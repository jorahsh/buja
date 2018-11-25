
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

$genres = array();

foreach($movies as $movie) {
	$genres = array_merge($genres, preg_split('/,\s/', $movie['genre']));
	$genres = array_unique($genres);
}

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
		<p class="movie-title"><?php echo htmlentities($movies[$pos]['title']); ?></p>
	</div>
	<div class="container" id="container">
		<ul>
<?php
	for($i = 0; $i < 7; $i++) { ?>
			<li data-title=<?php echo '"'.$movies[$i]['title'].'"';?>
			    data-desc=<?php echo '"'.htmlentities($movies[$i]['description']).'"'; ?>
			>
				<img src=<?php echo '"'.$movies[$i]['poster'].'"';?>
				/>
			</li>
<?php } ?>
			<img src="./img/left-arrow-circle.png" class="left">
			<img src="./img/right-arrow-circle.png" class="right">
		</ul>
	</div>
	<div class="center-text">
		<button class="show-description">Description</button>
		<button class="show-comments">Comments</button>
	</div>
	<div class="full">
		<div class="movie-description center">
			<p class="description-text center-text center description-width">
				<?php echo htmlentities($movies[$pos]['description']); ?>
			</p>
		</div>

		<div class="comments-input center-text">
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
<?php		
	foreach($comments as $comment) {
		echo 
			'<tr class="border-bottom">
			<td class="table-username center-text">'.htmlentities($comment['username']).'</td>
			<td class="table-comment center-text">'.htmlentities($comment['comment']).'</td>
			<td class="table-date center-text">'.$comment['date'].'</td></tr>';
	}
?>
		</tbody>
		</table>
	</div>
	<div class="genre-bar">
		<div class="slick center">
<?php
foreach($genres as $genre){ ?>
		<div><h3 class="genre-tab" 
			data-genre=<?php echo '"'.$genre.'"'; ?>><?php echo $genre; ?></h3></div>
<?php	}
?>
		</div>
	</div>
<?php include "jquery.php"; ?>
</div>
