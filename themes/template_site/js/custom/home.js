//---------------
// Bottom Slider
//---------------
enquire.register("screen and (max-width: 600px)", function() {
    jQuery('.slide__img').each(function(){
        jQuery(this).attr('src',jQuery(this).attr('data-small-src'));
    });
});

enquire.register("screen and (min-width: 601px) and (max-width: 960px)", function() {
    jQuery('.slide__img').each(function(){
        jQuery(this).attr('src',jQuery(this).attr('data-small-src'));
    });
});

enquire.register("screen and (min-width: 961px)", function() {
    jQuery('.slide__img').each(function(){
        jQuery(this).attr('src',jQuery(this).attr('data-medium-src'));
    });
});


//---------------------------------------
// Middle Block Slider Background Images
//---------------------------------------
jQuery('.slider .panel').each(function(){
        jQuery(this).css('background-image','url("'+jQuery(this).attr('data-background-src')+'")');
});


//----------------------------
// Top Block Background Image
//----------------------------
jQuery(document).ready(function(){
    //jQuery('.mission__image').css('background-image','url("'+jQuery('.mission__image').attr('data-bg-med')+'")');
});


//-----------------------
// Splash Image Swapping
//-----------------------
enquire.register("screen and (max-width: 600px)", function() {
    jQuery('.splash').css('background-image','url("'+jQuery('.splash').attr('data-bg-small')+'")');
});

enquire.register("screen and (min-width: 601px) and (max-width: 960px)", function() {
    jQuery('.splash').css('background-image','url("'+jQuery('.splash').attr('data-bg-med')+'")');
});

enquire.register("screen and (min-width: 961px)", function() {
    jQuery('.splash').css('background-image','url("'+jQuery('.splash').attr('data-bg-large')+'")');
});


//-------------------------------------------------------
// Match Height and UnMatch Height depending on the size
//-------------------------------------------------------
enquire.register("screen and (min-width: 1100px)", {
    match : function() {
        jQuery(".mission__panel").matchHeight({byRow: false, property: 'height',});
    },
    unmatch : function(){
        jQuery(".mission__panel").matchHeight({remove: true});
    }
});