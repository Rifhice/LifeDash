<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("Connexion.php");
$result;
if(isset($_GET["action"])){
  if($_GET["action"] === "add" && isset($_GET["ide"]) && isset($_GET["serie"]) && isset($_GET["repetition"]) && isset($_GET["charge"])){
    $stmt = $pdo->prepare("INSERT INTO PerformanceCharge(IdC, Serie,Repetition,Charge,Jour) VALUES (:ide,:serie,:repetition,:charge,:day)");
    $stmt->bindValue(':ide', $_GET["ide"], PDO::PARAM_INT);
    $stmt->bindValue(':serie', $_GET["serie"], PDO::PARAM_INT);
    $stmt->bindValue(':repetition', $_GET["repetition"], PDO::PARAM_INT);
    $stmt->bindValue(':charge', $_GET["charge"], PDO::PARAM_INT);
    $stmt->bindValue(':day', date('Y-m-d'), PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  }
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);

$pdo=null;

?>
