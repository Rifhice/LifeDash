<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("Connexion.php");
$result;
if(isset($_GET["action"])){
  if($_GET["action"] === "add" && isset($_GET["ide"]) && isset($_GET["temp"])){
    $stmt = $pdo->prepare("INSERT INTO PerformanceTemp(IdT, Temp,Jour) VALUES (:ide,:temp,:day)");
    $stmt->bindValue(':ide', $_GET["ide"], PDO::PARAM_INT);
    $stmt->bindValue(':temp', $_GET["temp"], PDO::PARAM_INT);
    $stmt->bindValue(':day', date('Y-m-d'), PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  }
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);

$pdo=null;

?>
