(function ($) {
    $(document).ready(function () {
        $('.tlp-portfolio').each(function () { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: '.tlp-zoom', // the selector for gallery item
                type: 'image',
                preload: [1, 3],
                gallery: {
                    enabled: true
                }
            });
        });
    });

    var $isotop = $('.tlp-portfolio-isotope').imagesLoaded(function () {
        $.when(HeightResize()).done(function () {
            $isotop.isotope({
                itemSelector: '.tlp-single-item',
            });
        });
    });


    $('#tlp-portfolio-isotope-button').on('click', 'button', function () {
        var filterValue = $(this).attr('data-filter');
        $isotop.isotope({filter: filterValue});
        $(this).parent().find('.selected').removeClass('selected');
        $(this).addClass('selected');
    });

    $(window).resize(function () {
        overlayIconResize();
        HeightResize();
    });
    $(window).load(function () {
        overlayIconResize();
        HeightResize();
    });

})(jQuery);

function overlayIconResize() {
    jQuery('.tlp-item').each(function () {
        var holder_height = jQuery(this).height();
        var a_height = jQuery(this).find('.tlp-overlay .link-icon').height();
        var h = (holder_height - a_height) / 2;
        jQuery(this).find('.link-icon').css('margin-top', h + 'px');
    });
}

function HeightResize() {
    if (jQuery(window).width() > 768) {
        jQuery(document).imagesLoaded(function () {
            jQuery(".tlp-portfolio").each(function () {
                var tlpMaxH = 0;
                jQuery(this).children('.row').children(".tlp-equal-height").children(".tlp-portfolio-item").height("auto");
                jQuery(this).children('.row').children(".tlp-equal-height").each(function () {
                    var $thisH = jQuery(this).children(".tlp-portfolio-item").outerHeight();
                    if ($thisH > tlpMaxH) {
                        tlpMaxH = $thisH;
                    }
                });
                jQuery(this).children('.row').children(".tlp-equal-height").children(".tlp-portfolio-item").height(tlpMaxH + "px");
            });

            var tlpMaxH = 0;
            jQuery(".tlp-portfolio-isotope").children(".tlp-equal-height").children(".tlp-portfolio-item").height("auto");
            jQuery(".tlp-portfolio-isotope > .tlp-equal-height").each(function () {
                var $thisH = jQuery(this).children(".tlp-portfolio-item").outerHeight();
                if ($thisH > tlpMaxH) {
                    tlpMaxH = $thisH;
                }
            });
            jQuery(".tlp-portfolio-isotope").children(".tlp-equal-height").children(".tlp-portfolio-item").height(tlpMaxH + "px");
        });

    } else {
        jQuery(".tlp-portfolio").children('.row').children(".tlp-equal-height").children(".tlp-portfolio-item").height("auto");
        jQuery(".tlp-portfolio-isotope").children(".tlp-equal-height").children(".tlp-portfolio-item").height("auto");
    }
}