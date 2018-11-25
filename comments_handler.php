<?php

session_start();

require_once 'Comments_Dao.php';

$movie = $_POST['movieId'];
$comment = $_POST['comment'];
$user = $_SESSION['user'];

$c_dao = new Comments_Dao();

echo $movie;
echo $user;

if(!empty($movie)) {

	if(!empty($comment)){
		if(strlen($comment) < 192 && strlen($comment) > 0) {
			$c_dao->addComment($user,$movie,$comment);
		}
	}

	$comments = $c_dao->getMovieComments($movie);

echo '<table align="center">
	<tbody>';	
	foreach($comments as $comment) {
		echo 
			'<tr class="border-bottom">
			<td class="table-username center-text">'.htmlentities($comment['username']).'</td>
			<td class="table-comment center-text">'.htmlentities($comment['comment']).'</td>
			<td class="table-date center-text">'.$comment['date'].'</td></tr>';
	}
echo	'</tbody>
	</table>';

}

exit;
