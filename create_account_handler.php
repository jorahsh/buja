<?php

session_start();

require_once 'User_Dao.php';

$username = $_POST['create_username'];
$email = $_POST['create_email'];
$password = $_POST['create_password'];

if (empty($username)) {
	$_SESSION['create_error'][] = 'please enter a username';
}

if (empty($email)) {
	$_SESSION['create_error'][] = 'please enter an email';
}

if (empty($password)) {
	$_SESSION['create_error'][] = 'please enter a password';
}

if (!isset($_SESSION['create_error'])) {
	$dao = new User_Dao();
	$dao->addUser($username,$email,$password);
	$_SESSION['logged_in'] = true;
	header('Location: https://stark-beyond-19703.herokuapp.com/main.php');
}

if (isset($_SESSION['create_error'])) {
	header('Location: https://stark-beyond-19703.herokuapp.com/create_account.php');
}

exit;
