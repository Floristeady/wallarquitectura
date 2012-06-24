<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>
			<article id="post-0" class="post error404 not-found" role="main">
				<h1><?php _e( '&iexcl;Hey! Esta p&aacute;gina no existe.', 'boilerplate' ); ?></h1>
				<p><?php _e( 'La p&aacute;gina que buscas no existe. </br>Puedes utilizar el men&uacute; de navegaci&oacute;n o volver la a <strong>p&aacute;gina de <a href="http://www.wallarquitectura.com">inicio.</a></strong>', 'boilerplate' ); ?></p>
				<script>
					// focus on search field after it has loaded
					document.getElementById('s') && document.getElementById('s').focus();
				</script>
			</article>
<?php get_footer(); ?>
