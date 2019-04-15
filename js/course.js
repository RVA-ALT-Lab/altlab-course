//build index for logistics page
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


//full size video
var videos = document.querySelectorAll('iframe[src^="https://www.youtube.com/"], iframe[src^="https://player.vimeo.com"], iframe[src^="https://www.youtube-nocookie.com/", iframe[src^="https://www.nytimes.com/"]'); //get video iframes for regular youtube, privacy+ youtube, and vimeo

videos.forEach(function(video) {
      let wrapper = document.createElement('div'); //create wrapper 
      wrapper.classList.add("video-responsive"); //give wrapper the class      
      video.parentNode.insertBefore(wrapper, video); //insert wrapper      
      wrapper.appendChild(video); // move video into wrapper
});