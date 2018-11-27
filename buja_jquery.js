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

	var getMovieId = function() {
		return $('li[style*="z-index: 10001;"]').data('movie-id');
	};

	var changeTitle = function() {
		var title = $('li[style*="z-index: 10001;"]').data('title');
		$('.movie-title').text(title);
	};

	var changeDescription = function() {
		var desc = $('li[style*="z-index: 10001;"]').data('desc');
		$('.description-text').text(desc);
	};

	var changeComments = function() {
		var movieId = getMovieId();
		$.post('comments_handler.php', {movieId: movieId}, function(data, status) {
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

	$('.submit-comment').click(function() {
		var movieId = getMovieId();
		var comment = $('#comment').val();
		$.post('comments_handler.php', {movieId: movieId, comment: comment}, function(data, status) {
			$('.movie-comments').html(data);
		});
	});

	$('.seen-movie').on('mouseover', function() {
		$('.seen-movie').tooltipster({
			content: "I've already seen this movie!",
			theme:'tooltipster-punk'
		});
		$('.seen-movie').tooltipster('show');
	});
});
