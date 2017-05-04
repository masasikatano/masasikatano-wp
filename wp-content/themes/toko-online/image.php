<?php
/**
 * The template for displaying all single posts and attachments.
 *
 * @package tokoonline
 * @since Toko Online 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<nav id="image-navigation" class="navigation image-navigation">
						<div class="nav-links">
							<div class="nav-previous"><?php previous_image_link( false, esc_html__( 'Previous Image', 'tokoonline' ) ); ?></div><div class="nav-next"><?php next_image_link( false, esc_html__( 'Next Image', 'tokoonline' ) ); ?></div>
						</div><!-- .nav-links -->
					</nav><!-- .image-navigation -->

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
						<div class="entry-attachment">
							<?php
/**
 * Filter the default Tokoonline image attachment size.
 *
 * @since Tokoonline 1.0
 *
 * @param string $image_size Image size. Default 'large'.
 */
								$image_size = apply_filters( 'tokoonline_attachment_size', 'large' );
								echo wp_get_attachment_image( get_the_ID(), $image_size );
							?>

							<?php if ( has_excerpt() ) : ?>
								<div class="entry-caption">
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
								</div><!-- .entry-caption -->
							<?php endif; ?>
						</div><!-- .entry-attachment -->

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

					<footer class="entry-footer">
						<?php tokoonline_entry_meta(); ?>
						<?php edit_post_link( esc_html__( 'Edit', 'tokoonline' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-footer -->
				</article><!-- #post-## -->

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php 
/**
 * Function Reference/get footer
 * Includes the footer.php template file from your current theme's directory. 
 * if a name is specified then a specialised footer footer-{name}.php will be included.
 *
 * If the theme contains no footer.php file then 
 * the footer from the default theme wp-includes/theme-compat/footer.php will be included.
 *
 * @link http://codex.wordpress.org/Function_Reference/get_footer
 */			
get_footer(); 
?>