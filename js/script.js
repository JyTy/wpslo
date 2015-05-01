jQuery(document).ready(function($) {
    
    // set body classes based on viewport
    responsiveFlow();
    $(window).on('resize', function(){
        responsiveFlow();
    });
});

function responsiveFlow() {
  var viewportWidth = jQuery(window).width();
    var viewportHeight = jQuery(window).height();
 
    if(0 < viewportWidth && viewportWidth <= 768){
        jQuery("body").addClass("mobileView").removeClass("tabView").removeClass("desktopView");
    }else if(768 < viewportWidth && viewportWidth <= 992){
        jQuery("body").addClass("tabView").removeClass("desktopView").removeClass("mobileView");
    }else{
        jQuery("body").addClass("desktopView").removeClass("tabView").removeClass("mobileView");
    }
}