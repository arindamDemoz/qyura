<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <form role="form" id="addCarrierData" method="post" action="#" enctype="multipart/form-data" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Froyofit is looking for rockstars! </h4>
                    <small class="font-bold">Please provide your required details along with your resume.</small>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" id="carrierSuccess" style="display: none"></div>
                    <div class="alert alert-danger" id="er_TopError" style="display: none"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="carrierLoad" class="progress progress-striped active">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 00%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name *</label>
                                    <div>
                                        <input type="text" class="form-control"  name="carrierName" id="carrierName"  required=""onkeypress="return isAlpha(event,this.value)" onblur="return checkText()"/>
                                    </div>
                                    <div class="help-block text-danger" id="er_carrierName" ></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email *</label>
                                    <div>
                                        <input type="email" class="form-control"  name="carrierEmail" id="carrierEmail"  required="" onblur="return checkEmail()" />
                                    </div>
                                    <div class="help-block text-danger" id="er_carrierEmail" ></div>
                                    <div class="has-error" ><?php echo form_error("carrierEmail"); ?></div>
                                </div>
                            </div> 
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone *</label>
                                    <div>
                                        <input type="tel" class="form-control"  name="carrierPhone" id="carrierPhone"  required="" onkeypress="return isNumberKey(event,'centreContactErr')" maxlength="11" onblur="return checkPhone()"/>
                                    </div>
                                    <div class="help-block text-danger" id="er_carrierPhone" ></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Position you are applying for *</label>
                                    <div>
                                        <select required name="carrierPosition" id="carrierPosition" class="bs-select form-control " data-live-search="true" title="Position" >
                                            <option value="">Select Position</option> 
                                            <option value="Business Development Manager">Business Development Manager</option> 
                                            <option value="Graphic Designer">Graphic Designer</option> 
                                            <option value="Content Writers">Content Writer</option> 
                                            <option value="Digital Marketing Analyst">Digital Marketing Analyst</option> 
                                        </select>
                                    </div>
                                    <div class="help-block text-danger" id="er_carrierPosition" ></div>
                                </div>
                            </div> 
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City *</label>
                                    <div>
                                        <select required name="carrierCity" id="carrierCity" class="bs-select form-control " data-live-search="true" title="City" >
                                            <option value="">Select City</option> 
                                            <option value="Delhi">Delhi</option> 
                                            <option value="Mumbai">Mumbai</option> 
                                            <option value="Bangalore">Bangalore</option> 
                                            <option value="Indore">Indore</option> 
                                            <option value="Pune">Pune</option>
                                            <option value="Chandigarh">Chandigarh</option> 
                                            <option value="Lucknow">Lucknow</option> 
                                        </select>
                                    </div>
                                    <div class="help-block text-danger" id="er_carrierCity" ></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Resume *</label>
                                    <div>
                                        <input type="file" name="carrierResume" id="carrierResume"  required="" onchange="ValidateSingleInput(this);"/>
                                    </div>
                                    <div class="help-block text-danger" id="er_carrierResume" ></div>
                                </div>
                            </div> 
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>