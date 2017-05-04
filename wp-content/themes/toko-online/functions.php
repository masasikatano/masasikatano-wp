<?php
/**
 * Tokoonline functions and definitions.
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 * @package tokoonline
 * @since Toko Online 1.0
 */
 
// -------------------------------------------------------------

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Toko Online 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

// -------------------------------------------------------------

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Toko Online 1.0
 */
function tokoonline_setup() {

/*
 * Make theme available for translation.
 * Translations can be filed in the /languages/ directory.
 * If you're building a theme based on tokoonline, use a find and replace
 * to change 'tokoonline' to the name of your theme in all the template files
 */
	load_theme_textdomain( 'tokoonline', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
	add_theme_support( 'title-tag' );

/*
 * Enable support for Post Thumbnails on posts and pages.
 *
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'tokoonline' ),
	) );

/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

/*
 * Enable support for Post Formats.
 * See http://codex.wordpress.org/Post_Formats
 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	
/*
 * Add Theme support for Custom Editor Style
 * 
 * Apply custom CSS to the WordPress Visual
 * editor, so that content in the editor is
 * visually consistent with content rendered
 * on the site.
 * 
 * Child Themes can remove support for this feature via
 * remove_editor_styles(). (Note PLURAL vs. singular.)
 * 
 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', tokoonline_fonts_url() ) );
}
add_action( 'after_setup_theme', 'tokoonline_setup' );

// -------------------------------------------------------------

/**
 * Register widget area.
 *
 * @since Toko Online 1.0
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function tokoonline_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'tokoonline' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'tokoonline' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tokoonline_widgets_init' );

// -------------------------------------------------------------

/**
 * Register Google fonts for Tokoonline.
 *
 * @since Toko Online 1.0
 *
 * @return string
 */
function tokoonline_fonts_url() {
	$fonts   = array();
	$subsets = 'latin,latin-ext';

/*
 * Translators: If there are characters in your language that are not supported
 * by Lato, translate this to 'off'. Do not translate into your own language.
 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'tokoonline' ) ) {
		$fonts[] = 'Lato:400italic,700italic,400,700';
	}

/*
 * Translators: If there are characters in your language that are not supported
 * by Raleway, translate this to 'off'. Do not translate into your own language.
 */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'tokoonline' ) ) {
		$fonts[] = 'Raleway:400italic,700italic,400,700';
	}

/*
 * Translators: If there are characters in your language that are not supported
 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'tokoonline' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

/*
 * Translators: To add an additional character subset specific to your language,
 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'tokoonline' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	return add_query_arg( array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	), '//fonts.googleapis.com/css' );
}

// -------------------------------------------------------------

/**
 * Enqueue scripts and styles.
 *
 * @since Toko Online 1.0
 */
function tokoonline_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'tokoonline-fonts', tokoonline_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'tokoonline-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'tokoonline-ie', get_template_directory_uri() . '/css/ie.css', array( 'tokoonline-style', 'genericons' ), '20141010' );
	wp_style_add_data( 'tokoonline-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'tokoonline-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'tokoonline-style' ), '20141010' );
	wp_style_add_data( 'tokoonline-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'tokoonline-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'tokoonline-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}
	
	wp_enqueue_script( 'tokoonline-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20141010', true );
    wp_localize_script( 'tokoonline-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'tokoonline' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'tokoonline' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'tokoonline_scripts' );

// -------------------------------------------------------------

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 */
function tokoonline_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'tokoonline' ),
		'next_text' => __( 'Next &rarr;', 'tokoonline' ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'tokoonline' ); ?></h1>
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}

// NAV SINGLE POST
function tokoonline_nav_single() {
  ?>
               <nav class="navigation post-navigation" role="navigation">
					<span class="alignleft"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'tokoonline' ) . '</span> %title' ); ?></span>
					<span class="alignright"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'tokoonline' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->

  <?php 
                    }//end nav single post
    add_action( 'tokoonline_navsingle', 'tokoonline_nav_single' );
	
// -------------------------------------------------------------	

/**
 * Display descriptions in main navigation.
 *
 * @since Toko Online 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 *
 * @return string Menu item with possible description.
 */
function tokoonline_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'tokoonline_nav_description', 10, 4 );

// NAVIGATIONS
function tokoonline_navigation() {
wp_nav_menu( array(
				'menu_class'     => 'nav-menu',
				'echo' => true, 
                'before' => '', 
                'after' => '', 
                'link_before' => '', 
                'link_after' => '', 
				'theme_location' => 'primary',
				'depth' => 0) );
}
    add_action( 'tokoonline_nav', 'tokoonline_navigation' );
	
// -------------------------------------------------------------	
	
/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Toko Online 1.0
 *
 * @param string $html Search form HTML
 *
 * @return string Modified search form HTML
 */
function tokoonline_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'tokoonline_search_form_modify' );

// -------------------------------------------------------------

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function tokoonline_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'tokoonline' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'tokoonline_wp_title', 10, 2 );

// -------------------------------------------------------------

/**
 * Implement the Custom Header feature.
 *
 * @since Toko Online 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

// -------------------------------------------------------------

/**
 * Custom template tags for this theme.
 *
 * @since Toko Online 1.0
 */
require get_template_directory() . '/inc/template-tags.php';
// -------------------------------------------------------------