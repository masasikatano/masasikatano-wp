<?php
/**
 * The default template for displaying content.
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
 * The Loop 
 * @link https://codex.wordpress.org/The_Loop
 */					
			if ( is_single() ) :
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
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
		<div style="padding-bottom:15px;" >
		<?php tokoonline_entry_meta(); ?>
		</div>
	</header><!-- .entry-header -->
		
	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				esc_html__( 'Continue reading %s', 'tokoonline' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
			
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

	<?php
		if ( is_single() && get_the_author_meta( 'description' ) ) :
/**
 * Function Reference/get template part
 *
 * Load a template part into a template (other than header, sidebar, footer). 
 * Makes it easy for a theme to reuse sections of code 
 * and an easy way for child themes to replace sections of their parent theme.
 *
 * Includes the named template part for a theme or if a name 
 * is specified then a specialized part will be included. 
 * If the theme contains no {slug}.php file then no template will be included.
 *
 * For the parameter, the template file is to be called "{slug}-{name}.php". 
 *
 * @link http://codex.wordpress.org/Function_Reference/get_template_part
 */					
			get_template_part( 'author-bio' );
		endif;
	?>
<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'tokoonline' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->