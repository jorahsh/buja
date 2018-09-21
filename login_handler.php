<?php
$_POST
	header("Location: http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}/main.php");
exit;
