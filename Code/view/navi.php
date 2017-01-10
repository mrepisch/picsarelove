<?php
?>

<div id="navigation">
	<ul>
		<?php if( $isLogdin == false) {?>
		<li><a href="index.php?cont=Login&action=register_form">Register</a></li> <?php } else{?>
		
		<li><a href="index.php?cont=Picture&action=displayForm">Bild hochladen</a></li><?php }?>
		<li><a href="index.php?cont=Picture&action=show_all&page=1">Alle anzeigen</a></li>
		<li><a href="">Zufälliges Bild</a></li>
		<li class="dropdown">
		<a href="#" class="dropbtn">Kategorie</a>
			<div class="dropdown-content">
				<a href="index.php?function=kategorisiertAnzeigen">Lustig</a>
				<a href="index.php?function=kategorisiertAnzeigen">Tiere</a>
				<a href="index.php?function=kategorisiertAnzeigen">Games</a>
			</div>
		</li>
	</ul>
</div>