
        <!-- Left Sidebar End -->
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Favorited By</h43>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-8 detailbox">


                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                            <form>
                                <aside class="col-md-3 col-sm-3">
                                    <select class="form-control">
                                        <option>Existing User</option>
                                        <option>New User</option>

                                    </select>
                                </aside>
                                <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                                    <div class="input-group">
                                        <input class="form-control pickDate" placeholder="From" id="date-1" type="text" onkeydown="return false;">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </aside>

                                <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                                    <div class="input-group">
                                        <input class="form-control pickDate" placeholder="To" id="date-2" type="text" onkeydown="return false;">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </aside>
                                <aside class="col-md-3 col-sm-3 pull-right">
                                    <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit">Export</button>
                                </aside>

                            </form>
                        </article>
                        
                        <!-- Form Section End -->

                       <div class="bg-white">
                            <!-- Table Section Start -->
                        <article class="clearfix p-t-20 p-b-20">
                        <?php print_r($favData); ?>
                          <div id="postList">
                        <!--start section -->
                           <?php if(isset($favData) && !empty($favData)){
                               foreach($favData as $key=>$val){
                                   echo $val;
                           }}
                               ?>
                            <aside class="width-20p text-center">
                                <img src="<?php if($val->img != ''){ echo base_url("assets/doctorsImages/$val->img"); }else{ echo 'noimage'; } ?>" class="img-responsive center-block"/>
                                <div class="overlay">
                                    <a href="<?php echo $val->userId; ?>" class="btn btn-xs btn-success m-tm-20">View Detail1</a>
                                </div>
                                <h4><?php echo $val->patientName; ?></h4>
                                <p><?php echo $val->email; ?></p>
                            </aside>
                               <?php // } } ?>
                          </div>
                            <!--end section -->
                              
                        </article>
                        <!-- Table Section End -->
                        <article class="clearfix m-t-20 p-b-20">
                            <ul class="list-inline list-unstyled pull-right call-pagination">
                                <li class="disabled"><a href="#">Prev</a></li>
                                <li><a href="#">1</a></li>
                                <li class="active"><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">Next</a></li>
                            </ul>
                        </article>
                </div>

                </section>
                <!-- Left Section End -->



                <!-- Right Section Start -->
                <section class="col-md-4 detailbox">
                    <div class="bg-white">
                        <figure class="clearfix">
                           
                                <h3>Summary</h3>

                            </figure>

                            <!-- Likes Detail Section Start -->

                            <article class="clearfix">
                                <h5 class="col-md-8 col-xs-8">Total Likes :</h5>
                                <h4 class="col-md-4 col-xs-4 text-right">1435</h4>
                            </article>

                            <article class="clearfix">
                                <h5 class="col-md-8 col-xs-8">Existing Patient Likes</h5>
                                <h4 class="col-md-4 col-xs-4 text-right">570</h4>
                            </article>


                            <article class="clearfix">
                                <h5 class="col-md-8 col-xs-8">New Patient Likes</h5>
                                <h4 class="col-md-4 col-xs-4 text-right">860</h4>
                            </article>
                            <!-- Likes Detail Section End -->

                            <!--Recent Likes -->
                            <article class="clearfix m-t-30">
                                <figure class="clearfix">
                                    <h3>Recent Likes</h3>
                                </figure>

                                <div tabindex="5000" style="overflow: hidden;" class="inbox-widget nicescroll mx-box">
                                    <aside class="table-responsive">
                                        <table class="table recent-likes">
                                            <tr>
                                                <td>
                                                    <h6><img src="assets/images/patient-1.jpg" alt="" class="img-responsive" /></h6>
                                                </td>
                                                <td>
                                                    <h6>Ramesh Solanki</h6>
                                                    <p>abc@gmail.com</p>
                                                </td>
                                                <td class="text-right">
                                                    <p>1 hours ago</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6><img src="assets/images/patient-2.jpg" alt="" class="img-responsive" /></h6>
                                                </td>
                                                <td>
                                                    <h6>Ramesh Solanki</h6>
                                                    <p>abc@gmail.com</p>
                                                </td>
                                                <td class="text-right">
                                                    <p>1 hours ago</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6><img src="assets/images/patient-1.jpg" alt="" class="img-responsive" /></h6>
                                                </td>
                                                <td>
                                                    <h6>Ramesh Solanki</h6>
                                                    <p>abc@gmail.com</p>
                                                </td>
                                                <td class="text-right">
                                                    <p>1 hours ago</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6><img src="assets/images/patient-2.jpg" alt="" class="img-responsive" /></h6>
                                                </td>
                                                <td>
                                                    <h6>Ramesh Solanki</h6>
                                                    <p>abc@gmail.com</p>
                                                </td>
                                                <td class="text-right">
                                                    <p>1 hours ago</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6><img src="assets/images/patient-1.jpg" alt="" class="img-responsive" /></h6>
                                                </td>
                                                <td>
                                                    <h6>Ramesh Solanki</h6>
                                                    <p>abc@gmail.com</p>
                                                </td>
                                                <td class="text-right">
                                                    <p>1 hours ago</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </aside>
                                </div>
                            </article>
                            <!--Recet Likes -->

                            <!--Likes Trend bar Chart -->
                            <article class="chartbox m-t-30">
                                <div class="bg-white">
                                    <figure class="clearfix">

                                        <h3>Like Trend</h3>

                                    </figure>
                                    <aside>
                                        <canvas id="like_trend" class="bar-fwth" data-type="Bar" height="200"></canvas>
                                    </aside>
                                    <form role="form" class="form-horizontal m-t-10">
                                        <aside class="clearfix call-track-form text-center p-b-20">

                                            <div class="col-md-5 col-md-offset-1 col-sm-4 col-sm-offset-2">
                                                <select class="form-control">
                                                    <option>2015</option>
                                                    <option>2014</option>
                                                    <option>2013</option>
                                                    <option>2012</option>
                                                    <option>2011</option>
                                                </select>
                                            </div>

                                            <div class="col-md-5 col-sm-4 m-tb-xs-3">
                                                <select class="form-control">
                                                    <option>Jan</option>
                                                    <option>Feb</option>
                                                    <option>Mar</option>
                                                    <option>Apr</option>
                                                </select>
                                            </div>
                                        </aside>
                                    </form>
                                </div>
                            </article>
                            <!--Like Trend bar Chart -->

                        </div>
                        </section>
                        <!-- Right Section End -->

                    </div>

                    <!-- container -->
                </div>
                <!-- content -->
                <footer class="footer text-right">
                    2015 © Qyura.
                </footer>
            </div>
            <!-- End Right content here -->
       