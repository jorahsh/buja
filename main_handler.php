<?php

session_start();

require_once 'Movie_Dao.php';
require_once 'Comments_Dao.php';

$seen = $_POST['seen'];
$view = $_POST['view'];
$comment = $_POST['comment'];
$seek = $_POST['seek'];
$user = $_SESSION['user'];
$movie = $_SESSION['movie'];
$m_dao = new Movie_Dao();
$c_dao = new Comments_Dao();

if (!empty($seen)) {
	$m_dao->addSeenMovie($user,$seen);
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
		$c_dao->addComment($user,$movie,$comment);
	}
	else {
	}
}

if(!empty($seek)) {
	$pos = $_SESSION['curr_movie'];
	if($seek === 'right'){
		$_SESSION['curr_movie'] = $pos + 1;
	}
	else {
		$_SESSION['curr_movie'] = $pos - 1;
	}
	unset($_SESSION['seek']);
}
		

header('Location: https://stark-beyond-19703.herokuapp.com/main.php');

exit;
