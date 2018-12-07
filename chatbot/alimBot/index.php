<?php 
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
include_once("db.php");

?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Alim Bot</title>
 </head>
 <body>
 	<h1>Formulaire d'alimentation</h1>
 	<form method="post" action="add.php">
 		<label>Entrée libelle:</label>
 		<input type="text" name="libelle">
 		<label>Entrée poid:</label>
 		<input type="text" name="poid">
 		<label>Sortie Text :</label>
 		<input type="text" name="sortie">
 		<input type="submit" name="submit">
 	</form>
 </body>
 </html>