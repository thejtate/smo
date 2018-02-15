/**
 * Created by dimateus on 05/05/16.
 */
(function ($) {
  Drupal.behaviors.smoCalendar = {
    attach: function (context, settings) {

        var $daysLink = $('.calendar-more-days', context),
            $closeBtn = $('.smo-calendar-btn-close', context);

            $daysLink.once('calendar-actions').on('click', function() {

                var $dayWrap = $('.smo-calendar-views-day-wrapper');
                $dayWrap.hide();

                if($dayWrap.hasClass('show-events')) {
                    $dayWrap.removeClass('show-events');
                }

                $('.smo-calendar-views-month-wrapper').show();

                var $wrap = $('.calendar-wrapper');
                if(!$wrap.hasClass('more-days-clicked')) {
                    $wrap.addClass('more-days-clicked');
                }
                return false;
            });

        $closeBtn.once('calendar-actions').on('click', function() {

            $('.smo-calendar-views-month-wrapper').hide();
            var $dayWrap = $('.smo-calendar-views-day-wrapper');
            if($dayWrap.hasClass('show-events')) {
                $dayWrap.removeClass('show-events')
            }
            $dayWrap.show();

            setTimeout(function() {
                $dayWrap.addClass('show-events');
            }, 50);


            return false;
        });

    }
  };

    Drupal.ajax.prototype.commands.smoCalendarSetDate = function(ajax, response, status) {

        if(typeof response.id !== 'undefined' && typeof response.cells_selector !== 'undefined') {
            var cells = $(response.cells_selector);
            cells.removeClass('current');
            cells.filter('#' + response.id).addClass('current');
        }
    }

})(jQuery);