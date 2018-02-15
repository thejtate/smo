(function ($) {

  if (typeof Drupal != 'undefined') {
    Drupal.behaviors.smo2016 = {
      attach: function (context, settings) {
        init();
      },

      completedCallback: function () {
        // Do nothing. But it's here in case other modules/themes want to override it.
      }
    }
  }

  $(function () {
    if (typeof Drupal == 'undefined') {
      init();
    }

    $(window).load(function () {
      initShowEvents();
    });
  });

  function init() {
    initSectionTopImg();
    initMobileNav();
    initElmsAnimation();
    initSectionHomeRandom();
    initFlexslider();
    initSelect();
    initFullWidthBlock();
    initScroll();
    initMargin();
    initAccordion();
  }

  function initAccordion() {
    var $elms = $('.b-accordion');

    if(!$elms.length) return;

    $elms.each(function() {
      var $this = $(this);
      var $items = $this.find('.accordion-item');

      $items.each(function() {
        var $this = $(this);

        $this.find('.item-hd').on('click', function() {
          $this.toggleClass('active');
        });
      });
    });
  }

  function initMargin() {
    var $elems = $('.full-block');

    $elems.find('.bg').each(function() {
      var $this = $(this);

      if($this.parents('.field-item').next().find('.b-with-bg').length) {
        $this.parents('.full-block').css('margin-bottom', 0);
      }

      if($this.parents('.field-item:last-child').length) {
        $this.parents('.full-block').css('margin-bottom', 0);
        $('.content-wrapper .container').css('padding-bottom', 0);
      }
    });
  }

  function initSectionTopImg() {
    var section = document.querySelector('.section-top .bg');

    if (!section) return;

    var img = section.querySelector('img');
    var sectionHeight, width, height;

    $(img).on('load', function () {
      setTimeout(function () {
        width = img.naturalWidth;
        height = img.naturalHeight;

        checkValues();

        img.style.opacity = 1;
      }, 60);
    });

    window.addEventListener('resize', function () {
      checkValues();
    });

    function checkValues() {
      if (width < 2560 || height < 634) {
        setValues();
      }
    }

    function setValues() {
      sectionHeight = section.offsetHeight;

      img.style.width = '100%';
      img.style.height = 'auto';

      if (img.offsetHeight < sectionHeight) {
        img.style.height = '100%';
        img.style.width = 'auto';
      }
    }
  }

  function initShowEvents() {
    var $wrapper = $('.smo-calendar-views-day-wrapper');

    if (!$wrapper.length) return;

    $wrapper.addClass('show-events');
  }

  function initScroll() {
    var $calendarWrapper = $(".calendar-wrapper");

    if (!$calendarWrapper.length) return;

    $calendarWrapper.find('.smo-calendar-views-day-wrapper .item-bd').scrollbar({
      "autoScrollSize": false
    });
  }

  function initElmsAnimation() {
    var $elms = $('.el-with-animation');
    var animationEnd = [];

    $(window).on('resize scroll', checkScroll);

    checkScroll();

    function checkScroll() {
      if (animationEnd.length === $elms.length) return;

      for (var i = 0; i < $elms.length; i++) {
        var $currentEl = $elms.eq(i);
        if (!$currentEl.hasClass('animating-end') && $(window).height() + $(window).scrollTop() > $currentEl.offset().top + $currentEl.height() / 2 + 50) {
          animate($currentEl);
        }
      }
    }

    function animate(el) {
      el.addClass('animating-end');
      animationEnd.push(1);
    }
  }

  function initMobileNav() {
    var $wrapper = $('#site-header');
    var $btn = $wrapper.find('.btn-mobile');
    var $list = $wrapper.find('.nav li a');
    var $html = $('html');

    if ($wrapper.hasClass('mobile-nav-processed')) return;

    $wrapper.addClass('mobile-nav-processed');
    $list.closest('.expanded').append('<span class="ico"></span>');

    $btn.on('click touch', function (e) {
      e.preventDefault();

      $('body').toggleClass('mobile-nav-active');
    });

    $list.parent().find('.ico').on('click touch', function (e) {
      var $this = $(this);

      if ($this.siblings('ul').length && $(window).outerWidth() < 992) {
        e.preventDefault();

        $this.parent().toggleClass('next-level-active');
      }
    });
  }

  function initFullWidthBlock() {
    var $elements = $('.full-block'),
      minWidth = 0;

    $(window).on('resize', setPosition);
    setPosition();

    function setPosition() {
      var $winWidth = $(window).outerWidth(),
        width;

      if ($winWidth > minWidth) {
        width = $winWidth;
      } else {
        width = minWidth;
      }

      $elements.width(width);
      $elements.css('margin-left', '-' + width / 2 + 'px');
    }
  }

  function initSectionHomeRandom() {
    var $wrapper = $('.section-home.random-items');

    if (!$wrapper.length || $wrapper.hasClass('random-items-processed')) return;

    $wrapper.addClass('random-items-processed');

    var $items = $wrapper.find('.item');
    var staticItem = $items.filter('.style-slider').index();
    var itemsLength = $items.length;

    if (!$items.is('.style-big')) {
      random();
    }

    var bigItem = $items.filter('.style-big').index();

    function random() {
      var result = randomInteger(0, itemsLength - 1);

      if (result == staticItem) {
        random();
      } else {
        $items.eq(result)
          .removeClass('col-lg-3 col-md-6 col-md-3')
          .addClass('col-lg-6 col-md-6 style-big');
      }
    }

    var arr = [];

    for (var x = 0; x < itemsLength; x++) {
      arr.push(x);
    }

    var newArr = [];
    getRandom(newArr);

    for (var i = 0; i < itemsLength; i++) {
      $wrapper.append($items.eq(newArr[i]));
    }

    function getRandom(arr) {
      var num = randomInteger(0, itemsLength - 1);
      var result = checkRandom(arr, num);

      if (!result) {
        if (num !== staticItem && num !== bigItem) {
          newArr.push(num);
        }
      }

      if (staticItem > -1) {
        if (newArr.length < itemsLength - 2) {
          getRandom(newArr);
        } else {
          newArr.unshift(staticItem);
          newArr.unshift(bigItem);
        }
      } else {
        if (newArr.length < itemsLength - 1) {
          getRandom(newArr);
        } else {
          newArr.unshift(bigItem);
        }
      }
    }

    function checkRandom(arr, num) {
      var result = false;

      for (var y = 0; y < arr.length; y++) {
        if (arr[y] == num) {
          result = true;

          break;
        }
      }

      return result;
    }

    function randomInteger(min, max) {
      var rand = min + Math.random() * (max + 1 - min);
      rand = Math.floor(rand);

      return rand;
    }
  }

  function initFlexslider() {
    $('.flexslider').flexslider();
  }

  function initSelect() {
    $('select').select2({
      width: 'full',
      minimumResultsForSearch: Infinity
    });
  }

})(jQuery);