<ul class="submenu-cat">
	
	<?php 
		$category = get_category_by_slug('inmobiliaria');

		echo '<li class="all cat-item"><a class="all" title="Ver todos los proyectos" href="'.get_category_link($category).'">todos los Proyectos</a></li>';

	?>
	
	
	<?php
	
	$args = array(
		'orderby'            => 'name', 
		'style'              => 'list',
		'title_li'           => '',
		'child_of'           => 7
		);

		$category = get_category_by_slug( 'inmobiliaria' );
		wp_list_categories($args);
		
	?>
		
</ul>
