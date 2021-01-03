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
                <div class="fliters">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="margin-top: 9px; color: #605047;">Download Hospital Surgery File </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 bhoechie-tab-container">
                    <div class="col-md-12 bhoechie-tab">
                        <br>
                        <div class="table-responsive table-desi">
                            <table class="table table-hover" border="1" class="cell-border">
                                <thead>
                                    <tr>
                                        <th  class="text-center" data-orderable="false">S.No</th>
                                        <th  class="text-center" data-orderable="false">Patient Name</th>
                                        <th  class="text-center order-true" data-orderable="true">Surgery Type</th>
                                        <th  class="text-center" data-orderable="false">Doctor</th>
                                        <th  class="text-center" data-orderable="false">Discharge Date</th>
                                        <th  class="text-center" data-orderable="false">Hospital Surgery Doc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if (!empty($surgery_list)){ 
                                            $i = 1;
                                            foreach ($surgery_list as $value) {   
                                     ?>
                                    <tr align="center">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo ucfirst($value['patient_name']); ?></td>
                                        <td><?php echo ucfirst($value['surgery_name']); ?></td>
                                        <td><?php echo "Dr. ".$value['doctor_name']; ?></td>
                                        <td>
                                        <?php
                                            if (!empty($value['discarge_date'])) {
                                                        date("F j, Y", strtotime($value['discarge_date']));
                                            } else {
                                                echo 'Not found';
                                            }
                                        ?></td>
                                        <td>
                                            <?php echo '<a href="'.base_url().'download_patient_surgery_file/'. base64_encode($value['hospital_surgery_file']).'/'.$value['id'].'" target="_blank"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-cloud-download" fill="currentColor" style="color:#4ab733;">
                    <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"></path>
                    <path fill-rule="evenodd" d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"></path>
		</svg></a>'; ?>
                                        </td>
                                    </tr>
                                        <?php $i++; } }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
 
