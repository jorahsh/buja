<?php

session_start();

require_once 'Comments_Dao.php';

if(isset($_REQUEST['movieId'])) {
	$movie = $_REQUEST['movieId'];
}

$c_dao = new Comments_Dao();

if (!empty($movie)) {
	$comments = $c_dao->getMovieComments($movie);
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

}

exit;
