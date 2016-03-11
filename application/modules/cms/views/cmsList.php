 <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">All Content Management System </h3>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox">


                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                            <form name="csvDownload" id="" action="<?php echo site_url('bloodbank/createCSV'); ?>" method="post">
                               <aside class="col-lg-1 col-md-2 col-sm-2">
                                    <a href="<?php echo base_url();?>index.php/cms/addcms" class="btn btn-appointment waves-effect waves-light" title="Add New CMS"><i class="fa fa-plus"></i> Add </a>
                                </aside>


                        <div class="bg-white">
                            <!-- Table Section Start -->
                            <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                                <table class="table all-bloodbank" id="datatable_bloodbank">
                                    <thead>
                                        <tr class="border-a-dull">
                                           
                                            <th>CMS Title</th>
                                            <th>CMS Description</th>
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
 