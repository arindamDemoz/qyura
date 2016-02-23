$('#date-3').datepicker();

$('.selectpicker').selectpicker({
    style: 'btn-default',
    size: "auto",
    width: "100%"
});

$("#bloodbank").click(function () {
    $("#bloodbankOption").fadeToggle();
});

$("#pharmacy").click(function () {
    $("#pharmacyOption").fadeToggle();
});

$("#ambulance").click(function () {
    $("#ambulanceOption").fadeToggle();
});

/* -- Upload Button -- */
document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};

document.getElementById("uploadBtnBb").onchange = function () {
    document.getElementById("uploadFileBb").value = this.value;
};

document.getElementById("uploadBtnP").onchange = function () {
    document.getElementById("uploadFileP").value = this.value;
};

document.getElementById("uploadBtnA").onchange = function () {
    document.getElementById("uploadFileA").value = this.value;
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