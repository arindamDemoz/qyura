  $("#edit").click(function () {
      $("#detail").toggle();
      $("#editdetail").toggle();
  });
  $("#picEdit").click(function () {
      $(".logo-img").hide();
      $(".pic-edit").hide();
      $(".logo-up").show();
  });

  /* -- Upload Button -- */

  document.getElementById("uploadBtnP").onchange = function () {
      document.getElementById("uploadFileP").value = this.value;
  };


  /* -- center modal -- */
  $(function () {
      function reposition() {
          var modal = $(this),
              dialog = modal.find('.modal-dialog');
          modal.css('display', 'block');

          // Dividing by two centers the modal exactly, but dividing by three
          // or four works better for larger screens.
          dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
      }
      // Reposition when a modal is shown
      $('.modal').on('show.bs.modal', reposition);
      // Reposition when the window is resized
      $(window).on('resize', function () {
          $('.modal:visible').each(reposition);
      });
  });

  function isNumberKey(evt, id) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          $("#" + id).html("Please enter number key");
          return false;
      } else {
          $("#" + id).html('');
          return true;
      }
  }