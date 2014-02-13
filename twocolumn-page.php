<?php
/**
 * Template Name: Two column, no sidebar
 *
 * A custom page template without sidebar.
 *
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
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
				<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'boilerplate' ), '', '' ); ?>

<?php endwhile; ?>

<?php get_footer(); ?>