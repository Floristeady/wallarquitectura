<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); 

$post = $wp_query->post;

if ( in_category ('Proyectos') ) {
    include(TEMPLATEPATH . '/single-proyectos.php');
} else if ( in_category('Inmobiliaria') ) {
    include(TEMPLATEPATH . '/single-inmobiliaria.php');
}

?>


<?php get_footer(); ?>
