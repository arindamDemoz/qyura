<style type="text/css">
    #medicart_offer_datatable_filter
    {
        display:none;
    }
    label.error p{
        color: #ef5350 !important;
    }
</style>
<?php $check= 0; 
if(isset($diagnosticId) && !empty($diagnosticId)){
    $check = $diagnosticId; 
}?>
<link href="<?php echo base_url();?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/cropper/main.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>

<?php $current = $this->router->fetch_method();
if($current != 'detailDiagnostic'):?>
<script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php else:?>

<script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>

<?php endif;?>

<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/jquery.xeditable.js"> </script> 
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js" type="text/javascript"></script> 

    
<script> 
     var urls = "<?php echo base_url()?>";
//     var diagnosticId = "<?php //echo $check?>";
</script>

<script>
     /**
     * @project Qyura
     * @description  datepicker
     * @access public
     */
    

    
        $('#date-1').datepicker();
        $('#date-2').datepicker();

        $('.pickDate').datepicker()
            .on('changeDate', function (ev) {
                $('.pickDate').datepicker('hide');
                     var sDate = $('#date-1').val();
                     var eDate = $('#date-2').val(); 
                     var d1 = new Date($('#date-1').val());
                     var d2 = new Date($('#date-2').val());
                     if(d1.getTime() > d2.getTime()){
                         alert('greater');
                     }
            });
        
        var hideKeyboard = function () {
          document.activeElement.blur();
          $(".pickDate").blur();
      };
      
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
     * @description  offer datatable
     * @access public
     */
    
       $(document).ready(function () {
           
        var oTableOffer = $('#medicart_offer_datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "columnDefs": [{
                    "targets": [1,2,3,4,5,6,7],
                    "orderable": false
                }],
            "pageLength": 10,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "dom": '<<t><"clearfix m-t-20 p-b-20" p>',
            "iDisplayStart ": 20,
            "columns": [
                {"data": "medicartOffer_id"},
                {"data": "MIname"},
                {"data": "medicartOffer_title"},
                {"data": "totalBooking"},
                {"data": "totalInquiries"},
                {"data": "medicartOffer_startDate"},
                {"data": "medicartOffer_endDate"},
                {"data": "status"}
            ],
            "ajax": {
                "url": "<?php echo site_url('medicart/getMedicartDl'); ?>",
                "type": "POST",
                "async": false,
                "data": function (d) {
                    d.search['value'] = $("#search").val();
                    d.cityId = $("#cityId").val();
                    d.statusId = $("#statusId").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                },
                 beforeSend: function () {
                   // setting a timeout
                    $('#load_consulting').show();
                },
                complete: function ()
                {
                   $('#load_consulting').hide('200');
                },
            }
        });
        
        var oTableEnquiries = $('#medicart_enquiries_datatables').DataTable({
            "processing": true,
            "serverSide": true,
            "columnDefs": [{
                    "targets": [1,2,3,4,5],
                    "orderable": false
                }],
            "pageLength": 10,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "dom": '<<t><"clearfix m-t-20 p-b-20" p>',
            "iDisplayStart ": 20,
            "columns": [
                {"data": "medicartContect_enquiryId"},
                {"data": "MIname"},
                {"data": "medicartOffer_title"},
                {"data": "medicartContect_name"},
                {"data": "medicartContect_mobileNo"},
                {"data": "action", "searchable": false, "order": false}
            ],
            "ajax": {
                "url": "<?php echo site_url('medicart/getMedicartEnquiriesDl'); ?>",
                "type": "POST",
                "async": false,
                "data": function (d) {
                    d.search['value'] = $("#search").val();
                    d.cityId = $("#cityIdEnq").val();
                    //d.statusId = $("#statusId").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                },
                 beforeSend: function () {
                   // setting a timeout
                    $('#load_consulting').show();
                },
                complete: function ()
                {
                   $('#load_consulting').hide('200');
                },
            }
        });
        

        var oTableBooking = $('#medicart_booking_datatables').DataTable({
            "processing": true,
            "serverSide": true,
            "columnDefs": [{
                    "targets": [1,2,3,4,5],
                    "orderable": false
                }],
            "pageLength": 10,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "dom": '<<t><"clearfix m-t-20 p-b-20" p>',
            "iDisplayStart ": 20,
            "columns": [
                {"data": "medicartBooking_bookId"},
                {"data": "MIname"},
                {"data": "medicartBooking_preferredDate"},
                {"data": "patientDetails_patientName"},
                {"data": "medicartOffer_title"},
                {"data": "users_mobile"},
                {"data": "action", "searchable": false, "order": false}
            ],
            "ajax": {
                "url": "<?php echo site_url('medicart/getMedicartBookingDl'); ?>",
                "type": "POST",
                "async": false,
                "data": function (d) {
                    //d.search['value'] = $("#search").val();
                    d.cityId = $("#cityIdEnq").val();
                    //d.statusId = $("#statusId").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                },
                 beforeSend: function () {
                   // setting a timeout
                    $('#load_consulting').show();
                },
                complete: function ()
                {
                   $('#load_consulting').hide('200');
                },
            }
        });
        
        $('#cityId,#statusId,#cityIdEnq').change(function () {
            oTableEnquiries.draw();
            oTableOffer.draw();
            oTableBooking.draw();
        });
          
        $('#search').on('keyup', function () {
          oTableEnquiries.draw();
          oTableOffer.draw();
          oTableBooking.draw();
        });
        
        $("#cityId,#cityIdEnq").select2({
             allowClear: true,
             placeholder: "Select a city"
        });
        $("#miType").select2({
             allowClear: true,
             placeholder: "Select MI Type"
        });
        $("#miName").select2({
             allowClear: true,
             placeholder: "Select MI Name"
        });
         $("#medicartOffer_offerCategory").select2({
             allowClear: true,
             placeholder: "Select Catrgory"
        });
    });
      
     
         function getMIList(type,cityId) { 
           if(type != '' && type == "Hospital"){
               var method = 'index.php/medicart/getHospital';
           }else if(type != '' && type == "Diagnostic"){
               var method = 'index.php/medicart/getDiagno';
           }
           
           $.ajax({
               url : urls + method,
               type: 'POST',
              data: {'cityId' : cityId},
              success:function(datas){
                  $('#miName').html(datas);
                  $('#miName').selectpicker('refresh');
              }
           });
           
        }
        
     $("#savebtn").click(function(){
         $("#avatar-modal").modal('hide');
     }); 
    
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
   
    </script>

</body>
</html>
