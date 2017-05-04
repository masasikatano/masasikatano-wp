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
		<?php
             // The Loop 		
		      while ( have_posts() ) : the_post(); 
			  
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
			 get_template_part( 'content', get_post_format() );
			 
			 //Next_and_Previous_Links	  
	             tokoonline_nav_single();
				 
             //If comments are open or we have at least one comment, load up the comment template			 
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				
			// end of the loop. 	
		      endwhile; 
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