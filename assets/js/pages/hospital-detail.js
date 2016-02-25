var app = angular.module('myApp', []);

app.controller('diag-c-avail', function ($scope) {
    $scope.names = [
        'MRI',

        "PET",
        'X-Ray',
        'Ultra Sonography',
        'X-Ray-2',
        'Mri-2',
        'Pet',
        'Mary',
        'Mri'
    ];
});


app.controller('diag-c-testing', function ($scope) {

    var a = '[{"testname":"Alfreds Futterkiste","City":"Berlin","Country":"Germany"},{"testname":"Alfreds Futterkiste","City":"Berlin","Country":"Germany"},{"testname":"Alfreds Futterkiste","City":"Berlin","Country":"Germany"},{"testname":"Alfreds Futterkiste","City":"Berlin","Country":"Germany"},{"testname":"Alfreds Futterkiste","City":"Berlin","Country":"Germany"},{"testname":"Alfreds Futterkiste","City":"Berlin","Country":"Germany"},{"testname":"Alfreds Futterkiste","City":"Berlin","Country":"Germany"},{"testname":"Alfreds Futterkiste","City":"Berlin","Country":"Germany"}]';
    $scope.names2 = JSON.parse(a);
    console.log($scope.names2);

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

$("#editpharma").click(function () {
    $("#detailpharma").toggle();
    $("#newpharma").toggle();
});

$("#editbbk").click(function () {
    $("#detailbbk").toggle();
    $("#newbbk").toggle();
});

$("#editac").click(function () {
    $("#detailac").toggle();
    $("#newac").toggle();
});


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

$("#edit").click(function () {
    $("#detail").toggle();
    $("#newDetail").toggle();
});
$("#editdetail").click(function () {
    $("#detail").toggle();
    $("#newDetail").toggle();
});

$("#editcompany").click(function () {
    $("#detailcompany").toggle();
    $("#newcompany").toggle();
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

$("#pharmacybtn").click(function () {
    $("#pharmacydetail").fadeToggle();
});

$("#bloodbankbtn").click(function () {
    $("#bloodbankdetail").fadeToggle();
});

/* -- Upload Button -- */

document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};

document.getElementById("uploadBtnBg").onchange = function () {
    document.getElementById("uploadFileBg").value = this.value;
};

document.getElementById("uploadBtnBb").onchange = function () {
    document.getElementById("uploadFileBb").value = this.value;
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


/* activate the carousel */
$("#modal-carousel").carousel({
    interval: false
});

/* change modal title when slide changes */
$("#modal-carousel").on("slid.bs.carousel", function () {
    $(".modal-title").html($(this).find(".active img").attr("title"));
})


