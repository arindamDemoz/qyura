<style>
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

    .footer{
        position: absolute;
    }
</style>

<?php 
$succ_msg = $this->session->flashdata('succ_msg');
if(isset($succ_msg) && $succ_msg != ''){ ?>
<div class="alert alert-success hide-mess">
    <h4><?php echo $succ_msg; ?></h4>
</div>
<?php } 
$err_msg = $this->session->flashdata('err_msg');
if(isset($err_msg) && $err_msg != ''){ ?>
<div class="alert alert-danger hide-mess" >
    <h4><?php echo $err_msg; ?></h4>
</div>
<?php } ?>
<!--<br><br>
<h2 class="text-center">Welcome to Froyofit </h2>-->
<br><br><!--
<div class="text-center"><img src="<?php echo base_url(); ?>assest/img/loginLogo.png" class="logo-home"></div>
<br><br>
<h2 class="text-center">Kindly fill respective services forms carefully from the left panel </h2>-->
<?php echo validation_errors(); ?>
<div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">Vendors</span>
                <h5>Registered Vendors</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">40 886,200</h1>
                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                <small>Total Registered Vendors</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-info pull-right">Consumer</span>
                <h5>Consumer Acquisition</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">275,800</h1>
                <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                <small>Total Consumer Acquisition</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-primary pull-right">Services</span>
                <h5>Services</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">106,120</h1>
                <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                <small>Total Services</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-danger pull-right">Revenue</span>
                <h5>Revenue Generated</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">80,600</h1>
                <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
                <small>Total Revenue Generated</small>
            </div>
        </div>
</div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">Partner With Us</span>
                <h5>Partner Enquiries</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">40 886,200</h1>
                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                <small>Recent Partner Enquiries</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-info pull-right">Call Back</span>
                <h5>Call Back Requests</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">275,800</h1>
                <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                <small>Recent Call Back Requests</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-primary pull-right">Subscription</span>
                <h5>Email Subscription</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">106,120</h1>
                <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                <small>Email Subscription Enquiries</small>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">Vendors</span>
                <h5>1234567890</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">40 886,200</h1>
                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                <small>Message Centre  (Vendor - customer care)</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-info pull-right">Requests</span>
                <h5>Recent Requests</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">275,800</h1>
                <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                <small>Recent Approval Requests (Pending)</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-primary pull-right">Consumer</span>
                <h5>9765543212</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">106,120</h1>
                <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                <small>Message Centre  (Consumer - customer care)</small>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">Signups</span>
                <h5>Vendor Signups</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">40 886,200</h1>
                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                <small>Recent Vendor Signups</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-info pull-right">Plan</span>
                <h5>Membership Plan</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">275,800</h1>
                <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                <small>Most Popular Membership</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-primary pull-right">Revenue</span>
                <h5>Revenue Generation</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">106,120</h1>
                <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                <small>Revenue Generation Trend</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-primary pull-right">Reviews</span>
                <h5>Vendors Reviews</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">106,120</h1>
                <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                <small>Recent Reviews to Vendors</small>
            </div>
        </div>
    </div>
</div>
<div class="row"><br><br></div>