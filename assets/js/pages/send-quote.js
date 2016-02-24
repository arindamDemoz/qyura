 $('#date-3').datepicker();
 $('#date-4').datepicker();
 $('#date-5').datepicker();
 $('#expiryDate').datepicker();
 $('.timepicker').timepicker();

 $('.pickDate').datepicker()
     .on('changeDate', function (ev) {
         $('.pickDate').datepicker('hide');
     });

 var hideKeyboard = function () {
     document.activeElement.blur();
     $(".pickDate").blur();
 };