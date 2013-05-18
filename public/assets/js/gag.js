jQuery(document).ready(function() {
   var $ = jQuery;


    $(window).scroll(function () {
        // ROYBIV Logo reaches navbar
        if ($(this).scrollTop() > 200) {
            $('.navbar').css('opacity',0.9);

        } else {
            $('.navbar').css('opacity',100);
        }
    });
    
    $('.boxgrid.thecombo').hover(function(){
            $(".cover", this).stop().animate({top:'260px', left:'325px'},{queue:false,duration:300});
    }, function() {
            $(".cover", this).stop().animate({top:'0px', left:'0px'},{queue:false,duration:300});
    });
});