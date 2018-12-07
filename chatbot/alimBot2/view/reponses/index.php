
<h2>Liste des brasseries</h2>

<table>
<?php
foreach($data as $brewery) 
{
	$country = new Country($brewery->country);
	echo "<tr>";
	echo "<td><a href='?r=brewery/view&id=".$brewery->idbrewery."'>".$brewery->name."</a></td>";
	echo "<td>".$country->name."</td>";
	echo "</tr>";
} 
?>
</table>

<a href="?r=brewery/add"><h3>Ajouter Brasserie<h3></a>