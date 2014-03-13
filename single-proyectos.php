
<div id="single-proyectos">

	<div id="breadcrumbs">
	<?php the_breadcrumb(); ?>

	</div>
	
	<nav id="nav-below" class="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Ir proyecto anterior', 'wallarquitectura' ) . '</span> %title' , TRUE, $excluded_categories = '7' ); ?></div>
			<?php  $category = get_category_by_slug('proyectos');
            echo '<a class="btn_all" title="Ver todos los proyectos" href="'.get_category_link($category).'"></a>' ?>
		    <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Ir al siguiente proyecto', 'wallarquitectura' ) . '</span>', TRUE, $excluded_categories = '7' ); ?></div>
		    
	</nav><!-- #nav-below -->


	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php  $rows = get_field('galeria_proyecto');  ?>
			<?php if($rows) { ?>
		    <div id="proyect-gallery" class="gallery flexslider">
			   <ul class="slides"> 
			   	<?php foreach($rows as $row) { ?>
			   	 <li> <img src="<?php bloginfo('template_url') ?>/scripts/timthumb.php?src=<?php echo $row['imagen_proyecto'] ?>&h=480"/> </li>
			   	<?php	} ?>
			   	</ul>
			</div>
			<?php } ?>
				
			<div class="col_IZ">
				
				<div class="entry-top">
					
					<?php //the_meta() ?>
					
					<h1><?php the_title(); ?></h1>

					<?php if( get_field('ubicacion') ) { ?>
					<h4><?php the_field('ubicacion'); ?></h4>
					<?php } ?>
					
				</div>
				
				<div class="entry-content">

					<?php if( get_field('ano_del_proyecto') ) { ?>
					<div class="data">
						<span><?php _e('Año','wallarquitectura') ?></span>
						<span class="strong"><?php the_field('ano_del_proyecto'); ?></span>
					</div>
					<?php } ?>
					
					<?php if( get_field('superficie_construida') ) { ?>
					<div class="data">
						<span><?php _e('Superficie Construida','wallarquitectura') ?></span>
						<span class="strong"><?php the_field('superficie_construida'); ?>m<sup>2</sup></span>
					</div>
					<?php } ?>
					
					<?php if( get_field('superficie_terreno') ) { ?>
					<div class="data">
						<span><?php _e('Superficie Terreno','wallarquitectura') ?></span>
						<span class="strong"><?php the_field('superficie_terreno'); ?>m<sup>2</sup></span>
					</div>
					<?php } ?>					
					
					
					<a class="btn_mapa btn_share social-desktop" target="_blank" href="javascript:void(0)">compartir</a>
					
					<div id="post-social" class="clearfix social-desktop">
						<?php echo do_shortcode('[social_share/] '); ?>
					</div>

				</div><!-- .entry-content -->
				
									
			</div>
			
			<div class="col_DE">
			
				<div class="content">
					<?php the_content(); ?>
				</div>

		    </div>
		    
		    <a class="btn_mapa btn_share social-movil" target="_blank" href="javascript:void(0)">compartir</a>
															
		</article><!-- #post-## -->
						
		<div class="clearfix"></div>
		
		<div class="entry-utility clearfix">
				<?php edit_post_link( __( 'Editar', 'wallarquitectura' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-utility -->

	
				
	<?php endwhile; // end of the loop. ?>

</div>

