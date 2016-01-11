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
        </script>
    </body>
</html>