<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tokoonline
 * @since Toko Online 1.0
 */

get_header(); ?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php 
	        /*
             * The Loop 
			 * @link https://codex.wordpress.org/The_Loop
             */					
		     if ( have_posts() ) : 
			    if ( is_home() && ! is_front_page() ) : 
	    ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>
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
					
				// End the loop	
			    endwhile; 
				tokoonline_paging_nav();			
		     else :
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
					
		      //Finish conditions
		     endif; 
		?>
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