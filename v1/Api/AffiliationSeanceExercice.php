<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("Connexion.php");
$result;

$value = explode('/',$_SERVER['REQUEST_URI']);

if($_SERVER['REQUEST_METHOD'] === "GET"){ //GET SEANCES
  $stmt = $pdo->prepare("SELECT DISTINCT a.IdSeance, a.IdExercice, e.Titre FROM AffiliationSeanceExercice a, Exercice e WHERE a.IdExercice = e.IdExercice");
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_OBJ);
}

else if($_SERVER['REQUEST_METHOD'] === "DELETE" && count($value) == 7){
  $stmt = $pdo->prepare('DELETE FROM `AffiliationSeanceExercice`
                          WHERE IdSeance = :ids AND IdExercice = :ide');
  $stmt->bindParam(':ids', urldecode($value[5]), PDO::PARAM_INT);
  $stmt->bindParam(':ide', urldecode($value[6]), PDO::PARAM_STR, 12);
  $stmt->execute();
}
else if($_SERVER['REQUEST_METHOD'] === "POST" && count($value) == 7){
  $stmt = $pdo->prepare('INSERT INTO `AffiliationSeanceExercice`(`IdSeance`, `IdExercice`) VALUES (:ids,:ide)');
  $stmt->bindParam(':ids', urldecode($value[5]), PDO::PARAM_INT);
  $stmt->bindParam(':ide', urldecode($value[6]), PDO::PARAM_STR, 12);
  $stmt->execute();
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);

$pdo=null;

?>
