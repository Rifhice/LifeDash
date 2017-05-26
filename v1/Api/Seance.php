<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("Connexion.php");

$value = explode('/',$_SERVER['REQUEST_URI']);

if($_SERVER['REQUEST_METHOD'] === "GET"){ //GET SEANCES
  $stmt = $pdo->prepare("SELECT * FROM Seance");
  $stmt->execute();
  $result =  $stmt->fetchAll(PDO::FETCH_OBJ);
}
else if($_SERVER['REQUEST_METHOD'] === "POST" && count($value) === 7){
  $stmt = $pdo->prepare("INSERT INTO Seance(Titre, Objectif) VALUES (:titre,:objectif)");
  $stmt->bindValue(':titre',  urldecode($value[5]), PDO::PARAM_INT);
  $stmt->bindValue(':objectif',  urldecode($value[6]), PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_OBJ);
}
else if($_SERVER['REQUEST_METHOD'] === "DELETE" && count($value) === 6){
  $stmt = $pdo->prepare("DELETE FROM `Seance`
                          WHERE IdSeance = :ids");
  $stmt->bindParam(':ids',  urldecode($value[5]), PDO::PARAM_INT);
  $stmt->execute();
}
else if($_SERVER['REQUEST_METHOD'] === "PUT"  && count($value) === 8){
  $stmt = $pdo->prepare("UPDATE `Seance` SET `Titre`=:titre,`Objectif`=:objectif WHERE IdSeance = :ids");
  $stmt->bindParam(':ids', $value[5], PDO::PARAM_INT);
  $stmt->bindValue(':titre',  urldecode($value[6]), PDO::PARAM_INT);
  $stmt->bindValue(':objectif',  urldecode($value[7]), PDO::PARAM_INT);
  $stmt->execute();
}


echo json_encode($result,JSON_UNESCAPED_UNICODE);

$pdo=null;

?>
