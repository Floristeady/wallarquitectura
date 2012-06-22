<?php
/**
 * The template for displaying Category Proyectos.
 *
 */

get_header(); ?>
		
		<?php include (TEMPLATEPATH . '/include/submenu.php'); ?>

		<!--PHP para dividir proyecto por post-->
		<?php	
		 $my_query = new WP_Query( array( 
		    'post_type' => 'post', 
		    'paged' => $paged,
		    'posts_per_page' => 12, 
		    'order' => 'DESC',
		    'cat' => $cat
		) );

		echo '<ul id="projects">';
		if ($my_query ->have_posts()) : while ( $my_query->have_posts() ) : $my_query->the_post();
		
		    if (  $my_query->current_post == 1  ||  $my_query->current_post == 5 ||  $my_query->current_post == 7 ||  $my_query->current_post == 9 ){ ?>
		        <li class="project-item large">
		        	<a class="btn_proyecto" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		        		<span class="over_title_large"><h4><?php the_title() ?></h4></span>
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
			 			
			 			 	
					 </a>
				</li>
					 
		    <?php /* Los otros proyectos  */
		    } else  { ?>
		       <li class="project-item">
		        	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		        		<span class="over_title_small"><h4><?php the_title() ?></h4></span>
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
			 			</a>
			 			
			 	</li>

		  <?php } endwhile;   echo '</ul>';
			  		/* Display navigation to next/previous pages when applicable */ 
					if(function_exists('wp_pagenavi')) { 
							wp_pagenavi( array(
							'query' =>$my_query 
						)); 
					}
				endif; ?>
				
		  
		<?php //wp_pagenavi( array( 'type' => 'multipart' ) ); ?>

		
		<?php wp_reset_query(); ?>
				

<?php get_footer(); ?>