$("#editdetail").click(function () {
    $("#detail").toggle();
    $("#newDetail").toggle();
});
$("#editawards").click(function () {
    $("#detailawards").toggle();
    $("#newawards").toggle();
});


$("#editservices").click(function () {
    $("#detailservices").toggle();
    $("#newservices").toggle();
});

$("#picEdit").click(function () {
    $(".logo-img").hide();
    $(".pic-edit").hide();
    $(".logo-up").show();
});

$('.selectpicker').selectpicker({
    style: 'btn-default',
    size: "auto",
    width: "100%"
});

$('.timepicker').timepicker();

$("#allTime").click(function () {
    $("#session").fadeToggle();
});

/* -- Upload Button -- */

document.getElementById("uploadBtnDd").onchange = function () {
    document.getElementById("uploadFileDd").value = this.value;
};

/*center modal*/

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

// Select2
$(".select2").select2({
    width: '100%'
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