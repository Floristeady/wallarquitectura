
<div id="single-proyectos">

	<!-- Breadcrumb -->
	<div id="breadcrumbs">
	<?php the_breadcrumb(); ?>
	</div>
	
	<nav id="nav-below" class="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Ir proyecto anterior', 'boilerplate' ) . '</span> %title' , TRUE, $excluded_categories = '7' ); ?></div>
			<?php  $category = get_category_by_slug('proyectos');
            echo '<a class="btn_all" title="Ver todos los proyectos" href="'.get_category_link($category).'"></a>' ?>
		    <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Ir al siguiente proyecto', 'boilerplate' ) . '</span>', TRUE, $excluded_categories = '7' ); ?></div>
		    
	</nav><!-- #nav-below -->


	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<div class="col_IZ">
						
						<div class="entry-top">
							<span class="info_dot"></span>
							<h1><?php the_title(); ?></h1>
							<?php  if((get_post_meta($post->ID, 'lugar', true))) { ?>
							<h4><?php echo get_post_meta($post->ID, 'lugar', true); ?></h4>
							<?php } ?>
							
							<a href="#" class="btn_info">+INFO</a>
						</div>
						
						<div class="entry-content">
							<?php  if((get_post_meta($post->ID, 'year', true))) { ?>
							<div class="data">
								<span>Año</span>
								<span class="strong"><?php echo get_post_meta($post->ID, 'year', true); ?></span>
							</div>
							<?php } ?>
							
							<?php  if((get_post_meta($post->ID, 'superficie', true))) { ?>
							<div class="data">
								<span>Superficie</span>
								<span class="strong"><?php echo get_post_meta($post->ID, 'superficie', true); ?>m<sup>2</sup></span>
							</div>
							<?php } ?>
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
						</div><!-- .entry-content -->
					
					</div>
					
					<div class="col_DE">
					<?php
				    	$gallery_shortcode = '[gallery id=post_ID"' . intval( $post->post_parent ) . '"]';
				    	print apply_filters( 'the_content', $gallery_shortcode );
					 ?>
					 
					</div>
					
					<footer class="entry-utility">
						<?php edit_post_link( __( 'Editar', 'boilerplate' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-utility -->
					
				</article><!-- #post-## -->
				
				<div class="clearfix"></div>
			
				
	<?php endwhile; // end of the loop. ?>

</div>

