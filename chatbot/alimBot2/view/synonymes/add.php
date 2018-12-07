

<h2>Ajouter une bière</h2>

<form action='?r=beer/add' method='post'>
	<p>
		<?php 
		$i = 0;
		foreach (Beer::findAll() as $beer) {
			$i++;
		}
		$i++;
		echo "<input name='idbeer' value='".$i."' style='display: none;' />";
	 	?>
	</p>
	<p>
		<label>Nom : </label>
		<input name='name'/>
	</p>
	<p>
		<label>Degrés : </label>
		<input name='degree'/>
	</p>
	<p>
		<label>Brasserie : </label>
		<select name='brewery'>
		<?php
		foreach(Brewery::findAll() as $brewery) {
			echo "<option value=".$brewery->idbrewery.">";
			echo $brewery->name;
			echo "</option>";
		}
		?>
		</select>
	</p>
	
	<p>
		<input type='submit' value='Ajouter'/>
	</p>
</form>

