<?php 
	foreach ($data as $row) {
		?>
		<a href="index.php?cont=Picture&action=show_category"><?php echo $row->categoryName?></a>			
		<?php
	}
?>
