<style type="text/css">
    #datatable_bloodbank_filter
    {
        display:none;
    }
    
    table.dataTable thead th {
    position: relative;
    background-image: none !important;
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
                    "serverSide": true,
                     "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "dom": '<<t><"clearfix m-t-20 p-b-20" p>',
                    "iDisplayStart ":20,
                    "columns": [
                        {"data": "orderId"},
                        {"data": "userName"},
                        {"data": "diagCatName"},
                        {"data": "MIname"},
                        {"data": "bookStatus"},
                        {"data": "view"}
                    ],
                    
                    "ajax": {
                        "url": "<?php echo site_url('miappointment/getDignostiData'); ?>",
                        "type": "POST",
                        "data": function ( d ) {
                                        
                                        d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                                    } 
                    }
                });
                
                 
            });
    
</script>
