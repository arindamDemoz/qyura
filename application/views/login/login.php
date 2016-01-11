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
            <p><?php if($this->uri->segment(1) == "partners"){ ?><h3>Partner Login</h3><?php } ?></p>
            <p><?php if($this->uri->segment(1) == "super"){ ?><h3>Super Admin Login</h3><?php } ?></p>
            <p><?php if($this->uri->segment(1) == "sales"){ ?><h3>Sales Login</h3><?php } ?></p>
            <p><?php if($this->uri->segment(1) == "admin"){ ?><h3>Admin Login</h3><?php } ?></p>
            <form class="m-t" role="form" action="<?php if($this->uri->segment(1) == "partners"){ echo site_url('/partners/validate'); }elseif($this->uri->segment(1) == "super"){ echo site_url('/super/validate'); }elseif($this->uri->segment(1) == "sales"){ echo site_url('/sales/validate'); }else{ echo site_url('/admin/validate'); } ?>" method="POST">
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

                <?php if($this->uri->segment(1) == "partners"){  ?><button type="button" class="btn btn-primary block full-width m-b signUp" onclick='window.location="<?php echo site_url(); ?>partners/signUp"'>SignUp Froyofit</button> <?php  } ?>
            </form>
            <?php if($this->uri->segment(1) == "partners"){ ?>
        <a href="<?php echo site_url(); ?>forgot/" >Forgot Password</a>
            <?php } ?>
            <p class="m-t"> <small>Froyofit &copy; 2015</small> </p>
        </div>
    </div>