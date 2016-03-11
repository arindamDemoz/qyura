<style type="text/css">
    #datatable_bloodbank_filter
    {
        display:none;
    }
</style>

<link href="<?php echo base_url(); ?>assets/summernote/dist/summernote.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/summernote/dist/summernote.min.js"></script>
<link href="<?php echo base_url();?>assets/cropper/cropper.min.css" rel="stylesheet">
<!--<link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->
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


<script>
     
      /**
     * @method datatable
     * @description get records in listing using datatables
     */
    $(document).ready(function () {
        var oTable = $('#datatable_bloodbank').DataTable({
            "processing": true,
            "bServerSide": true,
           // "searching": true,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "sAjaxSource": "<?php echo site_url('cms/getcmsdetail'); ?>",
           
             "columns": [
                {"data": "cms_title"},
                {"data": "cms_description"},
               
               {"data": "view" ,'searchable' : false},
            ],
        });

     
       
    });
  
   function validationBloodbank(){
       
       //$("form[name='bloodDetail']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#bloodBank_cntPrsn').val())
        
        var phn= $.trim($('#bloodBank_phn1').val());
        var myzip = $.trim($('#bloodBank_zip').val());
        var cityId =$.trim($('#cityId').val());
        var stateIds = $.trim($('#StateId').val());
        var bloodBank_mblNo = $.trim($('#bloodBank_mblNo').val());
        var status = 1;
       
             if($('#bloodBank_name').val()==''){
                $('#bloodBank_name').addClass('bdr-error');
                $('#error-bloodBank_name').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if($('#geocomplete').val()==''){
                $('#geocomplete').addClass('bdr-error');
                $('#error-bloodBank_add').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            
              
//            if(!$.isNumeric(phn)){
//                $('#bloodBank_phn1').addClass('bdr-error');
//                $('#error-bloodBank_phn').fadeIn().delay(3000).fadeOut('slow');
//                // $('#hospital_phn').focus();
//                status = 0;
//            }
              var emailCheck =  checkEmailFormat();
             
              
            if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
               
               status = 0;
            }
             if(!check.test(cpname)){
                $('#bloodBank_cntPrsn').addClass('bdr-error');
                $('#error-bloodBank_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                status = 0; 
            }
                if(!emailCheck){
                    status = 0;  
              }
       
            if( emails != '' && status == 1){
                check_email_detail(emails);
               
            }
            
        
            
            return false;
            
        }
    
</script>
<script>
  
     $(document).ready(function(){
               // $('.wysihtml5').wysihtml5();

                $('.summernote').summernote({
                    height: 300,                 // set editor height

                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor

                    focus: true                 // set focus to editable area after initializing summernote
                });

            });
   
    </script>

   