$('.timepicker').timepicker();
$('#date-3').datepicker();

$('.pickDate').datepicker()
    .on('changeDate', function (ev) {
        $('.pickDate').datepicker('hide');
    });

var hideKeyboard = function () {
    document.activeElement.blur();
    $(".pickDate").blur();
};