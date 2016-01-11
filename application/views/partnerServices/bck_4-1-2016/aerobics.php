<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>Aerobics</h3>
					<div> <?php  if(isset($messages)){ echo $messages; }?></div>
                </div>
                <div class="ibox-content">
                    <form method="POST" id="serviceForm" class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url(); ?>partners/aerobics" >
                        <div class="hr-line-dashed"></div> 
                        <div class="row">
                            <input type="hidden" name="fkServiceId" id="fkServiceId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkServiceId;endif;?>">
                            <input type="hidden" name="fkVendorId" id="fkVendorId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkVendorId;endif;?>">
                            <div class="col-lg-12 form-group">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>About Aerobics </label>
                                        <textarea rows="4" class="form-control" id="adoutService" name="adoutService"><?php if(isset($serviceData[0]->adoutService) && !empty($serviceData[0]->adoutService)):echo $serviceData[0]->adoutService;elseif(isset ($_POST['adoutService'])):echo $_POST['adoutService'];endif;?></textarea>
                                        <input type="hidden" name="aeroId" id="aeroId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->aeroId;endif;?>">
                                    </div>
                                </div>
                                
                            </div> 
                            <div class="col-lg-12 form-group">
                                <div class="col-lg-6">
                                <label>Do you have any of the following certification? </label>
                                <?php if(isset($serviceData) && !empty($serviceData)):
                                   $certification =  unserialize($serviceData[0]->certification);
                                endif;?>
                                <div class="icheck-inline">
                                    <label><input  <?php if(isset($certification) && !empty($certification)):if(in_array("International Fitness Association(IFA)", $certification)):echo"checked";endif;endif;?>  type="checkbox" name="certification[]" class="icheck" value="International Fitness Association(IFA)"> International Fitness Association(IFA) </label><br>
                                    <label><input   <?php if(isset($certification) && !empty($certification)):if(in_array("Aerobics and fitness association of America(AFAA)", $certification)):echo"checked";endif;endif;?> type="checkbox" name="certification[]" class="icheck" value="Aerobics and fitness association of America(AFAA)"> Aerobics and fitness association of America(AFAA) </label><br>
                                    <label><input   <?php if(isset($certification) && !empty($certification)):if(in_array("Indian Academy of Fitness Training(IAFT)", $certification)):echo"checked";endif;endif;?> type="checkbox" name="certification[]" class="icheck" value="Indian Academy of Fitness Training(IAFT)"> Indian Academy of Fitness Training(IAFT) </label><br>
                                    <textarea id="certificationId" name="moreCertification" placeholder="Any other certification . For more than one separate each by a comma" class="t-f-full" rows="1"><?php if(isset($serviceData[0]->moreCertification) && !empty($serviceData[0]->moreCertification)):echo $serviceData[0]->moreCertification;elseif(isset ($_POST['moreCertification'])):echo $_POST['moreCertification'];endif;?></textarea><br>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Please mention if you have received any Award/Accolades ?</label>
                                        <input id="aerobicsAward" name="awards" type="text" class="form-control" value="<?php if(isset($serviceData[0]->awards) && !empty($serviceData[0]->awards)):echo $serviceData[0]->awards;elseif(isset ($_POST['awards'])):echo $_POST['awards'];endif;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <label>What is your total experience in this field (in no. of years) ? *</label>
                                    <input id="aerobicsExperience" name="experience" type="tel" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->experience;endif;?>" onkeypress="return isNumberKey(event,'mobileErr')" maxlength="2" required="">
                                    <span class="has-error"><?php echo form_error("experience"); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                     <div class="form-group">
                                        <div class="icheck-inline">
                                            <label>
                                                Do you have membership of any association/board of personal trainers? </label>
                                            <label>
                                            <input type="radio" name="ifPersonalTrainer"  class="icheck" value="1" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->ifPersonalTrainer == 1):echo"checked";endif;endif;?> onclick="showHideFiled('personal_trainers', 1)"> Yes </label>
                                            <label class="m-left-10">
                                            <input type="radio" name="ifPersonalTrainer"  class="icheck deposit" value="0" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->ifPersonalTrainer == 0):echo"checked";endif;endif;?> onclick="showHideFiled('personal_trainers', 0)"> No </label>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6" id="personal_trainers" <?php if(isset($serviceData) && !empty($serviceData)){if($serviceData[0]->ifPersonalTrainer == 1){ echo "style='display:block'"; }else{ echo"style='display:none'"; } }?>>
                                    <div class="form-group">
                                    <label>What is the name of the association/board of personal trainers ?</label>
                                    <input id="personalTrainer" name="personalTrainer" type="text" class="form-control" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->personalTrainer;endif;?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group " >
                                        <label>Where do you provide service? *</label><br>
                                           <?php if(isset($serviceData) && !empty($serviceData)):
                                                $provideService =  unserialize($serviceData[0]->provideService);
                                           endif;?>
                                        <label class="chargesClass"><input <?php if(isset($provideService) && !empty($provideService)):if(in_array("At my centre", $provideService)):echo"checked";endif;endif;?> type="checkbox" name="provideService[]" class="icheck" value="At my centre"> At my centre </label>
                                        <label class="m-top-10"><input <?php if(isset($provideService) && !empty($provideService)):if(in_array("At my home", $provideService)):echo"checked";endif;endif;?> type="checkbox" name="provideService[]" class="icheck" value="At my home"> At my home </label>
                                        <label class="m-top-10"><input <?php if(isset($provideService) && !empty($provideService)):if(in_array("At customers location", $provideService)):echo"checked";endif;endif;?> type="checkbox" id="arobicService" onclick="customShow('arobicService', 'arobicQue')" name="provideService[]" class="icheck" value="At customers location"> At customer's location </label>
                                    </div>
                                </div>
                                <br><br>
                                <div id="arobicQue" <?php if(isset($provideService) && !empty($provideService)):if(in_array("At customers location", $provideService)): echo "style='display:block'"; else: echo "style='display:none'";endif; else:echo "style='display:none'";endif;?>>
                                <div class="col-lg-3">
                                    <div>
                                        <label>You can travel within</label>
                                        <select  name="travelling" id="aerobicsTravelKM" class="bs-select form-control" data-size="4" title="Traving KM"  >
                                            <option value="">Select Travel KM</option>
                                             
                                            <?php for($i=1;$i<=26;$i++):?>
                                            <option value="<?php echo $i;?>" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->travelling == $i):echo"selected";endif;endif;?>><?php echo $i;?></option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Do you have a vehicle?</label>
                                        <select  name="vehicle" id="aerobicsVehicle" class="bs-select form-control" data-size="4" title="Floor Name"  >
                                            <option value="1" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->vehicle == 1):echo"selected";endif;endif;?>>Yes</option>
                                            <option value="0" <?php if(isset($serviceData) && !empty($serviceData)):if($serviceData[0]->vehicle == 0):echo"selected";endif;endif;?>>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-12 form-group">
                                    <label>Brief Description about you/ your centre ? *</label><br/>
                                    <textarea name="aboutUs" id="aerobicsUserDescription" class="form-control" rows="2" required=""><?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->aboutUs;endif;?></textarea>
                                    <span class="has-error"><?php echo form_error("aboutUs"); ?></span>
                                </div>
                            </div>
                                <?php if(isset($serviceData) && !empty($serviceData)):
                                          $chargeType =  unserialize($serviceData[0]->chargeType);
                                          $chargeAmount =  unserialize($serviceData[0]->chargeAmount);
                                 endif;?>
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <label  for="typehead">Aerobics Charges *</label></div>
                                    <div class="has-error m-left-30 " id="chargesErr"><?php echo form_error("centerContact"); ?></div>
                                    <div class="col-md-12 ">
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
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="freeMember" onclick="customShow('freeMember', 'freeMemberDiv')" value="freeMember" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("freeMember", $chargeType)):echo"checked";endif;endif;?>/> Free with Gym membership</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("freeMember", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="freeMemberDiv"><input maxlength="50" id="freeMemberText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="Provide specific details" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("freeMember", $chargeAmount)):echo $chargeAmount['freeMember'];endif;endif;?>" ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
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