<!DOCTYPE html>
<html>
    <head>
        <title>Career</title>
        <link href="<?php echo base_url(); ?>/assest/fevicon.png" rel="shortcut icon" type="image/x-icon" />
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/currentopning.css">
        <style >
            .career {border-bottom: 1px solid grey; margin-top:30px !important;}
            .has-error, #er_carrierPhone, #er_carrierName{
                color: red;
                font-weight: 600;
            }
            body{
                background: rgba(0, 0, 0, 0) -moz-linear-gradient(left center , rgba(0, 0, 0, 0), rgba(105, 99, 99, 0.3)) repeat scroll 0 0;
            }
        </style>
    </head>
    <body>
        <!-- top navigation start -->
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navscroll"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>" title="Dove - Modern Start Up landing Page"><img src="<?php echo base_url(); ?>assest/img/froyologoheader.png"  alt="Froyo logo"></a> </div>
                <div class="navbar-collapse collapse navscroll">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" onclick="fromRedirect('home')">Home</a></li>
                        <li><a href="#" onclick="fromRedirect('features')">Features</a></li>
                        <li><a href="#" onclick="fromRedirect('screens')">About</a></li>
                        <li><a href="#">Career</a></li>
                        <li><a href="#" onclick="fromRedirect('team')">Faq</a></li>
                        <!--  <li><a target="blank" href="blog-grid.html">Blog</a></li> -->
                        <li><a href="#" onclick="fromRedirect('contact')">Partner With Us</a></li>
                        <!--   <li><button type="button" style="margin-top: 7px" class="btn btn-sm btn-info" data-toggle="collapse" data-target="#demo">Request a callback</button></li> -->
                    </ul>
                </div>
                <!--/.navbar-collapse --> 
            </div>
            <div class="container">
                <div id="demo" class="collapse">
                    <div class="forms" >
                        <div class="container-fluid">
                            <div class="row">
                                <!-- newsletter subscription form start -->
                                <div class="subscribe-form">
                                    <h2 class="h1 text-center">ANYTHING IN FITNESS. WE ARE HERE TO HELP!</h2>
                                    <form method="post" id="contactForm" action="#" role="form" >
                                        <div class="row">
                                            <div class="col-md-5 col-md-offset-1">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-lg" id="name" name="name" placeholder="Full Name">
                                                </div>
                                                <div id="namePlace"></div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-lg" id="name" name="mobile" placeholder="Mobile">
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-md-offset-1">
                                                <div class="form-group">
                                                    <input type="email" class="form-control input-lg" id="email2" name="email" placeholder="Email">
                                                </div>
                                                <div id="namePlace"></div>
                                            </div>
                                            <div class="col-md-5 ">
                                                <div class="form-group">
                                                    <select class="form-control input-lg " style="height: 56px !important">
                                                        <option >Preferred Time</option>
                                                        <option >Before 10 AM</option>
                                                        <option >10 AM - 2 PM</option>
                                                        <option >2 PM - 6 PM</option>
                                                        <option >6 PM - 10 PM</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-10 col-md-offset-1">
                                                <div class="form-group text-right">
                                                    <button type="submit" class="btn btn-primary btn-lg"><i class="icon-paper-plane"></i> Send Message</button>
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
        <div class="container">
            <!-- section1 start -->
            <div class="row m-top-80">
                <center><h1>Career</h1></center>
            </div>
            <!--    section 1 start -->
            <div class="row m-top-50">
                <div class="col-md-12">
                    <h3>BUSINESS DEVELOPMENT MANAGER <br>(Indore, Mumbai, Pune, Bangalore, Lucknow, Chandigarh, Delhi)</h3>
                    <p>Business Development manager will be responsible for attaching different service providers in fitness industry to get listed on FroyoFit.com by explaining them the business preposition.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>Job Responsibility</h6>
                    <div class="col-md-12">
                        <ul>
                            <li> Carry out the market research to find the best service providers in fitness industry. </li>
                            <li>Meeting with the vendors, explaining the business models to them and converting them to get listed on FroyoFit. </li>
                            <li>Take feedback from the vendors as well as users to make the process user friendly for everyone. </li>
                            <li>Will have to pitch the idea, negotiate with vendors and sign the contract with them.</li>
                            <li>Might also have to collect information like prices, photos, schedule times etc. about fitness service providers to create and update the database</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>ELIGIBILITY</h6>
                    <div class="col-md-12">
                        <ul>
                            <li>0-3 years of work experience in similar roles.</li>

                            <li>Any Graduation, MBA would be preferred.</li>

                            <li>Operating knowledge of MS office.</li>

                            <li>Familiarity with the geography of the location applied to.</li>

                            <li>Self motivated and enthusiastic </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>REMUNERATION</h6>
                    <div class="col-md-12">
                        <ul>
                            <li>5k to 15 K per month + Variable based on enthusiasm of candidate.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>OPEN POSITIONS</h6>
                    <div class="col-md-12">
                        <ul>
                            <li>2 in each city.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row m-top-20">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                        APPLY NOW
                    </button>
                </div>
            </div>
            <div class="col-md-12 career"></div>
            <!-- section 1 end -->
            <!-- start 2nd section -->
            <div class="row m-top-50">
                <div class="col-md-12">
                    <h3>Graphic Designer (Indore)</h3>
                    <p>Graphic Designer will be responsible designing content for online media including but not limited to web banners, images for facebook and other social media platforms.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>Job Responsibility</h6>
                    <div class="col-md-12">
                        <ul>
                            <li>Collaborate with the team of communications, marketing and management to produce high quality design and marketing material. </li>
                            <li>Able to take direction and add to conceptual and design development. </li>
                            <li>Build and incorporate graphics from illustrator and photoshop and possibly other online and offline softwares. </li>
                            <li>Create documents and templates that align with company identity.</li>
                            <li>Able to create engaging infographics.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>ELIGIBILITY</h6>
                    <div class="col-md-12">
                        <ul>
                            <li>0-3 years of work experience in similar roles.</li>
                            <li>Adobe indesign, Adobe photoshop, Adobe illustrator, CorelDraw, Photoshop, Flash and other online/offline software .</li>
                            <li>Good written communication skill would be a plus.</li>
                            <li>Self motivated and enthusiastic.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>REMUNERATION</h6>
                    <div class="col-md-12">
                        <ul>
                            <li>5k to 15 K per month as per skills and passion of candidates.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>OPEN POSITIONS</h6>
                    <div class="col-md-12">
                        <ul>
                            <li>1</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row m-top-20">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                        APPLY NOW
                    </button>
                </div>
            </div>
            <!-- end second section -->
            <!--  start third section -->
            <div class="col-md-12 career"></div>
            <div class="row m-top-50">
                <div class="col-md-12">
                    <h3>Content Writer (Indore)</h3>
                    <p>Content writers will be responsible for writing and developing engaging content for Froyofit and its
customers.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>Job Responsibility</h6>
                    <div class="col-md-12">
                        <ul>
                            <li>To develop & maintain customer engagement through innovative and creative articles and other
contents relating to fitness.  </li>
                            <li>To educate users, press, bloggers, analysts and influencers about the fitness services and
FROYOFIT initiatives. </li>
                            <li>To research and write articles, newsletter and emails on health and fitness topics.</li>
                            <li>To edit content produced by other members as needed.</li>
                            <li>To stay up to date with the fitness industry trends and news.</li>
                            <li>To manage all content online and offline, which will include proofreading, editing and ensuring all content is SEO optimized, wherever necessary.</li>
                            <li>To actively participate in all marketing activity, put relevant ideas forward and work synonymously with our PR and Digital marketing team.</li>
                            <li>To manage website updates, customer experience and related communication.</li>
                        </ul>    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>ELIGIBILITY</h6>
                    <ul>
                        <div class="col-md-12">
                            <li>Any Graduate/Postgraduate, BA/MA in English would be preferred.</li>
                            <li>0-3 years of work experience.</li>
                            <li>Good oral and written communication skills in English.</li>
                            <li>Knowledge of how to operate a laptop/PC, good typing speed and working knowledge of
Microsoft Office.</li>      
                            <li>Intelligent, enthusiastic and self-motivated.</li>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="row m-top-20">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                        APPLY NOW
                    </button>
                </div>
            </div>
            <!-- end third end -->
            <!--  start 4rth section -->
            <div class="col-md-12 career"></div>
                        <div class="row m-top-50">
                <div class="col-md-12">
                    <h3>DIGITAL MARKETING ANALYST(Indore)</h3>
                    <p>Digital marketing analyst will be responsible for managing the entire internet marketing campaigns utilizing innovative techniques, to build a competitive differentiation around FROYOFIT.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>Job Responsibility</h6>
                    <div class="col-md-12">
                        <ul>
                            <li>The person would be responsible for developing & executing online marketing campaigns/initiatives with the goal of increasing brand awareness, engagement and revenue. </li>
                            <li>Strategizing, Planning & Executing activities for all SEO/SEM/SMO/SMM campaigns.</li>
                            <li>Analyzing conversion funnel and identifying areas where new strategies can be
implemented to increase user acquisition. </li>
                            <li>Responsible for Optimizing web traffic and performance metrics like CTR, engagement, lead generation, conversion, site ranking and open rates/opt-outs.</li>
                            <li>Creating, managing and experimenting with new user acquisition campaigns.</li>
                            <li>Creating and discovering new channels and strategies to grow the user base.</li>
                            <li>Creating email marketing strategies to drive higher returns.</li>
                            <li>Developing effective & creative demand generation initiatives.</li>
                            <li>Ability to form their own Star Marketing team when required in future.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>ELIGIBILITY</h6>
                    <div class="col-md-12">
                        <ul>
                            <li>Any graduate/Postgraduate.</li>

                            <li>At least 2 years experience with proven SEO, SEM, SMO strategies.</li>

                            <li>Experience in digital campaign planning and implementation.</li>

                            <li>Working knowledge of Google Adwords, Google Analytics, Double Click (Search, Display) Remarketing, Social Media Marketing, Email Marketing, Display Marketing, and Mobile Marketing etc. </li>
                            
                            <li>Able to derive actionable insights from data.</li>
                            
                            <li>Proactive and talented person who has a passion for working in a startup.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row m-top-20">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                        APPLY NOW
                    </button>
                </div>
            </div>
<!--            <div class="row m-top-50">
                <div class="col-md-12">
                    <h3>Search Engine Optimization, (SEO) (Indore, Mumbai, Pune, Bangalore)</h3>
                    <p>SEO will be responsible for managing all SEO activities such as content strategy, link building and keyword strategy to increase rankings on all major search networks. Also manage all SEM campaigns on Google, Yahoo and Bing in order to maximize ROI.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>Job Responsibility</h6>
                    <div class="col-md-12">
                        <ul>
                            <li>Execute tests, collect and analyze data, identify trends and insights in order to achieve maximum ROI in paid search campaigns.  </li>
                            <li>Track, report, and analyze website analytics and PPC initiatives and campaigns. </li>
                            <li>Manage campaign expenses, staying on budget, estimating monthly costs and reconciling discrepancies. </li>
                            <li>Optimize copy and landing pages for search engine marketing.</li>
                            <li>Perform ongoing keyword discovery, expansion and optimization.</li>
                            <li>Ability to write in a variety of formats and styles for multiple audiences.</li>
                            <li>Research and analyze competitor advertising links.</li>
                            <li>Develop and implement link building strategy.</li>
                            <li>Work with the development team to ensure SEO best practices are properly implemented on newly developed code.</li>
                            <li>Work with editorial and marketing teams to drive SEO in content creation and content programming.</li>
                            <li>Recommend changes to website architecture, content, linking and other factors to improve SEO positions for target keywords.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>ELIGIBILITY</h6>
                    <div class="col-md-12">
                        <ul>
                            <li>0-3 years of work experience in similar roles..</li>

                            <li>Any Graduation, BA or MA from English would be preferred.</li>

                            <li>Excellent writing, grammar, spelling and formatting.</li>

                            <li>Ability to research the internet and gather reliable data and information to use in content writing.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row m-top-20">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                        APPLY NOW
                    </button>
                </div>
            </div>-->
            <!--  end 4rth section -->
            <!--    <div class="col-md-12 career"></div> -->
            <?php $this->load->view('carrierModel'); ?>
        </div>
        <br><br>
        <!-- section1 end -->
    <script src="<?php echo base_url(); ?>assest/js/vendor/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/bootbox.min.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/matchMedia.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/smooth-scroll.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/smoothscroll.min.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/fitvids.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/backgroundvideo.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/nivo-lightbox.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/owl.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/retina.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/wow.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/form.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/validate.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/contact.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/ajaxchimp.js"></script>
    <script src="<?php echo base_url(); ?>assest/js/main.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assest/bootstrap-select/bootstrap-select.min.js"></script>
    <!--<script type="text/javascript" src="<?php echo base_url(); ?>assest/select2/select2.min.js"></script>-->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,600' rel='stylesheet' type='text/css'>
    <script>
	
        function fromRedirect(movedId) {
	    var url = "<?php echo base_url();?>#"+movedId; 	
            window.location.href = url;
        }

	
        function fromSubMess() {
            bootbox.alert("Hey thanks for providing these details. We will come back to you. Ciao till then!", function () {
            });
        }
        
        
        
        $(document).ready(function(){
    
            $("#addCarrierData").submit(function( event ) {
                
                var checkE = checkEmail();
                var checkM = checkPhone(); 
                var checkT = checkText();
                
                if(checkT == true){
                    if(checkM == true){
                        if(checkE == true){
                            event.preventDefault();
                            var formData = new FormData(this);
                            $.ajax({

                            type:"POST",
                            url:'<?php echo site_url(); ?>/froyofit/carrierSaveFn',
                            data:formData,//only input
                            processData: false,
                            contentType: false,
                            xhr: function()
                            {
                                $(".loader").show();
                                var xhr = new window.XMLHttpRequest();
                                //Upload progress
                                xhr.upload.addEventListener("progress", function(evt){
                                  if (evt.lengthComputable) {
                                    var percentComplete = (evt.loaded / evt.total)*100;
                                    $('#carrierLoad .progress-bar').css('width',percentComplete+'%');
                                  }
                                }, false);
                                //Download progress
                                xhr.addEventListener("progress", function(evt){
                                  if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                  }
                                }, false);
                                return xhr;
                            },
                            success: function(response, textStatus, jqXHR){
                                try {
                                    $(".loader").hide();
                                    var data = $.parseJSON(response);
                                    if(data.status == 0)
                                    {
                                        if(data.isAlive)
                                        {
                                            $('#carrierLoad .progress-bar').css('width','00%');
                                            console.log(data.errors);
                                            $.each(data.errors, function( index, value ) {
                                                $('#er_'+index).html(value);
                                            });
                                            $('#er_TopError').show();
                                            setTimeout(function(){
                                                $('#er_TopError').hide(800);
                                                $('#er_TopError').html('');
                                            },2000);
                                        }
                                        else
                                        {
                                            $('#headLogin').html(data.loginMod);
                                        }
                                    }
                                    else{
                                        $('#carrierSuccess').hide();
                                        $('#carrierSuccess').html(data.msg);
                                        bootbox.alert({closeButton: false,message:"Hey thanks for providing these details. We will come back to you. !",callback:function() {location.reload(true);}});
                                        $('.modal-footer').addClass('text-center');
                                        $('.modal-footer [data-bb-handler="ok"]').html('Close');
                                         setTimeout(function(){
                                            $('#carrierSuccess').hide(800);
                                            $('#carrierSuccess').html('');
                                            $('.bs-select').selectpicker('deselectAll');
                                            $('.bs-select').val('');
                                            $('.bs-select').selectpicker('refresh');
                                         });
                                    }
                                }catch(e) {
                                    $('#er_TopError').show();
                                    $('#er_TopError').html(e);
                                    setTimeout(function(){
                                            $('#er_TopError').hide(800);
                                            $('#er_TopError').html('');
                                        },2000);
                                    }
                            }
                        });
                        }else{
                            $(".has-error").html("Please enter valid Email.");
                            return false;
                        }
                    }else{
                        $("#er_carrierPhone").html("Please enter valid Number.");
                        return false;
                    }
                }else{
                    $("#er_carrierName").html("Please enter a valid Name.");
                    return false;
                }
            });

        });
    var _validFileExtensions = [".doc",".pdf",".docx",".PDF",".DOCX",".DOC"];    
    function ValidateSingleInput(oInput) {
        if (oInput.type == "file") {
            var sFileName = oInput.value;
             if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    alert("Sorry,   '" + sFileName + "'   is invalid, allowed extensions are : -   " + _validFileExtensions.join(", "));
                    oInput.value = "";
                    return false;
                }
            }
        }
        return true;
    }
    
function isNumberKey(evt,id){   
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        $("#"+id).html("Please enter number key");
        return false;
    }else{
        $("#"+id).html('');
        return true;
    }
}
    
function isAlphaNumeric(e){ // Alphanumeric only
    var k;
    document.all ? k=e.keycode : k=e.which;
    return((k>47 && k<58)||(k>64 && k<91)||(k>96 && k<123)||k==0 || k == 32 || k == 8 || k == 127);
 }
     
function isAlpha(e){ // Alphanumeric only
    var k;
    document.all ? k=e.keycode : k=e.which;
    return((k >= 65 && k <= 90) || (k >= 97 && k <= 122) ||k==0 || k == 32 || k == 8 || k == 127 || k == 9);

 }
 
function checkPhone(){
     var mobile = $("#carrierPhone").val();
     if(mobile.length<10 || mobile.length>11){
        $("#er_carrierPhone").html("Please enter a valid number");
        return false;
     }else{
         $("#er_carrierPhone").html('');  
         return true;
     }
 }
 
function checkText(){
     var name = $("#carrierName").val();
     if(name.length<3 ){
        $("#er_carrierName").html("Please enter a valid name");
        return false;
     }else{
         $("#er_carrierName").html('');  
         return true;
     }
 }
 
 function checkEmail(){
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        var email = $('#carrierEmail').val();
        if(email!==''){
            if (!filter.test(email)){
                console.log('else pars');
                $("#email_msg").html('');
                var uleliment = $("#email").next();

                if(!uleliment.hasClass('parsley-error-list')) {
                   $(".has-error").html("Please enter valid Email.");
                   return false;
                }
            }else{
                $(".has-error").html('');
                return true;
            }
        }else{
            $(".has-error").html("Please enter valid Email.");
           return false;
        }
    }
    </script>
</body>
</html>
