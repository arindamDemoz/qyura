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
<br><br>
<h2 class="text-center">Welcome to Froyofit </h2>
<br><br>
<div class="text-center"><img src="<?php echo base_url(); ?>assest/img/loginLogo.png" class="logo-home"></div>
<br><br>
<h2 class="text-center">Kindly fill respective services forms carefully from the left panel </h2>
<?php echo validation_errors(); ?>