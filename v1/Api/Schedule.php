<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require_once('SG-iCalendar/SG_iCal.php');

  $ical = new SG_iCalReader( "https://planning-ade.umontpellier.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=63,64,233,546,547,548,921,1120,1346,234,433,545,750,1143,1176&projectId=45&calType=ical&nbWeeks=4" );

  $events = array();
  $i = 0;
  foreach( $ical->getEvents() As $event ) {
    $events[$i] = $event;
    $i = $i + 1;
  }

  function cmp($a, $b){
    return $a->getStart() > $b->getStart();
  }
  usort($events, "cmp");

  $data = array();

  $currentDate = date('d/m/Y');
  for ($i=0; $i < 5; $i++) {
    $data[date("d/m/Y", strtotime("+".$i." day"))] = array("date" => date("d/m/Y", strtotime("+".$i." day")));
  }

  foreach($events As $event){
    $tmp = array();
    $tmp["start"] = date("H:i",$event->getStart() + 7200);
    $tmp["end"] = date("H:i",$event->getEnd() + 7200);
    $tmp["summary"] = $event->getProperty('summary');
    $tmp["description"] = substr($event->getProperty('description'),0,strlen($event->getProperty('description')) - 30);
    $tmp["location"] = $event->getProperty('location');

    if(!isset($data[date("d/m/Y",$event->getStart() + 7200)]) || !is_array($data[date("d/m/Y",$event->getStart() + 7200)]))
      break;
    array_push($data[date("d/m/Y",$event->getStart() + 7200)], $tmp);
  }


  echo json_encode($data,JSON_UNESCAPED_UNICODE);

?>
