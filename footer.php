<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?>
		</section><!-- #main -->
		<footer id="footer" role="contentinfo">
			<div id="content-footer">
<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
			</div>
		</footer><!-- footer -->
		
	<?php wp_reset_query(); ?>
    <?php  if (!is_home()) { ?>	
		<?php query_posts('showposts=1&category_name=slogan'); ?> 
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div id="backstretch">
	        		
		</div>
		<?php endwhile; endif; ?>
		<!--#end-->
	<?php } ?>
		
	<div>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>
	</body>
</html>