<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package tokoonline
 * @since Toko Online 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'tokoonline' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'tokoonline' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php 
/*
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