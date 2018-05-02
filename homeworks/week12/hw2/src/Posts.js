import React from 'react'
import axios from 'axios'
import Showpost from './Showpost'


export default class Posts extends React.Component {
  constructor(props) {
    super(props)
    this.state = {
      post: [],
      currentPostId: ''
    }

    this.handleClick = this.handleClick.bind(this)
    this.backList = this.backList.bind(this)
  }

  handleClick(e) {
    this.setState({
      currentPostId: e.target.id
    })
  }

  backList() {
    this.setState({
      currentPostId: ''
    })
  }

  componentDidMount() {
    axios.get('https://jsonplaceholder.typicode.com/posts')
    .then( res => {
      this.setState({
        post: res.data
      })
    })
    .catch( err => console.log(err))

    // fetch('https://jsonplaceholder.typicode.com/posts')
    // .then( res => console.log(res))
    // .catch( err => console.log(err))

  }

  render() {
    const {post, currentPostId} = this.state
    return(
      <div>
        { currentPostId ? (
            
            <Showpost postId={currentPostId} backList={this.backList} />

          ) : (
            <div>
              <div className="display-4 mb-3">Posts List</div>
              <ul className="list-group list-group-flush">
                {post.map( item => (
                  <li className="list-group-item" style={{cursor: 'pointer'}} key={item.id} id={item.id} onClick={this.handleClick}>{item.title}</li>
                ))}
              </ul>
            </div>
        )}
      </div>

    )
  }
}