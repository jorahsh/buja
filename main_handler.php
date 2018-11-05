<?php

session_start();

require_once 'Movie_Dao.php';

$seen = $_POST['seen'];
$view = $_POST['view'];
$comment = $_POST['comment'];
$user = $_SESSION['user'];
$movie = $_SESSION['movie'];
$dao = new Movie_Dao();

if (!empty($seen)) {
	$dao->addSeenMovie($user,$seen);
	if(isset($_SESSION['curr_movie'])) {
		unset($_SESSION['curr_movie']);
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

if(!empty($comment)){
	if(strlen($comment) > 0) {
		$dao->addComment($user,$movie,$comment);
	}
	else {
	}
}

header('Location: https://stark-beyond-19703.herokuapp.com/main.php');

exit;
