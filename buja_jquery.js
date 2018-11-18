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
	var top_li = $('ul').find('li').css('z-index', '10001');
	$('.movie-title').text($('li[style="z-index: 10001;"] img').val());
	alert(top_li.html());
});
