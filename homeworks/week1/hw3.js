export const isPrime = (n) => {

  if( n==1 ) {
  
    return false
  
  }else if( n==2 ) {
  
  	return true
  
  }else if( n==3 ) {
  
  	return true
  
  }else {

    for(var i=2; i*i <= n; i++ ) {

      if( n % i ==0) {
        
        return false
      
      }

    }

    return true

  }  

}

  