  function submitform()
{
document.forms["searchForm"].submit();
}

// menu //
if (jQuery('.xs-menus').length > 0) {
  jQuery('.xs-menus').xs_nav({
    mobileBreakpoint: 992,
  });
  }
  if (jQuery('.nav-hidden-menu').length > 0) {
  jQuery('.nav-hidden-menu').xs_nav({
    hidden: true
  });
  jQuery(".btn-show").click(function(){ 
    jQuery(".nav-hidden-menu").data("xs_nav").toggleOffcanvas();
  });
}
// fancybox //
$('[data-fancybox="gallery"]').fancybox({
});

// slide toogle //
$('.filterToggle').click(function() {
  $('.filterInfos').slideToggle('slow');
});

// back to top //
$(function(){
  // Scroll Event
  $(window).on('scroll', function(){
      var scrolled = $(window).scrollTop();
      if (scrolled > 600) $('.btn-scroll-top').addClass('active');
      if (scrolled < 600) $('.btn-scroll-top').removeClass('active');
  });  
  // Click Event
  $('.btn-scroll-top').on('click', function() {
      $("html, body").animate({ scrollTop: "0" },  500);
  });
});

// stciky header //
$( document ).ready( function( $ ) {
  $( '#sticky' ).stickable();
});

// video carasual //
jQuery(document).ready(function () {
  // reference for main items
  var slider = jQuery('#slider');
  // reference for thumbnail items
  var thumbnailSlider = jQuery('#thumbnailSlider');
  //transition time in ms
  var duration = 1000;

  // carousel function for main slider
  slider.owlCarousel({
   loop:false,
   nav:false,
   autoplay:false,
   items:1
  }).on('changed.owl.carousel', function (e) {
   //On change of main item to trigger thumbnail item
   thumbnailSlider.trigger('to.owl.carousel', [e.item.index, duration, true]);
  });

  // carousel function for thumbnail slider
  thumbnailSlider.owlCarousel({
   loop:false,
   margin:10,
   center:false, //to display the thumbnail item in center
   nav:false,
   autoplay:false,

   responsive:{
    0:{
     items:3
    },
    600:{
     items:4
    },
    1000:{
     items:6
    }
   }
  }).on('click', '.owl-item', function () {
   // On click of thumbnail items to trigger same main item
   slider.trigger('to.owl.carousel', [jQuery(this).index(), duration, true]);

  }).on('changed.owl.carousel', function (e) {
   // On change of thumbnail item to trigger main item
   slider.trigger('to.owl.carousel', [e.item.index, duration, true]);
  });


  //These two are navigation for main items
  jQuery('.slider-right').click(function() {
   slider.trigger('next.owl.carousel');
  });
  jQuery('.slider-left').click(function() {
   slider.trigger('prev.owl.carousel');
  });
 });