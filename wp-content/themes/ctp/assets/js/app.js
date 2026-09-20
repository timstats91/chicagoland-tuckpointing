/**
 * Chicagoland Tuckpointing — front-end behaviour.
 *
 * Two things only: the mobile menu and the before/after slider. Everything
 * else (FAQ accordions, lazy images, smooth scrolling) is handled natively by
 * the browser, which is faster and works when this file fails to load.
 */
( function () {
	'use strict';

	/* --- Mobile navigation ---------------------------------------------- */

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

		// Close on escape, on outside click, and when a link is followed.
		document.addEventListener( 'keydown', function ( event ) {
			if ( 'Escape' === event.key ) {
				close();
			}
		} );

		document.addEventListener( 'click', function ( event ) {
			if ( ! nav.contains( event.target ) && ! toggle.contains( event.target ) ) {
				close();
			}
		} );

		nav.addEventListener( 'click', function ( event ) {
			if ( 'A' === event.target.tagName ) {
				close();
			}
		} );

		// Reset state if the viewport grows past the mobile breakpoint.
		var wide = window.matchMedia( '(min-width: 961px)' );
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

	/* --- Before / after slider ------------------------------------------- */

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

		// Keyboard support: the handle is a real focusable slider.
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
		Array.prototype.forEach.call( document.querySelectorAll( '.ba' ), initBeforeAfter );
	}

	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
}() );
