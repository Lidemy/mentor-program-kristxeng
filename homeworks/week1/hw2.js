export const capitalize = (str) => {
  if( str.charCodeAt(0) >=97 &&str.charCodeAt(0)<=122){
  
  str = String.fromCharCode(str.charCodeAt(0)-32) + str.substring(1)
  
  }
  return str;
}