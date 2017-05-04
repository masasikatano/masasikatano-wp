<?php
/**
 * The template for displaying link post formats.
 *
 * Used for both single and index/archive/search.
 *
 *
 * @package tokoonline
 * @since Toko Online 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tokoonline_post_thumbnail(); ?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( sprintf( '<h1 class="entry-title"><a href="%s">', esc_url( tokoonline_get_link_url() ) ), '</a></h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s">', esc_url( tokoonline_get_link_url() ) ), '</a></h2>' );
			endif;
		?>
	</header>
	<!-- .entry-header -->

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
	</div>
	<!-- .entry-content -->

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
		<?php tokoonline_entry_meta(); ?>
		<?php edit_post_link( esc_html__( 'Edit', 'tokoonline' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
	<!-- .entry-footer -->
</article><!-- #post-## -->