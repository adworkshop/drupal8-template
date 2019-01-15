<?php
namespace Drupal\adw_misc;

/**
 * Class DefaultService.
 *
 * @package Drupal\adw_misc
 */
class TwigGetFieldsStyledRenderArray extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'get_fields_styled_render_array';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('get_fields_styled_render_array',
        array($this, 'get_fields_styled_render_array'),
        array('is_safe' => array('html'))
      )
     );
  }

  /**
   * The php function
   */
  public function get_fields_styled_render_array($input,$style) {
    if(is_object($input)){
        $renderArray = $input->first()->view();
        $renderArray['#theme'] = 'image_style';
        $renderArray['#style_name'] = $style;
        $renderArray['#uri'] = $input->entity->getFileUri();
        return $renderArray;
    }
    else{
        return '';
    }
  }

}