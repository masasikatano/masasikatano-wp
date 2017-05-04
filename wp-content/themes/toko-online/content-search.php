<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
		    the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
		?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php 
/**
 * Function Reference/the excerpt
 * Displays the excerpt of the current post after applying several filters to it 
 * including auto-p formatting which turns double line-breaks into HTML paragraphs. 
 * It uses get_the_excerpt() to first generate a trimmed-down 
 * version of the full post content should there not be an explicit excerpt for the post.
 *
 * The trimmed-down version contains a 'more' tag at the end which by default is the […] or "hellip" symbol.
 * A user-supplied excerpt is NOT by default given such a symbol. 
 * To add it, you must either modify the raw $post->post_excerpt manually 
 * in your template before calling the_excerpt(), 
 * add a filter for 'get_the_excerpt' with a priority lower than 10, 
 * or add a filter for 'wp_trim_excerpt' (comparing the first and second parameter, 
 * because a user-supplied excerpt does not get altered in any way by this function). 
 *
 * An auto-generated excerpt will also have all shortcodes and tags removed. 
 * It is trimmed down to a word-boundary and the default length is 55 words. 
 * For languages in which words are (or can be) 
 * described with single characters (ie. East-Asian languages) 
 * the word-boundary is actually the character.
 *
 * ===== Note: ==== 
 * If the current post is an attachment, such as in the attachment.php and image.php template loops, 
 * then the attachment caption is displayed. Captions do not include the "[...]" text. 
 *
 * @link http://codex.wordpress.org/Function_Reference/the_excerpt
 */						
		    the_excerpt(); 
		?>
	</div><!-- .entry-summary -->

	<?php if ( 'post' == get_post_type() ) : ?>
		<footer class="entry-footer">
			<?php tokoonline_entry_meta(); ?>
			<?php edit_post_link( esc_html__( 'Edit', 'tokoonline' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer -->
	<?php else : ?>
		<?php edit_post_link( esc_html__( 'Edit', 'tokoonline' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>
	<?php endif; ?>
</article><!-- #post-## -->