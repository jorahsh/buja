<?php

session_start();

require_once 'User_Dao.php';

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username)) {
	$_SESSION['login_error'][] = 'please enter a username';
}
else {
	$_SESSION['username'] = $username;
}

if (empty($password)) {
	$_SESSION['login_error'][] = 'please enter a password';
}

if (!isset($_SESSION['login_error'])) {
	$dao = new User_Dao();
	$password = $password.$username;
	$hash = password_hash($password, PASSWORD_BCRYPT);
	if(password_verify($password, $hash)) {
		$user = $dao->getUser($username,$hash);
		if ($user != null){
			$_SESSION['logged_in'] = true;
			$_SESSION['user'] = $user['id'];
			header('Location: https://stark-beyond-19703.herokuapp.com/main.php');
		}
		else {
			$_SESSION['login_error'][] = 'DATABASE_ERROR: invalid username or password';
			$_SESSION['login_error'][] = $hash;
		}
	}
	else {
		$_SESSION['login_error'][] = 'PHP_ERROR: invalid username or password';
	}
}

if (isset($_SESSION['login_error'])) {
	header('Location: https://stark-beyond-19703.herokuapp.com');
}

exit;
