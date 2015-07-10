$(document).ready(function () {

    // activate fancybox
	$(".fancybox").fancybox();

    /**
     * =======================================
     * Detect Mobile Device
     * =======================================
     */
    var isMobile = checkMobile();

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

/**
 * =======================================
 * Function: Checks if userAgent is a mobile Device or window width is lower than 800
 *
 * source: http://www.abeautifulsite.net/detecting-mobile-devices-with-javascript/
 * @returns {{Android: Function, BlackBerry: Function, iOS: Function, Opera: Function, Windows: Function, width: Function, any: Function}}
 * =======================================
 */
function checkMobile() {
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
        width: function() {
            return $(window).width() <= 800;
        },
        any: function() {
            return ( isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows() || isMobile.width() );
        }
    };

    return isMobile;
}