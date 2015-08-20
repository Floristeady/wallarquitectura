<?php
/**
 * Template Name: P&aacute;gina de Inicio
 *
 *
 * @package WordPress
 * @subpackage wallarquitectura
 * @since wallarquitectura 1.0
 */

get_header(); ?>

	<?php if (have_posts()) : ?>
	<div id="home-gallery" class="home">
		
		<ul class="slides">
		    <?php while (have_posts()) : the_post(); ?>
		    <?php  $rows = get_field('slider');  ?>
		    
		    <?php if($rows) { ?>
			<?php foreach($rows as $row) { ?>
		    <li>
		             <?php  if( $row['icono_slider'] ) { ?>
				     	<span class="line l-left"></span>
				     	<span class="line l-right"></span>
				     	<img class="icono" alt ="<?php echo $row['titulo_slider'] ?>" src="<?php echo $row['icono_slider'] ?>">
				     <?php } ?>
				      
			         <h1><?php echo $row['titulo_slider'] ?></h1>
			        
			         <h4><?php echo $row['texto_descripcion_slider'] ?></h4>
					        
				      
				      <?php  if($row['texto_boton_slider']) { ?>
				      
					      <span class="line-two l2-left"></span>
					      <span class="line-two l2-right"></span>
					      
					      <a class="btn_more" title="Ver m&aacute;s" href="<?php echo $row['link_slider'] ?>" class="btn"><?php echo $row['texto_boton_slider'] ?></a>

				      <?php } ?>
				      
				      <img class="this" alt="<?php the_title();?>" title="<?php echo $row['imagen_slider'] ?>">
			</li>	
			
			<?php } ?>
			
			<?php } ?>		
				
		    <?php wp_reset_postdata();?>
							            
			<?php endwhile;?>
			<!--#end-->
			
		</ul>
		
	</div>
	 <?php endif; ?>
			
	
	<?php $args = array(
			'post_type'	=> 'post',
			'posts_per_page' => 3,
			'meta_query' => array(
				array( 'key' => 'proyecto_destacado', 'value' => '1')
			) );
		$featured_project = new WP_Query( $args ); ?>
		
	<?php if ( $featured_project->have_posts() ) : ?>
	<div id="home-projects">
		<h2 class="title"><?php _e('Nuestros Proyectos Destacados', 'wallarquitectura'); ?></h2>
		<ul>	
				<?php while ( $featured_project->have_posts() ) : $featured_project->the_post(); ?>
		
		   <li class="home-project column-three">
		 
			   <a href="<?php the_permalink();?>" class="img" title="">
					<?php 
					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'big'));
					$thumbnailsrc = "";
					if (!empty($domsxe))
						$thumbnailsrc = $domsxe->attributes()->src;
				?>
					<img src="<?php bloginfo('template_url') ?>/scripts/timthumb.php?src=<?php print $thumbnailsrc; ?>&w=400&h=240"> 
				</a>
				
			   <div class="item-project">
			   
			   		<div class="allcats">
				<?php foreach((get_the_category()) as $category) {
				    	if ($category->cat_name != 'Destacado' && $category->cat_name != 'Venta de Casas') {
				    	echo '<a class="cat" href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "Ver todos los proyectos" ), $category->name ) . '" ' . '>' . $category->name.'</a> ';} 
				    	
				    	if ($category->cat_name == 'Inmobiliaria'){
					    	echo '<span class="sale">SE VENDE</span>';
				    	}
				    } ?>
				   </div>
			
	
					<a href="<?php the_permalink();?>" title="Ver m&aacute;s del proyecto" class="title-featured"><?php the_title();?></a>
	
					<?php if (!empty($post->post_excerpt)){ ?>
			            <p><?php $excerpt = $post->post_excerpt;
			            								 $excerpt = strip_tags($excerpt);
			            								 $excerpt = substr($excerpt, 0, 130);
			            echo $excerpt ?>...</p>
			            <?php } else { ?>
			            <p><?php $content = $post->post_content;
			            								  $content = strip_tags($content);
			            								  $content = substr($content, 0, 130);
			            echo $content ?>...</p> <?php } ?>	
			            				
			           <span class="btn-more">conoce el proyecto<span class="arrow">></span> 
			      </div>
		     
			 </li>
			 <?php endwhile; ?> 
		</ul>
	</div>
	<?php endif; ?>
	
	 
   <div id="home-housing">
   	 <div class="content-center">
	   	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php if( get_field('titulo_seccion_inmobiliaria') ) { ?>
				<h1><?php the_field('titulo_seccion_inmobiliaria'); ?></h1>
				<span class="line"></span>
			<?php } ?>
			
			<?php if( get_field('texto_seccion_inmobiliaria') ) { ?>
				<h2><?php the_field('texto_seccion_inmobiliaria'); ?></h2>
			<?php } ?>
		<?php endwhile; // end of the loop. ?>

		<?php $args = array(
			'post_type'	=> 'post',
			'posts_per_page' => 3,
			'meta_query' => array(
				array( 'key' => 'inmobilaria_destacado', 'value' => '1')
			) );
		$featured_sale = new WP_Query( $args ); ?>
		
	<?php if ( $featured_sale->have_posts() ) : ?>	

	    <ul id="home-featured">
	    <?php while ( $featured_sale->have_posts() ) : $featured_sale->the_post(); ?>
	
			<li>
				 <a href="<?php the_permalink();?>" title="">
				 <span style="display: none;" class="icon-dollar"></span>
				  <?php 
					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'thumbnail'));
					$thumbnailsrc = "";
					if (!empty($domsxe))
						$thumbnailsrc = $domsxe->attributes()->src;?> 
					<div class="front"><img src="<?php print $thumbnailsrc; ?>"></div>
					
				 	<div class="text-container">
					 	<h3><?php the_title();?> <span>(vendida)</span></h3>
					 	<?php if( get_field('superficie_construida') ) { ?>
					 	<p><span class="icon-home"><?php the_field('superficie_construida'); ?>m<sup>2</sup></span>
					 	<?php } ?>
					 	
					 	<?php if( get_field('numero_habitaciones') ) { ?>
						<span class="icon-person193"><?php the_field('numero_habitaciones'); ?> <?php _e('Habitaciones', 'wallarquitectura') ?></span> 
						<?php } ?>
						
						<?php if( get_field('numero_de_banos') ) { ?>
						<span class="icon-classic2"><?php the_field('numero_de_banos'); ?> <?php _e('Baños', 'wallarquitectura') ?></span></p>
						<?php } ?>
						
						<div class="button"> <?php _e('Más detalles', 'wallarquitectura') ?> </div>
					</div>
				
			    </a>
			</li>
			
		
		<?php endwhile; ?> </ul> 
		
		</div>
	</div>
	<?php endif; ?>
	
	</div>
	
<?php get_footer(); ?>
