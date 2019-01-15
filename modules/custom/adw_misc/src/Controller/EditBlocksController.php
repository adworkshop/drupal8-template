<?php
namespace Drupal\adw_misc\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Example module.
 */
class EditBlocksController extends ControllerBase {

  /**
   * Returns a page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function editBlocksPage() {

    $query = \Drupal::entityQuery('block_content');
    $customBlockIds = $query->execute();

    $html = '';
    foreach($customBlockIds as $customBlockId){
        // Get a storage object.
        $block_storage = \Drupal::entityManager()->getStorage('block_content');
        // Load a single node.
        $block = $block_storage->load($customBlockId);
        $html .= '<a href="/block/'.$customBlockId.'">Edit '.$block->label().'</a><br/>';
    }


    $element = array(
      '#markup' => $html,
    );
    return $element;
  }

}

?>