<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- //market-->
        <div class="market-updates">
            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-3">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-usd"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Total Escorts</h4>
                        <h3><?php if (!empty($total_escort)) {
                        echo $total_escort;
                        } else {
                        echo 'Not Found';
                        } ?></h3>

                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-2">
                    <div class="col-md-3 market-update-right">
                        <i class="fa fa-eye"> </i>
                    </div>
                    <div class="col-md-9 market-update-left">
                        <h4>Inactive Escorts</h4>
                    <h3><?php if (!empty($indeactive_escort)) {
                    echo $indeactive_escort;
                    } else {
                    echo 'Not Found';
                    } ?></h3>

                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-1">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-users" ></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                    <h4>Active Escorts</h4>
                    <h3><?php if (!empty($active_escort)) {
                    echo $active_escort;
                    } else {
                    echo 'Not Found';
                    } ?></h3>

                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-4">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Total Cities</h4>
                        <h3><?php if (!empty($total_city)) {
                        echo $total_city;
                        } else {
                        echo 'Not Found';
                        } ?></h3>

                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            
            <div class="clearfix"> </div>
        </div>	
        <!-- //market-->
        <div class="row">
            <div class="panel-body">
                <div class="col-md-12 w3ls-graph">
                    <!--agileinfo-grap-->
                    <div class="agileinfo-grap">
                        <div class="agileits-box">
                            <header class="agileits-box-header clearfix">
                                <h3>Visitor Statistics</h3>
                                <div class="toolbar">


                                </div>
                            </header>
                            <div class="agileits-box-body clearfix">
                                <div id="hero-area"></div>
                            </div>
                        </div>
                    </div>
                    <!--//agileinfo-grap-->

                </div>
            </div>
        </div>
        
        <div class="agileits-w3layouts-stats">
            <div class="col-md-4 stats-info widget">
                <div class="stats-info-agileits">
                    <div class="stats-title">
                        <h4 class="title">Browser Stats</h4>
                    </div>
                    <div class="stats-body">
                        <ul class="list-unstyled">
                            <li>GoogleChrome <span class="pull-right">85%</span>  
                                <div class="progress progress-striped active progress-right">
                                    <div class="bar green" style="width:85%;"></div> 
                                </div>
                            </li>
                            <li>Firefox <span class="pull-right">35%</span>  
                                <div class="progress progress-striped active progress-right">
                                    <div class="bar yellow" style="width:35%;"></div>
                                </div>
                            </li>
                            <li>Internet Explorer <span class="pull-right">78%</span>  
                                <div class="progress progress-striped active progress-right">
                                    <div class="bar red" style="width:78%;"></div>
                                </div>
                            </li>
                            <li>Safari <span class="pull-right">50%</span>  
                                <div class="progress progress-striped active progress-right">
                                    <div class="bar blue" style="width:50%;"></div>
                                </div>
                            </li>
                            <li>Opera <span class="pull-right">80%</span>  
                                <div class="progress progress-striped active progress-right">
                                    <div class="bar light-blue" style="width:80%;"></div>
                                </div>
                            </li>
                            <li class="last">Others <span class="pull-right">60%</span>  
                                <div class="progress progress-striped active progress-right">
                                    <div class="bar orange" style="width:60%;"></div>
                                </div>
                            </li> 
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 stats-info stats-last widget-shadow">
                <div class="stats-last-agile">
                    <table class="table stats-table ">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>PRODUCT</th>
                                <th>STATUS</th>
                                <th>PROGRESS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Lorem ipsum</td>
                                <td><span class="label label-success">In progress</span></td>
                                <td><h5>85% <i class="fa fa-level-up"></i></h5></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Aliquam</td>
                                <td><span class="label label-warning">New</span></td>
                                <td><h5>35% <i class="fa fa-level-up"></i></h5></td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Lorem ipsum</td>
                                <td><span class="label label-danger">Overdue</span></td>
                                <td><h5 class="down">40% <i class="fa fa-level-down"></i></h5></td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Aliquam</td>
                                <td><span class="label label-info">Out of stock</span></td>
                                <td><h5>100% <i class="fa fa-level-up"></i></h5></td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Lorem ipsum</td>
                                <td><span class="label label-success">In progress</span></td>
                                <td><h5 class="down">10% <i class="fa fa-level-down"></i></h5></td>
                            </tr>
                            <tr>
                                <th scope="row">6</th>
                                <td>Aliquam</td>
                                <td><span class="label label-warning">New</span></td>
                                <td><h5>38% <i class="fa fa-level-up"></i></h5></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </section>
    <!-- footer -->
    <div class="footer">
        <div class="wthree-copyright">
            <p>© 2020 Hospital Management System</p>
        </div>
    </div>
    <!-- / footer -->
</section>
<!--main content end-->