
<link href="<?php echo base_url(); ?>assets/images/fevicon-m.ico" rel="shortcut icon">
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>


<script>
    var resizefunc = [];
</script>

<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js">
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jsapi.js">
</script>
<!-- Chart JS -->
<script src="<?php echo base_url(); ?>assets/vendor/chart.js/chart.min.js">
</script>
<script src="<?php echo base_url(); ?>assets/js/pages/favouriteby.js" type="text/javascript">
</script>

<script src="<?php echo base_url(); ?>assets/js/pages/favouriteby.js" type="text/javascript">
</script>
    


<script>

    $(document).ready(function () {
        var oTable = $('#favTable').DataTable({
            "processing": true,
            "serverSide": true,
            "bLengthChange": false,
            "bFilter": true,
            "iDisplayStart ": 10,
            "iDisplayLength": 12,
            "columns": [
                {"data": "first"},
                {"data": "second"},
                {"data": "third"},
                {"data": "fourth"},
                {"data": "fifth"},
            ],
            "ajax": {
                "url": "<?php echo site_url('favouriteby/getFavByDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    //d.cityId = $("#helathpkg_cityId").val();
                    //d.name = $("#search").val();
                    // d.mi = $("#mi").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });
    });

   

    

 function createCSV(){
         var mi = '';
         var helathpkg_cityId = '';
         mi = $('#mi').val();
         helathpkg_cityId = $('#helathpkg_cityId').val();
         $.ajax({
              url : urls + 'index.php/healthace/createCSV',
              type: 'POST',
             data: {'mi' : mi ,'helathpkg_cityId': helathpkg_cityId },
             success:function(datas){
                console.log(datas)
             }
          });
     } 
     
</script>   