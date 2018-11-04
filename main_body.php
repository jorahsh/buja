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
$genres = array('comedy', 'horror', 'action', 'drama', 'animated', 'family');

if(isset($_SESSION['movie_id'])) {
	$pos = $_SESSION['movie_id'];
}
else {
	$pos = rand(0, (count($movies) - 1));
	$_SESSION['movie_id'] = $pos;
}

$comments = $c_dao->getMovieComments($movies[$pos]['id']);

?>

<div>
	<div class="left-arrow-circle">
		<input type="image" src="./img/left-arrow-circle.png">
	</div>
	<div class="center-text large-text">
		<p><?php echo htmlentities($movies[$pos]['title']); ?></p>
	</div>
	<div>
		<div class="poster-container center">
			<form method="post" action="main_handler.php">
				<input class="center movie-poster" 
					type="image"
					name="seen"
					value="9"
					src=<?php echo '"'.$movies[$pos]['poster'].'"';?>>
				<input type="image"
					value="submit"
					class="seen-movie" 
					src="./img/eyeball.png">
			</form>
		</div>
	</div>
	<div class="right-arrow-circle">
		<input type="image" src="./img/right-arrow-circle.png">
	</div>
	<div class="center-text">
		<form method="post" action="main_handler.php">
			<input type="submit" name="view" value="description">
			<input type="submit" name="view" value="comments">
		</form>
	</div>
<?php
if(isset($_SESSION['view'])) {
?>	<div class="center">
<?php
	if($_SESSION['view'] === 'description') { ?>
			<p class="center-text center description-width">
				<?php echo htmlentities($movies[$pos]['description']); ?>
			</p>
<?php	}
	if($_SESSION['view'] === 'comments') { ?>
		
<?php	} ?>
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
</div>
