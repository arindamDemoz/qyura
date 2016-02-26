 <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Bloodbank Management</h43>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox">


                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                            <form>
                               <aside class="col-lg-1 col-md-2 col-sm-2">
                                    <a href="<?php echo base_url();?>index.php/bloodbank/Addbloodbank" class="btn btn-appointment waves-effect waves-light" title="Add New Blood Bank"><i class="fa fa-plus"></i> Add </a>
                                </aside>
                                <aside class="col-md-2 col-sm-2 m-t-xs-2">
                                                    <select class="selectpicker" data-width="100%" name="hospital_stateId" id="hospital_stateId" data-size="4" onchange ="fetchCityList(this.value)">

                                                        <option value=" ">Select State</option>
                                                       <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                   
                                 </aside>
                                <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                                    <select type="text" name="hospital_cityId" class="selectpicker" data-width="100%"  placeholder="Search" id="hospital_cityId" data-size="4" />
                                   <!-- <option>Delhi</option>
                                    <option>Kolkata</option> -->
                                    </select>
                                </aside>
                               <aside class="col-md-3 col-sm-4 m-tb-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input type="text" name="search" id="search" class="form-control" placeholder="Search" /> 
                                    </div>
                                </aside>
                                <aside class="col-md-2 col-sm-2 pull-right">
                                    <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit">Export</button>
                                </aside>

                            </form>
                        </article>
                        <!-- Form Section End -->

                        <div class="bg-white">
                            <!-- Table Section Start -->
                            <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                                <table class="table all-bloodbank" id="datatable_bloodbank">
                                    <thead>
                                        <tr class="border-a-dull">
                                            <th>Logo</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>Address</th>
<!--                                            <th>Open Hours</th>
                                            <th>Call Received</th>-->
                                            <th>Action</th>
                                        </tr>
                                    
                                  </thead>
                        </table>
                                    </aside>
                        </article>
                </div>

                </section>
                <!-- Left Section End -->

            </div>

            <!-- container -->
        </div>
        <!-- content -->
 