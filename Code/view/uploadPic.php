
<div id="content">
	<form method="post" action="index.php" enctype="multipart/form-data">
		<input type="hidden" name="cont" value="Picture"></input>
		<input type="hidden" name="action" value="upload">
		<label for="title">Titel: </label> <input type="text" name="title"><br>
		<label for="picture">Bild hochladen: </label> <input type="file" name="picture" /><br>
		<label for="category">Kategorie: </label>
		<select name=category>
			<option value="0" selected>Bitte Ausw�hlen</option>
			<option value="1" selected>Lustig</option>
			<option value="2" selected>Cool</option>
		</select><br>
	   	<input type="submit" value="Hochladen" name="upload">
	</form>
</div>