<?php
  setlocale(LC_TIME, 'fra', 'fr_FR');
  date_default_timezone_set('CEST');

  $city = "Montpellier";
  $country = "FR";
  $url = "http://api.openweathermap.org/data/2.5/forecast?APPID=436f5782f38fb3d2ad1df6423b3fcdce&q=".$city.",".$country."&units=metric&lang=fr";
  $json = file_get_contents($url);
  $data = json_decode($json,true);

  $day = array();

  $day[0]["day"] = date("D j F",strtotime(substr($data["list"][0]["dt_txt"],0,10)));
  $day[0]["temp"] = $data["list"][0]["main"]["temp"];
  $day[0]["descr"] = $data["list"][0]["weather"][0]["description"];
  $day[0]["icon"]  = "http://openweathermap.org/img/w/".$data["list"][0]["weather"][0]["icon"].".png";

  $currentDay = $data["list"][0]["dt_txt"];
  $i = 0;
  while(substr_compare($currentDay,$data["list"][$i]["dt_txt"],0,10,false) == 0){
    $i++;
  }

  $currentDay = $data["list"][$i]["dt_txt"];
  $currentMax = -50;
  $currentMin = 50;
  $index = 1;
    for($i;$i <= count($data["list"]) ;$i++) {
        if(substr_compare($currentDay,$data["list"][$i]["dt_txt"],0,10,false) == 0){
          if($currentMax < $data["list"][$i]["main"]["temp_max"]){
            $currentMax = $data["list"][$i]["main"]["temp_max"];
          }
          if($currentMin > $data["list"][$i]["main"]["temp_min"]){
            $currentMin = $data["list"][$i]["main"]["temp_min"];
          }
        }
        else{
          $day[$index]["day"] = substr($currentDay,0,10);
          $day[$index]["temp_max"] = $currentMax;
          $day[$index]["temp_min"] = $currentMin;
          $currentDay = $data["list"][$i]["dt_txt"];
          $currentMax = -50;
          $currentMin = 50;
          $index = $index + 1;
        }

  }

  echo json_encode($day,JSON_UNESCAPED_UNICODE);
?>
