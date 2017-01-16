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
		<form method="post">
			<input type="hidden" name="cont" value="User"></input>
			<input type="hidden" name="action" value="reset">
		    <label for="passwd">Password:</label> <input type="password" name="passwd"><br>
		    <label for="passwdrep">Password wiederholen:</label> <input type="password" name="passwdrep"><br>
	        <input type="submit" value="Passwort Ändern" name="register">
	    </form>
    </div>
</div>