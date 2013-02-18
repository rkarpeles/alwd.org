jQuery(document).ready(function() { 
    
	// Drop Down Menu
	jQuery('ul#main-menu').superfish({ 
        delay:       600,
        animation:   {opacity:'show',height:'show'},
        speed:       'fast',
        autoArrows:  true,
        dropShadows: false
    });

	// Accordion
	jQuery( ".accordion" ).accordion( { autoHeight: false } );

	// Toggle
	jQuery( ".toggle > .inner" ).hide();
	jQuery(".toggle .title").toggle(function(){
		jQuery(this).addClass("active").closest('.toggle').find('.inner').slideDown(200, 'easeOutCirc');
	}, function () {
		jQuery(this).removeClass("active").closest('.toggle').find('.inner').slideUp(200, 'easeOutCirc');
	});

	// Tabs
	jQuery(function() {
		jQuery( "#tabs" ).tabs();
	});
	
	// Gallery Hover Effect
	jQuery(".gallery-item .gallery-thumbnail .zoom-wrapper").hover(function(){		
		jQuery(this).animate({ opacity: 1 }, 300);
	}, function(){
		jQuery(this).animate({ opacity: 0 }, 300);
	});
	
	// PrettyPhoto
	jQuery(document).ready(function(){
		jQuery("a[rel^='prettyPhoto']").prettyPhoto();
	});
	
	// Slides Loader
	jQuery("#slides").removeClass("slide-loader");
	
	// Mobile Menu

	// Create the dropdown base
	jQuery("<select />").appendTo("#main-menu-wrapper");
      
	// Create default option "Go to..."
	jQuery("<option />", {
		"selected": "selected",
		"value"   : "",
		"text"    : "Go to..."
	}).appendTo("#main-menu-wrapper select");
      
	// Populate dropdown with menu items
	jQuery("#main-menu a").each(function() {
		var el = jQuery(this);
		jQuery("<option />", {
			"value"   : el.attr("href"),
			"text"    : el.text()
		}).appendTo("#main-menu-wrapper select");
	});
	
	// To make dropdown actually work
	jQuery("#main-menu-wrapper select").change(function() {
		window.location = jQuery(this).find("option:selected").val();
	});
	
});

// Slider
jQuery(window).load(function(){
  jQuery('.slider').flexslider({
    animation: "slide",
	controlNav: false
  });
});

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel();
});