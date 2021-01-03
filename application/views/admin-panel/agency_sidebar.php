<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="<?php echo base_url(); ?>admin/agency/dashboard">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Manage Agency</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url(); ?>admin/agency/escort_list">View Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/agency/escort_list">Edit Profile</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-users"></i>
                        <span>Escort Details</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url(); ?>admin/agency/escort_list">Escorts List</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/agency/escort_list">Add Escort</a></li>
                    </ul>
                </li>
                
                <li class="sub-menu">
                    <a href="#">
                        <i class="fa fa-envelope"></i>
                        <span>Mail </span>
                    </a>
                    <ul class="sub">
                        <li><a href="#">Inbox</a></li>
                        <li><a href="#">Compose Mail</a></li>
                    </ul>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->