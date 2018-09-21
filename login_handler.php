<?php
$_POST
	header('Location: https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/main.php');
exit;
