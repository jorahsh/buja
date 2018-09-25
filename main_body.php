<?php
echo '<div class="main-container">
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
		<img class= "grey-arrow-left" src="./img/grey-arrow-left.png">'

$genres = ['comedy', 'horror', 'action', 'drama', 'animated', 'family'];

foreach($genres as $genre){
	echo '<button>'$genre'</button>';
}

echo	'</div>
</div>';
