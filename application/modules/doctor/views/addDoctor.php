<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?php echo base_url();?>assets/images/fevicon-m.ico" rel="shortcut icon">
    <title>Add New Doctor</title>
    <link href="<?php echo base_url();?>assets/css/framework.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom-g.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom-r.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/vendor/select2/select2.css" rel="stylesheet" type="text/css" />
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
                           <span class=
                              "badge badge-xs badge-danger">3</span></a>
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
                <div id="sidebar-menu">
                    <ul>
                        <li>
                            <a href="dashboard.html" class="waves-effect"><i class="ion-ios7-keypad-outline"></i><span>Dashboard</span></a>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-hospital-o"></i> 
                            <span>Hospitals</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="hospital-listing.html">All Hospitals</a></li>
                                <li><a href="add-hospital.html">Add New Hospital</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-plus-square"></i> 
                            <span>Diagnostic Centres</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="diagnostic-center-listing.html">All Diag Centres</a></li>
                                <li><a href="add-diagcenter.html">Add New Diag Centre</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-heartbeat"></i> 
                            <span>Blood Banks</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-bloodbank.html">All Blood Banks</a></li>
                                <li><a href="add-bloodbank.html">Add New Blood Bank</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-medkit"></i> 
                            <span>Pharmacies</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-pharmacies.html">All Pharmacies</a></li>
                                <li><a href="add-pharmacy.html">Add New Pharmacies</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-ambulance"></i> 
                            <span>Ambulance Providr</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-ambulance-provider.html">All Ambulance Providers</a></li>
                                <li><a href="add-ambulance-provider.html">Add Ambulance Provider</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect active" href="#"><i class="fa fa-stethoscope"></i> 
                            <span>Doctors</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-doctor.html">All Doctors</a></li>
                                <li class="active"><a href="<?php echo base_url();?>index.php/doctor/addDoctor">Add New Doctor</a></li>
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
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <!-- consultation -->

                    <div style="display:show;" id="consultDiv">
                        <div class="clearfix">
                            <div class="col-md-12 text-success">
                            <?php echo $this->session->flashdata('message'); ?>
                         </div>
                            <div class="col-md-12">
                                <h3 class="pull-left page-title">Add New Doctor</h3>

                            </div>
                        </div>
                        <div class="map_canvas"></div>
                        <form class="cmxform form-horizontal tasi-form" id="doctorForm" method="post" action="<?php echo site_url('doctor/saveDoctor'); ?>" novalidate="novalidate" name="doctorForm" enctype="multipart/form-data">
                            <input type="hidden" name="ProfessionalExpCount" id="ProfessionalExpCount" value="1" />
                            <!-- Left Section Start -->
                            <section class="col-md-6 detailbox">
                                <div class="bg-white mi-form-section">
                                    <figure class="clearfix">
                                        <h3>General Detail</h3>
                                    </figure>
                                    <!-- Table Section End -->
                                    <div class="clearfix m-t-20">
                                        <article class="form-group m-lr-0 ">
                                            <label for="doctors_unqId" class="control-label col-md-4 col-sm-4">Doctor Id :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control disabled" id="doctors_unqId" name="doctors_unqId" type="disabled" required="" aria-required="true" placeholder="ACM304" readonly="readonly">
                                                 <label class="error" > <?php echo form_error("doctors_unqId"); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0 ">
                                            <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Doctor Photo :</label>
                                            <div class="col-md-8 col-sm-8 text-right">
                                                <label for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x"></i></label>
                                                <input type="file" style="display:none;" class="no-display" id="file-input" name="doctors_img">
                                                <label class="error" > <?php echo form_error("doctors_img"); ?></label>
                                                <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">First Name :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="doctors_fName" type="text" name="doctors_fName" required="">
                                                 <label class="error" style="display:none;" id="error-doctors_fName"> Please enter doctor's First name</label>
                                                <label class="error" > <?php echo form_error("doctors_fName"); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Last Name :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="doctors_lName" type="text" name="doctors_lName" required="" />
                                                <label class="error" style="display:none;" id="error-doctors_lName"> Please enter doctor's Last name</label>
                                                <label class="error" > <?php echo form_error("doctors_lName"); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Date of Birth :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <div class="input-group">
                                                    <input class="form-control pickDate" placeholder="dd/mm/yyyy" id="doctors_dob" type="text" name="doctors_dob">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                     <label class="error" style="display:none;" id="error-doctors_dob"> Please enter doctor's DOB</label>
                                                     <label class="error" > <?php echo form_error("doctors_dob"); ?></label>
                                                </div>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Speciality:</label>
                                            <div class="col-md-8 col-sm-8">
                                                <!--<input class="form-control " id="emailId" type="text" name="speciality" placeholder="Add Speciality">
                                                <ul class="ul-labeled">
                                                    <li class="label label-select">Cardiology<span class="badge"><i class="fa fa-close"></i></span></li>
                                                    <li class="label label-select">ENT<span class="badge"><i class="fa fa-close"></i></span></li>
                                                </ul> -->
                                                <select  multiple="" class="bs-select form-control-select2 " data-width="100%" name="doctorSpecialities_specialitiesId[]" Id="doctorSpecialities_specialitiesId" data-size="4" onchange ="fetchCity(this.value)">
                                                        <!--<option value="">Select Speciality</option>-->
                                                       <?php foreach($speciality as $key=>$val) {?>
                                                        <option value="<?php echo $val->specialities_id;?>"><?php echo $val->specialities_name;?></option>
                                                         <?php }?>
                                                    </select>
                                                <div class='setValues'></div>
                                                <label class="error" style="display:none;" id="error-doctorSpecialities_specialitiesId"> Please select speciality(s)</label>
                                                     <label class="error" > <?php echo form_error("doctorSpecialities_specialitiesId"); ?></label>
                                            </div>
                                        </article>


                                        <div id="multiplePhoneNumber">
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Landline Phone:</label>
                                             
                                            <div class="col-md-8 col-sm-8">
                                               
                                                <aside class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <select class="selectpicker" data-width="100%" name='preNumber[]' id="preNumber">
                                                            <option value='91'>+91</option>
                                                            <option value='1'>+1</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 m-t-xs-10">
                                                        <input type="text" class="form-control" name="midNumber[]" id="midNumber1" placeholder="731" maxlength="3" onblur="checkNumber('midNumber',1)" />
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-10 m-t-xs-10 ">
                                                        <input type="text" class="form-control" name="doctors_phn[]" id="doctors_phn1" maxlength="8" placeholder="7000123" onblur="checkNumber('doctors_phn',1)" />
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-t-xs-10"><a onclick="addPhoneNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a></div>
                                                        
                                                </aside>
                                                <label class="error" style="display:none;" id="error-doctors_phn1"> Please select your phone number</label>
                                                     
                                            </div>
                                        </article>
                                        </div>    
                                         <div id='multipleMobile'>
                                             
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Mobile:</label>
                                            <div class="col-md-8 col-sm-8">
                                                
                                               
                                                <aside class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <select class="selectpicker" data-width="100%" name="preMobileNumber[]" id="preMobileNumber1">
                                                            <option value="91">+91</option>
                                                            <option value="1">+1</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-10 m-t-xs-10">
                                                        <input type="text" class="form-control" name="doctors_mobile[]" id="doctors_mobile1" placeholder="9837000123" onblur="checkNumber('doctors_mobile',1)" maxlength="10" />
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-t-xs-10"><a  onclick="addMobileNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a></div>
                                                    
                                                   <label class="error" style="display:none;" id="error-doctors_mobile1"> Please select your mobile number</label>
                                                </aside>
                                              
                                                <aside class="checkbox checkbox-success">
                                                    <input type="checkbox" id="checkbox1" name="checkbox1" value="1">
                                                    <label for="checkbox3">
                                                        Make this number primary
                                                    </label>
                                                </aside>
                                            </div>
                                        </article>
                                       
                                         </div>     
         
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                            <div class="col-md-8 col-sm-8">
                                                <aside class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <select class="selectpicker" data-width="100%" name="doctors_countryId" id="doctors_countryId">
                                                            <option value="1">India</option>
                                                           
                                                        </select>
                                                    </div>
                                                     <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                        <select class="selectpicker" data-width="100%" name="doctors_stateId" Id="doctors_stateId" data-size="4" onchange ="fetchCity(this.value)">
                                                        <option value="">Select State</option>
                                                       <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-doctors_stateId"> please select a state</label>
                                                    <label class="error" > <?php echo form_error("doctors_stateId"); ?></label>
                                                </div>
                                                </aside>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <div class="col-md-8 col-md-offset-4 col-sm-4 col-sm-offset-4">
                                                <aside class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <select class="selectpicker" data-width="100%" name="doctors_cityId" id="doctors_cityId" data-size="4" >
                                                            <!--<option>Kolkata</option>
                                                            <option>Delhi</option>-->
                                                        </select>
                                                         <label class="error" style="display:none;" id="error-doctors_cityId"> please select a state</label>
                                                        <label class="error" > <?php echo form_error("doctors_cityId"); ?></label>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                        <input type="text" class="form-control" id="doctors_pin" nam="doctors_pin" placeholder="700001" maxlength="13" />
                                                        <label class="error" style="display:none;" id="error-doctors_pin"> please select a pin number</label>
                                                        <label class="error" > <?php echo form_error("doctors_pin"); ?></label>
                                                    </div>
                                                </aside>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                                <input type="text" class="form-control" id="geocomplete" name="doctor_addr" placeholder="209, ABC Road, near XYZ Building " />
                                                <label class="error" style="display:none;" id="error-doctor_addr"> please select a pin number</label>
                                                  <label class="error" > <?php echo form_error("doctors_pin"); ?></label>
                                            </div>
                                        </article>
                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Consultation Fee :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control" id="doctors_consultaionFee" name="doctors_consultaionFee" type="text" required="" />
                                                <label class="error" style="display:none;" id="error-doctors_consultaionFee"> please enter fees</label>
                                                <label class="error" > <?php echo form_error("doctors_consultaionFee"); ?></label>
                                            </div>
                                        </article>
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4"> Doctor On Call ? </label>
                                            <div class="col-md-8 col-sm-8">
                                                <aside class="radio radio-info radio-inline">
                                                    <input type="radio" id="inlineRadio1" value="1" name="doctors_27Src" checked>
                                                    <label for="inlineRadio1"> Yes</label>
                                                </aside>
                                                <aside class="radio radio-info radio-inline">
                                                    <input type="radio" id="inlineRadio2" value="0" name="doctors_27Src">
                                                    <label for="inlineRadio2"> No</label>
                                                </aside>
                                            </div>
                                        </article>


                                    </div>
                                    <!-- .form -->
                                </div>

                            </section>
                            <!-- Left Section End -->



                            <!-- Right Section Start -->
                            <section class="col-md-6 detailbox mi-form-section">
                                <div class="bg-white clearfix">
                                    <!-- Degree  Start -->

                                    <figure class="clearfix">
                                        <h3>Academic Detail</h3>
                                    </figure>
                                    <aside class="clearfix m-t-20">

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4">Degree</label>
                                            <div class="col-md-8">
                                                <div id="parentDegreeDiv">
                                                    <div id="childDegreeDiv1">
                                                    <aside class="row">
                                                        <div class="col-md-6 col-sm-6">
                                                            <select class="selectpicker" data-width="100%" data-size="4" name="doctorAcademic_degreeId[]" id="doctorAcademic_degreeId1">
                                                                 <option value="">Select Degree </option>
                                                                <?php foreach($degree as $key=>$val){?>
                                                                <option value="<?php echo $val->degree_id;?>"><?php echo $val->degree_SName;?></option>
                                                                <?php }?>
                                                            </select>
                                                            <label class="error" style="display:none;" id="error-doctorAcademic_degreeId1"> please select Degree</label>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                            <select class="selectpicker" data-width="100%" data-size="4" name="doctorSpecialities_specialitiesCatId[]" id="doctorSpecialities_specialitiesCatId1">
                                                                  <option value="">Select Specialities </option>
                                                                <?php foreach($speciality as $key=>$val) {?>
                                                            <option value="<?php echo $val->specialities_id;?>"><?php echo $val->specialities_name;?></option>
                                                             <?php }?>
                                                            </select>
                                                            <label class="error" style="display:none;" id="error-doctorSpecialities_specialitiesCatId1"> please select Specialities</label>
                                                        </div>
                                                    </aside>
                                                        <br />
                                                       
                                                        
                                                        
                                                    </div>       
                                                </div>     
                                            </div>
                                        </article>
                                        <!-- this section is need to implemented -->
                                       <!-- <article class="form-group m-lr-0">
                                            <div class="col-md-8 col-md-offset-4">
                                                <a href="#">degree.certificate.png</a>
                                                <span class="fa-icon">
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                    <a href="#"><i class="fa fa-trash"></i></a>
                                                </span>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <div class="col-md-8 col-md-offset-4">
                                                <a href="#">degree.certificate.png</a>
                                                <span class="fa-icon">
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                    <a href="#"><i class="fa fa-trash"></i></a>
                                                    <a href="#"><i class="fa fa-plus"></i></a>
                                                </span>
                                            </div>
                                        </article> -->

                                        <article class="form-group m-lr-0">
                                            <div class="col-md-8 col-md-offset-4">
                                               <!-- <button class="btn btn-danger waves-effect" type="button">Delete</button> -->
                                                <button class="btn btn-success waves-effect waves-light m-r-20" type="button" onclick="multipleAcademic()">Add More</button>
                                            </div>
                                        </article>



                                        <!-- Degree End -->


                                        <!-- Experience Section Start -->
                                        <figure class="clearfix">
                                            <h3>Professional Experience</h3>
                                        </figure>
                                        <aside class="clearfix m-t-20">
                                            
                                            
                                            <div id="parentDIV"> 
                                                <div id="child1">
                                                    <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-4">Duration:</label>
                                                    <div class="col-md-8">
                                                        <aside class="row">
                                                            <div class="col-lg-6 col-md-12 col-sm-6">
                                                                <div class="input-group">
                                                                    <input class="form-control pickDate" placeholder="dd/mm/yyyy" id="professionalExp_start1" type="text" name="professionalExp_start1">
                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                </div>
                                                                <label class="error" style="display:none;" id="error-professionalExp_start1"> please select Start date</label>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12 col-sm-6 m-t-md-15 m-t-xs-10">
                                                                <div class="input-group">
                                                                    <input class="form-control pickDate" placeholder="dd/mm/yyyy" id="professionalExp_end1" type="text" name="professionalExp_end1">
                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                </div>
                                                                 <label class="error" style="display:none;" id="error-professionalExp_end1"> please select End date</label>
                                                            </div>
                                                        </aside>
                                                    </div>
                                                </article>

                                                    <article class="form-group m-lr-0">
                                                        <div class="col-md-8 col-md-offset-4">
                                                            <select class="select2" data-width="100%" onchange="fetchHospitalSpeciality(this.value,1)" name="professionalExp_hospitalId1" id="HospitalSpecialityId">
                                                                <option value="">Select Hospital </option>
                                                                <?php foreach($hospital as $key=> $val){ ?>
                                                                <option value="<?php echo $val->hospital_id;?>"><?php echo $val->hospital_name;?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <label class="error" style="display:none;" id="error-HospitalSpecialityId"> please select Hospital</label>
                                                        </div>
                                                        
                                                    </article>

                                                    <article class="form-group m-lr-0 " >

                                                        <div class="col-md-8 col-md-offset-4">
                                                           <!-- <input class="form-control " id="speciality" type="text" name="speciality" placeholder="Add Speciality" readonly="readonly">
                                                            <ul class="ul-labeled">
                                                                <li class="label label-select">Cardiology<span class="badge"><i class="fa fa-close"></i></span></li>
                                                            </ul> -->
                                                            <select  multiple="" class="bs-select form-control-select2 " data-width="100%" name="doctorSpecialities_specialitiesId1[]" id="specialityDropdown1" data-size="4">
                                                                    <option value="">Select Speciality </option>
                                                            </select> 
                                                            <label class="error" style="display:none;" id="error-specialityDropdown1"> please select Hospital Speciality</label>
                                                        </div>
                                                    </article>
                                                </div>     
                                            </div>    


                                            <article class="form-group m-lr-0">
                                                <div class="col-md-8 col-md-offset-4">
                                                    <button class="btn btn-success waves-effect waves-light m-r-20" type="button" onclick="multipleProfessionalExp()">Add More</button>
                                                </div>
                                            </article>

                                        </aside>


                                        <!-- Experience Section End -->

                                        <!-- Feature Access Section Start -->
                                        <!--<div>
                                            <figure class="clearfix">
                                                <h3>Feature Access</h3>
                                            </figure>

                                            <article class=" m-lr-0 m-t-20">
                                                <label for="cname" class="control-label col-md-6 col-xs-9">App Consultation Booking </label>
                                                <div class="col-md-6 col-xs-3">
                                                    <aside class="checkbox checkbox-success m-t-5">
                                                        <input type="checkbox" id="checkbox3">
                                                        <label>

                                                        </label>
                                                    </aside>
                                                </div>
                                            </article>

                                            <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-6 col-xs-9"> Booking Management </label>
                                                <div class="col-md-6 col-xs-3">
                                                    <aside class="checkbox checkbox-success m-t-5">
                                                        <input type="checkbox" id="checkbox3">
                                                        <label>

                                                        </label>
                                                    </aside>
                                                </div>
                                            </article>

                                        </div>  -->  
                                        <!-- Feature Access Section End -->


                                        <!-- Account Detail Section Start -->
                                        <figure class="clearfix">
                                            <h3>Account Detail</h3>
                                        </figure>
                                        <aside class="clearfix m-t-20 p-b-20">
                                            <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Registered Email Id:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input type="email" class="form-control" id="users_email" name="users_email" placeholder="abc@gmail.com" onblur="checkEmailFormat()"/>
                                                    <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                                    <!--<label class="error" style="display:none;" id="error-users_email_check"> Email Already Exists!</label>-->
                                                    <label class="error" > <?php echo form_error("users_email"); ?></label>
                                                </div>
                                            </article>

                                            <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-4  col-sm-4">Registered Mobile no. :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input type="text" class="form-control" id="users_mobile" name="users_mobile" placeholder="8880007755" maxlength="10" onblur="checkNumber('users_mobile','')"/>
                                                    <label class="error" style="display:none;" id="error-users_mobile"> please enter your mobile number properly</label>
                                                    <label class="error" > <?php echo form_error("users_mobile"); ?></label>
                                                </div>
                                            </article>

                                            <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Enter Password :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input type="password" class="form-control" id="users_password" name="users_password" minlength="6"/>
                                                    <label class="error" style="display:none;" id="error-users_password"> please enter password and it should be 6 chracter</label>
                                                    <label class="error" > <?php echo form_error("users_password"); ?></label>
                                                </div>
                                            </article>

                                            <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Confirm Password :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input type="password" class="form-control" id="cnfPassword" name="cnfPassword" placeholder=" " />
                                                    <label class="error" style="display:none;" id="error-cnfPassword_check">Passwords do not match!</label>
                                                    <label class="error" > <?php echo form_error("cnfPassword"); ?></label>
                                                </div>
                                            </article>

                                        </aside>

                                        <!-- Account Detail Section End -->


                                </div>
                            </section>
                            <section class="clearfix ">
                                <div class="col-md-12 m-t-20 m-b-20">
                                    <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                                    <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="return validationDoctor()">Submit</button>
                                </div>

                            </section>
                            <fieldset>
                           
                            <input name="lat" type="text" value="">

                           <!-- <label>Longitude</label> -->
                            <input name="lng" type="text" value="">

                          </fieldset>
                        </form>

                    </div>

                    <!-- consultation -->



                    <!-- Right Section End -->

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
      /*  $('.selectpicker').selectpicker({
            style: 'btn-info',
            size: "auto",
            width: "100%"
        });*/
    </script>

    <script>
        var resizefunc = [];
    </script>
    <script src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js">
    </script>
    <script src="<?php echo base_url();?>assets/js/framework.js">
    </script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js">
    </script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript">
    </script>
    <script src="<?php echo base_url();?>assets/js/pages/add-doctor.js" type="text/javascript"></script>
    <!--<script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>-->
    <script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>
    
     <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
  
    <script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
     <script>
         
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
        
      
       $(".select2").select2({
            width: '100%'
        });

      $(".bs-select").select2({ placeholder: "Select a Speciality",
          allowClear: true
      });
     
    </script>
    <script>
     var urls = "<?php echo base_url()?>";
         var j = 1;
         var k = 1;
         var counts = 1;
         var countsAccademic = 1;
        function fetchCity(stateId) {    
           
           $.ajax({
               url : urls + 'index.php/doctor/fetchCity',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
               // console.log(datas);
                  $('#doctors_cityId').html(datas);
                  $('#doctors_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
        
        function addMobileNumber(){
                j = parseInt(j+1);
                $('#multipleMobile').append('<div id='+j+'><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4"></label><div class="col-md-8 col-sm-8"><aside class="row"> <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><select class="selectpicker" data-width="100%" name="preMobileNumber[]" id=preMobileNumber'+j+'><option value="91">+91</option><option value="1">+1</option></select></div><div class="col-lg-7 col-md-7 col-sm-7 col-xs-10 m-t-xs-10"><input type="text" class="form-control" name="doctors_mobile[]" id=doctors_mobile'+j+' placeholder="9837000123" maxlength="10" onblur=checkNumber("doctors_mobile",'+j+') /></div></aside><br /> <aside class="checkbox checkbox-success"><input type="checkbox" value="1" id="checkbox'+j+'" name="checkbox'+j+'"><label for="checkbox3">Make this number primary</label></aside></div></article></div>');
                $('#preMobileNumber'+j).selectpicker('refresh');
        }
        function addPhoneNumber(){
            k = parseInt(k+1);
            $('#multiplePhoneNumber').append('<div id=phoneDiv'+k+'<article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4"></label><div class="col-md-8 col-sm-8"><aside class="row"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><select class="selectpicker" data-width="100%" name="preNumber[]" id=preNumber'+k+'><option value=91>+91</option><option value=1>+1</option> </select></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 m-t-xs-10"> <input type="text" class="form-control" name="midNumber[]" id=midNumber'+k+' placeholder="731" maxlength="3" onblur=checkNumber("midNumber",'+k+') /></div> <div class="col-md-4 col-sm-4 col-xs-10 m-t-xs-10 "><input type="text" class="form-control" name="doctors_phn[]" id=doctors_phn'+k+' placeholder="7000123" maxlength="8" onblur=checkNumber("doctors_phn",'+k+') /></div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-t-xs-10"></div></aside></div></article></div>');
             $('#preNumber'+k).selectpicker('refresh');
       }  
       
       function checkNumber(inputName,ids){
           
           var mobileNumber = 0;
           if(ids != '')
            mobileNumber = $('#'+inputName+ids).val();
           else
            mobileNumber = $('#'+inputName).val();   
            // alert(mobileNumber);
           if(!$.isNumeric(mobileNumber)){
                
                if(ids != '')
                   $('#'+inputName+ids).addClass('bdr-error');
                 else
                    $('#'+inputName).addClass('bdr-error');
               // $('#error-users_mobile').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
            }
       }
       function validationDoctor(){
       //$("form[name='doctorForm']").submit();
      // alert('here');
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var doctors_fName = $.trim($('#doctors_fName').val());
        var doctors_lName = $.trim($('#doctors_lName').val());
        var emails = $.trim($('#users_email').val());
        var doctorSpecialities_specialitiesId = $.trim($('#doctorSpecialities_specialitiesId').val());  
        var midNumber1 = $('#midNumber1').val();
        var doctors_phn1= $('#doctors_phn1').val();
        var doctors_mobile1 = $('#doctors_mobile1').val();
        var doctors_pin = $.trim($('#doctors_pin').val());
        var doctors_cityId =$.trim($('#doctors_cityId').val());
        var doctors_stateId = $.trim($('#doctors_stateId').val());
        var doctors_consultaionFee = $.trim($('#doctors_consultaionFee').val());
        var pswd = $.trim($("#users_password").val());
        var cnfpswd = $.trim($("#cnfPassword").val());
        var users_mobile = $.trim($('#users_mobile').val());
       

            if(doctors_fName === ''){
                $('#doctors_fName').addClass('bdr-error');
                $('#error-doctors_fName').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               // $('#hospital_name').focus();
            }
             
           if(doctors_lName === ''){
                $('#doctors_lName').addClass('bdr-error');
                $('#error-doctors_lName').fadeIn().delay(3000).fadeOut('slow');
               // status= 0;
               // $('#hospital_type').focus();
            }
           
            if($('#doctors_dob').val() === ''){
                $('#doctors_dob').addClass('bdr-error');
                $('#error-doctors_dob').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               // $('#hospital_countryId').focus();
            }
             
           if(doctorSpecialities_specialitiesId === ''){
               // console.log("in state");
                $('#s2id_autogen1').addClass('bdr-error');
                $('#error-doctorSpecialities_specialitiesId').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               // $('#hospital_stateId').focus();
            }
            
            if(!$.isNumeric(midNumber1) && !$.isNumeric(doctors_phn1) ){
                $('#doctors_phn1').addClass('bdr-error');
                $('#midNumber1').addClass('bdr-error');
                $('#error-doctors_phn1').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               // $('#hospital_cityId').focus();
            }
            if(!$.isNumeric(doctors_mobile1) ){
                $('#doctors_mobile1').addClass('bdr-error');
                $('#error-doctors_mobile1').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               // $('#hospital_cityId').focus();
            }
             if(doctors_stateId === ''){
                $('#doctors_stateId').addClass('bdr-error');
                $('#error-doctors_stateId').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
            
            }
            if(doctors_cityId === ''){
                $('#doctors_cityId').addClass('bdr-error');
                $('#error-doctors_cityId').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               
            }
            if(!$.isNumeric(doctors_pin)){
                
                $('#doctors_pin').addClass('bdr-error');
                $('#error-doctors_pin').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
                // $('#hospital_zip').focus();
            } 
             if($("#geocomplete" ).val() === ''){
                $('#geocomplete').addClass('bdr-error');
                $('#error-doctor_addr').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               // $('#hospital_address').focus();
            }
             if(!$.isNumeric(doctors_consultaionFee)){
                $('#doctors_consultaionFee').addClass('bdr-error');
                $('#error-doctors_consultaionFee').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
                // $('#hospital_phn').focus();
            }
            if($('#doctorAcademic_degreeId1').val() === ''){
                 $('#doctorAcademic_degreeId1').addClass('bdr-error');
                $('#error-doctorAcademic_degreeId1').fadeIn().delay(3000).fadeOut('slow');
            }
             if($('#doctorSpecialities_specialitiesCatId1').val() === ''){
                 $('#doctorSpecialities_specialitiesCatId1').addClass('bdr-error');
                $('#error-doctorSpecialities_specialitiesCatId1').fadeIn().delay(4000).fadeOut('slow');
            }
             if($('#professionalExp_end1').val() === ''){
                 $('#professionalExp_end1').addClass('bdr-error');
                $('#error-professionalExp_end1').fadeIn().delay(4000).fadeOut('slow');
            }
             if($('#professionalExp_start1').val() === ''){
                 $('#professionalExp_start1').addClass('bdr-error');
                $('#error-professionalExp_start1').fadeIn().delay(4000).fadeOut('slow');
            }
              if($('#HospitalSpecialityId').val() === ''){
                 $('#HospitalSpecialityId').addClass('bdr-error');
                $('#error-HospitalSpecialityId').fadeIn().delay(4000).fadeOut('slow');
            }
            if($('#specialityDropdown1').val() === ''){
                $('#specialityDropdown1').addClass('bdr-error');
                $('#error-specialityDropdown1').fadeIn().delay(4000).fadeOut('slow');
            }
            if(emails === ''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(4000).fadeOut('slow');
               //$('#users_email').focus();
            }
            if(!$.isNumeric(users_mobile)){
                $('#users_mobile').addClass('bdr-error');
                $('#error-users_mobile').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
                // $('#hospital_phn').focus();
            }
          
            if(pswd.length < 6){
                $('#users_password').addClass('bdr-error');
                $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_password').focus();
            }
            if(cnfpswd == ''){
                $('#cnfPassword').addClass('bdr-error');
                $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#cnfpassword').focus();
            }
           
            if(pswd != cnfpswd){
                $('#cnfPassword').addClass('bdr-error');
                $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#cnfpassword').focus();
            }
           
            
        
            if(emails !=''){
              check_email(emails);
              return false;
            }
            return false;
            
        }
        
         function check_email(myEmail){
             
           $.ajax({
               url : urls + 'index.php/doctor/check_email',
               type: 'POST',
              data: {'users_email' : myEmail},
              success:function(datas){
                  console.log(datas);
                  if(datas == 0){
                   $("form[name='doctorForm']").submit();
                   return true;
              }
              else {
                $('#users_email').addClass('bdr-error');
                $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');;
               // $('#users_email').focus();
               return false;
              }
              } 
           });
        }
         
     function checkEmailFormat(){
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                var email = $('#users_email').val();
                if(email!==''){
                    if (!filter.test(email)){
                        
                       $('#users_email').addClass('bdr-error');
                         $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');;
                        // $('#users_email').focus();

                    }
            }
        } 
        function fetchHospitalSpeciality(hospitalId, numbers){
             $.ajax({
               url : urls + 'index.php/doctor/fetchHospitalSpeciality',
               type: 'POST',
              //data: {'hospitalId' : hospitalId},
              data: {'hospitalId' : 2},
              success:function(datas){
                  //console.log(datas);
                  $('#specialityDropdown'+numbers).html(datas);
                 // $('#specialityDropdown'+numbers).select2('refresh');
                  
              } 
           });
        }
        
        function multipleProfessionalExp() {
            counts = parseInt(counts) + 1;
            var ids = counts;
             var hospitalData = $('#HospitalSpecialityId').html();
           
               $('#parentDIV').append('<div id=child'+ids+'><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4">Duration:</label><div class="col-md-8"><aside class="row"><div class="col-lg-6 col-md-12 col-sm-6"><div class="input-group"><input class="form-control pickDate" placeholder="dd/mm/yyyy" id=professionalExp_start'+ids+' type="text" name=professionalExp_start'+ids+ '><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></div></div><div class="col-lg-6 col-md-12 col-sm-6 m-t-md-15 m-t-xs-10"><div class="input-group"><input class="form-control pickDate" placeholder="dd/mm/yyyy" id=professionalExp_end'+ids+' type="text" name=professionalExp_end'+ids+ '><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></div></div></aside></div></article><article class="form-group m-lr-0"><div class="col-md-8 col-md-offset-4"><select class="select2" data-width="100%" onchange="fetchHospitalSpeciality(this.value,'+ids+')" id=professionalExp_hospitalId'+ids+' name=professionalExp_hospitalId'+ids+'>'+hospitalData+'</select></div></article><article class="form-group m-lr-0 "><div class="col-md-8 col-md-offset-4"><select  multiple="" class="bs-select form-control-select2 " data-width="100%" name=doctorSpecialities_specialitiesId'+ids+'[] id=specialityDropdown'+ids+' data-size="4"></select></div></article></div>');
               $('#professionalExp_hospitalId'+ids).select2({
                    width: '100%'
                    });
          
                  $('#specialityDropdown'+ids).select2({ placeholder: "Select a Speciality",
                    allowClear: true
                });
               $('#professionalExp_start'+ids).datepicker();
               $('#professionalExp_end'+ids).datepicker();
               
             $('#ProfessionalExpCount').val(counts);   
      }
      
      function multipleAcademic(){
          countsAccademic = parseInt(countsAccademic) + 1;
           var divIds = countsAccademic;
           var degreeData = $('#doctorAcademic_degreeId1').html();
           var specialitiesData = $('#doctorSpecialities_specialitiesCatId1').html();
           $('#parentDegreeDiv').append('<div id=childDegreeDiv'+divIds+'><aside class="row"><div class="col-md-6 col-sm-6"><select class="selectpicker" data-width="100%" data-size="4" name="doctorAcademic_degreeId[]">'+degreeData+'</select></div><div class="col-md-6 col-sm-6 m-t-xs-10"><select class="selectpicker" data-width="100%" data-size="4" name="doctorSpecialities_specialitiesCatId[]">'+specialitiesData+'</select></div></aside></div><br />');
           $('.selectpicker').selectpicker({
            width: "100%"
        })
    
    }
    </script>    

</body>

</html>
