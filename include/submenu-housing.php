<ul class="submenu-cat">
	
	<?php 
		$category = get_category_by_slug('inmobiliaria');

		echo '<li class="all cat-item"><a class="all" title="Ver todos los proyectos" href="'.get_category_link($category).'">todos los Proyectos</a></li>';

	?>
	
	
	<?php
	
	$category = get_category_by_slug( 'inmobiliaria' );

	
	$args = array(
		'orderby'            => 'name', 
		'style'              => 'list',
		'title_li'           => '',
		'child_of'           => $category->term_id
		);

		wp_list_categories($args);
		
	?>
		
</ul>
