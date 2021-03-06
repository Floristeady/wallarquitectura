<?php
/**
 * wallarquitectura functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, wallarquitectura_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'wallarquitectura_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage wallarquitectura
 * @since wallarquitectura 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 1024;

/** Tell WordPress to run wallarquitectura_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'wallarquitectura_setup' );

if ( ! function_exists( 'wallarquitectura_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override wallarquitectura_setup() in a child theme, add your own wallarquitectura_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function wallarquitectura_setup() {

    // Add gallery custom 	
	remove_shortcode('gallery');
	add_shortcode('gallery', 'wallarquitectura_gallery_shortcode');
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Uncomment if you choose to use post thumbnails; add the_post_thumbnail() wherever thumbnail should appear
	//add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'wallarquitectura', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array('primary' => __( 'Primary Navigation', 'wallarquitectura' ),) );
	
	register_nav_menus( array('secondary' => __( 'Secondary Navigation', 'wallarquitectura' ),) );
	
	register_nav_menus( array('third' => __( 'Third Navigation', 'wallarquitectura' ),) );

	}
endif;

if ( ! function_exists( 'steady_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in steady_setup().
 *
 * @since Twenty Ten 1.0
 */
function steady_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;



// Iniciar galeria personalizada para el theme single-proyectos
function wallarquitectura_gallery_shortcode($attr) {
    global $post;
 
    static $instance = 0;
    $instance++;
 
    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_gallery', '', $attr);
    if ( $output != '' )
        return $output;
 
    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }
 
    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'div',
        'icontag'    => 'div',
        'captiontag' => 'span',
        'columns'    => 1,
        'size'       => 'original',
        'currentid'  => '0'
    ), $attr));
 
    $id = intval($id);
    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
 
    if ( empty($attachments) )
        return '';
 
    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }
 
    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
 
    if (!is_mobile()) {
    	$selector = "gallery-{$instance}"; } 
    else {	$selector = "gallery-mobil{$instance}";
	    
    }
 
    $output = apply_filters('gallery_style', "
        <style type='text/css'>
            #{$selector} {
                margin: auto;
            }
            #{$selector} .gallery-item {
                float: left;
                margin-top: 10px;
                text-align: center;
                width: {$itemwidth}%;
            }
        </style>
        <div id='$selector' class='gallery galleryid-{$id}'>");
 
    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
        $currentclass = ($id == $currentid) ? 'gallery-current' : 'gallery-item';
 
        $output .= "<{$itemtag} class='$currentclass'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                $link
            </{$icontag}>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '';
    }
 
    $output .= "
        </div>\n";
 
    return $output;
}
// End Gallery   


// Insertar Breadcrumb    
function the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo get_option('home');
	        echo '">';
		echo "Inicio";
		echo "</a>    /   ";
		
		//Display breadcrumb for single post
        if (is_single()) { //check if any single post is being displayed.
            //Returns an array of objects, one object for each category assigned to the post.
            //This code does not work well (wrong delimiters) if a single post is listed
            //at the same time in a top category AND in a sub-category. But this is highly unlikely.
            $category = get_the_category();
            $delimiter = ' / ';
            $num_cat = count($category); //counts the number of categories the post is listed in.
 
            //If you have a single post assigned to one category.
            //If you don't set a post to a category, WordPress will assign it a default category.
            if ($num_cat = 1)  //I put less or equal than 1 just in case the variable is not set (a catch all).
            {
                echo get_category_parents($category[0],  true,' ' . $delimiter . ' ');
                echo "<span>";
                //Display the full post title.
                echo ' ' . get_the_title();
                echo "</span> ";
            }
            //then the post is listed in more than 1 category.
            else {
                //Put bullets between categories, since they are at the same level in the hierarchy.
                echo the_category( $delimiter1, multiple);
            }
            
        }

		/*Codigo anterior---respaldo
		if (is_category() || is_single()) {
			the_category('   /   ', 'single');
			if (is_single()) {
				echo "   /   <span>";
				the_title();
				echo "</span> ";
			}*/
		elseif (is_page()) {
		    echo " <span>";
			the_title();
			echo "</span> ";
		}
	}
}    
// end breadcrumb



/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since Twenty Ten 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function wallarquitectura_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'wallarquitectura' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'wallarquitectura' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'wallarquitectura' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'wallarquitectura_filter_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function wallarquitectura_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'wallarquitectura_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function wallarquitectura_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'wallarquitectura_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function wallarquitectura_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continuar leyendo <span class="meta-nav">&rarr;</span>', 'wallarquitectura' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and wallarquitectura_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function wallarquitectura_auto_excerpt_more( $more ) {
	return ' &hellip;' . wallarquitectura_continue_reading_link();
}
add_filter( 'excerpt_more', 'wallarquitectura_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function wallarquitectura_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= wallarquitectura_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'wallarquitectura_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function wallarquitectura_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'wallarquitectura_remove_gallery_css' );

if ( ! function_exists( 'wallarquitectura_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wallarquitectura_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function wallarquitectura_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '%s <span class="says">says:</span>', 'wallarquitectura' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'wallarquitectura' ); ?></em>
				<br />
			<?php endif; ?>
			<footer class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'wallarquitectura' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'wallarquitectura' ), ' ' );
				?>
			</footer><!-- .comment-meta .commentmetadata -->
			<div class="comment-body"><?php comment_text(); ?></div>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-##  -->
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'wallarquitectura' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'wallarquitectura'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override wallarquitectura_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function wallarquitectura_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'wallarquitectura' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'wallarquitectura' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'wallarquitectura' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'wallarquitectura' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'wallarquitectura' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'wallarquitectura' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'wallarquitectura' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'wallarquitectura' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
/** Register sidebars by running wallarquitectura_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'wallarquitectura_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function wallarquitectura_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'wallarquitectura_remove_recent_comments_style' );

if ( ! function_exists( 'wallarquitectura_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function wallarquitectura_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> <span class="entry-date">%2$s %3$s %4$s</span> <span class="meta-sep">by</span> %5$s', 'wallarquitectura' ),
		// %1$s = container class
		'meta-prep meta-prep-author',
		// %2$s = month: /yyyy/mm/
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
			home_url() . '/' . get_the_date( 'Y' ) . '/' . get_the_date( 'm' ) . '/',
			esc_attr( 'View Archives for ' . get_the_date( 'F' ) . ' ' . get_the_date( 'Y' ) ),
			get_the_date( 'F' )
		),
		// %3$s = day: /yyyy/mm/dd/
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
			home_url() . '/' . get_the_date( 'Y' ) . '/' . get_the_date( 'm' ) . '/' . get_the_date( 'd' ) . '/',
			esc_attr( 'View Archives for ' . get_the_date( 'F' ) . ' ' . get_the_date( 'j' ) . ' ' . get_the_date( 'Y' ) ),
			get_the_date( 'j' )
		),
		// %4$s = year: /yyyy/
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
			home_url() . '/' . get_the_date( 'Y' ) . '/',
			esc_attr( 'View Archives for ' . get_the_date( 'Y' ) ),
			get_the_date( 'Y' )
		),
		// %5$s = author vcard
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'wallarquitectura' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'wallarquitectura_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function wallarquitectura_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'wallarquitectura' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'wallarquitectura' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'wallarquitectura' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/*	Begin wallarquitectura */
	// Add Admin
		require_once(TEMPLATEPATH . '/wall-admin/admin-menu.php');

	// remove version info from head and feeds (http://digwp.com/2009/07/remove-wordpress-version-number/)
		function wallarquitectura_complete_version_removal() {
			return '';
		}
		add_filter('the_generator', 'wallarquitectura_complete_version_removal');
/*	End wallarquitectura */

// change Search Form input type from "text" to "search" and add placeholder text
	function wallarquitectura_search_form ( $form ) {
		$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
		<div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
		<input type="search" placeholder="Search for..." value="' . get_search_query() . '" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
		</div>
		</form>';
		return $form;
	}
	add_filter( 'get_search_form', 'wallarquitectura_search_form' );

// added per WP upload process request post-thumbnails
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 250, 250 ); // default Post Thumbnail dimensions   
}

//image size thumbnaisl
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'featured-thumb', 310, 9999, true); //300 pixels wide (and unlimited height)
}


/**
** Admin menu custom**********************************************************************
**/

function edit_admin_menus() {
	global $menu;

	remove_menu_page('edit-comments.php'); // Remove the Tools Menu
	remove_menu_page('link-manager.php'); // Remove the Tools Menu
}

add_action( 'admin_menu', 'edit_admin_menus' );

function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Proyectos';
    $submenu['edit.php'][5][0] = 'Todos los Proyectos';
    $submenu['edit.php'][10][0] = 'Agregar proyecto';
    echo '';
}

add_action( 'admin_menu', 'change_post_menu_label' );

/**
********************* Contact function*****************
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
//get the name "[posttitle mypagelink] en mensaje [_post_title]"
	function wpcf7_postlink_shortcode_handler( $tag ) {
		global $wpcf7_contact_form;
		global $wpdb;
		
		if ( ! is_array( $tag ) )
			return '';
			
			$type = $tag['type'];
			$name = $tag['name'];
			
			$post = get_the_ID();
			
			$querystr = "SELECT * FROM $wpdb->posts WHERE ID = $post ";
			$pageposts = $wpdb->get_row($querystr, ARRAY_A);
			
			$html = '<input type="text" name="'. $name .'" value="'.$pageposts['post_title'].'" />';
			
			$html = $pageposts['post_title'];
			return $html;
	}
	
	wpcf7_add_shortcode( 'posttitle', 'wpcf7_postlink_shortcode_handler', true );
	
	function wpcf7_postlink_validation_filter( $result, $tag ) {
		global $wpcf7_contact_form;
		
		$type = $tag['type'];
		$name = $tag['name'];
		
		return $result;
	}
	
	add_filter( 'wpcf7_validate_pagelink', 'wpcf7_pagelink_validation_filter', 10, 2 );
}


?>