$(document).ready(function(){
        $('.container').carousel({
        	num: 5,
        	maxWidth: 300,
        	maxHeight: 450,
        	distance: 50,
        	scale: 0.6,
		autoPlay: false,
        	animationTime: 1000,
        	showTime: 4000
        });

	$('.slick').slick({
  		infinite: true,
  		slidesToShow: 6,
  		slidesToScroll: 3,
		dots: true
	});

	var changeTitle = function() {
		var title = $('li[style*="z-index: 10001;"]').data('title');
		$('.movie-title').text(title);
	};

	var changeDescription = function() {
		var desc = $('li[style*="z-index: 10001;"]').data('desc');
		$('.description-text').text(desc);
	};

	var changeComments = function() {
		var movieId = $('li[style*="z-index: 10001;"]').data('movie-id');
		$.post('comments_handler.php', {movieId: movieId}, function(data, status) {
			alert(data);
			$('.movie-comments').html(data);
		});
	};

	var shiftContent = function () {
		changeTitle();
		changeDescription();
		changeComments();
	};

	shiftContent();

	$('.right').click(function(){
		shiftContent();
	});

	$('.left').click(function() {
		shiftContent();
	});

	$('.show-description').click(function() {
		if($('.movie-description').css('display') == 'none'){
			$('.movie-description').css('display','block');
		}
		else {
			$('.movie-description').css('display','none');
		}
		if($('.comments-input').css('display') == 'block'){
			$('.comments-input').css('display', 'none');
		}
	});
	
	$('.show-comments').click(function() {
		if($('.comments').css('display') == 'none') {
			$('.comments').css('display', 'block');
		}
		else {
			$('.comments').css('display', 'none');
		}
		if($('.movie-description').css('display') == 'block'){
			$('.movie-description').css('display','none');
		}
	});

	$('.select-genre').click(function() {
		$.post('/main_handler.php', {genre: $('genre_tab').data('genre')}, function(data, status) {
			alert(data);
		});
	});
});
