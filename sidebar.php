<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage wallarquitectura
 * @since wallarquitectura 1.0
 */
?>


<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>

			<ul class="widget-list">
				<?php dynamic_sidebar( 'primary-widget-area' ); ?>
			</ul>

<?php endif; ?>