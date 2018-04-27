import React from 'react'
import ReactDOM from 'react-dom'

class TodoItem extends React.Component {
  constructor(props) {
    super(props)
    this.itemRemove = this.itemRemove.bind(this)
    this.itemCompeleted = this.itemCompeleted.bind(this)
  }

  itemRemove() {
    this.props.itemRemove(this.props.itemId)
  }

  itemCompeleted() {
    this.props.itemCompeleted(this.props.itemId)
  }
  render() {
    const {content, compeleted} = this.props
    return (
      <li className="list-group-item d-flex justify-content-between" style={{fontSize: 20, lineHeight: 1.6}}>
        <span style={{cursor: 'pointer'}} onClick={this.itemCompeleted}>
          { compeleted ? (  //已完成事項畫橫線
              <del>{content}</del>  
          ) : (
              content
          )}
        </span>
        <button className="btn btn-light" onClick={this.itemRemove}>X</button>
      </li>
    )
  }
}



class TodoList extends React.Component {
  constructor(props) {
    super(props)
    this.state = {
      inputValue: '',
      item: []
    }

    this.handleChange = this.handleChange.bind(this)
    this.handleSubmit = this.handleSubmit.bind(this)
    this.handleEnter = this.handleEnter.bind(this)
    this.itemRemove = this.itemRemove.bind(this)
    this.itemCompeleted = this.itemCompeleted.bind(this)
    this.id = 0
  }

  handleChange(e) {
    this.setState({
      inputValue: e.target.value
    })
  }

  handleSubmit() {
    //如果輸入框沒輸入文字，確認鍵不反應
    if(this.state.inputValue){
      this.setState({
        item: [{ id: this.id++, content: this.state.inputValue, compeleted: false}, ...this.state.item],
        inputValue: ''
      })
    }
  }

  handleEnter(e) {  //讓鍵盤 Enter 鍵等同網頁上的 Add 按鈕
    if(e.key==='Enter'){
      this.handleSubmit()
    }

  }

  itemRemove(itemId) {
    this.setState({
      item: this.state.item.filter( item => item.id !== itemId)
    })
  }

  itemCompeleted(itemId) {
    //只修改選取元素中的 compeleted，其他維持不變
    let items = this.state.item.map( item => {
      if(item.id === itemId) item.compeleted = !item.compeleted
      return item
    })

    //再把修改好的item，塞回 state    
    this.setState({
      item: items
    })
  }

  render() {
    return (
      <div className="container d-flex justify-content-center">
        <div className="col-md-8">
          <div className="display-3 mt-3">Todo List</div>
          <div className="input-group input-group-lg mb-3">
            <div className="input-group-prepend">
              <span className="input-group-text">+</span>
            </div>
            <input type="text" className="form-control" value={this.state.inputValue} onChange={this.handleChange} onKeyPress={this.handleEnter} />
            <div className="input-group-append">
              <button className="btn btn-outline-secondary" type="button" onClick={this.handleSubmit}>Add</button>
            </div>
          </div>
          <ul className="list-group">
            
            {this.state.item.map( item => (
              <TodoItem key={item.id} itemId={item.id} content={item.content} compeleted={item.compeleted} itemRemove={this.itemRemove} itemCompeleted={this.itemCompeleted}/>
            ))}

          </ul>
        </div>
      </div>
    )
  }
}

ReactDOM.render(
  <TodoList />,
  document.getElementById('root')
)