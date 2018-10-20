<?php
session_start();

$genres = array('comedy', 'horror', 'action', 'drama', 'animated', 'family');

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
	header('Location: https://stark-beyond-19703.herokuapp.com');
  	exit;
} ?>
<div class="main-container">
	<div class="left-arrow-circle">
		<img src="./img/left-arrow-circle.png">
	</div>
	<div class="movie-poster">
		<img src="./img/star-wars-poster.jpg">
	</div>
	<div class="right-arrow-circle">
		<img src="./img/right-arrow-circle.png">
	</div>
	<div class="genre-bar">
		<img class= "grey-arrow-right" src="./img/grey-arrow-right.png">
		<img class= "grey-arrow-left" src="./img/grey-arrow-left.png">
		<ul class="genre-list">';
<?php
foreach($genres as $genre){
	echo "<li class='genre-tab'> $genre </li>";
}
?>
		</ul>
	</div>
</div>
