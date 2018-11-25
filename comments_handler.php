<?php

session_start();

require_once 'Comments_Dao.php';

$movie = $_POST;
$c_dao = new Comments_Dao();

if (!empty($movie)) {
	$c_dao->getMovieComments($movie);
	if(isset($_SESSION['curr_movie'])) {
		unset($_SESSION['curr_movie']);
	}
}

echo '<table align="center">
	<tbody>';	
	foreach($comments as $comment) {
		echo 
			'<tr class="border-bottom">
			<td class="table-username center-text">'.htmlentities($comment['username']).'</td>
			<td class="table-comment center-text">'.htmlentities($comment['comment']).'</td>
			<td class="table-date center-text">'.$comment['date'].'</td></tr>';
	}
echo	'/tbody>
	</table>';

exit;
