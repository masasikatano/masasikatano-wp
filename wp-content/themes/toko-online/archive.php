<?php
/**
 * The template for displaying archive pages.
 *
 * @package tokoonline
 * @since Toko Online 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
			<h1 class="page-title">
					<?php
/**
 * Conditional Tags
 *
 * The Conditional Tags can be used in your Template files to change what content is displayed and how 
 * that content is displayed on a particular page depending on what conditions that page matches. 
 * For example, you might want to display a snippet of text above the series of posts, 
 * but only on the main page of your blog. 
 * With the is_home() Conditional Tag, that task is made easy. 
 *
 * @link https://codex.wordpress.org/Conditional_Tags
 */								
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'tokoonline' ), get_the_date() );

						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'tokoonline' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'tokoonline' ) ) );

						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'tokoonline' ), get_the_date( _x( 'Y', 'yearly archives date format', 'tokoonline' ) ) );

						else :
							_e( 'Archives', 'tokoonline' );

						endif;
					?>
				</h1>				
			</header><!-- .page-header -->

			<?php 
	        /*
             * The Loop 
			 * @link https://codex.wordpress.org/The_Loop
             */						
			       while ( have_posts() ) : the_post(); 

			/* Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
					get_template_part( 'content', get_post_format() );			
			    endwhile; 
				    tokoonline_paging_nav();
		     else :
			        get_template_part( 'content', 'none' ); 
		     endif; 
			?>

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