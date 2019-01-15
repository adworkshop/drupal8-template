<?php

namespace Drupal\metatag_fine_grained_perms;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\metatag\MetatagGroupPluginManager;
use Drupal\metatag\MetatagTagPluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides dynamic permissions for the Metatag module.
 *
 * @see metatag_fine_grained_perms.permissions.yml
 */
class MetatagPermissions implements ContainerInjectionInterface {

  use StringTranslationTrait;

  /**
   * The Metatag Tag Plugin Manager.
   *
   * @var \Drupal\metatag\MetatagTagPluginManager
   */
  protected $tagManager;

  /**
   * The Metatag Group Plugin Manager.
   *
   * @var \Drupal\metatag\MetatagGroupPluginManager
   */
  protected $groupManager;

  /**
   * Constructs a MetatagPermissions instance.
   *
   * @param \Drupal\metatag\MetatagTagPluginManager $tag_manager
   * @param \Drupal\metatag\MetatagGroupPluginManager $group_manager
   */
  public function __construct(MetatagTagPluginManager $tag_manager, MetatagGroupPluginManager $group_manager) {
    $this->tagManager = $tag_manager;
    $this->groupManager = $group_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.metatag.tag'),
      $container->get('plugin.manager.metatag.group')
    );
  }

  /**
   * Get metatag tag permissions.
   *
   * @return array
   *   Permissions array.
   */
  public function permissions() {
    $permissions = [];

    // Build permissions for each tag in each group.
    foreach ($this->tagManager->getDefinitions() as $metatag) {
      $group = $this->groupManager->getDefinition($metatag['group']);

      $permissions += [
        'access metatag tag ' . $metatag['group'] . '__' . $metatag['name'] => [
          'title' => $this->t('Access %tag in %group', [
            '%tag' => $metatag['label'],
            '%group' => $group['label'],
          ]),
        ],
      ];
    }

    return $permissions;
  }

}
