
<h2>Liste des jeux</h2>

<table>
<?php
foreach($data as $game) {
	echo "<tr>";
	echo "<td>".$game->name."</td>";
	echo "<td>";
	foreach($game->categories as $category) {
		echo "<a href='?r=category/view&id=".$category->idcategory."'>";
		echo $category->name;
		echo "</a> ";
	}
	echo "</td>";
	echo "</tr>";
}
?>
</table>
