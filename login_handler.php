<?php

session_start();

echo "<h1>OH LAWD HE'S COMIN!</h1>";

$username = $_POST['username'];
$password = $_POST['password'];

if (!isset($username) {
	$_SESSION['login_error'][] = 'please enter a username';
}

if (!isset($password) {
	$_SESSION['login_error'][] = 'please enter a password';
}

if (isset($_SESSION['login_error'])) {
	header('Location: https://stark-beyond-19703.herokuapp.com');
}
else {
	$_SESSION['logged_in'] = 'true';
	header('Location: https://stark-beyond-19703.herokuapp.com/main.php');
}
exit;
