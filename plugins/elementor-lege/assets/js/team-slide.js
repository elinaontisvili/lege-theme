(function($){

    $('.team__slider').slick({
	infinite: true,
	arrows: true,
	speed: 300,
	slidesToShow: 3,
	nextArrow: '<button type="button" class="common-arrow common-next"></button>',
	prevArrow: '<button type="button" class="common-arrow common-prev"></button>',
	responsive: [

	{
		breakpoint: 1271,
		settings: {
			slidesToShow: 1,
			centerPadding: '350px',
			centerMode: true,
			focusOnSelect: true
		}
	},
	{
		breakpoint: 1101,
		settings: {
			slidesToShow: 1,
			centerPadding: '270px',
			centerMode: true,
			focusOnSelect: true
		}
	},
	{
	breakpoint: 870,
		settings: {
			slidesToShow: 1,
			centerPadding: '210px',
			centerMode: true,
			focusOnSelect: true
		}
	},
	{
		breakpoint: 769,
			settings: {
				slidesToShow: 1,
				centerPadding: '0px',
				centerMode: false,
				focusOnSelect: false
			}
	},
	]
	});

})(jQuery);