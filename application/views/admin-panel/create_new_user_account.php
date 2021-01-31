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
                                    <h4 class="tab-head">Create New User Login</span></h4>
                                    <form name="create_new_login" id="create_new_login" method="post" action="<?php echo base_url(); ?>admin_panel/process_create_new_user_account" class="form-alt" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label> Name</label>
                                                <input type="text" class="form-control" id="user_name" name="user_name" value="" placeholder="Enter User Name">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                               <label>Email</label>
                                               <input type="text" class="form-control" id="user_email" name="user_email" value="" placeholder="Enter User Email">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Phone No.</label>
                                                <input type="text" class="form-control" id="user_phone" name="user_phone" value="" placeholder="Enter Phone No.">
                                            </div>
                                            
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Permission</label>
                                                <select name="user_type" id="user_type" class="form-control">
                                                    <option selected="" disabled="">Select Access Type </option>
                                                    <option value="1">Admin</option>
                                                    <option value="3">Computer Operator</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>User Password</label>
                                                <input class="form-control" type="password" name="password" id="password" value="" placeholder="Enter Password">
                                            </div>
                                            
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                                <label>Confirm Password</label>
                                                <input class="form-control" type="password" name="confirm_password" id="confirm_password" value="" placeholder="Enter Confirm Password">
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
                    </div>
                </div>
            </div> 
        </div>
        <br><br><br><br>
    </section>
<script src="<?php echo base_url(); ?>cpanel/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>cpanel/js/customs.js"></script>

<script>
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
</script>
