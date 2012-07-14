<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>

			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			
			 get_template_part( 'loop', 'index' ); */
			?>
			
			
			<div id="container-slide">
				<?php 
				/* Show slideshow project by category "destacado" and by date */
					$args = array(
						'category_name'=> 'destacado',
						'order'    => 'date'
						);
				query_posts($args) ?>
				
			    <ul id="slideshow">
				<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
			        <li class="slide">
			           
			            <a href="<?php the_permalink() ?>" rel="bookmark" title="Ir a <?php the_title_attribute(); ?>">
			            <span class="text">Proyecto</span>
			            <span class="title"><?php the_title() ?></span>
			            <?php //<span class="img"> the_post_thumbnail(array(960,516));</span>?>
			            
			            <?php  if((get_post_meta($post->ID, 'destacada_img', true))) { ?>
								 <span class="img"><img src="<?php echo get_post_meta($post->ID, 'destacada_img', true); ?>" alt="<?php the_title() ?>"/></span>
							<?php } ?>
			           
			            </a>
			            
				     </li>
			     <?php
				endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_query(); ?>
				</ul>
				
				<div id="nav"></div>
			</div>

<?php get_footer(); ?>