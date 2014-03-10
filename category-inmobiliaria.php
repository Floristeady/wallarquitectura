<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage wallarquitectura
 * @since wallarquitectura 1.0
 */

get_header(); ?>

				<?php include (TEMPLATEPATH . '/include/submenu-housing.php'); ?>

				<?php $post_categories = wp_get_post_categories(!wp_verify_nonce(isset($post_id)));
					$cats = array();
				?>
				
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
			 			  <span class="sale"><?php _e('SE VENDE /', 'wallarquitectura')?><span class="icon-dollar"></span></span>
			 			  <div class="more-info">
			 			  	   <p>
			 			  	  <?php if( get_field('superficie_construida') ) { ?>
				 			   <span class="icon-home"><?php the_field('superficie_construida'); ?>m<sup>2</sup></span>
				 			  <?php } ?>
				 			  
				 			  <?php if( get_field('numero_habitaciones') ) { ?>
					 		  <span class="icon-person193"><?php the_field('numero_habitaciones'); ?> <?php _e('Habitaciones','wallarquitectura') ?></span> 
					 		  <?php } ?>
					 		  
					 		  <?php if( get_field('numero_de_banos') ) { ?>
					 		  <span class="icon-classic2"><?php the_field('numero_de_banos'); ?> <?php _e('Baños','wallarquitectura') ?></span></p>
					 		  <?php } ?>
					 		  </p>
			 			  </div>
			 			  
			 			<img src='<?php bloginfo('template_url') ?>/scripts/timthumb.php?src=<?php print $thumbnailsrc; ?>&w=490' border=0 /></span>
			 			<?php
			 			endif;
			 			?>  
			 			
			 			<span class="info">
		        			<span class="h2"><?php the_title() ?></span>
		        			
		        			<!--BORRAR-->
		        			<span class="h4"><span class="bold">Ubicación: </span>
		        				<?php echo get_post_meta($post->ID, 'custom_ubicacion', true); ?>
							</span>
							<!--/BORRAR-->
							
							<?php if( get_field('ubicacion') ) { ?>	
							<span class="h4">
							<span class="bold"><?php _e('Ubicación:','wallarquitectura') ?></span>
							<?php the_field('ubicacion'); ?></span>
							<?php } ?>
							
		        		</span>

			 			
			 			 	
					 </a>
				</li>

			<?php endwhile;
			echo '</ul>'; ?>
			
			<?php wp_reset_query(); ?>
				

<?php get_footer(); ?>