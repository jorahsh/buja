<?php

session_start();

require_once 'Movie_Dao.php'

$seen = $_POST['seen'];
$user = $_SESSION['user'];

if (!empty($seen)) {
	$dao = new Movie_Dao();
	$dao->addSeenMovie($user,$seen);
}

header('Location: https://stark-beyond-19703.herokuapp.com/main.php');

exit;