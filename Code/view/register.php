<!-- View für das Registrierungsformular -->

<div id="content">
	<div id="register" class="form">
		<?php if($register_error != "Registrierung Erfolgreich") { ?>
			<h2>Registrieren</h2>
			<form method="post" onsubmit="return validateRegister();">
				<input type="hidden" name="cont" value="Login" />
				<input type="hidden" name="action" value="register">
			    <label for="emailreg">Email: </label> <input type="email" name="email" id="emailreg"><br>
			    <label for="passwdreg">Password:</label> <input type="password" name="passwd" id="passwdreg"><br>
			    <label for="passwdrepreg">Password wiederholen:</label> <input type="password" name="passwdrep" id="passwdrepreg"><br>
		        <input type="submit" value="Registrieren" />
		    </form>
	    <p class="error" id="register_error"><?php echo $register_error ?></p>
	   	<?php } ?>
	   	<p class="success" id="register_success"><?php echo $register_error ?></p>
    </div>
</div>