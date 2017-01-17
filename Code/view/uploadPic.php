<!-- Das Upload Formular um Bilder hochzuladen. 
	 Falls die Daten nicht valid sind wird dieses Formular mit den Fehlermeldungen angezeigt.
 -->
<div id="content">
	<div class="form">
	<h2>Bild Hochladen</h2>
	<form method="post" action="index.php" enctype="multipart/form-data" onsubmit="return validateUpload();">
		<input type="hidden" name="cont" value="Picture">
		<input type="hidden" name="action" value="upload">
		<label for="title">Titel: </label> <input type="text" name="title" id="pictitle"><br>
		<label for="picture">Bild: </label> <input type="file" name="picture" id="picture"><br>
		<label for="category">Kategorie: </label>
		<select name=category id="category">
			<option value="0" selected>Bitte Auswählen</option>
			<?php foreach ($rows as $row) : ?>
			<option value="<?php echo $row->categoryID?>"> <?php echo $row->categoryName?></option>
			<?php endforeach; ?>
		</select><br>
		<?php if(isset($_GET["noCat"])) : ?>
			<h4>Bitte füllen Sie alle Felder aus.</h4><br>
		<?php endif; ?> 
	   	<input type="submit" value="Hochladen" />
	</form>
	</div>
</div>
<script>
//Script um die Kategorien in das Select Objekt zu laden.
$.post( "index.php",{"cont":"Category", "action":"show_all"}, function( data ) {
	  $( "#cat_drop" ).html( data );
	});
</script>