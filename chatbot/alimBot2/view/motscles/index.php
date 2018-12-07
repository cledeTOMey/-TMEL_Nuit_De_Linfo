

<h2>Liste des mots</h2>

<table>
<?php
var_dump($data);
foreach($data as $bot) 
{
	echo "<tr>";
	echo "<td><a href='?r=bot/view&id=".$bot->idmot."'>".$bot->libelle_mot."</a></td>";
	echo "<td>".$bot->poid_mot."</td>";

	// $brewery = new Brewery($beer->idbrewery);
	// echo "<td>".$brewery->name."</td>";


	echo "</tr>";

}
?>
</table>

<a href="?r=motscles/add"><h3>Ajouter Mot<h3></a>
<?php  

	//require("add.php");

?>