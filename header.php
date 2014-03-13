<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage wallarquitectura
 * @since wallarquitectura 1.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="description" content="Empresa de arquitectura, diseño, construcción y proyectos inmobiliarios en Xalapa, Veracruz. México." >
		<title><?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 * We filter the output of wp_title() a bit -- see
			 * wallarquitectura_filter_wp_title() in functions.php.
			 */
			wp_title( '|', true, 'right' );
		?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
        ?>
        <script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-3179567-6']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		</script>
	</head>
	<body <?php body_class(); ?>>
			<div id="masterheader">
				<header id="header" role="banner">
										
					<div id="nav-mobile" class="hidden-desktop hidden-tablet">
					    <?php wp_nav_menu( array( 'container_id' => 'menu-third', 'theme_location' => 'third', 'sort_column' => 'menu_order' ) ); ?>
					    <span>X</span>
			        </div><!-- /mobile menu -->  
			        
					<hgroup>
						<h1><a id="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h2><?php bloginfo( 'description' ); ?></h2>
					</hgroup>
					
					<nav id="access" role="navigation" class="hidden-phone">
						<a id="skip" href="#content" title="<?php esc_attr_e( 'Skip to content', 'wallarquitectura' ); ?>"><?php _e( 'Skip to content', 'wallarquitectura' ); ?></a>
						<?php wp_nav_menu( array( 'container_id' => 'menu-primary', 'theme_location' => 'primary') ); ?>
					</nav>
					
					<nav id="nav-2" class="hidden-phone">
						<?php wp_nav_menu( array( 'container_id' => 'menu-secondary', 'theme_location' => 'secondary', 'sort_column' => 'menu_order' ) ); ?>
					</nav>
					
					<a href="#" id="btn-menu-movil" class=" hidden-desktop hidden-tablet menu-trigger"><span class="icon"></span>Menú</a>      
				
				</header>
			</div>
			
		    <div id="container">
				<section id="content" role="main">
