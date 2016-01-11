<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Listing</title>
        <link href="<?php echo base_url(); ?>/assest/fevicon.png" rel="shortcut icon" type="image/x-icon" />
        
        <link href="<?php echo base_url(); ?>inspinia/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Data Tables -->
        <link href="<?php echo base_url(); ?>inspinia/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>inspinia/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>inspinia/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>inspinia/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>inspinia/css/style.css" rel="stylesheet">

    </head>
    <body>
        <div id="wrapper">
            <div class="wrapper gray-bg">
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-12">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url() ?>assest/img/froyologo.png" alt="FroyoFit" style="width: 16%; margin-top: 1%; margin-bottom: -1%;"></a>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="<?php echo site_url(); ?>/admin/logout" style="margin-top: 5%;">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
		    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Enquiry Email's</h5>
                                </div>
                                <div class="ibox-content">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($emailList) && $emailList != NULL){ 
                                                foreach ($emailList as $email){ ?>
                                            <tr class="gradeX">
                                                <td><?php echo $email->emailList; ?></td>
                                                <td><?php echo date("d-m-Y ", strtotime($email->createAt));  ?></td>
                                                <td><?php echo date("g:i A",strtotime($email->createAt));  ?></td>
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Career</h5>
                                </div>
                                <div class="ibox-content">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Position</th>
                                                <th>City</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Resume</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($carrierData) && $carrierData != NULL){ 
                                                foreach ($carrierData as $carrier){ ?>
                                            <tr class="gradeX">
                                                <td><?php echo $carrier->carrierName; ?></td>
                                                <td><?php echo $carrier->carrierEmail; ?></td>
                                                <td><?php echo $carrier->carrierPhone; ?></td>
                                                <td><?php echo $carrier->carrierPosition; ?></td>
                                                <td><?php echo $carrier->carrierCity; ?></td>
                                                <td><?php echo date("d-m-Y ", strtotime($carrier->createAt));  ?></td>
                                                <td><?php echo date("g:i A",strtotime($carrier->createAt));  ?></td>
                                                <td><a target="_blank" href="<?php echo $carrier->carrierResume; ?>">Resume</a></td>
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Request a Callback</h5>
                                </div>
                                <div class="ibox-content">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Call Time</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($callbackList) && $callbackList != NULL){ 
                                                foreach ($callbackList as $callback){ ?>
                                            <tr class="gradeX">
                                                <td><?php echo $callback->callbackName; ?></td>
                                                <td><?php echo $callback->callbackEmail; ?></td>
                                                <td><?php echo $callback->callbackMobile; ?></td>
                                                <td><?php if($callback->callbackTime == 1){echo "Before 10 AM";}
                                                          elseif($callback->callbackTime == 2){echo "10 AM - 2 PM";}
                                                          elseif($callback->callbackTime == 3){echo "2 PM - 6 PM";}
                                                          elseif($callback->callbackTime == 4){echo "6 PM - 10 PM";}?>
                                                </td>
                                                <td><?php echo date("d-m-Y ", strtotime($callback->createAt));  ?></td>
                                                <td><?php echo date("g:i A",strtotime($callback->createAt));  ?></td>
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Partner With Us</h5>
                                </div>
                                <div class="ibox-content">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Location</th>
                                                <th class="col-md-3">Services</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($partnerList) && $partnerList != NULL){ 
                                                foreach ($partnerList as $partner){ ?>
                                            <tr class="gradeX">
                                                <td><?php echo $partner->partnerName; ?></td>
                                                <td><?php echo $partner->partnerEmail; ?></td>
                                                <td><?php echo $partner->partnerMobile; ?></td>
                                                <td><?php echo $partner->partnerLocation; ?></td>
                                                <td class="col-md-3"><?php echo $partner->partnerService; ?>, <?php if($partner->otherServiceText != NULL){ echo $partner->otherServiceText; } ?></td>
                                                <td><?php echo date("d-m-Y ", strtotime($partner->createAt));  ?></td>
                                                <td><?php echo date("g:i A",strtotime($partner->createAt));  ?></td>
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="<?php echo base_url(); ?>inspinia/js/jquery-2.1.1.js"></script>
        <script src="<?php echo base_url(); ?>inspinia/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo base_url(); ?>inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>inspinia/js/plugins/jeditable/jquery.jeditable.js"></script>

        <!-- Data Tables -->
        <script src="<?php echo base_url(); ?>inspinia/js/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="<?php echo base_url(); ?>inspinia/js/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>inspinia/js/plugins/dataTables/dataTables.responsive.js"></script>
        <script src="<?php echo base_url(); ?>inspinia/js/plugins/dataTables/dataTables.tableTools.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?php echo base_url(); ?>inspinia/js/inspinia.js"></script>
        <script src="<?php echo base_url(); ?>inspinia/js/plugins/pace/pace.min.js"></script>

        <!-- Page-Level Scripts -->
        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable({
                    responsive: true,
                    "dom": 'T<"clear">lfrtip',
                    "tableTools": {
//                        "aButtons": ["print" ],
                        "sSwfPath": "<?php echo base_url(); ?>inspinia/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                    },
                    "order": [
                        [1, 'desc']
                    ]
                });

                /* Init DataTables */
                var oTable = $('#editable').dataTable({
                    "order": [
                        [1, 'desc']
                    ]
                });

                /* Apply the jEditable handlers to the table */
                oTable.$('td').editable('../example_ajax.php', {
                    "callback": function (sValue, y) {
                        var aPos = oTable.fnGetPosition(this);
                        oTable.fnUpdate(sValue, aPos[0], aPos[1]);
                    },
                    "submitdata": function (value, settings) {
                        return {
                            "row_id": this.parentNode.getAttribute('id'),
                            "column": oTable.fnGetPosition(this)[2]
                        };
                    },
                    "width": "90%",
                    "height": "100%"
                });


            });

            function fnClickAddRow() {
                $('#editable').dataTable().fnAddData([
                    "Custom row",
                    "New row",
                    "New row",
                    "New row",
                    "New row"]);

            }
        </script>
        <style>
            body.DTTT_Print {
                background: #fff;

            }
            .DTTT_Print #page-wrapper {
                margin: 0;
                background:#fff;
            }

            button.DTTT_button, div.DTTT_button, a.DTTT_button {
                border: 1px solid #e7eaec;
                background: #fff;
                color: #676a6c;
                box-shadow: none;
                padding: 6px 8px;
            }
            button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
                border: 1px solid #d2d2d2;
                background: #fff;
                color: #676a6c;
                box-shadow: none;
                padding: 6px 8px;
            }

            .dataTables_filter label {
                margin-right: 5px;

            }
        </style>
    </body>

</html>
