<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);
require_once("Connexion.php");
$result;

$value = explode('/',$_SERVER['REQUEST_URI']);

if($_SERVER['REQUEST_METHOD'] === "GET"){ //GET SEANCES
  $stmt = $pdo->prepare("SELECT * FROM Exercice e");
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_OBJ);
}
else if($_SERVER['REQUEST_METHOD'] === "DELETE" && count($value) === 6){
  $stmt = $pdo->prepare("DELETE FROM `Exercice`
                          WHERE IdExercice = :ide");
  $stmt->bindParam(':ide', $value[5], PDO::PARAM_INT);
  $stmt->execute();
}
else if($_SERVER['REQUEST_METHOD'] === "POST"  && count($value) === 8){

  $stmt = $pdo->prepare("INSERT INTO Exercice(Titre, Description,Type) VALUES (:titre,:Description,:type)");
  $stmt->bindValue(':titre', urldecode($value[5]), PDO::PARAM_INT);
  $stmt->bindValue(':Description', urldecode($value[6]), PDO::PARAM_INT);
  $stmt->bindValue(':type', urldecode($value[7]), PDO::PARAM_INT);
  $stmt->execute();

}
else if($_SERVER['REQUEST_METHOD'] === "PUT" && count($value) === 8){
  $stmt = $pdo->prepare("UPDATE `Exercice` SET `Titre`=:titre,`Description`=:description WHERE IdExercice = :ide");
  $stmt->bindParam(':ide', $value[5], PDO::PARAM_INT);
  $stmt->bindValue(':titre', urldecode($value[6]), PDO::PARAM_INT);
  $stmt->bindValue(':description', urldecode($value[7]), PDO::PARAM_INT);
  $stmt->execute();
}


echo json_encode($result,JSON_UNESCAPED_UNICODE);

$pdo=null;

?>
