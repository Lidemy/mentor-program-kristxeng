import React from 'react'
import { hot } from 'react-hot-loader'
import Posts from './Posts'
import About from './About'

class Blog extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      tab: 'home'
    }

    this.handleTab = this.handleTab.bind(this)

  }

  handleTab(e) {
    e.preventDefault()
    this.setState({
      tab: e.target.name
    })
  }



  render() {
    let {tab} = this.state
    return(
      <div>
        <nav className="navbar navbar-expand navbar-light mb-5" style={{backgroundColor: '#dcdcdc'}}>
          <div className="container">
            <span className="navbar-brand h1">Blog</span>
            
            <ul className="navbar-nav mr-auto">
              <li className={ "nav-item " + (tab==='home' ? "active" : "") }>
                <a className="nav-link" href="#" name="home" onClick={this.handleTab}>Home</a>
              </li>
              <li className={ "nav-item " + (tab==='about' ? "active" : "") }>
                <a className="nav-link" href="#" name="about" onClick={this.handleTab}>About</a>
              </li>
            </ul>
            
          </div>
        </nav>
        <div className="container">
          {tab==='home' && <Posts />}
          {tab==='about' && <About />}
        </div>
      </div>
    )
  }
}



export default hot(module)(Blog)