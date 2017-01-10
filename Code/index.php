<?php

session_start();
if(isset($_GET['function'])) {
	$function = $_GET['function'];
} else {
	$function = 'anzeigen';
}

?>


<html>
	<head>
		<title>PicsAreLove</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta charset="UTF-8" />
	</head>
	<body>
		<div id="page">
			<?php
	        	include_once("view/navi.php");
	    	?>
			
			<?php
	        	include_once("view/$function.php");
	    	?>
    	</div>
    	
	</body>
</html>