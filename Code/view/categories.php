<?php 
	foreach ($data as $row) {
		?>
		<a href="index.php?cont=Picture&action=show&picID=1&category=<?php echo $row->categoryID?>"><?php echo $row->categoryName?></a>			
		<?php
	}
?>
