<style>
    .bootstrap-select.btn-group .dropdown-menu {
        width: 100px !important;
    }
    .m-top-20 {
     margin: 10px 0px ;   
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>Swimming</h3>
                </div>
                <div class="ibox-content">
                    <form method="POST" id="serviceForm" class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url(); ?>/partners/swimming">
                        <div class="hr-line-dashed"></div> 
                        <input type="hidden" class="form-control" name="featureId" required="" value="">
                        <div class="row">
                            <input type="hidden" name="fkServiceId" id="fkServiceId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkServiceId;endif;?>">
                            <input type="hidden" name="fkVendorId" id="fkVendorId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkVendorId;endif;?>">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Brief description about your centre *</label>
                                        <textarea required="required" rows="4" class="form-control" id="adoutService" name="adoutService"><?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->adoutService;endif;?></textarea>
                                        <input type="hidden" name="swimId" id="swimId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->swimId;endif;?>">
                                        <span class="has-error"><?php echo form_error("adoutService"); ?></span>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Please mention if you  have received any Award/Accolades or hold any record?</label>
                                        <input id="aerobicsAward" name="awards" type="text" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->awards;endif;?>">
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <label>How many trainers do you have ? *</label>
                                    <input id="trainer" name="trainer" type="tel" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->trainer;endif;?>" maxlength="2" onkeypress="return isNumberKey(event,'mobileErr')" required="">
                                    <span class="has-error"><?php echo form_error("trainer"); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <label>What is the total experience of your trainer in this field (in no. of years)? *</label>
                                    <input id="aerobicsExperience" name="experience" type="text" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->experience;endif;?>" placeholder="Please mention about the most experienced trainer " maxlength="2" onkeypress="return isNumberKey(event,'mobileErr')" required="">
                                    <span class="has-error"><?php echo form_error("experience"); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-lg-12">
                                    <label>What are the dimensions of your swimming pool (in feet) ? *</label>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                    
                                   
                                        <?php if(isset($serviceData) && !empty($serviceData)):
                                            $dimensions =  unserialize($serviceData[0]->dimensions);
                                        endif; ?>
                                        <div class="col-lg-3">
                                            <input id="dimensionsLength" name="dimensions[]" type="text" class="form-control" value="<?php if(isset($dimensions[0])){ echo $dimensions[0];}else{ echo "";} ?>" placeholder="Length" maxlength="2" onkeypress="return isNumberKey(event,'er_dimensions')" required="">
                                        </div>
                                        <div class="col-lg-3">
                                            <input id="dimensionsBreadth" name="dimensions[]" type="text" class="form-control" value="<?php if(isset($dimensions[1])){ echo $dimensions[1];}else{ echo "";} ?>" placeholder="Breadth" maxlength="2" onkeypress="return isNumberKey(event,'er_dimensions')" required="">
                                        </div>
                                        <div class="col-lg-3">
                                            <input id="dimensionsHdepth" name="dimensions[]" type="text" class="form-control" value="<?php if(isset($dimensions[2])){ echo $dimensions[2];}else{ echo "";} ?>" placeholder="Highest depth" maxlength="2" onkeypress="return isNumberKey(event,'er_dimensions')" required="">
                                        </div>
                                        <div class="col-lg-3">
                                            <input id="dimensionsLdepth" name="dimensions[]" type="text" class="form-control" value="<?php if(isset($dimensions[3])){ echo $dimensions[3];}else{ echo "";} ?>" placeholder="Lowest depth" maxlength="2" onkeypress="return isNumberKey(event,'er_dimensions')" required="">
                                        </div>
                                        <span class="has-error" id="er_dimensions"><?php echo form_error("dimensions[]"); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>How regularly you change pool water ? *</label><br/>
<!--                                        <textarea name="changeWaterPool" id="changeWaterPool" class="t-f-full"><?php //if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->changeWaterPool;endif;?></textarea>-->
                                        <select  name="changeWaterPool" id="changeWaterPool" class="bs-select form-control required" data-size="4" title=""  required="">
                                            <option value="Daily" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->changeWaterPool == "Daily"):echo"selected";endif;endif;?> >Daily</option>

                                            <option value="Alternate days" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->changeWaterPool == "Alternate days"):echo"selected";endif;endif;?> >Alternate days</option>

                                            <option value="Weekly" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->changeWaterPool == "Weekly"):echo"selected";endif;endif;?> >Weekly</option>

                                            <option value="Fortnightly" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->changeWaterPool == "Fortnightly"):echo"selected";endif;endif;?> >Fortnightly</option>

                                            <option value="Monthly" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->changeWaterPool == "Monthly"):echo"selected";endif;endif;?> >Monthly</option>
                                        </select>
                                        <span class="has-error"><?php echo form_error("changeWaterPool"); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <?php if(isset($serviceData) && !empty($serviceData)):
                                        $amenities =  unserialize($serviceData[0]->amenities);
                                endif; ?>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="icheck-inline">
                                            <label>What are the amenities your centre have? *</label>
                                            <div >
                                                <input type="checkbox" value="Locker" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Locker", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities1"  class="multiCheckbox" >
                                                <label>Locker</label>

                                                <input type="checkbox" value="Covered_pool" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Covered_pool", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities2" class="multiCheckbox"  >
                                                <label>Covered pool</label>

                                                <input type="checkbox"  value="Open_pool" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Open_pool", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities3" class="multiCheckbox">
                                                <label>Open pool</label>

                                                <input type="checkbox" value="Change room" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Change room", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities4" class="multiCheckbox" >
                                                <label>Change room </label>

                                                <input type="checkbox" value="Common change room" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Common change room", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities5" class="multiCheckbox">
                                                <label>Common change room</label>

                                                <input type="checkbox" value="Parking" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Parking", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities6" class="multiCheckbox" >
                                                <label>Parking</label>

                                                <input type="checkbox" value="Personal Trainer" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Personal Trainer", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities7" class="multiCheckbox">
                                                <label>Personal Trainer</label>

                                                <input type="checkbox" value="Spa_Sona" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Spa_Sona", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities8" class="multiCheckbox" >
                                                <label>Spa/Sauna</label>

                                                <input type="checkbox" value="Swimming Training Aids" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Swimming Training Aids", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities9" class="multiCheckbox" >
                                                <label>Swimming Training Aids(tube ,kick board,pull buoy,hand paddle,finger paddle,technique aids)</label>

                                                <input type="checkbox" value="Separate time" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Separate time", $amenities)):echo"checkbox";endif;endif;?> name="amenities[]" id="amenities10" class="multiCheckbox">
                                                <label>Separate time slot for women / children</label>

                                                <input type="checkbox" value="Security" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Security", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities11" class="multiCheckbox" >
                                                <label>Security</label>

                                                <input type="checkbox" value="First Aid" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("First Aid", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities12" class="multiCheckbox">
                                                <label>First Aid</label>

                                            </div>
                                            <span class="has-error"><?php echo form_error("amenities[]"); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <?php if(isset($serviceData) && !empty($serviceData)):
                                    $categories =  unserialize($serviceData[0]->categories);
                                endif; ?>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="icheck-inline">
                                            <label>Which categories of Swimming do you teach? *</label><br>
                                                
                                                <input type="checkbox" value="Front Crawl" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Front Crawl", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories1" class="multiCheckbox">
                                                <label>Front Crawl</label>
                                                
                                                <input type="checkbox" value="Back stroke" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Back stroke", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories2" class="multiCheckbox">
                                                <label>Back stroke</label>

                                                <input type="checkbox" value="Breast stroke" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Breast stroke", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories3" class="multiCheckbox">
                                                <label>Breast stroke</label>

                                                <input type="checkbox" value="Butterfly" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Butterfly", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories4" class="multiCheckbox">
                                                <label>Butterfly</label>

                                                <input type="checkbox" value="Side stroke" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Side stroke", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories5" class="multiCheckbox">
                                                <label>Side stroke</label>

                                                <input type="checkbox" value="Freestyle" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Freestyle", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories6" class="multiCheckbox">
                                                <label>Freestyle</label>

                                            <span class="has-error"><?php echo form_error("categories[]"); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if(isset($serviceData) && !empty($serviceData)):
                                    $male =  unserialize($serviceData[0]->male);
                                    $female =  unserialize($serviceData[0]->female);
                                    $kids =  unserialize($serviceData[0]->kids); 
                                    $common =  unserialize($serviceData[0]->common); 
                                    endif; ?>
                                <div class="col-lg-12">
                                    <div class="col-md-12"> 
                                        <div class="form-group">
                                            <label  for="typehead">Operating time slots ? *</label>
                                            <div id="male_Div">
                                                <div class="col-md-12" id="maleSlotDiv_1">
                                                    <div class="col-md-2 timeSlotClass" >
                                                        <input type="checkbox" name="timeSlot" id="maleC" onclick="customShowDays('maleC', 'maleStartTime_1','maleEndTime_1','male')" <?php if(isset($male[0]) && !empty($male[0]) && isset($male[1]) && !empty($male[1])):echo"checked";endif;?>/> Male
                                                        <input type="hidden" name="male_slots" id="male_slots" value="1">
                                                    </div>
                                                    <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="maleStartTime_1" autocomplete="off" class="form-control timepicker" type="text" name="male[]" <?php if(!isset($male[0]) && empty($male[0])):echo"disabled";endif;?> value="<?php if(isset($male[0])){ echo $male[0];}else{ echo "";} ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="maleEndTime_1" autocomplete="off" class="form-control timepicker" type="text" name="male[]" <?php if(!isset($male[1]) && empty($male[1])):echo"disabled";endif;?> value="<?php if(isset($male[1])){ echo $male[1];}else{ echo "";} ?>">
                                                        </div>
                                                    </div>

                                                        <div class="col-md-2 addShift_male <?php if(!isset($male[1]) && empty($male[1])):echo"hide";endif;?>">
                                                        <a href="javascript:;" class="add btn btn-success" onclick="addNewSlot('male');" id="maleSlotAdd_1"> <i class="fa fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="clear : both"></div>
                                            
                                            <div id="female_Div">
                                                <div class="col-md-12 m-top-10" id="femaleSlotDiv_1">
                                                    <div class="col-md-2 timeSlotClass" >
                                                        <input type="checkbox" name="timeSlot" id="femaleC" onclick="customShowDays('femaleC', 'femaleStartTime_1','femaleEndTime_1','female')" <?php if(isset($female[0]) && !empty($female[0]) && isset($female[1]) && !empty($female[1])):echo"checked";endif;?>/> Female
                                                        <input type="hidden" name="female_slots" id="female_slots" value="1">
                                                    </div>
                                                    <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="femaleStartTime_1" autocomplete="off" class="form-control timepicker" type="text" name="female[]" <?php if(!isset($female[0]) && empty($female[0])):echo"disabled";endif;?> value="<?php if(isset($female[0])){ echo $female[0];}else{ echo "";} ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="femaleEndTime_1" autocomplete="off" class="form-control timepicker" type="text" name="female[]" <?php if(!isset($female[1]) && empty($female[1])):echo"disabled";endif;?> value="<?php if(isset($female[1])){ echo $female[1];}else{ echo "";} ?>">
                                                        </div>
                                                    </div>

                                                        <div class="col-md-2 addShift_female <?php if(!isset($female[1]) && empty($female[1])):echo"hide";endif;?>">
                                                        <a href="javascript:;" class="add btn btn-success" onclick="addNewSlot('female');" id="femaleSlotAdd_1"> <i class="fa fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                              
                                            <div style="clear : both"></div>
                                            <div id="kids_Div">
                                                <div class="col-md-12 m-top-10" id="kidsSlotDiv_1">
                                                    <div class="col-md-2 timeSlotClass" >
                                                        <input type="checkbox" name="timeSlot" id="kidsC" onclick="customShowDays('kidsC', 'kidsStartTime_1','kidsEndTime_1','kids')" <?php if(isset($kids[0]) && !empty($kids[0]) && isset($kids[1]) && !empty($kids[1])):echo"checked";endif;?>/> Kids
                                                        <input type="hidden" name="kids_slots" id="kids_slots" value="1">
                                                    </div>
                                                    <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="kidsStartTime_1" autocomplete="off" class="form-control timepicker" type="text" name="kids[]" <?php if(!isset($kids[0]) && empty($kids[0])):echo"disabled";endif;?> value="<?php if(isset($kids[0])){ echo $kids[0];}else{ echo "";} ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3" data-autoclose="true">
                                                        <div class="bootstrap-timepicker input-group">
                                                            <input id="kidsEndTime_1" autocomplete="off" class="form-control timepicker" type="text" name="kids[]" <?php if(!isset($kids[1]) && empty($kids[1])):echo"disabled";endif;?> value="<?php if(isset($kids[1])){ echo $kids[1];}else{ echo "";} ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 addShift_kids <?php if(!isset($kids[1]) && empty($kids[1])):echo"hide";endif;?>" >
                                                        <a href="javascript:;" class="add btn btn-success" onclick="addNewSlot('kids');" id="kidsSlotAdd_1"> <i class="fa fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                      
                                            <div class="col-md-12  m-top-10">
                                                <div class="col-md-2">
                                                  <input type="checkbox" name="timeSlot" id="commonC" onclick="customShowDays('commonC', 'day13','day14')" <?php if(isset($common[0]) && !empty($common[0]) && isset($common[1]) && !empty($common[1])):echo"checked";endif;?>/> Common
                                                </div>
                                                <div class="col-md-3" data-autoclose="true">
                                                    <div class="bootstrap-timepicker input-group">
                                                        <input id="day13" autocomplete="off" class="form-control timepicker" type="text" name="common[]" <?php if(!isset($common[0]) && empty($common[0])):echo"disabled";endif;?> value="<?php if(isset($common[0])){ echo $common[0];}else{ echo ""; } ?>">
                                                  </div>
                                                </div>

                                                <div class="col-md-3" data-autoclose="true">
                                                    <div class="bootstrap-timepicker input-group">
                                                        <input id="day14" autocomplete="off" class="form-control timepicker" type="text" name="common[]" <?php if(!isset($common[1]) && empty($common[1])):echo"disabled";endif;?> value="<?php if(isset($common[1])){ echo $common[1];}else{ echo ""; } ?>">
                                                   </div>
                                                </div>
                                            </div>
                                    </div>
                                </div> 
                             </div>
                                <?php if(isset($serviceData) && !empty($serviceData)):
                                          $chargeType =  unserialize($serviceData[0]->chargeType);
                                          $chargeAmount =  unserialize($serviceData[0]->chargeAmount);
                                 endif;?>
                            <div class="col-md-12"> 
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label  for="typehead">Swimming Charges *</label>
                                    <div class="has-error m-left-30" id="chargesErr"><?php echo form_error("centerContact"); ?></div>
                                    <div class="col-md-12">
                                        <div class="col-md-4 charges"><input type="checkbox" name="chargeType[]" id="perSession" onclick="customShow('perSession', 'perSessionDiv')" value="Per Hour" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per Hour", $chargeType)):echo"checked";endif;endif;?>/> Per Hour </div>

                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per Hour", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perSessionDiv" ><input maxlength="100" id="perSessionText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Hour", $chargeAmount)):echo $chargeAmount['Per Hour'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    
                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="perDay" onclick="customShow('perDay', 'perDayDiv')" value="Per Day" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per Day", $chargeType)):echo"checked";endif;endif;?>/> Per Day</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per Day", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perDayDiv"><input maxlength="50" id="perDayText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Day", $chargeAmount)):echo $chargeAmount['Per Day'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>

                                    <div style="clear : both"></div>

                                    <div class="col-md-12  m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="perVisit" onclick="customShow('perVisit', 'perVisitDiv')" value="Weekly" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Weekly", $chargeType)):echo"checked";endif;endif;?>/> Weekly </div>
                                        
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Weekly", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perVisitDiv"><input maxlength="50" id="perVisitText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Weekly", $chargeAmount)):echo $chargeAmount['Weekly'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>


                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="perMonth" onclick="customShow('perMonth', 'perMonthDiv')" value="Per Month" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per Month", $chargeType)):echo"checked";endif;endif;?>/> Per Month</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per Month", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perMonthDiv"><input maxlength="50" id="perMonthText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Month", $chargeAmount)):echo $chargeAmount['Per Month'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    <div class="col-md-12  m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="bimonthly" onclick="customShow('bimonthly', 'bimonthlyDiv')" value="Bimonthly" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Bimonthly", $chargeType)):echo"checked";endif;endif;?>/> Bimonthly</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Bimonthly", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="bimonthlyDiv"><input maxlength="50" id="bimonthlyText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Bimonthly", $chargeAmount)):echo $chargeAmount['Bimonthly'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    <div class="col-md-12  m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="quarterly" onclick="customShow('quarterly', 'quarterlyDiv')" value="Quarterly" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Quarterly", $chargeType)):echo"checked";endif;endif;?>/> Quarterly</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Quarterly", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="quarterlyDiv"><input maxlength="50" id="quarterlyText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Quarterly", $chargeAmount)):echo $chargeAmount['Quarterly'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    <div class="col-md-12  m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="halfYearly" onclick="customShow('halfYearly', 'halfYearlyDiv')" value="Half Yearly" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Half Yearly", $chargeType)):echo"checked";endif;endif;?>/> Half Yearly</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Half Yearly", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="halfYearlyDiv"><input maxlength="50" id="halfYearlyText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Half Yearly", $chargeAmount)):echo $chargeAmount['Half Yearly'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    <div class="col-md-12  m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="annually" onclick="customShow('annually', 'annuallyDiv')" value="Annually" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Annually", $chargeType)):echo"checked";endif;endif;?>/> Annually</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Annually", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="annuallyDiv"><input maxlength="50" id="annuallyText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Annually", $chargeAmount)):echo $chargeAmount['Annually'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Select currency ?</label>
                                    <select  name="currency" id="currency" class="bs-select form-control" data-size="4" title="Currency"  >
                                        <option value="INR" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->currency == "INR"):echo"selected";endif;endif;?>>Indian(INR)</option>
                                        <option value="LKR" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->currency == "LKR"):echo"selected";endif;endif;?>>Sri Lanka(LKR)</option>
                                        <option value="AED" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->currency == "AED"):echo"selected";endif;endif;?>>Dubai(AED)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <button class="btn btn-primary" type="submit" name="submit" value="editFeature">Save changes</button>
                                <button class="btn btn-info" type="reset">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>