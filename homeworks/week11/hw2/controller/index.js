const Url = require('../model/url')

module.exports = {

  index: (req, res) => {

    res.render('index')
  },

  shorten: (req, res) => {

    let urlCode = makeRandom(6) 

    Url.create({

      shorten_url: urlCode,
      true_url: req.body.trueUrl
    
    }).then( () =>{

      res.send( urlCode )

    }).catch( (err) => {

      console.log(err)

    })
  }
}

// 隨機取得由大小寫及數字組成的亂數
function makeRandom( digits ){

  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < digits; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;

}