$( document ).ready(function() {
	skinnyNav();
	noHero();
	responsiveContainer();
	homepageSliderHeight();

})

$( window ).load(function() {
	searchForm();
	homepageSlider();
	ambassadorSlider();
	mobileNav();
	smoothArrow();
	productGallery();
	pinterestLink();
	productQuantityButtons();
	labelWidthFix();
	packagesInCart();
	swatchLinkOverride();
	
	if ($(window).width() < 960) {
		singleProductFlexslider();
	} else {
		divEqualizer($('.bamboo-benefit'));
		divEqualizer($('.blog-feed .blog-post'));
		singleProductPage();
	}
	if ($('#instafeed').length > 0) {
		instagramFeed();
	}
})

$( window ).resize(function() {
	labelWidthFix();
	packagesInCart();
	homepageSliderHeight();
	if ($(window).width() < 960) {
		singleProductFlexslider();
		skinnyNav()
	} else {
		singleProductPage();
		
	}
})

 $( document ).on( 'click', '.plus, .minus', function() {
    var $qty        = $( this ).closest( '.quantity' ).find( '.qty' ),
        currentVal  = parseFloat( $qty.val() ),
        max         = parseFloat( $qty.attr( 'max' ) ),
        min         = parseFloat( $qty.attr( 'min' ) ),
        step        = $qty.attr( 'step' );
    if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
    if ( max === '' || max === 'NaN' ) max = '';
    if ( min === '' || min === 'NaN' ) min = 0;
    if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;
    if ( $( this ).is( '.plus' ) ) {
        if ( max && ( max == currentVal || currentVal > max ) ) {
            $qty.val( max );
        } else {
            $qty.val( currentVal + parseFloat( step ) );
        }
    } else {
        if ( min && ( min == currentVal || currentVal < min ) ) {
            $qty.val( min );
        } else if ( currentVal > 0 ) {
            $qty.val( currentVal - parseFloat( step ) );
        }
    }
    $qty.trigger( 'change' );
});

function divEqualizer(divSelector) {
	var maxHeight = 0;
	divSelector.each(function(){
   		if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	divSelector.height(maxHeight);
}

function searchForm() {
	$('.side-nav.desktop .magnifying-glass').on('click', function() {
		if ($(this).hasClass('open')) {
			$('.desktop.side-nav').animate({right: '-280px'})
			$(this).removeClass('open');
		} else {
			$('.desktop.side-nav').animate({right: '0'})
			$(this).addClass('open');
		}
	})
}

function homepageSlider() {
	$('.flexslider.homepage').flexslider({
		controlNav: false,
		directionNav: false,
		smoothHeight: true,
		slideshow:true,
		start: function() {
			homepageSliderHeight();
		}
	})
}

function homepageSliderHeight() {
	if ($(window).width() > 960) {
		var height = $(window).height() + 20;
		$('.flexslider.homepage').css('height', height);
	// 	$('.flexslider.homepage').css('width', 'auto');
		$('.flexslider.homepage li').css('height', height)
	}
	
}

function ambassadorSlider() {
	$('.flexslider.ambassadors').flexslider({
		controlNav: false,
		directionNav: false,
		prevText: '',
		nextText: '',
		smoothHeight: true,
		slideshow:true
	})
}

function mobileNav() {
	$('#nav-toggle').on('click', function() {
		$('.dropdown-nav').slideToggle();
		$('.hamburger').toggleClass('active');
		$('.close').toggleClass('active');

	})
	$('.magnifying-glass').on('click', function() {
		$('.dropdown-search').slideToggle();
	})
}

function smoothArrow() {
	$('.smooth-arrow').on('click', function() {
		$('html, body').animate({
	        scrollTop: $( $.attr(this, 'href') ).offset().top
	    }, 600);
	    return false;
	})
}

function productGallery() {
	$(".thumbnails img").on('click', function(e) {
		e.preventDefault();
		$('.woocommerce-main-image img').attr('src',$(this).attr('src'));
		pinterestLink();
	})
	$('.product-type-variable .images img').on('load',function() {
		pinterestLink();		
	})
}

function pinterestLink() {
	var permalink = window.location.href;
	var image = $('.woocommerce-main-image img').attr('src');
	var title = document.title;
	$('.social a.pinterest').attr('href', 'https://pinterest.com/pin/create/button/?url=' + permalink + '&media=' + image + '&description=' + title);
 }

function productQuantityButtons() {
	$('.variations_button .buttons_added input[type="button"]').attr('value', '');
}

function singleProductPage() {
	$('.product .summary').css('height', 'initial');
	var imageHeight = $('.product .images').height();
	var summaryHeight = $('.product .summary').height();
	if (summaryHeight < imageHeight) {
		$('.product .summary').css('height', imageHeight);
	}
}

function singleProductFlexslider() {
	$('.single-product.flexslider').flexslider({
		slideshow:false,
		controlNav: true,
		directionNav: false,
		animation: 'slide'
	})
}

function instagramFeed() {
	 var feed = new Instafeed({
        accessToken: '272454729.3b4c337.0199cf32f2e6482e85b6c768ae484c4a',
        clientId: '3b4c3372310249939e26633ae1358aa0',
        get: 'user',
        userId: 272454729,
        sortBy: 'most-recent',
        limit: 10,
        resolution: 'low_resolution'
    });
    feed.run();
}

function quantityFunctionality() {
	$('.quantity .minus').on('click', function() {
		var current = parseInt($('.quantity input[type="number"]').val());
		if (current > 0) {
			$('.quantity input[type="number"]').val(current - 1);
		}
	})
	$('.quantity .plus').on('click', function() {
		var current = parseInt($('.quantity input[type="number"]').val());
		$('.quantity input[type="number"]').val(current + 1);
	})
}

function labelWidthFix() {
	var width = $('#container label.quantity-label').width();
	$('#container .variations_button label').css('width', width+20);
	$('#container .variations_button label.quantity-label').css('width', '18%');
	if ($(window).width() < 1190 && $(window).width() > 960 ) {
		$('#container button[type="submit"]').css('margin-left', '18%');
	}
}

function shippingAddressFix() {
	$('#ship-to-different-address input').on('click', function() {
		console.log('click')
		$('.shipping_address').slideToggle();
	})
}

function skinnyNav() {
	var margin = $(window).width() * 0.025;
	var width = $(window).width() - 90 - margin;
	$(".skinny .nav").css('width', width);
}

function packagesInCart() {
	if ($(window).width() > 960) {
		$('.component_container_table_item').each(function( i ) {
			var divHeight = $(this).height() - 75;
			var titleHeight = $(this).find('h3').height();
			var negativeMargin = divHeight - titleHeight;
			$(this).next($('.component_table_item')).css("margin-top", -negativeMargin)
		})
	} else {
		$('.component_container_table_item').each(function( i ) {
			$(this).next($('.component_table_item')).css("margin-top", 0)
		})
	}	
}

function noHero() {
	if ($('.no-hero').length > 0) {
		$('header').addClass('no-hero');
		$('.hero').hide();
	}
}


function swatchLinkOverride() {
	$('.products li .swatch-wrapper').on('click', function(e) {
		e.preventDefault();
		var link = $(this).closest($('a.permalink')).attr('href');
		window.location = link;
	})
}

function responsiveContainer() {
	$('.blog-post p').each(function() {
		if ($(this).has('iframe')) {
			$(this).addClass('responsive-container');
		}
	})
}









