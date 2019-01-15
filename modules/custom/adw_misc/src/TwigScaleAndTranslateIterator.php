<?php
namespace Drupal\adw_misc;

/**
 * Class DefaultService.
 *
 * @package Drupal\adw_misc
 */
class TwigScaleAndTranslateIterator extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'scale_and_translate_iterator';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('scale_and_translate_iterator',
        array($this, 'scale_and_translate_iterator'),
        array('is_safe' => array('html'))
      )
     );
  }

  /**
   * The php function to load a given block
   */
  public function scale_and_translate_iterator($iterator,$scale,$translate) {
    return ($iterator*$scale)+$translate;
  }

}