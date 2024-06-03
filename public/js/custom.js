(function($) {
	
    "use strict";

	/*===========================================================================
      *
      *  FULL SCREEN TOGGLE BUTTON
      *
      *============================================================================*/
	$("#fullscreen-button").on("click", function toggleFullScreen() {
		
      if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
		  $('#fullscreen-icon').removeClass('fa-expand');
		  $('#fullscreen-icon').addClass('fa-compress');
        if (document.documentElement.requestFullScreen) {
          document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
          document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
          document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        } else if (document.documentElement.msRequestFullscreen) {
          document.documentElement.msRequestFullscreen();
        }

      } else {

		$('#fullscreen-icon').addClass('fa-expand');
		$('#fullscreen-icon').removeClass('fa-compress');
        if (document.cancelFullScreen) {
          document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen();
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
        }
      }
    })



	/*===========================================================================
      *
      *  PAGE LOADING EFFECT
      *
      *============================================================================*/
	$(window).on("load", function(e) {
		$("#preloader").delay(0).fadeOut("slow");
	})



	/*===========================================================================
      *
      *  SCROLL TO TOP BUTTON
      *
      *============================================================================*/
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



	/*===========================================================================
      *
      *  GLOBAL SEARCH
      *
      *============================================================================*/
	$(document).on("click", "[data-toggle='search']", function(e) {
		var body = $("body");

		if(body.hasClass('search-gone')) {
			body.addClass('search-gone');
			body.removeClass('search-show');
		}else{
			body.removeClass('search-gone');
			body.addClass('search-show');
		}
	});
	var toggleSidebar = function() {
		var w = $(window);
		if(w.outerWidth() <= 1024) {
			$("body").addClass("sidebar-gone");
			$(document).off("click", "body").on("click", "body", function(e) {
				if($(e.target).hasClass('sidebar-show') || $(e.target).hasClass('search-show')) {
					$("body").removeClass("sidebar-show");
					$("body").addClass("sidebar-gone");
					$("body").removeClass("search-show");
				}
			});
		}else{
			$("body").removeClass("sidebar-gone");
		}
	}
	toggleSidebar();
	$(window).resize(toggleSidebar);



	/*===========================================================================
      *
      *  NOTIFICATION ALERTS
      *
      *============================================================================*/
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(4000, function(){
			$(this).remove(); 
		});
	}, 7000);



	/*===========================================================================
      *
      *  SIMPLEBAR INITIALIZATION
      *
      *============================================================================*/
	$(document).ready(function(){
		
		if (document.getElementById('scrollbar')) {
			var scrollbar = document.getElementById('scrollbar');
			new SimpleBar(scrollbar);
		  }
		
	});



  /*===========================================================================
      *
      *  PROMOCODE APPLY AT CHECKOUT
      *
      *============================================================================*/
	$('#prepaid-promocode-apply').on('click', function(e) {
		
		e.preventDefault()

		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: "POST",
			url: $('#payment-form').attr('promocode'),
			data: $('#payment-form').serialize(),

			success: function(data) {
				if (data['error']) {
					document.getElementById('promocode-error').classList.remove("d-none");
					document.getElementById('promocode-error').innerHTML = data['error'];	
				} else {
					document.getElementById('promocode-error').classList.add("d-none");
					document.getElementById('voucher-result').classList.remove("d-none");
					document.getElementById('total_payment').innerHTML = data['total'];
					document.getElementById('total_discount').innerHTML = data['discount'];
					document.getElementById('hidden_value').value = data['total'];
				}
			},
			error: function(data) {
				console.log(data)	
							
			}
		}).done(function(data) {})
	});


})(jQuery);


