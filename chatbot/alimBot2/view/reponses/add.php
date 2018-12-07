

<h2>Ajouter une brasserie</h2>

<form action='?r=brewery/add' method='post'>
	<p>
		<label>Nom : </label>
		<input name='name'/>
	</p>
	<p>
		<label>Pays : </label>
		<select name='country'>
		<?php
		foreach(Country::findAll() as $country) {
			echo "<option value=".$country->idcountry.">";
			echo $country->name;
			echo "</option>";
		}
		?>
		</select>
	</p>
	<p>
		<input type='submit' value='Ajouter'/>
	</p>
</form>

