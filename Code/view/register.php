<!-- View für das Registrierungsformular -->

<div id="content">
	<div id="register">
		<form method="post">
			<input type="hidden" name="cont" value="Login">
			<input type="hidden" name="action" value="register">
		    <label for="email">Email: </label> <input type="email" name="email" id="email"><br>
		    <label for="passwd">Password:</label> <input type="password" name="passwd" id="passwd"><br>
		    <label for="passwdrep">Password wiederholen:</label> <input type="password" name="passwdrep" id="passwdrep"><br>
	        <input type="submit" value="Registrieren" name="register">
	    </form>
    </div>
</div>