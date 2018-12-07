

<h2>Liste des bières</h2>

<table>
<?php

foreach($data as $beer) {
	echo "<tr>";
	echo "<td><a href='?r=beer/view&id=".$beer->idbeer."'>".$beer->name."</a></td>";
	echo "<td>".$beer->degree."°</td>";
	
	echo "<td>".$beer->brewery->name."</td>";

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