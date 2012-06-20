<ul class="list-categories">
		
	<li class="cat-item"><a href="/?cat=6" rel="todos" class="all" title="Ver todos los proyectos">Todos</a></li>
	
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
