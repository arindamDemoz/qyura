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
<script src="<?php echo base_url();?>assets/js/pages/addHospital.js">
    </script>

<script>
             /*-- Selectpicker --*/
$('.selectpicker').selectpicker({
    style: 'btn-default',
    size: "auto",
    width: "100%"
});

var urls = "<?php echo base_url()?>";
function fetchCity(stateId) {           
           $.ajax({
               url : urls + 'index.php/hospital/fetchCity',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
                  $('#hospital_cityId').html(datas);
                  $('#hospital_cityId').selectpicker('refresh');
              }
           });
           
        }
                         // datatable get records
         $(document).ready(function () {
                var oTable = $('#hospital_datatable').DataTable({
                   /* "processing": true,
                    "serverSide": true,
                    "bFilter": false,
                    "iDisplayStart ": 10,
                     "bLengthChange": false,
                    "bProcessing": true,
                    "iDisplayLength": 10,
                    "bPaginate": true,
                    "sPaginationType": "full_numbers",*/
                    "processing": true,
                    "serverSide": true,
                    "bLengthChange": false,
                    "bProcessing": true,
                    "iDisplayLength": 10,
                    "sPaginationType": "full_numbers",

                    "columns": [
                        {"data": "hospital_img"},
                        {"data": "hospital_name"},
                        {"data": "city_name"},
                        {"data": "hospital_phn"},
                        {"data": "hospital_address"},
                        {"data": "view"},
                    ],
                    
                    "ajax": {
                        "url": "<?php echo site_url('hospital/getHospitalDl'); ?>",
                        "type": "POST", 
                        "data": function ( d ) {
                                         d.cityId = $("#hospital_cityId").val();
                                         d.name = $("#search").val();
                                         if($("#hospital_stateId").val() != ' '){
                                         d.hosStateId = $("#hospital_stateId").val();
                                        }
                                         d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                                    } 
                    }
                });
                
                  $('#hospital_cityId,#hospital_stateId').change( function() {
                        oTable.draw();
                  } );
                     $('#search').on('keyup', function() {
                        //oTable.draw();
                         oTable.search($(this).val()).draw() ;
                        
                  } );
                
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

  
        var urls = "<?php echo base_url()?>";
         var j = 1;
         var k = 1;
         var l = 1;
         var n= 1;
         var m = 1;
         var p = 1;
        function fetchCity(stateId) {           
           $.ajax({
               url : urls + 'index.php/hospital/fetchCity',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
                  $('#hospital_cityId').html(datas);
                  $('#hospital_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
        function countPhoneNumber(){
        if(j==10)
            return false;
      j = parseInt(j)+parseInt(1); 
      $('#countPnone').val(j);
      $('#multiPhoneNumber').append('<input type=text class=form-control name=hospital_phn[] placeholder=9837000123 maxlength="10" id=hospital_phn'+j + ' />');
     $('#multiPreNumber').append('<select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber'+j+'><option value=91>+91</option><option value=1>+1</option></select>');
      $('#multiPreNumber'+j).selectpicker('refresh');
      //.append('<div class=col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10 id=multiPreNumber><select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber><option value =91>+91</option><option value =1>+1</option></select></div><div class=col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10 id=multiPhoneNumber><nput type=text class="form-control" name=hospital_phn[] id=hospital_phn1 placeholder=9837000123 maxlength=10 /> </div>');

   }
       function countBloodPhoneNumber(){
        if(k==10)
            return false;
      k = parseInt(k)+parseInt(1); 
      $('#countbloodBank_phn').val(k);
      $('#multiBloodbnkPhoneNumber').append('<input type=text class=form-control name=bloodBank_phn[] placeholder=9837000123 maxlength="10" id=bloodBank_phn'+k + ' />' );
     $('#multiBloodbnkPreNumber').append('<select class=selectpicker data-width=100% name=preblbankNo[] id=preblbankNo'+k+'><option value=91>+91</option><option value=1>+1</option></select>');
      $('#preblbankNo'+k).selectpicker('refresh');
      
   }

   function countPharmacyPhoneNumber(){
       if(l==10)
            return false;
      l = parseInt(l)+parseInt(1); 
      $('#countPharmacy_phn').val(l);
      $('#multipharmacyNumber').append('<input type=text class=form-control name=pharmacy_phn[] placeholder=9837000123 maxlength="10" id=pharmacy_phn'+l + ' />' );
     $('#multipharmacyPreNumber').append('<select class=selectpicker data-width=100% name=prePharmacy[] id=prePharmacy'+l+'><option value=91>+91</option><option value=1>+1</option></select>');
      $('#prePharmacy'+l).selectpicker('refresh');
   }
   
   function countAmbulancePhoneNumber(){
       if(n==10)
            return false;
      n = parseInt(n)+parseInt(1); 
      $('#countAmbulance_phn').val(n);
      $('#phoneAmbulance').append('<input type=text class=form-control name=ambulance_phn[] placeholder=9837000123 maxlength="10" id=ambulance_phn'+n + ' /> ' );
     $('#preAmbulance_name').append('<select class=selectpicker data-width=100% name=preAmbulance[] id=preAmbulance'+n+'><option value=91>+91</option><option value=1>+1</option></select> ');
     $('#preAmbulance'+n).selectpicker('refresh');
   }
   
   function countserviceName(){
        if(m==10)
            return false;
      m = parseInt(m)+parseInt(1); 
      $('#serviceName').val(m);
      $('#multiserviceName').append('<input type=text class=form-control name=hospitalServices_serviceName[] placeholder="Give Your Service Name" maxlength="30" id=hospitalServices_serviceName'+m + ' /> <br /> ' );
   }
   function bbname(){
       var bbankname = $('#bloodBank_name').val();
        var check= /^[a-zA-Z\s]+$/;
    if(!check.test(bbankname)){
    $('#bloodBank_name').addClass('bdr-error');
    $('#error-bloodBank_name').fadeIn().delay(3000).fadeOut('slow');
    // $('#bloodBank_name').focus();
    }
}
   function bbphone(){
    var bbphcheck=/^[0-9]+$/;
    var bbankphone=$.trim($('#bloodBank_phn1').val());
   if(!$.isNumeric(bbankphone)){
                
                $('#bloodBank_phn1').addClass('bdr-error');
                $('#error-bloodBank_phone').fadeIn().delay(3000).fadeOut('slow');
                // $('bloodBank_name').focus();
            } 
}
   function phname(){
        var pharname = $.trim($('#pharmacy_name').val());
          var check= /^[a-zA-Z\s]+$/;
        if(!check.test(pharname)){
        $('#pharmacy_name').addClass('bdr-error');
        $('#error-pharmacy_name').fadeIn().delay(3000).fadeOut('slow');
        // $('#pharmacy_name').focus();
}
}
   function phphone(){
    var pharname=$.trim($('#pharmacy_phn1').val());
    var phphonecheck=/^[0-9]+$/;
 if(!$.isNumeric(pharname)){
                
                $('#pharmacy_phn1').addClass('bdr-error');
                $('#error-pharmacy_phn1').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_zip').focus();
            } 
}
   function amname(){
        var amname =$.trim($('#ambulance_name').val());
        var check= /^[a-zA-Z\s]+$/;
        if(!check.test(amname)){
        $('#ambulance_name').addClass('bdr-error');
        $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
        // $('#pharmacy_name').focus();
}
}
   function amphone(){
    var amname=$.trim($('#ambulance_phn1').val());
    var amphonecheck=/^[0-9]+$/;
 if(!$.isNumeric(amname)){
   $('#ambulance_phn1').addClass('bdr-error');
   $('#error-ambulance_phn1').fadeIn().delay(3000).fadeOut('slow');
  } 
}
   function validationHospital(){
         //$("form[name='hospitalForm']").submit();
       
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#hospital_cntPrsn').val());
        var dsgn = $.trim($('#hospital_dsgn').val());
        var hsname =$.trim($('#hospitalServices_serviceName1').val());
        var pswd = $.trim($("#users_password").val());
        var cnfpswd = $.trim($("#cnfPassword").val());
        var mbl= $.trim($('#hospital_mblNo').val());
        var phn= $.trim($('#hospital_phn1').val());
        var myzip = $.trim($('#hospital_zip').val());
        var cityId =$.trim($('#hospital_cityId').val());
        var stateIds = $.trim($('#StateId').val());
        var hospital_mblNo = $.trim($('#hospital_mblNo').val());
        var aboutUs = $.trim($('#hospital_aboutUs').val());
  // alert(aboutUs);
            if($('#hospital_name').val()==''){
                $('#hospital_name').addClass('bdr-error');
                $('#error-hospital_name').fadeIn().delay(3000).fadeOut('slow');
                //return false;
               // $('#hospital_name').focus();
            }
          if($('#hospital_type').val()==''){
                $('#hospital_type').addClass('bdr-error');
                $('#error-hospital_type').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_type').focus();
            }
            if($.trim($('#hospital_countryId').val()) == ''){
                $('#hospital_countryId').addClass('bdr-error');
                $('#error-hospital_countryId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_countryId').focus();
            }
          if(!$.isNumeric(stateIds)){
               // console.log("in state");
                $('#hospital_stateId').addClass('bdr-error');
                $('#error-hospital_stateId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_stateId').focus();
            }
           if(!$.isNumeric(cityId)){
                $('#hospital_cityId').addClass('bdr-error');
                $('#error-hospital_cityId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_cityId').focus();
            }
           
            if(!$.isNumeric(myzip)){
                
                $('#hospital_zip').addClass('bdr-error');
                $('#error-hospital_zip').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_zip').focus();
            } 

           if($("input[name='hospital_address']" ).val()==''){
                $('#hospital_address').addClass('bdr-error');
                $('#error-hospital_address').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_address').focus();
            }
            
          if(!$.isNumeric(phn)){
                $('#hospital_phn1').addClass('bdr-error');
                $('#error-hospital_phn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
            }
            
            if(!check.test(hsname)){
                $('#hospitalServices_serviceName1').addClass('bdr-error');
                $('#error-hospitalServices_serviceName').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospitalServices_serviceName1').focus();
            }
           
           if(!check.test(cpname)){
                $('#hospital_cntPrsn').addClass('bdr-error');
                $('#error-hospital_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_cntPrsn').focus();
            }
            if(!check.test(dsgn)){
                $('#hospital_dsgn').addClass('bdr-error');
                $('#error-hospital_dsgn').fadeIn().delay(3000).fadeOut('slow');
               
               // $('#hospital_dsgn').focus();
            }
            if($('#hospital_mmbrTyp').val()==''){
                $('#hospital_mmbrTyp').addClass('bdr-error');
                $('#error-hospital_mmbrTyp').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_mmbrType').focus();
            }
            if(aboutUs === ''){
                $('#hospital_aboutUs').addClass('bdr-error');
                $('#error-hospital_aboutUs').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_aboutUs').focus();
            }
            if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_email').focus();
            }
           
          
           if(!($.isNumeric(hospital_mblNo))){
                $('#hospital_mblNo').addClass('bdr-error');
                $('#error-hospital_mblNo').fadeIn().delay(3000).fadeOut('slow');
                
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
               url : urls + 'index.php/hospital/check_email',
               type: 'POST',
              data: {'users_email' : myEmail},
              success:function(datas){
                  if(datas == 0){
                   $("form[name='hospitalForm']").submit();
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
   /*function addMultiserviceName(){
       if(p==10)
            return false;
      p = parseInt(p)+parseInt(1); 
      $('#countServiceName').val(p);
      $('#multiserviceName').append('<input type="text" class="form-control" name="hospitalServices_serviceName[]" id="" placeholder="Give Your Service Name" maxlength="30" />' );
   }*/
    
        $("#savebtn").click(function(){
         $("#avatar-modal").modal('hide');
     }); 
     
    </script> 
