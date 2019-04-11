console.log('loaded course js');
if(document.getElementById('index')){
  let headers = document.querySelectorAll("h1, h2, h3, h4, h5, h6");
  let i = 1;
  let indexHtml = '';
  let indexHolder = document.getElementById('index');
  headers.forEach(function(header) {
    header.id = "header-" + i;
    console.log(header.id);
    indexHtml = indexHtml + '<li><a href="#header-' + i + '">'+header.innerHTML+'</a></li>' ;
    ++i;
  });//
  indexHolder.innerHTML = indexHtml;

}