<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage wallarquitectura
 * @since wallarquitectura 1.0
 */

get_header(); ?>
			<article id="post-0" class="post error404 not-found" role="main">
				<h1><?php _e( '&iexcl;Hey! Esta p&aacute;gina no existe.', 'wallarquitectura' ); ?></h1>
				<p><?php _e( 'La p&aacute;gina que buscas no existe. </br>Puedes utilizar el men&uacute; de navegaci&oacute;n o volver a la <strong>p&aacute;gina de <a href="http://www.wallarquitectura.com">inicio.</a></strong>', 'wallarquitectura' ); ?></p>
				<script>
					// focus on search field after it has loaded
					document.getElementById('s') && document.getElementById('s').focus();
				</script>
			</article>
<?php get_footer(); ?>
