<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);
require_once("Connexion.php");
$result;
if(isset($_GET["action"])){
  if($_GET["action"] === "all"){
    $stmt = $pdo->prepare("SELECT * FROM Exercice e");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  else if($_GET["action"] === "delete" && isset($_GET["ide"])){
    $stmt = $pdo->prepare("DELETE FROM `Exercice`
                            WHERE IdExercice = :ide");
    $stmt->bindParam(':ide', $_GET["ide"], PDO::PARAM_INT);
    $stmt->execute();
  }
  else if($_GET["action"] === "add" && isset($_GET["titre"]) && isset($_GET["description"]) && isset($_GET["type"])){

    $stmt = $pdo->prepare("INSERT INTO Exercice(Titre, Description,Type) VALUES (:titre,:Description,:type)");
    $stmt->bindValue(':titre', $_GET["titre"], PDO::PARAM_INT);
    $stmt->bindValue(':Description', $_GET["description"], PDO::PARAM_INT);
    $stmt->bindValue(':type', $_GET["type"], PDO::PARAM_INT);
    $stmt->execute();

  }
  else if($_GET["action"] === "update" && isset($_GET["ide"]) && isset($_GET["titre"])  && isset($_GET["description"])){
    $stmt = $pdo->prepare("UPDATE `Exercice` SET `Titre`=:titre,`Description`=:description WHERE IdExercice = :ide");
    $stmt->bindParam(':ide', $_GET["ide"], PDO::PARAM_INT);
    $stmt->bindValue(':titre', $_GET["titre"], PDO::PARAM_INT);
    $stmt->bindValue(':description', $_GET["description"], PDO::PARAM_INT);
    $stmt->execute();
  }
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);

$pdo=null;

?>
