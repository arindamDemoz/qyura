<body data-spy="scroll" data-target=".navscroll">	
    <!-- preloader animation start -->
    <!-- <div class="preloader">
            <div class="wrap go">
                    <div class="loader orbit">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                    </div>
            </div>
    </div> -->
    <!-- preloader animation end -->
    <!-- top navigation start -->
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navscroll"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>" title="Dove - Modern Start Up landing Page"><img src="<?php echo base_url(); ?>assest/img/froyologoheader.png"  alt="Froyo logo"></a> </div>
            <div class="navbar-collapse collapse navscroll"  style="overflow: hidden;">
                <ul class="nav navbar-nav navbar-right" data-toggle="collapse" data-target=".navscroll">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#screens">About</a></li>
                    <li><a href="<?php echo site_url(); ?>/froyofit/carrierViewFn">Career</a></li>
                    <li><a href="#team">Faq</a></li>
                    <!--  <li><a target="blank" href="blog-grid.html">Blog</a></li> -->
                    <li><a href="#contact">Partner With Us</a></li>
                    <li><button type="button" style="margin-top: 7px" class="btn btn-sm btn-info" data-toggle="collapse" data-target="#demo">Request a callback</button></li>
                </ul>
            </div>
            <!--/.navbar-collapse --> 
        </div>
        <div class="container" >
            <div id="demo" class="collapse">
                <div class="forms" >
                    <div class="container-fluid">
                        <div class="row">
                            <!-- newsletter subscription form start -->
                            <div class="subscribe-form">
                                <h2 class="h1 text-center m-bottom-20">Request a call back</h2>
                                <form role="form" id="requestCallback" method="POST" action="#" enctype="multipart/form-data" >
                                    <div class="row">
                                        <div class="col-md-10 col-md-offset-1">
                                            <!--<div class="alert alert-success col-md-12" id="callbackSuccess" style="display: none"></div>-->
                                            <div class="alert alert-danger col-md-12" id="er_TopError" style="display: none"></div>
                                        </div>
                                        <div class="col-md-5 col-md-offset-1">
                                            <div class="">
                                                <input type="text" class="form-control input-lg" id="callbackName" name="callbackName" placeholder="Full Name" required="" onkeypress="return isAlpha(event,this.value)" onblur="return checkText('callbackName','er_callbackName')">
                                            </div>
                                            <div class="customError" id="er_callbackName" ></div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-lg" id="callbackMobile" name="callbackMobile" placeholder="Mobile" maxlength="11" onKeyPress="return isNumberKey(event)" required="" onblur="return checkPhone('callbackMobile','er_callbackMobile')">
                                                <div class="customError" id="er_callbackMobile" ></div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-md-offset-1">
                                            <div class="form-group m-bottom-10">
                                                <input  type="email" class="form-control input-lg" id="callbackEmail" name="callbackEmail" placeholder="Email" required="" onblur="return checkEmail('callbackEmail','er_callbackEmail')">
                                                <div class="customError" id="er_callbackEmail" ></div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 ">
                                            <div class="form-group">
                                                <select class="form-control input-lg " style="height: 56px !important" required="" id="callbackTime" name="callbackTime">
                                                    <option value="">Preferred Time</option>
                                                    <option value="1">Before 10 AM</option>
                                                    <option value="2">10 AM - 2 PM</option>
                                                    <option value="3">2 PM - 6 PM</option>
                                                    <option value="4">6 PM - 10 PM</option>
                                                </select>
                                            </div>
                                            <div class="help-block text-danger" id="er_callbackTime" ></div>
                                        </div>
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="form-group text-center">
                                                <button style="margin-top:10px" type="submit" class="btn btn-primary btn-lg" ><i class="icon-paper-plane"></i> Send Message</button>
                                            </div>
                                        </div>
                                    </div>							
                                </form>

                                <!-- container for success and error messages -->
                                <div id="response"></div>
                            </div>
                            <!-- contact form end -->

                            <!-- form switch buttons start -->
                            <div class="form-switch">
                                <button data-toggle="collapse" data-target="#demo" class="subscribe-btn active" id="onpen-sub-form" data-original-title="Mailchimp subscription form"><i class="fa fa-minus"></i></button>
                            </div>
                            <!-- form switch buttons end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- top navigation end -->

    <!-- main banner start -->
    <div class="bg-img overlay-color">
        <div class="banner" id="home">
            <div class="container">

                <center class="row">
                    <img src="<?php echo base_url(); ?>assest/img/froyologo.png" alt="" class="img-responsive logo-width">
                </center>
                <div style="display:none;position:absolute;top:42%;left:45%;padding:2px;" id="loader">
                    <img src="<?php echo base_url(); ?>/inspinia/loader/loader.gif" alt="Loader">
                </div>
                <div class="row">
                    <div class="col-sm-7">
                        <h1 class="col-sm-12 m-bottom-20 text-center header-font">Staying Fit will never be so <br> boring again!</h1>

                        <div class=" col-sm-12 col-xs-12 wow zoomIn"><img src="<?php echo base_url(); ?>assest/img/single-button.png" class="img-responsive img-height m-auto img-height"></div>




                        <div class="col-xs-12 m-top-20 text-center">
                            <div class="alert alert-danger col-md-12" id="er_TopError" style="display: none"></div>
                            <form class="form-inline mailchimp  wow zoomIn" role="form" action="#" id="emilList" method="POST">
                                <!-- success and error messages -->
                                <!-- <h4 class="subscription-success"></h4>
                                <h4 class="subscription-error"></h4> -->
                                <div class="form-group emailLabel">
                                    <input type="email" class="form-control input-lg" id="EMAIL" name="EMAIL" placeholder="Enter Email Address" onblur="return checkEmail('EMAIL','err_email')">
                                    
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg m-top-10"><i class="fa fa-hand-o-up "></i>Be the First to Know<img src="<?php echo base_url(); ?>assest/img/star-1.png"></button>
                                <div class="help-block text-danger" id="er_emailListText" ></div>
                                <div class="has-error" id="err_email"><?php echo form_error("contactPersonName"); ?></div>
                            </form>	
                        </div>

                        <small class="headfont col-xs-12 text-center"><img src="<?php echo base_url(); ?>assest/img/star.png">And get a chance to win exciting fitness goodies from Froyofit </small>


                    </div>

                    <div class="col-sm-5 hidden-xs">
                        <div class="phone-mockup style1">
                            <div class="wrapper">
                                <!-- phone mockup (back layer) -->
                                <img class="layer-one wow fadeInLeft img-responsive" data-wow-delay="1s" src="<?php echo base_url(); ?>assest/img/mockups/iphone-darksplashfdashboard.png"  alt="">
                                <!-- phone mockup (back layer) -->
                                <img class="layer-two img-responsive" src="<?php echo base_url(); ?>assest/img/mockups/iphone-whitefsplash.png"  alt="">							
                            </div>
                        </div>			
                    </div>
                </div>	

            </div>
        </div>
    </div>
    <!-- main banner end -->


    <!-- features section start -->
    <div class="features section" id="features">
        <div class="container">

            <div class="clearfix">
                <h2 class="h1 text-center ">Amazing Features </h2>
                <div class="colored-line">
        </div>
                <h2 class="text-center"><small>A fit & healthy body is the best fashion statement one can make!</small></h2> 
                <div class="colored-line">
        </div>
            </div>

            <hr class="spacer">

            <div class="row">

                <div class="col-sm-4">


                    <div class="feature style1 wow fadeInRight m-top-100" data-wow-delay="1s">
                        <div class="col-sm-9 p-top-10"> <h4>Discover Fitness Options</h4></div> 
                        <div class="col-sm-3"> <i class="icon_pin_alt orange"></i></div>
                        <div class="clearfix"></div> 
                    </div>



                    <div class="feature style1 wow fadeInRight m-top-80" data-wow-delay="1.2s">
                        <div class="col-sm-9 p-top-10">  <h4>Compare Service Providers</h4></div> 
                        <div class="col-sm-3"> <i class="  green"> <img  src="<?php echo base_url(); ?>assest/img/search.png"  alt=""></i></div> 
                        <div class="clearfix"></div>
                    </div>


                    <div class="feature style1 wow fadeInRight m-top-80" data-wow-delay="1.4s">

                        <div class="col-sm-9 p-top-10">  <h4>Book Free Trials</h4></div> 
                        <div class="col-sm-3">  <i class=" icon_like cyan"></i></div> 

                        <div class="clearfix"></div>

                    </div>

                    <!-- <div class="feature style1 wow fadeInRight" data-wow-delay="1.2s">
                       <i class="icon_search-2 green"></i>
                       <h4>Compare</h4>
                       <p>&nbsp;</p>
                   </div> --> 
                    <!-- 
                                                 <div class="feature style1 wow fadeInRight" data-wow-delay="1.4s">
                                                    <i class=" icon_like cyan"></i>
                                                     <h4>Try Before Buy</h4>
                                                    <p>&nbsp;</p>
                                                </div>
                    -->

                </div>






                <div class="col-sm-4 col-md-4 text-center">
                    <div class="phone-mockup style2">
                        <div class="wrapper">
                            <!-- phone mockup (back layer) -->
                            <img class="layer-one wow fadeIn img-responsive m-auto img-full manage-img" data-wow-delay="0.5s" src="<?php echo base_url(); ?>assest/img/mockups/iphone-darksplashfdashboard.png"  alt="">
                            <!-- phone mockup (back layer) -->
                            <!-- <img class="layer-two wow fadeInLeft img-responsive" data-wow-delay="1s" src="assest/img/mockups/iphone-screenfroyo.png"  alt=""> -->
                        </div>
                    </div>
                </div>




                <div class="col-sm-4">


                    <div class="feature style1 wow fadeInRight m-top-100" data-wow-delay="1.6s">
                        <div class="col-sm-3">  <i class="icon_calendar green "></i></div> 
                        <div class="col-sm-9 p-top-10"> <h4>Workout Schedules</h4></i></div>
                        <div class="clearfix"></div> 
                    </div>



                    <div class="feature style1 wow fadeInRight m-top-80" data-wow-delay="1.8s">
                        <div class="col-sm-3">   <i class="icon_gift_alt orange"></i></div> 
                        <div class="col-sm-9 p-top-10">  <h4>Exclusive Fitness Offers</h4></i></div> 
                        <div class="clearfix"></div>
                    </div>


                    <div class="feature style1 wow fadeInRight m-top-80" data-wow-delay="1.9s">
                        <div class="col-sm-3">  <i class=" icon_wallet cyan"></i></div> 
                        <div class="col-sm-9 p-top-10">  <h4>Super Secure Payment</h4></div> 

                        <div class="clearfix"></div>

                    </div>

                    <!-- <div class="feature style1 wow fadeInRight" data-wow-delay="1.2s">
                       <i class="icon_search-2 green"></i>
                       <h4>Compare</h4>
                       <p>&nbsp;</p>
                   </div> --> 
                    <!-- 
                                                 <div class="feature style1 wow fadeInRight" data-wow-delay="1.4s">
                                                    <i class=" icon_like cyan"></i>
                                                     <h4>Try Before Buy</h4>
                                                    <p>&nbsp;</p>
                                                </div>
                    -->

                </div>








            </div>

        </div>
    </div>
    <!-- features section end -->





    <!-- About Froyo start-->
     <div class="bg-about ">
    <div class="app-screenshots section" id="screens">
        
 <h2 class="h1 text-center text-white ">About Froyo</h2>
            <div class="colored-line m-bottom-30"></div>
        <div class="container-fluid font-16">

<div class="container">

        


          
            <div class="row ">
               
                <div class="col-sm-7  font-w-300  m-top-160 text-white">
               


                    <p class="wow fadeInLeft">Ever wondered about adopting a healthy lifestyle, but don't know where to start? Whether you should join Yoga or Pilates, take Zumba lessons or Karate? What should your budget be? Whether you should take up a class near your home or work? </p>

                    <p class="wow fadeInLeft">Well! we all have faced a similar situation and would hate to see you go through all the hassle. 
                        Froyo endeavours to solve all your fitness related problems, we wish to enable you to find a health regime worthy of a Bollywood Star, that suits your pocket. </p>

                    <p class="wow fadeInLeft"><img src="<?php echo base_url(); ?>assest/img/quote.png"> Our Mission - To empower every Indian to have access to a healthy and fit lifestyle. <img src="<?php echo base_url(); ?>assest/img/quote-left.png"></p>

                    <p class="wow fadeInLeft">And to attain this, we have a dedicated team who work tirelessly to ensure that only the best in the business come to you. We ensure this by regular and strict quality checks and continuously updating our database with pictures, user reviews etc of all our partner facilities so that you have the power of making an informed choice</p>
                


                </div>		
                

                <div class="col-sm-5">
                    <div class="phone-mockup style1">
                        <div class="wrapper">
                            <img class="layer-one wow fadeInLeft img-responsive" data-wow-delay="1s" src="<?php echo base_url(); ?>assest/img/mockups/about-froyo.png"  alt="">
                            <img class="layer-two img-responsive" src="<?php echo base_url(); ?>assest/img/mockups/iphone-whitefsplash.png" alt="">							
                        </div>
                    </div>
                </div>

            </div>
     </div>      
        </div>
    </div>
    </div>
    <!-- Abou Froyo end -->




    <!-- team section start -->
    <div class="team-container section " id="team">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h1 text-center">Frequently Asked Questions</h2>
                    <div class="colored-line"></div>
                    <h2 class="text-center"><small>Incase of further questions, drop us a line at info@froyofit.com</small></h2>
                    <div class="colored-line"></div>


                    <!-- spacer -->
                    <hr class="spacer">

                    <div class="row accordian-border">
                        <div class="col-md-12">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading active">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">What is FroyoFit?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse in">
                                        <div class="panel-body bordergrey">FroyoFit is a technology platform where you can discover, compare, book free trials and join various fitness options like Gym, Yoga, Zumba, Dance, etc. and also avail exciting offers and deals on signing up</div>
                                    </div>
                                </div>
                                <div class="panel panel-default ">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">When will your app launch?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse">
                                        <div class="panel-body">We are working hard to bring to you our app at the earliest. Do not forget to leave your email id on the website,  so that you know as soon as we launch. And trust us it will be sooner than you think.</div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading ">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">What are the platforms on which you are launching your app?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse">
                                        <div class="panel-body">We are launching on Android and iOS platforms.</div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading ">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">How will FroyoFit help me in my fitness endeavors?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse4" class="panel-collapse collapse">
                                        <div class="panel-body">FroyoFit will bring the best service providers across all fitness categories at your finger tips. You can choose on the basis of their ratings, distance from your location, amenities, pricing etc. You can book free trials with them and check their services before buying a membership. And yes! don’t forget to avail the amazing offers that we bring for you exclusively on FroyoFit.</div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading ">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">How do i win the free fitness goodies from FroyoFit?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse5" class="panel-collapse collapse">
                                        <div class="panel-body">Enter your email id on our website to get notified about our app launch. And at our app launch event we will announce the list of winners. Hundreds of goodies will be up for grabs!</div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading ">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">How is FroyoFit different from others?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse6" class="panel-collapse collapse">
                                        <div class="panel-body">Well! that is for you to decide and let the world know about it once we launch! Stay Tuned! </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">I run a fitness centre, How can i partner with you?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse7" class="panel-collapse collapse">
                                        <div class="panel-body">Awesome! Just drop us a line on info@froyofit.com or fill up the form <a href="#contact"><strong>here</strong>.</a></div>
                                    </div>
                                </div>

                                <!--
                           <div class="panel panel-default">
                               <div class="panel-heading">
                                   <h4 class="panel-title">
                                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse8"> Are there any deliver costs?</a>
                                   </h4>
                               </div>
                               <div id="collapse8" class="panel-collapse collapse">
                                   <div class="panel-body">Nope, it's absolutely free.</div>
                               </div>
                           </div>


                           <div class="panel panel-default">
                               <div class="panel-heading">
                                   <h4 class="panel-title">
                                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse9"> Are your products fresh?</a>
                                   </h4>
                               </div>
                               <div id="collapse9" class="panel-collapse collapse">
                                   <div class="panel-body">Always! We make sure that the products we deliver to you are the freshest one. Feel free to return a product if you don't find it fresh.</div>
                               </div>
                           </div> 
                           <div class="panel panel-default">
                               <div class="panel-heading">
                                   <h4 class="panel-title">
                                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse10">  What if I am not satisfied with a product?</a>
                                   </h4>
                               </div>
                               <div id="collapse10" class="panel-collapse collapse">
                                   <div class="panel-body">Feel free to return, and not pay for any product you don't like.</div>
                               </div>
                           </div>  --> 
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- team section start -->


    <!-- pricing section start -->

    <!-- pricing section end -->

    <!-- contact  forms start -->
    <div class="forms" id="contact">
        <div class="container-fluid">
            <div class="row">

                <!-- newsletter subscription form start -->
                <div class="subscribe-form bg-orange">
                    

                     <h2 class="h1 text-center">Partner With Us</h2>
                    <div class="colored-line-2"></div>
                    <h2 class="text-center"><small>Please fill up this short form and we will get back to you for more details.</small></h2>
                    <div class="colored-line-2  m-bottom-40 m-bottom-30"></div>

                    <form role="form" id="partnerWithUs" method="POST" action="#" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <!--<div class="alert alert-success col-md-12" id="partnerSuccess" style="display: none"></div>-->
                                <div class="alert alert-danger col-md-12" id="er_TopError" style="display: none"></div>
                            </div>
                            <div class="col-md-4 col-md-offset-2">
                                <div class="">
                                    <input type="text" onBlur="return checkText('partnerName','er_partnerName'),customMessPop('partnerName', 'namePlace', '0');" class="form-control input-lg" id="partnerName" name="partnerName" placeholder="Name" required="" onkeypress="return isAlpha(event,this.value)" >
                                    <div class="" id="er_partnerName" ></div>
                                </div>
                                <div class="placeHolderCustom" id="namePlace"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="email" onBlur="return checkEmail('partnerEmail','er_partnerEmail'),customMessPop('partnerEmail', 'emailPlace', '1');" class="form-control input-lg" id="partnerEmail" name="partnerEmail" placeholder="Email id" required="">
                                    <div class="" id="er_partnerEmail" ></div>
                                </div>
                                <div class="placeHolderCustom" id="emailPlace"></div>
                            </div>
                            <div class="col-md-4 col-md-offset-2">
                                <div class="">
                                    <input type="tel" onKeyPress="return isNumberKey(event)" onBlur="return checkPhone('partnerMobile','er_partnerMobile'),customMessPop('partnerMobile', 'phonePlace', '2');" class="form-control input-lg" id="partnerMobile" name="partnerMobile" placeholder="Phone Number" maxlength="11" required="">
                                    <div class="" id="er_partnerMobile" ></div>
                                </div>
                                <div class="placeHolderCustom" id="phonePlace"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" onBlur="customMessPop('partnerLocation', 'locationPlace', '3');" class="form-control input-lg" id="partnerLocation" name="partnerLocation" placeholder="Location" required="">
                                </div>
                                <div class="placeHolderCustom" id="locationPlace"></div>
                                <div class="help-block text-danger" id="er_partnerLocation" ></div>
                            </div>
                            <div class="col-md-4 col-md-offset-2">
                                <div class="form-group m-bottom-10">
                                    <select class="bs-select form-control  select-bg " data-selected-text-format="count>2" data-live-search="true" title="Your Services"  multiple id="partnerService" name="partnerService[]" required="">
                                        <option value="Aerobics" >Aerobics </option>
                                        <option value="Cross functional training" >Cross functional training</option>
                                        <option value="Dance" >Dance</option>
                                        <option value="Dietitian/Nutritionist" >Dietician/Nutritionist</option>
                                        <option value="Fitness Studio" >Fitness Studio</option>
                                        <option value="Gym" >Gym </option>
                                        <option value="Karate/Martial Arts" >Karate/Martial Arts</option>
                                        <option value="Kick Boxing" >Kick Boxing</option>
                                        <option value="Personal Trainer" >Personal Trainer</option>
                                        <option value="Pilates" >Pilates</option>
                                        <option value="Spinning" >Spinning </option>
                                        <option value="Swimming" >Swimming</option>
                                        <option value="Yoga" >Yoga</option>
                                        <option value="Zumba" >Zumba</option>
                                    </select>
                                </div>
                                <div class="help-block text-danger" id="er_partnerService" ></div>
                            </div>
                            <div class="col-md-4" >
                                <div class="form-group m-bottom-10">
                                    <input type="text" class="form-control input-lg" id="otherServiceText" name="otherServiceText" placeholder="Any other fitness related activity" >
                                </div>
                            </div>                                    
                            <div class="col-md-8 col-md-offset-2">
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary btn-lg bg-btn" ><i class="icon-paper-plane"></i> Send Message</button>
                                </div>
                            </div>
                        </div>							
                    </form>

                    <!-- container for success and error messages -->
                    <div id="response"></div>
                </div>
                <!-- contact form end -->

                <!-- form switch buttons start -->
                <div class="form-switch">
                    <button class="subscribe-btn active bg-orange" id="onpen-sub-form" data-original-title="Mailchimp subscription form "><i class="fa fa-envelope-o"></i></button>
                </div>
                <!-- form switch buttons end -->
            </div>
        </div>
    </div>
    <!-- contact and subscription forms start -->
    <!-- footer start -->
    <footer class="footer section">
        <div class="container">
            <div class="row">
<!--                <div class="col-sm-3">
                    <a class="btn-xs btn-warning" href="<?php //echo site_url(); ?>/froyofit/login">Carrier Details List</a><br><br>
                    <a class="btn-xs btn-warning" href="<?php //echo site_url(); ?>/froyofit/vendorForm">Vendor SignUp</a>
                </div>-->
<!--                <div class="col-sm-6">
                    <a href="<?php //echo site_url(); ?>/froyofit/partnerList">Partner With Us List</a>
                </div>-->
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <p class="copyright">&copy; 2015 Froyofit, All Rights Reserved.</p>
                </div>
                <div class="col-sm-6">
                    <ul class="social text-right">
                        <li><a href="https://www.facebook.com/froyofit" title="facebook" class="tool-tip"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/FroyoFit" title="twitter" class="tool-tip"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/froyofit" title="linkedin" class="tool-tip"><i class="fa fa-linkedin"></i></a></li>
                    </ul>		
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->
