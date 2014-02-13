
<div id="single-inmobiliaria">
		<!-- Breadcrumb -->
		<div id="breadcrumbs">
		<?php the_breadcrumb(); ?>
		</div>
		
		<nav id="nav-below" class="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Ir proyecto anterior', 'boilerplate' ) . '</span> %title' , TRUE, $excluded_categories = '6', '11', '12' ); ?></div>
			<?php  $category = get_category_by_slug('proceso');
            echo '<a class="btn_all" title="Ver todos los proyectos" href="'.get_category_link($category).'"></a>' ?>
		    <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Ir al siguiente proyecto', 'boilerplate' ) . '</span>', TRUE, $excluded_categories = '6', '11', '12' ); ?></div>
		    
	</nav><!-- #nav-below -->


		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<div class="col_IZ">
						
						<div class="entry-top">
							<h1><?php the_title(); ?></h1>
							<?php  if((get_post_meta($post->ID, 'custom_ubicacion', true))) { ?>
							<h4><?php echo get_post_meta($post->ID, 'custom_ubicacion', true); ?></h4>
							<?php } ?>
						</div>
						
						<div class="entry-content">
							
							<?php  if((get_post_meta($post->ID, 'custom_superficie', true))) { ?>
							<div class="data">
								<span>Superficie Construida</span>
								<span class="bold"><?php echo get_post_meta($post->ID, 'custom_superficie', true); ?>m<sup>2</sup></span>
							</div>
							<?php } ?>
							
							<?php  if((get_post_meta($post->ID, 'custom_superficie_terreno', true))) { ?>
							<div class="data">
								<span>Superficie Terreno</span>
								<span class="strong"><?php echo get_post_meta($post->ID, 'custom_superficie_terreno', true); ?>m<sup>2</sup></span>
							</div>
							<?php } ?>
							
													
							<?php  if((get_post_meta($post->ID, 'custom_select', true))) { ?>
							<div class="data">
								<span>Año</span>
								<span class="bold"><?php echo get_post_meta($post->ID, 'custom_select', true); ?></span>
							</div>
							<?php } ?>
							
							<div id="post-social-inm" class="clearfix social-desktop">
							
								<?php echo do_shortcode('[social_share/] '); ?>
							</div>
				 
							
														
						</div><!-- .entry-content -->
					
					</div>
					<!--fin col_DE-->
					
									
				    <div class="col_DE">
				    
				    	<div class="content">
							<?php the_content(); ?>
						</div>
						
						<div id="housing-gallery" class="gallery flexslider">
						   <div class="slides"> 
						  	
		                    
						    	<?php
								$args = array(
								    'post_type' => 'attachment',
								    'numberposts' => null,
								    'post_parent' => $post->ID,
								    'post_mime_type' => 'image',
								    'orderby'    => 'title',
								    'order'    => 'ASC',
								    'exclude' => get_post_thumbnail_id($post->ID)
								);
								$attachments = get_posts($args);
								if ($attachments) {
								    foreach ($attachments as $attachment) {
								        //Tamaños: "thumbnail", "medium", "large", "full"
								        $image_atts = wp_get_attachment_image_src( $attachment->ID, 'full' ); 
								        $alt_text = get_post_meta($post->ID, '_wp_attachment_image_alt', true); ?>
								        
							 
								      <img src="<?php echo $image_atts[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_atts[1]; ?>" height="<?php echo $image_atts[2]; ?>" />
								    <?php
								    }
								}
								?>
		
							</div>
						</div><!--/gallery -->
						
						<div id="carousel" class="flexslider">
						   <div class="slides"> 
						  	
		                    
						    	<?php
								$args = array(
								    'post_type' => 'attachment',
								    'numberposts' => null,
								    'post_parent' => $post->ID,
								    'post_mime_type' => 'image',
								    'orderby'    => 'title',
								    'order'    => 'ASC',
								    'exclude' => get_post_thumbnail_id($post->ID)
								);
								$attachments = get_posts($args);
								if ($attachments) {
								    foreach ($attachments as $attachment) {
								        //Tamaños: "thumbnail", "medium", "large", "full"
								        $image_atts = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' ); 
								        $alt_text = get_post_meta($post->ID, '_wp_attachment_image_alt', true); ?>
								        
							 
								      <img src="<?php echo $image_atts[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_atts[1]; ?>" height="<?php echo $image_atts[2]; ?>" />
								    <?php
								    }
								}
								?>
								
							</div>
						</div><!--/gallery -->

					</div>
					<!--fin col_IZ-->
					
					
					<div id="post-social-inm" class="clearfix social-movil">
								<?php echo do_shortcode('[social_share/] '); ?>
					</div>
					

					</article><!-- #post-## -->
				
				
				<div class="clearfix"></div>
				
				<div class="entry-utility clearfix">
						<?php edit_post_link( __( 'Editar', 'boilerplate' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->

	<?php endwhile; // end of the loop. ?>
</div>
