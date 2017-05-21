<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("Connexion.php");


if(isset($_GET["action"])){
  if($_GET["action"] === "all"){
    $stmt = $pdo->prepare("SELECT * FROM Seance");
    $stmt->execute();
    $result =  $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  if($_GET["action"] === "add" && isset($_GET["titre"]) && isset($_GET["objectif"])){
    $stmt = $pdo->prepare("INSERT INTO Seance(Titre, Objectif) VALUES (:titre,:objectif)");
    $stmt->bindValue(':titre', $_GET["titre"], PDO::PARAM_INT);
    $stmt->bindValue(':objectif', $_GET["objectif"], PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  if($_GET["action"] === "delete" && isset($_GET["ids"])){
    $stmt = $pdo->prepare("DELETE FROM `Seance`
                            WHERE IdSeance = :ids");
    $stmt->bindParam(':ids', $_GET["ids"], PDO::PARAM_INT);
    $stmt->execute();
  }
  if($_GET["action"] === "update" && isset($_GET["ids"]) && isset($_GET["titre"])  && isset($_GET["objectif"])){
    $stmt = $pdo->prepare("UPDATE `Seance` SET `Titre`=:titre,`Objectif`=:objectif WHERE IdSeance = :ids");
    $stmt->bindParam(':ids', $_GET["ids"], PDO::PARAM_INT);
    $stmt->bindValue(':titre', $_GET["titre"], PDO::PARAM_INT);
    $stmt->bindValue(':objectif', $_GET["objectif"], PDO::PARAM_INT);
    $stmt->execute();
  }
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);

$pdo=null;

?>
