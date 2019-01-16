//-----------------------------------------
// Sidebar Newsletter Signup Form Validate
//-----------------------------------------
jQuery('form.sidebar_newsletter__form').submit(function(e){

    if(jQuery('#edit-name-first').val() == '' || jQuery('#edit-email').val() == ''){
        alert('Please enter a name and email address.');
        e.preventDefault();
        return false;
    }

});

//--------------
// ANCHOR BUTTON
//--------------

function checkIfScrollIsAtTop() {
    if(jQuery(window).scrollTop()<=100){
      jQuery(".anchor_btn").addClass("at_top");
      jQuery(".anchor_btn.at_top").fadeIn();
    } else {
      jQuery(".anchor_btn").addClass("at_top");
      jQuery(".anchor_btn.at_top").fadeOut();
    }
}

function scrollToAnchor(aid){
  var divTag = jQuery("div[name='"+ aid +"']");
  jQuery('html,body').animate({scrollTop: divTag.offset().top},'slow');
}

// enquire.register("screen and (min-width:960px)", {
//   // Triggered when a media query matches.
//   match : function() {

//     jQuery(window).scroll(function(){
//       checkIfScrollIsAtTop();
//     });
    
//     jQuery(".anchor_btn__link").click(function() {
//       scrollToAnchor("mission");
//       console.log("fired");
//     });
    
//     checkIfScrollIsAtTop();

//   }, unmatch : function() {

//   }
// });

//--------------
// END ANCHOR BUTTON
//--------------

var setFooterPaddingBottom = function(){
    jQuery(".footer").css("padding-bottom", jQuery(".bookNowToolbar").height() + "px");
}

setFooterPaddingBottom();

jQuery(window).bind("resize", function(){
    setFooterPaddingBottom();
});



// General Onready

jQuery(document).ready(function() {
  
  // SVG Fallbacks
  if (!Modernizr.svg) {
	jQuery("").attr("src", "");
  }	
  
  // Header Scrolling
  var header = jQuery('header.site-header');
  var scrollState = 'top';  
  
  jQuery(window).scroll(function(){ 
	var scrollPos = jQuery(window).scrollTop();
	if (scrollPos != 0) {
	  if (scrollState === 'top') {
		scrollState = 'scrolled';
		header.addClass('scrolling');
	  }		
	}       
	else if(scrollPos === 0) {
	  if (scrollState === 'scrolled'){
		scrollState = 'top';
		header.removeClass('scrolling');
	  }
	}
  });
  
  // Calculate header offset when window is resized
  jQuery(window).bind('resize', calculateHeaderOffset).resize();

});

// Calculate Header Offset (when fixed at 1200px)
function calculateHeaderOffset() {
  if(Modernizr.mq('(min-width: 1800px)') ) {
	jQuery('header.site-header').next().css("margin-top", "135px");   
  }	
  else if(Modernizr.mq('(min-width: 1600px)') ) {
	jQuery('header.site-header').next().css("margin-top", "127px");   
  }
  else if(Modernizr.mq('(min-width: 1400px)') ) {
	jQuery('header.site-header').next().css("margin-top", "110px");   
  }
  else if(Modernizr.mq('(min-width: 1200px)') ) {
	jQuery('header.site-header').next().css("margin-top", "102px");   
  }			
  else if(Modernizr.mq('(min-width: 1100px)') ) {
	jQuery('header.site-header').next().css("margin-top", "84px");   
  } 
  else {
	jQuery('header.site-header').next().css("margin-top", "auto"); 
  }	
}

// Upper Donation Counter Promo Move/Bind
jQuery(window).bind('resize', function(){  
  if(Modernizr.mq('(min-width: 960px)') ) {
	jQuery('.upper-promo.donation-counter').insertAfter('.upper-promo.saranac-lake');
  }	  
  else {
	jQuery('.upper-promo.donation-counter').insertBefore('.upper-promo.saranac-lake');
  }  
}).resize();

// Clean function to remove unwatned nodes from inside a DOM node (Support for inline-block grid layout)
var utils = {};
utils.clean = function(node) {
  var child, i, len = node.childNodes.length;
  if (len === 0) { return; }
  // iterate backwards, as we are removing unwanted nodes
  for (i = len; i > 0; i -= 1) {
	child = node.childNodes[i - 1];
	// comment node? or empty text node
	if (child.nodeType === 8 || (child.nodeType === 3 && !/\S/.test(child.nodeValue) )) {
	  node.removeChild(child);
	}
	else {
	  if (child.nodeType === 1) {
		utils.clean(child);
	  }
	}
  }
};
// Add .inline-block-grid-parent class where needed
jQuery(".footer-contact-form form").addClass("inline-block-grid-parent");
// Run divs with class .inline-block-grid-parent through clean function
jQuery(".inline-block-grid-parent").each( function(){ 
  utils.clean(this);
});


// JC JC JC
// JC JC JC
// JC JC JC

//on doc read

jQuery(document).ready(function(){
  setPromoHeight();
});

//on resize

jQuery(window).on('resize', function(e) {
  setPromoHeight();
});


//----------
// WOW Init
//----------
jQuery(document).ready(function(){
    new WOW({
        boxClass:'wow',// animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 0,// distance to the element when triggering the animation (default is 0)
        mobile: false,// trigger animations on mobile devices (default is true)
        live: true,// act on asynchronously loaded content (default is true)
        scrollContainer: null, // optional scroll container selector, otherwise use window
    }).init();
});

//@DD quick menu hide thing
jQuery('.hideMenu').click(function(){
    jQuery('#toolbar-administration').hide();
    jQuery('body').css('margin-left','0px');
});



//----------
// PROMO HEIGHT
//----------

function setPromoHeight() {

  var $sidebar = jQuery(".sidebar");
  $sidebar.find(".sidebar_promo").each(function(){
    var $promo_container = jQuery(this).find(".sidebar_promo__container");
    $promo_container.css("padding-top", ($promo_container.find(".copy").height() * 2 / 3));
  });
}

//----------
// DETECT NUMBER OF VISIBLE OWL ITEMS AND HIDE NAV WHEN APPROPRIATE (AGAIN)
//----------

jQuery(document).ready(function(){
  jQuery(".listings__nav_link--left").addClass("reached_end");
});

jQuery(window).on('resize', function(e) {
  greyCarouselNav();
});

jQuery(".listings__nav").on("click", function(){
  greyCarouselNav();
});

function greyCarouselNav() {

  var $target =  jQuery(".owl-carousel--listings");

  if ($target.find(".owl-item").last().hasClass("active")) {
    $target.closest(".listings").find(".listings__nav_link--right").addClass("reached_end");
  } else {
    $target.closest(".listings").find(".listings__nav_link--right").removeClass("reached_end");
  }
  
  if ($target.find(".owl-item").first().hasClass("active")) {
    $target.closest(".listings").find(".listings__nav_link--left").addClass("reached_end");
  } else {
    $target.closest(".listings").find(".listings__nav_link--left").removeClass("reached_end");
  }

}


//----------
// DETECT HOW MANY LISTING INFOS THERE ARE
//----------
// jQuery(".listing__info").each(function(){

//   if (jQuery(this).find("li").length <= 1) {
//     jQuery(this).addClass("has_single_child");
//   }
// });


//----------
// DETECT IF THERE'S A SIDEBAR
//----------

if (jQuery(".content_and_sidebar__container").find('.sidebar').length == 0) {
  jQuery(".content_and_sidebar__container").addClass("no_sidebar");
}