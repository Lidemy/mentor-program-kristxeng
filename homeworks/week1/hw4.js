export const isPalindromes = (str) => {

  for( var i=0; i<Math.floor(str.length/2); i++) {

    if( str.charAt(i) !== str.charAt(str.length-1-i)) {

      return false;

    }

  }

  return true;
}