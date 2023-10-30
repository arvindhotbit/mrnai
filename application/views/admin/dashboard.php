<div class="content-wrapper">
    <section class="content-header">
        <h1> Dashboard </h1>
        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <h4>Users Stats</h4>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="<?php echo site_url('admin/user/list');?>">
                        <div class="info-box">
                            <span class="info-box-icon  bg-green"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Users</span>
                                <span class="info-box-number"><?php if (!empty($total_users)){echo $total_users;}else{ echo 0;} ?>
                                    
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <?php $tod=date('m-d-Y')."++-+".date('m-d-Y')."+"; ?>
                    <a href="<?php echo site_url('admin/user/list?daterange='.$tod);?>">
                        <div class="info-box">
                            <span class="info-box-icon  bg-orange"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Today Users</span>
                                <span class="info-box-number"><?php if (!empty($today_users)){echo $today_users;}else{ echo 0;} ?>
                                    
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="<?php echo site_url('admin/user/list');?>">
                        <div class="info-box">
                            <span class="info-box-icon  bg-purple"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">This Month Users</span>
                                <span class="info-box-number"><?php if (!empty($total_month_users)){echo $total_month_users;}else{ echo 0;} ?>
                                    
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <h4>Business Stats</h4>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="<?php echo site_url('admin/business/list');?>">
                        <div class="info-box">
                            <span class="info-box-icon  bg-green"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Business</span>
                                <span class="info-box-number"><?php if (!empty($total_business)){echo $total_business;}else{ echo 0;} ?>
                                    
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <?php $tod=date('m-d-Y')."++-+".date('m-d-Y')."+"; ?>
                    <a href="<?php echo site_url('admin/business/list?daterange='.$tod);?>">
                        <div class="info-box">
                            <span class="info-box-icon  bg-orange"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Today Business</span>
                                <span class="info-box-number"><?php if (!empty($today_business)){echo $today_business;}else{ echo 0;} ?>
                                    
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="<?php echo site_url('admin/business/list');?>">
                        <div class="info-box">
                            <span class="info-box-icon  bg-purple"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">This Month Business</span>
                                <span class="info-box-number"><?php if (!empty($total_month_business)){echo $total_month_business;}else{ echo 0;} ?>
                                    
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4>Booking Stats</h4>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="<?php echo site_url('admin/booking/list');?>">
                        <div class="info-box">
                            <span class="info-box-icon  bg-green"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Booking</span>
                                <span class="info-box-number"><?php if (!empty($total_booking)){echo $total_booking;}else{ echo 0;} ?>
                                    
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <?php $tod=date('m-d-Y')."++-+".date('m-d-Y')."+"; ?>
                    <a href="<?php echo site_url('admin/booking/list?daterange='.$tod);?>">
                        <div class="info-box">
                            <span class="info-box-icon  bg-orange"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Today Booking</span>
                                <span class="info-box-number"><?php if (!empty($today_booking)){echo $today_booking;}else{ echo 0;} ?>
                                    
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="<?php echo site_url('admin/booking/list');?>">
                        <div class="info-box">
                            <span class="info-box-icon  bg-purple"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">This Month Booking</span>
                                <span class="info-box-number"><?php if (!empty($total_month_booking)){echo $total_month_booking;}else{ echo 0;} ?>
                                    
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="<?php echo site_url('admin/booking/list');?>">
                        <div class="info-box">
                            <span class="info-box-icon  bg-green"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Complete Booking</span>
                                <span class="info-box-number"><?php if (!empty($complete_booking)){echo $complete_booking;}else{ echo 0;} ?>
                                    
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <?php $tod=date('m-d-Y')."++-+".date('m-d-Y')."+"; ?>
                    <a href="<?php echo site_url('admin/booking/list?daterange='.$tod);?>">
                        <div class="info-box">
                            <span class="info-box-icon  bg-orange"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Complete Booking(month)</span>
                                <span class="info-box-number"><?php if (!empty($complete_month_booking)){echo $complete_month_booking;}else{ echo 0;} ?>
                                    
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
        </div>

    </section>
</div>