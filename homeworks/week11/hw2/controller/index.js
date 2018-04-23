const Url = require('../model/url')

module.exports = {

  index: (req, res) => {

    res.render('index')
  },

  shorten: (req, res) => {

    //短網址存進資料庫前，先驗證是否有重複
    /*這邊實際執行confirmUsable函式，但第二個參數其實包含了整個匿名函式的函式定義
      在確認短網址沒有重複時，才會呼叫這個匿名函式執行！*/
    confirmUsable( 6, urlCode => { // <== 從 urlCode 開始是匿名的 callback function 的定義

      // 確認沒有重複，實際存入資料庫
      Url.create({

        shorten_url: urlCode,
        true_url: req.body.trueUrl
      
      }).then( () =>{

        res.send( urlCode )

      }).catch( (err) => {

        console.log(err)

      })
    })
  }
}


function confirmUsable(digits, cb){ // <== 上面的匿名函式 用 cb 代入參考

  const urlCode = makeRandom(digits)

  Url.count({

    where:{ shorten_url: urlCode}
  
  }).then( count => {

    //如果資料庫沒有相同的urlCode，則執行 cb function
    if( count === 0 ){
    
      cb( urlCode )  // <==這邊才實際呼叫 cb 引入的匿名 function 執行

    //如果 urlCode 重複，則重複執行 confirmUsable
    } else {

      return confirmUsable(digits, cb)
    }
  })
}

// 隨機取得由大小寫及數字組成的亂數
function makeRandom( digits ){

  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < digits; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;

}

