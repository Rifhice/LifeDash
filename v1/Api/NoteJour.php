<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);
require_once("Connexion.php");
$result;

$value = explode('/',$_SERVER['REQUEST_URI']);

if($_SERVER['REQUEST_METHOD'] === "GET"){ //GET SEANCES
    $stmt = $pdo->prepare("SELECT * FROM NoteJour ORDER BY 'Jour' DESC");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
}
else if($_SERVER['REQUEST_METHOD'] === "DELETE" && count($value) == 6){
  $stmt = $pdo->prepare("DELETE FROM `NoteJour`
                          WHERE Jour = :jour");
  $stmt->bindParam(':jour', urldecode($value[5]), PDO::PARAM_INT);
  $stmt->execute();
}
else if($_SERVER['REQUEST_METHOD'] === "POST" && count($value) == 8){
  $stmt = $pdo->prepare("INSERT INTO NoteJour(Jour,Note,Commentaires) VALUES (:jour,:note,:commentaires)");
  $stmt->bindParam(':jour', urldecode($value[5]), PDO::PARAM_INT);
  $stmt->bindParam(':note', urldecode($value[6]), PDO::PARAM_STR, 12);
  $stmt->bindParam(':commentaires', urldecode($value[7]), PDO::PARAM_STR, 12);
  $stmt->execute();
}
else if($_SERVER['REQUEST_METHOD'] === "PUT" && count($value) == 8){
  $stmt = $pdo->prepare("UPDATE `NoteJour` SET `Note`=:note,`Commentaires`=:commentaires WHERE `Jour` = :jour");
  $stmt->bindParam(':jour', urldecode($value[5]), PDO::PARAM_INT);
  $stmt->bindParam(':note', urldecode($value[6]), PDO::PARAM_STR, 12);
  $stmt->bindParam(':commentaires', urldecode($value[7]), PDO::PARAM_STR, 12);
  $stmt->execute();
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);

$pdo=null;

?>
