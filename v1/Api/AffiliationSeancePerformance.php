<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("Connexion.php");
$result;
if($_SERVER['REQUEST_METHOD'] === "GET"){ //GET SEANCES
    $stmt = $pdo->prepare("SELECT * FROM AffiliationPerformanceSeance");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);

$pdo=null;

?>
