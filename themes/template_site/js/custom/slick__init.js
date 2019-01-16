jQuery(document).ready(function(){
	jQuery('.listings__slider').slick({
		adaptiveHeight: true,
		dots: false,
		infinite: false,
		slidesToShow: 1,
		arrows: false,
		slidesToScroll: 1,
		mobileFirst: true,

		responsive: [
			{
				breakpoint: 800,
				settings: {
					slidesToShow: 2,
				}
			},
			{
				breakpoint: 1100,
				settings: {
					centerPadding: '80px',
				}
			}
		],
	});
});