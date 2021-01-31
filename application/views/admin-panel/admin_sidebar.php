<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="<?php echo base_url(); ?>dashboard">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
               
                <?php if(!empty($this->session->userdata['userType']) && $this->session->userdata['userType'] == 3) { ?>
                <li class="sub-menu">
                    <a href="javascript:void(0);">
                        <i class="fa fa-h-square"></i>
                        <span>Manage OPD</span> 
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url(); ?>add_opd_patient">Add OPD Details</a></li>
                        <li><a href="<?php echo base_url(); ?>upload_opd_patient_file">Upload OPD File</a></li>
                        <li><a href="<?php echo base_url(); ?>opd_patient_list">OPD Patient List</a></li>
                    </ul>
                </li>
                <?php } ?>
                
                <?php if(!empty($this->session->userdata['userType']) && $this->session->userdata['userType'] == 1) { ?>
                <li class="sub-menu">
                    <a href="#">
                        <i class="fa fa-hospital-o"></i>
                        <span>Manage Surgery</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url(); ?>add_surgery_patient_details">Add Surgery</a></li>
                        <li><a href="<?php echo base_url(); ?>surgery_patient_list">Surgery List</a></li>
                        <li><a href="<?php echo base_url(); ?>advance_search">Advance Search </a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:void(0);">
                        <i class="fa fa-h-square"></i>
                        <span>Manage OPD</span> 
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url(); ?>add_opd_patient">Add OPD Details</a></li>
                        <li><a href="<?php echo base_url(); ?>upload_opd_patient_file">Upload OPD File</a></li>
                        <li><a href="<?php echo base_url(); ?>opd_patient_list">OPD Patient List</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:void(0);">
                        <span class="glyphicon glyphicon-user" style="background: #FFF; font-size: 14px;"></span>
                        <span>User Manager</span> 
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url(); ?>create_new_user_account">Create New Login</a></li>
                        <li><a href="#">Change password</a></li>
                        <li><a href="<?php echo base_url(); ?>users_list"> User Detais</a></li>
                    </ul>
                </li>
<!--                <li class="sub-menu">
                    <a href="javascript:void(0);">
                        <i class="fa fa-tasks"></i>
                        <span>Manage Country</span>
                    </a>
                    <ul class="sub">
                        <li><a href="#">Country List</a></li>
                        <li><a href="#">Add Country</a></li>
                        <li><a href="#">Edit Country</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-money"></i>
                        <span>Manage Currency</span>
                    </a>
                    <ul class="sub">
                    	<li><a href="#">Currency List</a></li>
                        <li><a href="#">Add Currency</a></li>
                        <li><a href="#">Edit Currency</a></li>
						
                    </ul>
                </li>-->

                <?php } ?>
                <!--                <li class="sub-menu">
                    <a href="javascript:void(0);">
                        <i class="fa fa-newspaper-o"></i>
                        <span>Manage Blog</span>
                    </a>
                    <ul class="sub">
                    	<li><a href="#">Blog List</a></li>
                        <li><a href="#">Add Blog</a></li>
                        <li><a href="#">Edit Blog</a></li>
						
                    </ul>
                </li>-->
<!--                <li class="sub-menu">
                    <a href="javascript:void(0);">
                        <i class="fa fa-envelope"></i>
                        <span>Mail </span>
                    </a>
                    <ul class="sub">
                        <li><a href="mail.html">Inbox</a></li>
                        <li><a href="mail_compose.html">Compose Mail</a></li>
                    </ul>
                </li>-->
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->