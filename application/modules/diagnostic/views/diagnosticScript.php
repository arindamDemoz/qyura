<style type="text/css">
    #diagnostic_datatable_filter
    {
        display:none;
    }
</style>
<link href="<?php echo base_url();?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/cropper/main.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>
<?php $current = $this->router->fetch_method();
if($current == 'detailDiagnostic'):?>
<script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>
<?php else:?>
<script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php endif;?>
<script src="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/js/angular.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/diagdetail.js"></script>
<script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<script>
      $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form",
          types: ["geocode", "establishment"],
        });

        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });
      });
      
      $(document).ready(function(){
          fetchStates();
            function fetchStates(){
            
            var countryId = $('#countryId').val();
            var stateId = $('#StateId').val();
           // alert(countryId);
            //alert(stateId);
            $.ajax({
               url : urls + 'index.php/diagnostic/fetchStates',
               type: 'POST',
              data: {'stateId' : stateId , 'countryId' : countryId},
              success:function(datas){
                //console.log(datas);
                  $('#diagnostic_stateId').html(datas);
                $('#diagnostic_stateId').selectpicker('refresh');
                  fetchCityOnload(stateId);
                  //$('#StateId').val(stateId);
              }
           });
        }

        function fetchCityOnload(stateId) {    
           var cityId = $('#cityId').val();
           //alert(cityId);
           $.ajax({
               url : urls + 'index.php/diagnostic/fetchCityOnload',
               type: 'POST',
              data: {'stateId' : stateId , 'cityId' : cityId},
              success:function(datas){
                console.log(datas);
                  $('#diagnostic_cityId').html(datas);
                  $('#diagnostic_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
      });
    </script>
<script>

    /*-- Selectpicker --*/
    $('.selectpicker').selectpicker({
        style: 'btn-default',
        size: "auto",
        width: "100%"
    });
    $("#savebtn").click(function(){
         $("#avatar-modal").modal('hide');
     }); 
    
    var urls = "<?php echo base_url() ?>";
    function fetchCity(stateId) {
        $.ajax({
            url: urls + 'index.php/diagnostic/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                $('#diagnostic_cityId').html(datas);
                $('#diagnostic_cityId').selectpicker('refresh');
            }
        });

    }

    // datatable get records
    $(document).ready(function () {
        var oTable = $('#diagnostic_datatable').DataTable({
             "processing": true,
            "bServerSide": false,
             //"searching": true,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            //"bPaginate": true,
            "sPaginationType": "full_numbers",
            "columns": [
                {"data": "diagnostic_img"},
                {"data": "diagnostic_name"},
                {"data": "city_name"},
                {"data": "diagnostic_phn"},
                {"data": "diagnostic_address"},
                {"data": "view"},
            ],
            "ajax": {
                "url": "<?php echo site_url('diagnostic/getDiagnosticDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.cityId = $("#diagnostic_cityId").val();
                    d.bloodBank_name = $("#search").val();
                    if ($("#hospital_stateId").val() != ' ') {
                        d.hosStateId = $("#hospital_stateId").val();
                    }
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });
        $('#diagnostic_cityId,#hospital_stateId').change(function () {
            oTable.draw();
        });
        $('#search').on('keyup', function () {
            oTable.search($(this).val()).draw();
            
        });

    });
    
    
    var urls = "<?php echo base_url()?>";
    var j = 1;
    var k = 1;
    var l =1;
    var n= 1;
    var m =1;
   function fetchCity(stateId) {           
      $.ajax({
          url : urls + 'index.php/diagnostic/fetchCity',
          type: 'POST',
         data: {'stateId' : stateId},
         success:function(datas){
             $('#diagnostic_cityId').html(datas);
             $('#diagnostic_cityId').selectpicker('refresh');
             $('#StateId').val(stateId);
         }
      });

   }
    function countPhoneNumber(){
        if(j==10)
            return false;
      j = parseInt(j)+parseInt(1); 
      $('#countPnone').val(j);
      $('#multiPhoneNumber').append('<input type=text class=form-control name=diagnostic_phn[] placeholder=9837000123 maxlength="10" id=diagnostic_phn'+j + ' />');
     $('#multiPreNumber').append('<select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber'+j+'><option value=91>+91</option><option value=1>+1</option></select>');
      $('#multiPreNumber'+j).selectpicker('refresh');
   }

    function validationDiagnostic(){
       // $("form[name='diagnosticForm']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var RegExpression = /^[a-zA-Z\s]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#diagnostic_cntPrsn').val());
        
        var pswd = $.trim($("#users_password").val());
        var cnfpswd = $.trim($("#cnfpassword").val());
        var mbl= $.trim($('#diagnostic_mblNo').val());
        var phn= $.trim($('#diagnostic_phn1').val());
        var myzip = $.trim($('#diagnostic_zip').val());
        var cityId =$.trim($('#diagnostic_cityId').val());
        var stateIds = $.trim($('#StateId').val());
        var diagnostic_mblNo = $.trim($('#diagnostic_mblNo').val());
       
    //debugger;
   
            if($('#diagnostic_name').val()==''){
                $('#diagnostic_name').addClass('bdr-error');
                $('#error-diagnostic_name').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_name').focus();
              // return false;
            }
          if($('#diagnostic_type').val()==''){
                $('#diagnostic_type').addClass('bdr-error');
                $('#error-diagnostic_type').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_type').focus();
            }
             if($.trim($('#diagnostic_countryId').val()) == ''){
                $('#diagnostic_countryId').addClass('bdr-error');
                $('#error-diagnostic_countryId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_countryId').focus();
            }
           if(!$.isNumeric(stateIds)){
               // console.log("in state");
                $('#diagnostic_stateId').addClass('bdr-error');
                $('#error-diagnostic_stateId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_stateId').focus();
            }
            if(!$.isNumeric(cityId)){
                $('#diagnostic_cityId').addClass('bdr-error');
                $('#error-diagnostic_cityId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_cityId').focus();
            }
           
            if(!$.isNumeric(myzip)){
                $('#diagnostic_zip').addClass('bdr-error');
                $('#error-diagnostic_zip').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_zip').focus();
            } 

            if($("input[name='diagnostic_address']" ).val()==''){
                $('#geocomplete').addClass('bdr-error');
                $('#error-diagnostic_address').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_address').focus();
            }
            
            if(!$.isNumeric(phn)){
                $('#diagnostic_phn1').addClass('bdr-error');
                $('#error-diagnostic_phn1').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
            }
                     
          
            if(!RegExpression.test(cpname)){
                $('#diagnostic_cntPrsn').addClass('bdr-error');
                $('#error-diagnostic_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_cntPrsn').focus();
            }
            
           
            if($('#diagnostic_mbrTyp').val()==''){
                $('#diagnostic_mbrTyp').addClass('bdr-error');
                $('#error-diagnostic_mbrTyp').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_mmbrType').focus();
            }
            if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_email').focus();
            }
           
           /* else if(diagnostic_mblNo == ''){
                $('#diagnostic_mblNo').addClass('bdr-error');
                $('#error-diagnostic_mblNo').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#hospital_mblNo').focus();
            }*/
            if(!($.isNumeric(diagnostic_mblNo))){
                $('#diagnostic_mblNo').addClass('bdr-error');
                $('#error-diagnostic_mblNo').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#hospital_mblNo').focus();
            }
            if($('#users_password').val()=='' || pswd.length < 6){
                $('#users_password').addClass('bdr-error');
                $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_password').focus();
            }
            if($('#cnfPassword').val()=='' || pswd!= cnfpswd){
                $('#cnfPassword').addClass('bdr-error');
                $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#cnfpassword').focus();
            }
            
               //debugger;
        if(emails !=''){
              check_email(emails);
              return false;
            }
            return false;
            
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
    function check_email(myEmail){
           $.ajax({
               url : urls + 'index.php/diagnostic/check_email',
               type: 'POST',
              data: {'users_email' : myEmail},
              success:function(datas){
                  if(datas == 0){
                   $("form[name='diagnosticForm']").submit();
                   return true;
              }
              else {
                    $('#users_email').addClass('bdr-error');
                $('#error-users_email_check').delay(3000).fadeOut('slow');;
               // $('#users_email').focus();
               return false;
              }
              } 
           });
        }
</script>
