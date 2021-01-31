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
                    	<div class="col-md-2">
                    		<p style="margin-top: 9px;">OPD Search: </p>
                    	</div>
                    	<div class="col-md-5">
                            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                            <input type="hidden" name="start_date" id="start_date" value="">
                            <input type="hidden" name="end_date" id="end_date" value="">
                    	</div>
                        <div class="col-md-3">
                            <select id="doctor_id" name="doctor_id">
                                <option selected="" value="">Select Doctor Name</option>
                                <?php foreach ($doctor_list as $value){ ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo "Dr. ".ucfirst($value['name']); ?></option>
                                <?php } ?>
                            </select>
                    	</div>
                        <div class="col-md-2">
                            <button type="button" id="search_opd_patient" class="btn btn-primary">Search</button>
                    	</div>
                    </div>
                	
                </div>
                <div class="col-md-12 bhoechie-tab-container">
                    <div class="col-md-12 bhoechie-tab">
                        <div class="table-responsive table-desi">
                            <table class="table table-hover" id="opt_patient_table" border="1" class="cell-border">
                                <thead>
                                    <tr>
                                        <th  class="text-center" data-orderable="false">S.No</th>
                                        <th  class="text-center order-true" data-orderable="true">OPD Number Id</th>
                                        <th  class="text-center" data-orderable="false">Patient Name</th>
                                        <th  class="text-center" data-orderable="false">Department</th>
                                        <th  class="text-center" data-orderable="false">Date</th>
                                        <th  class="text-center" data-orderable="false">Valid</th>
                                        <th  class="text-center" data-orderable="false">Shift</th>
                                        <th  class="text-center" data-orderable="false">OPD Type</th>
                                        <th  class="text-center" data-orderable="false">Guardian Name</th>
                                        <th  class="text-center" data-orderable="false">Doctor</th>
                                        <th  class="text-center" data-orderable="false">Address</th>
        <!--                            <th>Edit</th>-->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
<link href="<?php echo base_url(); ?>cpanel/css/buttons.dataTables.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>cpanel/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>cpanel/data-table-js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>cpanel/data-table-js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>cpanel/data-table-js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>cpanel/data-table-js/responsive.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>cpanel/data-table-js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>cpanel/data-table-js/dataTables.select.min.js"></script>
 <!-- bootstrap-daterangepicker -->
 <script src="<?php echo base_url(); ?>cpanel/data-table-js/moment.min.js"></script>   
<script type="text/javascript">
    var opt_patient_table;
    var time = moment().format('D-MMM-YYYY');

    $(document).ready(function(){
       get_opt_patient_list();
    });   
    
    function get_agency_details(){
        var data = {
            'start_date': $("#start_date").val(),
            'end_date': $("#end_date").val(),
            'doctor_id': $("#doctor_id").val()
        };

        return data;
    }
    
    $("#search_opd_patient").on('click',function(){
        get_opt_patient_list();
        opt_patient_table.ajax.reload();
    });
       
    
    function get_opt_patient_list(flag){
        opt_patient_table = $('#opt_patient_table').DataTable({
            "processing": true, 
            "serverSide": true,
            "order": [[ 1, "desc" ]],
            "dom": 'Blfrtip',
            "retrieve": true,
            "buttons": [
                {
                    extend: 'excel',
                    text: 'Export',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3]
                    },
                    title: 'opt_patient_table_'+time,
                    action: newExportAction
                },
            ],
            "language":{ 
                "processing": "<div class='spinner'>\n\
                                    <div class='rect1' style='background-color:#db3236'></div>\n\
                                    <div class='rect2' style='background-color:#4885ed'></div>\n\
                                    <div class='rect3' style='background-color:#f4c20d'></div>\n\
                                    <div class='rect4' style='background-color:#3cba54'></div>\n\
                                </div>"
            },
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50, 100,"All"]],
            "ordering": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>admin_panel/get_opt_patient_details",
                "type": "POST",
                data: function(d){
                    var entity = get_agency_details();
                    d.start_date = entity.start_date,
                    d.end_date = entity.end_date,
                    d.doctor_id = entity.doctor_id,
                    d.search_flag = true
                },
            },
            "columnDefs": [
                {
                    "targets": [1,3], //first column / numbering column
                    "orderable": true //set not orderable
                }
            ],
            "deferRender": true       
        });
    }
    
     
    var oldExportAction = function (self, e, opt_patient_table, button, config) {
        if (button[0].className.indexOf('buttons-excel') >= 0) {
            if ($.fn.dataTable.ext.buttons.excelHtml5.available(opt_patient_table, config)) {
                $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, opt_patient_table, button, config);
            }
            else {
                $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, opt_patient_table, button, config);
            }
        } else if (button[0].className.indexOf('buttons-print') >= 0) {
            $.fn.dataTable.ext.buttons.print.action(e, opt_patient_table, button, config);
        }
    };

    var newExportAction = function (e, opt_patient_table, button, config) {
        var self = this;
        var oldStart = opt_patient_table.settings()[0]._iDisplayStart;

        opt_patient_table.one('preXhr', function (e, s, data) {
            // Just this once, load all data from the server...
            data.start = 0;
            data.length = opt_patient_table.page.info().recordsTotal;

            opt_patient_table.one('preDraw', function (e, settings) {
                // Call the original action function 
                oldExportAction(self, e, opt_patient_table, button, config);

                opt_patient_table.one('preXhr', function (e, s, data) {
                    // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                    // Set the property to what it was before exporting.
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });

                // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                setTimeout(opt_patient_table.ajax.reload, 0);

                // Prevent rendering of the full data to the DOM
                return false;
            });
        });

        // Requery the server with the new one-time export settings
        opt_patient_table.ajax.reload();
    };
    
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/> 
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $("#start_date").val(start.format('YYYY-MM-DD'));
        $("#end_date").val(end.format('YYYY-MM-DD'));
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
</script>  