$(function(){
  var pos = $('header').offset().top;
			var height = $('header').outerHeight();
			$(window).scroll(function() {
				if ($(this).scrollTop() > pos) {
					$('.header-nav').addClass("change-color");
          // $('.menu-font').addClass("change-color-font");
				} else if ($(this).scrollTop() == 0) {
					$('.header-nav').removeClass("change-color");
          // $('.menu-font').removeClass("change-color-font");
				}
			});

			$('.humburger-btn').on('click', function() {
				$('.menu02').toggleClass('menu02-open')
			});


});