<style>
    .dataTables_filter {
        float: right !important;
        padding-right: 10px;
    }
    table {border-collapse:collapse;}
    tr {border:2px solid #999;}
    
    
    table {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 13px;
    }
    
    .table > thead > tr > th{
       color: #000; 
    }
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
            <div class="agency-list">
                <div class="col-md-12 bhoechie-tab-container">
                    <div class="col-md-12 bhoechie-tab">
                        <div class="table-responsive table-desi">
                            <br>
                            <table class="table table-hover" id="opt_patient_table" border="1" class="cell-border">
                                <thead>
                                    <tr>
                                        <th  class="text-center" data-orderable="false">S.No</th>
                                        <th  class="text-center order-true" data-orderable="true">User Name</th>
                                        <th  class="text-center" data-orderable="false">User Email</th>
                                        <th  class="text-center order-true" data-orderable="true"> User Phone Number</th>
                                        <th  class="text-center" data-orderable="false">Access Type</th>
                                        <th>Edit</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $i = 1; 
                                    foreach ($users_list as $value) {
                                        ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo ucfirst($value->name); ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $value->mobile_no; ?></td>
                                        <td><?php if($value->user_type == 1){
                                            echo 'Admin'; 
                                        } else {
                                            echo 'Computer Operator'; 
                                        } ?></td>
                                        <td><a href="http://hospitalmanagement.com/edit_surgery_patient_details/<?php echo ($value->id); ?>" class="edit_c" style="background:#36b5c7;" target="_blank"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                        <td>
                                            <?php if ($value->active == 1) { ?>
                                            <a href="javascript:void(0);" class="btn btn-danger user_action" data-userid="<?php echo ($value->id); ?>" data-status="<?php echo ($value->active); ?>"  style="width: 100%;">Deactivate</a>
                                            <?php }else {?>
                                            <a href="javascript:void(0);" class="btn btn-success user_action" data-userid="<?php echo ($value->id); ?>" data-status="<?php echo ($value->active); ?>" style="width: 100%;">Active</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php $i++; } ?>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 <!-- bootstrap-daterangepicker -->
 <script>
 
 $(".user_action").on("click", function(){
     var user_id = $(this).data("userid");
     var status = $(this).data("status");
     if(confirm('Do you want to continue ?')){
        $.ajax({
           type: 'POST',
           url: '<?php echo base_url(); ?>admin_panel/manageuser_account',
           dataType: "json",
           ProcessData:true,
           cache:true,
           data:{user_id:user_id, status:status},
           success: function(result) {
               window.location.href ="<?php echo base_url(); ?>users_list";
           }
       });
     }
 });
 
 </script>

