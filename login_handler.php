<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if (isset($username) && isset($password)) {
	header('Location: https://stark-beyond-19703.herokuapp.com/main.php');
}
else {
	if (!isset($username) {
		$_SESSION['login_error'][] = 'please enter a username';
	}
	if (!isset($password) {
		$_SESSION['login_error'][] = 'please enter a password';
	}
	header('Location: https://stark-beyond-19703.herokuapp.com');
}

exit;
