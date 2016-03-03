<!-- Begin page -->
<div id="wrapper">
    <!-- Start right Content here -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container row">
                <!-- consultation -->
                <div style="display:show;" id="consultDiv">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Add Appointments</h3>

                        </div>
                    </div>
                    <form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="#" novalidate="novalidate">

                        <!-- Left Section Start -->
                        <section class="col-md-6 detailbox">
                            <div class="bg-white mi-form-section">
                                <figure class="clearfix">
                                    <h3>Appointment Details</h3>
                                </figure>
                                <!-- Table Section End -->
                                <div class="clearfix m-t-20">

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Select City:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" id="appointment_city" name="appointment_city" data-width="100%" >
                                                <option value="">Select City</option>
                                                <?php if(isset($qyura_city) && $qyura_city != NULL){
                                                    foreach($qyura_city as $city){ ?>
                                                    <option value="<?php echo $city->city_id; ?>"><?php echo $city->city_name; ?></option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Appointment For :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" onchange="getHospital(this)" >
                                                <option value="">Select Type</option>
                                                <option value="0">Hospitals</option>
                                                <option value="1">Diagnostic Center</option>
                                            </select>
                                        </div>
                                    </article>
                                    
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Select :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" id="mi_centre" name="mi_centre">
                                                
                                            </select>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Appointment Type :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" onchange="changeForm(this.value)">
                                                <option value="0">Consultation</option>
                                                <option value="1">Diagnostic</option>
                                            </select>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Appointment Id :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control disabled" id="appointmentId" name="appointmentId" type="disabled" name="email" required="" aria-required="true" placeholder="ACM304">
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Speciallity :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="speciallity" id="speciallity" data-width="100%">
                                                <option>Cardiology</option>
                                                <option>Gynology</option>
                                            </select>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Assign Doctor :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="" id="" data-width="100%">
                                                <option>Dr. Sambit Jain</option>
                                                <option>Dr. Rohit Agrawal</option>
                                            </select>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Referred by :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="" id="" data-width="100%">
                                                <option>NA</option>
                                                <option>Dr. Karuna Roy </option>
                                            </select>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Date :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control pickDate" placeholder="dd/mm/yy" id="date-3" type="text" onkeydown="return false;" />
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Session :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="" id="" data-width="100%">
                                                <option>Morning</option>
                                                <option>Evening</option>
                                            </select>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Time Slot :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="" id="" data-width="100%">
                                                <option>08:00 AM - 10:00 AM</option>
                                                <option>10:00 AM - 12:00 AM</option>
                                            </select>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Final Timing :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="bootstrap-timepicker input-group w-full">
                                                <input id="timepicker4" type="text" class="form-control timepicker" />
                                            </div>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Patient Remarks :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <textarea class="form-control " id="patientRemark" name="patientRemark" required="" aria-required="true"></textarea>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Appointment Status :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="" id="" data-width="100%">
                                                <option>Confirmed</option>
                                                <option>Not Confirmed</option>
                                            </select>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">HMS Appointment ID (Optional) :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control " id="curl" type="url" name="url">
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Address:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%">
                                                        <option>India</option>
                                                        <option>Shrilanka</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <select class="selectpicker" data-width="100%">
                                                        <option>West Bengal</option>
                                                        <option>Oddisa</option>
                                                    </select>
                                                </div>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0 m-t-xs-10">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%">
                                                        <option>Kolkata</option>
                                                        <option>Delhi</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <input type="text" class="form-control" id="zip" nam="zip" placeholder="700001" />
                                                </div>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0 m-t-xs-10">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="209, ABC Road, near XYZ Building " />
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
                                <!-- Patient Section Start -->

                                <figure class="clearfix">
                                    <h3>Patient Details</h3>
                                </figure>
                                <aside class="clearfix m-t-20">
                                    <article class="form-group m-lr-0 m-rl-o">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Patient Email Id :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="patient_email" name="patient_email" type="email" required="" aria-required="true" placeholder="Test@gmail.com" onblur="getpatientdetails()">
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Patient Mobile Number :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="users_mobile" name="users_mobile" type="text" required="" aria-required="true" placeholder="Mobile Number" >
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Patient Id:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%">
                                                <option>ACM002</option>
                                                <option>AEB351</option>
                                            </select>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Patient Name:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="users_username" name="users_username" type="text" required="" aria-required="true" placeholder="Name" >
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%">
                                                        <option>India</option>
                                                        <option>Shrilanka</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <select class="selectpicker" data-width="100%">
                                                        <option>West Bengal</option>
                                                        <option>Oddisa</option>
                                                    </select>
                                                </div>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0 m-t-xs-10">
                                        <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%">
                                                        <option>Kolkata</option>
                                                        <option>Delhi</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <input type="text" class="form-control" id="zip" nam="zip" placeholder="700001" />
                                                </div>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0 m-t-xs-10">
                                        <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="209, ABC Road, near XYZ Building " />
                                        </div>
                                    </article>
                                </aside>
                                <!-- Patient Section Start -->


                                <!-- Payment Section Start -->
                                <figure class="clearfix">
                                    <h3>Payment Details</h3>
                                </figure>
                                <aside class="clearfix m-t-20">
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Consulation Fee:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="consulationFee" name="consulationFee" placeholder="500" />
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Other Fee:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="otherFee" name="otherFee" placeholder="0" />
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Tax :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="tax" id="name" data-width="100%">
                                                <option>5%</option>
                                                <option>10%</option>
                                            </select>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Total Payable Amount:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="totalPayableAmount" name="totalPayableAmount" placeholder="525" />
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Payment Status :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="paymentStatus" id="paymentStatus" data-width="100%">
                                                <option>Paid</option>
                                                <option>Unpaid</option>
                                            </select>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Payment Mode:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="paymentMode" name="paymentMode" placeholder="Cash" />
                                        </div>
                                    </article>

                                </aside>

                                <!-- Payment Section End -->

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
            </div>
            <!-- container -->
        </div>
        <!-- content -->
        <footer class="footer text-right">
            2015 © Qyura.
        </footer>
    </div>
    <!-- End Right content here -->
</div>
<!-- END wrapper -->

<script>
    var resizefunc = [];
    
    function getHospital(obj){
        var city_id = $("#appointment_city").val();
        var appointment_type = $("#"+obj).val();
        alert(city_id);
        alert(appointment_type);
        var url = '<?php echo site_url();?>/miappointment/getHospital/';
        $.ajax({
            url:url,
            async:false,
            type: 'POST',
            data:{'city_id':city_id,'appointment_type':appointment_type},
            beforeSend: function (xhr) { },
            success: function (data) {
                console.log(data);
                $('#mi_centre').html(data);
               // $('#editDiv').modal('show');
            }      
        });
    }
    
    function getpatientdetails(){
        var patient_email = $("#patient_email").val();
        var url = '<?php echo site_url();?>/miappointment/getpatient/';
        $.ajax({
            url:url,
            async:false,
            type: 'POST',
            data:{'patient_email':patient_email},
            beforeSend: function (xhr) { },
            success: function (data) {
                $('#editForm').html(data);
               // $('#editDiv').modal('show');
            }      
        });
    }
</script>