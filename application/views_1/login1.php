<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FROYOFIT | Login</title>
    <link href="<?php echo base_url(); ?>/assest/fevicon.png" rel="shortcut icon" type="image/x-icon" />
    
    <link href="<?php echo base_url(); ?>inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>inspinia/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>inspinia/css/style.css" rel="stylesheet">
    <style>
        .custom{
            //background-image: url('<?php echo base_url(); ?>inspinia/css/img4.png') !important;
        }
        
    </style>
</head>

<body class="gray-bg custom">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
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
                <h1 class="logo-name"><img src="<?php echo base_url(); ?>assest/img/loginLogo.png" width="48%"></h1> 
            </div>
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p><?php  if($this->uri->segment(1) == "partners"){ ?><h3>Partner Login</h3><?php } ?></p>
            <form class="m-t" role="form" action="<?php if($this->uri->segment(1) == "partners"){ echo site_url('/partners/validate'); }else{ echo site_url('/admin/validate'); }?>" method="POST">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Username" required="" name="email" onkeyup="err();">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="" name="password" onkeyup="err();">
                </div>
                <div class="form-group" style="color:red" id="error">
                <?php
                    if(isset($error)){
                        echo $error;
                    }
                    ?>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <?php if($this->uri->segment(1) == "partners"){  ?><button type="button" class="btn btn-primary block full-width m-b signUp" onclick='window.location="<?php echo site_url(); ?>/partners/signUp"'>SignUp Froyofit</button> <?php  } ?>
            </form>
            <p class="m-t"> <small>Froyofit &copy; 2015</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>inspinia/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url(); ?>inspinia/js/bootstrap.min.js"></script>
<script>
function err(){
    $('#error').hide();
}
</script>

<style type="text/css">
    .signUp{
        background-color : rgb(88,194,149);
        border-color : rgb(88,194,149);
    }

   .signUp:hover {
    background-color: #37976e;
    border-color: #37976e;
    color: #ffffff;
    }
</style>
</body>

</html>
<!--To add more fields, kindly drop an email at partner@froyofit.com--> 