/**
 * Chicagoland Tuckpointing — front-end behaviour.
 *
 * Three things: the mobile menu, the nav dropdowns, and the before/after
 * slider. FAQ accordions, lazy images and smooth scrolling are all native, so
 * they keep working if this file never loads.
 */
( function () {
	'use strict';

	var DESKTOP = '(min-width: 961px)';

	/* --- Nav dropdowns ---------------------------------------------------- */

	function initDropdowns() {
		var toggles = document.querySelectorAll( '.nav__toggle' );

		if ( ! toggles.length ) {
			return;
		}

		function close( toggle ) {
			toggle.setAttribute( 'aria-expanded', 'false' );
		}

		function closeAll( except ) {
			Array.prototype.forEach.call( toggles, function ( toggle ) {
				if ( toggle !== except ) {
					close( toggle );
				}
			} );
		}

		Array.prototype.forEach.call( toggles, function ( toggle ) {
			var item = toggle.closest( 'li' );

			toggle.addEventListener( 'click', function () {
				var open = 'true' === toggle.getAttribute( 'aria-expanded' );
				closeAll( toggle );
				toggle.setAttribute( 'aria-expanded', open ? 'false' : 'true' );
			} );

			if ( ! item ) {
				return;
			}

			// Keep aria-expanded truthful while tabbing through the submenu,
			// rather than letting CSS :focus-within open a menu the button
			// still claims is closed.
			item.addEventListener( 'focusin', function () {
				if ( window.matchMedia( DESKTOP ).matches ) {
					closeAll( toggle );
					toggle.setAttribute( 'aria-expanded', 'true' );
				}
			} );

			item.addEventListener( 'focusout', function ( event ) {
				if ( ! window.matchMedia( DESKTOP ).matches ) {
					return;
				}

				if ( ! item.contains( event.relatedTarget ) ) {
					close( toggle );
				}
			} );
		} );

		// Escape closes the open menu and puts focus back on its button.
		document.addEventListener( 'keydown', function ( event ) {
			if ( 'Escape' !== event.key ) {
				return;
			}

			Array.prototype.forEach.call( toggles, function ( toggle ) {
				if ( 'true' !== toggle.getAttribute( 'aria-expanded' ) ) {
					return;
				}

				var item = toggle.closest( 'li' );
				close( toggle );

				if ( item && item.contains( document.activeElement ) ) {
					toggle.focus();
				}
			} );
		} );

		document.addEventListener( 'click', function ( event ) {
			if ( ! event.target.closest( '.nav' ) ) {
				closeAll( null );
			}
		} );
	}

	/* --- Mobile navigation ------------------------------------------------ */

	function initNav() {
		var toggle = document.querySelector( '.nav-toggle' );
		var nav = document.getElementById( 'primary-nav' );

		if ( ! toggle || ! nav ) {
			return;
		}

		function close() {
			nav.classList.remove( 'is-open' );
			toggle.setAttribute( 'aria-expanded', 'false' );
		}

		toggle.addEventListener( 'click', function () {
			var open = nav.classList.toggle( 'is-open' );
			toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		} );

		document.addEventListener( 'keydown', function ( event ) {
			if ( 'Escape' === event.key && nav.classList.contains( 'is-open' ) ) {
				close();
				toggle.focus();
			}
		} );

		document.addEventListener( 'click', function ( event ) {
			if ( ! nav.contains( event.target ) && ! toggle.contains( event.target ) ) {
				close();
			}
		} );

		// Following a link closes the panel — but tapping a submenu disclosure
		// inside it must not.
		nav.addEventListener( 'click', function ( event ) {
			if ( event.target.closest( 'a' ) ) {
				close();
			}
		} );

		var wide = window.matchMedia( DESKTOP );

		var onChange = function ( event ) {
			if ( event.matches ) {
				close();
			}
		};

		if ( wide.addEventListener ) {
			wide.addEventListener( 'change', onChange );
		} else if ( wide.addListener ) {
			wide.addListener( onChange );
		}
	}

	/* --- Before / after slider -------------------------------------------- */

	function initBeforeAfter( root ) {
		var after = root.querySelector( '.ba__after' );
		var handle = root.querySelector( '.ba__handle' );

		if ( ! after || ! handle ) {
			return;
		}

		var dragging = false;

		function setPosition( percent ) {
			var clamped = Math.max( 0, Math.min( 100, percent ) );
			after.style.width = clamped + '%';
			handle.style.left = clamped + '%';
			handle.setAttribute( 'aria-valuenow', Math.round( clamped ) );
		}

		function fromClientX( clientX ) {
			var rect = root.getBoundingClientRect();

			if ( ! rect.width ) {
				return;
			}

			setPosition( ( ( clientX - rect.left ) / rect.width ) * 100 );
		}

		function start( event ) {
			dragging = true;
			root.classList.add( 'is-dragging' );
			fromClientX( event.touches ? event.touches[ 0 ].clientX : event.clientX );
		}

		function move( event ) {
			if ( ! dragging ) {
				return;
			}

			if ( event.touches ) {
				fromClientX( event.touches[ 0 ].clientX );
			} else {
				event.preventDefault();
				fromClientX( event.clientX );
			}
		}

		function end() {
			dragging = false;
			root.classList.remove( 'is-dragging' );
		}

		root.addEventListener( 'mousedown', start );
		root.addEventListener( 'touchstart', start, { passive: true } );
		window.addEventListener( 'mousemove', move );
		window.addEventListener( 'touchmove', move, { passive: true } );
		window.addEventListener( 'mouseup', end );
		window.addEventListener( 'touchend', end );

		handle.addEventListener( 'keydown', function ( event ) {
			var current = parseFloat( handle.getAttribute( 'aria-valuenow' ) || '50' );
			var step = event.shiftKey ? 10 : 2;

			if ( 'ArrowLeft' === event.key ) {
				event.preventDefault();
				setPosition( current - step );
			} else if ( 'ArrowRight' === event.key ) {
				event.preventDefault();
				setPosition( current + step );
			} else if ( 'Home' === event.key ) {
				event.preventDefault();
				setPosition( 0 );
			} else if ( 'End' === event.key ) {
				event.preventDefault();
				setPosition( 100 );
			}
		} );

		setPosition( 50 );
	}

	/* --- Boot -------------------------------------------------------------- */

	function init() {
		initNav();
		initDropdowns();
		Array.prototype.forEach.call( document.querySelectorAll( '.ba' ), initBeforeAfter );
	}

	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
}() );
