<?php

session_start();

require_once 'Movie_Dao.php';

$seen = $_POST['seen'];
$view = $_POST['view'];
$user = $_SESSION['user'];

if (!empty($seen)) {
	$dao = new Movie_Dao();
	/*$dao->addSeenMovie($user,$seen);*/
	if(isset($_SESSION['movie_id'])) {
		unset($_SESSION['movie_id']);
	}
}

if(!empty($view)) {
	if(isset($_SESSION['view']) && $_SESSION['view'] === $view) {
		unset($_SESSION['view']);
	}
	else {
		$_SESSION['view'] = $view;
	}
}

header('Location: https://stark-beyond-19703.herokuapp.com/main.php');

exit;
