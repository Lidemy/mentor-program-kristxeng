var list = [];

$(document).ready( ()=>{
  
  //新增待辦事項
  $('.todo__add-btn').click( ()=>{
    if( $('.todo__input').val() !== '' ){

      //新待辦事項從最前端加入
      //list.text 是待辦事項內容，list.isCompleted 標示是否完成
      list.unshift( { 
      	text: $('.todo__input').val(),
      	isCompleted: false
      } );

      render();

      //輸入框清空
      $('.todo__input').val('');
    }
  })

  //刪除待辦事項按鈕處理
  //click evenListener 如果掛在 document 或 body 上，在 iOS 裝置上會失效。
  $('.container').on('click', '.todo__del-btn', function(e){

    //找到點擊刪除鍵所屬待辦事項在 list 中的 index
    var index = $('.todo-item').index( $(e.target).parents('.todo-item') ) - 1;

    //留下沒有被點擊刪除按鍵的待辦事項
    list = list.filter( (item, i) => i !== index );

    render();

  });

  $('.container').on('click', '.todo__completed-btn', function(e){
    
    //找到點擊刪除鍵所屬待辦事項在 list 中的 index
    var index = $('.todo-item').index( $(e.target).parents('.todo-item') ) - 1;

    //將點擊完成的待辦事項標記，重複點擊可以取消
    if( list[index]['isCompleted'] === false ){

    	list[index]['isCompleted'] = true;

    }else{

    	list[index]['isCompleted'] = false;
    }
    

    render();

  });
});

function render(){
  //每次 render 之前，先把item清空，但需保留第一個item(撰寫框)
  $('.todo-item:gt(0)').remove();

  for(var i=0; i<list.length; i++){

    if( !list[i]['isCompleted'] ){
      //未完成的待辦事項
      $('.todo-item:last').after(`
        <div class="todo-item">
          <div class="todo__completed-btn unselectable"></div>
          <div class="todo__content">${list[i]['text']}</div>
          <div class="todo__del-btn"><img src="close.jpg" /></div>
        </div>
      `)
    }else{
      //已完成的待辦事項
      $('.todo-item:last').after(`
        <div class="todo-item">
          <div class="todo__completed-btn unselectable">&radic;</div>
          <div class="todo__content todo__content--completed">${list[i]['text']}</div>
          <div class="todo__del-btn"><img src="close.jpg" /></div>
        </div>
      `)
    }
  }
  
}