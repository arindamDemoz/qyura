<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>Cross Functional</h3>
                    <div> <?php  if(isset($messages)){ echo $messages; }?></div>
                </div>
                <div class="ibox-content">
                    <form method="POST" id="serviceForm" class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url(); ?>partners/crossfunctional" >
                        <div class="hr-line-dashed"></div> 
                        <div class="row">
                            <input type="hidden" name="fkServiceId" id="fkServiceId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkServiceId;endif;?>">
                            <input type="hidden" name="fkVendorId" id="fkVendorId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->fkVendorId;endif;?>">
                            <div class="col-lg-12 form-group">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Please provide details about cross functional training. *</label>
                                        <textarea required="required" rows="4" class="form-control" id="adoutService" name="adoutService"><?php if(isset($serviceData[0]->adoutService) && !empty($serviceData[0]->adoutService)):echo $serviceData[0]->adoutService;elseif(isset ($_POST['adoutService'])):echo $_POST['adoutService'];endif;?></textarea>
                                        <input type="hidden" name="crossId" id="crossId" value="<?php if(isset($serviceData) && !empty($serviceData)):echo $serviceData[0]->crossId;endif;?>">
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

