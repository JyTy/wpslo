jQuery(document).ready(function($) {
    
    // set body classes based on viewport
    responsiveFlow();
    $(window).on('resize', function(){
        responsiveFlow();
    });

    // Animate to plugin cat
    $('.plg-cat-list a').click(function(){
        $('html, body').animate({
            scrollTop: $( $.attr(this, 'href') ).offset().top
        }, 500);
        return false;
    });
});

function responsiveFlow() {
  var viewportWidth = jQuery(window).width();
    var viewportHeight = jQuery(window).height();
 
    if(0 < viewportWidth && viewportWidth <= 768){
        jQuery("body").addClass("mobileView").removeClass("tabView").removeClass("desktopView");
        jQuery(".stickyBar").trigger("sticky_kit:detach");
    }else if(768 < viewportWidth && viewportWidth <= 992){
        jQuery("body").addClass("tabView").removeClass("desktopView").removeClass("mobileView");
        jQuery(".stickyBar").trigger("sticky_kit:detach");
    }else{
        jQuery("body").addClass("desktopView").removeClass("tabView").removeClass("mobileView");
        jQuery(".stickyBar").stick_in_parent({parent: jQuery(".container")});
    }
}

(function($) {
    $(window).load(function() {
        $(".stickyBar").stick_in_parent({parent: $(".container")});

        $('.sidebar')
        .on('sticky_kit:bottom', function(e) {
            $(this).parent().css('position', 'static');
        })
        .on('sticky_kit:unbottom', function(e) {
            $(this).parent().css('position', 'relative');
        })
   });
})(jQuery);