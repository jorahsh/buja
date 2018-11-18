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
	var top_li = $('li[style="display: block;position: absolute;z-index: 10001;overflow: hidden;width: 300px;height: 450px;left: 100px;top: 0px;"]');
	$('.movie-title').text($('li[style="z-index: 10001;"] img').val());
	alert(top_li.html());
});
