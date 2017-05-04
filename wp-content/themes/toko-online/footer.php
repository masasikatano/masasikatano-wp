<?php
/**
 * The template for displaying the footer.
 *
 * Template part file that contains the site footer and
 * closing HTML body elements
 *
 * This file is called by all primary template pages
 * 
 * Child Themes can override this template part file globally,
 * via "footer.php", or in a given specific context, via
 * "footer-{context}.php". For example, to replace this
 * template part file on static Pages, a Child Theme would
 * include the file "footer-page.php".
 *
 * Contains the closing of the "site-content" div and all content after.
 * @package tokoonline
 * @since Toko Online 1.0
 */
?>
	
	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php
				/**
				 * Fires before the Tokoonline footer text for footer customization.
				 *
				 * @since Tokoonline 1.0
				 */
				do_action( 'tokoonline_credits' );
			?>
			<a href="<?php echo home_url('/') ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
            <?php bloginfo('name'); ?></a> | <a href="<?php echo esc_url(__('http://filloshop.com','tokoonline')); ?>" title="<?php esc_attr_e('tokoonline', 'tokoonline'); ?>"><?php printf('Toko Online'); ?></a> powered by <a href="<?php echo esc_url(__('http://wordpress.org','tokoonline')); ?>" title="<?php esc_attr_e('WordPress', 'tokoonline'); ?>"><?php printf('WordPress'); ?></a>
 
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->
</div><!-- .site -->

<?php 
// Fire the 'wp_footer' action hook
// 
// @link http://codex.wordpress.org/Hook_Reference/wp_footer
// 
// This hook is used by WordPress core, Themes, and Plugins to 
// add scripts, CSS styles, meta tags, etc. to the document footer.
// 
// MUST come immediately before the closing </body> tag
// 
// @param	null
// @return	mixed	any output hooked into 'wp_footer'

wp_footer(); 

// -------------------------------------------------------	
?>
</div>
</body>
</html>