<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username)) {
	$_SESSION['login_error'][] = 'please enter a username';
}

if (empty($password)) {
	$_SESSION['login_error'][] = 'please enter a password';
}

if (isset($_SESSION['login_error'])) {
	header('Location: https://stark-beyond-19703.herokuapp.com');
}
else {
	$_SESSION['logged_in'] = true;
	header('Location: https://stark-beyond-19703.herokuapp.com/main.php');
}
exit;
