const Sequelize = require('sequelize')
const sequelize = require('./db')

const Url = sequelize.define('url', {
  shorten_url: {
    type: Sequelize.STRING
  },
  true_url: {
    type: Sequelize.STRING
  }
})

Url.sync()

module.exports = Url