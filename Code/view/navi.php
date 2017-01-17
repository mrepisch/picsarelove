<!-- Der View für die Navigation. 
	 Es müssen andere Punkte dargestellt werden je nach dem ob der Benutzer eingelogt ist oder nicht 
-->
<?php
?>

<div id="navigation_area">
	<ul id="navigation">
		<?php if( $isLogdin == false) {?>
		<li class="first_navi"><a href="index.php?cont=Login&action=register_form">Registrieren</a></li> <?php } else{?>
		
		<li class="first_navi"><a href="index.php?cont=User&action=showOptions">User Verwaltung</a></li>
		<li><a href="index.php?cont=Picture&action=displayForm">Bild hochladen</a></li><?php }?>
		<li><a href="index.php?cont=Picture&action=show">Alle anzeigen</a></li>
		<li class="last_navi"><a href="index.php?cont=Picture&action=show&picID=random">Zufälliges Bild</a></li>
		<li class="cat"><u>Kategorien</u>
			<div class="dropdown-content" id="cat_drop" >
				
			</div>
		</li>
	</ul>
</div>
<script>
$.post( "index.php",{"cont":"Category", "action":"show_all"}, function( data ) {
	  $( "#cat_drop" ).html( data );
	});
</script>