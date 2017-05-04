<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package tokoonline
 * @since Toko Online 1.0
 */

if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'sidebar-1' )  ) : ?>
	<div id="secondary" class="secondary">
	
		<?php 
		/**
		 * Output the sidebar navigation menu
		 * 
		 * If the user has defined a custom navigation menu
		 * and has applied that menu to the 'primary'
		 * theme location, then output that menu. Otherwise,
		 * output nothing.
		 * 
		 * The menu will output only one level of Page
		 * hierarchy.
		 */		
		if (
		/**
		 * WordPress conditional tag that returns true if
		 * the user has applied a custom navigation menu 
		 * to the specified theme location
		 */		
		has_nav_menu( 'primary' ) ) : ?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
		    <?php get_search_form(); ?>
			<?php tokoonline_navigation(); ?>	
		</nav><!-- .main-navigation -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="widget-area" class="widget-area" role="complementary">
			<?php
		/**
		 * Output a dynamic sidebar
		 * 
		 * @link http://codex.wordpress.org/Function_Reference/dynamic_sidebar
		 * 
		 * Outputs the specified dynamic sidebar. A dynamic sidebar 
		 * is used to output Widgets as specified by the user.
		 */
			dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- .widget-area -->
		<?php endif; ?>
		
	</div><!-- .secondary -->
<?php endif; ?>