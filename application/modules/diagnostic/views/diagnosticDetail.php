<?php //print_r($pharmacyData);exit;?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?php echo base_url();?>assets/images/fevicon-m.ico" rel="shortcut icon">
    <title>Diagnostic Details</title>
    <link href="<?php echo base_url();?>assets/css/framework.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom-g.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom-r.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/css/responsive-r.css" rel="stylesheet" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
</head>

<body class="fixed-left">
    <!-- Begin page -->
  <div id="wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- Logo -->
            <div class="topbar-left">
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container row">
                    <div class="clearfix">
                        <div class="pull-left">
                            <div class="mlogo visible-xs visible-sm"><a href="#"><i class="md"></i></a></div>

                            <div class="hidden-xs hidden-sm">
                                <a class="logo" href="#"><img src="<?php echo base_url();?>assets/images/qyura-f-l.png"></a>

                                <button class="button-menu-mobile open-left"><i class="fa fa-bars"></i></button> <span class="clearfix"></span>
                            </div>

                            <button class="button-menu-mobile open-left hidden-lg hidden-md"><i class="fa fa-bars"></i></button> <span class="clearfix"></span>
                        </div>

                        <form class="navbar-form pull-left visible-md" role="search">
                            <div class="form-group">
                                <input class="form-control search-bar" placeholder="Type here for search..." type="text">
                            </div>
                            <button class="btn btn-search" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="dropdown">
                                <a aria-expanded="true" class="dropdown-toggle profile" data-toggle="dropdown" href=""><img alt="user-img" class="img-circle" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg"> Ramesh K
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="javascript:void(0)"><i class=
                                    "md md-face-unlock"></i> Profile</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><i class=
                                    "md md-settings"></i> Settings</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><i class=
                                    "md md-lock"></i> Lock screen</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><i class=
                                    "md md-settings-power"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown hidden-xs">
                                <a aria-expanded="true" class="dropdown-toggle waves-effect waves-light" data-target="#" data-toggle="dropdown" href="#"><i class="md md-notifications"></i>
                           <span class="badge badge-xs badge-danger">3</span></a>
                                <ul class="dropdown-menu dropdown-menu-lg">
                                    <li class="text-center notifi-title">
                                        Notification
                                    </li>
                                    <li class="list-group">
                                        <a class="list-group-item" href="javascript:void(0);">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <em class="fa fa-user-plus fa-2x text-info">
                                          </em>
                                                </div>
                                                <div class="media-body clearfix">
                                                    <div class="media-heading">
                                                        New user registered
                                                    </div>
                                                    <p class="m-0"><small>You have
                                             10 unread messages</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="list-group-item" href="javascript:void(0);">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <em class="fa fa-diamond fa-2x text-primary">
                                          </em>
                                                </div>
                                                <div class="media-body clearfix">
                                                    <div class="media-heading">
                                                        New settings
                                                    </div>
                                                    <p class="m-0"><small>There are
                                             new settings
                                             available</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="list-group-item" href="javascript:void(0);">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <em class="fa fa-bell-o fa-2x text-danger">
                                          </em>
                                                </div>
                                                <div class="media-body clearfix">
                                                    <div class="media-heading">
                                                        Updates
                                                    </div>
                                                    <p class="m-0"><small>There are
                                             <span class=
                                                "text-primary">2</span> new
                                             updates available</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="list-group-item" href="javascript:void(0);"><small>See
                                 all notifications</small></a>
                                    </li>
                                </ul>
                            </li>
                            <!-- <li class="hidden-xs">
                           <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="md md-settings"></i></a>
                           </li> -->
                            <li class="hidden-xs hidden-sm">
                                <a class="waves-effect waves-light" href="#" id="btn-fullscreen"><i class=
                              "md md-crop-free"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- nav-collapse -->
                </div>
            </div>
        </div>
        <!-- Top Bar End -->
        <!-- Left Sidebar Start -->
        <div class="left side-menu">
           <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <!--  Side Menu Bar -->
                <div id="sidebar-menu">
                    <ul>
                        <li>
                            <a href="dashboard.html" class="waves-effect"><i class="ion-ios7-keypad-outline"></i><span>Dashboard</span></a>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-hospital-o"></i> 
                            <span>Hospitals</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo base_url();?>index.php/hospital">All Hospitals</a></li>
                                <li><a href="<?php echo base_url();?>index.php/hospital/addHospital">Add New Hospital</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-plus-square"></i> 
                            <span>Diagnostic Centres</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo base_url();?>index.php/diagnostic">All Diag Centres</a></li>
                                <li><a href="<?php echo base_url();?>index.php/diagnostic/addDiagnostic">Add New Diag Centre</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-heartbeat"></i> 
                            <span>Blood Banks</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo base_url();?>index.php/bloodBank">All Blood Banks</a></li>
                                <li><a href="<?php echo base_url();?>index.php/bloodBank/AddbloodBank">Add New Blood Bank</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-medkit"></i> 
                            <span>Pharmacies</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo base_url();?>index.php/pharmacy">All Pharmacies</a></li>
                                <li><a href="<?php echo base_url();?>index.php/pharmacy/addPharmacy">Add New Pharmacies</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-ambulance"></i> 
                            <span>Ambulance Providr</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo base_url();?>index.php/ambulance">All Ambulance Providers</a></li>
                                <li><a href="<?php echo base_url();?>index.php/ambulance/addAmbulance">Add Ambulance Provider</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-stethoscope"></i> 
                            <span>Doctors</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-doctor.html">All Doctors</a></li>
                                <li><a href="add-doctor.html">Add New Doctor</a></li>
                                <li><a href="#">Schedule & Availability</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-stethoscope"></i> 
                            <span>MI Appointments</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="#">Pending Appointments</a></li>
                                <li><a href="all-appointment.html">All Appointments</a></li>
                                <li><a href="addappointment.html">Add New Appointment</a></li>
                                <li><a href="upload-reports.html">Upload Test Reports</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-stethoscope"></i> 
                            <span>Dr. Appointments</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="#">Pending Appointments</a></li>
                                <li><a href="doctor-appointments.html">All Appointments</a></li>
                                <li><a href="add-doctor-appointment.html">Add New Appointment</a></li>

                            </ul>
                        </li>


                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="ion-clipboard"></i> 
                            <span>Quotations</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="#">Pending Quotation Req.</a></li>
                                <li><a href="quotelist.html">All Quotation Requests</a></li>
                                <li><a href="send-quote.html">Send a Quote</a></li>
                                <li><a href="quote-history.html">Quotation History</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-newspaper-o"></i><span>Healthcare Packag.</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="health-packages.html">Healthcare Package</a></li>
                                <li><a href="add-health-package.html">Add New Package</a></li>
                                <li><a href="health-package-booking.html">Package Booking</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-newspaper-o"></i><span>Medicart</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="medicart-offer-list.html">Medicart Offers</a></li>
                                <li><a href="medicart-booking.html">Booking Requests</a></li>
                                <li><a href="medicart-enquiry.html">Enquiries</a></li>
                                <li><a href="add-medicat-offer.html">Add New Offer</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="call-tracking.html" class="waves-effect"><i class="ion-ios7-telephone-outline"></i><span>Call Tracking</span></a>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="md md-account-circle"></i><span>User Management</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-user.html">User List</a></li>
                                <li><a href="add-user.html">Add New User</a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-star-o"></i><span>Rate & Reviews</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="review-management.html">All Reviews</a></li>
                                <li><a href="#">Ratings</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="waves-effect"><i class="fa fa-star-o"></i><span>Favorited By</span></a>
                        </li>
                        <li>
                            <a href="#" class="waves-effect"><i class="fa fa-bar-chart-o"></i><span>App Analytics</span></a>

                        </li>
                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="md md-trending-up"></i><span>Finance</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="#">Finacial Accounts</a></li>
                                <li><a href="#">Invoice List</a></li>
                                <li><a href="#">Payment Transactions</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-gift"></i> <span>Promo Coupons</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="#">Coupons List</a></li>
                                <li><a href="#">Create a Coupon</a></li>
                            </ul>
                        </li>


                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-gift"></i> <span>Sponsor Health Tips</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="#">All Healthtip Offers</a></li>
                                <li><a href="#">Healthtip Bookings</a></li>
                                <li><a href="#">Healthtip Messages</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="waves-effect" href="#"><i class="fa fa-list-alt"></i><span>Reporting</span></a>
                        </li>
                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-gift"></i> <span>Master</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="specialities.html">Specialities</a></li>
                                <li><a href="diagnostics.html">Diagnostics</a></li>
                                <li><a href="degrees.html">Doctor Degrees</a></li>
                                <li><a href="#">Memberships</a></li>
                                <li><a href="#">Transaction Configuration</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="waves-effect" href="#"><i class="fa fa-cog"></i><span>Settings</span></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                
                <!-- End Side Bar -->
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                         <div class="col-md-12 text-success">
                            <?php echo $this->session->flashdata('message'); ?>
                         </div>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Diagnostic Detail</h3>
                            <a href="all-pharmacies.html" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>
                               
                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox m-t-10">


                        <div class="bg-white">
                            <!-- Table Section Start -->

                            <section class="col-md-12">

                                <aside class="clearfix m-bg-pic">


                                    <div class="bg-picture text-center">
                                        <div class="bg-picture-overlay"></div>
                                        <div class="profile-info-name">
                                            <div class='pro-img'>
                                                <!-- image -->
                                                <?php if(!empty($diagnosticData[0]->diagnostic_img)){
                                                    ?>
                                               <img src="<?php echo base_url()?>assets/diagnosticsImage/<?php echo $diagnosticData[0]->diagnostic_img; ?>" alt="" class="img-responsive" />
                                               <?php } else { ?>
                                                 <img src="<?php echo base_url()?>assets/images/noImage.png" alt="" class="img-responsive" />
                                               <?php } ?>
                                                <!-- description div -->
                                                <div class='pic-edit'>
                                                    <h3><a href="javascript:void(0)" class="pull-center cl-white" title="Edit Logo"><i class="fa fa-pencil"></i></a></h3>
                                                </div>
                                                <!-- end description div -->
                                            </div>

                                            <h3 class="text-white"> <?php echo $diagnosticData[0]->diagnostic_name;?> </h3>
                                            <h4> <?php if(isset($diagnosticData[0]->diagnostic_address)){ echo $diagnosticData[0]->diagnostic_address; }?> </h4>

                                        </div>

                                    </div>
                                    <!--/ meta -->

                                </aside>
                                <section class="clearfix hospitalBtn">
                                    <div class="col-md-12">
                                        <a href="#" class="pull-right cl-white" title="Edit Background"><i class="fa fa-pencil"></i></a>

                                    </div>

                                </section>
                                <!--
                                <article class="text-center clearfix m-t-50">
                                    <ul class="nav nav-tab nav-setting">
                                        <li class="active">
                                            <a data-toggle="tab" href="#general">General Detail</a>
                                        </li>
                                    </ul>
                                </article>
                                -->

                                <article class="tab-content p-b-20 m-t-50">

                                    <!-- General Detail Starts -->
                                     <div class="map_canvas"></div>
                                    
                                    <section class="tab-pane fade in active" id="general">

                                        <article class="detailbox">
                                            <div class="bg-white mi-form-section">

                                                <!-- Table Section End -->
                                                <aside class="clearfix m-t-20 setting">
                                                    <div class="col-md-8">
                                                        <h4>Diagnostic Details 
                                                         <a href="javascript:void(0)" id="edit" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                                        </h4>
                                                        <hr/>
                                                        <aside id="detail" style="display: <?php echo $detailShow;?>;">
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Diagnostic Name :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"> <?php echo $diagnosticData[0]->diagnostic_name;?> </p>
                                                            </article>
                                                            
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(isset($diagnosticData[0]->diagnostic_address)){ echo $diagnosticData[0]->diagnostic_address; }?> </p>
                                                            </article>

                                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <aside class="col-md-8 col-sm-8 text-right t-xs-left">
                                                                    <?php 
                                                                    $explode= explode('|',$diagnosticData[0]->diagnostic_phn); 
                                                                    for($i= 0; $i< count($explode)-1;$i++){?>
                                                                    <p>+<?php echo $explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    <!-- <p>+91-011-123456</p>
                                                                    <p>+91-011-123456</p>
                                                                    <p>+91-011-123456</p> -->
                                                                </aside>
                                                            </article>
                                                            
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Email Id :</label>
                                                                <p class="col-md-8  col-sm-8 text-right t-xs-left"> <?php echo $diagnosticData[0]->users_email;?> </p>
                                                            </article>
                                                            
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                                                <p class="col-md-8  col-sm-8 text-right t-xs-left"> <?php if(isset($diagnosticData[0]->diagnostic_cntPrsn)){ echo $diagnosticData[0]->diagnostic_cntPrsn; }?> </p>
                                                            </article>
                                                             
                                                        </aside>
                                                        <!--edit-->
                                                         <form name="diagnosticDetail" action="<?php echo site_url(); ?>/diagnostic/saveDetailDiagnostic/<?php echo $diagnosticId; ?>" id="diagnosticDetail" method="post">
                                                         <input type="hidden" id="StateId" name="StateId" value="<?php echo $diagnosticData[0]->diagnostic_stateId;?>" />
                                                          <input type="hidden" id="countryId" name="countryId" value="<?php echo $diagnosticData[0]->diagnostic_countryId;?>" />
                                                          <input type="hidden" id="cityId" name="cityId" value="<?php echo $diagnosticData[0]->diagnostic_cityId;?>" />
                                                        <aside id="newDetail" style="display:<?php echo $showStatus;?>;">
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Diagnostic Name :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="diagnostic_name" name="diagnostic_name" type="text" value="<?php echo $diagnosticData[0]->diagnostic_name;?>">
                                                                    <label class="error" > <?php echo form_error("diagnostic_name"); ?></label>
                                                                </div>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                            <div class="col-md-8 col-sm-8">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%" name="diagnostic_countryId" id="diagnostic_countryId">
                                                        <option>Select Country</option>
                                                        <?php foreach($allCountry as $key=>$val) {?>
                                                        <option value="<?php echo $val->country_id;?>" <?php if($val->country_id == $diagnosticData[0]->diagnostic_countryId){ echo 'selected';} ?>><?php echo $val->country;?></option>
                                                         <?php }?>
                                                        
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <select class="selectpicker" data-width="100%" name="diagnostic_stateId" id="diagnostic_stateId" onchange ="fetchCity(this.value)">
                                                        <option>Select State</option>
                                                        <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                </div>
                                            </aside>
                                            <aside class="row m-t-10">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%" name="diagnostic_cityId" id="diagnostic_cityId" data-size="4">
                                                        
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <input class="form-control" id="diagnostic_zip" name="diagnostic_zip" type="text" value="<?php echo $diagnosticData[0]->diagnostic_zip;?>">
                                                </div>
                                            </aside>
                                            <div class="clearfix m-t-10">
                                            <textarea class="form-control" id="geocomplete" name="diagnostic_address" type="text" ><?php if(isset($diagnosticData[0]->diagnostic_address)){ echo $diagnosticData[0]->diagnostic_address; }?></textarea>
                                                                    <label class="error" > <?php echo form_error("diagnostic_address"); ?></label>
                                        </div>
                                        </div>
                                                        </article>

                                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <?php 
                                                                    $explodes= explode('|',$diagnosticData[0]->diagnostic_phn); 
                                                                    for($i= 0; $i< count($explodes)-1;$i++){
                                                                    $moreExpolde = explode(' ',$explodes[$i]);?>
                                                                    
                                                                    
                                                                    <aside class="row">
                                                                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">
                                                                            <select class="selectpicker" data-width="100%" name="pre_number[]">
                                                                                <option value="91" <?php if($moreExpolde[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                                <option value="1" <?php if($moreExpolde[0] == '1'){ echo 'selected';}?>>+1</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-10 m-t-xs-10">
                                                                            <input type="text" class="form-control" name="diagnostic_phn[]" id="diagnostic_phn<?php echo $i;?>" placeholder="9837000123" value="<?php echo $moreExpolde[1];?>" maxlength="10" onblur="checkNumber(<?php echo $i;?>)"/>
                                                                        </div>
                                                                       
                                                                    </aside>
                                                                    <br />
                                                                    <?php $moreExpolde ='';}?>
                                                               
                                                                    <p class="m-t-10">* If it is landline, include Std code with number </p>
                                                                </div>
                                                            </article>
                                                            
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Email Id :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                 <input class="form-control" id="users_email" name="users_email" type="email" value="<?php echo $diagnosticData[0]->users_email;?>" onblur="checkEmailFormat()" />
                                                                  <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exists!</label>
                                                                <label class="error" > <?php echo form_error("users_email"); ?></label>
                                                                </div>
                                                            </article>
                                    
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                 
                                                                    <input class="form-control" id="diagnostic_cntPrsn" name="diagnostic_cntPrsn" type="text" value="<?php if(isset($diagnosticData[0]->diagnostic_cntPrsn)){ echo $diagnosticData[0]->diagnostic_cntPrsn; }?>">
                                                           <label class="error" > <?php echo form_error("diagnostic_cntPrsn"); ?></label>
                                                           </div>    
                                                            </article>
                                                           
                                                            
                                                             <article class="clearfix m-b-10">

                                                              <div class="col-md-12">
                                                              <button type="submit" class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="return validationDiagnostic();">Update</button>
                                                              </div>

                                                             </article>
                                                        </aside>
                                                             <fieldset>
                           
                                                                <input name="lat" type="hidden" value="<?php echo $diagnosticData[0]->diagnostic_lat;?>">

                                                               <!-- <label>Longitude</label> -->
                                                                <input name="lng" type="hidden" value="<?php echo $diagnosticData[0]->diagnostic_long;?>">
                                                                <input name="user_tables_id" id="user_tables_id" type="hidden" value="<?php echo $diagnosticData[0]->users_id;?>">
                                                             </fieldset>  
                                                        </form>  
                                                    </div>

                                                </aside>
                                            </div>
                                        </article>
                                    </section>       
                                   
                                </article>

                            </section>



                            <!-- Table Section End -->
                            <article class="clearfix">

                            </article>
                        </div>

                    </section>
                    <!-- Left Section End -->


                </div>

                <!-- container -->
            </div>
            <!-- content -->
            <footer class="footer text-right">
                2015 © Qyura.
            </footer>
        </div>
        <!-- End Right content here -->
    </div>
    <!-- END wrapper -->






    <script>
        var resizefunc = [];
    </script>
     <script src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js"> </script>
    <script src="<?php echo base_url();?>assets/js/framework.js"> </script>
        <script src="<?php echo base_url();?>assets/js/pages/blood-detail.js">
    </script>
     <script src="<?php echo base_url();?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="https://www.google.com/jsapi">
    </script>
    
   <!--<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>-->

    <script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
    <script>
         var urls = "<?php echo base_url()?>";
         var stateIds = $.trim($('#StateId').val());
        /* $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form",
          types: ["geocode", "establishment"],
        });

        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });


      });*/
        $(document).ready(function(){
            fetchStates();
            function fetchStates(){
            
            var countryId = $('#countryId').val();
            //var stateId = $('#StateId').val();
            
            $.ajax({
               url : urls + 'index.php/diagnostic/fetchStates',
               type: 'POST',
              data: {'stateId' : stateIds , 'countryId' : countryId},
              success:function(datas){
               // console.log(datas);
                  $('#diagnostic_stateId').html(datas);
                  $('#diagnostic_stateId').selectpicker('refresh');
                  fetchCityOnload();
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
              data: {'stateId' : stateIds , 'cityId' : cityId},
              success:function(datas){
               // console.log(datas);
                  $('#diagnostic_cityId').html(datas);
                  $('#diagnostic_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
        }) ;
      function fetchCity(stateId) {    
           
           $.ajax({
               url : urls + 'index.php/diagnostic/fetchCity',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
               // console.log(datas);
                  $('#diagnostic_cityId').html(datas);
                  $('#diagnostic_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
       function validationDiagnostic(){
           
       //$("form[name='bloodDetail']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#diagnostic_cntPrsn').val());
        
       
            if($.trim($('#diagnostic_name').val()) === ''){
                $('#diagnostic_name').addClass('bdr-error');
                
            }
          
            if($.trim($('#geocomplete').val()) === ''){
               $("#geocomplete").addClass('bdr-error');
               
            }
             if(!check.test(cpname)){
                $('#diagnostic_cntPrsn').addClass('bdr-error');
                
            }

            if( emails !== ''){
                check_email(emails);
            }
            
            return false;
            
            
        }
        function checkNumber(id){
            var phone = $.trim($('#'+'diagnostic_phn'+id).val());
            if(!($.isNumeric(phone))){
             $('#'+'diagnostic_phn'+id).addClass('bdr-error');
         }
        }
        function checkEmailFormat(){
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                var email = $('#users_email').val();
                if(email!==''){
                    if (!filter.test(email)){
                       $('#users_email').addClass('bdr-error');
                    }
            }
        } 
        
        function check_email(myEmail){
            var user_table_id = $('#user_tables_id').val();
           $.ajax({
               url : urls + 'index.php/diagnostic/check_email',
               type: 'POST',
              data: {'users_email' : myEmail,'user_table_id' : user_table_id },
              success:function(datas){
                 // console.log(datas);
                  if(datas == 0){
                   $("form[name='diagnosticDetail']").submit();
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
        
        
    </script>
</body>

</html>
