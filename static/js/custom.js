
$('.course_slider').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 3,
  dots:true,
  autoplay:true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

$('.slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  adaptiveHeight:false,
  autoplay: true,
  pauseOnHover:true,
  autoplaySpeed: 6000,
  asNavFor: '.slider-nav',
});

$('.slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider',
  dots: false,
  vertical: true,
  centerMode: true,
  arrows:false,
  verticalSwiping: true,
  focusOnSelect: true
});
//show specific course.

var video_player = document.getElementById("video_player"),
links = document.getElementById("links"),
link = links.getElementsByTagName('a');
for(var i = 0; i < link.length; i++){
  link[i].onclick=handler;
}
function handler(e){
  e.preventDefault();
  videotarget = this.getAttribute("href");
  filename = videotarget.substr(0, videotarget.lastIndexOf('.'))||videotarget;
  video = document.querySelector("#video_player video");
  video.removeAttribute('poster');
  source = document.querySelectorAll("#video_player video source");
  source[0].src = filename + ".mp4";
  source[1].src = filename + ".ogg";
  video.load();
  video.play();
}
