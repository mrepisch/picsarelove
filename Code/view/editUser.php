<?php
?>

<div id="content">

	<div id="pictures">
	
		<table id="userConfigTable">
		<tr>
			<th>Bilder verwalten</th>
		</tr>
		<?php foreach ($data as $row) { ?>
			<tr>
				<td><img src="<?php echo $row->imagePath ?>" class="previewPic"></td>
				<td><?php echo $row->title ?></td>
				<td class="deleteCell"><a href="index.php?cont=Picture&action=delete&picID=<?php echo $row->picID ?>"><img class="deleteButton" src="pictures/delete.png" id="delete"></a></td>
			</tr>
		
						
		<?php } ?>
		</table>
	</div>
		<div id="change_pw">
		<h3>Passwort Ändern</h3><br>
		<form method="post">
			<input type="hidden" name="cont" value="User">
			<input type="hidden" name="action" value="changePW">
			<label for="oldpasswd">Altes Password:</label> <input type="password" name="oldpasswd" id="oldpasswd"><br>
		    <label for="passwd">Neues Password:</label> <input type="password" name="passwd" id="passwd"><br>
		    <label for="passwdrep">Password bestätigen:</label> <input type="password" name="passwdrep" id="passwdrep"><br>
	        <input type="submit" value="Passwort Ändern">
	    </form>
    </div>
</div>