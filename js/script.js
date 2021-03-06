/*
	Any site-specific scripts you might have.
	Note that <html> innately gets a class of "no-js".
	This is to allow you to react to non-JS users.
	Recommend removing that and adding "js" as one of the first things your script does.
	Note that if you are using Modernizr, it already does this for you. :-)
*/


/*****Menu Desplegable*****/
$(function(){
	if(!/Android|webOS|iPhone|iPod|iPad|BlackBerry/i.test(navigator.userAgent) ) {
		$("ul.sub-menu").parents().addClass('sub-menu-parent');
		// Oculto los submenus
		$("#menu-menu-principal ul.sub-menu-parent").css('display', 'none');
		// Defino que submenus deben estar visibles cuando se pasa el mouse por encima
		$('#menu-menu-principal li').hover(function(){
			$(this).find('ul.sub-menu:first:hidden').slideDown(400);
			$('sub-menu').show();
		},function(){
			$(this).find('ul.sub-menu:first').slideUp(400);
		});
	 }
});


/*****Flexislider Home y Galer�a Proyectos*****/
$(function() {
	  
	//  if ($(window).width() <= 767) {
	      $('#home-gallery').flexslider({
	        animation: "slide",
	        slideshow: false,
	        controlNav: true,
	        directionNav: true,
			keyboardNav: true,
			pauseOnAction: true,
			pauseOnHover: false,
			touch: true,	 				
			animationLoop: true,
			after: function(){
			  var new_img = $('.flex-active-slide').children('img.this').attr('title');
			  $.backstretch('' + new_img + '');
			}
	      });
      //} else {
	      $('#home-gallery').flexslider({
	        animation: "fade",
	        slideshow: true,
	        controlNav: true,
	        directionNav: false,
			touch: true,	 				
			after: function(){
			  var new_img = $('.flex-active-slide').children('img.this').attr('title');
			  $.backstretch('' + new_img + '');
			}
	      });
      //}
      
      // Home
	  if ($('body').hasClass('home')) {
	    var new_img = $('.flex-active-slide').children('img.this').attr('title');
		$.backstretch(new_img, {duration: 2000, fade: 750});
      }
     
     // Proyecto 
     $('#proyect-gallery').flexslider({
        animation: "slide",
        slideshow: false,
        selector: ".slides > li",
	    directionNav: true,
	    keyboardNav: true,
	    controlNav: false
      });

      // Inmobiliaria
       $('#housing-gallery').flexslider({
	       animation: "slide",
	       controlNav: false,
	       animationLoop: false,
	       slideshow: false,
	       selector: ".slides > li"
	    });
}); 


/*****Proyectos Pag Inicio muestra img*****/
if (!$(window).width() <= 767) {
	$(function(){
		$('.home-project').each(
			function(i,content){
				$(content).hover(
					function(){
						$(this).find('a.img img').animate({scale: 1.4},{duration:200});	
					}, function(){
						$(this).find('a.img img').animate({scale: 1},{duration:200});	
				}); }
		  );  
	}); 				
} 

/*****Color de font en listado proyectos*****/
$(function () {
	
     var colorgray= $('body').hasClass('category-proyectos');
     
     if (colorgray == true) {
	 	$('body').css({'background-color' : '#242424'}).animate({'opacity': 1}, 600);
	 } else {
		 $('body').css({'background-color' : '#ffffff'}).animate({'opacity': 1}, 600);
	 }
	
	$(window).bind("load", function() { //The load event will only fire if the entire page or document is fully loaded
		  int = setInterval(changecolor, 200); //200 is the fade in speed in milliseconds
    });
    
    function changecolor() {
     	var classwhite = $('body').hasClass('category-proyectos');
	     
	     if (classwhite == true) {
				$('body').attr('id', 'white');	
			    clearInterval(int);
		} 
	}
});


/*****Listado de proyectos*****/
$(function () {

	$("#single-proyectos #nav li:nth-child(6n+6)").addClass("mar-right-0");

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

	
    /*----last child----*/
	$("#projects li.mar-right-0").css("margin-right","0");
    $("#housing li:nth-child(2n+2)").css("margin-right","0");
    $(".home-project:last-child").css("padding-right", "0"); 
    $(".home-project:last-child").css("border-right", "0"); 

	
});

/*****Listado de inmobiliaria*****/
$(function(){
  if ( $('#housing').length) {
	var $container = $('#housing');
	
	$container.imagesLoaded( function(){
	  $container.isotope({
	        // options
		    //itemSelector : 'article',
		    layoutMode : 'masonry',
		    itemPositionDataEnabled: true
	  });
	});
}
});


/*****Mostrar Compartir Botones Sociales*****/

$(function(){
	$("a.btn_share").bind('click focus', function(){
		$('#single-proyectos #post-social').toggleClass('show');
	}); 
});


$(function(){
	winh = $('body').width();
	
	if (winh < 560) {
		$('#housing li img').removeAttr('height');
	}
});

/***** Menu mobile *****/
$(function($){

 $('#btn-menu-movil')
   .bind('click focus', function(){
     $('#nav-mobile').slideToggle();
     $('#btn-menu-movil').toggleClass('active');
     $('.backstretch').toggleClass('active');
  }); 
  
  $('#nav-mobile span')
   .bind('click focus', function(){
     $('#nav-mobile').slideToggle();
     $('#btn-menu-movil').toggleClass('active');
     $('.backstretch').toggleClass('active');
  }); 
  
});