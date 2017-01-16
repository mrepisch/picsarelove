<?php 
	foreach ($data as $row) {
		?>
		<a href="index.php?cont=Picture&action=show&category=<?php echo $row->categoryID?>"><?php echo $row->categoryName?></a>			
		<?php
	}
?>
