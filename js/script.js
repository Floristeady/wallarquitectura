/*
	Any site-specific scripts you might have.
	Note that <html> innately gets a class of "no-js".
	This is to allow you to react to non-JS users.
	Recommend removing that and adding "js" as one of the first things your script does.
	Note that if you are using Modernizr, it already does this for you. :-)
*/

/*----Menu dropdown----*/
$(function(){
	$("ul.sub-menu").parents().addClass('sub-menu-parent');
	// Oculto los submenus
	$("#menu-menu-principal ul.sub-menu-parent").css('display', 'none');
	// Defino que submenus deben estar visibles cuando se pasa el mouse por encima
	$('#menu-menu-principal li').hover(function(){
		$(this).find('ul.sub-menu-parent:first:hidden').slideDown(400);
		$('sub-menu').show();
	},function(){
		$(this).find('ul.sub-menu-parent:first').slideUp(400);
	});
});


/*----Cambio de color por class template----*/
$(function () {
	
	 $('body').css({ 'opacity' : 0 });
	 
     var colorgray= $('body').hasClass('category');
     
     if (colorgray == true) {
	 	$('body').css({'background-color' : '#242424', 'opacity' : '0'}).animate({'opacity': 1}, 600);
	 } else {
		 $('body').css({'background-color' : '#ffffff', 'opacity' : '0'}).animate({'opacity': 1}, 600);
	 }
	
	$(window).bind("load", function() { //The load event will only fire if the entire page or document is fully loaded
		  int = setInterval(changecolor, 200); //200 is the fade in speed in milliseconds
    });
    
    function changecolor() {
     	var classwhite = $('body').hasClass('category');
     	var colorgreen = $('body').hasClass('page-id-2');
        var colorgreen = $('body').hasClass('page-id-15');
	     
	     if (classwhite == true) {
				$('body').attr('id', 'white');	
			    clearInterval(int);
		} else if (colorgreen == true) {
				$('body').css({'background-color' : '#669700'}).animate({'opacity': 1}, 600);
				$('body').attr('id', 'white');	
				clearInterval(int);
		}
	}
});


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


/*----Galeria single-proyectos.php y single-inmobiliaria.php----*/
$(function() {
	$('#gallery-1') 
	.after('<ul id="nav">')
	.cycle({ 
	    fx:     'fade', 
	    speed:  'slow', 
	    timeout: 10000, 
	    slideExpr: '.gallery-item img',
	    pager:  '#nav', 
	    height:  'auto',
	    fit: 0, 
	    after: onAfter,
     
    // callback fn that creates a thumbnail to use as pager anchor 
    pagerAnchorBuilder: function(idx, slide) { 
        return '<li><a href="#"><img src="' + slide.src + '" width="224" /></a></li>'; 
    } 
	});
	
	function onAfter(curr, next, opts, fwd){
		//get the height of the current slide
		var $ht = $(this).height();
		//set the container's height to that of the current slide
		$(this).parent().animate({height: $ht});
	}
	
	
});


/*----Listado de proyectos----*/
$(function () {
	
	$("#projects li:nth-child(3n+3)").addClass("mar-right-0");

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

		
		var findcat =  $('.submenu-cat li').hasClass('current-cat');
		
		//console.log(findcat);
		
		if (findcat == false) {
			$('li.all').addClass('current-cat');
		} else {
			$('li.all').removeClass('current-cat');
		}
	


/*----Desplegar cuadro proyecto entry-content----*/

	$("a.btn_info").toggle(
		function(){
			$(this).addClass('arrow_down');
			$('.entry-content').slideDown();
			console.log ("ok");
		}, function(){
			$(this).removeClass('arrow_down');
			$('.entry-content').slideUp();
	});
	
});
