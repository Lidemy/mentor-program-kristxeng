const express = require('express');
const app = express();
const mysql = require('mysql');
const conn = require('./db').conn;
const usersTable = require('./db').usersTable;
const cmmtsTable = require('./db').cmmtsTable;
const bodyParser = require('body-parser');

// 驗證php hash 的資料用，為了使用舊資料表而裝
const phpPassword = require("node-php-password");
const session = require('express-session');

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());


app.set('views', './views');
app.set('view engine', 'ejs');
app.use(express.static('./public'));
app.use(session({
  secret: 'fdsh521',
  resave: true,
  saveUninitialized: true,
  cookie: {maxAge: 60*60 * 1000}
}));




// 登入頁路由
app.get('/login', (req, res) => {
  
  res.render('login');
});

// 登入驗證
app.post('/login', (req, res) => {



  conn.query({  
    sql: 'SELECT id, username, password, nickname FROM ?? WHERE username = ?',
    values: [ usersTable, req.body.username ]

  }, (error, results) => {
    if (error) throw error;

    //有查詢到結果則比對密碼
    if(results.length !== 0){
      if( phpPassword.verify(req.body.password, results[0].password) ){
        
        req.session.user_id = results[0].id;
        req.session.nickname = results[0].nickname;
        res.send('ok');
      } else {

        res.send('error'); //密碼比對錯誤
      }

    } else {
      
        res.send('error'); //查詢不到該 username
      
    }; 
  });
});


// 註冊頁路由
app.get('/reg', (req, res) => {

  res.render('reg');
});

// 註冊頁驗證
app.post('/reg', (req, res) => {

  //檢查帳號及暱稱是否已被人使用
  conn.query({
    sql: 'SELECT username , nickname FROM ?? WHERE username=? OR nickname=?',
    values: [ usersTable, req.body.username, req.body.nickname ]
  
  }, (error, results) => {

    if (error) throw error;

    //如果找不到重複帳號或暱稱，才做資料寫入
    if( results.length === 0) {

      conn.query({
        sql: 'INSERT INTO ?? (username, password, nickname) VALUES (?, ?, ?)',
        values: [ usersTable, req.body.username, phpPassword.hash(req.body.password), req.body.nickname ]

      }, (error, results) => {
        if (error) throw error;

        req.session.user_id = results.insertId;
        req.session.nickname = req.body.nickname;
        res.send('ok');
      });

    //如果已有重複的帳號暱稱，則回傳'error'  
    }else{

      res.send('error');

    };
  });
});


//首頁路由
app.get('/', (req, res) =>{

  res.redirect('/pages/1');

})

// 首頁顯示留言&頁碼處理
app.get('/pages/:page', (req, res) => {

  var currentPage,
      totalPages,
      cmmtStartNum;

  //驗證用戶登入狀態
  if( typeof(req.session.user_id) !== 'undefined' ){
    res.locals.user = { user_id: req.session.user_id, nickname: req.session.nickname };
  }else{
    res.locals.user = { user_id: undefined, nickname: undefined};
  }

  // 查詢主要留言筆數，用以計算頁數及每頁起始留言
  conn.query({ 
    sql: 'SELECT COUNT(parent_id) AS datanum FROM ?? WHERE parent_id = 0',
    values: [cmmtsTable]
  }, (error, results, fields) => { 

    if (error) throw error;

    // 總頁數計算
    totalPages = Math.ceil( results[0].datanum / 10 ); 
    res.locals.totalPages = totalPages;

    if( parseInt(req.params.page) < 0 || parseInt(req.params.page) > totalPages || isNaN(parseInt(req.params.page)) ){

      //如果頁碼不合法，跳回第一頁
      res.redirect('/pages/1');

    } else {
      
      currentPage = parseInt(req.params.page);
      res.locals.currentPage = currentPage;
      cmmtStartNum = ( currentPage - 1 ) * 10;
    };

    //查詢目前頁面需要的十筆主要留言
    conn.query({ 
      sql:'SELECT c.id AS cmmt_id, user_id, nickname, created_by, content FROM ?? AS c INNER JOIN ?? AS u '+
              'ON parent_id = 0 AND user_id = u.id ORDER BY created_by DESC LIMIT ?, 10',
      values: [cmmtsTable, usersTable, cmmtStartNum]
      }, (error, results) => {
      if (error) throw error;

      res.locals.cmmt = results;

      //console.log(res.locals)
      

      //串接查詢子留言的 multiple sql statement
      var sql = '';
      for(let i=0; i<res.locals.cmmt.length; i++){

        sql += 'SELECT c.id AS cmmt_id, user_id, nickname, created_by, content, parent_id FROM '+cmmtsTable+' AS c INNER JOIN '+usersTable+' AS u WHERE'+
               ' parent_id = '+ res.locals.cmmt[i].cmmt_id + ' AND user_id = u.id ORDER BY created_by ASC;';
      }

      //查詢目前頁面的子留言
      conn.query({ sql }, (error, results) => {
        if (error) throw error;
        
        //把子留言依序塞進所屬的主留言中
        for(let i=0; i<res.locals.cmmt.length; i++){
          res.locals.cmmt[i].subCmmt = results[i];
        }
        
        res.render('index');
      });
    });
  });
});

//修改留言處理
app.post('/modify_cmmt', (req, res) => {

  conn.query({
    sql: 'UPDATE ?? SET content = ? WHERE id = ?',
    values: [cmmtsTable, req.body.content, req.body.cmmt_id]
  },(error, results)=>{

    if(error) res.send('error');
    else res.send('modified');
  });
});

//刪除留言處理
app.delete('/delete_cmmt',  (req, res) => {

  conn.query({
    sql: 'DELETE FROM ?? WHERE id = ? OR parent_id = ?',
    values: [cmmtsTable, req.body.cmmt_id, req.body.cmmt_id]
  }, (error, results) => {

    if(error) res.send('error');
    else res.send('deleted');
  });
});

// 登出處理
app.get('/logout', (req, res) => {
  req.session.destroy();
  res.redirect('/pages/1');
})

//新增留言處理
app.post('/insert_cmmt', (req, res) => {

  var sql = 'INSERT INTO ?? ( user_id, parent_id, content ) VALUES (?, ?, ?)';
  var inserts = [cmmtsTable, req.session.user_id, req.body.parent_id, req.body.content];
  sql = mysql.format(sql, inserts);

  conn.query({ sql }, (error, results) =>{

    if(error) throw error;

    //取得剛剛新增留言的 id ，並回查這筆留言的 created_by
    var cmmt_id = results.insertId;

    conn.query({
      sql: 'SELECT created_by FROM ?? AS c  WHERE c.id = ?',
      values: [cmmtsTable, cmmt_id]
    }, (error, results) => {
      if(error) throw error;

      //console.log(results)
      res.json({
        "nickname": req.session.nickname,
        "cmmt_id": cmmt_id,
        "created_by": results[0].created_by
      });

    });
  });
});


app.listen( 3000, () => console.log('Server is listening Port 3000 ') );