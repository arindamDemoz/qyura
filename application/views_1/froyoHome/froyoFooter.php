<!-- javascript/jquery plugins -->
        <script src="<?php echo base_url(); ?>assest/js/vendor/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/bootbox.min.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/matchMedia.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/smooth-scroll.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/smoothscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/fitvids.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/backgroundvideo.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/nivo-lightbox.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/owl.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/retina.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/scroll-to-top.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/wow.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/form.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/validate.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/contact.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/ajaxchimp.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/main.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assest/bootstrap-select/bootstrap-select.min.js"></script>
<!--        <script type="text/javascript" src="<?php echo base_url(); ?>assest/select2/select2.min.js"></script>-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>

       <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,500italic,900' rel='stylesheet' type='text/css'>

    <script>
    var directionsDisplay; 
    var directionsService = new google.maps.DirectionsService();
    google.maps.event.addDomListener(window, 'load', function() {
        new google.maps.places.SearchBox(document.getElementById('partnerLocation'));
        directionsDisplay = new google.maps.DirectionsRenderer({'draggable': true});
    });
            $(document).ready(function(){
                handleBootstrapSelect();
            });
                
            var handleBootstrapSelect   = function(){
                $('.bs-select').selectpicker({
                    iconBase: 'fa',
                    tickIcon: 'fa-check',
                    liveSearch:false
                });

            }

            function fromSubMess(){
                bootbox.alert("Hey thanks for providing these details. We will come back to you. Ciao till then!", function() {});
            }
            
           function customMessPop(inFd,divId,mess){
                if(mess == 0 ){var name = " Nice Name!"; var check = checkText('partnerName','er_partnerName'); }
                if(mess == 1 ){var name = " Won't Spam!"; var check = checkEmail('partnerEmail','er_partnerEmail') }
                if(mess == 2 ){var name = " Great!"; var check = checkPhone('partnerMobile','er_partnerMobile'); }
                if(mess == 3 ){var name = " Happening Huh!"; var check = 'true'; }
                
                var bdate = $("#"+inFd).val();
                bdate = $.trim(bdate);
                bdate = bdate.split(" ");
                if(check){
                    if(bdate != ''){
                        if(mess == 0){
                            $("#"+divId).html(bdate[0]+name);
                        }else{
                            $("#"+divId).html(name);
                        }
                    }
                }
            }

            function isNumberKey(evt){   
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
                return true;
            }
            
	    function isAlphaNumeric(e){ // Alphanumeric only
		var k;
		document.all ? k=e.keycode : k=e.which;
		return((k>47 && k<58)||(k>64 && k<91)||(k>96 && k<123)||k==0 || k == 32 || k == 8 || k == 127);
	     }
     
	    function isAlpha(e){ // Alphanumeric only
		var k;
		document.all ? k=e.keycode : k=e.which;
		return((k >= 65 && k <= 90) || (k >= 97 && k <= 122) ||k==0 || k == 32 || k == 8 || k == 127 || k == 9);
		
	     }

            function customShow(id,textId){
                
                var anyVal = $("#"+id).val();
                
                if(jQuery.inArray("other", anyVal) !== -1){
                    
                    $("#"+textId).removeAttr('disabled');
                    $("#"+textId).show();
                }else{
                    
                    $("#"+textId).attr('disabled', "");
                    $("#"+textId).hide();
                }
            }
            
            
            $(document).ready(function(){
    
	    $("#emilList").submit(function( event ) {
                var check = checkEmail('EMAIL','err_email');
                if(check){
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    
                    type:"POST",
                    url:'<?php echo site_url(); ?>/froyofit/emailList',
                    data:formData,//only input
                    processData: false,
                    contentType: false,
                    xhr: function()
                    {
                        $("#loader").show();
                        var xhr = new window.XMLHttpRequest();
                        //Upload progress
                        xhr.upload.addEventListener("progress", function(evt){
                          if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total)*100;
                            $('#emailListLoad .progress-bar').css('width',percentComplete+'%');
                          }
                        }, false);
                        //Download progress
                        xhr.addEventListener("progress", function(evt){
                          if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                          }
                        }, false);
                        return xhr;
                    },
                    success: function(response, textStatus, jqXHR){
                        try {
                            $("#loader").hide();
                            var data = $.parseJSON(response);
                            if(data.status == 0)
                            {
                                if(data.isAlive)
                                {
                                    $('#emailListLoad .progress-bar').css('width','00%');
                                    console.log(data.errors);
                                    $.each(data.errors, function( index, value ) {
                                        $('#er_'+index).html(value);
                                    });
                                    $('#er_TopError').show();
                                    setTimeout(function(){
                                        $('#er_TopError').hide(800);
                                        $('#er_TopError').html('');
                                    },2000);
                                }
                                else
                                {
                                    $('#headLogin').html(data.loginMod);
                                }
                            }
                            else{
                                $('#emailListSuccess').show();
                                $('#emailListSuccess').html(data.msg);
                                bootbox.alert({closeButton: false,message:"Hey thanks for providing these details. We will come back to you.!",callback:function() {}});
                                $('.modal-footer').addClass('text-center');
                                $('.modal-footer [data-bb-handler="ok"]').html('Close');
                                 setTimeout(function(){
                                    $('#emailListSuccess').hide(800);
                                    $('#emailListSuccess').html('');
                                    $('#EMAIL').val('');
                                    $('.bs-select').selectpicker('deselectAll');
                                    $('.bs-select').val('');
                                    $('.bs-select').selectpicker('refresh');
                                 });
                            }
                        }catch(e) {
                            $('#er_TopError').show();
                            $('#er_TopError').html(e);
                            setTimeout(function(){
                                    $('#er_TopError').hide(800);
                                    $('#er_TopError').html('');
                                },2000);
                            }
                    }
                });
                }else{
                    $(".has-error").html("Please enter valid Email.");
                    return false;
                }
            });

            $("#requestCallback").submit(function( event ) {
                var checkE = checkEmail('callbackEmail','er_callbackEmail');
                var checkM = checkPhone('callbackMobile','er_callbackMobile'); 
                var checkT = checkText('callbackName','er_callbackName');
                
                if(checkT == true){
                    if(checkM == true){
                        if(checkE == true){
                        event.preventDefault();
                        var formData = new FormData(this);
                        $.ajax({

                            type:"POST",
                            url:'<?php echo site_url(); ?>/froyofit/requestCallback',
                            data:formData,//only input
                            processData: false,
                            contentType: false,
                            xhr: function()
                            {
                                $("#loader").show();
                                var xhr = new window.XMLHttpRequest();
                                //Upload progress
                                xhr.upload.addEventListener("progress", function(evt){
                                  if (evt.lengthComputable) {
                                    var percentComplete = (evt.loaded / evt.total)*100;
                                    $('#callbackLoad .progress-bar').css('width',percentComplete+'%');
                                  }
                                }, false);
                                //Download progress
                                xhr.addEventListener("progress", function(evt){
                                  if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                  }
                                }, false);
                                return xhr;
                            },
                            success: function(response, textStatus, jqXHR){
                                try {
                                    $("#loader").hide();
                                    var data = $.parseJSON(response);
                                    if(data.status == 0)
                                    {
                                        if(data.isAlive)
                                        {
                                            $('#callbackLoad .progress-bar').css('width','00%');
                                            console.log(data.errors);
                                            $.each(data.errors, function( index, value ) {
                                                $('#er_'+index).html(value);
                                            });
                                            $('#er_TopError').show();
                                            setTimeout(function(){
                                                $('#er_TopError').hide(800);
                                                $('#er_TopError').html('');
                                            },2000);
                                        }
                                        else
                                        {
                                            $('#headLogin').html(data.loginMod);
                                        }
                                    }
                                    else{
                                        $('#callbackSuccess').show();
                                        $('#callbackSuccess').html(data.msg);
                                        bootbox.alert({closeButton: false,message:"Hey thanks for providing these details. We will contact you soon.!",callback:function() {location.reload(true);}});
                                        $('.modal-footer').addClass('text-center');
                                        $('.modal-footer [data-bb-handler="ok"]').html('Close');
                                         setTimeout(function(){
                                            $('#callbackSuccess').hide(800);
                                            $('#callbackSuccess').html('');
                                            $('.bs-select').selectpicker('deselectAll');
                                            $('.bs-select').val('');
                                            $('.bs-select').selectpicker('refresh');
                                         });
                                    }
                                }catch(e) {
                                    $('#er_TopError').show();
                                    $('#er_TopError').html(e);
                                    setTimeout(function(){
                                            $('#er_TopError').hide(800);
                                            $('#er_TopError').html('');
                                        },2000);
                                    }
                            }
                        });
                        }else{
                            $("#er_callbackEmail").html("Please enter valid Email.");
                            return false;
                        }
                    }else{
                        $("#er_callbackMobile").html("Please enter valid Number.");
                        return false;
                    }
                }else{
                    $("#er_callbackName").html("Please enter a valid Name.");
                    return false;
                }
            });
            
            $("#partnerWithUs").submit(function( event ) {
        
                var checkE = checkEmail('partnerEmail','er_partnerEmail');
                var checkM = checkPhone('partnerMobile','er_partnerMobile'); 
                var checkT = checkText('partnerName','er_partnerName');
                
                if(checkT == true){
                    if(checkM == true){
                        if(checkE == true){
                            event.preventDefault();
                            var formData = new FormData(this);
                            $.ajax({

                                type:"POST",
                                url:'<?php echo site_url(); ?>/froyofit/partnerWithUs',
                                data:formData,//only input
                                processData: false,
                                contentType: false,
                                xhr: function()
                                {
                                    $("#loader").show();
                                    var xhr = new window.XMLHttpRequest();
                                    //Upload progress
                                    xhr.upload.addEventListener("progress", function(evt){
                                      if (evt.lengthComputable) {
                                        var percentComplete = (evt.loaded / evt.total)*100;
                                        $('#partnerLoad .progress-bar').css('width',percentComplete+'%');
                                      }
                                    }, false);
                                    //Download progress
                                    xhr.addEventListener("progress", function(evt){
                                      if (evt.lengthComputable) {
                                        var percentComplete = evt.loaded / evt.total;
                                      }
                                    }, false);
                                    return xhr;
                                },
                                success: function(response, textStatus, jqXHR){
                                    try {
                                        $("#loader").hide();
                                        var data = $.parseJSON(response);
                                        if(data.status == 0)
                                        {
                                            if(data.isAlive)
                                            {
                                                $('#partnerLoad .progress-bar').css('width','00%');
                                                console.log(data.errors);
                                                $.each(data.errors, function( index, value ) {
                                                    $('#er_'+index).html(value);
                                                });
                                                $('#er_TopError').show();
                                                setTimeout(function(){
                                                    $('#er_TopError').hide(800);
                                                    $('#er_TopError').html('');
                                                },2000);
                                            }
                                            else
                                            {
                                                $('#headLogin').html(data.loginMod);
                                            }
                                        }
                                        else{
                                            $('#partnerSuccess').show();
                                            $('#partnerSuccess').html(data.msg);
                                            bootbox.alert({closeButton: false,message:"Hey thanks for providing these details. We will come back to you.!",callback:function() {location.reload(true);}});
                                            $('.modal-footer').addClass('text-center');
                                            $('.modal-footer [data-bb-handler="ok"]').html('Close');
                                             setTimeout(function(){
                                                $('#partnerSuccess').hide(800);
                                                $('#partnerSuccess').html('');
                                                $('.bs-select').selectpicker('deselectAll');
                                                $('.bs-select').val('');
                                                $('.bs-select').selectpicker('refresh');
                                             });
                                        }
                                    }catch(e) {
                                        $('#er_TopError').show();
                                        $('#er_TopError').html(e);
                                        setTimeout(function(){
                                                $('#er_TopError').hide(800);
                                                $('#er_TopError').html('');
                                            },2000);
                                        }
                                }
                            });
                        }else{
                            $("#er_partnerEmail").html("Please enter valid Email.");
                            return false;
                        }
                    }else{
                        $("#er_partnerMobile").html("Please enter valid Number.");
                        return false;
                    }
                }else{
                    $("#er_partnerName").html("Please enter a valid Name.");
                    return false;
                }
            });

        });
        
function checkPhone(id,errId){
     var mobile = $("#"+id).val();
     if(mobile.length<10 || mobile.length>11){
        $("#"+errId).html("Please enter a valid number");
        return false;
     }else{
         $("#"+errId).html('');  
         return true;
     }
}
 
function checkText(textId,errId){
    
    var name = $("#"+textId).val();
    if(name.length<3 ){
       $("#"+errId).html("Please enter a valid name");
       return false;
    }else{
        $("#"+errId).html('');  
        return true;
    }
}

function checkEmail(id,errId){
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    var email = $('#'+id).val();
    if(email!==''){
        if (!filter.test(email)){
            console.log('else pars');
            $("#email_msg").html('');
            var uleliment = $("#email").next();

            if(!uleliment.hasClass('parsley-error-list')) {
               $("#"+errId).html("Please enter valid Email.");
               return false;
            }
        }else{
            $("#"+errId).html('');
            return true;
        }
    }else{
        $("#"+errId).html("Please enter valid Email.");
       return false;
    }
}

</script>

    </body>

</html>
