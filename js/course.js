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
var videos = document.querySelectorAll('iframe[src^="https://www.youtube.com/"], iframe[src^="https://player.vimeo.com"], iframe[src^="https://www.youtube-nocookie.com/"], iframe[src^="https://www.nytimes.com/"]'); //get video iframes for regular youtube, privacy+ youtube, and vimeo

videos.forEach(function(video) {
      let wrapper = document.createElement('div'); //create wrapper 
      wrapper.classList.add("video-responsive"); //give wrapper the class      
      video.parentNode.insertBefore(wrapper, video); //insert wrapper      
      wrapper.appendChild(video); // move video into wrapper
});

//BUBBLE ZONE

//let scores = ['pos-one', 'pos-one', 'pos-three','neg-two','pos-one', 'pos-one', 'pos-three','neg-two', 'neg-ten','neg-ten','neg-ten','neg-ten','neg-ten','neg-ten','neg-ten','neg-ten','pos-seven']
let scores = gformScores.scores;
countThem(scores)
function countThem(scores){
  //let bubbles = document.querySelectorAll('.bubble');//gets all the bubbles
  //console.log(bubbles)
  scores.forEach(function(score){
    let bubble = document.getElementById(score);
    console.log(bubble)
    //el.getAttribute('data-foo'));
    let count = parseInt(bubble.getAttribute('data-count'),10);
    console.log(count);
    count = count+1;
    bubble.setAttribute('data-count', count);
    bubble.setAttribute('style', 'border-top:' + (count*3.5) + 'px solid #00b3be);');
  })
}