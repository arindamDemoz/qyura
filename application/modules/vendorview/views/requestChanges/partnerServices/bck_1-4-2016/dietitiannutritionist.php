<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>Dietitian/Nutritionist</h3>
                </div>

                <div class="ibox-content">
                    <form method="POST" id="serviceForm" class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url(); ?>/partners/dietitiannutritionist">
                        <div class="hr-line-dashed"></div> 
                        <input type="hidden" class="form-control" name="featureId" required="" value="">
                        <div class="row">
                            <input type="hidden" name="fkServiceId" id="fkServiceId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkServiceId;endif;?>">
                            <input type="hidden" name="fkVendorId" id="fkVendorId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkVendorId;endif;?>">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Importance of keeping a Healthy Diet regime  </label>
                                        <textarea rows="4" class="form-control" id="adoutService" name="adoutService"><?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->adoutService;endif;?></textarea>
                                        <input type="hidden" name="dieticianId" id="dieticianId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->dietId;endif;?>">
                                    </div>
                                </div>
                            </div> 
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>What degree do you hold in this field? *</label>
                                        <input id="degre" name="degre" type="text" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->degre;endif;?>" required="">
                                        <span class="has-error"><?php echo form_error("degre"); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label>From which Institute ? *</label>
                                        <input id="institute" name="institute" type="text" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->institute;endif;?>" required="">
                                        <span class="has-error"><?php echo form_error("institute"); ?></span>
                                    </div>
                                </div>


                                
                            </div>
                            <div class="col-md-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <label>What is your total experience in this field (in no. of years)? *</label>
                                    <input id="aerobicsExperience" name="experience" type="text" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->experience;endif;?>" onkeypress="return isNumberKey(event,'mobileErr')" maxlength="2" required="">
                                    <span class="has-error"><?php echo form_error("experience"); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6"> <div class="form-group">
                                        <div class="icheck-inline">
                                            <label>
                                                Are you associated with any hospital or any recognized institute ? If yes kindly mention. </label>
                                                <label>
                                                <input type="radio" id="personalTrainer1" name="recognizedYesNo"  class="icheck" value="1" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->recognizedYesNo == 1):echo"checked";endif;endif;?> onclick="showHideFiled('recognized', 1)"> Yes </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <label>
                                                <input type="radio" id="personalTrainer0" name="recognizedYesNo"  class="icheck deposit" value="0" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->recognizedYesNo == 0):echo"checked";endif;endif;?> onclick="showHideFiled('recognized', 0)"> No </label>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6" id="recognized"  <?php if(isset($serviceData) && !empty($serviceData)){if($serviceData[0]->recognizedYesNo == 1){ echo "style='display:block'"; }else{ echo"style='display:none'"; } }?>>
                                    <div class="form-group">
                                        <label>Name of the Hospital/Recognized institute .</label><br/>
                                        <textarea name="recognizedDetail" id="recognizedDetail" class="t-f-full"><?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->recognizedDetail;endif;?></textarea>
                                   </div>
                              </div>
                            </div>

                             
                           
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Brief Description about you/ your centre ? *</label><br/>
                                        <textarea name="aboutUs" id="aerobicsUserDescription" class="t-f-full" required=""><?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->aboutUs;endif;?></textarea>
                                        <span class="has-error"><?php echo form_error("aboutUs"); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Where do you provide service? *</label><br>
                                           <?php if(isset($serviceData) && !empty($serviceData)):
                                                $provideService =  unserialize($serviceData[0]->provideService);
                                           endif;?>
                                        <label class="m-320-10 chargesClass"><input <?php if(isset($provideService) && !empty($provideService)):if(in_array("At my centre", $provideService)):echo"checked";endif;endif;?> type="checkbox" name="provideService[]" class="icheck" value="At my centre"> At my centre </label>
                                        <label class="m-left-10"><input <?php if(isset($provideService) && !empty($provideService)):if(in_array("At my home", $provideService)):echo"checked";endif;endif;?> type="checkbox" name="provideService[]" class="icheck" value="At my home"> At my home </label>
                                        <label class="m-left-10"><input <?php if(isset($provideService) && !empty($provideService)):if(in_array("At customer's location", $provideService)):echo"checked";endif;endif;?> type="checkbox" id="arobicService" onclick="customShow('arobicService', 'arobicQue')" name="provideService[]" class="icheck" value="At customer's location"> At customer's location </label><br>
                                    </div>
                                </div>
                                <div class="row" id="arobicQue" <?php if(isset($provideService) && !empty($provideService)):if(in_array("At customer's location", $provideService)): echo "style='display:block'"; else: echo "style='display:none'";endif; else:echo "style='display:none'";endif;?>>
                                    <div class="col-lg-6">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>You can travel within</label>
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
                                        $dieticianType =  unserialize($serviceData[0]->amenities);
                                endif; ?>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="icheck-inline">
                                            <label>What type of Dietitian or Nutritionist you are ? *</label><br>
                                            
                                            <input type="checkbox" value="Nutrition Scientists" <?php if(isset($serviceData) && !empty($serviceData) && is_array($dieticianType)):if(in_array("Nutrition Scientists", $dieticianType)):echo"checked";endif;endif;?> name="dieticianType[]" id="dieticianType1" class="multiCheckbox">
                                            <label>Nutrition Scientists</label>
                                            
                                            <input type="checkbox" value="Public Health Nutritionist" <?php if(isset($serviceData) && !empty($serviceData) && is_array($dieticianType)):if(in_array("Public Health Nutritionist", $dieticianType)):echo"checked";endif;endif;?> name="dieticianType[]" id="dieticianType2" class="multiCheckbox">
                                            <label>Public Health Nutritionist</label>

                                            <input type="checkbox" value="Clinical Dietician" <?php if(isset($serviceData) && !empty($serviceData) && is_array($dieticianType)):if(in_array("Clinical Dietician", $dieticianType)):echo"checked";endif;endif;?> name="dieticianType[]" id="dieticianType3" class="multiCheckbox">
                                            <label>Clinical Dietician</label>

                                            <input type="checkbox" value="Community Dietician" <?php if(isset($serviceData) && !empty($serviceData) && is_array($dieticianType)):if(in_array("Community Dietician", $dieticianType)):echo"checked";endif;endif;?> name="dieticianType[]" id="dieticianType4" class="multiCheckbox">
                                            <label>Community Dietician</label>

                                            <input type="checkbox" value="Foodservice Dietician" <?php if(isset($serviceData) && !empty($serviceData) && is_array($dieticianType)):if(in_array("Foodservice Dietician", $dieticianType)):echo"checked";endif;endif;?> name="dieticianType[]" id="dieticianType5" class="multiCheckbox">
                                            <label>Foodservice Dietician</label>

                                            <input type="checkbox" value="Gerontological Dietician" <?php if(isset($serviceData) && !empty($serviceData) && is_array($dieticianType)):if(in_array("Gerontological Dietician", $dieticianType)):echo"checked";endif;endif;?> name="dieticianType[]" id="dieticianType6" class="multiCheckbox">
                                            <label>Gerontological Dietician</label>

                                            <input type="checkbox" value="Research Dietician" <?php if(isset($serviceData) && !empty($serviceData) && is_array($dieticianType)):if(in_array("Research Dietician", $dieticianType)):echo"checked";endif;endif;?> name="dieticianType[]" id="dieticianType7" class="multiCheckbox">
                                            <label>Research Dietician</label>

                                            <input type="checkbox" value="Administrative Dietician" <?php if(isset($serviceData) && !empty($serviceData) && is_array($dieticianType)):if(in_array("Administrative Dietician", $dieticianType)):echo"checked";endif;endif;?> name="dieticianType[]" id="dieticianType8" class="multiCheckbox">
                                            <label>Administrative Dietician</label>

                                            <input type="checkbox" value="Business Dietician" <?php if(isset($serviceData) && !empty($serviceData) && is_array($dieticianType)):if(in_array("Business Dietician", $dieticianType)):echo"checked";endif;endif;?> name="dieticianType[]" id="dieticianType9" class="multiCheckbox">
                                            <label>Business Dietician</label>

                                            <input type="checkbox" value="Consultant Dietician" <?php if(isset($serviceData) && !empty($serviceData) && is_array($dieticianType)):if(in_array("Consultant Dietician", $dieticianType)):echo"checked";endif;endif;?> name="dieticianType[]" id="dieticianType10" class="multiCheckbox">
                                            <label>Consultant Dietician</label>

                                            <span class="has-error"><?php echo form_error("dieticianType[]"); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <?php if(isset($serviceData) && !empty($serviceData)):
                                          $chargeType =  unserialize($serviceData[0]->chargeType);
                                          $chargeAmount =  unserialize($serviceData[0]->chargeAmount);
                                 endif;?>
                            <div class="col-md-7"> 
                                <div>
                                    <div class="col-lg-12"><label  for="typehead">Dietitian/Nutritionist Charges *</label></div>
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
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="perMonth" onclick="customShow('perMonth', 'perMonthDiv')" value="Per Month" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per Month", $chargeType)):echo"checked";endif;endif;?>/> Per Month</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per Month", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perMonthDiv"><input maxlength="50" id="perMonthText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Month", $chargeAmount)):echo $chargeAmount['Per Month'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>

                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="bimonthly" onclick="customShow('bimonthly', 'bimonthlyDiv')" value="Bimonthly" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Bimonthly", $chargeType)):echo"checked";endif;endif;?>/> Bimonthly</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Bimonthly", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="bimonthlyDiv"><input maxlength="50" id="bimonthlyText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Bimonthly", $chargeAmount)):echo $chargeAmount['Bimonthly'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
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
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="perDay" onclick="customShow('perDay', 'perDayDiv')" value="Per Specific Program" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per Specific Program", $chargeType)):echo"checked";endif;endif;?>/> Per Specific Program</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per Specific Program", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perDayDiv">
                                            <div class="col-md-6">
                                                <input id="perDayText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Specific Program", $chargeAmount)):echo $chargeAmount['Per Specific Program'];endif;endif;?>" >
                                            </div>
                                            <div class="col-md-6">
                                                <input id="perDayText1" tabindex="1" class="form-control" type="text" name="chargeAmountText" placeholder="Program details" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Specific Program", $chargeAmount)):echo $serviceData[0]->chargeAmountText;endif;endif;?>" >
                                            </div>
                                            
                                        </div>
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

<script type="text/javascript">
    function showHideFiled(id,checked){
        if (checked == 1) {
         $("#"+id).css("display", "block");
      }else if (checked == 0) {
        $("#"+id).css("display", "none");
      };
    }
</script>

