(function($) {
  $(document).ready(function() {
    $('.red-excerpt-read-more').on('click', function(e) {
      /* Prevent link click */
      e.preventDefault();

      /* Hide read more excerpt */
      $(this).addClass('red-hidden');

      /* Show hidden part of excerpt */
      var overflowText = $(this).siblings('.red-overflow-excerpt');
      overflowText.removeClass('red-hidden');

    });
  });
})(jQuery);
