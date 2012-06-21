
<div id="single-inmobiliaria">
		<!-- Breadcrumb -->
		<div id="breadcrumbs">
		<?php the_breadcrumb(); ?>
		</div>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<div class="col_DE">
						
						<div class="entry-top">
							<h1><?php the_title(); ?></h1>
						</div>
						
						<div class="entry-content">
							<?php the_content(); ?>
							
							<?php  if((get_post_meta($post->ID, 'superficie', true))) { ?>
							<div class="data">
								<span>Superficie</span>
								<span class="bold"><?php echo get_post_meta($post->ID, 'superficie', true); ?>m<sup>2</sup></span>
							</div>
							<?php } ?>
							
							
							<?php  if((get_post_meta($post->ID, 'direccion', true))) { ?>
							<div class="data">
								<span>Ubicación</span>
								<span class="bold"><?php echo get_post_meta($post->ID, 'direccion', true); ?></span>							<a class="btn_mapa" target="_blank" href="<?php echo get_post_meta($post->ID, 'mapa', true); ?>">Ver mapa</a>
							</div>
							<?php } ?>
							
							
							<?php  if((get_post_meta($post->ID, 'telefono', true))) { ?>
							<div class="data">
								<span>Teléfono de contacto</span>
								<span class="bold"><?php echo get_post_meta($post->ID, 'telefono', true); ?></span>
							</div>
							<?php } ?>

						
							<?php  if((get_post_meta($post->ID, 'año', true))) { ?>
							<div class="data">
								<span>Año</span>
								<span class="bold"><?php echo get_post_meta($post->ID, 'año', true); ?></span>
							</div>
							<?php } ?>
							
							
							<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
						</div><!-- .entry-content -->
					
					</div>
					<!--fin col_DE-->
					
					<div class="col_IZ">
						<?php
					    	$gallery_shortcode = '[gallery id=post_ID"' . intval( $post->post_parent ) . '"]';
					    	print apply_filters( 'the_content', $gallery_shortcode );
						 ?>
					 
					</div>
					<!--fin col_IZ-->

					<footer class="entry-utility">
						<?php edit_post_link( __( 'Editar', 'boilerplate' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-utility -->
				</article><!-- #post-## -->
				
				<div class="clearfix"></div>
				<div id="comments">
					<?php comments_template( '', false ); ?>
			   </div>
	<?php endwhile; // end of the loop. ?>
</div>
