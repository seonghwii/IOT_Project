(function ($) {

	new WOW().init();			
		
		$('.testimonialslide').flexslider({
		animation: "slide",
		slideshow: false,
		directionNav:false,
		controlNav: true
		});
		
		
		//parallax
        if ( $('#parallax').length )
        {
			$(window).stellar({
				responsive:true,
                scrollProperty: 'scroll',
                parallaxElements: false,
                horizontalScrolling: false,
                horizontalOffset: 0,
                verticalOffset: 0
            });

        }
	
		

})(jQuery);

//	alert("SS");