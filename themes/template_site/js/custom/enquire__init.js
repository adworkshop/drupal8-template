jQuery(document).ready(function($){			
	intro_promo();
	mission__image();
	featured_listing();
	sidebar_promo();
});



//  Intro Promo Image _______________________________________
function intro_promo() {
	var parsed = [], $img, $bg_tpl = jQuery('<div/>', {class: 'intro_promo__img'}), $bg;
	jQuery('.intro_promo__img').each(function(index, value) {
		$img = jQuery(value)
		$bg = $bg_tpl.clone().attr('style', 'background-image: url(' + $img.attr('src') + ')');
		parsed.push({img : $img, bg : $bg});
	});

	enquire.register("screen and (min-width:960px)", {
		// Triggered when a media query matches.
		match : function() {
		jQuery(parsed).each(function(index, element) {
			jQuery(element.img).replaceWith(element.bg);
		});
		}, unmatch : function() {
		jQuery(parsed).each(function(index, element) {
			jQuery(element.bg).replaceWith(element.img);
		});
		}
	});
}
	



//  Mission Image _______________________________________
function mission__image() {
	var parsed = [], $img, $bg_tpl = jQuery('<div/>', {class: 'mission__image'}), $bg;
	jQuery('.mission__image').each(function(index, value) {
		$img = jQuery(value)
		$bg = $bg_tpl.clone().attr('style', 'background-image: url(' + $img.attr('src') + ')');
		parsed.push({img : $img, bg : $bg});
	});

	enquire.register("screen and (min-width:960px)", {
		// Triggered when a media query matches.
		match : function() {
		jQuery(parsed).each(function(index, element) {
			jQuery(element.img).replaceWith(element.bg);
		});
		}, unmatch : function() {
		jQuery(parsed).each(function(index, element) {
			jQuery(element.bg).replaceWith(element.img);
		});
		}
	});
}
	


//  Featured Listing Image _______________________________________
function featured_listing() {
	var parsed = [], $img, $bg_tpl = jQuery('<div/>', {class: 'featured_listing__img'}), $bg;
	jQuery('.featured_listing__img').each(function(index, value) {
		$img = jQuery(value)
		$bg = $bg_tpl.clone().attr('style', 'background-image: url(' + $img.attr('src') + ')');
		parsed.push({img : $img, bg : $bg});
	});

	enquire.register("screen and (min-width:960px)", {
		// Triggered when a media query matches.
		match : function() {
		jQuery(parsed).each(function(index, element) {
			jQuery(element.img).replaceWith(element.bg);
		});
		}, unmatch : function() {
		jQuery(parsed).each(function(index, element) {
			jQuery(element.bg).replaceWith(element.img);
		});
		}
	});
}



//  Sidebar Promo Image _______________________________________
function sidebar_promo() {
	var parsed = [], $img, $bg_tpl = jQuery('<div/>', {class: 'sidebar_promo__img'}), $bg;
	jQuery('.sidebar_promo__img').each(function(index, value) {
		$img = jQuery(value)
		$bg = $bg_tpl.clone().attr('style', 'background-image: url(' + $img.attr('src') + ')');
		parsed.push({img : $img, bg : $bg});
	});

	enquire.register("screen and (min-width:960px)", {
		// Triggered when a media query matches.
		match : function() {
		jQuery(parsed).each(function(index, element) {
			jQuery(element.img).replaceWith(element.bg);
		});
		}, unmatch : function() {
		jQuery(parsed).each(function(index, element) {
			jQuery(element.bg).replaceWith(element.img);
		});
		}
	});
}