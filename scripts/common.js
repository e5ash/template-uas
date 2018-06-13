$(document).ready(function($) {

	$('.input_tel input').mask('+7 (999) 999-99-99');
	

	$('.gallery__slider').slick({
		centerMode: true,
		variableWidth: true,
		dots: true,
		responsive: [{
			breakpoint: 815,
			 settings: {
        centerMode: false,
				variableWidth: false,
      }
		}]
	})

	$('.program__item_show .program__slider-wrap').slick({
		dots: true
	})

	$('.program__btn-more').click(function(event) {
		$('.program__item').slideDown(300)
		$(this).hide();
		$('.program__item_hide .program__slider-wrap').slick({
			dots: true
		})
	});

	$('.reviews__list').slick({
		slidesToShow: 2,
		responsive: [{
			breakpoint: 992,
			 settings: {
        slidesToShow: 1
      }
		}]
	})
$('#menu-item-490 a').attr('target','_blank');
	$(".header__nav-wrap").on("click","a", function (event) {
		var widthWindow = $(window).width(),
				minusHeight,
				idAttr = $(this).parent('li').attr("id");

		if(idAttr != 'menu-item-490'){
			event.preventDefault();

			var id  = $(this).attr('href'),
					top = $(id).offset().top;
			if(widthWindow < 790) {
				minusHeight = 70;
			} else{
				minusHeight = 102;
			}
			$('body,html').animate({scrollTop: top - minusHeight}, 1500);
			$('.header__mobile-btn').removeClass('header__mobile-btn_click');
			$('.header__nav-wrap').removeClass('header__nav-wrap_open');
		}
	});

	$(window).on('load resize scroll', function(event) {
		if($(window).scrollTop() > 1){
			$('.header__nav').addClass('header__nav_scroll');
		} else{
			$('.header__nav').removeClass('header__nav_scroll');
		}
	});

	$(window).on('load resize', function(event) {
		setTimeout(function() {
			$('.sbi_photo').each(function() {
				var width = $(this).width();
				$(this).css('height', width);
				console.log(width);
			});
			
		}, 1000);
	});

	$('.header__mobile-btn').click(function() {
		$(this).toggleClass('header__mobile-btn_click');
		$('.header__nav-wrap').toggleClass('header__nav-wrap_open');
	});


	

});
