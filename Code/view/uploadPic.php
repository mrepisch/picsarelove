
<div id="content">
	<form method="post">
		<input type="hidden" name="cont" value="Picture"></input>
		<input type="hidden" name="action" value="upload">
		<label for="title">Titel: </label> <input type="text" name="title"><br>
		<label for="image">Bild hochladen: </label> <input type="file" name="image"><br>
		<label for="category">Kategorie: </label>
		<select name=category>
			<option value="0" selected>Bitte Ausw�hlen</option>
		<?php foreach($entities as $entity) : ?>
			
		<?php endforeach; ?>
		</select><br>
	   	<input type="submit" value="Hochladen" name="upload">
	</form>
</div>