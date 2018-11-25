<?php

session_start();

require_once 'User_Dao.php';

$username = $_POST['create_username'];
$email = $_POST['create_email'];
$password = $_POST['create_password'];

if (empty($username)) {
	$_SESSION['create_error'][] = 'please enter a username';
	if (isset($_SESSION['create_username'])) {
		unset($_SESSION['create_username']);
	}
}
else { 
	if (strlen($username) < 3) {
		$_SESSION['create_error'][] = 'username must be at least 3 characters';
	}
	elseif (strlen($username) > 191) {
		$_SESSION['create_error'][] = 'username cannot be more than 191 characters long';
	}
	$_SESSION['create_username'] = $username;
}

if (empty($email)) {
	$_SESSION['create_error'][] = 'please enter an email';
	if (isset($_SESSION['create_email'])) {
		unset($_SESSION['create_email']);
	}
}
else {
	if (!preg_match('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/', $email)) {
		$_SESSION['create_error'][] = 'please enter a valid email';
	}
	$_SESSION['create_email'] = $email;
}

if (empty($password)) {
	$_SESSION['create_error'][] = 'please enter a password';
}
elseif (strlen($password) < 5) {
	$_SESSION['create_error'][] = 'passowrd must be at least 5 characters';
}
elseif (strlen($password) > 191) {
	$_SESSION['create_error'][] = 'password cannot be more than 191 characters long';
}

if (!isset($_SESSION['create_error'])) {
	$dao = new User_Dao();
	$password = $password.$username;
	$password = password_hash($password, PASSWORD_BCRYPT);
	$ret = $dao->addUser($username,$email,$password);
	if($ret === 1) {
		$_SESSION['logged_in'] = true;
		$user = $dao->getUser($username,$password);
		$_SESSION['user'] = $user['id'];
		header('Location: https://stark-beyond-19703.herokuapp.com/main.php');
	}
	else {
		$_SESSION['create_error'][] = 'username or email is already taken';
	}
}

if (isset($_SESSION['create_error'])) {
	header('Location: https://stark-beyond-19703.herokuapp.com/create_account.php');
}

exit;
