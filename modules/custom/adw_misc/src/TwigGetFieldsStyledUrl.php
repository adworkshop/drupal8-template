<?php
namespace Drupal\adw_misc;

use Drupal\image\Entity\ImageStyle;

/**
 * Class DefaultService.
 *
 * @package Drupal\adw_misc
 */
class TwigGetFieldsStyledUrl extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'get_fields_styled_url';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('get_fields_styled_url',
        array($this, 'get_fields_styled_url'),
        array('is_safe' => array('html'))
      )
     );
  }

  /**
   * The php function
   */
  public function get_fields_styled_url($input,$style) {
    if(is_object($input)){
        $uri = $input->entity->getFileUri();
        $url = ImageStyle::load($style)->buildUrl($uri);
        return $url;
    }
    elseif(is_array($input)){
        $uri = \Drupal\file\Entity\File::load($input['#item']->getValue()['target_id'])->getFileUri();
        $url = ImageStyle::load($style)->buildUrl($uri);
        return $url;
    }
    else{
        return '';
    }
  }

}