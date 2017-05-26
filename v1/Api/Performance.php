<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("Connexion.php");
$result;

$value = explode('/',$_SERVER['REQUEST_URI']);


if($_SERVER['REQUEST_METHOD'] === "GET"){ //GET SEANCES
  $stmt = $pdo->prepare("SELECT * FROM PerformanceCharge ORDER BY Date(Jour) DESC");
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_OBJ);
  $result["charge"] = $data;
  $stmt = $pdo->prepare("SELECT * FROM PerformanceTemps ORDER BY Date(Jour) DESC");
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_OBJ);
  $result["temps"] = $data;
  $stmt = $pdo->prepare("SELECT * FROM Performance p,Exercice e WHERE e.IdExercice = p.IdExercice");
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_OBJ);
  $result["perf"] = $data;
}
else if($_SERVER['REQUEST_METHOD'] === "POST" && count($value) > 7){

  $stmt = $pdo->prepare("INSERT INTO Performance(IdExercice) VALUES (:ide)");
  $stmt->bindValue(':ide', urldecode($value[6]), PDO::PARAM_INT);
  $stmt->execute();

  $stmt = $pdo->prepare("SELECT `AUTO_INCREMENT`
                          FROM  INFORMATION_SCHEMA.TABLES
                          WHERE TABLE_SCHEMA = 'LifeDash'
                          AND   TABLE_NAME   = 'Performance'");
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  $idPerf = $result[0]->AUTO_INCREMENT - 1;

  if(urldecode($value[5]) === "charge"){
    $stmt = $pdo->prepare("INSERT INTO PerformanceCharge(IdPerformance, Series,Repetition,Charge,Jour) VALUES (:idperformance,:serie,:repetition,:charge,:day)");
    $stmt->bindValue(':idperformance', $idPerf, PDO::PARAM_INT);
    $stmt->bindValue(':serie', urldecode($value[7]), PDO::PARAM_INT);
    $stmt->bindValue(':repetition', urldecode($value[8]), PDO::PARAM_INT);
    $stmt->bindValue(':charge',urldecode($value[9]), PDO::PARAM_INT);
    $stmt->bindValue(':day', date('Y-m-d'), PDO::PARAM_INT);
    $stmt->execute();
  }
  else if(urldecode($value[5]) === "temps"){
    $stmt = $pdo->prepare("INSERT INTO PerformanceTemps(IdPerformance, Temps,Jour) VALUES (:idPerf,:temps,:day)");
    $stmt->bindValue(':idPerf', $idPerf, PDO::PARAM_INT);
    $stmt->bindValue(':temps', urldecode($value[7]), PDO::PARAM_INT);
    $stmt->bindValue(':day', date('Y-m-d'), PDO::PARAM_INT);
    $stmt->execute();
  }

  if(count($value) === 11 || count($value) === 9){
    $stmt = $pdo->prepare("INSERT INTO AffiliationPerformanceSeance(IdPerformance, IdSeance) VALUES (:idPerf,:idseance)");
    $stmt->bindValue(':idPerf', $idPerf, PDO::PARAM_INT);
    $stmt->bindValue(':idseance', urldecode($value[count($value)-1]), PDO::PARAM_INT);
    $stmt->execute();
  }

}

echo json_encode($result,JSON_UNESCAPED_UNICODE);

$pdo=null;

?>
