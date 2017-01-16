<!DOCTYPE html>
<html>

<?php
require_once 'view/header.php';
?>
<body> 
<?php
require_once 'control/Dispatcher.php';
$dispatcher = new Dispatcher();
$dispatcher->dispatch();

?>


</body>
</html>
<!-- -->