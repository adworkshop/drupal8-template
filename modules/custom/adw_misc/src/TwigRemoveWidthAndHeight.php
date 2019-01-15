<?php
namespace Drupal\adw_misc;

/**
 * Class DefaultService.
 *
 * @package Drupal\adw_misc
 */
class TwigRemoveWidthAndHeight extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'remove_width_and_height';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('remove_width_and_height',
        array($this, 'remove_width_and_height'),
        array('is_safe' => array('html'))
      )
     );
  }

  /**
   * The php function to load a given block
   */
  public function remove_width_and_height($input) {
    //$input['#object'] is of type paragraph
    $imgFieldValue = $input['#items']->first()->getValue();
    unset($imgFieldValue['width']);
    unset($imgFieldValue['height']);
    $input['#items']->first()->setValue($imgFieldValue);
    return $input;
  }

}