jQuery(window).load(function(){

		jQuery(".gallery").owlCarousel({
			loop: true,
			responsive:{
				0:{
					items:1
				},
				450:{
					items:1
				},
				600:{
					items:2
				},
				960:{
					items:3
				},
			}
		});
});

//BEGIN homepage listings carousel init

jQuery(".listing__image").load(function(){

	jQuery(".owl-carousel--listings").on('initialized.owl.carousel', function(event){ 
		detectNumberOfOwlItems(".owl-carousel--listings");
    //alert( 'Owl is loaded!' );
	});

	jQuery(".owl-carousel--listings").owlCarousel({
		loop: false,
		autoHeight:true,
		responsive:{
			0:{
				items:1,
			},
			450:{
				items:1,
			},
			800:{
				autoHeight: true,
				items:2,
				margin: 40,
			},
			1100:{
				items: 2,
				margin: 80,
			}
		}
	});

});

//END homepage listings carousel

jQuery(window).on('resize', function(e) {
	detectNumberOfOwlItems(".owl-carousel--listings");
});

var $listingsOwlCarousel = jQuery('.listings .owl-carousel--listings');

jQuery('.listings__nav_link--right').click(function() {
		$listingsOwlCarousel.trigger('next.owl.carousel');
});

jQuery('.listings__nav_link--left').click(function() {
		$listingsOwlCarousel.trigger('prev.owl.carousel');
});


//----------
// DETECT NUMBER OF VISIBLE OWL ITEMS AND HIDE NAV WHEN APPROPRIATE
//----------

var detectNumberOfOwlItems = function(target){

  var numberOfVisible = jQuery(target + ".active").length;
  var numberOfTotal = jQuery(target).length;
  
  if (numberOfTotal === 1 || numberOfTotal === numberOfVisible){
    jQuery(".listings__nav_link").addClass("inactive");
  } else {
    jQuery(".listings__nav_link").removeClass("inactive");
  }
};

jQuery(document).ready(function(){
	detectNumberOfOwlItems(".listings .owl-item");
});

var resizeTimer;

jQuery(window).on('resize', function(e) {

  clearTimeout(resizeTimer);
  resizeTimer = setTimeout(function() {

    detectNumberOfOwlItems(".listings .owl-item");

  }, 250);

});

//----------
// DETECT NUMBER OF VISIBLE OWL ITEMS AND HIDE NAV WHEN APPROPRIATE
//----------