<style>
    .footer{
        position: relative !important;
    }
</style>
<div id="wrapper">
    <div  class="gray-bg wrapper">
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <a href="<?php if(($this->uri->segment(2) == "signUp") ) { echo site_url('partners'); }else{ echo site_url('partners/vendorServices'); }?>"><img src="<?php echo base_url(); ?>assest/img/froyologo.png" alt="FroyoFit" style="width: 16%; margin-top: 1%; margin-bottom: -1%;"></a>
            <!--<ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a>Vendor</a>
                    </li>
                    <li class="active">
                        <strong>Partner Signup</strong>
                    </li>
                </ol>-->
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Partner Edit Profile</h5>
                        </div>
                        <div class="ibox-content">
<!--                                <h2>
                                Vendor
                            </h2>-->
<!--                                <p>

                            </p>-->
                            <?php foreach ($userDatas as $userData); ?>
                            <form id="formEdit" method="POST" action="<?php echo site_url(); ?>partners/vendorEditFn" class="wizard-big" enctype="multipart/form-data">
                                <h1>General :</h1>
                                <fieldset>
                                    <div class="row">
                                        <input type="hidden" id="vendorId" name="vendorId" value="<?php echo $userData->vendorId; ?>">
                                        <div class="col-lg-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Centre Name *</label>
                                                    <label class="has-error" id="err_centerName"><?php echo form_error("centerName"); ?></label>
                                                    <input id="centerName" name="centerName" type="text" class="form-control required" placeholder="Your Centre Name" value="<?php echo $userData->centerName; ?>" onblur="return checkText('centerName','err_centerName')">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Centre Address *</label>
                                                    <label class="has-error"><?php echo form_error("centerAddress"); ?></label>
                                                    <input type="text" name="centerAddress" class="form-control required" placeholder="Your Centre Address" id="centerAddress" value="<?php echo $userData->centerAdd; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Centre Email Id *</label>
                                                    <label class="has-error" id="err_centerEmail"><?php echo form_error("centerEmail"); ?></label>
                                                    <input id="centerEmail" name="centerEmail" type="email" class="form-control required" placeholder="Your Centre Email" value="<?php echo $userData->centerEmail; ?>" onblur="return checkEmail('centerEmail','err_centerEmail')" readonly="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Centre Contact No *</label>
                                                    <label class="has-error" id="centreContactErr"><?php echo form_error("centerContact"); ?></label>
                                                    <input id="centerContact" name="centerContact" type="text" class="form-control required" placeholder="Your Centre Mobile" value="<?php echo $userData->centerContact; ?>" onkeypress="return isNumberKey(event,'centreContactErr')" onblur="return checkPhone('centerContact','centreContactErr')">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Change Password *</label>
                                                    <label class="has-error" id="er_password"><?php echo form_error("password"); ?></label>
                                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" onblur="checkPassword('password','confirm');">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Confirm Password *</label>
                                                    <label class="has-error" id="er_confirm"><?php echo form_error("password"); ?></label>
                                                    <input id="confirm" name="confirm" type="password" class="form-control" placeholder="Re-Type Password" onblur="checkConfirm('password','confirm');" >
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Contact person Name  *</label>
                                                    <label class="has-error" id="err_coperson"><?php echo form_error("contactPersonName"); ?></label>
                                                    <input type="text" id="contactPersonName" name="contactPersonName" class="form-control required" placeholder="Your Name" value="<?php echo $userData->contactPerson; ?>" onkeypress="return isAlpha(event,this.value)" onblur="return checkText('contactPersonName','err_coperson')" >
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Contact Mobile phone *</label>
                                                    <label class="has-error" id="mobileErr"><?php echo form_error("contactMobile"); ?></label>
                                                    <input id="contactMobile" name="contactMobile" type="text" class="form-control required" placeholder="Your Mobile" value="<?php echo $userData->contactMobile; ?>" onkeypress="return isNumberKey(event,'mobileErr')" maxlength="11" onblur="return checkPhone('contactMobile','mobileErr')">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Contact Person email id *</label>
                                                    <label class="has-error" id="err_contactEmail"><?php echo form_error("contactEmail"); ?></label>
                                                    <input id="contactEmail" name="contactEmail" type="email" class="form-control required" placeholder="Your Email" value="<?php echo $userData->contactEmail; ?>" onblur="return checkEmail('contactEmail','err_contactEmail')" readonly="">
                                                </div>
                                            </div>
                                            <?php if(isset($userDatas) && !empty($userDatas)):
                                                    $language =  unserialize($userData->language);
                                            endif; ?>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Languages Known *</label>
                                                    <label class="has-error" ><?php echo form_error("selectLanguage"); ?></label>
                                                    <select name="selectLanguage[]" id="selectLanguage" class="bs-select form-control required" data-size="auto" data-live-search="true" title="Languages"  multiple="">
                                                        <option value="hindi" <?php if(isset($language) && !empty($language)):if(in_array("hindi", $language)):echo"selected";endif;endif;?> >Hindi</option>
                                                        <option value="english" <?php if(isset($language) && !empty($language)):if(in_array("english", $language)):echo"selected";endif;endif;?> >English</option>
                                                        <option value="marathi" <?php if(isset($language) && !empty($language)):if(in_array("marathi", $language)):echo"selected";endif;endif;?> >Marathi</option>
                                                        <option value="kannada" <?php if(isset($language) && !empty($language)):if(in_array("kannada", $language)):echo"selected";endif;endif;?> >Kannada</option>
                                                        <option value="tamil" <?php if(isset($language) && !empty($language)):if(in_array("tamil", $language)):echo"selected";endif;endif;?> >Tamil</option>
                                                        <option value="telgu" <?php if(isset($language) && !empty($language)):if(in_array("telgu", $language)):echo"selected";endif;endif;?> >Telgu</option>
                                                        <option value="malayalam" <?php if(isset($language) && !empty($language)):if(in_array("malayalam", $language)):echo"selected";endif;endif;?> >Malayalam</option>
                                                        <option value="arabic" <?php if(isset($language) && !empty($language)):if(in_array("arabic", $language)):echo"selected";endif;endif;?> >Arabic</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Facebook Id</label>
                                                    <label class="has-error"><?php echo form_error("fbId"); ?></label>
                                                    <input id="fbId" name="fbId" type="text" class="form-control " placeholder="Your Facebook Id" value="<?php echo $userData->fbId; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Twitter Id</label>
                                                    <label class="has-error"><?php echo form_error("contactEmail"); ?></label>
                                                    <input id="twitId" name="twitId" type="text" class="form-control " placeholder="Your Twitter Id" value="<?php echo $userData->twitId; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Photo </label>
                                                    <input id="photoList" name="photoList[]" type="file" class="" multiple="" onchange="ValidateSingleInput(this);">
                                                    Please press CTRL to select multiple files.
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Documents/Certificates </label>
                                                    <input id="documents" name="documents[]" type="file" class="" multiple="" onchange="ValidateSingleInputFile(this);">
                                                    Please press CTRL to select multiple files.
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Video </label>
                                                    <input id="video" name="video[]" type="text" class="form-control" >
                                                    Kindly paste your video link here<br>
                                                    <a onclick="addMoreVideo();"><i class="fa fa-plus-circle fa-lg"></i></a>
                                                </div>
                                            </div>
                                            <div id="moreVideos"></div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Is your centre for Women Only ? </label>
                                                    <label class="has-error" ><?php echo form_error("centerType"); ?></label>
                                                    <select name="centerType" id="centerType" class="bs-select form-control required" data-size="auto" title="Languages" onchange="showWomenTime(this.value,'womenDiv')">
                                                        <option <?php if(isset($language) && !empty($language)):if($userData->centerType == 1):echo"selected";endif;endif;?> value="1">Yes</option>
                                                        <option <?php if(isset($language) && !empty($language)):if($userData->centerType == 0):echo"selected";endif;endif;?> value="0">No</option>
                                                    </select>
                                                    <div class="has-error"><?php echo form_error("centerType"); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
				    
                                    <?php if(isset($userDatas) && !empty($userDatas)):
                                            $mon =  unserialize($userData->mon);
                                            $tue =  unserialize($userData->tue);
                                            $wed =  unserialize($userData->wed);
                                            $thu =  unserialize($userData->thu);
                                            $fri =  unserialize($userData->fri);
                                            $sat =  unserialize($userData->sat);
                                            $sun =  unserialize($userData->sun);
                                            $lunchHours =  unserialize($userData->lunchHours);
                                            $shiftM =  unserialize($userData->shiftM);
                                            $shiftE =  unserialize($userData->shiftE);
                                    endif; ?>
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <label class="col-md-3" for="typehead">Days *</label>
                                                <label class="col-md-3" for="typehead">Opening Hours</label>
                                                <label class="col-md-3" for="typehead">Closing Hours</label>
                                                <label class="has-error m-left-30" id="checkDays"><?php echo form_error("centerType"); ?></label>
                                                <div id="checkDaysTime">
                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                          <input type="checkbox" name="check1" id="check1" onclick="customShowDays('check1', 'day1','day2')" <?php if(isset($mon) && !empty($mon)):echo"checked";endif;?>/> Monday
                                                        </div>
                                                        <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="day1" autocomplete="off" class="form-control timepicker" type="text" name="mon[]" <?php if(!isset($mon[0]) && empty($mon[0])):echo"disabled";endif;?> value="<?php if($mon){ echo $mon[0];} ?>">
                                                            </div>
                                                        </div>

                                                          <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <div class="bootstrap-timepicker input-group">
                                                                    <input id="day2" autocomplete="off" class="form-control timepicker" type="text" name="mon[]" <?php if(!isset($mon[1]) && empty($mon[1])):echo"disabled";endif;?> value="<?php if($mon){ echo $mon[1];} ?>">
                                                                 </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="checkbox" id="allOpenHour" onclick="allDaysHour('allOpenHour', 'day1','day2')"/> All Days 
                                                        </div>
                                                    </div>
                                                    <div style="clear : both"></div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                          <input type="checkbox" name="check2" id="check2" onclick="customShowDays('check2', 'day3','day4')" <?php if(isset($tue) && !empty($tue)):echo"checked";endif;?>/> Tuesday
                                                        </div>
                                                        <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                             <input id="day3" autocomplete="off" class="form-control timepicker" type="text" name="tue[]" <?php if(!isset($tue[0]) && empty($tue[0])):echo"disabled";endif;?> value="<?php if($tue){ echo $tue[0];} ?>">
                                                         </div>
                                                        </div>
                                                          <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="day4" autocomplete="off" class="form-control timepicker" type="text" name="tue[]" <?php if(!isset($tue[1]) && empty($tue[1])):echo"disabled";endif;?> value="<?php if($tue){ echo $tue[1];} ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                          <input type="checkbox" name="check3" id="check3" onclick="customShowDays('check3', 'day5','day6')" <?php if(isset($wed) && !empty($wed)):echo"checked";endif;?>/> Wednesday
                                                        </div>
                                                        <div class="col-md-3 clockpicker" data-autoclose="true">
                                                            <input id="day5" autocomplete="off" class="form-control timepicker" type="text" name="wed[]" <?php if(!isset($wed[0]) && empty($wed[0])):echo"disabled";endif;?> value="<?php if($wed){ echo $wed[0];} ?>">
                                                        </div>
                                                          <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="day6" autocomplete="off" class="form-control timepicker" type="text" name="wed[]" <?php if(!isset($wed[1]) && empty($wed[1])):echo"disabled";endif;?> value="<?php if($wed){ echo $wed[1];} ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                          <input type="checkbox" name="check4" id="check4" onclick="customShowDays('check4', 'day7','day8')" <?php if(isset($thu) && !empty($thu)):echo"checked";endif;?>/> Thursday
                                                        </div>
                                                        <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="day7" autocomplete="off" class="form-control timepicker" type="text" name="thu[]" <?php if(!isset($thu[0]) && empty($thu[0])):echo"disabled";endif;?> value="<?php if($thu){ echo $thu[0];} ?>">
                                                            </div>
                                                        </div>
                                                          <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="day8" autocomplete="off" class="form-control timepicker" type="text" name="thu[]" <?php if(!isset($thu[1]) && empty($thu[1])):echo"disabled";endif;?> value="<?php if($thu){ echo $thu[1];} ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                          <input type="checkbox" name="check5" id="check5" onclick="customShowDays('check5', 'day9','day10')" <?php if(isset($fri) && !empty($fri)):echo"checked";endif;?>/> Friday
                                                        </div>
                                                        <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="day9" autocomplete="off" class="form-control timepicker" type="text" name="fri[]" <?php if(!isset($fri[0]) && empty($fri[0])):echo"disabled";endif;?> value="<?php if($fri){ echo $fri[0];} ?>">
                                                            </div>
                                                        </div>
                                                          <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="day10" autocomplete="off" class="form-control timepicker" type="text" name="fri[]" <?php if(!isset($fri[1]) && empty($fri[1])):echo"disabled";endif;?> value="<?php if($fri){ echo $fri[1];} ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                          <input type="checkbox" name="check6" id="check6" onclick="customShowDays('check6', 'day11','day12')" <?php if(isset($sat) && !empty($sat)):echo"checked";endif;?>/> Saturday
                                                        </div>
                                                        <div class="col-md-3 clockpicker" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                             <input id="day11" autocomplete="off" class="form-control timepicker" type="text" name="sat[]" <?php if(!isset($sat[0]) && empty($sat[0])):echo"disabled";endif;?> value="<?php if($sat){ echo $sat[0];} ?>">
                                                         </div>
                                                        </div>
                                                          <div class="col-md-3 clockpicker" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="day12" autocomplete="off" class="form-control timepicker" type="text" name="sat[]" <?php if(!isset($sat[1]) && empty($sat[1])):echo"disabled";endif;?> value="<?php if($sat){ echo $sat[1];} ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                          <input type="checkbox" name="check7" id="check7" onclick="customShowDays('check7', 'day13','day14')" <?php if(isset($sun) && !empty($sun)):echo"checked";endif;?>/> Sunday
                                                        </div>
                                                        <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                             <input id="day13" autocomplete="off" class="form-control timepicker" type="text" name="sun[]" <?php if(!isset($sun[0]) && empty($sun[0])):echo"disabled";endif;?> value="<?php if($sun){ echo $sun[0];} ?>">
                                                         </div>
                                                        </div>
                                                          <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="day14" autocomplete="off" class="form-control timepicker" type="text" name="sun[]" <?php if(!isset($sun[1]) && empty($sun[1])):echo"disabled";endif;?> value="<?php if($sun){ echo $sun[1];} ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                      <input type="checkbox" name="check8" id="check8" onclick="customShowDays('check8', 'lunch1','lunch2')" <?php if(isset($lunchHours) && !empty($lunchHours)):echo"checked";endif;?>/> Break Hours
                                                    </div>
                                                    <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="lunch1" autocomplete="off" class="form-control timepicker" type="text" name="lunch[]" <?php if(!isset($lunchHours[0]) && empty($lunchHours[0])):echo"disabled";endif;?> value="<?php if($lunchHours){ echo $lunchHours[0];} ?>">
                                                        </div>
                                                    </div>
                                                      <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                         <input id="lunch2" autocomplete="off" class="form-control timepicker" type="text" name="lunch[]" <?php if(!isset($lunchHours[1]) && empty($lunchHours[1])):echo"disabled";endif;?> value="<?php if($lunchHours){ echo $lunchHours[1]; } ?>">
                                                     </div>
                                                    </div>
                                                </div>
                                                <div id="womenDiv" style="<?php if($userData->centerType == 0){ ?>display: none;"<?php } ?>>
                                                    <label  for="typehead">Separate Time Slots (For womens only)</label>
                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                          <input type="checkbox" name="check9" id="check9" onclick="customShowDays('check9', 'shift1','shift2')" <?php if(isset($shiftM) && !empty($shiftM)):echo"checked";endif;?>/> Morning Shift
                                                        </div>
                                                        <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="shift1" autocomplete="off" class="form-control timepicker" type="text" name="shiftM[]" <?php if(!isset($shiftM[0]) && empty($shiftM[0])):echo"disabled";endif;?> value="<?php if($shiftM){ echo $shiftM[0];} ?>">
                                                            </div>
                                                        </div>
                                                          <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="shift2" autocomplete="off" class="form-control timepicker" type="text" name="shiftM[]" <?php if(!isset($shiftM[1]) && empty($shiftM[1])):echo"disabled";endif;?> value="<?php if($shiftM){ echo $shiftM[1]; } ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                          <input type="checkbox" name="check10" id="check10" onclick="customShowDays('check10', 'shift3','shift4')" <?php if(isset($shiftE) && !empty($shiftE)):echo"checked";endif;?>/> Evening Shift
                                                        </div>
                                                        <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="shift3" autocomplete="off" class="form-control timepicker" type="text" name="shiftE[]" <?php if(!isset($shiftE[0]) && empty($shiftE[0])):echo"disabled";endif;?> value="<?php if($shiftE){ echo $shiftE[0];} ?>">
                                                            </div>
                                                        </div>
                                                          <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="shift4" autocomplete="off" class="form-control timepicker" type="text" name="shiftE[]" <?php if(!isset($shiftE[1]) && empty($shiftE[1])):echo"disabled";endif;?> value="<?php if($shiftE){ echo $shiftE[1]; } ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if(isset($userDatas) && !empty($userDatas)):
                                                        $womenDays =  unserialize($userData->womenDays);
                                                    endif; ?>
                                                    <div class="col-md-12">
                                                        <div class="col-md-1">
                                                            <input type="checkbox" name="womenDays[]" id="womenDays1" <?php if(isset($womenDays) && !empty($womenDays)):if(in_array("mon", $womenDays)):echo"checked";endif;endif;?> value="mon" /> <label>Mon</label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input type="checkbox" name="womenDays[]" id="womenDays2" <?php if(isset($womenDays) && !empty($womenDays)):if(in_array("tue", $womenDays)):echo"checked";endif;endif;?> value="tue" /> <label>Tue</label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input type="checkbox" name="womenDays[]" id="womenDays3" <?php if(isset($womenDays) && !empty($womenDays)):if(in_array("wed", $womenDays)):echo"checked";endif;endif;?> value="wed" /> <label>Wed</label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input type="checkbox" name="womenDays[]" id="womenDays4" <?php if(isset($womenDays) && !empty($womenDays)):if(in_array("thu", $womenDays)):echo"checked";endif;endif;?> value="thu" /> <label>Thu</label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input type="checkbox" name="womenDays[]" id="womenDays5" <?php if(isset($womenDays) && !empty($womenDays)):if(in_array("fri", $womenDays)):echo"checked";endif;endif;?> value="fri" /> <label>Fri</label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input type="checkbox" name="womenDays[]" id="womenDays6" <?php if(isset($womenDays) && !empty($womenDays)):if(in_array("sat", $womenDays)):echo"checked";endif;endif;?> value="sat" /> <label>Sat</label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input type="checkbox" name="womenDays[]" id="womenDays7" <?php if(isset($womenDays) && !empty($womenDays)):if(in_array("sun", $womenDays)):echo"checked";endif;endif;?> value="sun" /> <label>Sun</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(isset($userDatas) && !empty($userDatas)):
                                                $serviceNames =  unserialize($userData->serviceNames);
                                        endif;  ?>
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <label  for="typehead">What all services do you provide ?</label>
                                                <div class="col-md-12">
                                                <?php foreach($services as $service){?>
                                                    <div class="col-md-4 servicesId"><input type="checkbox" name="services[]" id="<?php echo $service->serviceName; ?>" value="<?php echo $service->serviceId; ?>" <?php if(isset($serviceNames) && !empty($serviceNames)):if(in_array($service->serviceId, $serviceNames)):echo"checked";endif;endif;?> /> <?php echo $service->serviceName; ?></div>
                                                <?php } ?>
                                                </div>
                                                <div style="clear : both"></div>
                                                <div class="col-md-12" style="display: none" id="serviceOther">
                                                    <label>Other's *</label>
                                                    <div class="col-md-12"><input type="text" class="form-control"/></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>