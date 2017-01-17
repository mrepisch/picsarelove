<!-- View für das Registrierungsformular -->

<div id="content">
	<div id="register">
		<form method="post" onsubmit="return validateRegistern();">
			<input type="hidden" name="cont" value="Login" />
			<input type="hidden" name="action" value="register">
		    <label for="emailreg">Email: </label> <input type="email" name="email" id="emailreg"><br>
		    <label for="passwdreg">Password:</label> <input type="password" name="passwd" id="passwdreg"><br>
		    <label for="passwdrepreg">Password wiederholen:</label> <input type="password" name="passwdrep" id="passwdrepreg"><br>
	        <input type="submit" value="Register" />
	    </form>
    </div>
</div>