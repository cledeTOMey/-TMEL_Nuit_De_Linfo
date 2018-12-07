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
 	<?php 
 	$getmotscles = DB::getInstance()->prepare("SELECT * FROM motscles");
 	$getmotscles->execute();

 	 ?>
 	<h1>Formulaire d'alimentation</h1>
 	<h2>Correspondances</h2>
 	<form method="post" action="add.php">
 		<label>Entrée libelle:</label>
 		<input type="text" name="libelle">
 		<label>Entrée poid:</label>
 		<input type="text" name="poid">
 		<label>Sortie Text :</label>
 		<input type="text" name="sortie">
 		<input type="submit" name="submit">
 	</form>

 	<h2>Synonymes</h2>
 	<form method="post" action="add.php">
 		<select>
 			<option name="">-</option>
 			<?php 
 			while($motscles = $getmotscles->fetch(PDO::FETCH_ASSOC))
 			{
 				$val = $motscles[1];
 				$key = $motscles[0];
 				var_dump($val);
 				echo "<option name='$key'>$val</option>";
 			}

 			 ?>
 		</select>
 	</form>

 </body>
 </html>