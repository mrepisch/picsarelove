<?php
?>

<div id="content">
	<div id="pictures">
		<ul  class="previewItem">
		<?php foreach ($data as $row) { ?>
			<li>
				<span><img src="<?php echo $row->imagePath ?>" class="previewPic"><p><?php echo $row->title ?></p></span>
				<span><a href="index.php?cont=Picture&action=delete&picID=<?php echo $row->picID ?>"><img src="pictures/delete.png" id="delete"></a></span>
			</li>			
		<?php } ?>
		</ul>
	</div>
	<div id="register">
		<form method="post" onsubmit="return validateChangePW();">
			<input type="hidden" name="cont" value="User">
			<input type="hidden" name="action" value="changePW">
			<label for="oldpasswd">Altes Password:</label> <input type="password" name="oldpasswd" id="oldpasswd"><br>
		    <label for="passwd">Neues Password:</label> <input type="password" name="passwd" id="passwd"><br>
		    <label for="passwdrep">Password bestätigen:</label> <input type="password" name="passwdrep" id="passwdrep"><br>
	        <input type="submit" value="Passwort Ändern" />
	    </form>
    </div>
</div>