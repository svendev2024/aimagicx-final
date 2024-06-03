/* ===================================================================

  Minimizing Menu Bar 

  =================================================================== */

  $(document).ready(function() {

    "use strict";
  
    $(window).on('scroll', function() {
  
      if($(document).scrollTop()>100) {
        $('#navbar-container').addClass('minimize-navbar');
      }
      else {
        $('#navbar-container').removeClass('minimize-navbar');
      }
  
    });
  
  });