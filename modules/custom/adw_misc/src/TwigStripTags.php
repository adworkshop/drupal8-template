<?php
namespace Drupal\adw_misc;


/**
 * Class DefaultService.
 *
 * @package Drupal\adw_misc
 */
class TwigStripTags extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'strip_tags';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('strip_tags',
        array($this, 'strip_tags'),
        array('is_safe' => array('html'))
      )
     );
  }

  /**
   * The php function to load a given block
   */
  public function strip_tags($input) {

    if(is_string($input)){
        return strip_tags($input);
    }
    elseif(is_object($input) && method_exists($input,'__toString')){
        return strip_tags($input->__toString());
    }
    else{
        return $input;
    }
  }

}