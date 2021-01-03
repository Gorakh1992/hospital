<style>
    .dataTables_filter {
        float: right !important;
        padding-right: 10px;
    }
</style>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="page-title">
                    <h5>Escorts List</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="agency-list">
                <div class="fliters">
                    <div class="row">
                        <div class="col-md-4">
                            <p style="margin-top: 9px;">Search : </p>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="city_id" name="city_id">
                                <option disabled="" selected="">Select City</option>
                                <?php foreach ($city_list as $val ) { ?>
                                <option value="<?php echo $val['id']; ?>"><?php echo $val['city_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="" id="search_agency" class="nxt-btn">Search</button>
                        </div>
                    </div>

                </div>
                <div class="table-responsive table-desi">
                    <table class="table table-hover" id="escorts_list_data">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>profile Image</th>
                                <th> id</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>Occupation</th>
                                <th>Escort Type</th>
                                <th>Edit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
<link rel="stylesheet" href="<?php echo base_url(); ?>cpanel/css/select2.min.css">
<script src="<?php echo base_url(); ?>cpanel/js/select2.min.js"></script>
<script type="text/javascript">
      $("#city_id").select2();      
</script>
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
    var escorts_data_table;
    var time = moment().format('D-MMM-YYYY');

    $(document).ready(function(){
       get_escorts_data_list();
    });
     
    $('#search_agency').on('click',function(){
        var city_id = $('#city_id').val();
       
        if(city_id == '' || city_id == null){
            alert("Please Select City."); 
            return false;
        }
        escorts_data_table.ajax.reload();
    });
    
    
    function get_escorts_details(){
        var data = {
            'agency_id':<?php echo $this->session->userdata("userID"); ?>,
            'city_id': $('#city_id').val()
        };
        return data;
    }
    
    function get_escorts_data_list(){
        escorts_data_table = $('#escorts_list_data').DataTable({
            "processing": true, 
            "serverSide": true,
            "dom": 'lBfrtip',
            "buttons": [
                {
                    extend: 'excel',
                    text: 'Export',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3]
                    },
                    title: 'escorts_list_data_'+time,
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
            select: {
                style: 'multi'
            },
            "order": [[0, 'asc']], 
            "pageLength": 25,
            "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50, 100,"All"]],
            "ordering": false,
            "ajax": {
                "url": "<?php echo base_url(); ?>admin_panel/get_escorts_list",
                "type": "POST",
                data: function(d){
                    var entity = get_escorts_details();
                    d.city_id = entity.city_id,
                    d.agency_id = entity.agency_id,        
                    d.search_flag = true
                },
            },
            "deferRender": true       
        });
    }
    
     
    var oldExportAction = function (self, e, escorts_data_table, button, config) {
        if (button[0].className.indexOf('buttons-excel') >= 0) {
            if ($.fn.dataTable.ext.buttons.excelHtml5.available(escorts_data_table, config)) {
                $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, escorts_data_table, button, config);
            }
            else {
                $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, escorts_data_table, button, config);
            }
        } else if (button[0].className.indexOf('buttons-print') >= 0) {
            $.fn.dataTable.ext.buttons.print.action(e, escorts_data_table, button, config);
        }
    };

    var newExportAction = function (e, escorts_data_table, button, config) {
        var self = this;
        var oldStart = escorts_data_table.settings()[0]._iDisplayStart;

        escorts_data_table.one('preXhr', function (e, s, data) {
            // Just this once, load all data from the server...
            data.start = 0;
            data.length = escorts_data_table.page.info().recordsTotal;

            escorts_data_table.one('preDraw', function (e, settings) {
                // Call the original action function 
                oldExportAction(self, e, escorts_data_table, button, config);

                escorts_data_table.one('preXhr', function (e, s, data) {
                    // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                    // Set the property to what it was before exporting.
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });

                // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                setTimeout(escorts_data_table.ajax.reload, 0);

                // Prevent rendering of the full data to the DOM
                return false;
            });
        });

        // Requery the server with the new one-time export settings
        escorts_data_table.ajax.reload();
    };
    
   

</script>