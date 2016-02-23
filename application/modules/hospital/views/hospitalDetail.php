<?php //print_r($pharmacyData);exit;?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?php echo base_url();?>assets/images/fevicon-m.ico" rel="shortcut icon">
    <title>Hospitals Details</title>
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
                            <h3 class="pull-left page-title">Hospital Detail</h3>
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
                                                <?php if(!empty($hospitalData[0]->hospital_img)){
                                                    ?>
                                               <img src="<?php echo base_url()?>assets/hospitalsImages/<?php echo $hospitalData[0]->hospital_img; ?>" alt="" class="img-responsive" />
                                               <?php } else { ?>
                                                 <img src="<?php echo base_url()?>assets/images/noImage.png" alt="" class="img-responsive" />
                                               <?php } ?>
                                                <!-- description div -->
                                                <div class='pic-edit'>
                                                    <h3><a href="javascript:void(0)" class="pull-center cl-white" title="Edit Logo"><i class="fa fa-pencil"></i></a></h3>
                                                </div>
                                                <!-- end description div -->
                                            </div>

                                            <h3 class="text-white"> <?php echo $hospitalData[0]->hospital_name;?> </h3>
                                            <h4> <?php if(isset($hospitalData[0]->hospital_address)){ echo $hospitalData[0]->hospital_address; }?> </h4>

                                        </div>

                                    </div>
                                    <!--/ meta -->

                                </aside>
                                <section class="clearfix hospitalBtn">
                                    <div class="col-md-12">
                                        <a href="#" class="pull-right cl-white" title="Edit Background"><i class="fa fa-pencil"></i></a>

                                    </div>

                                </section>
                                
                                <article class="text-center clearfix m-t-50">
                                    <ul class="nav nav-tab nav-setting">
                                        <li class="active">
                                            <a data-toggle="tab" href="#general">General Detail</a>
                                        </li>
                                        
                                        <li class=" ">
                                            <a data-toggle="tab" href="#diagnostic">Diagnostics</a>
                                        </li>
                                        <li class=" ">
                                            <a data-toggle="tab" href="#specialities">Specialities</a>
                                        </li>
                                        <li class=" ">
                                            <a data-toggle="tab" href="#gallery">Gallery</a>
                                        </li>
                                        <li class=" ">
                                            <a data-toggle="tab" href="#timeslot">Time Slot</a>
                                        </li>
                                       <li class=" ">
                                            <a data-toggle="tab" href="#doctor">All Doctors</a>
                                        </li>
                                        
                                        <li class=" ">
                                            <a data-toggle="tab" href="#account">Account</a>
                                        </li>

                                    </ul>
                                </article>

                                <article class="tab-content p-b-20 m-t-50">

                                    <!-- General Detail Starts -->
                                     <div class="map_canvas"></div>
                                    
                                    <section class="tab-pane fade in active" id="general">

                                        <article class="detailbox">
                                            <div class="bg-white mi-form-section">

                                                <!-- Table Section End -->
                                                <aside class="clearfix m-t-20 setting">
                                                    <div class="col-md-8">
                                                        <h4>Hospital Details 
                                                         <a href="javascript:void(0)" id="edit" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                                        </h4>
                                                        <hr/>
                                                        <aside id="detail" style="display: <?php echo $detailShow;?>;">
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Hospital Name :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"> <?php echo $hospitalData[0]->hospital_name;?> </p>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Hospital Type :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">
                                                                    <?php if($hospitalData[0]->hospital_type == 1)
                                                                            echo "Trauma Centres";
                                                                            else if($hospitalData[0]->hospital_type == 2)
                                                                            echo "Rehabilitation Hospitals";
                                                                            else
                                                                            echo "Children's Hospitals";    
                                                                        ?>
                                                                </p>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(isset($hospitalData[0]->hospital_address)){ echo $hospitalData[0]->hospital_address; }?> </p>
                                                            </article>

                                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <aside class="col-md-8 col-sm-8 text-right t-xs-left">
                                                                    <?php 
                                                                    $explode= explode('|',$hospitalData[0]->hospital_phn); 
                                                                    for($i= 0; $i< count($explode)-1;$i++){?>
                                                                    <p>+<?php echo $explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    <!-- <p>+91-011-123456</p>
                                                                    <p>+91-011-123456</p>
                                                                    <p>+91-011-123456</p> -->
                                                                </aside>
                                                            </article>
                                                            <?php if(isset($hospitalData[0]->bloodBank_name)){?>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Blood Bank :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">Available</p>
                                                            </article>
                                                             <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php echo $hospitalData[0]->bloodBank_name;?></p>
                                                            </article>
                                                            
                                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <aside class="col-md-8 col-sm-8 t-xs-left">
                                                                    <?php 
                                                                    $bloodBank_explode= explode('|',$hospitalData[0]->bloodBank_phn); 
                                                                    for($i= 0; $i< count($bloodBank_explode)-1;$i++){?>
                                                                    <p>+<?php echo $bloodBank_explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    <!--<p>+91-011-123456</p>-->
                                                                </aside>
                                                            <?php }?>
                                                            </article>
                                                            <?php if(isset($hospitalData[0]->pharmacy_name)){?>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Pharmacy :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">Available</p>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php echo $hospitalData[0]->pharmacy_name;?></p>
                                                            </article>
                                                            
                                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <aside class="col-md-8 col-sm-8 t-xs-left">
                                                                    <?php 
                                                                    $pharmacy_explode= explode('|',$hospitalData[0]->pharmacy_phn); 
                                                                    for($i= 0; $i< count($pharmacy_explode)-1;$i++){?>
                                                                    <p>+<?php echo $pharmacy_explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                  <!-- <p>+<?php echo $hospitalData[0]->pharmacy_phn;?></p>-->
                                                                </aside>
                                                            </article>
                                                            <?php }?>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">24x7 Emergency :</label>
                                                                <?php if($hospitalData[0]->isEmergency == 1){?>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">Available</p>
                                                                <?php } else {?>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">Not Available</p>
                                                                 <?php }?>
                                                            </article>
                                                            <!--<article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Email Id :</label>
                                                                <p class="col-md-8  col-sm-8 text-right t-xs-left"> <?php echo $hospitalData[0]->users_email;?> </p>
                                                            </article>-->
                                                            
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                                                <p class="col-md-8  col-sm-8 text-right t-xs-left"> <?php if(isset($hospitalData[0]->hospital_cntPrsn)){ echo $hospitalData[0]->hospital_cntPrsn; }?> </p>
                                                            </article>
                                                             <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Designation:</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(isset($hospitalData[0]->hospital_dsgn)){ echo $hospitalData[0]->hospital_dsgn; }?></p>
                                                            </article> 
                                                        </aside>
                                                        <!--edit-->
                                                         <form name="hospitalDetail" action="<?php echo site_url(); ?>/hospital/saveDetailHospital/<?php echo $hospitalId; ?>" id="hospitalDetail" method="post">
                                                         <input type="hidden" id="StateId" name="StateId" value="<?php echo $hospitalData[0]->hospital_stateId;?>" />
                                                          <input type="hidden" id="countryId" name="countryId" value="<?php echo $hospitalData[0]->hospital_countryId;?>" />
                                                          <input type="hidden" id="cityId" name="cityId" value="<?php echo $hospitalData[0]->hospital_cityId;?>" />
                                                        <aside id="newDetail" style="display:<?php echo $showStatus;?>;">
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Hospital Name :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="hospital_name" name="hospital_name" type="text" value="<?php echo $hospitalData[0]->hospital_name;?>">
                                                                    <label class="error" > <?php echo form_error("hospital_name"); ?></label>
                                                                </div>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cname" class="control-label col-md-4  col-sm-4">Hospital Type :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <select class="selectpicker" data-width="100%" name="hospital_type" id="hospital_type" tabindex="-98">
                                                                        <option value="1" <?php if($hospitalData[0]->hospital_type == 1){ echo 'selected';}?>> Trauma Centres</option>
                                                                        <option value="2" <?php if($hospitalData[0]->hospital_type == 2){ echo 'selected';}?>>Rehabilitation Hospitals</option>
                                                                        <option value="3" <?php if($hospitalData[0]->hospital_type == 3){ echo 'selected';}?>>Children's Hospitals</option>
                                                                    </select>
                                                                </div>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                            <div class="col-md-8 col-sm-8">
                                                    <!-- <aside class="row">
                                                         <div class="col-md-6 col-sm-6">
                                                             <select class="selectpicker" data-width="100%" name="hospital_countryId" id="hospital_countryId">
                                                                 <option>Select Country</option>
                                                                 <?php foreach($allCountry as $key=>$val) {?>
                                                                 <option value="<?php echo $val->country_id;?>" <?php if($val->country_id == $hospitalData[0]->hospital_countryId){ echo 'selected';} ?>><?php echo $val->country;?></option>
                                                                  <?php }?>

                                                             </select>
                                                         </div>
                                                         <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                             <select class="selectpicker" data-width="100%" name="hospital_stateId" id="hospital_stateId" onchange ="fetchCity(this.value)">
                                                                 <option>Select State</option>
                                                                 <?php foreach($allStates as $key=>$val) {?>
                                                                 <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                                  <?php }?>
                                                             </select>
                                                         </div>
                                                     </aside> -->
                                                     <!-- <aside class="row m-t-10">
                                                         <div class="col-md-6 col-sm-6">
                                                             <select class="selectpicker" data-width="100%" name="hospital_cityId" id="hospital_cityId" data-size="4">

                                                             </select>
                                                         </div>
                                                         <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                             <input class="form-control" id="hospital_zip" name="hospital_zip" type="text" value="<?php echo $hospitalData[0]->hospital_zip;?>">
                                                         </div>
                                                     </aside> -->
                                            <div class="clearfix m-t-10">
                                                <textarea class="form-control" id="geocomplete" name="hospital_address" type="text" ><?php if(isset($hospitalData[0]->hospital_address)){ echo $hospitalData[0]->hospital_address; }?></textarea>
                                               <label class="error" > <?php echo form_error("hospital_address"); ?></label>
                                            </div>
                                        </div>
                                                        </article>

                                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <?php 
                                                                    $explodes= explode('|',$hospitalData[0]->hospital_phn); 
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
                                                                            <input type="text" class="form-control" name="hospital_phn[]" id="hospital_phn<?php echo ($i+1);?>" placeholder="9837000123" value="<?php echo $moreExpolde[1];?>" maxlength="10" onblur="checkNumber(<?php echo $i;?>)"/>
                                                                        </div>
                                                                       
                                                                    </aside>
                                                                    <br />
                                                                    <?php $moreExpolde ='';}?>
                                                               
                                                                    <p class="m-t-10">* If it is landline, include Std code with number </p>
                                                                </div>
                                                            </article>
                                                            <article class="clearfix">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">Bloodbank Availablity </label>
                                                                        <div class="col-md-8 col-xs-3">
                                                                            <aside class="checkbox checkbox-success m-t-5">
                                                                                <input type="checkbox" id="bloodbankbtn" name="bloodbank_chk" value="1">
                                                                                <label>

                                                                                </label>
                                                                            </aside>
                                                                        </div>
                                                                    </article>
                                                                    
                                                                    <section id="bloodbankdetail" style="display:none">
                                                                
                                                                        <article class="clearfix m-b-10">
                                                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                       <div class="col-md-8 col-sm-8">
                                                                           <input class="form-control" name="bloodBank_name" id="bloodBank_name" type="text" value="<?php if(isset($hospitalData[0]->bloodBank_name)){ echo $hospitalData[0]->bloodBank_name; } ?>">
                                                                           <div>
                                                                   </article>
                                                                       <article class="clearfix m-b-10 ">
                                                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                       <div class="col-md-8 col-sm-8">
                                                                            <?php 
                                                                            if($hospitalData[0]->bloodBank_phn != ''){
                                                                                $explodes_bloodbank= explode('|',$hospitalData[0]->bloodBank_phn); 
                                                                                for($i= 0; $i< count($explodes_bloodbank)-1;$i++){
                                                                                $more_bloodbank = explode(' ',$explodes_bloodbank[$i]);?>
                                                                           <aside class="row">
                                                                               <div class="col-md-3 col-sm-3 col-xs-12">
                                                                                   <select class="selectpicker" data-width="100%" name="preblbankNo[]" id="preblbankNo<?php echo ($i+1);?>">
                                                                                    <option value="91" <?php if($more_bloodbank[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                                    <option value="1" <?php if($more_bloodbank[0] == '1'){ echo 'selected';}?>>+1</option>
                                                                                   </select>
                                                                               </div>
                                                                               <div class="col-md-9 col-sm-9 col-xs-10 m-t-xs-10">
                                                                                   <input type="teL" class="form-control" name="bloodBank_phn[]" id="bloodBank_phn<?php echo ($i+1);?>" value ="<?php echo $more_bloodbank[1]; ?>" placeholder="9837000123" onkeypress="return isNumberKey(event)" />
                                                                               </div>

                                                                           </aside>
                                                                            <?php $more_bloodbank = ''; } } else {?>
                                                                                <aside class="row">
                                                                               <div class="col-md-3 col-sm-3 col-xs-12">
                                                                                   <select class="selectpicker" data-width="100%" name="preblbankNo[]" id="preblbankNo1">
                                                                                    <option value="91" >+91</option>
                                                                                    <option value="1" >+1</option>
                                                                                   </select>
                                                                               </div>
                                                                               <div class="col-md-9 col-sm-9 col-xs-10 m-t-xs-10">
                                                                                   <input type="teL" class="form-control" name="bloodBank_phn[]" id="bloodBank_phn1" value ="" placeholder="9837000123" onkeypress="return isNumberKey(event)" />
                                                                               </div>

                                                                           </aside>
                                                                            <?php } ?>
                                                                       </div>
                                                                   </article>
                                                                  </section>
                                                          <!--  <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Email Id :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                 <input class="form-control" id="users_email" name="users_email" type="email" value="<?php echo $hospitalData[0]->users_email;?>" onblur="checkEmailFormat()" />
                                                                  <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exists!</label>
                                                                <label class="error" > <?php echo form_error("users_email"); ?></label>
                                                                </div>
                                                            </article> -->
                                                           <article class="clearfix">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">Pharmacy Availablity </label>
                                                                        <div class="col-md-8 col-xs-3">
                                                                            <aside class="checkbox checkbox-success m-t-5">
                                                                                <input type="checkbox" id="pharmacybtn" name="pharmacy_chk" value="1">
                                                                                <label>

                                                                                </label>
                                                                            </aside>
                                                                        </div>
                                                                    </article>
                                                                     
                                                          <section id="pharmacydetail" style="display:none">
                                                                
                                                                 <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="pharmacy_name" name="pharmacy_name" type="text" value="<?php if(isset($hospitalData[0]->pharmacy_name)){ echo $hospitalData[0]->pharmacy_name; } ?>" >
                                                                    <div>
                                                            </article>
                                                                 
                                                                <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <?php 
                                                                    if($hospitalData[0]->pharmacy_phn != ''){
                                                                    $explodesPharmacy= explode('|',$hospitalData[0]->pharmacy_phn); 
                                                                    for($i= 0; $i< count($explodesPharmacy)-1;$i++){
                                                                    $morePharmacy = explode(' ',$explodesPharmacy[$i]);?>
                                                                    <aside class="row">
                                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                                            <select class="selectpicker" data-width="100%" name="prePharmacy[]" id="prePharmacy<?php echo ($i+1);?>">
                                                                                <option value="91" <?php if($morePharmacy[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                                    <option value="1" <?php if($morePharmacy[0] == '1'){ echo 'selected';}?>>+1</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-9 col-sm-9 col-xs-10 m-t-xs-10">
                                                                            <input type="teL" class="form-control" name="pharmacy_phn[]" id="pharmacy_phn<?php echo ($i+1);?>" value ="<?php echo $morePharmacy[1]; ?>" placeholder="9837000123" onkeypress="return isNumberKey(event)" />
                                                                        </div>

                                                                    </aside>
                                                                    <?php $morePharmacy = '';} } else { ?>
                                                                    <aside class="row">
                                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                                            <select class="selectpicker" data-width="100%" name="prePharmacy[]" id="prePharmacy1">
                                                                                <option value="91">+91</option>
                                                                                    <option value="1">+1</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-9 col-sm-9 col-xs-10 m-t-xs-10">
                                                                            <input type="teL" class="form-control" name="pharmacy_phn[]" id="pharmacy_phn1" placeholder="9837000123" onkeypress="return isNumberKey(event)" />
                                                                        </div>

                                                                    </aside>
                                                                    <?php }?>
                                                                </div>
                                                            </article>
                                                           </section>
                                    
                                                            
                                                           <article class="clearfix">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">24x7 Emergency </label>
                                                                        <div class="col-md-8 col-xs-3">
                                                                            <aside class="checkbox checkbox-success m-t-5">
                                                                                <input type="checkbox" id="isEmergency" name="isEmergency" value="1" <?php if($hospitalData[0]->isEmergency == 1){ echo "checked";}?> />
                                                                                <label>

                                                                                </label>
                                                                            </aside>
                                                                        </div>
                                                    </article>
                                                               
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                 
                                                                    <input class="form-control" id="hospital_cntPrsn" name="hospital_cntPrsn" type="text" value="<?php if(isset($hospitalData[0]->hospital_cntPrsn)){ echo $hospitalData[0]->hospital_cntPrsn; }?>">
                                                           <label class="error" > <?php echo form_error("hospital_cntPrsn"); ?></label>
                                                           </div>    
                                                            </article>
                                                          <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Designation :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="hospital_dsgn" name="hospital_dsgn" type="text" value="<?php if(isset($hospitalData[0]->hospital_dsgn)){ echo $hospitalData[0]->hospital_dsgn; }?>">
                                                                    <label class="error" > <?php echo form_error("hospital_dsgn"); ?></label>
                                                                    <div>
                                                            </article>
                                                          
                                                           
                                                            <article class="clearfix m-b-10">

                                                              <div class="col-md-12">
                                                              <button type="submit" class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="return validationHospital();">Update</button>
                                                              </div>

                                                             </article>
                                                        </aside>
                                                             <fieldset>
                           
                                                                <input name="lat" type="hidden" value="<?php echo $hospitalData[0]->hospital_lat;?>">

                                                               <!-- <label>Longitude</label> -->
                                                                <input name="lng" type="hidden" value="<?php echo $hospitalData[0]->hospital_long;?>">
                                                                <input name="user_tables_id" id="user_tables_id" type="hidden" value="<?php echo $hospitalData[0]->users_id;?>">
                                                            <?php if($hospitalData[0]->pharmacy_phn != '' OR $hospitalData[0]->pharmacy_name != ''){ ?>
                                                                <input name="pharmacy_status" id="pharmacy_status" type="hidden" value="<?php echo $hospitalData[0]->pharmacy_name;?>">
                                                            <?php } ?>
                                                               <?php if($hospitalData[0]->bloodBank_name != '' OR $hospitalData[0]->bloodBank_phn != ''){ ?>
                                                                <input name="bloodbank_status" id="bloodbank_status" type="hidden" value="<?php echo $hospitalData[0]->bloodBank_name;?>">
                                                            <?php } ?>  
                                                             </fieldset>  
                                                        </form>  
                                                    </div>

                                                </aside>
                                            </div>
                                        </article>
                                    </section>  
                                  
                                    <!--diagnostic Starts -->
                                    <section class="tab-pane fade in" id="diagnostic"  ng-app="myApp">
                                        <!-- first Section Start -->
                                        <aside class="clearfix">
                                            <section class="col-md-3 detailbox m-b-20 diag" ng-controller="diag-c-avail">
                                                <aside class="bg-white">
                                                    <figure class="clearfix">

                                                        <h3>Diagnostic Categories Available</h3>
                                                        

                                                        <article class="clearfix">

                                                            <div class="input-group m-b-5">
                                                                <span class="input-group-btn">
                                                        <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                                        </span>
                                                                <input type="text" placeholder="Search" class="form-control" name="example-input1-group2" id="example-input1-group2" ng-model="test">
                                                            </div>
                                                        </article>
                                                    </figure>
                                                    <div class="nicescroll mx-h-300">
                                                        <div class="clearfix diag-detail">
                                                            <ul>
                                                                <li ng-repeat="x in names | filter:test">
                                                                    {{ x }}
                                                                </li>
                                                            </ul>


                                                        </div>
                                                    </div>
                                                </aside>
                                            </section>




                                            <!-- first Section End -->


                                            <section class="col-md-1 detailbox m-b-20 text-center">
                                                <div class="m-t-150">
                                                    <a href="#"><i class="fa fa-arrow-right s-add"></i></a>
                                                </div>
                                                <div class="m-t-50">

                                                    <a href="#"> <i class="fa fa-arrow-left s-add"></i></a>
                                                </div>

                                            </section>
                                            <!-- second Section Start -->
                                            <section class="col-md-3 detailbox m-b-20 diag" ng-controller="diag-c-avail">
                                                <aside class="bg-white">
                                                    <figure class="clearfix">

                                                        <h3>Diagnostic Categories Added</h3>

                                                        <article class="clearfix">

                                                            <div class="input-group m-b-5">
                                                                <span class="input-group-btn">
                                                        <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                                        </span>
                                                                <input type="text" placeholder="Search" class="form-control" name="example-input1-group2" id="example-input1-group2" ng-model="test">
                                                            </div>
                                                        </article>
                                                    </figure>
                                                    <div class="nicescroll mx-h-300">
                                                        <div class="clearfix diag-detail">
                                                            <ul>
                                                                <li ng-repeat="x in names | filter:test">
                                                                    {{ x }}
                                                                </li>
                                                            </ul>


                                                        </div>
                                                    </div>
                                                </aside>
                                            </section>
                                            <!-- second Section End -->





                                            <!-- third Section Start -->
                                            <section class="col-md-5 detailbox m-b-20 diag" ng-app="myApp" ng-controller="diag-c-avail">
                                                <aside class="bg-white">
                                                    <figure class="clearfix">

                                                        <h3>Diagnostic Categories Available</h3>

                                                        <article class="clearfix">

                                                            <div class="input-group m-b-5">
                                                                <span class="input-group-btn">
                                                        <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                                        </span>
                                                                <input type="text" placeholder="Search" class="form-control" name="example-input1-group2" id="example-input1-group2" ng-model="test">
                                                            </div>
                                                        </article>
                                                    </figure>
                                                    <div class="nicescroll mx-h-300">
                                                        <div class="clearfix diag-detail">
                                                            <ul>
                                                                <li ng-repeat="x in names | filter:test">
                                                                    {{ x }}
                                                                </li>
                                                            </ul>


                                                        </div>
                                                    </div>
                                                </aside>
                                            </section>
                                            <!-- third Section End -->
                                        </aside>

                                        <section class="clearfix detailbox m-b-20">
                                            <div class="col-md-8" ng-app="myApp" ng-controller="diag-c-avail">
                                                <figure class="clearfix">
                                                    <h3>Diagnostic Test Pricing Setup</h3>
                                                    <article class="clearfix">

                                                        <div class="input-group m-b-5">
                                                            <span class="input-group-btn">
                                                        <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                                        </span>
                                                            <input type="text" placeholder="Search" class="form-control" name="example-input1-group2" id="example-input1-group2">
                                                        </div>
                                                    </article>
                                                </figure>


                                                <aside class="table-responsive">
                                                    <table class="table">

                                                        <col style="width:70%">
                                                            <col style="width:20%">
                                                                <col style="width:10%">
                                                                    <tbody>

                                                                        <tr class="border-a-dull">
                                                                            <th>Test Name</th>
                                                                            <th>Price</th>
                                                                            <th>Action</th>

                                                                        </tr>
                                                                    </tbody>
                                                    </table>


                                                    <article class="nicescroll mx-h-300">
                                                        <table class="table">

                                                            <col style="width:70%">
                                                                <col style="width:20%">
                                                                    <col style="width:10%">
                                                                        <tbody>
                                                                            <tr>

                                                                                <td>
                                                                                    Cmplete Blood Count(CBC)
                                                                                </td>
                                                                                <td>
                                                                                    <i class="fa fa-inr"></i> <a data-title="Enter username" data-pk="1" data-type="text" id="username" href="#" class="editable editable-click " data-original-title="" title="Edit Price">1200</a>
                                                                                </td>
                                                                                <td>

                                                                                    <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>

                                                                                </td>
                                                                            </tr>

                                                                            <tr>

                                                                                <td>
                                                                                    Blood Chemistry Test
                                                                                </td>
                                                                                <td>
                                                                                    <i class="fa fa-inr"></i> 1200
                                                                                </td>
                                                                                <td>

                                                                                    <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>

                                                                                </td>
                                                                            </tr>

                                                                            <tr>

                                                                                <td>
                                                                                    Cmplete Blood Count(CBC)
                                                                                </td>
                                                                                <td>
                                                                                    <i class="fa fa-inr"></i> 1200
                                                                                </td>
                                                                                <td>

                                                                                    <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>

                                                                                </td>
                                                                            </tr>

                                                                            <tr>

                                                                                <td>
                                                                                    Blood Chemistry Test
                                                                                </td>
                                                                                <td>
                                                                                    <i class="fa fa-inr"></i> 1200
                                                                                </td>
                                                                                <td>

                                                                                    <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>

                                                                                <td>
                                                                                    Cmplete Blood Count(CBC)
                                                                                </td>
                                                                                <td>
                                                                                    <i class="fa fa-inr"></i> 1200
                                                                                </td>
                                                                                <td>

                                                                                    <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>

                                                                                </td>
                                                                            </tr>

                                                                            <tr>

                                                                                <td>
                                                                                    Blood Chemistry Test
                                                                                </td>
                                                                                <td>
                                                                                    <i class="fa fa-inr"></i> 1200
                                                                                </td>
                                                                                <td>

                                                                                    <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>

                                                                                <td>
                                                                                    Cmplete Blood Count(CBC)
                                                                                </td>
                                                                                <td>
                                                                                    <i class="fa fa-inr"></i> 1200
                                                                                </td>
                                                                                <td>

                                                                                    <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>

                                                                                </td>
                                                                            </tr>

                                                                            <tr>

                                                                                <td>
                                                                                    Blood Chemistry Test
                                                                                </td>
                                                                                <td>
                                                                                    <i class="fa fa-inr"></i> 1200
                                                                                </td>
                                                                                <td>

                                                                                    <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>

                                                                                <td>
                                                                                    Cmplete Blood Count(CBC)
                                                                                </td>
                                                                                <td>
                                                                                    <i class="fa fa-inr"></i> 1200
                                                                                </td>
                                                                                <td>

                                                                                    <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>

                                                                                </td>
                                                                            </tr>

                                                                            <tr>

                                                                                <td>
                                                                                    Blood Chemistry Test
                                                                                </td>
                                                                                <td>
                                                                                    <i class="fa fa-inr"></i> 1200
                                                                                </td>
                                                                                <td>

                                                                                    <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>

                                                                                </td>
                                                                            </tr>




                                                                        </tbody>
                                                        </table>
                                                    </article>
                                                </aside>

                                            </div>

                                            <div class="col-md-4">

                                                <figure class="clearfix">
                                                    <h3 class="pull-left ">Test Preparation Instruction</h3>
                                                </figure>

                                                <aside class="clearfix mx-h-400">

                                                    <article class="nicescroll">
                                                        <p class="p-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.


                                                        </p>

                                                        <aside class="clearfix p-5">
                                                            <a href="#" class="btn btn-success waves-effect waves-light m-b-5 p-abs " data-toggle="modal" data-target="#myModal">Edit</a>

                                                        </aside>

                                                    </article>
                                                </aside>

                                            </div>

                                        </section>

                                    </section>
                                    <!-- diagnostic Ends --> 
                                    
                                     <!--Specialities Starts -->
                                    <section class="tab-pane fade in" id="specialities">
                                        <aside class="clearfix">
                                            
                                            <section class="col-md-5 detailbox m-b-20 diag" ng-app="myApp"  ng-controller="diag-c-avail">
                                                <aside class="bg-white">
                                                    <figure class="clearfix">

                                                          <h3>Specialities Available</h3>
                                                        

                                                        <article class="clearfix">

                                                            <div class="input-group m-b-5">
                                                                <span class="input-group-btn">
                                                        <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                                        </span>
                                                                <input type="text" placeholder="Search" class="form-control" name="example-input1-group2" id="example-input1-group2" ng-model="test">
                                                            </div>
                                                        </article>
                                                    </figure>
                                                    <div class="nicescroll mx-h-300">
                                                        <div class="clearfix diag-detail">
                                                            <ul>
                                                                <li ng-repeat="x in names | filter:test">
                                                                    {{ x }}
                                                                </li>
                                                            </ul>


                                                        </div>
                                                    </div>
                                                </aside>
                                            </section>

                                            <!-- first Section End -->


                                            <section class="col-md-2 detailbox m-b-20 text-center">
                                                <div class="m-t-150">
                                                    <a href="#"><i class="fa fa-arrow-right s-add"></i></a>
                                                </div>
                                                <div class="m-t-50">

                                                    <a href="#"> <i class="fa fa-arrow-left s-add"></i></a>
                                                </div>

                                            </section>
                                            <!-- second Section Start -->
                                            
                                            <section class="col-md-5 detailbox m-b-20 diag" ng-app="myApp" ng-controller="diag-c-avail">
                                                <aside class="bg-white">
                                                    <figure class="clearfix">

                                                          <h3>Specialities Added</h3>
                                                        

                                                        <article class="clearfix">

                                                            <div class="input-group m-b-5">
                                                                <span class="input-group-btn">
                                                        <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                                        </span>
                                                                <input type="text" placeholder="Search" class="form-control" name="example-input1-group2" id="example-input1-group2" ng-model="test">
                                                            </div>
                                                        </article>
                                                    </figure>
                                                    <div class="nicescroll mx-h-300">
                                                        <div class="clearfix diag-detail">
                                                            <ul>
                                                                <li ng-repeat="x in names | filter:test">
                                                                    {{ x }}
                                                                </li>
                                                            </ul>


                                                        </div>
                                                    </div>
                                                </aside>
                                            </section>
                                            <!-- second Section End -->

                                        </aside>
                                    </section>
                                    <!-- Specialities Ends -->
                                    <!--Gllery Starts -->
                                    <section class="tab-pane fade in" id="gallery">
                                       
                                        <div class="clearfix">
 
    
                                             <div class="clearfix">
      			
                                                            <div class="col-12 col-md-3 col-sm-3">
                                                                            <a title="Image 1" href="#"> 
                                                                                    <img class="thumbnail img-responsive" id="image-1" src="assets/images/hospital/h1.jpg">
                                                                            </a>
                                                                    </div>

                                                                    <div class="col-12 col-md-3 col-sm-3">
                                                                            <a title="Image 2" href="#"> 
                                                                                    <img class="thumbnail img-responsive" id="image-2" src="assets/images/hospital/h2.jpg">
                                                                            </a>

                                                                    </div>
                                                                    <div class="col-12 col-md-3 col-sm-3">
                                                                            <a title="Image 3" href="#"> 
                                                                                    <img class="thumbnail img-responsive" id="image-3" src="assets/images/hospital/h3.jpg" />
                                                                            </a>
                                                                    </div>
                                                  <div class="col-12 col-md-3 col-sm-3">
                                                                            <a title="Image 3" href="#"> 
                                                                                    <img class="thumbnail img-responsive" id="image-3" src="assets/images/hospital/h3.jpg" />
                                                                            </a>
                                                                    </div>
                                        </div>

                                        <hr>

                                      </div>

                                    <div class="hidden" id="img-repo">

                                            <!-- #image-1 -->
                                            <div class="item" id="image-1">
                                                    <img class="thumbnail img-responsive" title="Image 11" src="http://dummyimage.com/600x350/ccc/969696">
                                            </div>
                                            <div class="item" id="image-1">
                                                    <img class="thumbnail img-responsive" title="Image 12" src="http://dummyimage.com/600x600/ccc/969696">
                                            </div>
                                            <div class="item" id="image-1">
                                                    <img class="thumbnail img-responsive" title="Image 13" src="http://dummyimage.com/300x300/ccc/969696">
                                            </div>

                                            <!-- #image-2 -->
                                            <div class="item" id="image-2">
                                                    <img class="thumbnail img-responsive" title="Image 21" src="http://dummyimage.com/600x350/2255EE/969696">
                                            </div>
                                            <div class="item" id="image-2">
                                                    <img class="thumbnail img-responsive" title="Image 21" src="http://dummyimage.com/600x600/2255EE/969696">
                                            </div>
                                            <div class="item" id="image-2">
                                                    <img class="thumbnail img-responsive" title="Image 23" src="http://dummyimage.com/300x300/2255EE/969696">
                                            </div>   

                                            <!-- #image-3-->
                                            <div class="item" id="image-3">
                                                    <img class="thumbnail img-responsive" title="Image 31" src="http://dummyimage.com/600x350/449955/FFF">
                                            </div>
                                            <div class="item" id="image-3">
                                                    <img class="thumbnail img-responsive" title="Image 32" src="http://dummyimage.com/600x600/449955/FFF">
                                            </div>
                                            <div class="item" id="image-3">
                                                    <img class="thumbnail img-responsive" title="Image 33" src="http://dummyimage.com/300x300/449955/FFF">
                                            </div>        

                                    </div>

                                    </section>
                                    <!--Gallery Ends -->
                                    
                                    <!-- Timeslot start -->
                                    <section class="tab-pane fade in" id="timeslot">
                                        <div class="col-md-10 p-b-20">
                                            <form class="form-horizontal">
                                                <article class="clearfix">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">24/7 Services :</label>
                                                </article>
                                                <aside id="session">
                                                    <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Morning Session:</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="08:30 AM" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="12:30 PM" />
                                                            </div>
                                                        </div>
                                                    </article>

                                                    <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Afternoon Session :</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="12:30 PM" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="05:00 PM" />
                                                            </div>
                                                        </div>
                                                    </article>

                                                    <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Evening Session :</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="05:00 PM" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="09:30 PM" />
                                                            </div>
                                                        </div>
                                                    </article>
                                                </aside>
                                                <article class="clearfix ">
                                                    <div class="col-md-12 m-t-20 m-b-20">
                                                        <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                                                        <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit">Submit</button>
                                                    </div>
                                                </article>
                                            </form>
                                        </div>
                                    </section>
                                    <!-- Timeslot Ends -->
                                    
                                     <!--All Doctors Starts -->
                                   <section class="tab-pane fade in" id="doctor">

                                    <article class="clearfix m-top-40 p-b-20">
                           <aside class="table-responsive">
                              <table class="table all-doctor">
                                 <tbody>
                                    <tr class="border-a-dull">
                                       <th>Photo</th>
                                       <th>Name and Id</th>
                                       <th>Speciality</th>
                                       <th>Experience</th>
                                       <th>Date of Joining</th>
                                       <th>Phone</th>
                                       <th>Action</th>
                                    </tr>
                                    <tr>
                                       <td>
                                          <i class="fa fa-check-circle doc-online"></i>
                                          <h6><img src="assets/images/doctor/doc-1.jpg" alt="" class="img-responsive" /></h6>
                                       </td>
                                       <td>
                                          <h6>Alpesh Dhakad</h6>
                                          <p>ACH089</p>
                                       </td>
                                       <td>
                                          <h6>Surgury</h6>
                                       </td>
                                       <td>
                                          <h6>20 Years</h6>
                                       </td>
                                       <td>
                                          <h6>15 Nov, 2014</h6>
                                       </td>
                                       <td>
                                          <h6>9826000777</h6>
                                          <h6>0731-2349999</h6>
                                       </td>
                                       <td>
                                          <h6><a href="doctor-profile.html" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Detail</a></h6>
                                          <a href="edit-doctor.html" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Edit Detail</a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <i class="fa fa-check-circle doc-online"></i>
                                          <h6><img src="assets/images/doctor/doc-2.jpg" alt="" class="img-responsive" /></h6>
                                       </td>
                                       <td>
                                          <h6>Dr. Manoj Kumar</h6>
                                          <p>ACH089</p>
                                       </td>
                                       <td>
                                          <h6>Cardiology</h6>
                                       </td>
                                       <td>
                                          <h6>15 Years</h6>
                                       </td>
                                       <td>
                                          <h6>15 Jan, 2013</h6>
                                       </td>
                                       <td>
                                          <h6>9826000777</h6>
                                          <h6>0731-2349999</h6>
                                       </td>
                                       <td>
                                          <h6><a href="doctor-profile.html" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Detail</a></h6>
                                          <a href="edit-doctor.html" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Edit Detail</a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <i class="fa fa-check-circle doc-online"></i>
                                          <h6><img src="assets/images/doctor/doc-3.jpg" alt="" class="img-responsive" /></h6>
                                       </td>
                                       <td>
                                          <h6>Dr. Prabha Jha</h6>
                                          <p>ACH089</p>
                                       </td>
                                       <td>
                                          <h6>Eye Specialist</h6>
                                       </td>
                                       <td>
                                          <h6>10 Years</h6>
                                       </td>
                                       <td>
                                          <h6>15 Jan, 2013</h6>
                                       </td>
                                       <td>
                                          <h6>9826000777</h6>
                                          <h6>0731-2349999</h6>
                                       </td>
                                       <td>
                                          <h6><a href="doctor-profile.html" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Detail</a></h6>
                                          <a href="edit-doctor.html" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Edit Detail</a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <i class="fa fa-check-circle doc-online"></i>
                                          <h6><img src="assets/images/doctor/doc-1.jpg" alt="" class="img-responsive" /></h6>
                                       </td>
                                       <td>
                                          <h6>Alpesh Dhakad</h6>
                                          <p>ACH089</p>
                                       </td>
                                       <td>
                                          <h6>Surgury</h6>
                                       </td>
                                       <td>
                                          <h6>20 Years</h6>
                                       </td>
                                       <td>
                                          <h6>15 Nov, 2014</h6>
                                       </td>
                                       <td>
                                          <h6>9826000777</h6>
                                          <h6>0731-2349999</h6>
                                       </td>
                                       <td>
                                          <h6><a href="doctor-profile.html" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Detail</a></h6>
                                          <a href="edit-doctor.html" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Edit Detail</a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <i class="fa fa-check-circle doc-online"></i>
                                          <h6><img src="assets/images/doctor/doc-2.jpg" alt="" class="img-responsive" /></h6>
                                       </td>
                                       <td>
                                          <h6>Dr. Manoj Kumar</h6>
                                          <p>ACH089</p>
                                       </td>
                                       <td>
                                          <h6>Cardiology</h6>
                                       </td>
                                       <td>
                                          <h6>15 Years</h6>
                                       </td>
                                       <td>
                                          <h6>15 Jan, 2013</h6>
                                       </td>
                                       <td>
                                          <h6>9826000777</h6>
                                          <h6>0731-2349999</h6>
                                       </td>
                                       <td>
                                          <h6><a href="doctor-profile.html" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Detail</a></h6>
                                          <a href="edit-doctor.html" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Edit Detail</a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <i class="fa fa-check-circle doc-online"></i>
                                          <h6><img src="assets/images/doctor/doc-3.jpg" alt="" class="img-responsive" /></h6>
                                       </td>
                                       <td>
                                          <h6>Dr. Prabha Jha</h6>
                                          <p>ACH089</p>
                                       </td>
                                       <td>
                                          <h6>Eye Specialist</h6>
                                       </td>
                                       <td>
                                          <h6>10 Years</h6>
                                       </td>
                                       <td>
                                          <h6>15 Jan, 2013</h6>
                                       </td>
                                       <td>
                                          <h6>9826000777</h6>
                                          <h6>0731-2349999</h6>
                                       </td>
                                       <td>
                                          <h6><a href="doctor-profile.html" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Detail</a></h6>
                                          <a href="edit-doctor.html" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Edit Detail</a>
                                       </td>
                                    </tr>
                    
                                </tbody>
                              </table>
                           </aside>
                            <article class="clearfix m-t-20 p-b-20">
                        <ul class="list-inline list-unstyled pull-right call-pagination">
                           <li class="disabled"><a href="#">Prev</a></li>
                           <li><a href="#">1</a></li>
                           <li class="active"><a href="#">2</a></li>
                           <li><a href="#">3</a></li>
                           <li><a href="#">4</a></li>
                           <li><a href="#">Next</a></li>
                        </ul>
                     </article>                              
                        </article>
                                    </section>
                                    <!-- All Doctors Ends -->
                                    
                                   <!--Account Starts -->
                                    <section class="tab-pane fade in" id="account">
                                        <div class="clearfix m-t-20 p-b-20 doctor-description">
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-5">Registered Email Id :</label>
                                                <p class="col-md-8 col-sm-7"><?php echo $hospitalData[0]->users_email; ?></p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-5">Registered Mobile Number:</label>
                                                <p class="col-md-8 col-sm-7">+91 <?php if(isset($hospitalData[0]->users_mobile)){ echo $hospitalData[0]->users_mobile; } ?></p>
                                            </article>
                                            <form class="" name="passwordUpdate" id="passwordUpdate" action="<?php base_url();?>hospital/updatePassword">
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-5">Change Password:</label>

                                                <aside class="col-md-4 col-sm-4">
                                                   
                                                    <input type="password" name="users_password" class="form-control" placeholder="New Password" id="users_password" />
                                                   
                                                    <!-- <p><a class="m-t-10" href="#">Edit</a></p> -->
                                                </aside>
                                            </article>
                                            
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-5">Confirm Password:</label>

                                                <aside class="col-md-4 col-sm-4">
                                                   
                                                    <input type="password" name="cnfPassword" class="form-control" placeholder="Confirm Password" id="cnfPassword" />
                                                   
                                                    <p><a class="m-t-10" href="javascript:void(0)" onclick="updatePassword()">Edit</a></p>
                                                    <p class="error" id="error-password_email_check" style="display:none;"> Server not respond properly!</p>
                                                    <p class="text-success" style="display:none;" id="error-password_email_check_success"> Password Changed Successfully!</p>
                                                </aside>
                                            </article>
                                               <!-- <input type="text" name="myPassword" id="myPassword" value="<?php if(isset($bloodBankData[0]->users_password)){ echo $bloodBankData[0]->users_password;}?>" /> -->
                                            </form>      
                                        </div>
                                    </section>
                                   <!-- Account Ends -->

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
        <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Detail</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Comming Soon</p>

                                </div>
                                <div class="modal-footer p-t-10">
                                    <button type="button" class="btn btn-appointment" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
    </div>
    <!-- END wrapper -->
     <!--Change Logo-->
                    <div id="changeBg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3>Change Background</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <img src="assets/images/hospital.jpg" class="img-responsive center-block" />
                                        <form class="form-horizontal">

                                            <article class="form-group m-lr-0 ">
                                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Background :</label>
                                                    <div class="col-md-8 col-sm-8 text-right">
                                                        <input id="uploadFileBg" class="showUpload" disabled="disabled" />
                                                        <div class="fileUpload btn btn-sm btn-upload">
                                                            <span><i class="fa fa-cloud-upload fa-3x"></i></span>
                                                            <input id="uploadBtnBg" type="file" class="upload" />
                                                        </div>
                                                    </div>
                                                </article>


                                            <article class="clearfix m-t-20">
                                                <button type="button" class="btn btn-primary pull-right waves-effect waves-light bg-btn m-r-20">Upload</button>
                                            </article>
                                        </form>
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                    <!-- /Change Logo -->
                                        
                    <!-- Gallery Model -->
                    <div class="modal" id="modal-gallery" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" type="button" data-dismiss="modal">×</button>
                                  <h3 class="modal-title"></h3>
                              </div>
                              <div class="modal-body">
                                  <div id="modal-carousel" class="carousel">

                                    <div class="carousel-inner">           
                                    </div>

                                    <a class="carousel-control left" href="#modal-carousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                    <a class="carousel-control right" href="#modal-carousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>

                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                    </div>
                    <!-- Gallery Model Ends -->






    <script>
        var resizefunc = [];
    </script>
     <script src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js"> </script>
    <script src="<?php echo base_url();?>assets/js/framework.js"> </script>
        <script src="<?php echo base_url();?>assets/js/pages/blood-detail.js">
    </script>
     <script src="<?php echo base_url();?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.js">  </script>
    <script type="text/javascript" src="https://www.google.com/jsapi">
    </script>
    
   <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>

    <script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/jquery.xeditable.js"> </script>
    <script src="<?php echo base_url(); ?>assets/js/angular.min.js"> </script>
    <script src="<?php echo base_url(); ?>assets/js/pages/hospital-detail.js"></script>
    <script>
         var urls = "<?php echo base_url()?>";
         var stateIds = $.trim($('#StateId').val());
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
        $(document).ready(function(){
           /* fetchStates();
            function fetchStates(){
            
            var countryId = $('#countryId').val();
            //var stateId = $('#StateId').val();
            
            $.ajax({
               url : urls + 'index.php/hospital/fetchStates',
               type: 'POST',
              data: {'stateId' : stateIds , 'countryId' : countryId},
              success:function(datas){
               // console.log(datas);
                  $('#hospital_stateId').html(datas);
                  $('#hospital_stateId').selectpicker('refresh');
                  fetchCityOnload();
                  //$('#StateId').val(stateId);
              }
           });
        }

        function fetchCityOnload(stateId) {    
           var cityId = $('#cityId').val();
           //alert(cityId);
           $.ajax({
               url : urls + 'index.php/hospital/fetchCityOnload',
               type: 'POST',
              data: {'stateId' : stateIds , 'cityId' : cityId},
              success:function(datas){
               // console.log(datas);
                  $('#hospital_cityId').html(datas);
                  $('#hospital_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }*/
        var pharmacy_status = '';
        pharmacy_status = $('#pharmacy_status').val();
        var bloodbank_status = '';
        bloodbank_status = $('#bloodbank_status').val();
        if(bloodbank_status != '')
        $("#bloodbankbtn").trigger("click");
        if(bloodbank_status != '')
        $("#pharmacybtn").trigger("click");


    }) ;
      function fetchCity(stateId) {    
           
           $.ajax({
               url : urls + 'index.php/hospital/fetchCity',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
               // console.log(datas);
                  $('#hospital_cityId').html(datas);
                  $('#hospital_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
       function validationHospital(){
           
       //$("form[name='bloodDetail']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        //var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#hospital_cntPrsn').val());
        
       
            if($.trim($('#hospital_name').val()) === ''){
                $('#hospital_name').addClass('bdr-error');
                
            }
          
            if($.trim($('#geocomplete').val()) === ''){
               $("#geocomplete").addClass('bdr-error');
               
            }
             if(!check.test(cpname)){
                $('#hospital_cntPrsn').addClass('bdr-error');
                
            }

            if( emails !== ''){
                check_email(emails);
            }
            
            return false;
            
            
        }
        function checkNumber(id){
            var phone = $.trim($('#'+'hospital_phn'+id).val());
            if(!($.isNumeric(phone))){
             $('#'+'hospital_phn'+id).addClass('bdr-error');
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
               url : urls + 'index.php/hospital/check_email',
               type: 'POST',
              data: {'users_email' : myEmail,'user_table_id' : user_table_id },
              success:function(datas){
                 // console.log(datas);
                  if(datas == 0){
                   $("form[name='hospitalDetail']").submit();
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
        function updatePassword(){
          
            var pswd = $.trim($("#users_password").val());
            var cnfpswd = $.trim($("#cnfPassword").val());
            //var password = $('#myPassword').val();
            var user_tables_id = $('#user_tables_id').val();
            var status = 1;
            if(pswd.length < 6){
                $('#users_password').addClass('bdr-error');
                //$('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_password').focus();
               status = 0;
            }
           
           if(pswd != cnfpswd){
                $('#cnfPassword').addClass('bdr-error');
               // $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#cnfpassword').focus();
               status = 0;
            }
            if(status == 0)
                return false;
            else{
                    $.ajax({
                  url : urls + 'index.php/hospital/updatePassword',
                  type: 'POST',
                 //data: {'currentPassword' : pswd,'existingPassword' : password,'user_tables_id' : user_tables_id}, password updated from another user except super admin
                 data: {'currentPassword' : pswd,'user_tables_id' : user_tables_id},
                 success:function(datas){
                     //var statuss = datas.split('~');
                     //console.log(datas);
                    
                     if(datas == 0){
                   $('#error-password_email_check').fadeIn().delay(4000).fadeOut('slow');
                      return true;
                    }
                    else {
                           /*$('#myPassword').val(statuss[1]);*/
                           $('#users_password').val('');
                           $('#cnfPassword').val('');
                           $('#error-password_email_check_success').fadeIn().delay(4000).fadeOut('slow');

                           return true;
                    }
                 } 
              });
              
            }
        }
        
    </script>
</body>

</html>
