<?php
session_start();

require_once'Movie_Dao.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
	header('Location: https://stark-beyond-19703.herokuapp.com');
  	exit;
}
if (!isset($_SESSION['user'])) {
	header('Location: https://stark-beyond-19703.herokuapp.com');
  	exit;
}

$dao = new Movie_Dao();
$user = $_SESSION['user'];
$movies = $dao->getMoviesUserHasNotSeen($user);
$genres = array('comedy', 'horror', 'action', 'drama', 'animated', 'family');
$rand = rand(0, (count($movies) - 1));
?>

<div>
	<div class="left-arrow-circle">
		<input type="image" src="./img/left-arrow-circle.png">
	</div>
	<div class="center-text large-text">
		<p><?php echo htmlentities($movies[$rand]['title']); ?></p>
	</div>
	<div>
		<div class="poster-container center">
			<form method="post" action="main_handler.php">
				<input class="center movie-poster" 
					type="image" 
					src=<?php echo '"'. $movies[$rand]['poster'] . '"';?>
					name="seen"
					value=<?php echo '"' . $rand . '"';?>>
				<input type="image" value="submit" class="seen-movie" src="./img/eyeball.png">
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
	if($_SESSION['view'] === 'description') { ?>
		<div>
			<div class="center">
				<p class="center-text half-width"><?php echo htmlentities($movies[$rand]['description']); ?></p>
			</div>
		</div>
<?php	}
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
