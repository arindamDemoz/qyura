  $('#date-1').datepicker({

  });
  $('#date-2').datepicker({

  });
  $('#date-3').datepicker({

  });


  $('.pickDate').datepicker()
      .on('changeDate', function (ev) {
          $('.pickDate').datepicker('hide');
      });

  var hideKeyboard = function () {
      document.activeElement.blur();
      $(".pickDate").blur();
  };

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

  /* -- Upload Button -- */

  document.getElementById("uploadBtn").onchange = function () {
      document.getElementById("uploadFile").value = this.value;
  };

  /* -- Date Picker -- */