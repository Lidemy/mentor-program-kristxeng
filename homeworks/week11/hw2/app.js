const express = require('express')
const app = express()
const bodyParser = require('body-parser');

const indexController = require('./controller/index')
const redirectController = require('./controller/redirect')

app.set('view engine', 'ejs')
app.use(express.static('./public'));

app.use(bodyParser.urlencoded({ extended: false }))
app.use(bodyParser.json())


const Url = require('./model/url')


app.get('/', indexController.index)
app.post('/', indexController.shorten)

app.get('/s/:shortenUrl', redirectController)

app.listen( 3000, () => console.log('Server is listening Port 3000') )