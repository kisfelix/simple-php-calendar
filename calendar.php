<?php
//create standard calendar "grid" (Sunday to Saturday) for a month (default: current month)

//default for year and month - make your own changes to handle all boundary cases and exceptions
$target_year = date("Y");
$target_month = date("n");

$week_pos = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
$target_month_name = date("F", strtotime("$target_year-$target_month-1"));
$start_day = date("D", strtotime("$target_year-$target_month-1"));
$start_day_pos = array_search($start_day, $week_pos);
$calendar_data = array();
//empty spot filler if needed at start of calendar grid
if ($start_day_pos != 0)
{
  for ($i = 0; $i < $start_day_pos; $i ++) {
    $calendar_data[] = "&nbsp;";
  }
}
//determine month's ending day
if ($target_month == 4 || $target_month == 6 || $target_month == 9 || $target_month == 11) {
  $ending_day = 30;
}
elseif ($target_month == 2) 
{
  if (($target_year % 100) == 0)
  {
    if (($target_year % 400) == 0) {
      $ending_day = 29;
    }
    else {
      $ending_day = 28;
    }
  }
  elseif (($target_year % 4) == 0) {
    $ending_day = 29;
  }
  else {
    $ending_day = 28;
  }
}
else {
  $ending_day = 31;
}
//fill calendar grid up to "ending day"
for ($j = 1; $j <= $ending_day; $j ++) {
  $calendar_data[] = $j;
}
$end_day = date("D", strtotime("$target_year-$target_month-$ending_day"));
$end_day_pos = array_search($end_day, $week_pos);
//empty spot filler if needed at end of calendar grid
if ($end_day_pos != 6)
{
  for ($k = $end_day_pos; $k < 6; $k ++) {
    $calendar_data[] = "&nbsp;";
  }
}
//for building nav buttons for next / previous months
$next_month = $target_month + 1;
if ($next_month == 13)
{
  $next_month = 1;
  $next_year = $target_year + 1;
}
else {
  $next_year = $target_year;
}
$prev_month = $target_month - 1;
if ($prev_month == 0)
{
  $prev_month = 12;
  $prev_year = $target_year - 1;
}
else {
  $prev_year = $target_year;
}

//final results
//$calendar_data has all the dates with proper starting point for "day 1"
?>
