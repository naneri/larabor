/*	Table OF Contents
	==========================
	Carousel
	Ajax Tab
	List view , Grid view  and compact view
	Global Plugins
	Customs Script
	responsive cat-collapse for homepage
	*/
	
	
$(document).ready(function() {
    /*==================================
	 Carousel 
	====================================*/

    // Featured Listings  carousel || HOME PAGE
    var owlitem = $(".item-carousel");

    owlitem.owlCarousel({
        //navigation : true, // Show next and prev buttons
        navigation: false,
        pagination: true,
        items: 5,
		itemsDesktopSmall: 	[979,3],
		itemsTablet: [768, 3],
        itemsTabletSmall: [660, 2],
		itemsMobile: [400,1]


    });

    // Custom Navigation Events
    $("#nextItem").click(function() {
        owlitem.trigger('owl.next');
    })
    $("#prevItem").click(function() {
        owlitem.trigger('owl.prev');
    })


    // Featured Listings  carousel || HOME PAGE
    var featuredListSlider = $(".featured-list-slider");

    featuredListSlider.owlCarousel({
        //navigation : true, // Show next and prev buttons
        navigation: false,
        pagination: false,
        items: 5,
        itemsDesktopSmall: 	[979,3],
        itemsTablet: [768, 3],
        itemsTabletSmall: [660, 2],
        itemsMobile: [400,1]
    });

    // Custom Navigation Events
    $(".featured-list-row .next").click(function() {
        featuredListSlider.trigger('owl.next');
    })
    $(".featured-list-row .prev").click(function() {
        featuredListSlider.trigger('owl.prev');
    })

    /*==================================
	Global Plugins || 
	====================================*/

    $('.long-list').hideMaxListItems({
        'max': 8,
        'speed': 500,
        'moreText': 'View More ([COUNT])'
    });


    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    /*=======================================================================================
		cat-collapse Hmepage Category Responsive view  
	========================================================================================*/
	
    $(window).bind('resize load', function() {
		
        if ($(this).width() < 767) {

        $('.cat-collapse').collapse('hide');
		
            $('.cat-collapse').on('shown.bs.collapse', function() {
                $(this).prev('.cat-title').find('.icon-down-open-big').addClass("active-panel");
                //$(this).prev('.cat-title').find('.icon-down-open-big').toggleClass('icon-down-open-big icon-up-open-big');
            });

            $('.cat-collapse').on('hidden.bs.collapse', function() {
                $(this).prev('.cat-title').find('.icon-down-open-big').removeClass("active-panel");
            })

        } else {
			
		$('.cat-collapse').removeClass('out').addClass('in').css('height', 'auto');
           
        }
		
    });

    // DEMO PREVIEW

    $(".tbtn").click(function() {
        $('.themeControll').toggleClass('active')
    })

}); // end Ready


	
