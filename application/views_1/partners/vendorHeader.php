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
<?php if($this->uri->segment(1) == "partners" ){ 
      if($this->uri->segment(2) == "vendorServices"         || $this->uri->segment(4) == "aerobics" 
      || $this->uri->segment(4) == "crossfunctional"        || $this->uri->segment(4) == "dance"
      || $this->uri->segment(4) == "dietitiannutritionist"  || $this->uri->segment(4) == "fitnessstudio"  
      || $this->uri->segment(4) == "gym"                    || $this->uri->segment(4) == "karatemartialart"  
      || $this->uri->segment(4) == "kickboxing"             || $this->uri->segment(4) == "nutritionist"
      || $this->uri->segment(4) == "pilates"                || $this->uri->segment(4) == "spinning"
      || $this->uri->segment(4) == "swimming"               || $this->uri->segment(4) == "yoga" 
      || $this->uri->segment(4) == "zumba"                  || $this->uri->segment(4) == "others"                                      || $this->uri->segment(2) == "aerobics" 
      || $this->uri->segment(2) == "crossfunctional"        || $this->uri->segment(2) == "dance"
      || $this->uri->segment(2) == "dietitiannutritionist"  || $this->uri->segment(2) == "fitnessstudio"  
      || $this->uri->segment(2) == "gym"                    || $this->uri->segment(2) == "karateMartialart"  
      || $this->uri->segment(2) == "kickboxing"             || $this->uri->segment(2) == "pilates"         
      || $this->uri->segment(2) == "spinning"               || $this->uri->segment(2) == "swimming"        
      || $this->uri->segment(2) == "yoga"                   || $this->uri->segment(2) == "zumba"    
      || $this->uri->segment(4) == "others"        ){?>    
    <div id="wrapper"> 
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> 
                                    <span class="block m-t-xs"> 
                                        <strong class="font-bold"><?php echo $this->session->userdata('vendorEmail'); ?></strong>
                                        &nbsp; <b class="fa fa-edit"></b></span>
                                    
                                </span> 
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo site_url('/partners/editProfile'); ?>">Edit</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            FF+ 
                        </div>
                    </li>
                    <?php $vendorId = $this->session->userdata('vendorId'); ?>
                    
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(2)=="vendorServices") ? 'active' : "" ;?>">
                            <a href="<?php echo site_url(); ?>/partners/vendorServices"><i class="fa fa-th-large"></i> <span class="nav-label">Home</a>
                    </li>
                    <?php if (in_array("Aerobics", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="aerobics") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/aerobics"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">Aerobics</span></a>
                    </li>
                    <?php } 
                    if (in_array("Cross Functional", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="crossfunctional") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/crossfunctional"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">Cross Functional</span></a>
                    </li>
                    <?php }
                    if (in_array("Dance", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="dance") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/dance"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">Dance</span></a>
                    </li>
                    <?php }
                    if (in_array("Dietitian/Nutritionist", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="dietitiannutritionist") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/dietitiannutritionist"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">Dietitian/Nutritionist</span></a>
                    </li>
                    <?php }
                    if (in_array("Fitness Studio", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="fitnessstudio") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/fitnessstudio"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">Fitness Studio</span></a>
                    </li>
                    <?php }
                    if (in_array("GYM", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="gym") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/gym"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">GYM</span></a>
                    </li> 
                    <?php }
                    if (in_array("Karate/Martial Art", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="karatemartialart") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/karatemartialart"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">Karate/Martial Art</span></a>
                    </li>
                    <?php }
                    if (in_array("Kick Boxing", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="kickboxing") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/kickboxing"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">Kick Boxing</span></a>
                    </li>
                    <?php }
                    if (in_array("Pilates", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="pilates") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/pilates"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">Pilates</span></a>
                    </li>
                    <?php }
                    if (in_array("Spinning", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="spinning") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/spinning"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">Spinning</span></a>
                    </li>
                    <?php }
                    if (in_array("Swimming", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="swimming") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/swimming"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">Swimming</span></a>
                    </li>
                    <?php }
                    if (in_array("YOGA", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="yoga") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/yoga"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">YOGA</span></a>
                    </li>
                    <?php }
                    if (in_array("Zumba", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="zumba") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/zumba"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">Zumba</span></a>
                    </li>
                    <?php }
                    if (in_array("Others", $servicesArray)){ ?>
                    <li class="<?php echo ($this->uri->segment(1)=="partners" &&  $this->uri->segment(4)=="others") ? 'active' : "" ;?>" >
                        <a href="<?php echo site_url("partners/vendorCustomView")."/".$vendorId."/others"; ?>"><i class="fa fa-th-list"></i> <span class="nav-label">Others</span></a>
                    </li>
                    <?php } ?>
                    <li class="special_link">
                        <a href="<?php echo site_url('/partners/editProfile'); ?>"><i class="fa fa-edit"></i><span class="nav-label">Edit Profile</span></a>
                    </li>
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
                            <span class="m-r-sm text-muted welcome-message">Welcome to FROYOFIT</span>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/partners/logout'); ?>">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul> 
                </nav>
            </div>
<?php } } ?>
