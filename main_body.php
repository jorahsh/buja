
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
$selected_genre = $_SESSION['genre'];
$movies = $m_dao->getMoviesUserHasNotSeen($user);
$genres = array();

foreach($movies as $movie) {
	$genres = array_merge($genres, preg_split('/,\s/', $movie['genre']));
	$genres = array_unique($genres);
}

if(!empty($selected_genre)) {
	$new_movies = array();
	foreach($movies as $movie) {
		if(strpos($movie['genre'], $_SESSION['genre']) !== false) {
			array_push($new_movies, $movie);
		}
	}
	$movies = $new_movies;
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
		<p class="movie-title"></p>
	</div>
	<div class="container" id="container">
		<ul>
			<li data-title=<?php echo '"'.$movies[$pos]['title'].'"';?>
			    data-desc=<?php echo '"'.$movies[$pos]['description'].'"'; ?>
			    data-movie-id=<?php echo '"'.$movies[$pos]['id'].'"'; ?>
			>
				<div>
					<form method="post" action="main_handler.php">
						<img class="poster-container"
						     src=<?php echo '"'.$movies[$pos]['poster'].'"';?>>
						<input type="hidden"
						       name="seen"
						       value=<?php echo '"'.$movies[$pos]['id'].'"';?>>
						<input type="image"
						       name="submit"
						       class="seen-movie" 
						       src="./img/eyeball.png">
					</form>
				</div>
			</li>
<?php
	for($i = 1; $i < 4; $i++) { 
		$index = ($pos + $i) % count($movies); ?>
			<li data-title=<?php echo '"'.$movies[$index]['title'].'"';?>
			    data-desc=<?php echo '"'.$movies[$index]['description'].'"'; ?>
			    data-movie-id=<?php echo '"'.$movies[$index]['id'].'"'; ?>
			>
				<div>
					<form method="post" action="main_handler.php">
						<img class="poster-container"
						     src=<?php echo '"'.$movies[$index]['poster'].'"';?>>
						<input type="hidden"
						       name="seen"
						       value=<?php echo '"'.$movies[$index]['id'].'"';?>>
						<input type="image"
						       name="submit"
						       class="seen-movie" 
						       src="./img/eyeball.png">
					</form>
				</div>
			</li>
<?php } ?>	
<?php
	for($i = 3; $i > 0; $i--) { 
		$index = $pos - $i; 
		if($index < 0) {
			$index = $index + count($movies);
		}?>
			<li data-title=<?php echo '"'.$movies[$index]['title'].'"';?>
			    data-desc=<?php echo '"'.$movies[$index]['description'].'"'; ?>
			    data-movie-id=<?php echo '"'.$movies[$index]['id'].'"'; ?>
			>
				<div>
					<form method="post" action="main_handler.php">
						<img class="poster-container"
						     src=<?php echo '"'.$movies[$index]['poster'].'"';?>>
						<input type="hidden"
						       name="seen"
						       value=<?php echo '"'.$movies[$index]['id'].'"';?>>
						<input type="image"
						       name="submit"
						       class="seen-movie tooltip"
						       title="I've seen this movie!" 
						       src="./img/eyeball.png">
					</form>
				</div>
			</li>
<?php } ?>	
			<div class="left">
				<form id="poster-left" method="post" action="main_handler.php">
					<input type="hidden" name="seek" value="left">
					<img type="image" src="./img/left-arrow-circle.png">
				</form>
			</div>
			<div class="right">				
				<form id="poster-right" method="post" action="main_handler.php">
					<input type="hidden" name="seek" value="right">
					<img type="image" src="./img/right-arrow-circle.png">
				</form>
			</div>
		</ul>
	</div>
	<div class="center-text">
		<button name="view" value="description"class="show-description">Description</button>
		<button name="view" value="comments"class="show-comments">Comments</button>
	</div>
	<div class="full">
		<div class="movie-description center">
			<p class="description-text center-text center description-width">
				<?php echo htmlentities($movies[$pos]['description']); ?>
			</p>
		</div>
		<div class="comments">
			<div class="comments-input center-text">
				<div class="center">
					<label for="comment">Leave your comment here:</label>
					<input class="wide" type="text" id="comment">
					<button class="submit-comment">Add Comment!</button>
				</div>
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
		<div class="movie-comments"></div>
		</div>
	</div>
	<div class="genre-bar">
		<div class="slick center">
<?php
foreach($genres as $genre){ ?>
			<div class="select-genre">
				<form method="post" action="main_handler.php">
					<input type="hidden" name="genre" value=<?php echo '"'.$genre.'"'; ?>>
					<input type="submit" class="genre-tab 
				<?php if($genre === $selected_genre){echo 'selected-genre';}?>" 
						value=<?php echo '"'.$genre.'"'; ?>>
				</form>
			</div>
<?php	}
?>
		</div>
	</div>
<?php include "jquery.php"; ?>
</div>
