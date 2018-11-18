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

	var centerMovie = $('li[style*="z-index: 10001;"]');

	var changeTitle = function() {
		var title = centerMovie.data('title');
		$('.movie-title').text(title);
	};

	var changeDescription = function() {
		var desc = centerMovie.data('desc');
		$('.description-text').text(desc);
	}

	changeTitle();
	changeDescription();

	$('.right').click(function(){
		changeTitle();
		changeDescription();

	});

	$('.left').click(function() {
		changeTitle();
		changeDescription();

	});

	$('show-description').click(function() {
		$('movie-description').toggle();
	});
	
});
