<!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Medicart Booking</h3>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox">


                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                            <form>
                                <aside class="col-lg-1 col-md-2 col-sm-2">
                                        <a href="<?php echo site_url('medicart/addOffer');?>" title="Add New Offer" class="btn btn-appointment waves-effect waves-light"> <i class="fa fa-plus"></i> Add</a>
                                </aside>
                                  <aside class="col-md-3 col-sm-3">
                                     <select class="selectpicker" data-width="100%" name="cityIdEnq" id="cityIdEnq" data-size="4">

                                         <option value="">Select City</option>
                                         <?php foreach ($allCity as $key => $val) { ?>
                                             <option value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
                                         <?php } ?>
                                     </select>
                                 </aside>
                                <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                                    <div class="input-group">
                                        <input class="form-control pickDate" placeholder="From" id="date-1" type="text" onkeydown="return false;">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </aside>

                                <aside class="col-md-3 col-sm-3">
                                    <input type="text" name="search" class="form-control" placeholder="Search" />
                                </aside>


                            </form>
                        </article>
                        <!-- Form Section End -->

                        <div class="bg-white">
                            <!-- Table Section Start -->

                            <article class="clearfix m-top-40 p-b-20">
                                           <div style="display: none;" id="load_consulting" class="text-center text-success "><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/beet.gif'); ?>" /></div>
                                <aside class="table-responsive">
                                    <table class="table" id="medicart_booking_datatables">

                                        <thead>
                                            <tr class="border-a-dull">
                                                <th>Booking Id</th>
                                                <th>MI Name</th>
                                                <th>Pref. Date</th>
                                                <th>Booked By</th>
                                                <th>Booked For</th>
                                                <th>Contact</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </aside>

                            </article>
                            <!-- Table Section End -->
                        </div>

                    </section>
                    <!-- Left Section End -->

                </div>

                <!-- container -->
            </div>
            <!-- content -->
            