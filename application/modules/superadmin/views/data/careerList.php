<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Enquiry Email's</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($emailList) && $emailList != NULL){ 
                                foreach ($emailList as $email){ ?>
                            <tr class="gradeX">
                                <td><?php echo $email->emailList; ?></td>
                                <td><?php echo date("d-m-Y ", strtotime($email->createAt));  ?></td>
                                <td><?php echo date("g:i A",strtotime($email->createAt));  ?></td>
                                <td></td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Career</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Position</th>
                                <th>City</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Resume</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($carrierData) && $carrierData != NULL){ 
                                foreach ($carrierData as $carrier){ ?>
                            <tr class="gradeX">
                                <td><?php echo $carrier->carrierName; ?></td>
                                <td><?php echo $carrier->carrierEmail; ?></td>
                                <td><?php echo $carrier->carrierPhone; ?></td>
                                <td><?php echo $carrier->carrierPosition; ?></td>
                                <td><?php echo $carrier->carrierCity; ?></td>
                                <td><?php echo date("d-m-Y ", strtotime($carrier->createAt));  ?></td>
                                <td><?php echo date("g:i A",strtotime($carrier->createAt));  ?></td>
                                <td><a target="_blank" href="<?php echo $carrier->carrierResume; ?>">Resume</a></td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Request a Callback</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Call Time</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($callbackList) && $callbackList != NULL){ 
                                foreach ($callbackList as $callback){ ?>
                            <tr class="gradeX">
                                <td><?php echo $callback->callbackName; ?></td>
                                <td><?php echo $callback->callbackEmail; ?></td>
                                <td><?php echo $callback->callbackMobile; ?></td>
                                <td><?php if($callback->callbackTime == 1){echo "Before 10 AM";}
                                          elseif($callback->callbackTime == 2){echo "10 AM - 2 PM";}
                                          elseif($callback->callbackTime == 3){echo "2 PM - 6 PM";}
                                          elseif($callback->callbackTime == 4){echo "6 PM - 10 PM";}?>
                                </td>
                                <td><?php echo date("d-m-Y ", strtotime($callback->createAt));  ?></td>
                                <td><?php echo date("g:i A",strtotime($callback->createAt));  ?></td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>