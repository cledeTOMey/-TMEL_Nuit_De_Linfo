

<h2>Liste des synonymes</h2>

<table>
<?php

foreach($data as $synonymes) {
	echo "<tr>";
	echo "<td><a href='?r=beer/view&id=".$synonymes->idbeer."'>".$synonymes->name."</a></td>";
	echo "<td>".$synonymes->degree."</td>";
	
	echo "<td>".$synonymes->motcles->libelle_mot."</td>";

	// $brewery = new Brewery($beer->idbrewery);
	// echo "<td>".$brewery->name."</td>";


	echo "</tr>";

}
?>
</table>

<a href="?r=beer/add"><h3>Ajouter Bière<h3></a>
<?php  

	//require("add.php");

?>