jQuery(document).ready(function() {
   var $ = jQuery;
    $(window).scroll(function () {
        // ROYBIV Logo reaches navbar
        if ($(this).scrollTop() > 200) {
            //$('.navbar').fadeIn(400);
            $('.navbar').css('opacity',0.9);

        } else {
            $('.navbar').css('opacity',100);
        }
    });
});