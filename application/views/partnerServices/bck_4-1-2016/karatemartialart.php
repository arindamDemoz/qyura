<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>Karate/ martial arts</h3>
                </div>

                <div class="ibox-content">
                    <form method="POST" id="serviceForm" class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url(); ?>/partners/karateMartialart">
                        <div class="hr-line-dashed"></div> 
                        <input type="hidden" class="form-control" name="featureId" required="" value="">
                        <div class="row">
                            <input type="hidden" name="fkServiceId" id="fkServiceId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkServiceId;endif;?>">
                            <input type="hidden" name="fkVendorId" id="fkVendorId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkVendorId;endif;?>">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>About Karate/ Martial arts </label>
                                        <textarea rows="4" class="form-control" id="adoutService" name="adoutService"><?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->adoutService;endif;?></textarea>
                                        <input type="hidden" name="karaId" id="karaId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->karaId;endif;?>">
                                    </div>
                                </div>
                            </div> 
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Please mention if you  have received any award or hold any record(level) ?</label>
                                        <input id="aerobicsAward" name="awards" type="text" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->awards;endif;?>">
                                    </div>
                                  
                                </div>
                               
                            </div>
                            <div class="col-md-12">
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                    <label>What is your total experience in this field (in no. of years)? *</label>
                                    <input id="aerobicsExperience" name="experience" type="text" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->experience;endif;?>" required="">
                                    <span class="has-error"><?php echo form_error("experience"); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                      <div class="form-group">
                                        <div class="icheck-inline">
                                            <label>
                                               Have you attended any institute for learning or from personal teacher?<br>
                                                <label>
                                                <input type="radio" name="ifPersonalTrainer"  class="icheck" value="1" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->ifPersonalTrainer == 1):echo"checked";endif;endif;?> onclick="showHideFiled('personal_trainers', 1)"> Yes </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <label>
                                                <input type="radio" name="ifPersonalTrainer"  class="icheck deposit" value="0" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->ifPersonalTrainer == 0):echo"checked";endif;endif;?> onclick="showHideFiled('personal_trainers', 0)"> No </label>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-lg-6" id="personal_trainers" <?php if(isset($serviceData) && !empty($serviceData)){if($serviceData[0]->ifPersonalTrainer == 1){ echo "style='display:block'"; }else{ echo"style='display:none'"; } }?>>
                              <div class="form-group">
                                    <label>Name of institute for learning or from personal teacher ?</label>
                                    <input id="personalTrainer" name="personalTrainer" type="text" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->personalTrainer;endif;?>">
                                    </div>
                            </div>
                            </div>

                            

                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Brief Description about you/ your centre ? *</label><br/>
                                        <textarea name="aboutUs" id="aerobicsUserDescription"  class="t-f-full" required=""><?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->aboutUs;endif;?></textarea>
                                        <span class="has-error"><?php echo form_error("aboutUs"); ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php if(isset($serviceData) && !empty($serviceData)):
                                        $ageGroup =  unserialize($serviceData[0]->ageGroup);
                                endif; ?>
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <div class="icheck-inline">
                                        <label>Which age group you cater to? *</label><br>
                                            
                                            <input type="checkbox" value="Below 10" <?php if(isset($serviceData) && !empty($serviceData) && is_array($ageGroup)):if(in_array("Below 10", $ageGroup)):echo"checked";endif;endif;?> name="ageGroup[]" id="ageGroup1" class="multiCheckbox">
                                            <label>Below 10</label>
                                            
                                            <input type="checkbox" value="10-25" <?php if(isset($serviceData) && !empty($serviceData) && is_array($ageGroup)):if(in_array("10-25", $ageGroup)):echo"checked";endif;endif;?> name="ageGroup[]" id="ageGroup2" class="multiCheckbox">
                                            <label>10-25</label>
                                            
                                            <input type="checkbox" value="Above 25" <?php if(isset($serviceData) && !empty($serviceData) && is_array($ageGroup)):if(in_array("Above 25", $ageGroup)):echo"checked";endif;endif;?> name="ageGroup[]" id="ageGroup3" class="multiCheckbox">
                                            <label>Above 25</label>
                                            
                                        <span class="has-error"><?php echo form_error("ageGroup[]"); ?></span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <?php if(isset($serviceData) && !empty($serviceData)):
                                    $amenities =  unserialize($serviceData[0]->amenities);
                            endif; ?>
                            <div class="col-md-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="icheck-inline">
                                            <label>What amenities your centre has? *</label><br>
                                                
                                            <input type="checkbox" value="Change Room" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Change Room", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities1" class="multiCheckbox">
                                            <label>Change Room</label>
                                                
                                            <input type="checkbox" value="Medical Aid" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Medical Aid", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities2" class="multiCheckbox">
                                            <label>Medical Aid</label>

                                            <input type="checkbox" value="Locker" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Locker", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities3" class="multiCheckbox">
                                            <label>Locker</label>

                                            <input type="checkbox" value="Personal trainer" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Personal trainer", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities4" class="multiCheckbox">
                                            <label>Personal trainer</label>

                                            <input type="checkbox" value="Group classes" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Group classes", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities5" class="multiCheckbox">
                                            <label>Group classes</label>

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
                                            <label>Which categories of karate/martial arts do you teach? *</label><br>
                                                
                                            <input type="checkbox" value="Shotokan" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Shotokan", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories1" class="multiCheckbox">
                                            <label>Shotokan – Ryu</label>
                                                
                                            <input type="checkbox" value="Contemporary" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Contemporary", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories2" class="multiCheckbox">
                                            <label>Contemporary</label>

                                            <input type="checkbox" value="Chito" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Chito", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories3" class="multiCheckbox">
                                            <label>Chito – Ryu</label>
                                            
                                            <input type="checkbox" value="Shito" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Shito", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories4" class="multiCheckbox">
                                            <label>Shito – Ryu</label>

                                            <input type="checkbox" value="Goju" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Goju", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories5" class="multiCheckbox">
                                            <label>Goju – Ryu</label>

                                            <input type="checkbox" value="Wado" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Wado", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories6" class="multiCheckbox">
                                            <label>Wado – Ryu</label>

                                            <input type="checkbox" value="Shorin" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Shorin", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories7" class="multiCheckbox">
                                            <label>Shorin – Ryu</label>

                                            <input type="checkbox" value="Uechi" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Uechi", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories8" class="multiCheckbox">
                                            <label>Uechi – Ryu</label>

                                            <input type="checkbox" value="Shuri" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Shuri", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories9" class="multiCheckbox">
                                            <label>Shuri – Ryu</label>

                                            <input type="checkbox" value="Kyokushinkai" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Kyokushinkai", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories10" class="multiCheckbox">
                                            <label>Kyokushinkai</label>

                                            <input type="checkbox" value="Budokan" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Budokan", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories11" class="multiCheckbox">
                                            <label>Budokan</label>

                                            <input type="checkbox" value="Aikido" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Aikido", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories12" class="multiCheckbox">
                                            <label>Aikido</label>

                                            <input type="checkbox" value="Brazilian" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Brazilian", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories13" class="multiCheckbox">
                                            <label>Brazilian Jiu-Jitsu (BJJ)</label>

                                            <input type="checkbox" value="Judo" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Judo", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories14" class="multiCheckbox">
                                            <label>Judo</label>

                                            <input type="checkbox" value="Karate" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Karate", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories15" class="multiCheckbox">
                                            <label>Karate</label>

                                            <input type="checkbox" value="Krav Maga" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Krav Maga", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories16" class="multiCheckbox">
                                            <label>Krav Maga</label>

                                            <input type="checkbox" value="Kung Fu" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Kung Fu", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories17" class="multiCheckbox">
                                            <label>Kung Fu</label>

                                            <input type="checkbox" value="Mixed" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Mixed", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories18" class="multiCheckbox">
                                            <label>Mixed Martial Arts (MMA)</label>

                                            <input type="checkbox" value="Muay" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Muay", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories19" class="multiCheckbox">
                                            <label>Muay Thai</label>

                                            <input type="checkbox" value="Taekwondo" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Taekwondo", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories20" class="multiCheckbox">
                                            <label>Taekwondo</label>

                                            <input type="checkbox" value="Tang" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Tang", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories21" class="multiCheckbox">
                                            <label>Tang Soo Do</label>

<!--                                            <input type="checkbox" value="Other" <?php if(isset($serviceData) && !empty($serviceData) && is_array($categories)):if(in_array("Other", $categories)):echo"checked";endif;endif;?> name="categories[]" id="categories" class="multiCheckbox">
                                            <label>Other</label>-->

                                            <span class="has-error"><?php echo form_error("categories[]"); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <?php if(isset($serviceData) && !empty($serviceData)):
                                          $chargeType =  unserialize($serviceData[0]->chargeType);
                                          $chargeAmount =  unserialize($serviceData[0]->chargeAmount);
                                 endif;?>
                            <div class="col-md-6"> 
                                <div>
                                    <div class="col-lg-12"><label  for="typehead">Karate/Martial arts Charges *</label></div>
                                    <div class="has-error m-left-30" id="chargesErr"><?php echo form_error("centerContact"); ?></div>
                                    <div class="col-md-12">
                                        <div class="col-md-4 charges"><input type="checkbox" name="chargeType[]" id="perSession" onclick="customShow('perSession', 'perSessionDiv')" value="Per session" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per session", $chargeType)):echo"checked";endif;endif;?>/> Per session</div>

                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per session", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perSessionDiv" ><input maxlength="100" id="perSessionText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per session", $chargeAmount)):echo $chargeAmount['Per session'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    <div style="clear : both"></div>

                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="perVisit" onclick="customShow('perVisit', 'perVisitDiv')" value="Per Style" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per Style", $chargeType)):echo"checked";endif;endif;?>/>Per Style</div>

                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per Style", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perVisitDiv"><input maxlength="50" id="perVisitText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Style", $chargeAmount)):echo $chargeAmount['Per Style'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>

                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="perMonth" onclick="customShow('perMonth', 'perMonthDiv')" value="Per Month" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per Month", $chargeType)):echo"checked";endif;endif;?>/> Per Month</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per Month", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perMonthDiv"><input maxlength="50" id="perMonthText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Month", $chargeAmount)):echo $chargeAmount['Per Month'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="bimonthly" onclick="customShow('bimonthly', 'bimonthlyDiv')" value="Bimonthly" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Bimonthly", $chargeType)):echo"checked";endif;endif;?>/> Bimonthly</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Bimonthly", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="bimonthlyDiv"><input maxlength="50" id="bimonthlyText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Bimonthly", $chargeAmount)):echo $chargeAmount['Bimonthly'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="quarterly" onclick="customShow('quarterly', 'quarterlyDiv')" value="Quarterly" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Quarterly", $chargeType)):echo"checked";endif;endif;?>/> Quarterly</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Quarterly", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="quarterlyDiv"><input maxlength="50" id="quarterlyText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Quarterly", $chargeAmount)):echo $chargeAmount['Quarterly'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="halfYearly" onclick="customShow('halfYearly', 'halfYearlyDiv')" value="Half Yearly" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Half Yearly", $chargeType)):echo"checked";endif;endif;?>/> Half Yearly</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Half Yearly", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="halfYearlyDiv"><input maxlength="50" id="halfYearlyText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Half Yearly", $chargeAmount)):echo $chargeAmount['Half Yearly'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    <div class="col-md-12 m-top-10">
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

