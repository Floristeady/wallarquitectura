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
		
		<?php $my_query = new WP_Query( array( 
		    'post_type' => 'post', 
		    'posts_per_page' => 12, 
		    'order' => 'DESC'
		) );
		
		echo '<ul id="projects">';
		
		while ( $my_query->have_posts() ) : $my_query->the_post();
		
		    if (  $my_query->current_post == 1  ||  $my_query->current_post == 5 ||  $my_query->current_post == 7 ||  $my_query->current_post == 9 ){ ?>
		        <li class="project-item">
		        	<a class="btn_proyecto" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		        		<span class="over_title"><h4><?php the_title() ?></h4></span>
		            	<?php //Obtenemos la url de la imagen destacada
    					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'large'));
    					$thumbnailsrc = "";
    					if (!empty($domsxe))
							$thumbnailsrc = $domsxe->attributes()->src;
						if (!empty($thumbnailsrc)):
						?>
			 			<span class='img'><img src='<?php bloginfo('template_url') ?>/scripts/timthumb.php?src=<?php print $thumbnailsrc; ?>&w=464&h=236' border=0 /></span>
			 			<?php
			 			endif;
			 			?>    
		        	</a></li>
		    <?php
		    } else  { ?>
		       <li class="project-item">
		        	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		        		<span class="over_title"><h4><?php the_title() ?></h4></span>
		            	<?php //Obtenemos la url de la imagen destacada
    					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'large'));
    					$thumbnailsrc = "";
    					if (!empty($domsxe))
							$thumbnailsrc = $domsxe->attributes()->src;
						if (!empty($thumbnailsrc)):
						?>
			 			<span class='img'><img src='<?php bloginfo('template_url') ?>/scripts/timthumb.php?src=<?php print $thumbnailsrc; ?>&w=236&h=236' border=0 /></span>
			 			<?php
			 			endif;
			 			?>    
		        	</a></li>

		  <?php   }
		
		endwhile;
		
		echo '</ul>';?>
		<?php wp_reset_query(); ?>

<?php get_footer(); ?>