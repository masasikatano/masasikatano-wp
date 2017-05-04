<?php
/**
 * The template for displaying search results pages.
 *
 * @package tokoonline
 * @since Toko Online 1.0
 */

get_header(); ?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'tokoonline' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php
				tokoonline_paging_nav();
			?>

		<?php else : ?>

			<?php 
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
			get_template_part( 'content', 'none' ); 
			?>

		<?php endif; ?>
		</main><!-- .site-main -->
	</section><!-- .content-area -->
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