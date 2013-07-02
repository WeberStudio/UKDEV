jQuery(document).ready(function(){
    scrollWrapper = jQuery('.scroll-box');
    scrollContent = jQuery('.scroll-box .grid');

    if( !Modernizr.touch ){

        scrollWrapper.mousewheel(function(event, delta, deltaX, deltaY) {
            console.log(scrollWrapper.width());
            var currentScroll = parseInt( jQuery(this).scrollLeft());
            jQuery(this).scrollLeft( currentScroll + (-deltaY*100) );
            var finalRight = ((scrollContent.width() -   jQuery(this).scrollLeft()) == scrollWrapper.width());
            console.log(scrollContent.width() -   jQuery(this).scrollLeft());
            var finalLeft =  (jQuery(this).scrollLeft() == 0);
            if( finalRight && (deltaY < 0) ) {
                var windowScroll = jQuery(window).scrollTop();
                windowScroll +=50;
                jQuery(window).scrollTop(windowScroll);
            } else if(finalLeft && (deltaY > 0) ){
                var windowScroll = jQuery(window).scrollTop();
                windowScroll -=50;
                jQuery(window).scrollTop(windowScroll);
            }
            scrollWrapper.getNiceScroll().resize();
        });
    }

    try{
        scrollWrapper.niceScroll({
            cursorcolor:"#57bae8",
            cursorwidth:"16px",
            cursorborder:"none",
            cursorborderradius:"0px",
            cursoropacitymin:"1",
            background:"#f0f3f4",
            railpadding:{top:"20px"}
        }).rail.css({'height':'15px'});
    } catch(e){
        console.log("Seems scrolling works wrong.");
    }

});


