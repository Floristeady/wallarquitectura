<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage wallarquitectura
 * @since wallarquitectura 1.0
 */

get_header(); 

$post = $wp_query->post;

if ( in_category ('Proyectos')  ) {
    include(TEMPLATEPATH . '/single-proyectos.php');
} else if ( in_category('Inmobiliaria') || in_category('Lotificaciones') || in_category('Venta de Casas')) {
    include(TEMPLATEPATH . '/single-inmobiliaria.php');
    
}  else if ( in_category('Proceso')) {
    include(TEMPLATEPATH . '/single-proceso.php');
    
}else {
	include(TEMPLATEPATH . '/single-proyectos.php');
}

?>


<?php get_footer(); ?>
