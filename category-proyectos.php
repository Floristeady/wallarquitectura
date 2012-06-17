<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>

				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '' . $category_description . '';

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				
				get_template_part( 'loop', 'category' ); */
				?>
				
				<ul id="projects">
				<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
			        <li class="project-item">
			           
			            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			            	<span class="over_title"><h4><?php the_title() ?></h4></span>
			            
			            	<span class="img"><?php the_post_thumbnail(array(236,232));?></span>
			         
			            </a>
			            
				     </li>
			     <?php
				endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_query(); ?>
				</ul>


<?php get_footer(); ?>