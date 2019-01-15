<?php
namespace Drupal\adw_misc;

/**
 * Class DefaultService.
 *
 * @package Drupal\adw_misc
 */
class TwigGetNextUpcomingDate extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'get_next_upcoming_date';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('get_next_upcoming_date',
        array($this, 'get_next_upcoming_date'),
        array('is_safe' => array('html'))
      )
     );
  }

  /**
   * The php function to load a given block
   */
  public function get_next_upcoming_date($dateField) {

    $now = time();
    $nonPastInstances = array();
    $firstStartDate = 0;
    $lastEndDate = 0;
    $currentlyHappeningDateRange = array();
    $firstNonPastStartDate = 0;

    // First find the instances that haven't passed
    // and figure out the first start date and last end date
    // and find out if we're currently in the midst of a date range
    // and figure out first non-past start date
    for($i=0; $i<$dateField['#items']->count(); $i++){
        $thisDateInstance = $dateField[$i];

        // correct a misconception I had about what happens if start and end are exactly the same
        if(!isset($thisDateInstance['end_date']) && !isset($thisDateInstance['start_date'])){
            $thisDateInstance['start_date']['#plain_text'] = $thisDateInstance['#plain_text'];
            $thisDateInstance['end_date']['#plain_text'] = $thisDateInstance['#plain_text'];
        }

        // Add to array of non-past instances
        if(isset($thisDateInstance['end_date']['#plain_text']) && $thisDateInstance['end_date']['#plain_text'] > $now){
            $nonPastInstances[] = array(
                'start' => $thisDateInstance['start_date']['#plain_text'],
                'end'   => $thisDateInstance['end_date']['#plain_text'],
            );
        }

        // Update First Start Date
        if(isset($thisDateInstance['start_date']) && ($thisDateInstance['start_date']['#plain_text'] < $firstStartDate || $firstStartDate == 0)){
            $firstStartDate = $thisDateInstance['start_date']['#plain_text'];
        }

        // Update Last End Date
        if(isset($thisDateInstance['end_date']) && $thisDateInstance['end_date']['#plain_text'] > $lastEndDate){
            $lastEndDate = $thisDateInstance['end_date']['#plain_text'];
        }

        // Update Currently Happening Date Range
        if(
            isset($thisDateInstance['start_date'])
            && isset($thisDateInstance['end_date'])
            && $thisDateInstance['end_date']['#plain_text'] > $now
            && $thisDateInstance['start_date']['#plain_text'] < $now
        ){
            $currentlyHappeningDateRange = array(
                'start' => $thisDateInstance['start_date']['#plain_text'],
                'end'   => $thisDateInstance['end_date']['#plain_text'],
            );
        }

        // Update First Non-Past Start Date
        if(
            isset($thisDateInstance['start_date'])
            && $thisDateInstance['start_date']['#plain_text'] > $now
            && (
                $firstNonPastStartDate > $thisDateInstance['start_date']['#plain_text']
                || $firstNonPastStartDate == 0
            )
        ){
            $firstNonPastStartDate = $thisDateInstance['start_date']['#plain_text'];
        }

    }

    //--------------------------
    // Ok here's the date logic:
    //--------------------------
    // If all instances have passed use the last end date
    // If all instances are in the future use the first start date
    // If we are currently inside a date range use today's date
    // If none of the above cases are true then use the first non past start date

    // If all instances have passed use the last end date
    if($lastEndDate < $now){
        $dateToUse = $lastEndDate;
    }
    // If all instances are in the future use the first start date
    elseif($firstStartDate > $now){
        $dateToUse = $firstStartDate;
    }
    // If we are currently inside a date range use today's date
    elseif(isset($currentlyHappeningDateRange['start'])){
        $dateToUse = $now;
    }
    // If none of the above cases are true then use the first non past start date
    else{
        $dateToUse = $firstNonPastStartDate;
    }

    return $dateToUse;
  }

}