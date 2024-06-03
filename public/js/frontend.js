/* ===================================================================

  Minimizing Menu Bar 

  =================================================================== */

  $(document).ready(function() {

    "use strict";
  
    $(window).on('scroll', function() {
      
      var image = document.getElementById("brand-img");

      if($(document).scrollTop()>100) {
        $('#navbar-container').addClass('minimize-navbar');
        $('.nav-link').addClass('dark-color');
        image.src = '../img/brand/logo.png';
      }
      else {
        $('#navbar-container').removeClass('minimize-navbar');
        $('.nav-link').removeClass('dark-color');
    image.src = '../img/brand/logo-white.png';
    
      }
  
    });
  
  });


/* ===================================================================

   SCROLL TO TOP BUTTON

   =================================================================== */
	$(window).on("scroll", function(e) {
    	if ($(this).scrollTop() > 0) {
            $('#back-to-top').fadeIn('slow');
        } else {
            $('#back-to-top').fadeOut('slow');
        }
    });
    $("#back-to-top").on("click", function(e){
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });



/* ===================================================================

    Feedbacks Section Image Slider 

   =================================================================== */

   $(document).ready(function()  {

    "use strict";
  
    $('#feedbacks').slick({
       slidesToShow: 3,
       slidesToScroll: 1,
       dots: true,
       arrows: true,
       nextArrow: $('.offers-next'),
       prevArrow: $('.offers-prev'),
       autoplay: false,
       autoplaySpeed: 2000, 
       speed: 1000,
       infinite: true,
       responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,         
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
          }
        },
      ]
    });
  
  });



/* ===================================================================

    Blogs Section Image Slider 

   =================================================================== */

   $(document).ready(function()  {

    "use strict";
  
    $('#blogs').slick({
       slidesToShow: 3,
       slidesToScroll: 1,
       dots: true,
       arrows: true,
       nextArrow: $('.blogs-next'),
       prevArrow: $('.blogs-prev'),
       autoplay: false,
       autoplaySpeed: 2000, 
       speed: 1000,
       infinite: true,
       responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,         
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
          }
        },
      ]
    });
  
  });



/* ===================================================================

    Partners Section Image Slider 

   =================================================================== */

   $(document).ready(function()  {

    "use strict";
  
    $('#partners').slick({
       slidesToShow: 6,
       slidesToScroll: 1,
       dots: false,
       arrows: false,
       autoplay: true,
       autoplaySpeed: 2000, 
       speed: 1000,
       infinite: true,
       responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,         
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
          }
        },
      ]
    });
  
  });



/* ===================================================================

  Current Menu Item

=================================================================== */

$(document).ready(function() {
		
  //Bootstraping variable
  let headerWrapper		= parseInt($('#navbarNav').height());
  let offsetTolerance	= 300;
  
  //Detecting user's scroll
  $(window).scroll(function() {
  
    //Check scroll position
    let scrollPosition	= parseInt($(this).scrollTop());
    
    //Move trough each menu and check its position with scroll position then add selected-nav class
    $('.navbar-nav > li > a').each(function() {

      let thisHref				= $(this).attr('href');
      let thisTruePosition	= parseInt($(thisHref).offset().top);
      let thisPosition 		= thisTruePosition - headerWrapper - offsetTolerance;
      
      if(scrollPosition >= thisPosition) {
        $('.navbar-nav > li > a.active').removeClass('active');
        $('.navbar-nav > li > a[href=\\'+ thisHref +']').addClass('active');
        
      }
    });
    
    
    //If we're at the bottom of the page, move pointer to the last section
    bottomPage	= parseInt($(document).height()) - parseInt($(window).height());
    
    if(scrollPosition == bottomPage || scrollPosition >= bottomPage) {
    
      $('.selected-nav').removeClass('selected-nav');
      $('navbar-nav > li > a:last').addClass('selected-nav');
    }
  });
  
});