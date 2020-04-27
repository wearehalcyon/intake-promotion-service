'use_strict';

(function ($) {

    $(document).ready(function(){
        $.fn.equivalent = function (){
            var $blocks = $(this),
                maxH    = $blocks.eq(0).height();
            $blocks.each(function(){
                maxH = ( $(this).height() > maxH ) ? $(this).height() : maxH;
            });
            $blocks.height(maxH);
        }
        $('.campaignItem').equivalent();
    });

})(jQuery);
