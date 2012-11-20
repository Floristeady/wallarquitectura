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
			<?php query_posts('showposts=2&category_name=slogan'); ?> 
		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		    <li>
				    
			    	<?php //Obtenemos la url de la imagen destacada
					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'original'));
					$thumbnailsrc = "";
					if (!empty($domsxe))
						$thumbnailsrc = $domsxe->attributes()->src;?>
				        
			        <h1><?php the_title();?></h1>
			        
			         <h4><?php $excerpt = $post->post_excerpt;
						 $excerpt = strip_tags($excerpt);
						 $excerpt = substr($excerpt, 0, 180);
				      echo $excerpt ?>...</h4>
					            
				      <img title="<?php print $thumbnailsrc; ?>">
					
			</li>	
							            
			<?php endwhile; endif; ?>
			<!--#end-->
			
		</ul>
		
	</div>
			
	<ul id="home-items">	
	<?php query_posts('showposts=3&category_name=destacado'); ?> 
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
	 <li class="home-project column-three">
	 
		   <?php //$current_post_categories = get_the_category(); 		
			 // foreach( $current_post_categories as $category) {
		   // if your permalinks are set to use the category's name for the URL, use:
		  // echo '<a class="title-news" href="/?cat='.$category->cat_ID.'">'.$category->cat_name.'</a>';} ?>
		
		   <a class="item-proyect" href="<?php the_permalink();?>" title="Ver m&aacute;s del proyecto">
				<span class="title-featured"><?php the_title();?></span>
			
			
				<?php if (!empty($post->post_excerpt)){ ?>
		            <p><?php $excerpt = $post->post_excerpt;
		            								 $excerpt = strip_tags($excerpt);
		            								 $excerpt = substr($excerpt, 0, 180);
		            echo $excerpt ?>...</p>
		            <?php } else { ?>
		            <p><?php $content = $post->post_content;
		            								  $content = strip_tags($content);
		            								  $content = substr($content, 0, 180);
		            echo $content ?>...</p> <?php } ?>	
		            				
		           <span class="btn-more">conoce el proyecto<span class="arrow"></span> 
		      </a>
		     
		 </li>

	<?php endwhile; endif; ?>
	<!--#end-->
	 </ul>
	
