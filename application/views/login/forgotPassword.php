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
            <p><?php  if($this->uri->segment(1) == "forgot"){ ?><h3>Forgot Password</h3><?php } ?></p>
            <div id="forgotDiv">
                <form class="m-t" role="form" action="<?php if($this->uri->segment(1) == "forgot"){ echo site_url('/forgot/forgotPassword'); }?>" method="POST">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email Id" required="" name="forgotEmail" onkeyup="err();">
                    </div>
                    <div class="form-group" style="color:red" id="error">
                    <?php
                        echo form_error('forgotEmail');
                        if(isset($error)){
                            echo $error;
                        }
                    ?>
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>
                </form>
                <?php if($this->uri->segment(1) == "forgot"){ ?>
                    <a href="<?php echo site_url(); ?>/partners" >Back</a>
                <?php } ?>
            </div>
            <p class="m-t"> <small>Froyofit &copy; 2015</small> </p>
        </div>
    </div>
