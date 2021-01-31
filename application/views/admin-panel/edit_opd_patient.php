
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="page-title">
                    <h5><marquee behavior="scroll" direction="left" scrollamount="10"><span style="color: #fefdfd;">LIFE LINE HOPITAL AND ADVANCE STONE CLINIC</span></marquee></h5>
                </div>
            </div>
        </div>
        <br>
        <div class="row text-center">
            <div class="col-md-12">
        <?php 
        if($this->session->flashdata('status')){
        ?>
       <div class="alert alert-success"> 
       <?php  echo $this->session->flashdata('status'); ?>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
           </button>
       </div>
       <?php    
        } else if($this->session->flashdata('error')){
        ?>
       <div class = "alert alert-danger">
       <?php echo $this->session->flashdata('error'); ?>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
      </div>
     <?php } ?>
          </div>
       </div>
        <div class="row">
            <div class="add-agency">
                <div class="col-md-12 bhoechie-tab-container">
                    <div class="col-md-12 bhoechie-tab">
                        <div class="bhoechie-tab-content active">
                                <div class="profile-detail-tab">
                                    <h4 class="tab-head">Edit OPD PATIENTS DETAILS</span></h4>
                                    <form name="edit_opd_patient" id="add_opd_patient" method="post" action="<?php echo base_url(); ?>admin_panel/process_edit_opd_patient" class="form-alt">
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>OPD Number Id.</label>
                                                <input class="form-control" type="text" name="opd_number_id" id="opd_number_id" value="<?php if($patient_list['opd_number_id']){ echo $patient_list['opd_number_id']; } ?>" readonly="" placeholder="Enter OPD Number Id">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Patient Name</label>
                                                <input class="form-control" type="text" name="patient_name" id="patient_name" value="<?php if($patient_list['patient_name']){ echo $patient_list['patient_name']; } ?>" placeholder="Enter Patient Name">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Contact Number</label>
                                                <input class="form-control" type="number" min="0" name="contact_number" id="contact_number" value="<?php if($patient_list['contact_number']){ echo $patient_list['contact_number']; } ?>" placeholder="Enter Contact Number">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Date</label>
                                                <input class="form-control" type="text" name="date" id="date" value="<?php if($patient_list['date']){ echo $patient_list['date']; } ?>" placeholder="DD/MM/YYYY">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Valid</label>
                                                <input class="form-control" type="text" name="valid_date" id="valid_date" value="<?php if($patient_list['valid_date']){ echo $patient_list['valid_date']; } ?>" placeholder="DD/MM/YYYY">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Shift</label>
                                                <input class="form-control" type="text" name="shift" id="shift" value="<?php if($patient_list['shift']){ echo $patient_list['shift']; } ?>" placeholder="Enter shift">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Department</label>
                                                <input class="form-control" type="text" name="department" id="department" value="<?php if($patient_list['department']){ echo $patient_list['department']; } ?>" placeholder="Enter department">
<!--                                                <select class="form-control" name="sex" id="sex">
                                                    <option disabled="" selected="">Select Sex</option>
                                                    <?php 
                                                            $sex_array = array('male'=> 'Male', 'female'=>'Female', 'other' => 'Other'); 
                                                            foreach ($sex_array as $key => $val) {
                                                        ?>
                                                    <option value="<?php echo  $key; ?>" <?php if($patient_list['sex'] == $key){ echo 'selected'; } ?>><?php echo  $val; ?></option>
                                                    <?php } ?>
                                                </select>-->
                                                
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Guardian Name</label>
                                                <input class="form-control" type="text" name="guardian_name" id="guardian_name" placeholder="Enter Guardian Name" value="<?php if($patient_list['guardian_name']){ echo $patient_list['guardian_name']; } ?>">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Doctor</label>
                                                <select class="form-control" name="doctor_id" id="doctor_id">
                                                    <option disabled="" selected="">Select Doctor Name</option>
                                                    <?php 
                                                        if(!empty($doctor_list)){
                                                            foreach ($doctor_list as $value){
                                                    ?> 
                                                    <option value="<?php echo  $value['id']; ?>" <?php if($patient_list['doctor_id'] == $value['id']){ echo 'selected'; } ?>><?php echo strtoupper($value['name']); ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-6 col-xs-6">
                                                <label>Address</label>
                                                <textarea class="form-control" rows="1" cols="10" name="address" id="address" placeholder="Enter Address..."><?php if($patient_list['address']){ echo $patient_list['address']; } ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row" style="text-align: center;">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <input type="hidden" name="patient_id" value="<?php echo $patient_list['id']; ?>">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>                        
                    </div>
                </div>
            </div> 
        </div>
    </section>
     
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
          $( "#date" ).datepicker({dateFormat: 'dd-mm-yy'});
          $( "#valid_date" ).datepicker({dateFormat: 'dd-mm-yy'});
        }); 
    
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	});

	$(document).ready(function() {
            $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                var index = $(this).index();
                $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
            });
	});
</script>
<script src="<?php echo base_url(); ?>cpanel/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>cpanel/js/customs.js"></script>