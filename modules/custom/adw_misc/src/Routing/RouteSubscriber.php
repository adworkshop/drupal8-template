<?php
namespace Drupal\adw_misc\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;


/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  public function alterRoutes(RouteCollection $collection) {

  //kint($collection);
  /*if($collection->get('view.contact_messages.page_1') != ''){
    // view (had to change permission for actual view, not sure if this is also necessarry)
    $collection->get('view.contact_messages.page_1')->setRequirements(
      array(
        '_permission'=>'view contact form submissions',
        '_method'=>'GET|POST'
      )
    );
  }

  if($collection->get('entity.contact_message.canonical') != ''){
    // individual
    $collection->get('entity.contact_message.canonical')->setRequirements(
      array(
        '_permission'=>'view contact form submissions',
        '_method'=>'GET|POST'
      )
    );
    kint($collection->get('entity.contact_message.canonical'));
  }


    // change cache flush to clear cache
    if($collection->get('cacheflush.presets') != ''){
        $collection->get('cacheflush.presets')->setDefault('_title', 'Clear Cache');
    }

    // change permissions for main "configuration" page/menu-item
    if($collection->get('system.admin_config') != ''){
        $collection->get('system.admin_config')->setRequirements(
            array(
                '_permission'=>'view main config page',
                '_method'=>'GET|POST'
            )
        );
    }

    // change permission for contact form editing
    if($collection->get('entity.contact_form.collection') != ''){
        $collection->get('entity.contact_form.collection')->setRequirements(
            array(
                '_permission'=>'edit contact forms',
                '_method'=>'GET|POST'
            )
        );
    }

    // change permission for contact email edit page
    if($collection->get('contact_storage.settings') != ''){
        $collection->get('contact_storage.settings')->setRequirements(
            array(
                '_permission'=>'edit contact forms',
                '_method'=>'GET|POST'
            )
        );
    }
*/
  }

}

?>