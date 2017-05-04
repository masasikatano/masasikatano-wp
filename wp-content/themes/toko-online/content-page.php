<?php
/**
 * The template used for displaying page content.
 *
 * @package tokoonline
 * @since Toko Online 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
/*
 * Function Reference/the post thumbnail
 *
 * Display the Featured Image (previously called Post Thumbnails) for the current post, 
 * as set in that post's edit screen.
 *
 * This tag must be used within The Loop. Use get_the_post_thumbnail($id, $size, $attr ) 
 * instead to get the featured image for any post.
 *
 * Use has_post_thumbnail() to check whether a Feature Image has been added to the post.
 * To enable post thumbnails, the current theme must include add_theme_support( 'post-thumbnails' ); 
 * in its functions.php file. See also Post Thumbnails. 
 *
 * @link http://codex.wordpress.org/Function_Reference/the_post_thumbnail
 */			
	        tokoonline_post_thumbnail(); 
	?>

	<header class="entry-header">
		<?php 
/*
 * Function Reference/the title
 *
 * Displays or returns the title of the current post. 
 * This tag may only be used within The Loop, 
 * to get the title of a post outside of the loop use get_the_title. 
 * If the post is protected or private, 
 * this will be noted by the words "Protected: " or "Private: " prepended to the title. 
 *
 * @link http://codex.wordpress.org/Function_Reference/the_title
 */					
		    the_title( '<h1 class="entry-title">', '</h1>' ); 
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
/**
 * Function Reference/the content
 *
 *
 * Displays the contents of the current post. This template tag must be within The_Loop.
 * If the quicktag <!--more--> is used in a post to designate the "cut-off" 
 * point for the post to be excerpted, 
 * the_content() tag will only show the excerpt up to the <!--more--> 
 * quicktag point on non-single/non-permalink post pages. 
 * By design, the_content() tag includes a parameter for formatting the <!--more--> content and look, 
 * which creates a link to "continue reading" the full post.
 *
 *  Note about <!--more--> :
 *
 * 1. No whitespaces are allowed before the "more" in the <!--more--> quicktag. 
 *    In other words <!-- more --> will not work!
 * 2. The <!--more--> quicktag will not operate and is ignored in Templates 
 *    where just one post is displayed, such as single.php.
 * 3. Read Customizing the Read More for more details.
 *
 * @link http://codex.wordpress.org/Function_Reference/the_content
 */					
		    the_content(); 
		?>
		<?php
/**
 * Function Reference/wp link pages
 *
 * Displays page-links for paginated posts (i.e. includes the <!--nextpage--> Quicktag one or more times). 
 * This works in much the same way as link_pages() (deprecated), 
 * the difference being that arguments are given in query string format. 
 * This tag must be within The_Loop. 
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_link_pages
 */				
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'tokoonline' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'tokoonline' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php edit_post_link( esc_html__( 'Edit', 'tokoonline' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

</article><!-- #post-## -->