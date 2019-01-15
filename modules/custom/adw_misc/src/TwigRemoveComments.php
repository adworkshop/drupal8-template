<?php
namespace Drupal\adw_misc;


/**
 * Class DefaultService.
 *
 * @package Drupal\adw_misc
 */
class TwigRemoveComments extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'remove_comments';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('remove_comments',
        array($this, 'remove_comments'),
        array('is_safe' => array('html'))
      )
     );
  }

  /**
   * The php function to load a given block
   */
  public function remove_comments($input) {

    if(is_string($input)){
        return preg_replace('/<!--(.|\s)*?-->/', '',$input);
    }
    elseif(is_object($input) && method_exists($input,'__toString')){
        return preg_replace('/<!--(.|\s)*?-->/', '',$input->__toString());
    }
    else{
        return $input;
    }
  }

}