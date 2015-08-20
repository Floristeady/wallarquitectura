<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
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
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'wallarquitectura' ), 'after' => '' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'wallarquitectura' ), '', '' ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
				
<?php endwhile; ?>

<?php get_footer(); ?>