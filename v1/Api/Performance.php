<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("Connexion.php");
$result;
if(isset($_GET["action"])){
  if($_GET["action"] === "all"){
    $stmt = $pdo->prepare("SELECT * FROM Exercice e");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  if($_GET["action"] === "add" && isset($_GET["ide"])){

    $stmt = $pdo->prepare("INSERT INTO Performance(IdExercice) VALUES (:ide)");
    $stmt->bindValue(':ide', $_GET["ide"], PDO::PARAM_INT);
    $stmt->execute();

    $stmt = $pdo->prepare("SELECT `AUTO_INCREMENT`
                            FROM  INFORMATION_SCHEMA.TABLES
                            WHERE TABLE_SCHEMA = 'LifeDash'
                            AND   TABLE_NAME   = 'Performance'");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    $idPerf = $result[0]->AUTO_INCREMENT - 1;

    if(isset($_GET["type"]) && $_GET["type"] == "charge" && isset($_GET["serie"]) && isset($_GET["repetition"]) && isset($_GET["charge"])){
      $stmt = $pdo->prepare("INSERT INTO PerformanceCharge(IdPerformance, Series,Repetition,Charge,Jour) VALUES (:idperformance,:serie,:repetition,:charge,:day)");
      $stmt->bindValue(':idperformance', $idPerf, PDO::PARAM_INT);
      $stmt->bindValue(':serie', $_GET["serie"], PDO::PARAM_INT);
      $stmt->bindValue(':repetition', $_GET["repetition"], PDO::PARAM_INT);
      $stmt->bindValue(':charge', $_GET["charge"], PDO::PARAM_INT);
      $stmt->bindValue(':day', date('Y-m-d'), PDO::PARAM_INT);
      $stmt->execute();
    }
    else if(isset($_GET["type"]) && $_GET["type"] == "temps" && isset($_GET["temps"])){
      $stmt = $pdo->prepare("INSERT INTO PerformanceTemps(IdPerformance, Temps,Jour) VALUES (:idPerf,:temps,:day)");
      $stmt->bindValue(':idPerf', $idPerf, PDO::PARAM_INT);
      $stmt->bindValue(':temps', $_GET["temps"], PDO::PARAM_INT);
      $stmt->bindValue(':day', date('Y-m-d'), PDO::PARAM_INT);
      $stmt->execute();
    }

    if(isset($_GET["seance"])){
      $stmt = $pdo->prepare("INSERT INTO AffiliationPerformanceSeance(IdPerformance, IdSeance) VALUES (:idPerf,:idseance)");
      $stmt->bindValue(':idPerf', $idPerf, PDO::PARAM_INT);
      $stmt->bindValue(':idseance', $_GET["seance"], PDO::PARAM_INT);
      $stmt->execute();
    }

  }
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);

$pdo=null;

?>
