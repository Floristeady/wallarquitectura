/*
	Any site-specific scripts you might have.
	Note that <html> innately gets a class of "no-js".
	This is to allow you to react to non-JS users.
	Recommend removing that and adding "js" as one of the first things your script does.
	Note that if you are using Modernizr, it already does this for you. :-)
*/

/*----Home Slideshow----*/
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


/*----Galeria single-proyectos.php----*/
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


/*----Listado de proyectos----*/
$(function () {
	
	/* Nth Child effect*/
	function nthchild() {
		$("#projects li:nth-child(3n+3)").addClass("mar-right-0");
	}

	// Fade del load project and filter tag
	$(function () {
		  $('.project-item').hide();//hide all the images on the page
		});
		
		var i = 0; //initialize
		var int=0; //Internet Explorer Fix
		$(window).bind("load", function() { //The load event will only fire if the entire page or document is fully loaded
		  int = setInterval(doThis, 200); //200 is the fade in speed in milliseconds
		});
		
		function doThis() {
		    var imgs = $('.project-item').length; //count the number of images on the page
		    if (i >= imgs) { // Loop the images
		    clearInterval(int); //When it reaches the last image the loop ends
		    }
		
		    $('.project-item:hidden').eq(0).fadeIn(200); //fades in the hidden images one by one
		    i++;//add 1 to the count
		}
	
	
	
	    // filterByHash filters the list of Portfolio Items using a passed-in tag, if available, or the hash-tag in the url
		filterByHash = function(tag) {
	        // Cache the portfolio items
	        var portfolioItems = $('#projects li');
	        // And the tag links
	        var portfolioFilters = $('.tag a');
	
	        // De-select all the filter links
	        portfolioFilters.removeClass('current');
	
	        if (tag) {
	            if (tag == 'all' || tag == '') {
	                // Show all the items
	                portfolioItems.animate({ width: 'show', opacity: 'show' });
	                // Highlight the 'All' tag
	               // $('.all', portfolioFilters).addClass('current');
	                $(portfolioFilters).filter('.all').addClass('current');
	            } else {
	                // Show the desired items and hide the rest
	                $('#projects li.' + tag).animate({ width: 'show', opacity: 'show' });
	                $('#projects li:not(.' + tag + ')').animate({ width: 'hide', opacity: 'hide' });
	                // Highlight the tag
	                portfolioFilters.filter('a[href$=' + tag + ']').addClass('current');
	            }
	        } else {
	            // Use the url hash if a tag wasn't passed in
	            tag = location.hash.substr(1);
	
	            if (tag == 'all' || tag == '') {
	                // Highlight the 'All' tag
	                $(portfolioFilters).filter('.all').addClass('current');
	                nthchild();
	            } else {
	                // Hide the undesired ones
	                $('#projects li.:not(.' + tag + ')').hide();
	                // Highlight the tag
	                portfolioFilters.filter('a[href$=' + tag + ']').addClass('current');
	                nthchild();
	            }
	        }
	    }
	
		// Filter initiall on pageload
	    filterByHash();
	
	  // Re-filter when a tag is selected
	    $('.tag a').click(function(){
			filterByHash($(this).attr('href').substr(1));
			return false;
		});
	
	
});
