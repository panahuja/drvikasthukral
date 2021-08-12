$(document).ready(function(){
$('.slick-track').slick({
  dots: false,
  infinite: true,
  speed:2000,
  slidesToShow: 4,
  autoplay: true,
  autoplaySpeed: 5000,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false
		
      }
    },
    {
      breakpoint: 650,
      settings: {
        slidesToShow: 2,
		autoplay: true,
  		autoplaySpeed: 2000,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 490,
      settings: {
        slidesToShow: 1,
		autoplay: true,
        autoplaySpeed: 2000,
        slidesToScroll: 1
      }
    }
  ]
});
});

$(document).ready(function(){
$('.slick-track1').slick({
  dots: true,
  infinite: true,
  speed:2000,
  slidesToShow: 1,
  autoplay: true,
  autoplaySpeed: 5000,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true
		
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
		autoplay: true,
  		autoplaySpeed: 2000,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
		autoplay: true,
        autoplaySpeed: 2000,
        slidesToScroll: 1
      }
    }
  ]
});
});