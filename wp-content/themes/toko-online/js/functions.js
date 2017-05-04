/**
 * Theme functions file.
 *
 * Contains handlers for navigation
 */
;(function($) {

	$.slicknavs = function(options) {
		var settings = $.extend({
			siteClose: true, // true or false - Enable closing of Slicknavs by clicking on #toko-site.
			scrollLock: false, // true or false - Prevent scrolling of site when a Slicknav is open.
			disableOver: false, // integer or false - Hide Slicknavs over a specific width.
			hideControlClasses: false // true or false - Hide controls at same width as disableOver.
		}, options);
		var test = document.createElement('div').style, // Create element to test on.
		supportTransition = false, // Variable for testing transitions.
		supportTransform = false; // variable for testing transforms.

		// Test for CSS Transitions
		if (test.MozTransition === '' || test.WebkitTransition === '' || test.OTransition === '' || test.transition === '') supportTransition = true;

		// Test for CSS Transforms
		if (test.MozTransform === '' || test.WebkitTransform === '' || test.OTransform === '' || test.transform === '') supportTransform = true;
       
	   // Get user agent string.
		var ua = navigator.userAgent, 
		android = false, 
		iOS = false;
		
		// Detect Android in user agent string.
		if (/Android/.test(ua)) { 
			android = ua.substr(ua.indexOf('Android')+8, 3); 
		} else if (/(iPhone|iPod|iPad)/.test(ua)) {
			iOS = ua.substr(ua.indexOf('OS ')+3, 3).replace('_', '.'); 
		}
		
		if (android && android < 3 || iOS && iOS < 5) $('html').addClass('toko-static'); 

		// Site container
		var $site = $('#toko-site, .toko-site-container'); 

		// Left Slicknav	
		if ($('.toko-left').length) { 
			var $left = $('.toko-left'), 
			leftActive = false; 
		}

		// Right Slicknav
		if ($('.toko-right').length) { 
			var $right = $('.toko-right'), 
			rightActive = false; 
		}
		
		// Initialisation variable.	
		var init = false, 
		windowWidth = $(window).width(), 
		$controls = $('.toko-toggle-left, .toko-toggle-right, .toko-open-left, .toko-open-right, .toko-close'), 
		$slide = $('.toko-slide'); 
		
		// Initailise Slicknavs
		function initialise() {
			if (!settings.disableOver || (typeof settings.disableOver === 'number' && settings.disableOver >= windowWidth)) { 
				init = true; 
				$('html').addClass('toko-init'); 
				if (settings.hideControlClasses) $controls.removeClass('toko-hide'); 
				css(); 
			} else if (typeof settings.disableOver === 'number' && settings.disableOver < windowWidth) { 
				init = false; 
				$('html').removeClass('toko-init'); 
				if (settings.hideControlClasses) $controls.addClass('toko-hide'); 
				$site.css('minHeight', '');
				if (leftActive || rightActive) close(); 
			}
		}
		initialise();
		
		// Inline CSS
		function css() {
			// Set minimum height.
			$site.css('minHeight', ''); 
			$site.css('minHeight', $('html').height() + 'px'); // Set minimum height of the site to the minimum height of the html.
			
			// Custom Slicknav widths.
			if ($left && $left.hasClass('toko-width-custom')) $left.css('width', $left.attr('data-toko-width')); // Set user custom width.
			if ($right && $right.hasClass('toko-width-custom')) $right.css('width', $right.attr('data-toko-width')); // Set user custom width.
			
			// Set off-canvas margins for Slicknavs with push and overlay animations.
			if ($left && ($left.hasClass('toko-style-push') || $left.hasClass('toko-style-overlay'))) $left.css('marginLeft', '-' + $left.css('width'));
			if ($right && ($right.hasClass('toko-style-push') || $right.hasClass('toko-style-overlay'))) $right.css('marginRight', '-' + $right.css('width'));
			
			// Site scroll locking.
			if (settings.scrollLock) $('html').addClass('toko-scroll-lock');
		}
		
		// Resize Functions
		$(window).resize(function() {
			var resizedWindowWidth = $(window).width(); // Get resized window width.
			if (windowWidth !== resizedWindowWidth) { // Slicknavs is running and window was actually resized.
				windowWidth = resizedWindowWidth; // Set the new window width.
				initialise(); // Call initalise to see if Slicknavs should still be running.
				if (leftActive) open('left'); // If left Slicknav is open, calling open will ensure it is the correct size.
				if (rightActive) open('right'); // If right Slicknav is open, calling open will ensure it is the correct size.
			}
		});
		
		var animation; // Animation type.

		// Set animation type.
		if (supportTransition && supportTransform) { // Browser supports css transitions and transforms.
			animation = 'translate'; // Translate for browsers that support it.
			if (android && android < 4.4) animation = 'side'; // Android supports both, but can't translate any fixed positions, so use left instead.
		} else {
			animation = 'jQuery'; // Browsers that don't support css transitions and transitions.
		}

		// Animate mixin.
		function animate(object, amount, side) {
			// Choose selectors depending on animation style.
			var selector;
			
			if (object.hasClass('toko-style-push')) {
				selector = $site.add(object).add($slide); // Push - Animate site, Slicknav and user elements.
			} else if (object.hasClass('toko-style-overlay')) {
				selector = object; // Overlay - Animate Slicknav only.
			} else {
				selector = $site.add($slide); // Reveal - Animate site and user elements.
			}
			
			// Apply animation
			if (animation === 'translate') {
				selector.css('transform', 'translate(' + amount + ')'); // Apply the animation.

			} else if (animation === 'side') {		
				if (amount[0] === '-') amount = amount.substr(1); // Remove the '-' from the passed amount for side animations.
				if (amount !== '0px') selector.css(side, '0px'); // Add a 0 value so css transition works.
				setTimeout(function() { // Set a timeout to allow the 0 value to be applied above.
					selector.css(side, amount); // Apply the animation.
				}, 1);

			} else if (animation === 'jQuery') {
				if (amount[0] === '-') amount = amount.substr(1); // Remove the '-' from the passed amount for jQuery animations.
				var properties = {};
				properties[side] = amount;
				selector.stop().animate(properties, 400); // Stop any current jQuery animation before starting another.
			}
			
			// If closed, remove the inline styling on completion of the animation.
			setTimeout(function() {
				if (amount === '0px') {
					selector.removeAttr('style');
					css();
				}
			}, 400);
		}

		// Open a Slicknav
		function open(side) {
			// Check to see if opposite Slicknav is open.
			if (side === 'left' && $left && rightActive || side === 'right' && $right && leftActive) { // It's open, close it, then continue.
				close();
				setTimeout(proceed, 400);
			} else { // Its not open, continue.
				proceed();
			}

			// Open
			function proceed() {
				if (init && side === 'left' && $left) { // Slicknavs is initiated, left is in use and called to open.
					$('html').addClass('toko-active toko-active-left'); // Add active classes.
					$left.addClass('toko-active');
					animate($left, $left.css('width'), 'left'); // Animation
					setTimeout(function() { leftActive = true; }, 400); // Set active variables.
				} else if (init && side === 'right' && $right) { // Slicknavs is initiated, right is in use and called to open.
					$('html').addClass('toko-active toko-active-right'); // Add active classes.
					$right.addClass('toko-active');
					animate($right, '-' + $right.css('width'), 'right'); // Animation
					setTimeout(function() { rightActive = true; }, 400); // Set active variables.
				}
			}
		}
			
		// Close either Slicknav
		function close(link) {
			if (leftActive || rightActive) { // If a Slicknav is open.
				if (leftActive) {
					animate($left, '0px', 'left'); // Animation
					leftActive = false;
				}
				if (rightActive) {
					animate($right, '0px', 'right'); // Animation
					rightActive = false;
				}
			
				setTimeout(function() { // Wait for closing animation to finish.
					$('html').removeClass('toko-active toko-active-left toko-active-right'); // Remove active classes.
					if ($left) $left.removeClass('toko-active');
					if ($right) $right.removeClass('toko-active');
					if (typeof link !== 'undefined') window.location = link; // If a link has been passed to the function, go to it.
				}, 400);
			}
		}
		
		// Toggle either Slicknav
		function toggle(side) {
			if (side === 'left' && $left) { // If left Slicknav is called and in use.
				if (!leftActive) {
					open('left'); // Slicknav is closed, open it.
				} else {
					close(); // Slicknav is open, close it.
				}
			}
			if (side === 'right' && $right) { // If right Slicknav is called and in use.
				if (!rightActive) {
					open('right'); // Slicknav is closed, open it.
				} else {
					close(); // Slicknav is open, close it.
				}
			}
		}

		this.slicknavs = {
			open: open, // Maps user variable name to the open method.
			close: close, // Maps user variable name to the close method.
			toggle: toggle, // Maps user variable name to the toggle method.
			init: function() { // Returns true or false whether Slicknavs are running or not.
				return init; // Returns true or false whether Slicknavs are running.
			},
			active: function(side) { // Returns true or false whether Slicknav is open or closed.
				if (side === 'left' && $left) return leftActive;
				if (side === 'right' && $right) return rightActive;
			},
			destroy: function(side) { // Removes the Slicknav from the DOM.
				if (side === 'left' && $left) {
					if (leftActive) close(); // Close if its open.
					setTimeout(function() {
						$left.remove(); // Remove it.
						$left = false; // Set variable to false so it cannot be opened again.
					}, 400);
				}
				if (side === 'right' && $right) {
					if (rightActive) close(); // Close if its open.
					setTimeout(function() {
						$right.remove(); // Remove it.
						$right = false; // Set variable to false so it cannot be opened again.
					}, 400);
				}
			}
		};

		function eventHandler(event, selector) {
			event.stopPropagation(); // Stop event bubbling.
			event.preventDefault(); // Prevent default behaviour
			if (event.type === 'touchend') selector.off('click'); // If event type was touch turn off clicks to prevent phantom clicks.
		}
		
		// Toggle left Slicknav
		$('.toko-toggle-left').on('touchend click', function(event) {
			eventHandler(event, $(this)); // Handle the event.
			toggle('left'); // Toggle the left Slidbar.
		});
		
		// Toggle right Slicknav
		$('.toko-toggle-right').on('touchend click', function(event) {
			eventHandler(event, $(this)); // Handle the event.
			toggle('right'); // Toggle the right Slidbar.
		});
		
		// Open left Slicknav
		$('.toko-open-left').on('touchend click', function(event) {
			eventHandler(event, $(this)); // Handle the event.
			open('left'); // Open the left Slicknav.
		});
		
		// Open right Slicknav
		$('.toko-open-right').on('touchend click', function(event) {
			eventHandler(event, $(this)); // Handle the event.
			open('right'); // Open the right Slicknav.
		});
		
		// Close a Slicknav
		$('.toko-close').on('touchend click', function(event) {
			eventHandler(event, $(this)); // Handle the event.
			var link;
			
			// Close Slicknav via link
			if ( $(this).parents('.toko-slicknav') ) {
				if ( $(this).is('a') ) {
					link = $(this).attr('href');
				} else if ( $(this).children('a') ) {
					link = $(this).children('a').attr('href');
				}
			}
			
			close(link); // Close Slicknav and pass link.
		});
		
		// Close Slicknav via site
		$site.on('touchend click', function(event) {
			if (settings.siteClose && (leftActive || rightActive)) { // If settings permit closing by site and left or right Slicknav is open.
				eventHandler(event, $(this)); // Handle the event.
				close(); // Close it.
			}
		});
		
	}; // End Slicknavs function.

}) (jQuery);

( function( $ ) {
	var $body, $window, sidebar, toolbarOffset;

	// Add dropdown toggle that display child menu items.
	$( '.main-navigation .page_item_has_children > a, .main-navigation .menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false">' + screenReaderText.expand + '</button>' );

	$( '.dropdown-toggle' ).click( function( e ) {
		var _this = $( this );
		e.preventDefault();
		_this.toggleClass( 'toggle-on' );
		_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
		_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		_this.html( _this.html() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
	} );

	// Enable menu toggle for small screens.
	( function() {
		var secondary = $( '#secondary' ), button, menu, widgets, social;
		if ( ! secondary ) {
			return;
		}

		button = $( '.site-branding' ).find( '.secondary-toggle' );
		if ( ! button ) {
			return;
		}

		// Hide button if there is no widgets and menu is missing or empty.
		menu    = secondary.find( '.nav-menu' );
		widgets = secondary.find( '#widget-area' );
		social  = secondary.find( '#social-navigation' );
		if ( ! widgets.length && ! social.length && ( ! menu || ! menu.children().length ) ) {
			button.hide();
			return;
		}

		button.on( 'click.tokoonline', function() {
			secondary.toggleClass( 'toggled-on' );
			secondary.trigger( 'resize' );
			$( this ).toggleClass( 'toggled-on' );
		} );
	} )();


	// Sidebar (un)fixing: fix when short, un-fix when scroll needed
	function fixedOrScrolledSidebar() {
		if ( $window.width() >= 955 ) {
			if ( sidebar.scrollHeight < ( $window.height() - toolbarOffset ) ) {
				$body.addClass( 'sidebar-fixed' );
			} else {
				$body.removeClass( 'sidebar-fixed' );
			}
		} else {
			$body.removeClass( 'sidebar-fixed' );
		}
	}

	function debouncedFixedOrScrolledSidebar() {
		var timeout;
		return function() {
			clearTimeout( timeout );
			timeout = setTimeout( function() {
				timeout = null;
				fixedOrScrolledSidebar();
			}, 150 );
		};
	}


	$( document ).ready( function() {
		// But! We only want to allow fixed sidebars when there are no submenus.
		if ( $( '#site-navigation .sub-menu' ).length ) {
			return;
		}

		// only initialize 'em if we need 'em
		$body         = $( 'body' );
		$window       = $( window );
		sidebar       = $( '#sidebar' )[0];
		toolbarOffset = $body.is( '.admin-bar' ) ? $( '#wpadminbar' ).height() : 0;

		$window
			.on( 'load.tokoonline', fixedOrScrolledSidebar )
			.on( 'resize.tokoonline', debouncedFixedOrScrolledSidebar() );
	} );

} )( jQuery );
	(function($) {
				$(document).ready(function() {
					$.slicknavs({
						scrollLock: true
					});
				});
			     }) (jQuery);