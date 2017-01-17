<!-- Der Haupinhalt der Seite. Hier werden die Bilder Pfeile und Kommentare dargestellt -->
<div id="content">
<?php
	?>

		<div id="arrows">
			<a href="index.php?cont=Picture&action=show&picID=<?php echo $last->picID ?>&category=<?php echo $categoryID?> "><img src="pictures/arrow_left.png" /></a>
			<a href="index.php?cont=Picture&action=show&picID=<?php echo $next->picID ?>&category=<?php echo $categoryID?>  "><img src="pictures/arrow_right.png" /></a>
		</div>
		<div id="post">
			<h3><?php echo $data->title ?></h3>
			<img src="<?php echo $data->imagePath ?>"></img><br>
			<div id="comments">
				<div id="comment_content">
			
				</div>
		
			<?php if($isLogdin == true ) {?>
			<form action="index.php" method="post" onsubmit="return validateComment();">
					<input type="hidden" name="cont" value="Comment" />
					<input type="hidden" name="action" value="createNew">
					<input type="hidden" name="cont" value="Comment"></input>
					<input type="hidden" name="action" value="createNew"></input>
					<input type="hidden" name="picID" value="<?php echo $data->picID ?>" ></input>
					<textarea rows="5" cols="30" placeholder="Hier dein Kommentar" name="text"></textarea>
					<input type="submit" value="Senden" />
				</form>
				<?php }?>
			</div>
		</div>
	<script type="text/javascript">
	var dataID = <?php echo $data->picID ?>;
	$.post( "index.php",{"cont":"Comment", "action":"show_for_pic" , "picID":dataID}, function( data ) {
		  $( "#comment_content" ).html( data );
		});
	</script>

	
</div>