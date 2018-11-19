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

	$('.genre-bar').slick({
  		infinite: true,
  		slidesToShow: 3,
  		slidesToScroll: 3
	});

	var changeTitle = function() {
		var title = $('li[style*="z-index: 10001;"]').data('title');
		$('.movie-title').text(title);
	};

	var changeDescription = function() {
		var desc = $('li[style*="z-index: 10001;"]').data('desc');
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

	$('.show-description').click(function() {
		if($('.movie-description').css('display') == 'none'){
			$('.movie-description').css('display','block');
		}
		else {
			$('.movie-description').css('display','none');
		}

	});
	
	$('.show-comments').click(function() {
		if($('.comments-input').css('display') == 'none') {
			$('.comments-input').css('display', 'block');
		}
		else {
			$('.comments-input').css('display', 'none');
		}
	});
});
