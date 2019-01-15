<?php

namespace Drupal\menu_admin_per_menu\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;
use Drupal\menu_admin_per_menu\Access\MenuAdminPerMenuAccess;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller routines for menu overview route.
 */
class MenuAdminPerMenuController extends ControllerBase {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $currentUser;

  /**
   * The allowed menus provider.
   *
   * @var \Drupal\menu_admin_per_menu\Access\MenuAdminPerMenuAccess
   */
  protected $allowedMenusService;

  /**
   * Constructs a new MenuAdminPerMenu instance.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\Core\Session\AccountInterface $current_user
   *   The current user.
   * @param \Drupal\menu_admin_per_menu\Access\MenuAdminPerMenuAccess $allowed_menus
   *   The check provider.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, AccountInterface $current_user, MenuAdminPerMenuAccess $allowed_menus) {
    $this->entityTypeManager = $entity_type_manager;
    $this->currentUser = $current_user;
    $this->allowedMenusService = $allowed_menus;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('current_user'),
      $container->get('menu_admin_per_menu.allowed_menus')
    );
  }

  /**
   * Constructs menus overview page.
   */
  public function menuOverviewPage() {
    $account = $this->currentUser;
    $menu_table = $this->entityTypeManager->getListBuilder('menu')->render();
    if ($account->hasPermission('administer menu')) {
      return $menu_table;
    }
    $allowed_menus = $this->allowedMenusService->getPerMenuPermissions($account);
    foreach ($menu_table['table']['#rows'] as $menu_key => $menu_item) {
      if (!isset($allowed_menus["administer $menu_key menu items"])) {
        unset($menu_table['table']['#rows'][$menu_key]);
      }
      else {
        $menu_row = &$menu_table['table']['#rows'][$menu_key];
        $menu_operations = &$menu_row['operations']['data']['#links'];
        $menu_operations['list']['title'] = $this->t('List links');
        $menu_operations['list']['url'] = Url::fromRoute('entity.menu.edit_form', array('menu' => $menu_key));
        $menu_operations['add']['title'] = $this->t('Add link');
        $menu_operations['add']['url'] = Url::fromRoute('entity.menu.add_link_form', array('menu' => $menu_key));
      }
    }
    return $menu_table;
  }

}
