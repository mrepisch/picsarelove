<div id="content">
<?php
foreach ($data as $pic){
	?>
	<div id="post">
		<h3><?php echo $pic->title?></h3>
		<img src="<?php echo $pic->imagePath ?>"></img><br>
		<h4>Kommentare (*Nummer*)</h4><br>
		<div>
			<div >
				<h5>User1</h5>
				<p>Kommentar. Lorem Ipsum Dolorem</p>
			</div>
			<div >
				<h5>User2</h5>
				<p>Lorem Ipsum Dolorem. Kommentar</p>
			</div>
			<form action="index.php" method="post">
				<input type="hidden" name="cont" value="Comment"></input>
				<input type="hidden" name="action" value="createNew"></input>
				<input type="hidden" name="pictureid" value="1" ></input>
				<textarea rows="5" cols="30" placeholder="Hier dein Kommentar"></textarea>
				<input type="submit" value="senden">
			</form>
		</div>
	</div>
	<?php }?>



	
</div>