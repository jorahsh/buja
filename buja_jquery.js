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
	var title = $('li[style*="z-index: 10001;"]').attr('value');
	$('.movie-title').text(title);
	$('.right').click(function(){
		var title = $('li[style*="z-index: 10001;"]').attr('value');
		$('.movie-title').text(title);
	});
});
