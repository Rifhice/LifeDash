<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $source = "google-news";
  $key = "e9c74b0146a64283a1e9c2713ee502fb";
  $url = "https://newsapi.org/v1/articles?source=".$source."&sortBy=top&apiKey=".$key."";
  $json = file_get_contents($url);
  $data = json_decode($json,true);

  echo json_encode(array_splice($data["articles"],0,6),JSON_UNESCAPED_UNICODE);

  ?>
