/*
	Any site-specific scripts you might have.
	Note that <html> innately gets a class of "no-js".
	This is to allow you to react to non-JS users.
	Recommend removing that and adding "js" as one of the first things your script does.
	Note that if you are using Modernizr, it already does this for you. :-)
*/

$(function() {
	$('#slideshow') 
	.cycle({ 
	    fx:     'fade', 
	    speed:  'slow', 
	    timeout: 10000, 
	    pager:  '#nav', 
	    slideExpr: 'li.slide'
	});

});



$(function() {
	$('#gallery-1') 
	.after('<ul id="nav">')
	.cycle({ 
	    fx:     'fade', 
	    speed:  'slow', 
	    timeout: 10000, 
	    slideExpr: '.gallery-item img',
	    pager:  '#nav', 
     
    // callback fn that creates a thumbnail to use as pager anchor 
    pagerAnchorBuilder: function(idx, slide) { 
        return '<li><a href="#"><img src="' + slide.src + '" width="224" /></a></li>'; 
    } 
	});

});