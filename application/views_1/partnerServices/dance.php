<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>Dance</h3>
                </div>

                <div class="ibox-content">
                    <form method="POST" id="serviceForm" class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url(); ?>/partners/dance">
                        <div class="hr-line-dashed"></div> 
                        <div class="row">
                            <input type="hidden" name="fkServiceId" id="fkServiceId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkServiceId;endif;?>">
                            <input type="hidden" name="fkVendorId" id="fkVendorId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkVendorId;endif;?>">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Brief Description about you & your centre *</label>
                                        <textarea required="required" rows="4" class="form-control" id="adoutService" name="adoutService" ><?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->adoutService;endif;?></textarea>
                                        <input type="hidden" name="danceId" id="danceId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->danceId;endif;?>">
                                    </div>
                                </div>
                                
                            </div> 
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Please mention if you have received any Award/Accolades ?</label>
                                        <input id="aerobicsAward" name="awards" type="text" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->awards;endif;?>">
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <label>What is your total experience in this field (in no. of years) ? *</label>
                                    <input id="aerobicsExperience" name="experience" type="text" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->experience;endif;?>" onkeypress="return isNumberKey(event,'mobileErr')" maxlength="2" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6"><div class="form-group">
                                        <div class="icheck-inline">
                                            <label>
                                                What is your source of learning?  
                                            </label> </br>
                                                <label class="m-320-10">
                                                <input type="radio" name="ifPersonalTrainer"  class="icheck" value="2" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->ifPersonalTrainer == 2):echo"checked";endif;endif;?>  onclick="showHideFiled('personal_trainers', 1)"> Professional Institute 
                                            </label>
                                                <label class="m-left-10">
                                                <input type="radio" name="ifPersonalTrainer"  class="icheck" value="1" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->ifPersonalTrainer == 1):echo"checked";endif;endif;?> onclick="showHideFiled('personal_trainers', 1)"> Personal Teacher </label>
                                                <label class="m-left-10">
                                                <input type="radio" name="ifPersonalTrainer"  class="icheck deposit" value="0" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->ifPersonalTrainer == 0):echo"checked";endif;endif;?> onclick="showHideFiled('personal_trainers', 0)"> Self </label>
                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6" id="personal_trainers" <?php if(isset($serviceData) && !empty($serviceData)){if($serviceData[0]->ifPersonalTrainer == 1 or $serviceData[0]->ifPersonalTrainer == 2){ echo "style='display:block'"; }else{ echo"style='display:none'"; } }?>>
                                    <div class="form-group">
                                        <label>Name of Professional Institute/Personal Teacher</label>
                                        <input id="personalTrainer" name="personalTrainer" type="text" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->personalTrainer;endif;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label >Where do you provide service? *</label><br>
                                           <?php if(isset($serviceData) && !empty($serviceData)):
                                                $provideService =  unserialize($serviceData[0]->provideService);
                                           endif;?>
                                        <label class="m-320-10 chargesClass"><input <?php if(isset($provideService) && !empty($provideService)):if(in_array("At my centre", $provideService)):echo"checked";endif;endif;?> type="checkbox" name="provideService[]" class="icheck" value="At my centre"> At my centre </label>
                                        <label class="m-left-10"><input <?php if(isset($provideService) && !empty($provideService)):if(in_array("At my home", $provideService)):echo"checked";endif;endif;?> type="checkbox" name="provideService[]" class="icheck" value="At my home"> At my home </label>
                                        <label class="m-left-10"><input <?php if(isset($provideService) && !empty($provideService)):if(in_array("At customer's location", $provideService)):echo"checked";endif;endif;?> type="checkbox" id="arobicService" onclick="customShow('arobicService', 'arobicQue')" name="provideService[]" class="icheck" value="At customer's location"> At customer's location </label>
                                    </div>
                                </div>
                                <div class="row " id="arobicQue" <?php if(isset($provideService) && !empty($provideService)):if(in_array("At customer's location", $provideService)): echo "style='display:block'"; else: echo "style='display:none'";endif; else:echo "style='display:none'";endif;?>>
                                    <div class="col-lg-6">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Are you willing to travel within</label>
                                                <select  name="travelling" id="aerobicsTravelKM" class="bs-select form-control" data-size="4" data-live-search="true" title="Traving KM"  >
                                                    <option value="">Select Travel KM</option>

                                                    <?php for($i=1;$i<=26;$i++):?>
                                                    <option value="<?php echo $i;?>" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->travelling == $i):echo"selected";endif;endif;?>><?php echo $i;?></option>
                                                    <?php endfor;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Do you have a vehicle?</label>
                                                <select  name="vehicle" id="aerobicsVehicle" class="bs-select form-control" data-size="4" data-live-search="true" title="Floor Name"  >
                                                    <option value="1" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->vehicle == 1):echo"selected";endif;endif;?>>Yes</option>
                                                    <option value="0" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->vehicle == 0):echo"selected";endif;endif;?>>No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                              <?php if(isset($serviceData) && !empty($serviceData)):
                                        $ageGroup =  unserialize($serviceData[0]->ageGroup);
                                endif; ?>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <div class="icheck-inline">
                                        <label>Which age group you cater to? *</label><br>
                                            
                                            <input type="checkbox" value="Below 10" <?php if(isset($serviceData) && !empty($serviceData) && is_array($ageGroup)):if(in_array("Below 10", $ageGroup)):echo"checked";endif;endif;?> name="ageGroup[]" id="ageGroup" class="multiCheckbox">
                                            <label>Below 10</label>
                                            
                                            <input type="checkbox" value="10-25" <?php if(isset($serviceData) && !empty($serviceData) && is_array($ageGroup)):if(in_array("10-25", $ageGroup)):echo"checked";endif;endif;?> name="ageGroup[]" id="ageGroup" class="multiCheckbox">
                                            <label>10-25</label>
                                            
                                            <input type="checkbox" value="Above 25" <?php if(isset($serviceData) && !empty($serviceData) && is_array($ageGroup)):if(in_array("Above 25", $ageGroup)):echo"checked";endif;endif;?> name="ageGroup[]" id="ageGroup" class="multiCheckbox">
                                            <label>Above 25</label>
                                            
                                        <span class="has-error"><?php echo form_error("ageGroup[]"); ?></span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <?php if(isset($serviceData) && !empty($serviceData)):
                                        $amenities =  unserialize($serviceData[0]->amenities);
                                endif; ?>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="icheck-inline">
                                            <label>Which categories of dance do you teach ? *</label><br>
                                            
                                            <input type="checkbox" value="Acrobatic" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Acrobatic", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Acrobatic</label>
                                            
                                            <input type="checkbox" value="Belle" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Belle", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Belle</label>
                                            
                                            <input type="checkbox" value="Ballroom" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Ballroom", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Ballroom</label>
                                            
                                            <input type="checkbox" value="Belly" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Belly", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Belly</label>
                                            
                                            <input type="checkbox" value="Bharatnatyam" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Bharatnatyam", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Bharatnatyam</label>
                                            
                                            <input type="checkbox" value="Break dance" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Break dance", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Break dance</label>
                                            
                                            <input type="checkbox" value="Cha Cha" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Cha Cha", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Cha Cha</label>
                                            
                                            <input type="checkbox" value="Classical" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Classical", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Classical</label>
                                            
                                            <input type="checkbox" value="Choreography" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Choreography", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Choreography</label>
                                            
                                            <input type="checkbox" value="Contemporary" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Contemporary", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Contemporary</label>
                                            
                                            <input type="checkbox" value="Dandiya" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Dandiya", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Dandiya</label>
                                            
                                            <input type="checkbox" value="Folk" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Folk", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Folk</label>
                                            
                                            <input type="checkbox" value="Free Style" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Free Style", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Free Style</label>
                                            
                                            <input type="checkbox" value="Fusion" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Fusion", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Fusion</label>
                                            
                                            <input type="checkbox" value="Garba" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Garba", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Garba</label>
                                            
                                            <input type="checkbox" value="Hip Hop" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Hip Hop", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Hip Hop</label>
                                            
                                            <input type="checkbox" value="Jazz" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Jazz", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Jazz</label>
                                            
                                            <input type="checkbox" value="Jive" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Jive", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Jive</label>
                                            
                                            <input type="checkbox" value="Kathak" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Kathak", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Kathak</label>
                                            
                                            <input type="checkbox" value="Kathakali" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Kathakali", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Kathakali</label>
                                            
                                            <input type="checkbox" value="Kuchipudi" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Kuchipudi", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Kuchipudi</label>
                                            
                                            <input type="checkbox" value="Latin" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Latin", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Latin</label>
                                            
                                            <input type="checkbox" value="Latin American" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Latin American", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Latin American</label>
                                            
                                            <input type="checkbox" value="Odissi" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Odissi", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Odissi</label>
                                            
                                            <input type="checkbox" value="Pole" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Pole", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Pole</label>
                                            
                                            <input type="checkbox" value="Rock n roll" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Rock n roll", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Rock n roll</label>
                                            
                                            <input type="checkbox" value="salsa" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("salsa", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>salsa</label>
                                            
                                            <input type="checkbox" value="Tango" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Tango", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Tango</label>
                                            
                                            <input type="checkbox" value="Tap" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Tap", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Tap</label>
                                            
                                            <input type="checkbox" value="Waltz" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Waltz", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Waltz</label>
                                            
                                            <input type="checkbox" value="Western" <?php if(isset($serviceData) && !empty($serviceData) && is_array($amenities)):if(in_array("Western", $amenities)):echo"checked";endif;endif;?> name="amenities[]" id="amenities" class="multiCheckbox">
                                            <label>Western</label>
                                            
                                        <span class="has-error"><?php echo form_error("amenities[]"); ?></span>
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
                                    <div class="col-lg-12"> <label  for="typehead">Dance Charges *</label></div>
                                    <div class="has-error m-left-30" id="chargesErr"><?php echo form_error("centerContact"); ?></div>
                                    <div class="col-md-12">
                                        <div class="col-md-4 charges"><input type="checkbox" name="chargeType[]" id="perSession" onclick="customShow('perSession', 'perSessionDiv')" value="Per session" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per session", $chargeType)):echo"checked";endif;endif;?>/> Per session</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per session", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perSessionDiv" ><input maxlength="100" id="perSessionText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per session", $chargeAmount)):echo $chargeAmount['Per session'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    <div style="clear : both"></div>
                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="perVisit" onclick="customShow('perVisit', 'perVisitDiv')" value="Per Visit" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per Visit", $chargeType)):echo"checked";endif;endif;?>/> Per Visit</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per Visit", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perVisitDiv"><input maxlength="50" id="perVisitText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Visit", $chargeAmount)):echo $chargeAmount['Per Visit'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="perDay" onclick="customShow('perDay', 'perDayDiv')" value="Per Day" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per Day", $chargeType)):echo"checked";endif;endif;?>/> Per Day</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per Day", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perDayDiv"><input maxlength="50" id="perDayText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Day", $chargeAmount)):echo $chargeAmount['Per Day'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
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

                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="performance" onclick="customShow('performance', 'performanceDiv')" value="Performance" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Annually", $chargeType)):echo"checked";endif;endif;?>/> Per Parody</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Performance", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="performanceDiv"><input maxlength="50" id="performanceText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Performance", $chargeAmount)):echo $chargeAmount['Performance'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    
                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="perminute" onclick="customShow('perminute', 'perminuteDiv')" value="Per Minute" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per Minute", $chargeType)):echo"checked";endif;endif;?>/> Per Minute</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per Minute", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perminuteDiv"><input maxlength="50" id="perminuteText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Minute", $chargeAmount)):echo $chargeAmount['Per Minute'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    
                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="persong" onclick="customShow('persong', 'persongDiv')" value="Per Song" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per Song", $chargeType)):echo"checked";endif;endif;?>/> Per Song</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per Song", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="persongDiv"><input maxlength="50" id="persongText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Song", $chargeAmount)):echo $chargeAmount['Per Song'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
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

