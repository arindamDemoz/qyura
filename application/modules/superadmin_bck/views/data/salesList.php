<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Partner With Us</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Location</th>
                                <th class="col-md-3">Services</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($partnerList) && $partnerList != NULL){ 
                                foreach ($partnerList as $partner){ ?>
                            <tr class="gradeX">
                                <td><?php echo $partner->partnerName; ?></td>
                                <td><?php echo $partner->partnerEmail; ?></td>
                                <td><?php echo $partner->partnerMobile; ?></td>
                                <td><?php echo $partner->partnerLocation; ?></td>
                                <td class="col-md-3"><?php echo $partner->partnerService; ?>, <?php if($partner->otherServiceText != NULL){ echo $partner->otherServiceText; } ?></td>
                                <td><?php echo date("d-m-Y ", strtotime($partner->createAt));  ?></td>
                                <td><?php echo date("g:i A",strtotime($partner->createAt));  ?></td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>