<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>VENDOR | Forms</title>
        <link href="<?php echo base_url(); ?>/assest/fevicon.png" rel="shortcut icon" type="image/x-icon" />
        
        <link href="<?php echo base_url(); ?>inspinia/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>inspinia/css/plugins/iCheck/custom.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>inspinia/css/plugins/steps/jquery.steps.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>inspinia/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>inspinia/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>inspinia/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/bootstrap-select/bootstrap-select.min.css"/>
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/select2/select2.css"/>-->

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/timepicker/bootstrap-timepicker.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/line/grey.css"  />
        <style>
            .icheckbox_line-grey, .iradio_line-grey {
                display: inline-block;
                /*height: 16px;*/
                line-height: 17px;
                margin: 10px 3px;
                padding: 3px 15px 5px 38px;
                position: relative;
                width: auto;
            }
            .customHide{
                display: none;
            }
            .has-error{
                color: red;
            }
	    .m-left-30{
                margin-left : 30px !important;
            }
            .float-e-margins .btn {
                margin-bottom: 0px;
            }
            .chargesClass > label.error{
                position: absolute;
                bottom: -4%;
                left: 2%;
            }
            .icheckbox_line-grey > label.error{
                left: 4%;
                margin-top: -2%;
                position: fixed;
            }
            .timeSlotClass > label.error{
                right: 19%;
                position: fixed;
            }
            .charges > label.error {
                left: 16%;
                margin-top: -1%;
                position: fixed;
            }
	    @media screen and (min-width: 320px) and (max-width: 768px) {
                .wizard > .steps > ul > li {
                    width: 100%;
                }
            }
	    @media screen and (min-width: 320px) and (max-width: 768px) {
		body.mini-navbar #page-wrapper {
		    margin: 0 0 0 160px;
		}
		body.mini-navbar .navbar-static-side {
		    width: 160px;
		}
		body.mini-navbar .logo-element {
		    display: none;
		}
		body.mini-navbar .profile-element, body.mini-navbar .nav-label, body.mini-navbar .navbar-default .nav li a span {
		    display: block;
		}
		body.mini-navbar .navbar-default .nav > li > a {
		    font-size: 12px;
		}
		.fa{
		    float: left;
		    line-height: 1.4;
		}
		.dropdown.profile-element {
		    margin: 10px 0 10px 10px;
		}
		.logo-home {
		    width: 55%;
		}
	    }
        </style>
    </head>
<body>

    <div id="wrapper"> 
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
<!--                                <span class="clear"> 
                                    <span class="block m-t-xs"> 
                                        <strong class="font-bold"><?php echo $this->session->userdata('vendorEmail'); ?></strong>
                                        &nbsp; <b class="fa fa-edit"></b></span>
                                </span> -->
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#myModal">Change Password</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            FF+ 
                        </div>
                    </li>
                    
                    <?php $vendorId = $this->session->userdata('vendorId'); ?>
                    
                    <li class="active">
                            <a href="<?php echo site_url(); ?>superadmin/vendorServices"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</a>
                    </li>
                    
                    <?php foreach ($servicesArray as $service){

                        $tableName = strtolower($service);
                        $tableName = str_replace('/', '', $tableName);
                        $tableName = str_replace(' ', '', $tableName);
                        $tableName = trim($tableName);
                        ?> 
                        <li class="<?php echo ($this->uri->segment(3)=="aerobics") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("vendorview/vendorCustomView")."/$tableName"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label"><?php echo $service; ?></span></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </nav> 
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="#">Welcome to Froyofit</a>
                        </li>
<!--                        <li>
                            <a href="#" data-toggle="modal" data-target="#myModal">Change Password</a>
                        </li>-->
                        <li>
                            <a href="<?php echo site_url('/superadmin/dashboard/logout'); ?>">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul> 
                </nav>
            </div>

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h6 class="modal-title">Change Password</h6>
            </div>
            <form method="POST" id="changePassword" action="#" class="wizard-big" enctype="multipart/form-data">
                <!--<div class="alert alert-success" id="passwordSuccess" style="display: none"></div>-->
                <div class="alert alert-danger" id="er_TopError" style="display: none"></div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="vendorId" name="vendorId" value="<?php echo $this->session->userdata('vendorId');  ?>">
                        <label>Old Password *</label>
                        <label class="has-error" id="er_old"><?php echo form_error("password"); ?></label>
                        <input id="old" name="old" type="password" class="form-control required" placeholder="Password" required="">
                        <br>
                        <label>New Password *</label>
                        <label class="has-error" id="er_password"><?php echo form_error("password"); ?></label>
                        <input id="password" name="password" type="password" class="form-control required" placeholder="Password" onblur="checkPassword('password','confirm');" required="">
                        <br>
                        <label>Confirm New Password *</label>
                        <label class="has-error" id="er_confirm"><?php echo form_error("password"); ?></label>
                        <input id="confirm" name="confirm" type="password" class="form-control required" placeholder="Re-Type Password" onblur="checkConfirm('password','confirm');" required="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>