export const stars = (n) => {

  var star=[]

  for(var i=0; i<n; i++){
    star[i] = i? star[i-1]+'*' : '*'
  }
  
  return star;
}