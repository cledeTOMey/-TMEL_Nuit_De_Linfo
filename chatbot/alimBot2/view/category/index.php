
<h2>Liste des catégories de jeux</h2>

<table>
<?php
foreach($data as $categ) {
	echo "<tr>";
	echo "<td>".$categ->name."</td>";
	echo "<td>".($categ->online?"Online":"Offline")."</td>";
	echo "</tr>";
}
?>
</table>
