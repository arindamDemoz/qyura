<style>
    .footer{
        position: relative !important;
    }
</style>
<div id="wrapper">
    <div  class="gray-bg wrapper">
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <a href="<?php echo site_url('partners'); ?>"><img src="<?php echo base_url(); ?>assest/img/froyologo.png" alt="FroyoFit" style="width: 16%; margin-top: 1%; margin-bottom: -1%;"></a>
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
                            <h5>Partner Signup</h5>
                        </div>
                        <div class="ibox-content">
<!--                                <h2>
                                Vendor
                            </h2>-->
<!--                                <p>

                            </p>-->

                            <form id="form" method="POST" action="<?php echo site_url(); ?>/partners/vendorSaveFn" class="wizard-big" enctype="multipart/form-data">
                                <h1>General :</h1>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Centre Name *</label>
                                                    <label class="has-error" id="err_centerName"><?php echo form_error("centerName"); ?></label>
                                                    <input id="centerName" name="centerName" type="text" class="form-control required" placeholder="Your Centre Name" onblur="return checkText('centerName','err_centerName')">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Centre Address *</label>
                                                    <label class="has-error"><?php echo form_error("centerAddress"); ?></label>
                                                    <input type="text" name="centerAddress" class="form-control required" placeholder="Your Centre Address" id="centerAddress" value="<?php echo set_value('centerAddress'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Centre Email Id *</label>
                                                    <label class="has-error" id="err_centerEmail"><?php echo form_error("centerEmail"); ?></label>
                                                    <input id="centerEmail" name="centerEmail" type="email" class="form-control required" placeholder="Your Centre Email" onblur="return checkEmailBlur('centerEmail','err_centerEmail')">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Centre Contact No *</label>
                                                    <label class="has-error" id="centreContactErr"><?php echo form_error("centerContact"); ?></label>
                                                    <input id="centerContact" name="centerContact" type="tel" class="form-control required" placeholder="Your Centre Mobile" onkeypress="return isNumberKey(event,'centreContactErr')" maxlength="11" onblur="return checkPhone('centerContact','centreContactErr')">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Password *</label>
                                                    <label class="has-error" id="er_password"><?php echo form_error("password"); ?></label>
                                                    <input id="password" name="password" type="password" class="form-control required" placeholder="Password" onblur="checkPassword('password','confirm');">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Confirm Password *</label>
                                                    <label class="has-error" id="er_confirm"><?php echo form_error("password"); ?></label>
                                                    <input id="confirm" name="confirm" type="password" class="form-control required" placeholder="Re-Type Password" onblur="checkConfirm('password','confirm');" >
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Contact person Name  *</label>
                                                    <label class="has-error" id="err_coperson"><?php echo form_error("contactPersonName"); ?></label>
                                                    <input type="text" id="contactPersonName" name="contactPersonName" class="form-control required" placeholder="Your Name" onkeypress="return isAlpha(event,this.value)" onblur="return checkText('contactPersonName','err_coperson')">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Contact Mobile phone *</label>
                                                    <label class="has-error" id="mobileErr"><?php echo form_error("contactMobile"); ?></label>
                                                    <input id="contactMobile" name="contactMobile" type="tel" class="form-control required" placeholder="Your Mobile" onkeypress="return isNumberKey(event,'mobileErr')" maxlength="11" onblur="return checkPhone('contactMobile','mobileErr')">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Contact Person email id *</label>
                                                    <label class="has-error" id="err_contactEmail"><?php echo form_error("contactEmail"); ?></label>
                                                    <input id="contactEmail" name="contactEmail" type="email" class="form-control required" placeholder="Your Email" onblur="return checkEmailBlur('contactEmail','err_contactEmail')">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Languages Known *</label>
                                                    <label class="has-error" ><?php echo form_error("selectLanguage"); ?></label>
                                                    <select name="selectLanguage[]" id="selectLanguage" class="bs-select form-control required" data-size="auto" data-live-search="true" title="Languages"  multiple="">
                                                        <option value="hindi">Hindi</option>
                                                        <option value="english">English</option>
                                                        <option value="marathi">Marathi</option>
                                                        <option value="kannada">Kannada</option>
                                                        <option value="tamil">Tamil</option>
                                                        <option value="telgu">Telgu</option>
                                                        <option value="malayalam">Malayalam</option>
                                                        <option value="arabic">Arabic</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Facebook Id</label>
                                                    <label class="has-error"><?php echo form_error("fbId"); ?></label>
                                                    <input id="fbId" name="fbId" type="text" class="form-control " placeholder="Your Facebook Id" >
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Twitter Id</label>
                                                    <label class="has-error"><?php echo form_error("contactEmail"); ?></label>
                                                    <input id="twitId" name="twitId" type="text" class="form-control " placeholder="Your Twitter Id" >
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
                                                        <option value="1">Yes</option>
                                                        <option selected="" value="0">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<button onclick="checkEmailExist('centerEmail','err_centerEmail')">Click</button>-->
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
                                                          <input type="checkbox" name="check1" id="check1" onclick="customShowDays('check1', 'day1','day2')"/> Monday
                                                        </div>

                                                        <div class=" col-lg-3">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input type="text" id="day1" class="form-control timepicker" name="mon[]" disabled="" />
                                                            </div>
                                                        </div>

                                                        <div class=" col-lg-3">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input type="text" id="day2" class="form-control timepicker" name="mon[]" disabled="" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <input type="checkbox" id="allOpenHour" onclick="allDaysHour('allOpenHour', 'day1','day2')"/> All Days 
                                                        </div>
                                                    </div>
                                                    
                                                    <div style="clear : both"></div>
                                                    <div class="col-md-12">

                                                       <div class="col-md-3">
                                                         <input type="checkbox" name="check2" id="check2" onclick="customShowDays('check2', 'day3','day4')"/> Tuesday
                                                       </div>

                                                       <div class="col-md-3" data-autoclose="true">
                                                          <div class="bootstrap-timepicker input-group">
                                                              <input id="day3" autocomplete="off" class="form-control timepicker" type="text" name="tue[]" disabled="" class="" >
                                                           </div>
                                                       </div>

                                                         <div class="col-md-3" data-autoclose="true">
                                                            <div class="bootstrap-timepicker input-group">
                                                                <input id="day4" autocomplete="off" class="form-control timepicker" type="text" name="tue[]" disabled="">
                                                            </div>
                                                       </div>
                                                   </div>

                                                    <div class="col-md-12">

                                                      <div class="col-md-3">
                                                        <input type="checkbox" name="check3" id="check3" onclick="customShowDays('check3', 'day5','day6')"/> Wednesday
                                                      </div>

                                                      <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="day5" autocomplete="off" class="form-control timepicker" type="text" name="wed[]" disabled="" value="">
                                                        </div>
                                                      </div>

                                                        <div class="col-md-3" data-autoclose="true">
                                                           <div class="bootstrap-timepicker input-group">
                                                              <input id="day6" autocomplete="off" class="form-control timepicker" type="text" name="wed[]" disabled="">
                                                           </div>
                                                      </div>
                                                  </div>
                                                    <div class="col-md-12">

                                                      <div class="col-md-3">
                                                        <input type="checkbox" name="check4" id="check4" onclick="customShowDays('check4', 'day7','day8')"/> Thursday
                                                      </div>

                                                      <div class="col-md-3" data-autoclose="true">
                                                          <div class="bootstrap-timepicker input-group">
                                                            <input id="day7" autocomplete="off" class="form-control timepicker" type="text" name="thu[]" disabled="">
                                                          </div>
                                                      </div>

                                                        <div class="col-md-3" data-autoclose="true">
                                                          <div class="bootstrap-timepicker input-group">
                                                              <input id="day8" autocomplete="off" class="form-control timepicker" type="text" name="thu[]" disabled="">
                                                          </div>
                                                      </div>
                                                  </div>
                                                    <div class="col-md-12">

                                                      <div class="col-md-3">
                                                        <input type="checkbox" name="check5" id="check5" onclick="customShowDays('check5', 'day9','day10')"/> Friday
                                                      </div>

                                                      <div class="col-md-3" data-autoclose="true">
                                                          <div class="bootstrap-timepicker input-group">
                                                              <input id="day9" autocomplete="off" class="form-control timepicker" type="text" name="fri[]" disabled="">
                                                          </div>
                                                      </div>

                                                        <div class="col-md-3" data-autoclose="true">
                                                          <div class="bootstrap-timepicker input-group">
                                                              <input id="day10" autocomplete="off" class="form-control timepicker" type="text" name="fri[]" disabled="">
                                                          </div>
                                                      </div>
                                                  </div>
                                                    <div class="col-md-12">

                                                      <div class="col-md-3">
                                                        <input type="checkbox" name="check6" id="check6" onclick="customShowDays('check6', 'day11','day12')"/> Saturday
                                                      </div>

                                                      <div class="col-md-3" data-autoclose="true">
                                                          <div class="bootstrap-timepicker input-group">
                                                              <input id="day11" autocomplete="off" class="form-control timepicker" type="text" name="sat[]" disabled="">
                                                          </div>
                                                      </div>

                                                        <div class="col-md-3 " data-autoclose="true">
                                                          <div class="bootstrap-timepicker input-group">
                                                              <input id="day12" autocomplete="off" class="form-control timepicker" type="text" name="sat[]" disabled="">
                                                          </div>
                                                      </div>
                                                  </div>

                                                    <div class="col-md-12">
                                                      <div class="col-md-3">

                                                        <input type="checkbox" name="check7" id="check7" onclick="customShowDays('check7', 'day13','day14')"/> Sunday
                                                      </div>

                                                      <div class="col-md-3" data-autoclose="true">
                                                         <div class="bootstrap-timepicker input-group">
                                                            <input id="day13" autocomplete="off" class="form-control timepicker" type="text" name="sun[]" disabled="">
                                                         </div>
                                                      </div>

                                                        <div class="col-md-3" data-autoclose="true">
                                                          <div class="bootstrap-timepicker input-group">
                                                              <input id="day14" autocomplete="off" class="form-control timepicker" type="text" name="sun[]" disabled="">
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                      <input type="checkbox" name="check8" id="check8" onclick="customShowDays('check8', 'lunch1','lunch2')"/> Break Hours
                                                    </div>
                                                    <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="lunch1" autocomplete="off" class="form-control timepicker" type="text" name="lunch[]" disabled="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="lunch2" autocomplete="off" class="form-control timepicker" type="text" name="lunch[]" disabled="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="womenDiv" style="display: none;">
                                                <label  for="typehead">Separate Time Slots (For womens only)</label>
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name="check9" id="check9" onclick="customShowDays('check9', 'shift1','shift2')"/> Morning Shift
                                                    </div>

                                                    <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="shift1" autocomplete="off" class="form-control timepicker" type="text" name="shiftM[]" disabled="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="shift2" autocomplete="off" class="form-control timepicker" type="text" name="shiftM[]" disabled="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name="check10" id="check10" onclick="customShowDays('check10', 'shift3','shift4')"/> Evening Shift
                                                    </div>

                                                    <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="shift3" autocomplete="off" class="form-control timepicker" type="text" name="shiftE[]" disabled="">
                                                       </div>
                                                    </div>
                                                    <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="shift4" autocomplete="off" class="form-control timepicker" type="text" name="shiftE[]" disabled="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-1">
                                                        <input type="checkbox" name="womenDays[]" id="womenDays1" value="mon" /> <label>Mon</label>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="checkbox" name="womenDays[]" id="womenDays2" value="tue" /> <label>Tue</label>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="checkbox" name="womenDays[]" id="womenDays3" value="wed" /> <label>Wed</label>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="checkbox" name="womenDays[]" id="womenDays4" value="thu" /> <label>Thu</label>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="checkbox" name="womenDays[]" id="womenDays5" value="fri" /> <label>Fri</label>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="checkbox" name="womenDays[]" id="womenDays6" value="sat" /> <label>Sat</label>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="checkbox" name="womenDays[]" id="womenDays7" value="sun" /> <label>Sun</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <label  for="typehead">What all services do you provide ?</label>
                                                <div class="col-md-12">
                                                <?php foreach($services as $service){?>
                                                    <div class="col-md-4 servicesId"><input type="checkbox" name="services[]" id="<?php echo $service->serviceName; ?>" value="<?php echo $service->serviceId; ?>"/> <?php echo $service->serviceName; ?></div>
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