<?php

/**
 * @file
 * Contains \Drupal\improved_multi_select\Tests\ImprovedMultiSelectTests.
 */

namespace Drupal\improved_multi_select\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Improved Multi Select Tests.
 *
 * @group improved_multi_select
 */
class ImprovedMultiSelectTests extends WebTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
  public static $modules = array('improved_multi_select');


  /**
   * Test improved_multi_select_load_selectors() function.
   */
  protected function testIMSLoadSelectors() {
    $replace_all = FALSE;
    $selectors = [];
    $jquery_selectors = improved_multi_select_load_selectors($replace_all, $selectors);
    $this->assertIdentical($jquery_selectors, ['select[multiple]']);
    $replace_all = TRUE;
    $jquery_selectors = improved_multi_select_load_selectors($replace_all, $selectors);
    $this->assertIdentical($jquery_selectors, ['select[multiple]']);
    $selectors = ['test_selector'];
    $jquery_selectors = improved_multi_select_load_selectors($replace_all, $selectors);
    $this->assertIdentical($jquery_selectors, ['select[multiple]']);
    $replace_all = FALSE;
    $jquery_selectors = improved_multi_select_load_selectors($replace_all, $selectors);
    $this->assertIdentical($jquery_selectors, ['test_selector']);
  }

}
