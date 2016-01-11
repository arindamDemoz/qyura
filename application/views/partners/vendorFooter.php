                <div class="footer">
                    <div>
                        <strong>Copyright</strong> Froyofit &copy; 2015
                    </div>
                </div>
            </div>
        </div>
<!--        <button onclick="demo()">fhfdghdf</button>-->
<!-- sometime later, probably inside your on load event callback -->
        <!-- Mainly scripts -->
        <script src="<?php echo base_url(); ?>inspinia/js/jquery-2.1.1.js"></script>
        <script src="<?php echo base_url(); ?>inspinia/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo base_url(); ?>inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <!-- Custom and plugin javascript -->
        <script src="<?php echo base_url(); ?>inspinia/js/inspinia.js"></script>
        <script src="<?php echo base_url(); ?>inspinia/js/plugins/pace/pace.min.js"></script>
        <!-- Steps -->
        <script src="<?php echo base_url(); ?>inspinia/js/plugins/staps/jquery.steps.js"></script>
        <!-- Jquery Validate -->
        <script src="<?php echo base_url(); ?>inspinia/js/plugins/validate/jquery.validate.min.js"></script>
        
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>assest/select2/select2.min.js"></script>-->

        <script src="<?php echo base_url(); ?>assest/js/bootbox.min.js"></script>
        <script src="<?php echo base_url(); ?>assest/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>inspinia/js/reCopy.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assest/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="<?php echo base_url(); ?>assest/js/icheck.js"  type="text/javascript"></script> 
        <script>
                $('.multiCheckbox').each(function(){
                    var self = $(this),
                      label = self.next(),
                      label_text = label.text();

                    label.remove();
                    self.iCheck({
                      checkboxClass: 'icheckbox_line-grey',
                      radioClass: 'iradio_line-grey',
                      insert: '<div class="icheck_line-icon"></div>' + label_text
                    });
                });
               
                
                $('.multiCheckbox').on('ifUnchecked', function(){
                    $(this).parent().css('background-color',"grey");
                });
                
                $('.multiCheckbox').on('ifChecked', function(){ 
                    $(this).parent().css('background-color',"#1ED3B5");
                });
        
            $(function(){
                var removeLink = ' <a class="remove add btn btn-danger" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"><i class="fa fa-minus"></i></a>';
              $('a.add').relCopy({ append: removeLink});	
            });
            function customShow(id,textId){
                if($("#"+id).prop("checked") == true){
                    $("#"+textId).show();
                    $("#"+textId+" input").prop('required',true);
                }else{
                    $("#"+textId).hide();
                    $("#"+textId+" input").prop('required',false);
                }
            }
            
            var handleBootstrapSelect   = function(){
                $('select').selectpicker({
                    iconBase: 'fa',
                    tickIcon: 'fa-check',
                    liveSearch:false
                });
            }
            
            $(document).ready(function(){
                $('.multiCheckbox').is('ifChecked', function(){ 
                    $(this).parent().css('background-color',"#1ED3B5");
                });
                <?php if( !($this->uri->segment(2) == "signUp") ) {
                    if( !($this->uri->segment(2) == "editProfile") ) {            ?>    
//                        handleBootstrapSelect();
                <?php } } ?>

                setTimeout(function(){
                    $('.hide-mess').hide(800);
                },2000);
            });

            function isNumberKey(evt,id){   
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57)){
                    $("#"+id).html("Please enter number key");
                    return false;
                }else{
                    $("#"+id).html('');
                    return true;
                }
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

            function checkPhone(id,errId){
                 var mobile = $("#"+id).val();
                 if(mobile.length<10 || mobile.length>11){
                     $("#"+id).addClass( "error" );
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
                   $("#"+textId).addClass( "error" );
                   $("#"+errId).text("Please enter a valid name");
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
                        
                        $("#email_msg").html('');
                        var uleliment = $("#email").next();

                        if(!uleliment.hasClass('parsley-error-list')) {
                           $("#"+errId).html("Please enter valid Email.");
                           $("#"+id).addClass( "error" )
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
            
            function checkEmailBlur(id,errId){
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                var email = $('#'+id).val();
                if(email!==''){
                    if (!filter.test(email)){
                        
                        $("#email_msg").html('');
                        var uleliment = $("#email").next();

                        if(!uleliment.hasClass('parsley-error-list')) {
                           $("#"+errId).html("Please enter valid Email.");
                           $("#"+id).addClass( "error" )
                           return false;
                        }
                    }else{
                        $("#"+errId).html('');
                        checkEmailExist(id,errId);
                        return true;
                    }
                }else{
                    $("#"+errId).html("Please enter valid Email.");
                   return false;
                }
            }

            function checkConfirm(val,val2){

                var pass = $("#"+val).val();
                var conf = $("#"+val2).val();

                if(pass != conf ){
            //        $("#"+val).addClass( "error" );
                    $("#"+val2).addClass( "error" );
                    $("#er_"+val2).text("Please enter the same value again.");
                    return false;
                }else{
                    $("#er_"+val2).html('');  
                    return true;
                }
            }

            function checkPassword(val,val2){

            var pass = $("#"+val).val();
        //    var conf = $("#"+val2).val();
            var flag;
            if(pass.length < 8 ){
               $("#"+val).addClass( "error" );
        //       $("#"+val2).addClass( "error" );
               $("#er_"+val).text("(8-15 characters long with atleast 1 digit(0-9), special character(@,#))");
               flag = false;
            }
            
            if(pass.length > 16 ){
               $("#"+val).addClass( "error" );
        //       $("#"+val2).addClass( "error" );
               $("#er_"+val).text("(8-15 characters long with atleast 1 digit(0-9), special character(@,#))");
               flag = false;
            }
            //if password contains both lower and uppercase characters
//            if(!pass.match(/([a-z])|([a-z])/) ){
//               $("#"+val).addClass( "error" );
//        //       $("#"+val2).addClass( "error" );
//               $("#er_"+val).text("Atleast 1 lowercase character Required .");
//               flag = false;
//            }
//            //if password contains both lower characters
//            if(!pass.match(/([A-Z])|([A-Z])/) ){
//               $("#"+val).addClass( "error" );
//        //       $("#"+val2).addClass( "error" );
//               $("#er_"+val).text("Atleast 1 uppercase character Required .");
//               flag = false;
//            }
            //if it has numbers and characters
            if(!pass.match(/([0-9])/) ){
               $("#"+val).addClass( "error" );
        //       $("#"+val2).addClass( "error" );
               $("#er_"+val).text("(8-15 characters long with atleast 1 digit(0-9), special character(@,#))");
               flag = false;
            }
            //if it has numbers and characters
            if(!pass.match(/([!,%,&,@,#,$,^,*,?,_,~])/) ){
               $("#"+val).addClass( "error" );
        //       $("#"+val2).addClass( "error" );
               $("#er_"+val).text("(8-15 characters long with atleast 1 digit(0-9), special character(@,#))");
               flag = false;
            }
            if(flag != false){
                $("#er_"+val).html('');  
                checkConfirm(val,val2);
                return true;
            }
        }
        
        function checkEmailExist(id,errId){

            var email = $('#'+id).val();
            var url = '<?php echo site_url('partners/checkEmailExist');?>';

            $.ajax({
                url:url,
                type: 'POST',
                data:{'email':email,'column':id},
                success: function (response) {

                    if(response == "0"){
                        $("#"+errId).html("");
                        email = "true";
                    } else {
                        $("#"+id).addClass( "error" );
                        $("#"+errId).html("This email id has already been taken.");
                        email = "false";
                    }

                }      
            });
            return email;
        }
        
        $(document).ready(function(){
	    $("#changePassword").submit(function( event ) {
                if(checkPassword('password','confirm') == true){
                    if(checkConfirm('password','confirm') == true){
                    event.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({

                        type:"POST",
                        url:'<?php echo site_url(); ?>/partners/changePassword',
                        data:formData,//only input
                        processData: false,
                        contentType: false,
                        xhr: function()
                        {
                            $(".loader").show();
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
                                $(".loader").hide();
                                
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
                                            $('#er_TopError').hide(5000);
                                            $('#er_TopError').html('');
                                        },5000);
                                    }
                                    else
                                    {
                                        $('#headLogin').html(data.loginMod);
                                    }
                                }
                                else{
                                    document.getElementById("changePassword").reset();
                                    $('#myModal').modal('toggle');
                                    
                                    $('#passwordSuccess').show();
                                    $('#passwordSuccess').html(data.msg);
                                    bootbox.alert({closeButton: false,message:"Your password is successfully changed. !",callback:function() {location.reload(true);}});
                                    $('.modal-footer').addClass('text-center');
                                    $('.modal-footer [data-bb-handler="ok"]').html('Close');
                                    setTimeout(function(){
                                       $('#passwordSuccess').hide(5000);
                                       $('#passwordSuccess').html('');
                                    });
                                }
                            }catch(e) {
                                $('#er_TopError').show();
                                $('#er_TopError').html(e);
                                setTimeout(function(){
                                        $('#er_TopError').hide(5000);
                                        $('#er_TopError').html('');
                                    },5000);
                                }
                        }
                    });
                    }else{
                        $("#err_confirm").html("Password is not match.");
                        return false;
                    }
            }else{
                $("#err_password").html("(8-15 characters long with atleast 1 digit(0-9), special character(@,#))");
                return false;
            }
        });
            $('.icheck-inline').find("input[type=checkbox]").each(function(){
                $(this).prop("checked") == true ?icheckcolore($(this).attr('id')):'';
            });
        });
        
        
    
    function icheckcolore(id)
    { 
        $('#'+id).parent('.icheckbox_line-grey').css( "background-color", "#1ED3B5" );
    }
    
    function addNewSlot(type){

        var oldVal = $("#"+type+"_slots").val();
        
        var typeVal = parseInt(oldVal) + parseInt(1);
        
        var htmlData = '<div class="col-md-12 m-top-20 " id="'+type+'SlotDiv_'+typeVal+'"><div class="col-md-3 col-md-offset-2" data-autoclose="true"><div class="bootstrap-timepicker input-group"><input id="'+type+'StartTime_'+typeVal+'" autocomplete="off" class="form-control timepicker" type="text" name="'+type+'[]" value=""></div></div><div class="col-md-3" data-autoclose="true"><div class="bootstrap-timepicker input-group"><input id="'+type+'EndTime_'+typeVal+'" autocomplete="off" class="form-control timepicker" type="text" name="'+type+'[]"  value=""></div></div><div class="col-md-2 addShift_'+type+'"> <a href="javascript:;" id="'+type+'SlotAdd_'+typeVal+'" class="add btn btn-success" onclick="addNewSlot(\''+type+'\');"> <i class="fa fa-plus"></i></a><a id="'+type+'SlotRemove_'+typeVal+'" class="remove add btn btn-danger" href="javascript:;" onclick="removeMore(\''+typeVal+'\',\''+type+'\')"><i class="fa fa-minus"></i></a></div></div>';
        
       $("#"+type+"_Div").append(htmlData);
       $("#"+type+"_slots").val(typeVal);

       $('.timepicker').timepicker({
            defaultTime: false,
            showMeridian:false
        });    
       if(typeVal !== 1){
            $("#"+type+'SlotAdd_'+oldVal+"").hide();
            $("#"+type+'SlotRemove_'+oldVal+"").hide();
       }
    }
    
    function removeMore(typeVal,type){
        
        $("#"+type+'SlotDiv_'+typeVal+"").slideUp(function(){
//            $("#"+type+'SlotDiv_'+typeVal+"").remove();
        });
        
        typeVal = parseInt(typeVal) - parseInt(1);
        $("#"+type+"_slots").val(typeVal);
        
        $("#"+type+'SlotAdd_'+typeVal+"").show();
        $("#"+type+'SlotRemove_'+typeVal+"").show();
    }


    $(document).ready(function(){
   $('.requestclass').on('click',function(){
    var tablesName = $('#tablesName').val();
    var fkVendorId = $('#fkVendorId').val();
    $.ajax({
              url: "<?php echo base_url('vendorview/requestChangesData'); ?>",
              type: 'POST',
              data: $('#serviceForm').serialize(),
              success:function(datas){
                  $('#requestDataPrint').html(datas);
                  $('#modalTitle').html(tablesName);
                  $('.showModal').modal('show');
              }
    });
    
  });
});
        </script>
    </body>
</html>

<div class="modal inmodal showModal"  tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <!--<i class="fa fa-laptop modal-icon"></i>-->
                                            <h4 class="modal-title" id="modalTitle"></h4>
                                           </div>
                                        <div class="modal-body">
                                             <div id="requestDataPrint"></div>
                                        </div>
                                        <div class="modal-footer">
                                           
                                        </div>
            </div>
       </div>
</div>