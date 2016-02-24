  $('#date-1').datepicker(

  );
  $('#date-2').datepicker(

  );
  $('#date-3').datepicker(

  );

  /* -- Upload Button -- */

  document.getElementById("uploadBtn").onchange = function () {
      document.getElementById("uploadFile").value = this.value;
  };


  $('.pickDate').datepicker()
      .on('changeDate', function (ev) {
          $('.pickDate').datepicker('hide');
      });

  $('.selectpicker').selectpicker({
      style: 'btn-default',
      size: "auto",
      width: "100%"
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