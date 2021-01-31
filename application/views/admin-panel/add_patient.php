<style>
#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:90%;position: absolute; z-index: 99999;  }
#country-list li{padding: 10px; color:#FFF ; background: #8b5c7e; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2; color:graytext;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>
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
                        <?php if(($this->session->userdata['userType'] == 3 || $this->session->userdata['userType'] == 1) && $this->uri->segment(1) == 'add_opd_patient'){ ?>
                        <div class="bhoechie-tab-content active">
                                <div class="profile-detail-tab">
                                    <h4 class="tab-head">ADD OPD PATIENTS DETAILS</span></h4>
                                    <form name="add_opd_patient" id="add_opd_patient" method="post" action="<?php echo base_url(); ?>admin_panel/process_add_opd_patient" class="form-alt">
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>OPD Number Id</label>
                                                <input class="form-control" type="text" name="opd_number_id" id="opd_number_id" placeholder="Enter OPD Number Id" required="">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Patient Name</label>
                                                <input class="form-control" type="text" name="patient_name" id="patient_name" placeholder="Enter Patient Name">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Contact Number</label>
                                                <input class="form-control" type="number" min="0" name="contact_number" id="contact_number" placeholder="Enter Contact Number">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Date</label>
                                                <input class="form-control" type="text" name="date" id="date" placeholder="DD/MM/YYYY">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Valid</label>
                                                <input class="form-control" type="text" name="valid_date" id="valid_date" placeholder="DD/MM/YYYY">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Shift</label>
                                                <input class="form-control" type="text" name="shift" id="shift" placeholder="Enter shift">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Department</label>
                                                <input class="form-control" type="text" name="department" id="department" placeholder="Enter Department">
<!--                                                <select class="form-control" name="sex" id="sex">
                                                    <option disabled="" selected="">Select Sex</option>
                                                    <?php 
                                                            $sex_array = array('male'=> 'Male', 'female'=>'Female', 'other' => 'Other'); 
                                                            foreach ($sex_array as $key => $val) {
                                                        ?>
                                                    <option value="<?php echo  $key; ?>"><?php echo  $val; ?></option>
                                                    <?php } ?>
                                                </select>-->
                                                
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Guardian Name</label>
                                                <input class="form-control" type="text" name="guardian_name" id="guardian_name" placeholder="Enter Guardian Name">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Doctor</label>
                                                
                                                <select class="form-control" name="doctor_id" id="doctor_id">
                                                    <option disabled="" selected="">Select Doctor Name</option>
                                                    <?php 
                                                        if(!empty($doctor_list)){
                                                            foreach ($doctor_list as $value){
                                                    ?> 
                                                    <option value="<?php echo  $value['id']; ?>"><?php echo strtoupper($value['name']); ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-6 col-xs-6">
                                                <label>Address</label>
                                                <textarea class="form-control" rows="1" cols="10" name="address" id="address" placeholder="Enter Address..."></textarea>
                                            </div>
                                        </div>
                                        <div class="row" style="text-align: center;">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } else if($this->session->userdata['userType'] == 1){   ?>
                        <div class="bhoechie-tab-content active">
                                <div class="profile-detail-tab">
                                    <h4 class="tab-head">Surgery DETAILS</span></h4>
                                    <form name="surgery_patient_form_id" id="surgery_patient_form_id" method="post" action="<?php echo base_url(); ?>admin_panel/process_add_patient_surgery_list" class="form-alt" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Patient Name</label>
                                                <input type="hidden" id="surgery_patient_id" name="surgery_patient_id" />
                                                <input type="text" class="form-control" id="surgery_patient_name" name="surgery_patient_name" value="" placeholder="Select Patient Name">
                                                <div id="suggesstion-box"></div>
                                                
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Surgery Type</label>
                                                <select class="form-control" name="surgery_type" id="surgery_type">
                                                    <option disabled="" selected="">Select Surgery Type</option>
                                                    <?php 
                                                        if(!empty($surgery_list)){
                                                            foreach ($surgery_list as $value){
                                                    ?> 
                                                    <option value="<?php echo  $value['id']; ?>"><?php echo strtoupper($value['surgery_name']); ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Doctor Name</label>
                                                <select class="form-control" name="doctor_id" id="doctor_id">
                                                    <option disabled="" selected="">Select Doctor Name</option>
                                                    <?php 
                                                        if(!empty($doctor_list)){
                                                            foreach ($doctor_list as $value){
                                                    ?> 
                                                    <option value="<?php echo  $value['id']; ?>"><?php echo "Dr. " . strtoupper($value['name']); ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Surgery Date</label>
                                                <input class="form-control" type="text" name="surgery_date" id="surgery_date" placeholder="DD/MM/YYYY">
                                            </div>
                                                                                  
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Adhar No.</label>
                                                <input class="form-control" type="number"  name="patient_adhar_number" id="patient_adhar_number" placeholder="Enter Adhar No">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Surgery Amount</label>
                                                <input class="form-control" type="number" min="0" name="surgery_amount" id="surgery_amount" placeholder="Enter Surgery Amount">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Discount Amount</label>
                                                <input class="form-control" type="number" min="0" name="discount_amount" id="discount_amount" placeholder="Enter Discount Amount">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Advance Amount</label>
                                                <input class="form-control" type="number" min="0" name="advance_amount" id="advance_amount" placeholder="Enter Advance Amount">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Pending Amount</label>
                                                <input class="form-control" type="number" min="0" name="pending_amount" id="pending_amount" placeholder="Enter Pending Amount" readonly="">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Advance Taken By</label>
                                                <input class="form-control" type="text" name="advance_taken" id="advance_taken" placeholder="Enter Person Name">
                                            </div>
                                            
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Patient Risk Bound</label>
                                                <input class="form-control" type="file" name="patient_risk_bound" id="patient_risk_bound">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Other Doctor Referrer File</label>
                                                <input class="form-control" type="file" name="referrer_file" id="referrer_file">
                                            </div>
                                            
                                        </div>
                                        <div class="row" style="text-align: center;">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>                            
                        <?php } ?>
                    </div>
                </div>
            </div> 
        </div>
    </section>
     
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>cpanel/css/select2.min.css">
  <script src="<?php echo base_url(); ?>cpanel/js/select2.min.js"></script>
    <script>
                
//        $("#surgery_patient_name").select2();
//        $("#surgery_type").select2();
//        $("#doctor_id").select2();
        
$(document).ready(function(){
 $("#surgery_patient_name").keyup(function(){
        $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>/admin_panel/get_patient_lists",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
                $("#surgery_patient_name").css("background","#FFF no-repeat 165px");
        },
        success: function(data){
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#surgery_patient_name").css("background","#FFF");
        }
        });
    });
});

function selectPatientName(val, name) {
    $("#surgery_patient_id").val(val);
    $("#suggesstion-box").hide();
    $("#surgery_patient_name").val(name);
}
      
        
        $( function() {
          $( "#date" ).datepicker({dateFormat: 'dd-mm-yy'});
          $( "#valid_date" ).datepicker({dateFormat: 'dd-mm-yy'});
          $( "#surgery_date" ).datepicker({dateFormat: 'dd-mm-yy'});
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
        
        $("#advance_amount, #discount_amount, #surgery_amount").on("blur",function(){
            var surgery_amount = $("#surgery_amount").val();
            var advance_amount = $("#advance_amount").val();
            if(surgery_amount ==''){
                surgery_amount = 0;
            }
            var discount_amount = $("#discount_amount").val();
            if(discount_amount == ''){
                discount_amount = 0;
            }
            amount_pending = ((surgery_amount -advance_amount) - discount_amount).toFixed(2);
            $("#pending_amount").val(amount_pending);

        });    
        
</script>
<script src="<?php echo base_url(); ?>cpanel/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>cpanel/js/customs.js"></script>