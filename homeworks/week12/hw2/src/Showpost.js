import React from 'react'
import axios from 'axios'

export default class Showpost extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      post: ''
    }
  }

  componentDidMount() {
    axios.get('https://jsonplaceholder.typicode.com/posts/' + this.props.postId)
    .then( res => {
      this.setState({
        post: res.data
      })
    })
  }

  render() {
    const {post} = this.state
    return(
      <div>
        <div>
          <button type="button" className="btn btn-light" onClick={()=>this.props.backList()}>Back List</button>
        </div>
        <div className="display-4">{post.title}</div>
        <p>{post.body}</p>
      </div>
    )
  }

}