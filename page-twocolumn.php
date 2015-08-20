<?php
/**
 * Template Name: P&aacute;gina dos columnas
 *
 * A custom page template without sidebar.
 *
 *
 * @package WordPress
 * @subpackage wallarquitectura
 * @since wallarquitectura 1.0
 */

get_header(); ?>

<!-- Breadcrumb -->
<div id="breadcrumbs">
	<?php the_breadcrumb(); ?>
</div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				
				<h1 class="title-two-column"><?php the_title(); ?></h1>
				<div class="two-column">
				<?php the_content(); ?>
				</div>
				<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'wallarquitectura' ), 'after' => '' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'wallarquitectura' ), '', '' ); ?>

<?php endwhile; ?>

<?php get_footer(); ?>