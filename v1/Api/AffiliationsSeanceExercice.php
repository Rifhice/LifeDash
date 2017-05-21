<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("Connexion.php");
$result;
if(isset($_GET["action"])){
  if($_GET["action"] === "all"){
    $stmt = $pdo->prepare("SELECT DISTINCT a.IdSeance, a.IdExercice, e.Titre FROM AffiliationSeanceExercice a, Exercice e WHERE a.IdExercice = e.IdExercice");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  if($_GET["action"] === "delete"){
    $stmt = $pdo->prepare('DELETE FROM `AffiliationSeanceExercice`
                            WHERE IdSeance = :ids AND IdExercice = :ide');
    $stmt->bindParam(':ids', $_GET["ids"], PDO::PARAM_INT);
    $stmt->bindParam(':ide', $_GET["ide"], PDO::PARAM_STR, 12);
    $stmt->execute();
  }
  if($_GET["action"] === "add"){
    $stmt = $pdo->prepare('INSERT INTO `AffiliationSeanceExercice`(`IdSeance`, `IdExercice`) VALUES (:ids,:ide)');
    $stmt->bindParam(':ids', $_GET["ids"], PDO::PARAM_INT);
    $stmt->bindParam(':ide', $_GET["ide"], PDO::PARAM_STR, 12);
    $stmt->execute();
  }
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);

$pdo=null;

?>
