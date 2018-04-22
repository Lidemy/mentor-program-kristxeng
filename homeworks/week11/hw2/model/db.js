const Sequelize = require('sequelize')
const sequelize = new Sequelize('shorten_url', '', '', {
  host: 'localhost',
  dialect: 'mysql'
})

sequelize
  .authenticate()
  .then( ()=> {
    console.log('Connection has been established successfully.')
  })
  .catch( err => {
    console.log('Unable to connect to the database:', err)
  })

module.exports = sequelize