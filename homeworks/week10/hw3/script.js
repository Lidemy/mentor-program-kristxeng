var list = [];

$(document).ready( ()=>{
  
  //新增待辦事項
  $('.todo__add-btn').click( ()=>{
    if( $('.todo__input').val() !== '' ){

      //新待辦事項從最前端加入，list每個item的第二個值用來標記是否完成
      list.unshift( [$('.todo__input').val(),0] );

      render();

      //輸入框清空
      $('.todo__input').val('');
    }
  })

  //刪除待辦事項按鈕處理
  $(document).on('click', '.todo__del-btn', function(e){

    //找到點擊刪除鍵所屬待辦事項在 list 中的 index
    var index = $('.todo-item').index( $(e.target).parents('.todo-item') ) - 1;

    //留下沒有被點擊刪除按鍵的待辦事項
    list = list.filter( (item, i) => i !== index );

    render();

  });

  $(document).on('click', '.todo__completed-btn', function(e){
    
    //找到點擊刪除鍵所屬待辦事項在 list 中的 index
    var index = $('.todo-item').index( $(e.target).parents('.todo-item') ) - 1;

    //將點擊完成的待辦事項標記
    list[index][1] = 1;

    render();

  });
});

function render(){
  //每次 render 之前，先把item清空，但需保留第一個item(撰寫框)
  $('.todo-item:gt(0)').remove();

  for(var i=0; i<list.length; i++){

    if( list[i][1] === 0){
      //未完成的待辦事項
      $('.todo-item:last').after(`
        <div class="todo-item">
          <div class="todo__completed-btn unselectable"></div>
          <div class="todo__content">${list[i][0]}</div>
          <div class="todo__del-btn"><img src="close.jpg" /></div>
        </div>
      `)
    }else{
      //已完成的待辦事項
      $('.todo-item:last').after(`
        <div class="todo-item">
          <div class="todo__completed-btn unselectable">&radic;</div>
          <div class="todo__content todo__content--completed">${list[i][0]}</div>
          <div class="todo__del-btn"><img src="close.jpg" /></div>
        </div>
      `)
    }
  }
  
}