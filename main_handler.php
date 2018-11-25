<?php

session_start();

require_once 'Movie_Dao.php';
require_once 'Comments_Dao.php';

$seen = $_POST['seen'];
$comment = $_POST['comment'];
$genre = $_POST['genre_tab'];
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

if(!empty($comment)){
	if(strlen($comment) > 191) {
		$_SESSION['comment_error'] = 'comments cannot be more than 191 characters long';
	}
	elseif(strlen($comment) > 0) {
		$c_dao->addComment($user,$movie,$comment);
	}
}

header('Location: https://stark-beyond-19703.herokuapp.com/main.php');

exit;
