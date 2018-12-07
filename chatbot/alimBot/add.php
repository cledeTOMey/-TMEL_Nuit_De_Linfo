<?php
include_once("db.php");
$db =  DB::getInstance();
// var_dump($_POST);
// if(isset($_POST["action"]))
// {
	
if(isset($_POST["libelle"]) && isset($_POST["poid"]) && isset($_POST["sortie"]))
{
	$request = DB::getInstance()->prepare("INSERT INTO motscles(libelle_mot, poid_mot) values(:libelle, :poid)");
	$request->bindParam(':libelle', $_POST["libelle"]);
	$request->bindParam(':poid', $_POST["poid"]);
	$request->execute();
	$id = DB::getInstance()->prepare("SELECT idmot WHERE libelle_mot = :libelle");
	$id->bindParam(':libelle', $_POST["libelle"]);
	$id->execute();
	$request2 = DB::getInstance()->prepare("INSERT INTO reponses(idmot, text_reponse) values(:idmot, :sortie)");
	$request2->bindParam(':idmot', $_POST["idmot"]);
	$request2->bindParam(':sortie', $_POST["sortie"]);
	$request2->execute();
	// echo "string";
}
	
// }
header("Location: .");
die();
 ?>