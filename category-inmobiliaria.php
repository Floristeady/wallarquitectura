<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>

				<?php include (TEMPLATEPATH . '/include/submenu-housing.php'); ?>

				<!--Para obtener el ID de la categoria-->
				<?php $post_categories = wp_get_post_categories(!wp_verify_nonce(isset($post_id)));
					$cats = array();
				?>
				
				<!--PHP para dividir proyecto por post-->
				<?php	
				 $my_query = new WP_Query( array( 
				    'post_type' => 'post', 
				    'posts_per_page' => 6, 
				    'order' => 'DESC',
				    'cat' => $cat 
				) );
				
				echo '<ul id="housing">';
				
				while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				
				<li class="housing-item">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
	        		 
		            	<?php //Obtenemos la url de la imagen destacada
	    					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'large'));
	    					$thumbnailsrc = "";
	    					if (!empty($domsxe))
								$thumbnailsrc = $domsxe->attributes()->src;
							if (!empty($thumbnailsrc)):
						?>
						
						<?php
							$foo = getimagesize($thumbnailsrc);
							$width=$foo[0]; 
							$height=$foo[1];
						?>
			 			<span class='img'>
			 			  <span class="sale">SE VENDE</span>
			 			<img width="456" height="<?php echo $height ?>" src='<?php bloginfo('template_url') ?>/scripts/timthumb.php?src=<?php print $thumbnailsrc; ?>&w=456' border=0 /></span>
			 			<?php
			 			endif;
			 			?>  
			 			
			 			<span class="info">
		        			<span class="h2"><?php the_title() ?></span>
		        			
		        			<span class="h4"><span class="bold">Ubicación: </span>
		        				<?php echo get_post_meta($post->ID, 'custom_ubicacion', true); ?>
							</span>
							
		        		</span>

			 			
			 			 	
					 </a>
				</li>

			<?php endwhile;
			echo '</ul>'; ?>
			
			<?php wp_reset_query(); ?>
				

<?php get_footer(); ?>