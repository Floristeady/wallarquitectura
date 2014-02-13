<ul class="submenu-cat">

	<?php 
		$category = get_category_by_slug('proyectos');

		echo '<li class="all cat-item"><a class="all" title="Ver todos los proyectos" href="'.get_category_link($category).'">Todos</a></li>';

	?>
	
	<?php
	$category = get_category_by_slug( 'proyectos' );
	
	$args = array(
		'orderby'            => 'none', 
		'style'              => 'list',
		'title_li'           => '',
		'child_of'           => $category->term_id
		);

		wp_list_categories($args);
				
	?>
	
	
	
		
</ul>
