(function ($) {
    Drupal.behaviors.customActions = {
        attach: function (context, settings) {

            //Prevent open maps links in desktop version
            $('a[href$=".gif"], a[href$=".jpg"], a[href$=".png"], a[href$=".bmp"]', '.museum-map-page .field-collection-item-field-basic-content-blocks', context)
                .once('maps-links')
                .on('click', function () {
                    if ($('html').hasClass('desktop')) {
                        return false;
                    }
                });

            //member yes/no actions
            $('a[data-role$="not-member-btn"]').once('not-member-btn').on('click', function(e){
                $('div[data-role$="not-member-wrap"]').show();
                return false;
            });

        }

    };
})(jQuery);