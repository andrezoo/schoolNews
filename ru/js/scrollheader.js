$(document).ready(function() {

  if ($(window).scrollTop() > 100) {
      $('.head-main').removeClass('antiscroll');
      $('.head-main').addClass('scroll');
  }
  else if(($(window).scrollTop() == 0)) {
    $('.head-main').addClass('antiscroll');
    $('.head-main').removeClass('scroll');
  }
  
});

$(window).scroll(function(){

    if ($(window).scrollTop() > 100) {
        $('.head-main').removeClass('antiscroll');
        $('.head-main').addClass('scroll');
    }
    else if(($(window).scrollTop() == 0)) {
      $('.head-main').addClass('antiscroll');
      $('.head-main').removeClass('scroll');
    }

});
