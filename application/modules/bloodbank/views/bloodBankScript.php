<style type="text/css">
    #datatable_bloodbank_filter
    {
        display:none;
    }
</style>
<link href="<?php echo base_url();?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/cropper/main.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>
<?php $current = $this->router->fetch_method();
if($current == 'detailBloodBank'):?>
<script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>
<?php else:?>
<script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php endif;?>

<script src="<?php echo base_url(); ?>assets/js/reCopy.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/blood-detail.js"></script>
 <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>

<script>
     var urls = "<?php echo base_url()?>";
     
      /**
     * @method datatable
     * @description get records in listing using datatables
     */
    $(document).ready(function () {
        var oTable = $('#datatable_bloodbank').DataTable({
            "processing": true,
            "bServerSide": false,
            //"searching": true,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            //"bPaginate": true,
            "sPaginationType": "full_numbers",
            "columns": [
                {"data": "bloodBank_photo"},
                {"data": "bloodBank_name"},
                {"data": "bloodBank_phn"},
                {"data": "city_name"},
                {"data": "bloodBank_add"},
                //{"data": "open"},
                // {"data": "call"},
                {"data": "view"},
            ],
            "ajax": {
                "url": "<?php echo site_url('bloodbank/getBloodBankDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.cityId = $("#hospital_cityId").val();
                    d.bloodBank_name = $("#search").val();
                    if ($("#hospital_stateId").val() != ' ') {
                        d.hosStateId = $("#hospital_stateId").val();
                    }
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });

        $('#hospital_cityId,#hospital_stateId').change(function () {
            oTable.draw();
        });
        $('#search').on('keyup', function () {
            oTable.search($(this).val()).draw();
        });
    });

    $('#date-3').datepicker();

    $(function () {
        $("#geocomplete").geocomplete({
            map: ".map_canvas",
            details: "form",
            types: ["geocode", "establishment"],
        });

        $("#find").click(function () {
            $("#geocomplete").trigger("geocode");
        });
    });
    /*-- Selectpicker --*/
    $('.selectpicker').selectpicker({
        style: 'btn-default',
        size: "auto",
        width: "100%"
    });

    var urls = "<?php echo base_url() ?>";
    function fetchCityList(stateId) {
        $.ajax({
            url: urls + 'index.php/hospital/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                $('#hospital_cityId').html(datas);
                $('#hospital_cityId').selectpicker('refresh');

            }
        });


    }

    
       $(function(){
            var removeLink = '<a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"> <i class="fa fa-minus-circle fa-2x m-t-5 label-plus"></i></a>';
          $('a.add').relCopy({ append: removeLink});	
          
          });
          
         //var urls = "<?php // echo base_url()?>";
         var j = 1;
         var k = 1;
         var l =1;
         var n= 1;
         var m =1;
         
   function fetchCity(stateId) {   

           $.ajax({
               url : urls + 'index.php/bloodbank/fetchCity',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
 
                  $('#cityId').html(datas);
                  $('#cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
         
   function validationBloodbank(){
           
       //$("form[name='bloodDetail']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#bloodBank_cntPrsn').val());
        
       
            if($.trim($('#bloodBank_name').val()) === ''){
                $('#bloodBank_name').addClass('bdr-error');
                
            }
          
            if($.trim($('#geocomplete').val()) === ''){
               $("#geocomplete").addClass('bdr-error');
               
            }
             if(!check.test(cpname)){
                $('#bloodBank_cntPrsn').addClass('bdr-error');
                
            }
            
            if( emails !== ''){
                check_email_detail(emails);
            }
            
            return false;
            
        }
        
    function checkEmailFormatDetail(){
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                var email = $('#users_email').val();
                if(email!==''){
                    if (!filter.test(email)){
                       $('#users_email').addClass('bdr-error');
                    }
            }
        } 
        
   function check_email(myEmail){
           $.ajax({
               url : urls + 'index.php/bloodbank/check_email',
               type: 'POST',
              data: {'users_email' : myEmail},
              success:function(datas){
                  if(datas == 0){
                   $("form[name='submitForm']").submit();
                   return true;
              }
              else {
                $('#users_email').addClass('bdr-error');
                $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');;
               // $('#users_email').focus();
               return false;
              }
              } 
           });
        }
     
   function check_email_detail(myEmail){
            var user_table_id = $('#user_tables_id').val();
           $.ajax({
               url : urls + 'index.php/bloodbank/check_email',
               type: 'POST',
              data: {'users_email' : myEmail,'user_table_id' : user_table_id },
              success:function(datas){
                 // console.log(datas);
                  if(datas == 0){
                   $("form[name='bloodDetail']").submit();
                   return true;
              }
              else {
                $('#users_email').addClass('bdr-error');
                $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');;
               
               return false;
              }
              } 
           });
    }
   function checkNumber(id){
            var phone = $.trim($('#'+'bloodBank_phn'+id).val());
            if(!($.isNumeric(phone))){
             $('#'+'bloodBank_phn'+id).addClass('bdr-error');
         }
        }
        
 function checkEmailFormat(){
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                var email = $('#users_email').val();
                if(email!==''){
                    if (!filter.test(email)){
                        
                       $('#users_email').addClass('bdr-error');
                         $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');;
                        // $('#users_email').focus();

                    }
            }
        }
        
   function check_email_blood_bank(myEmail){
            var user_table_id = $('#user_tables_id').val();
           $.ajax({
               url : urls + 'index.php/bloodbank/check_email',
               type: 'POST',
              data: {'users_email' : myEmail,'user_table_id' : user_table_id },
              success:function(datas){
                 // console.log(datas);
                  if(datas == 0){
                   $("form[name='bloodDetail']").submit();
                   return true;
              }
              else {
                $('#users_email').addClass('bdr-error');
                $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');;
               
               return false;
              }
              } 
           });
        }
        
   function updatePassword(){
          
            var pswd = $.trim($("#users_password").val());
            var cnfpswd = $.trim($("#cnfPassword").val());
            //var password = $('#myPassword').val();
            var user_tables_id = $('#user_tables_id').val();
            var status = 1;
            if(pswd.length < 6){
                $('#users_password').addClass('bdr-error');
                //$('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_password').focus();
               status = 0;
            }
           
           if(pswd != cnfpswd){
                $('#cnfPassword').addClass('bdr-error');
               // $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#cnfpassword').focus();
               status = 0;
            }
            if(status == 0)
                return false;
            else{
                    $.ajax({
                  url : urls + 'index.php/bloodbank/updatePassword',
                  type: 'POST',
                 //data: {'currentPassword' : pswd,'existingPassword' : password,'user_tables_id' : user_tables_id}, password updated from another user except super admin
                 data: {'currentPassword' : pswd,'user_tables_id' : user_tables_id},
                 success:function(datas){
                     //var statuss = datas.split('~');
                     //console.log(datas);
                    
                     if(datas == 0){
                   $('#error-password_email_check').fadeIn().delay(4000).fadeOut('slow');
                      return true;
                    }
                    else {
                           /*$('#myPassword').val(statuss[1]);*/
                           $('#users_password').val('');
                           $('#cnfPassword').val('');
                           $('#error-password_email_check_success').fadeIn().delay(4000).fadeOut('slow');

                           return true;
                    }
                 } 
              });
              
            }
        }
        
   function validationBloodbankAdd(){
         $("form[name='bloodbankForm']").submit();
       
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#bloodBank_cntPrsn').val());
        
        
        var pswd = $.trim($("#users_password").val());
        var cnfpswd = $.trim($("#cnfPassword").val());
        
        var phn= $.trim($('#bloodBank_phn1').val());
        var myzip = $.trim($('#bloodBank_zip').val());
        var cityId =$.trim($('#cityId').val());
        var stateIds = $.trim($('#StateId').val());
        var bloodBank_mblNo = $.trim($('#bloodBank_mblNo').val());
       // alert(stateIds.length);
       //console.log( stateIds == '' || typeof stateIds == 'string' || typeof stateIds == 'undefined');
    //debugger;
   
            if($('#bloodBank_name').val()==''){
                $('#bloodBank_name').addClass('bdr-error');
                $('#error-bloodBank_name').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_name').focus();
            }
           if($('#bloodBank_type').val()==''){
                $('#bloodBank_type').addClass('bdr-error');
                $('#error-bloodBank_type').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_type').focus();
            }
            if($.trim($('#countryId').val()) == ''){
                $('#countryId').addClass('bdr-error');
                $('#error-countryId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_countryId').focus();
            }
           if(!$.isNumeric(stateIds)){
               // console.log("in state");
                $('#stateId').addClass('bdr-error');
                $('#error-stateId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_stateId').focus();
            }
            if(!$.isNumeric(cityId)){
                $('#cityId').addClass('bdr-error');
                $('#error-cityId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_cityId').focus();
            }
           
            if(!$.isNumeric(myzip)){
                
                $('#bloodBank_zip').addClass('bdr-error');
                $('#error-bloodBank_zip').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_zip').focus();
            } 

            if($("input[name='bloodBank_add']" ).val()==''){
                $('#bloodBank_add').addClass('bdr-error');
                $('#error-bloodBank_add').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_address').focus();
            }
            
            
            if(!$.isNumeric(phn)){
                $('#bloodBank_phn1').addClass('bdr-error');
                $('#error-bloodBank_phn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
            }
            
            if(!check.test(cpname)){
                $('#bloodBank_cntPrsn').addClass('bdr-error');
                $('#error-bloodBank_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_cntPrsn').focus();
            }
           
            if($('#bloodBank_mmbrTyp').val()==''){
                $('#bloodBank_mmbrTyp').addClass('bdr-error');
                $('#error-bloodBank_mmbrTyp').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_mmbrType').focus();
            }
            if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_email').focus();
            }
            if(!($.isNumeric(bloodBank_mblNo))){
                $('#bloodBank_mblNo').addClass('bdr-error');
                $('#error-bloodBank_mblNo').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#hospital_mblNo').focus();
            }
            if(pswd.length < 6){
                $('#users_password').addClass('bdr-error');
                $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_password').focus();
            }
            if(cnfpswd == ''){
                $('#cnfPassword').addClass('bdr-error');
                $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#cnfpassword').focus();
            }
           
            if(pswd != cnfpswd){
                $('#cnfPassword').addClass('bdr-error');
                $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#cnfpassword').focus();
            }
            if(emails !=''){
              check_email(emails);
              return false;
            }
               //debugger;
        
            return false;
            
        }
              
   function check_email(myEmail){
           $.ajax({
               url : urls + 'index.php/bloodbank/check_email',
               type: 'POST',
              data: {'users_email' : myEmail},
              success:function(datas){
                  console.log(datas);
                  if(datas == 0){
                   $("form[name='bloodbankForm']").submit();
                   return true;
              }
              else {
                $('#users_email').addClass('bdr-error');
                $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');;
               // $('#users_email').focus();
               return false;
              }
              } 
           });
        }
    $("#savebtn").click(function(){
         $("#avatar-modal").modal('hide');
     }); 
    
</script>
