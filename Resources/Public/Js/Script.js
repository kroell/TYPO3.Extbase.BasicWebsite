$(document).ready(function () {
	//$('[data-toggle=offcanvas]').click(function () {
	//	$('.row-offcanvas').toggleClass('active')
	//});

	$(".fancybox").fancybox();

    /**
     * =======================================
     * Detect Mobile Device
     * =======================================
     */
    // source: http://www.abeautifulsite.net/detecting-mobile-devices-with-javascript/
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match( /Android/i );
        },
        BlackBerry: function() {
            return navigator.userAgent.match( /BlackBerry/i );
        },
        iOS: function() {
            return navigator.userAgent.match( /iPhone|iPad|iPod/i );
        },
        Opera: function() {
            return navigator.userAgent.match( /Opera Mini/i );
        },
        Windows: function() {
            return navigator.userAgent.match( /IEMobile/i );
        },
        any: function() {
            return ( isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows() );
        }
    };

    /**
     * =======================================
     * Animations
     * =======================================
     */
    if ( $( 'body' ).hasClass( 'enable-animations' ) && ! isMobile.any() ) {
        var $elements = $( '*[data-animation]' );
        animateIt($elements);
    };

});

/**
 * =======================================
 * Function: Animate all elements
 *
 * @param $elements
 * =======================================
 */
function animateIt($elements) {
    $elements.each( function( i, el ) {

        var $el = $( el ),
            animationClass = $el.data( 'animation' );

        $el.addClass( animationClass );
        $el.addClass( 'animated' );
        $el.addClass( 'wait-animation' );

        $el.one( 'inview', function() {
            $el.removeClass( 'wait-animation' );
            $el.addClass( 'done-animation' );
        });
    });
}