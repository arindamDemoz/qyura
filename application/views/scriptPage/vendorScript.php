<script src="<?php echo base_url(); ?>inspinia/js/plugins/clockpicker/clockpicker.js"></script>

<?php  if($this->uri->segment(1) == "partners" ){ 
    if($this->uri->segment(2) == "signUp" || $this->uri->segment(2) == "editProfile" ){ ?>
<!--<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>-->
<!--<script type="text/javascript">
    
//    Google Address Api
    var directionsDisplay; 
    var directionsService = new google.maps.DirectionsService();
    google.maps.event.addDomListener(window, 'load', function() {
        new google.maps.places.SearchBox(document.getElementById('centerAddress'));
        directionsDisplay = new google.maps.DirectionsRenderer({'draggable': true});
    });
</script>-->
<?php } } ?>

<script type="text/javascript">   
var count = 0;
function addMoreVideo() {
    $("#moreVideos").append('  <div class="col-lg-6"><div class="form-group"><label>Video *</label><input name="video[]" type="text" class="form-control" ></div></div>');
    var contentH  = $('.content').height();
    var colHeight = $("#moreVideos .col-lg-6").height();

    if(count % 2)
    {
        var contentH  = $('.content').height(contentH);
    }
    else
    {
        var contentH  = $('.content').height(contentH+colHeight);
    }
    count++;
}

function checkCheck(){
    if($("#checkDaysTime").find("input[type=checkbox]").is(":checked")){
        return true;
    }else{
        $("#checkDays").html("Please select at least one");
        return false;
    }
}

function timeSplit(time){
    var splitTime = time.split(":");
    var hour = parseInt(splitTime[0]);
    var min = parseInt(splitTime[1]);
    hour = hour*60;
    var totalTime = hour + min;
    return totalTime;
    
}

function timeSlot() {
    var i; var count = 0; var flag = 0;
    for(i=1;i<11;i++){
        if($("#check"+i).prop("checked") == true){
            var day1 = $("#open"+i).val();
            var day2 = $("#close"+i).val();
            var min1 = timeSplit(day1);
            var min2 = timeSplit(day2);
            count++;
            if(min1 < min2){ flag++; }else{}
        }
    }
    if(count == flag){ 
        $("#checkDays").html(""); 
        return true; 
    }else{ 
        $("#checkDays").html("Please enter valid time duration"); 
        return false; 
    }
}

$(document).ready(function () {
    $("#wizard").steps();
    $("#form").steps({
        bodyTag: "fieldset",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            // Always allow going backward even if the current step contains invalid fields!
            if (currentIndex > newIndex)
            {
                return true;
            }

            // Forbid suppressing "Warning" step if the user is to young
            if (newIndex === 3 && Number($("#age").val()) < 18)
            {
                return false;
            }

            var form = $(this);

            // Clean up if user went backward before
            if (currentIndex < newIndex)
            {
                // To remove error styles
                $(".body:eq(" + newIndex + ") label.error", form).remove();
                $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
            }

            // Disable validation on fields that are disabled or hidden.
            form.validate().settings.ignore = ":disabled,:hidden";

            // Start validation; Prevent going forward if false
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex)
        {
            // Suppress (skip) "Warning" step if the user is old enough.
            if (currentIndex === 2 && Number($("#age").val()) >= 18)
            {
                $(this).steps("next");
            }

            // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
            if (currentIndex === 2 && priorIndex === 3)
            {
                $(this).steps("previous");
            }
        },

        onCanceled: function (event) {
            window.location.assign('<?php echo site_url('partners'); ?>');
        },

        onFinishing: function (event, currentIndex)
        {

            var form = $(this);
            form.validate().settings.ignore = ":disabled";
            // Start validation; Prevent form submission if false
            if(form.valid() == true){
                if(checkCheck() == true){
                    if(checkText('centerName','err_centerName') == true){
                        if(checkEmail('centerEmail','err_centerEmail') == true){
                            if(checkPhone('centerContact','centreContactErr') == true){
                                if(checkPassword('password','confirm') == true){
                                    if(checkConfirm('password','confirm') == true){
                                        if(checkText('contactPersonName','err_coperson') == true){
                                            if(checkPhone('contactMobile','mobileErr') == true){
                                                return checkEmail();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }else{
                return form.valid();
            }
            // Disable validation on fields that are disabled.
            // At this point it's recommended to do an overall check (mean ignoring only disabled fields)




        },
        onFinished: function (event, currentIndex)
        {

            bootbox.alert({closeButton: false,message:"Hey thanks for providing these details.A verification link has been emailed to you.Kindly verify and then you are all set to login!",callback:function() {form.submit();}});
            $('.modal-footer').addClass('text-center');
            $('.modal-footer [data-bb-handler="ok"]').html('Okay');
            var form = $(this);
            // Submit form input

        }
    }).validate({
        errorPlacement: function (error, element)
        {
            element.before(error);
        },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });
    
    $("#formEdit").steps({
        bodyTag: "fieldset",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            // Always allow going backward even if the current step contains invalid fields!
            if (currentIndex > newIndex)
            {
                return true;
            }

            // Forbid suppressing "Warning" step if the user is to young
            if (newIndex === 3 && Number($("#age").val()) < 18)
            {
                return false;
            }

            var form = $(this);

            // Clean up if user went backward before
            if (currentIndex < newIndex)
            {
                // To remove error styles
                $(".body:eq(" + newIndex + ") label.error", form).remove();
                $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
            }

            // Disable validation on fields that are disabled or hidden.
            form.validate().settings.ignore = ":disabled,:hidden";

            // Start validation; Prevent going forward if false
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex)
        {
            // Suppress (skip) "Warning" step if the user is old enough.
            if (currentIndex === 2 && Number($("#age").val()) >= 18)
            {
                $(this).steps("next");
            }

            // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
            if (currentIndex === 2 && priorIndex === 3)
            {
                $(this).steps("previous");
            }
        },

        onCanceled: function (event) {
            window.location.assign('<?php echo site_url('partners/vendorServices'); ?>');
        },

        onFinishing: function (event, currentIndex)
        {

            var form = $(this);
            form.validate().settings.ignore = ":disabled";

            // Start validation; Prevent form submission if false
            if(form.valid() == true){
                if(checkCheck() == true){
                    if(checkText('centerName','err_centerName') == true){
                        if(checkEmail('centerEmail','err_centerEmail') == true){
                            if(checkPhone('centerContact','centreContactErr')){
                                if(checkText('contactPersonName','err_coperson')){
                                    if(checkPhone('contactMobile','mobileErr')){
                                        if(checkEmail('contactEmail','err_contactEmail')){
                                            return timeSlot();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }else{
                return form.valid();
            }
            // Disable validation on fields that are disabled.
            // At this point it's recommended to do an overall check (mean ignoring only disabled fields)




        },
        onFinished: function (event, currentIndex)
        {

            bootbox.alert({closeButton: false,message:"Hey thanks for providing these details.A verification link has been emailed to you.Kindly verify and then you are all set to login!",callback:function() {form.submit();}});
            $('.modal-footer').addClass('text-center');
            $('.modal-footer [data-bb-handler="ok"]').html('Okay');
            var form = $(this);
            // Submit form input

        }
    }).validate({
        errorPlacement: function (error, element)
        {
            element.before(error);
        },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });



//        $('.clockpicker').clockpicker();

});
    
//  Custom Show Hide Function
function customShowDays(checkId,day1,day2,type){

    if($("#"+checkId).prop("checked") == true){
        $('#'+day1).prop("disabled", false);
        $('#'+day2).prop("disabled", false);
        $("#"+day1).prop('required',true);
        $("#"+day2).prop('required',true);
        var total = $("#"+type+"_slots").val();
        
        $(".addShift_"+type).show();
       
    }else{
        $('#'+day1).prop("disabled", true);
        $('#'+day2).prop("disabled", true);
        $('#'+day1).val('');
        $('#'+day2).val('');
        $("#"+day1).prop('required',false);
        $("#"+day2).prop('required',false);

        $(".addShift_"+type).hide();
        
        var total = $("#"+type+"_slots").val();
        
        for(var i=2; i <= total ; i++){
            $("#"+type+"SlotDiv_"+i).remove();
        }
        
    }
}

function customTimeSlot(checkId,day1,day2){
        
        if($("#"+checkId).prop("checked") == true){
            $('#'+day1).show();
            $('#'+day2).show();
            $("#"+day1).prop('required',true);
            $("#"+day2).prop('required',true);
        }else{
            $('#'+day1).hide();
            $('#'+day2).hide();
            $('#'+day1).val('');
            $('#'+day2).val('');
            $("#"+day1).prop('required',false);
            $("#"+day2).prop('required',false);
        }
    }
    
function showWomenTime(selectVal,divId){
        if(selectVal == 1){
            $("#"+divId).show(function(){
                $("#"+divId).find("input[type=text]").prop('required',true);
                $("#"+divId).find("input[type=text]").prop('disabled',false);
                $("#"+divId).find("input[type=checkbox]").prop('checked',true);
                var contentH  = $('.content').height();
                var contentH  = $('.content').height(contentH+78);
            });
        }else{
             $("#"+divId).hide(function(){
                $("#"+divId).find("input[type=text]").prop('required',false);
                $("#"+divId).find("input[type=text]").prop('disabled',true);
                $("#"+divId).find("input[type=checkbox]").prop('checked',false);
                var contentH  = $('.content').height();
                var contentH  = $('.content').height(contentH-78);
            });
            
        }
    }

//   Fill Monday Value to all days
function allDaysHour(checkId,valId1,valId2){
        
        if($("#"+checkId).prop("checked") == true){
            var openHour = $("#"+valId1).val();
            var closeHour = $("#"+valId2).val();

            if(openHour == '' && closeHour == ''){
                alert("Monday Time is Required");
                $("#"+checkId).prop('checked', false);
            }else{
                var i;
                for(i=2;i<8;i++){
                    $("#check"+i).prop('checked', true);
                    $("#open"+i).prop("disabled", false);
                    $("#open"+i).val(openHour);
                    $("#close"+i).prop("disabled", false);
                    $("#close"+i).val(closeHour);
                }
            }
        }else{
            var j;
            for(j=2;j<8;j++){
                $("#check"+j).prop('checked', false);
                $("#open"+j).prop("disabled", true);
                $("#open"+j).val('');
                $("#close"+j).prop("disabled", true);
                $("#close"+j).val('');
            }
        }
    }

//  Validate Image 
var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                alert("Sorry,   '" + sFileName + "'   is invalid, allowed extensions are : -   " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
    
//  Validate File 
var _validFileDocExtensions = [".pdf", ".doc"];    
function ValidateSingleInputFile(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileDocExtensions.length; j++) {
                var sCurExtension = _validFileDocExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                alert("Sorry,   '" + sFileName + "'   is invalid, allowed extensions are : -   " + _validFileDocExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
   
</script>

<script type="text/javascript">
    function showHideFiled(id,checked){
        if (checked == 1) {
         $("#"+id).css("display", "block");
      }else if (checked == 0) {
        $("#"+id).css("display", "none");
      };
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.timepicker').timepicker({
            defaultTime: false,
            showMeridian:false
        });
        handleBootstrapSelect();
    });
</script>