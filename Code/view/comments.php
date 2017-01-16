<div class="comment">
<?php 
	foreach( $data as $comment ){
		?>
		<div >
		<h5><?php echo $comment->userName?></h5>
		<p><?php echo $comment->text ?></p>
		</div>
	<?php 
	}
	?>
</div>

				
				
			