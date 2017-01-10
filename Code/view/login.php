<?php if($isLogdin == false){ ?>
 <div id="login">
 	<form action="index.php" method="post">
	<input type="hidden" name="cont" value="Login"></input>
	<input type="hidden" name="action" value="login">
	
	<label for="email">Email</label>
	<input type="email" name="email"></input>
	<label for="passwd">Passwort</label>
	<input type="password" name="passwd"></input>
	<input type="submit" value="Login"> </input> 
	</form>
</div>
<?php }else{ ?>
 <div id="login">
 	<p><?php echo $userName ?></p>
 	<form method="post" action="index.php">
 		<input type="hidden" name="cont" value="Login"></input>
		<input type="hidden" name="action" value="logout">
		<input type="submit" value="Abmelden" ></input>
 	</form>
 </div>
<?php } ?>