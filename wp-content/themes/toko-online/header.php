<?php
/**
 * The header theme.
 *
 * Template part file that contains the HTML document head and 
 * opening HTML body elements, as well as the site header and 
 * "infobar".
 *
 * This file is called by all primary template pages
 * 
 * Child Themes can override this template part file globally,
 * via "header.php", or in a given specific context, via
 * "header-{context}.php". For example, to replace this
 * template part file on static Pages, a Child Theme would
 * include the file "header-page.php".
 *
 * @package tokoonline
 * @since Toko Online 1.0
 */
?><!DOCTYPE html>
<html <?php 
/**
 * Output language attributes for the <html> tag
 * 
 * @link http://codex.wordpress.org/Function_Reference/language_attributes language_attributes
 * 
 * Added inside the HTML <html> tag, and outputs various HTML
 * language attributes, such as language and text-direction.
 * 
 * @param	null
 * @return	string	e.g. dir="ltr" lang="en-US"
 */
language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php
/**
 * Output the site HTML type
 *
 * @link http://codex.wordpress.org/Function_Reference/bloginfo bloginfo
 * @link http://codex.wordpress.org/Function_Reference/get_bloginfo get_bloginfo
 * 
 * bloginfo() prints (displays/outputs) the data requested. 
 * get_bloginfo() returns, rather than display/output, the data
 * 
 * The 'charset' parameter is the document character set
 * 	- Defined in wp-config.php
 *  - Usually "UTF-8"
 *
 * @param	string	$show	e.g. 'charset'; default: none
 * @return	string			e.g. "UTF-8"
 */	
	bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php 
/**
 * Function Reference/wp title
 *
 * Display or retrieve page <title> for all areas of blog.
 * The text for the <title> element is generated based on the type of post, page, archive, etc., 
 * being displayed. You may also append or prepend a string to this using the function's parameters. 
 * The result may be displayed directly, or returned for further processing.
 *
 * You can also specify what separator is to be used between the different segments of the title. 
 * By default, the separator is displayed before the page title, 
 * so that the blog title will be before the page title.
 * This is not good for title display, since the blog title shows up on most tabs 
 * and not what is important, which is the page that the user is looking at.
 *
 *
 * The main reason to have the blog title to the right is for browsers supporting tabs. 
 * You can achieve this by using the $seplocation parameter and setting the value to 'right'. 
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_title
 */				
	          wp_title( '|', true, 'right' );
// -------------------------------------------------------		  
		   ?>
	</title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<script>(function(){document.documentElement.className='js'})();</script>
	<?php 
/**
 * WP Head
 *
 * Always have wp_head() just before the closing </head>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to add elements to <head> such
 * as styles, scripts, and meta tags.
 */	
   	    wp_head(); 
// --------------------------------------------	
	?>
</head>
<body <?php 
/**
 * Body Class
 * 
 * Output HTML <body> tag CSS ID attribute content, 
 * Output HTML <body> tag "class" attribute, 
 * based on current page context
 */
body_class(); ?>>

 <div id="page" class="hfeed site">
 <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'tokoonline' ); ?></a>
<div class="toko-slicknav toko-left toko-width">
		<ul class="toggle-close">
		     <li class="toko-close"><i class="icon-close"></i></li>
		</ul><!-- .toggle-close --> 
	<div id="sidebar" class="sidebar">	
		<?php 
/**
 * Function Reference/get sidebar
 *
 * If a name ($name) is specified then a specialized sidebar sidebar-{name}.php will be included. 
 * If sidebar-{name}.php does not exist, then it will fallback to loading sidebar.php.
 *
 * @link http://codex.wordpress.org/Function_Reference/get_sidebar
 */					
		get_sidebar(); 
// ------------------------------------------------		
		?>
	</div><!-- .sidebar -->
</div><!-- .toko-slicknav -->

        <ul class="toggle-top">
            <li class="toko-toggle-left"><i class="icon-nav"></i></li>
        </ul><!-- .toggle-top -->    
		
			   <div id="toko-site">
	    <header id="masthead" class="site-header" role="banner">
			<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</a>				
		</header><!-- #masthead -->
	<div id="content" class="site-content">