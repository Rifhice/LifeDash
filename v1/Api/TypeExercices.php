<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("Connexion.php");
$result;
if(isset($_GET["action"])){
  if($_GET["action"] === "all"){
    $stmt = $pdo->prepare("SELECT * FROM TypeExercice");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  }
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);

$pdo=null;

?>
