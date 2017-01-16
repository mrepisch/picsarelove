<div id="content">
<?php
foreach ($data as $pic){
	?>
	<div id="post">
		<h3><?php echo $pic->title?></h3>
		<img src="<?php echo $pic->imagePath ?>"></img><br>
		<h4>Kommentare (*Nummer*)</h4><br>
		<div id="comments">
			<div id="comment_content">
			
			</div>
		
			<?php if($isLogdin == true ) {?>
			<form action="index.php" method="post">
				<input type="hidden" name="cont" value="Comment"></input>
				<input type="hidden" name="action" value="createNew"></input>
				<input type="hidden" name="pictureid" value="<?php echo $pic->picID ?>" ></input>
				<textarea rows="5" cols="30" placeholder="Hier dein Kommentar" name="text"></textarea>
				<input type="submit" value="senden">
			</form>
			<?php }?>
		</div>
	</div>
	<script type="text/javascript">
	$.post( "index.php",{"cont":"Comment", "action":"show_for_pic" , "picID":"<?php echo $pic->picID ?>"}, function( data ) {
		  $( "#comment_content" ).html( data );
		});
	</script>
	<?php }?>

	
</div>