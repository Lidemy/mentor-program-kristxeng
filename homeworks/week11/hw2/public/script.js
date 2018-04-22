$('.btn').click(()=>{

  if( $('#true-url').val() !== ''){

    $.post('/', { trueUrl: $('#true-url').val() }, response =>{

      $('.shorten-url').text( 'http://thinkr.tw:3001/s/' + response )

      console.log($('#true-url').val())

    })
  }  
})