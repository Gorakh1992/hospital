<link href="<?php echo base_url(); ?>cpanel/css/imageuploadify.min.css" rel="stylesheet">
<style>
 .btn-default {
    display: block;
    color: #3AA0FF;
    border-color: #3AA0FF;
    border-radius: 1em;
    margin: 25px auto;
    max-width: 500px;
  }

.btn-default {
    border-color: #f096aa !important;
    color: #f096aa !important;
    margin: 0px auto !important;
    margin-bottom: 15px !important;
}

.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
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
                <div class = "alert alert-danger" id="error_id" style="display: none;">
                  Upload files having extensions: ( .xlsx, .xls )
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="resetFile()">
                       <span aria-hidden="true">&times;</span>
                   </button>
              </div>
                
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
                            <div class="upload-tab">
                                <h4 class="tab-head">Upload OPD PATIENTS FILE</h4>
                                <div class="custom-upload">
                                    <form name="opd_patient_upload" id="opd_patient_upload" method="post" action="<?php echo base_url(); ?>admin_panel/process_upload_opd_patient" class="form-alt" enctype="multipart/form-data">
                                        <div class="imageuploadify well">
                                            <div class="imageuploadify-overlay">
                                                <i class="fa fa-picture-o"></i>
                                            </div>
                                            <div class="imageuploadify-images-list text-center">
                                                <i class="fa fa-cloud-upload"></i>
                                                <span class="imageuploadify-message">Drag&amp;Drop Your File(s)Here To Upload</span>
                                                <input type="file" accept=".xlsx,.xls" name="file" id="patient_file" style="background: white;" class="btn btn-default">
                                            </div>
                                        </div>
                                   
                                </div>
                                <br>
                                    <div class="row" style="text-align: center;">
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <button type="submit" class="btn btn-primary" id="upload_patient_file">Upload</button>
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
</section>
     
    <script>
        
        $("body").on("click", "#upload_patient_file", function () {
            var allowedFiles = [".xls", ".xlsx"];
            var fileUpload = $("#patient_file");
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:()])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(fileUpload.val().toLowerCase())) {
                $("#error_id").css({'display':'block'});
                return false;
            }
        });     
       
        function resetFile() {
          const file = document.querySelector('#patient_file');
          file.value = '';
        }

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