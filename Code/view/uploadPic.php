<?php
?>

<div id="content">
	<form method="post">
		<label for="title">Titel: </label> <input type="text" name="title"><br>
		<label for="image">Bild hochladen: </label> <input type="file" name="image"><br>
		<label for="category">Kategorie: </label>
		<select name=category>
			<option value="0" selected>(please select:)</option>
			<option value="1">Lustig</option>
			<option value="2">Cool</option>
			<option value="3">three</option>
			<option value="other">other, please specify:</option>
		</select><br>
   	<input type="submit" value="Create" name="create">
</form>