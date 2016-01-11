<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php if($this->uri->segment(1) == "super"){ echo "Super Admin"; }elseif($this->uri->segment(1) == "sales"){ echo "Sales"; }else{ echo "Admin"; } ?></title>
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
                                <a href="<?php if($this->uri->segment(1) == "super"){ echo site_url('/super/logout'); }elseif($this->uri->segment(1) == "sales"){ echo site_url('/sales/logout'); }else{ echo site_url('/admin/logout'); } ?>" style="margin-top: 5%;">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>