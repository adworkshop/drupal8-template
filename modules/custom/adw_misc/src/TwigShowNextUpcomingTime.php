<?php
namespace Drupal\adw_misc;

/**
 * Class DefaultService.
 *
 * @package Drupal\adw_misc
 */
class TwigShowNextUpcomingTime extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'show_next_upcoming_time';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('show_next_upcoming_time',
        array($this, 'show_next_upcoming_time'),
        array('is_safe' => array('html'))
      )
     );
  }

  /**
   * The php function
   */
  public function show_next_upcoming_time($variables) {

        $dates = array();
        for($i=0; $i<$variables['#items']->count(); $i++){
            if(isset($variables[$i]['start_date'])){
                $dates[$i] = array(
                    $variables[$i]['start_date']['#plain_text']
                );
            }
            if(isset($variables[$i]['end_date'])){
                $dates[$i][] = $variables[$i]['end_date']['#plain_text'];
            }
            // correct a misconception I had about what happens if start and end are exactly the same
            if(!isset($variables[$i]['start_date']) && !isset($variables[$i]['end_date'])){
                $dates[$i] = array(
                    $variables[$i]['#plain_text'],
                    $variables[$i]['#plain_text']
                );
            }
        }

        $nextUpcomingDateIndex = $this->get_next_upcoming_date($dates,TRUE);
        $nextUpcomingTimeMarkup = '';
        if(isset($dates[$nextUpcomingDateIndex][0]) && date('g:iA',$dates[$nextUpcomingDateIndex][0]) != '12:00AM'){
            $nextUpcomingTimeMarkup = date('g:iA',$dates[$nextUpcomingDateIndex][0]);
        }
        if(
            isset($dates[$nextUpcomingDateIndex][1])
            && date('g:iA',$dates[$nextUpcomingDateIndex][1]) != '12:00AM'
            && date('g:iA',$dates[$nextUpcomingDateIndex][1]) != '11:59PM'
            && $dates[$nextUpcomingDateIndex][0] != $dates[$nextUpcomingDateIndex][1]
        ){
            if($nextUpcomingTimeMarkup != ''){
                $nextUpcomingTimeMarkup .= ' - ';
            }
            $nextUpcomingTimeMarkup .= date('g:iA',$dates[$nextUpcomingDateIndex][1]);
        }

        if($nextUpcomingTimeMarkup != ''){
            return '<li>'.$nextUpcomingTimeMarkup.'</li>';
        }
        else{
            return '';
        }
  }

    // Returns next upcoming date in unix format
    // unless second argument is set to true in which case it returns the index of the next upcoming date
    public function get_next_upcoming_date($dates, $returnNextUpcomingDateIndex = FALSE){

        $now = time();
        $nonPastInstances = array();
        $firstStartDate = 0;
        $lastEndDate = 0;
        $currentlyHappeningDateRange = array();
        $firstNonPastStartDate = 0;
        // variables relating to returning the index of the next upcoming date
        $firstStartDateIndex = 0;
        $lastEndDateIndex = 0;
        $currentlyHappeningDateRangeIndex = 0;
        $firstNonPastStartDateIndex = 0;

        // First find the instances that haven't passed
        // and figure out the first start date and last end date
        // and find out if we're currently in the midst of a date range
        // and figure out first non-past start date
        foreach($dates as $thisDateIndex => $thisDateInstance){

            // Add to array of non-past instances
            if($thisDateInstance[1] > $now){
                $nonPastInstances[] = array(
                    'start' => $thisDateInstance[0],
                    'end'   => $thisDateInstance[1],
                );
            }

            // Update First Start Date
            if($thisDateInstance[0] < $firstStartDate || $firstStartDate == 0){
                $firstStartDate = $thisDateInstance[0];
                $firstStartDateIndex = $thisDateIndex;
            }

            // Update Last End Date
            if($thisDateInstance[1] > $lastEndDate){
                $lastEndDate = $thisDateInstance[1];
                $lastEndDateIndex = $thisDateIndex;
            }

            // Update Currently Happening Date Range
            if(
                $thisDateInstance[1] > $now
                && $thisDateInstance[0] < $now
            ){
                $currentlyHappeningDateRange = array(
                    'start' => $thisDateInstance[0],
                    'end'   => $thisDateInstance[1],
                );
                $currentlyHappeningDateRangeIndex = $thisDateIndex;
            }

            // Update First Non-Past Start Date
            if(
                $thisDateInstance[0] > $now
                && (
                    $firstNonPastStartDate > $thisDateInstance[0]
                    || $firstNonPastStartDate == 0
                )
            ){
                $firstNonPastStartDate = $thisDateInstance[0];
                $firstNonPastStartDateIndex = $thisDateIndex;
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
            $indexToUse = $lastEndDateIndex;
        }
        // If all instances are in the future use the first start date
        elseif($firstStartDate > $now){
            $dateToUse = $firstStartDate;
            $indexToUse = $firstStartDateIndex;
        }
        // If we are currently inside a date range use today's date
        elseif(isset($currentlyHappeningDateRange['start'])){
            $dateToUse = $now;
            $indexToUse = $currentlyHappeningDateRangeIndex;
        }
        // If none of the above cases are true then use the first non past start date
        else{
            $dateToUse = $firstNonPastStartDate;
            $indexToUse = $firstNonPastStartDateIndex;
        }

        if($returnNextUpcomingDateIndex){
            return $indexToUse;
        }else {
            return $dateToUse;
        }
    }

}