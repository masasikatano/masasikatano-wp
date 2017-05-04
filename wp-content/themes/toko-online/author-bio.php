<?php
/**
 * The template for displaying Author bios.
 *
 * @package tokoonline
 * @since Toko Online 1.0
 */
?>

<div class="author-info">
	<h2 class="author-heading"><?php _e( 'Published by', 'tokoonline' ); ?></h2>
	<div class="author-avatar">
		<?php
/**
* Filter the author bio avatar size.
*
* @since Tokoonline 1.0
*
* @param int $size The avatar height and width size in pixels.
*/
		$author_bio_avatar_size = apply_filters( 'tokoonline_author_bio_avatar_size', 56 );
		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->
	<div class="author-description">
		<h3 class="author-title"><?php echo get_the_author(); ?></h3>
		<p class="author-bio">
			<?php 
/*
* Function Reference/the author meta
*
* The the_author_meta Template Tag displays the desired meta data for a user. 
* If this tag is used within The Loop, the user ID value need not be specified, 
* and the displayed data is that of the current post author. 
* A user ID can be specified if this tag is used outside The Loop. 			 
* @link https://codex.wordpress.org/Function_Reference/the_author_meta
*/							
			the_author_meta( 'description' ); 
			?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s', 'tokoonline' ), get_the_author() ); ?>
			</a>
		</p><!-- .author-bio -->
	</div><!-- .author-description -->
</div><!-- .author-info -->