

<h2>Ajouter un mot</h2>

<form action='?r=motscles/add' method='post'>
	<p>
		<?php 
		$i = 0;
		foreach (Motscles::findAll() as $bot) 
		{
			$i++;
		}
		$i++;
		echo "<input name='idmot' value='".$i."' style='display: none;' />";
	 	?>
	</p>
	<p>
		<label>Mot entrée: </label>
		<input name='libelle_mot'/>
	</p>
	<p>
		<label>Poid mot entrée: </label>
		<input name='poid_mot'/>
	</p>
	<p>
		<label>Mot sortie: </label>
		<input name='text_reponse'/>
	</p>
	<p>
		<input type='submit' value='Ajouter'/>
	</p>
</form>

