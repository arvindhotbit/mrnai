<body>
    <div class="wrapper">
    <div class="topSection themeClr">
        <div class="container mini-container">
            <div class="row ">
                <div class="col-12 g-0">
                    <div class="d-flex bg-default justify-content-between align-items-center py-2">
                        <div class="w-25">
                            <!-- <a class="cursor-pointer" href="<?php echo site_url('business_window');?>"> -->
                            <a class="cursor-pointer" data-bs-toggle="offcanvas" data-bs-target="#demo1">
                                <img src="<?php echo site_url();?>assets/front/images/ic_settings.svg" alt="">
                            </a>
                        </div>
                        <div class="heading w-50 text-center">
                            <h6><?php echo ucfirst($business_name);?></h6>
                        </div>
                        <div class="whatBtn w-25"> 
                            <a href="#" class="btn btn-outline-success">
                                <img src="<?php echo site_url();?>assets/front/images/new/header_whatsapp.svg" alt="">
                                    <small><?php echo $this->lang->line('lab_support_text');?></small> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottomSection my-3">
        <div class="container mini-container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-2 shadow r-10 text-center">
                        <div class="card-body p-2">
                            <img src="<?php echo $qr_image;?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="floatbtn">
        <a href="https://wa.me?text=<?php echo $qr_image;?>" data-action="share/whatsapp/share"><img src="<?php echo site_url();?>assets/front/images/new/float_whatsapp.svg" alt=""><span><?php echo $this->lang->line('btn_share_text');?></span></a>
    </div>
</div>


<!-- menu -->
<div class="offcanvas offcanvas-bottom _setLocation _h80" id="demo1">
    <div class="offcanvas-header ">
        <span data-bs-dismiss="offcanvas" id="closepop">
            <img src="<?php echo site_url();?>assets/front/images/ic_close_light.svg" alt=""></span>
        <h1 class="offcanvas-title"><?php echo $this->lang->line('head_business_portal_title');?></h1>
    </div>
    <div class="newCanva">
        <h4><?php echo $this->lang->line('lab_this_month_booking_text');?></h4>
        <h1><?php echo $month_booking;?> </h1>
        <h3><?php echo $total_booking;?> <?php echo $this->lang->line('lab_booking_done_text');?></h3>
    </div>
    <div class="offcanvas-body py-1">
        <ul class="m-0 p-0 list-unstyled protal">
            <li class="d-flex justify-content-between align-items-center">
                <a href="#"><img class="me-2" src="<?php echo site_url();?>assets/front/images/business_a.svg" alt="">  <?php echo $this->lang->line('head_business_open_title');?> </a>
                <div class="toggbtn">
                    <input type="checkbox" id="businessToggle" class="d-none" onchange="updateLiveStatus()" <?php echo ($business_live=='yes')?'checked':'';?>>
                    <label for="businessToggle" >
                        <span></span>
                    </label>
                </div>
            </li>
            <li>
                <a href="<?php echo site_url('business_window');?>"><img class="me-2" src="<?php echo site_url();?>assets/front/images/business_a.svg" alt=""> <?php echo $this->lang->line('head_view_tv_screen_title');?></a>
            </li>
            <li>
                <a href="<?php echo site_url('edit_profile');?>"><img class="me-2" src="<?php echo site_url();?>assets/front/images/business_a.svg" alt=""> <?php echo $this->lang->line('head_manage_profile_title');?></a>
            </li>
            <li>
                <a href="<?php echo site_url('business_services');?>"><img class="me-2" src="<?php echo site_url();?>assets/front/images/business_a.svg" alt=""> <?php echo $this->lang->line('head_add_manage_service_title');?></a>
            </li>
            <li>
                <a href="<?php echo site_url('bqrcode');?>"><img class="me-2" src="<?php echo site_url();?>assets/front/images/business_a.svg" alt=""> <?php echo $this->lang->line('head_qrprint_title');?></a>
            </li>
        </ul>
        <div class=" d-flex justify-content-between">
            <a href="<?php echo site_url('logout');?>" class="logout btn">
                <img class="me-2" src="<?php echo site_url();?>assets/front/images/business_b.svg" alt=""> <?php echo $this->lang->line('btn_logout_text');?>
            </a>
            <a href="#" class="btn btn-outline-success rounded-3 text-white py-0 p-2">
                <img src="<?php echo site_url();?>assets/front/images/new/header_whatsapp.svg" alt=""><?php echo $this->lang->line('lab_support_text');?> </a>
        </div>
    </div>
</div>
<script type="text/javascript">
function updateLiveStatus() {
    $("#loader").show(); 
    $.ajax({
        url: "<?php echo site_url('update_business_status');?>",
        type: 'POST',
        data: {status:''},
        dataType: 'json',
        success:function(resp){
            $("#loader").hide();  
            $("#closepop").trigger('click');
        },
        error:function(err){
            $("#loader").hide();
        }
    });
}
</script>
