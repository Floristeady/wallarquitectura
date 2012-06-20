<ul class="list-categories">
	
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
