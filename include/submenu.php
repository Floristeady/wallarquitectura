<ul class="submenu-cat">

	<?php 
		$category = get_category_by_slug('proyectos');

		echo '<li class="all cat-item"><a class="all" title="Ver todos los proyectos" href="'.get_category_link($category).'">Todos</a></li>';

	?>
	
	<?php
	
	$args = array(
		'orderby'            => 'name', 
		'style'              => 'list',
		'title_li'           => '',
		'child_of'           => 6
		);

		$category = get_category_by_slug( 'proyectos' );
		wp_list_categories($args);
	?>
	
		
</ul>
