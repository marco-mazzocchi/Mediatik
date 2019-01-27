(function(document, $) {

   $(function() {

      // require user confirm before click on class "confirm-required"
      $('.confirm-required').on('click', function(e) {

         var self = $(this);
         var message = self.data("message") || "Sei sicuro di voler procedere?";
         return confirm(message);

      });

      // star rating plugin
      var starRating = $('.star-rating-wrapper');
      if(starRating.length) {
         starRating.rating();
      }

      // chosen plugin
      $(".chosen-select").chosen();


      new Clipboard('.clipboard');

      $('#copy-to-clipboard').on('click', function(e) {
         e.preventDefault();
         var modal = $('#email-address-list-modal');
         modal.modal();
      });

      // toggle filter in journalists page
      $('#journalists-filters').hide();
      $('#filter-btn').on('click', function(e) {
          e.preventDefault();
          $('#journalists-filters').slideToggle();
       });


   });

})(document, jQuery);
