<?php

session_start();

require_once 'Buja_Dao.php';

$username = $_POST['create_username'];
$password = $_POST['create_password'];

if (empty($username)) {
	$_SESSION['create_error'][] = 'please enter a username';
}

if (empty($password)) {
	$_SESSION['create_error'][] = 'please enter a password';
}

if (!isset($_SESSION['create_error'])) {
	$dao = new Buja_Dao();
	$dao->setUser($username,$password);
	$_SESSION['logged_in'] = true;
	header('Location: https://stark-beyond-19703.herokuapp.com/main.php');
}

if (isset($_SESSION['create_error'])) {
	print_r($_SESSION['create_error']);
	/*	header('Location: https://stark-beyond-19703.herokuapp.com/create_account.php');*/
}

exit;
