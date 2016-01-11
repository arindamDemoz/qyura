<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo strtoupper($tablename);?></h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th>Center Name</th>
                                <th>Center Email</th>
                                <th>Contact Person</th>
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($serviceData) != NULL){ 
                                foreach ($serviceData as $serviceDataList){ ?>
                            <tr class="gradeX">
                                <td><?php echo $serviceDataList->centerName; ?></td>
                                <td><?php echo $serviceDataList->centerEmail;  ?></td>
                                <td><?php echo $serviceDataList->contactPerson;  ?></td>
                                <td><a href="<?php echo site_url("vendorview/vendorCustomView")."/$tablename/$serviceDataList->vendorId"  ?>">View</a> &nbsp;<?php if($serviceDataList->updateStatus==1){?><img src="<?php echo site_url()?>assest/img/notification.jpg" style="width: 6%;" title="Requested For Changes"> <?php }?></td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   </div> 