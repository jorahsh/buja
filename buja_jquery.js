$(document).ready(function(){
        $('.poster-carousel').carousel({
            num: 5,
            maxWidth: 450,
            maxHeight: 300,
            distance: 50,
            scale: 0.6,
            animationTime: 1000,
            showTime: 4000
        });
	$('.poster-carousel').carousel({
		num: 3,
		maxWidth: 250,
		maxHeight: 150,
		autoPlay: true,
		showTime: 2000,
		animationTime: 300,
		scale: 0.8,
		distance: 50
	});
});
