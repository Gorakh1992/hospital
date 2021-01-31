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
                        <div class="bhoechie-tab-content active">
                                <div class="profile-detail-tab">
                                    <h4 class="tab-head">Edit Surgery DETAILS</span></h4>
                                    <form name="edit_surgery_patient_form_id" id="edit_surgery_patient_form_id" method="post" action="<?php echo base_url(); ?>admin_panel/process_edit_patient_surgery" class="form-alt" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Patient Name</label>
                                                <input type="hidden" id="surgery_patient_id" name="surgery_patient_id" value="<?php if($surgery_patient['patient_id']){ echo $surgery_patient['patient_id']; } ?>" />
                                                <input type="text" class="form-control" id="surgery_patient_name" name="surgery_patient_name" value="<?php if($surgery_patient['patient_name']){ echo $surgery_patient['patient_name']; } ?>" placeholder="Select Patient Name">
                                                <div id="suggesstion-box"></div>
<!--                                                <select class="form-control" name="surgery_patient_name" id="surgery_patient_name">
                                                    <option disabled="" selected="">Select Patient Name</option>
                                                    <?php 
                                                        if(!empty($patient_list)){
                                                            foreach ($patient_list as $value){
                                                    ?> 
                                                    <option value="<?php echo  $value['id']; ?>"><?php echo strtoupper($value['patient_name']); ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>-->
                                                
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Surgery Type</label>
                                                <select class="form-control" name="surgery_type" id="surgery_type">
                                                    <option disabled="" selected="">Select Surgery Type</option>
                                                    <?php 
                                                        if(!empty($surgery_list)){
                                                            foreach ($surgery_list as $value){
                                                    ?> 
                                                    <option value="<?php echo  $value['id']; ?>" <?php if($value['id'] == $surgery_patient['surgery_type_id']){ echo 'selected'; } ?>><?php echo strtoupper($value['surgery_name']); ?></option>
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
                                                    <option value="<?php echo  $value['id']; ?>" <?php if($value['id'] == $surgery_patient['doctor_id']){ echo 'selected'; } ?>><?php echo "Dr. " . strtoupper($value['name']); ?></option>
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
                                                <input class="form-control" type="number"  name="patient_adhar_number" id="patient_adhar_number" placeholder="Enter Adhar No" value="<?php echo $surgery_patient['patient_adhar_number']; ?>">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Surgery Amount</label>
                                                <input class="form-control" type="number" min="0" name="surgery_amount" id="surgery_amount" value="<?php echo $surgery_patient['surgery_amount']; ?>" placeholder="Enter Surgery Amount">
                                            </div>
                                            
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Discount Amount</label>
                                                <input class="form-control" type="number" min="0" name="discount_amount" id="discount_amount" value="<?php echo $surgery_patient['discount_amount']; ?>" placeholder="Enter Discount Amount">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Advance Amount</label>
                                                <input class="form-control" type="number" min="0" name="advance_amount" id="advance_amount" value="<?php echo $surgery_patient['advance_amount']; ?>" placeholder="Enter Advance Amount">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Pending Amount</label>
                                                <input class="form-control" type="number" min="0" name="pending_amount" id="pending_amount" value="<?php echo $surgery_patient['pending_amount']; ?>" placeholder="Enter Pending Amount" readonly="">
                                            </div>
                                            
                                                                                       
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Patient Risk Bound</label>
                                                <input class="form-control" type="file" name="patient_risk_bound" id="patient_risk_bound">
                                                <input class="form-control" type="hidden" name="old_patient_risk_bound" id="old_patient_risk_bound" value="<?php echo ($surgery_patient['parent_risk_bound_file']); ?>">
                                            </div>
                                            
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Patient Surgery File</label>
                                                <input class="form-control" type="file" name="patient_surgery_file[]" id="patient_surgery_file" multiple="">
                                                <?php foreach ($surgery_files as $value){ ?>
                                                <input class="form-control" type="hidden" name="old_patient_surgery_file[]"  value="<?php echo ($value['hospital_surgery_file']); ?>">
                                                <?php } ?>
                                            </div>
                                            
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Other Doctor Referrer File</label>
                                                <input class="form-control" type="file" name="referrer_file" id="referrer_file">
                                                <input class="form-control" type="hidden" name="old_referrer_file" id="referrer_file" value="<?php echo ($value['hospital_surgery_file']); ?>">
                                            </div>
                                            
                                        </div>
                                        <div class="row" style="text-align: center;">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <input type="hidden" name="edit_id" value="<?php echo $surgery_patient['id']; ?>">
                                                <button type="submit" class="btn btn-primary">Submit</button>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
          $( "#surgery_date" ).datepicker({dateFormat: 'dd-mm-yy'});
          $('#surgery_date').datepicker("setDate", new Date("<?php echo trim(date("d-m-Y", strtotime($surgery_patient['surgery_date']))); ?>"));
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


$("#advance_amount, #discount_amount, #surgery_amount, #surgery_amount").on("blur",function(){
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