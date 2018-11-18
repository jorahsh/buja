
<?php
session_start();

require_once'Movie_Dao.php';
require_once'Comments_Dao.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
	header('Location: https://stark-beyond-19703.herokuapp.com');
  	exit;
}
if (!isset($_SESSION['user'])) {
	header('Location: https://stark-beyond-19703.herokuapp.com');
  	exit;
}

$m_dao = new Movie_Dao();
$c_dao = new COmments_Dao();
$user = $_SESSION['user'];
$movies = $m_dao->getMoviesUserHasNotSeen($user);

$test = array();

foreach($movies as $movie) {
	/*this will one day be the genres array */	
	$test = array_merge($test, preg_split('/,\s/', $movie['genre']));
	$test = array_unique($test);
}

$genres = array('comedy', 'horror', 'action', 'drama', 'animated', 'family');

if(isset($_SESSION['curr_movie'])) {
	$pos = $_SESSION['curr_movie'];
	if($pos < 0) {
		$pos = $pos + count($movies);
	}
	else {
		$pos = $pos % count($movies);
	}
}
else {
	$pos = rand(0, (count($movies) - 1));
	$_SESSION['curr_movie'] = $pos;
}

$_SESSION['movie'] = ($movies[$pos]['id']);
$comments = $c_dao->getMovieComments($movies[$pos]['id']);

?>

<div>
	<div class="center-text large-text">
		<p><?php echo htmlentities($movies[$pos]['title']); ?></p>
	</div>
	<div class="poster-carousel">
		<ul>
<?php
	foreach($movies as $movie) { ?>
		<li>
			<img class="center movie-poster" src=<?php echo '"'.$movie['poster'].'"';?>>
		</li>
<?php } ?>
			<img class="left" src="./img/left-arrow-circle.png">
			<img class="right" src="./img/right-arrow-circle.png">
		</ul>
	</div>
	<div class="center-text">
		<form method="post" action="main_handler.php">
			<input type="submit" name="view" value="description">
			<input type="submit" name="view" value="comments">
		</form>
	</div>
<?php
if(isset($_SESSION['view'])) {
?>	<div  class="full">
<?php
	if($_SESSION['view'] === 'description') { ?>
		<div class="center">
			<p class="center-text center description-width">
				<?php echo htmlentities($movies[$pos]['description']); ?>
			</p>
		</div>
<?php	}
	if($_SESSION['view'] === 'comments') { ?>
		<div class="center-text">
		<form method="post" action="main_handler.php">
			<div class="center">
				Leave your comment here:<input class="wide" type="text" name="comment">
				<input type="submit" value="Add Comment!">
			</div>
		</form>
		</div>
<?php
	if(isset($_SESSION['comment_error'])) { ?>
		<div class="center-text">
			<p class="center-text center description-width">
				<?php echo $_SESSION['comment_error']; unset($_SESSION['comment_error']);?>
			</p>
		</div>
<?php	}
?>
		<table align="center">
		<tbody>
<?php		foreach($comments as $comment) {
			echo 
				'<tr class="border-bottom">
				<td class="table-username center-text">'.htmlentities($comment['username']).'</td>
				<td class="table-comment center-text">'.htmlentities($comment['comment']).'</td>
				<td class="table-date center-text">'.$comment['date'].'</td></tr>';
		}
?>
		</tbody>
		</table>
<?php
	} ?>
	</div>
<?php
}
?>	
	<div class="genre-bar">
		<input type="image" class= "grey-arrow-right" src="./img/grey-arrow-right.png">
		<input type="image" class= "grey-arrow-left" src="./img/grey-arrow-left.png">
		<ul class="genre-list">
<?php
foreach($genres as $genre){
	echo "<li class='genre-tab'> $genre </li>";
}
?>
		</ul>
	</div>
<?php include "jquery.php"; ?>
</div>
