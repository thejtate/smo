(function ($) {
    Drupal.behaviors.smoCustomHomepageEdit = {
      attach: function (context, settings) {

          var $galleryWrapper = $('.gallery-items', context)
              ,$galleryFeaturedCheckboxes = $galleryWrapper.find('.field-name-field-home-gallery-featured input'),
              featuredCheckbox = null;


          $galleryWrapper.once('checkbox-handler', function(){
              $galleryFeaturedCheckboxes.on('change', featuredSingleCheckedHandler);
          });

          function featuredSingleCheckedHandler() {
              var $this = $(this);
              if($(this).prop('checked')) {
                  $galleryFeaturedCheckboxes.not($this).prop('checked', false);
              }
          }

      }
    };
})(jQuery);