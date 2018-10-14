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

if (!isset($_SESSION['login_error'])) {
	$myFile = fopen("login.txt", "w");
	require_once 'Buja_Dao.php';
	fwrite($myFile, "past require");
	$dao = new Buja_Dao();
	fwrite($myFile, "past new dao");
	if ($dao.getUser($username,$password)){
		$_SESSION['logged_in'] = true;
		header('Location: https://stark-beyond-19703.herokuapp.com/main.php');
	}
	else {
		$_SESSION['login_error'][] = 'invalid username or password';
	}
}

if (isset($_SESSION['login_error'])) {
	header('Location: https://stark-beyond-19703.herokuapp.com');
}

exit;
