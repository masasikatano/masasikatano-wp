<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package tokoonline
 * @since Toko Online 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'tokoonline' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h2>

		<?php tokoonline_comment_nav(); ?>

		<ol class="comment-list">
			<?php
/** 
 * Function Reference/wp list comments
 *
 * Displays all comments for a post or Page 
 * based on a variety of parameters including ones set in the administration area.
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_list_comments
 */						
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 56,
				) );
			?>
		</ol><!-- .comment-list -->
		
		<?php tokoonline_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'tokoonline' ); ?></p>
	<?php endif; ?>

	<?php 
/**
 * Function Reference/comment form
 *
 * This tag outputs a complete commenting form for use within a template.
 * Most strings and form fields may be controlled through the $args array passed into the function, 
 * while you may also choose to use the comment_form_default_fields 
 * filter to modify the array of default  fields 
 * if you'd just like to add a new one or remove a single field. All fields are also individually 
 *
 * passed through a filter of the form comment_form_field_$name 
 * where $name is the key used in the array of fields.
 *
 * Please note, that although most parameters are marked as optional, 
 * not including them all in your code will produce errors when using define('WP_DEBUG', true); 
 *
 * @link http://codex.wordpress.org/Function_Reference/comment_form
 */				
	  comment_form(); 
	?>

</div><!-- .comments-area -->