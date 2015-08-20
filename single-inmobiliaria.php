
<div id="single-inmobiliaria">

		<div id="breadcrumbs">
		<?php the_breadcrumb(); ?>
		</div>
		
		<nav id="nav-below" class="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Ir proyecto anterior', 'wallarquitectura' ) . '</span> %title' , TRUE ); ?></div>
			<?php  $category = get_category_by_slug('inmobiliaria');
            echo '<a class="btn_all" title="Ver todos los proyectos" href="'.get_category_link($category).'"></a>' ?>
		    <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Ir al siguiente proyecto', 'wallarquitectura' ) . '</span>', TRUE); ?></div>
		    
	</nav><!-- #nav-below -->


		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>					
									
				    <div class="col_IZ">   
						
						<?php  $rows = get_field('galeria_proyecto');  ?>
						<?php if($rows) { ?>
						 <div id="housing-gallery" class="gallery flexslider">
						    
						    <span class="sale">EN VENTA /<span class="icon-dollar"></span></span>

							 <ul class="slides"> 
							   	<?php foreach($rows as $row) { ?>
							   	 <li> <img src="<?php bloginfo('template_url') ?>/scripts/timthumb.php?src=<?php echo $row['imagen_proyecto'] ?>&h=520"/> </li>
							   	<?php	} ?>
							 </ul>

							<?php } ?>
						</div>
						
						 <div class="info">
						    	<p>						  											
								<?php if( get_field('numero_habitaciones') ) { ?>
								<span class="icon-person193"> <?php the_field('numero_habitaciones'); ?>     <?php _e(' Habitaciones', 'wallarquitectura') ?> / </span> 							
								<?php } ?>
								
								<?php if( get_field('numero_de_banos') ) { ?>
							    <span class="icon-classic2"> <?php the_field('numero_de_banos'); ?><?php _e(' Baños', 'wallarquitectura') ?> / </span>
							    <?php } ?>
							    
							     <?php if( get_field('superficie_construida') ) { ?>
						 	<span class="icon-home"><?php the_field('superficie_construida'); ?>m<sup>2</sup> Construido /</span>
						 	  <?php } ?>
						 	  
						 	  <?php if( get_field('superficie_terreno') ) { ?>
						 	<span class="icon-protractor1"><?php the_field('superficie_terreno'); ?>m<sup>2</sup> Terreno</span>
						 	  <?php } ?>
							   </p>
							   
					    </div>


						<div class="content">
							<?php the_content(); ?>
						</div>
							
				   </div>
				   
				   
				   <div class="col_DE">
						
						<div class="entry-top">
							<h1><?php the_title(); ?></h1>
							
							<?php if( get_field('ubicacion') ) { ?>																	<h4><?php the_field('ubicacion'); ?></h4>
							<?php } ?>
						</div>
						
						<div class="entry-content">
							
							<?php if( get_field('telefonos') ) { ?>
							<div class="data">
								<span><?php _e('Teléfono(s) Ventas','wallarquitectura') ?></span>
								<span class="bold"><?php the_field('telefonos'); ?></span>
							</div>
							<?php } ?>
							
							
							<?php if( get_field('direccion') ) { ?>	
							<div class="data">
								<span><?php _e('Ubicación','wallarquitectura') ?></span>
								<span class="bold"><?php the_field('direccion'); ?></span>							
							<?php if( get_field('mapa_de_google') ) { ?>	
								<a class="btn_mapa icon-location" target="_blank" href="<?php the_field('mapa_de_google'); ?>"><?php _e('ver mapa ubicación','wallarquitectura') ?></a>
							    <?php } ?>
							</div>
							<?php } ?>
							
							
							<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
							<?php if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) { ?>
							   <div class="form">
							     <?php echo do_shortcode('[contact-form-7 id="647" title="Formulario Inmobiliaria"]'); ?>
							   </div>
							<?php } ?>
							
							
							<div id="post-social-inm" class="clearfix social-desktop">	
								<?php echo do_shortcode('[social_share/] '); ?>
							</div>
														
						</div>
					
					</div>
					<!--fin col_DE-->

			</article>

		<?php endwhile; // end of the loop. ?>
</div>
