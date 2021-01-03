<!DOCTYPE html>
<head>
    <title>Hospital Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>cpanel/css/bootstrap.min.css" >
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>cpanel/css/style.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo base_url(); ?>cpanel/css/style-responsive.css" rel="stylesheet"/>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font.css" type="text/css"/>
    <link href="<?php echo base_url(); ?>cpanel/css/font-awesome.css" rel="stylesheet"> 
    <!-- //font-awesome icons -->
    <script src="<?php echo base_url(); ?>cpanel/js/jquery2.0.3.min.js"></script>
</head>
<body>
    <div class="log-w3">
        <div style="text-align: center; margin-top:3%;" >
            <span id="login_message"></span>
        </div>
        
        <div class="w3layouts-main">
            <h2>Sign In Now</h2>
            <form action="<?php echo base_url(); ?>admin_login" id="login" method="post">
                <input type="email" class="ggg" name="email" id="email" placeholder="E-MAIL" >
                <input type="password" class="ggg" name="clear_password" id="clear_password" placeholder="PASSWORD">
                <div class="clearfix"></div>
                <input type="submit" value="Sign In" name="login">
            </form>
            
        </div>
    </div>
    <script src="<?php echo base_url(); ?>cpanel/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>cpanel/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>cpanel/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url(); ?>cpanel/js/scripts.js"></script>
    <script src="<?php echo base_url(); ?>cpanel/js/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url(); ?>cpanel/js/jquery.nicescroll.js"></script>
    <script src="<?php echo base_url(); ?>cpanel/js/jquery.scrollTo.js"></script>
    <script src="<?php echo base_url(); ?>cpanel/js/customs.js"></script>
</body>
</html>