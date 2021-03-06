<?php
/**
 * Loop Index
 * @package WordPress
 * @subpackage Wall
 * @since wall 2.0
 */
?>
	<div id="home-gallery" class="">
	
		<ul class="slides">
			<?php query_posts('showposts=3&category_name=slogan'); ?> 
		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		    <li>
				    
			    	<?php //Obtenemos la url de la imagen destacada
					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'original'));
					$thumbnailsrc = "";
					if (!empty($domsxe))
						$thumbnailsrc = $domsxe->attributes()->src;?>
				      
				     <?php  if((get_post_meta($post->ID, 'icon_slogan', true))) { ?>
				     	<span class="line l-left"></span>
				     	<span class="line l-right"></span>
				     	<img class="icono" alt ="<?php the_title();?>" src="<?php echo get_post_meta($post->ID, 'icon_slogan', true); ?>">
				     <?php } ?>
				      
			         <h1><?php the_title();?></h1>
			        
			         <h4><?php $excerpt = $post->post_excerpt;
						 $excerpt = strip_tags($excerpt);
						 $excerpt = substr($excerpt, 0, 180);
				      echo $excerpt ?>...</h4>
					        
				      
				      <?php  if((get_post_meta($post->ID, 'btn_titulo', true))) { ?>
				      
					      <span class="line-two l2-left"></span>
					      <span class="line-two l2-right"></span>
					      
					      <a class="btn_more" title="Ver m&aacute;s" href="<?php echo get_post_meta($post->ID, 'url', true); ?>" class="btn"><?php echo get_post_meta($post->ID, 'btn_titulo', true); ?></a>

				      <?php } ?>
				      
				      <img class="this" alt="<?php the_title();?>" title="<?php print $thumbnailsrc; ?>">
			</li>	
							            
			<?php endwhile; endif; ?>
			<!--#end-->
			
		</ul>
		
	</div>
			
	<ul id="home-projects">	
	<?php query_posts('showposts=3&category_name=destacado'); ?> 
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
	 <li class="home-project column-three">
	 
		   <a href="<?php the_permalink();?>" class="img" title="">
					<?php $attachments = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order'));
					if ( ! is_array($attachments) ) continue;
					$count = count($attachments);
					$first_attachment = array_shift($attachments);?>
				    <?php echo wp_get_attachment_image($first_attachment->ID, "medium"); ?>
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

	<?php endwhile; endif; ?>
	<!--#end-->
	 </ul>
	
<div id="home-housing">
		<div class="content-center">
			<h1>Venta de Casa</h1>
			<span class="line"></span>
			<h2>También hacemos proyectos inmobiliarios. <br/>Revisa nuestros <a href="">proyectos en venta</a>, contáctanos para más información. </h2>
		
		<?php query_posts('showposts=3&category_name=destacado'); ?> 
	    <?php if (have_posts()) : ?>
	    <ul id="home-featured">
	    <?php while (have_posts()) : the_post(); ?>
	
			<li>
				 <a href="<?php the_permalink();?>" title="">
				  <?php $attachments = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order'));
					if ( ! is_array($attachments) ) continue;
					$count = count($attachments);
					$first_attachment = array_shift($attachments);
					$attachment_id = $first_attachment->ID; // attachment ID
					$image_attributes = wp_get_attachment_image_src( $attachment_id ); // returns an array?> 
					<div class="front"><img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>"></div>
				 	<div class="back"><span><?php the_title();?></span></div>
					
			    </a>
			</li>
			
		
		<?php endwhile; ?> </ul> <?php endif; ?>
		
		</div>
	</div>
