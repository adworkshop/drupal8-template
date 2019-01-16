/* ======================================================= */
/*                        ADWORKSHOP MENU                  */
/* ======================================================= */

var mobileToggleClicked = false;

jQuery('.mobileBtnWrapper a.mainMenuToggle').click(function() {

    if(!mobileToggleClicked){
        jQuery("nav#mainMenu").slideDown(200, 'easeInSine');
        jQuery(this).addClass('active');
    }
    else{
        jQuery("nav#mainMenu").slideUp(200, 'easeOutSine');
        jQuery(this).removeClass('active');
    }
    mobileToggleClicked = !mobileToggleClicked;

});

jQuery('nav.menuContainer .openChild').on('click', openChildClick);

function openChildClick(event) {
  var $parent = jQuery(event.currentTarget).parent(),
      $targetUl = $parent.find('>ul');

  $targetUl.stop(true, true);
  if ($parent.hasClass('over')) {
    $parent.removeClass('over');
    $targetUl.slideUp(200);

    return;
  }

  $parent.siblings('li.over').each(function(index, element) {
    jQuery(element).find('> ul').slideUp(200);
    jQuery(element).removeClass('over');
  });

  $parent.addClass('over');
  $targetUl.slideDown(200);
}