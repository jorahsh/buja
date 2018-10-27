<?php
session_start();

require_once'Movie_Dao.php';

$dao = new Movie_Dao();
$movies = $dao->getAllMovies();
$genres = array('comedy', 'horror', 'action', 'drama', 'animated', 'family');

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
	header('Location: https://stark-beyond-19703.herokuapp.com');
  	exit;
} ?>
<div class="main-container">
	<div class="left-arrow-circle">
		<input type="image" src="./img/left-arrow-circle.png">
	</div>
	<div class="movie-poster">
		<input type="image" src=<?php echo '"'. $movies[0]['poster'] . '"';?>>
	</div>
	<div class="right-arrow-circle">
		<input type="image" src="./img/right-arrow-circle.png">
	</div>
	<div class="genre-bar">
		<input type="image" class= "grey-arrow-right" src="./img/grey-arrow-right.png">
		<input type="image" class= "grey-arrow-left" src="./img/grey-arrow-left.png">
		<ul class="genre-list">';
<?php
foreach($genres as $genre){
	echo "<li class='genre-tab'> $genre </li>";
}
?>
		</ul>
	</div>
</div>
