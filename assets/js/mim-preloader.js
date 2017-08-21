$ = new jQuery.noConflict();

$(window).on('load', function() { // makes sure the whole site is loaded 
  $('.sk-rotating-plane').fadeOut(); // will first fade out the loading animation 
  $('.mim-preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
  $('body').delay(350).css({'overflow':'visible'});
})