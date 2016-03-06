<!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <!-- consultation -->

                    <div style="display:show;" id="consultDiv">
                        <div class="clearfix">
                            <div class="col-md-12">
                                <h3 class="pull-left page-title">Add New Medicart Offer</h3>

                            </div>
                        </div>
                        <form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="#" novalidate="novalidate">

                            <!-- Left Section Start -->
                            <section class="col-md-6 detailbox">
                                <div class="bg-white mi-form-section">
                                    <figure class="clearfix">
                                        <h3>General Detail</h3>
                                    </figure>
                                    <!-- Table Section End -->
                                    <div class="clearfix m-t-20">
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">City:</label>
                                            <div class="col-md-8 col-sm-8">
                                                <select class="selectpicker" data-width="100%" name="cityId" id="cityId">
                                                  <option value="">Select City</option>
                                                    <?php foreach ($allCity as $key => $val) { ?>
                                                        <option value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0 ">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">MI Name:</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input type="text" class="form-control" id="miName" name="miName" required="" aria-required="true" placeholder="MI Name">
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0 ">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Id :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control disabled" id="id" name="id" type="disabled" required="" aria-required="true" placeholder="ACM304">
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Offer Category:</label>
                                            <div class="col-md-8 col-sm-8">
                                                <select class="selectpicker" data-width="100%" name="gender">
                                                    <option value=" ">Health Insurance</option>
                                                    <option value=" ">Family Pack</option>
                                                </select>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Title :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="title" type="text" name="title" required="">
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0 ">
                                            <label class="control-label col-md-4 col-sm-4" for="cemail">Image:</label>
                                            <div class="col-md-8 col-sm-8 text-right">
                                                <input id="uploadFile" class="showUpload" disabled="disabled" />
                                                <div class="fileUpload btn btn-sm btn-upload">
                                                    <span><i class="fa fa-cloud-upload fa-3x"></i></span>
                                                    <input id="uploadBtn" type="file" class="upload" />
                                                </div>
                                                <img src="assets/images/profile-1.jpg" alt=" " class="img-responsive" />
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Description :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <textarea class="form-control " id="description" type="text" name="description" required=""></textarea>
                                            </div>
                                        </article>

                                    </div>
                                    <!-- .form -->
                                </div>

                            </section>
                            <!-- Left Section End -->



                            <!-- Right Section Start -->
                            <section class="col-md-6 detailbox mi-form-section">
                                <div class="bg-white clearfix">
                                    <!-- Other Info Start -->

                                    <figure class="clearfix">
                                        <h3>Other Information</h3>
                                    </figure>
                                    <aside class="clearfix m-t-20">

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Allow Booking ?</label>
                                            <div class="col-md-8 col-sm-8">
                                                <div class="radio radio-success radio-inline">
                                                    <input type="radio" checked="" name="booking" value="Yes" id="inlineRadio1">
                                                    <label for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="radio radio-success radio-inline">
                                                    <input type="radio" name="booking" value="No" id="inlineRadio2">
                                                    <label for="inlineRadio2">No</label>
                                                </div>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Maximum Booking Limit </label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="bookingLimit" type="text" name="bookingLimit" required="">
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Publish Duration:</label>
                                            <div class="col-md-8 col-sm-8">
                                                <aside class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="input-group">
                                                            <input class="form-control pickDate" id="date-1" type="text" name="dateTo" placeholder="Date To" onkeydown="return false;">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                        <div class="input-group">
                                                            <input class="form-control pickDate" id="date-2" type="text" name="dateFrom" placeholder="Date From" onkeydown="return false;">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </aside>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Discount Offer</label>
                                            <div class="col-md-8 col-sm-8">
                                                <div class="radio radio-success radio-inline">
                                                    <input type="radio" checked="" name="discount" value="Yes" id="inlineRadio1">
                                                    <label for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="radio radio-success radio-inline">
                                                    <input type="radio" name="discount" value="No" id="inlineRadio2">
                                                    <label for="inlineRadio2">No</label>
                                                </div>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Discount for Age Group </label>
                                            <div class="col-md-8 col-sm-8">
                                                <select class="selectpicker" data-width="100%" name="company">
                                                    <option value="Female">700</option>
                                                    <option>500</option>

                                                </select>
                                            </div>
                                        </article>


                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Actual Pricing :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="actualPricing" type="text" name="actualPricing" required="" placeholder="9000">
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Discounted Pricing :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="discountPricing" type="text" name="discountPricing" required="" placeholder="7000">
                                            </div>
                                        </article>

                                        <!-- Other Info Section End -->

                                </div>
                            </section>
                            <section class="clearfix ">
                                <div class="col-md-12 m-t-20 m-b-20">
                                    <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                                    <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit">Submit</button>
                                </div>

                            </section>
                        </form>

                    </div>

                    <!-- consultation -->



                    <!-- Right Section End -->

                </div>

                <!-- container -->
            </div>
           