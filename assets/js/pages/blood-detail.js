$("#edit").click(function () {
    $("#detail").toggle();
    $("#newDetail").toggle();
});

$("#opve").click(function () {
    $("#opveDetail").fadeToggle();
});
$("#onve").click(function () {
    $("#onveDetail").fadeToggle();
});

$("#apve").click(function () {
    $("#apveDetail").fadeToggle();
});
$("#anve").click(function () {
    $("#anveDetail").fadeToggle();
});

$("#picEdit").click(function () {
    $(".logo-img").hide();
    $(".logo-up").show();
    $("#picEdit").hide();
    $("#picEditClose").show();

});

$("#picEditClose").click(function () {
    $(".logo-up").hide();
    $(".logo-img").show();
    $("#picEdit").show();
    $("#picEditClose").hide();


});

/* -- Upload Button -- */

//document.getElementById("uploadBtnB").onchange = function () {
//    document.getElementById("uploadFileB").value = this.value;
//};


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