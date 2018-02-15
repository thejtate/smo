/**
 * Creates youtube player from id.
 */
(function ($) {

  $(window).load(function () {
    initVideo();
  });

  function initVideo() {
    var $btn = $(".video img");
    $btn.on('click', labnolIframe);
  }

  function labnolIframe() {
    var $this = $(this);

    var iframe = $('.video-player iframe');
    if ((typeof iframe !== "undefined") && (iframe.length)) {
      var src = iframe.attr("src");
      var width = iframe.attr("width");
      var height = iframe.attr("height");
      var iframe = document.createElement("iframe");
      iframe.setAttribute("src", src + "&autoplay=1");
      iframe.setAttribute("frameborder", "0");
      iframe.setAttribute("height", height);
      iframe.setAttribute("width", width);
      $(".video").append(iframe);
      $(".video #ytapiplayer").hide();
      $(".video .video-player").hide();
      $this.fadeOut(1000);
    }
  }


})(jQuery);
