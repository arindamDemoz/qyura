<style type="text/css">
    #diagnostic_datatable_filter
    {
        display:none;
    }
</style>
<?php $check= 0; 
$id = $this->uri->segment(3); 
if(!empty($id)){
	$check = $this->uri->segment(3); 
}else{
	$check = 0 ;
}?>
<link href="<?php echo base_url();?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/cropper/main.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>

<?php $current = $this->router->fetch_method();
if($current != 'detailDiagnostic'):?>
<script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php else:?>

<!--<script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>-->
<script src="<?php echo base_url(); ?>assets/cropper/gallery_cropper.js"></script>

<?php endif;?>

<script src="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
<!--<script src="<?php echo base_url();?>assets/js/angular.min.js"></script>-->
<script src="<?php echo base_url();?>assets/js/pages/diagdetail.js"></script>
<script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<script> 
     var urls = "<?php echo base_url()?>";
     var diagnosticId = "<?php echo $check?>";
</script>
<script>
     /**
     * @project Qyura
     * @description  geo location address
     * @access public
     */
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
      
    /**
     * @project Qyura
     * @description  city, state records
     * @access public
     */
    
      $(document).ready(function(){
          
          fetchStates();
          loadAwards();
          loadServices();
          loadSpeciality();
          loadDiagnostic();
          
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
                //console.log(datas);
                  $('#diagnostic_cityId').html(datas);
                  $('#diagnostic_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
      });
    </script>
<script>

    /**
     * @project Qyura
     * @description  datepicker
     * @access public
     */
    $('.selectpicker').selectpicker({
        style: 'btn-default',
        size: "auto",
        width: "100%"
    });
    $("#savebtn").click(function(){
         $("#avatar-modal").modal('hide');
     }); 
    
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

    /**
     * @project Qyura
     * @description  datatable listing
     * @access public
     */
    $(document).ready(function () {
        var oTable = $('#diagnostic_datatable').DataTable({
             "processing": true,
            "bServerSide": true,
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
            //oTable.search($(this).val()).draw();
             oTable.draw();
            
        });
        
          /**
            * @project Qyura
            * @description  datatable listing
            * @access public
            */
        var oTableDr = $('#diagnostic_doctors').DataTable({
             "processing": true,
            "bServerSide": false,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "sPaginationType": "full_numbers",
            "columns": [
                {"data": "doctors_img"},
                {"data": "name"},
                {"data": "specialityName"},
                {"data": "consFee"},
                {"data": "exp"},
                {"data": "doctors_phn"},
                {"data": "view"},
            ],
            "ajax": {
                "url": urls + 'index.php/diagnostic/getDiagnosticDoctorsDl/'+diagnosticId,
                "type": "POST",
                "data": function (d) {
                   
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });
        
    });
    
    /**
     * @project Qyura
     * @description  form validation
     * @access public
     */  
     
    var urls = "<?php echo base_url()?>";
    var j = 1;
    var k = 1;
    var l =1;
    var n= 1;
    var m =1;
    function fetchCityDetails(stateId) {           
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
        
    /**
     * @project Qyura
     * @description award crud operation
     * @access public
     */   
    
    function addAwards(){
        var dialAwards_awardsName = $.trim($('#diagnostic_awardsName').val());
        if(dialAwards_awardsName != ''){
            $.ajax({
               url : urls + 'index.php/diagnostic/addDiagnosticAwards',
               type: 'POST',
              data: {'diagnosticId' : diagnosticId , 'diaAwards_awardsName' : dialAwards_awardsName },
              success:function(datas){
               // console.log(datas);
                  loadAwards();
                  $('#diagnostic_awardsName').val('');
              }
           });
        }    
    }
    function editAwards(awardsId){
         var edit_awardsName = $.trim($('#'+awardsId).val());
        
        if(edit_awardsName != ''){
            
            $.ajax({
               url : urls + 'index.php/diagnostic/editDiagnosticAwards',
               type: 'POST',
              data: {'awardsId' : awardsId , 'diaAwards_awardsName' : edit_awardsName },
              success:function(datas){
              console.log(datas);
                  loadAwards();
              }
           });
        }  
    }
    function deleteAwards(awardsId){
        
         $.ajax({
               url : urls + 'index.php/diagnostic/deleteDiagnosticAwards',
               type: 'POST',
              data: {'awardsId' : awardsId },
              success:function(datas){
              console.log(datas);
                  loadAwards();
              }
           });
        
    }
    function loadAwards(){
       
        $('#loadAwards').load(urls + 'index.php/diagnostic/diagnosticAwards/'+diagnosticId,function () {
           // alert('callback function ');
        });
        $('#totalAwards').load(urls + 'index.php/diagnostic/detailAwards/'+diagnosticId,function () {
           // alert('callback function implementation');
        });
    }
    
    
    /**
     * @project Qyura
     * @description service crud operation
     * @access public
     */
    function addServices(){
        var diagnostic_serviceName = $.trim($('#diagnostic_serviceName').val());
        if(diagnostic_serviceName != ''){
            $.ajax({
               url : urls + 'index.php/diagnostic/addDiagnosticServices',
               type: 'POST',
              data: {'diagnosticId' : diagnosticId , 'service_name' : diagnostic_serviceName },
              success:function(datas){
               // console.log(datas);
                  loadServices();
                  $('#diagnostic_serviceName').val('');
              }
           });
        }    
    }
    function editServices(awardsId){
         var edit_awardsName = $.trim($('#'+awardsId).val());
        
        if(edit_awardsName != ''){
            
            $.ajax({
               url : urls + 'index.php/diagnostic/editDiagnosticServices',
               type: 'POST',
              data: {'awardsId' : awardsId , 'service_name' : edit_awardsName },
              success:function(datas){
              console.log(datas);
                  loadServices();
              }
           });
        }  
    }
    function deleteServices(awardsId){
        
         $.ajax({
               url : urls + 'index.php/diagnostic/deleteDiagnosticServices',
               type: 'POST',
              data: {'awardsId' : awardsId },
              success:function(datas){
              console.log(datas);
                  loadServices();
              }
           });
        
    }
    function loadServices(){
       
        $('#loadServices').load(urls + 'index.php/diagnostic/diagnosticServices/'+diagnosticId,function () {
           // alert('callback function ');
        });
        $('#totalServices').load(urls + 'index.php/diagnostic/detailServices/'+diagnosticId,function () {
           // alert('callback function implementation');
        });
    }
    function deleteGalleryImage(id){
	  if(confirm('Are you sure want to delete?')){	
    	  $.ajax({
              url : urls + 'index.php/diagnostic/deleteGalleryImage',
              type: 'POST',
             data: {'id' : id },
             success:function(datas){
                loadGallery();
             }
          });

     }
    }
    function loadGallery(){
    	$('#display_gallery').load(urls + 'index.php/diagnostic/getGalleryImage/'+diagnosticId,function () {

         });
    }
    
    
   /**
     * @project Qyura
     * @description load diagnostic
     * @access public
     */
    
    function loadDiagnostic(){
        $('#list2').load(urls + 'index.php/diagnostic/diagnosticCategorys/'+diagnosticId,function () {
           // alert('callback function implementation');
        });
        $('#list3').load(urls + 'index.php/diagnostic/diagnosticAllocatedCategorys/'+diagnosticId,function () {
           // alert('callback function implementation');
        });
    
    } 
    
     function addDiagnostic(){
         $('.diagonasticCheck').each(function() {
            if($(this).is(':checked')){
                $.ajax({
                    url : urls + 'index.php/diagnostic/addDiagnosticHasCategory',
                    type: 'POST',
                   data: {'diagnosticId' : diagnosticId , 'diagnosticsHasCat_diagnosticsCatId' : $(this).val() },
                   success:function(datas){
                    
                       loadDiagnostic();
                   }
                });
            }
            
        });
    }
    
      function revertDiagnostic(){
         $('.diagonasticAllocCheck').each(function() {
            if($(this).is(':checked')){
                $.ajax({
                    url : urls + 'index.php/diagnostic/revertDiagnosticHasCategory',
                    type: 'POST',
                   data: {'diagnosticId' : diagnosticId , 'diagnosticsHasCat_id' : $(this).val() },
                   success:function(datas){
                    
                       loadDiagnostic();
                   }
                });
            }
            
        });
    }
    
    /**
     * @project Qyura
     * @description load speciality
     * @access public
     */
    
    function loadSpeciality(){
        $('#list4').load(urls + 'index.php/diagnostic/diagnosticSpecialities/'+diagnosticId,function () {
           // alert('callback function implementation');
        });
        $('#list5').load(urls + 'index.php/diagnostic/diagnosticAllocatedSpecialities/'+diagnosticId,function () {
           // alert('callback function implementation');
        });
    
    } 
    
     function addSpeciality(){
         $('.diagonasticSpecialCheck').each(function() {
            if($(this).is(':checked')){
                $.ajax({
                    url : urls + 'index.php/diagnostic/addSpeciality',
                    type: 'POST',
                   data: {'diagnosticId' : diagnosticId , 'diagnosticSpecialities_specialitiesId' : $(this).val() },
                   success:function(datas){
                    
                       loadSpeciality();
                   }
                });
            }
            
        });
    }
    
      function revertSpeciality(){
         $('.diagonasticAllocSpecialCheck').each(function() {
            if($(this).is(':checked')){
                $.ajax({
                    url : urls + 'index.php/diagnostic/revertSpeciality',
                    type: 'POST',
                   data: {'diagnosticId' : diagnosticId , 'diagnosticSpecialities_id' : $(this).val() },
                   success:function(datas){
                    
                       loadSpeciality();
                   }
                });
            }
            
        });
    }
    
    
    function getDignosticPrize(diagnosticId,categoryId){
       
        $.ajax({
                    url : urls + 'index.php/diagnostic/getDiagnosticPrizeList',
                    type: 'POST',
                   data: {'diagnosticId' : diagnosticId , 'categoryId' : categoryId },
                   success:function(datas){
                    
                       $('#loadTestDetail').html(datas);
                   }
                });
    }
      function fetchInstruction(digTestId){
         $.ajax({
                    url : urls + 'index.php/diagnostic/detailDiagnosticInstruction',
                    type: 'POST',
                   data: {'quotationDetailTests_id' : digTestId},
                   success:function(datas){
                    
                       $('#detailInstruction').html(datas);
                   }
                });
    }
</script>
