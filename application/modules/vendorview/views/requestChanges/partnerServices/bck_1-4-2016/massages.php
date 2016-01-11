<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>Massages</h3>
                </div>

                <div class="ibox-content">
                    <form method="POST" id="serviceForm" class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url(); ?>/partners/massages">
                        <div class="hr-line-dashed"></div> 
                        <input type="hidden" class="form-control" name="featureId" required="" value="">
                        <div class="row">
                            <input type="hidden" name="fkServiceId" id="fkServiceId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkServiceId;endif;?>">
                            <input type="hidden" name="fkVendorId" id="fkVendorId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkVendorId;endif;?>">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Health Benefits of massages.  </label>
                                        <textarea rows="4" class="form-control" id="adoutService" name="adoutService"><?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->adoutService;endif;?></textarea>
                                        <input type="hidden" name="massId" id="massId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->massId;endif;?>">
                                    </div>
                                </div>
                            </div> 
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Brief Description about you / your centre ? *</label><br/>
                                        <textarea name="aboutUs" id="aerobicsUserDescription" class="t-f-full" required=""><?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->aboutUs;endif;?></textarea>
                                        <span class="has-error"><?php echo form_error("aboutUs"); ?></span>
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
                            </div>
                            <div class="row col-md-12" id="arobicQue" <?php if(isset($provideService) && !empty($provideService)):if(in_array("At customer's location", $provideService)): echo "style='display:block'"; else: echo "style='display:none'";endif; else:echo "style='display:none'";endif;?>>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>What item do you carry with yourself required for massage ?</label><br/>
                                            <textarea name="item" id="item" class="t-f-full" required=""><?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->item;endif;?></textarea>
                                            <span class="has-error"><?php echo form_error("item"); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
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
                                    <div class="col-lg-3">
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
                            
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Type of massages you provide ?</label><br/>
                                        <textarea name="typeMass" id="typeMass" class="t-f-full" required=""><?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->typeMass;endif;?></textarea>
                                        <span class="has-error"><?php echo form_error("typeMass"); ?></span>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if(isset($serviceData) && !empty($serviceData)):
                                $chargeType =  unserialize($serviceData[0]->chargeType);
                                $chargeAmount =  unserialize($serviceData[0]->chargeAmount);
                            endif; ?>
                            <div class="col-md-7"> 
                                <div>
                                    <div class="col-lg-12"><label  for="typehead">Massages Charges *</label></div>
                                    <div class="has-error m-left-30" id="chargesErr"><?php echo form_error("centerContact"); ?></div>
                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="per30min" onclick="customShow('per30min', 'per30minDiv')" value="Per 30 Min" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per 30 Min", $chargeType)):echo"checked";endif;endif;?>/> Per 30 Min</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per 30 Min", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="per30minDiv"><input maxlength="50" id="per30minText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per 30 Min", $chargeAmount)):echo $chargeAmount['Per 30 Min'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div> 
                                    
                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="per60min" onclick="customShow('per60min', 'per60minDiv')" value="Per 60 Min" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per 60 Min", $chargeType)):echo"checked";endif;endif;?>/> Per 60 Min</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per 60 Min", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="per60minDiv"><input maxlength="50" id="per60minText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per 60 Min", $chargeAmount)):echo $chargeAmount['Per 60 Min'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                    
                                    <div class="col-md-12 m-top-10">
                                        <div class="col-md-4"><input type="checkbox" name="chargeType[]" id="per90min" onclick="customShow('per90min', 'per90minDiv')" value="Per 90 Min" <?php if(isset($chargeType) && !empty($chargeType)):if(in_array("Per 90 Min", $chargeType)):echo"checked";endif;endif;?>/> Per 90 Min</div>
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per 90 Min", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="per90minDiv"><input maxlength="50" id="per90minText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per 90 Min", $chargeAmount)):echo $chargeAmount['Per 90 Min'];endif;endif;?>" onkeypress="return isNumberKey(event,'chargesErr')"></div>
                                    </div>
                                     
                                    <div class="col-md-12 m-top-10">
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
                                        <div class="col-md-8 <?php if(isset($chargeType) && !empty($chargeType)):if(!in_array("Per Month", $chargeType)):echo"customHide";endif;else: echo 'customHide';endif;?>" id="perMonthDiv">
                                            <div class="col-md-6">
                                                <input id="perMonthText" tabindex="1" class="form-control" type="text" name="chargeAmount[]" placeholder="&#8377; 00.00" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Month", $chargeAmount)):echo $chargeAmount['Per Month'];endif;endif;?>" >
                                            </div>
                                            <div class="col-md-6">
                                                <input id="perDayText1" tabindex="1" class="form-control" type="text" name="chargeAmountText" placeholder="Program details" value="<?php if(isset($chargeType) && !empty($chargeType)):if(array_key_exists("Per Month", $chargeAmount)):echo $serviceData[0]->chargeAmountText;endif;endif;?>" >
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

