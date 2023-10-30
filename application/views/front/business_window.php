<link rel="stylesheet" href="<?php echo site_url('assets/front/css/owl.carousel.min.css');?>">
<body>
    <div class="wrapper">
    <div class="topSection themeClr">
        <div class="container mini-container">
            <div class="row ">
                <div class="col-12 g-0">
                    <div class="d-flex bg-default justify-content-between align-items-center py-2">
                        <div class="w-25">
                            <a class="cursor-pointer" data-bs-toggle="offcanvas" data-bs-target="#demo1">
                                <img src="<?php echo site_url();?>assets/front/images/ic_settings.svg" alt="">
                            </a>
                        </div>
                        <div class="heading w-50 text-center">
                            <h6><?php echo ucfirst($business_name);?></h6>
                        </div>
                        <div class="whatBtn w-25"> 
                            <a href="#" class="btn btn-outline-success">
                                <img  src="<?php echo site_url();?>assets/front/images/new/header_whatsapp.svg" alt="">
                                    <small><?php echo $this->lang->line('lab_support_text');?></small> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="owl-carousel owl-theme">
        <?php foreach ($windows as $key => $ls) { ?>
        <div>
            <div class="topSection themeClr">
                <div class="container mini-container">
                    <div class="row ">
                        <div class="col-12 g-0">
                            <div class="d-flex rounded-0 bg-orange justify-content-between align-items-center py-2">
                                <div><a class="cursor-pointer" onclick="prevArrow()"><img class="d-ltr"
                                            src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt=""></a></div>
                                <div class="heading">
                                    <h6><?php echo ucfirst($ls['window_name']);?> <?php echo $this->lang->line('lab_window_text');?></h6>
                                </div>
                                <div>
                                    <a class="cursor-pointer" onclick="nextArrow()">
                                        <img src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt=""></a>
                                </div>
                            </div>
                            <?php if(!empty($ls['current'])){ ?>
                            <div class="bg_app_Block">
                                <div class="appContainer">
                                    <div>
                                        <span><?php echo $this->lang->line('lab_current_no_text');?></span>
                                        <h1><?php echo $ls['current']['seat_no'];?></h1>
                                    </div>
                                    <div>
                                        <span><?php echo $this->lang->line('lab_serving_text');?></span>
                                        <h1><?php echo ucwords($ls['current']['services']);?></h1>
                                        <button class="btn btn-outline-light w-auto mt-3 px-3" onclick="bookingStatus('hold',<?php echo $ls['current']['id'];?>)">
                                            <img width="10" src="<?php echo site_url();?>assets/front/images/ic_close.svg" alt=""> <?php echo $this->lang->line('btn_hold_text');?>
                                        </button>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-between align-items-center">
                                        <button class="btn btn-success w-75 mx-auto" onclick="bookingStatus('complete',<?php echo $ls['current']['id'];?>)">
                                            <img width="10" src="<?php echo site_url();?>assets/front/images/ic_right.svg" alt=""> <?php echo $this->lang->line('btn_completed_text');?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php }else{ ?>
                                <!-- if no booking available -->
                                
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($ls['bookings'])){ ?>
            <div class="bottomSection my-3">
                <div class="container mini-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-start themeTitle">
                                <h4 class="mb-0s"><?php echo $this->lang->line('lab_people_text');?><span>&nbsp;<?php echo $this->lang->line('lab_inline_text');?></span></h4>
                                <span>&nbsp; <?php echo count($ls['bookings']);?></span>
                            </div>
                            <?php foreach ($ls['bookings'] as $k=> $val) { ?>
                            <div class="card mb-2 shadow r-10 <?php echo ($val['status']=='In-Progress')?'activeNumber':'';?>">
                                <div class="card-body p-2 searchList customerList">
                                    <div class="d-flex ">
                                        <div class="me-2">
                                            <?php if(empty($val['profile_pic'])){ ?>
                                                <img src="<?php echo site_url();?>assets/front/images/placeholder_image.jpeg" alt="" class="img-fluid shadow">
                                            <?php }else{ ?>
                                                <img src="<?php echo site_url($val['profile_pic']);?>" alt="" class="img-fluid shadow">
                                            <?php } ?>
                                        </div>
                                        <div class="caption align-items-start ">
                                            <div class="w-100 d-flex justify-content-between">
                                                <div>
                                                    <h4 class="mb-1"><?php echo ucfirst($val['fullname']);?></h4>
                                                    <p class="mb-0"><span><?php echo ucwords($val['services']);?></span></p>

                                                </div>
                                                <div class="count d-flex">
                                                    <?php if(!empty($val['phone_no'])){ ?>
                                                    <a href="tel:<?php echo $val['phone_no'];?>">
                                                    <img src="<?php echo site_url();?>assets/front/images/new/ic_call.svg" width="30" height="30" class="img-fluid callimg" /></a>
                                                    <?php } ?>
                                                    <p class="mb-0"><?php echo $val['seat_no'];?></p>
                                                </div>
                                            </div>

                                            <div class="actionbtn">
                                                <?php if($val['status']=='Pending'){ ?>
                                                <button class="btn  btn-success" onclick="bookingStatus('confirm',<?php echo $val['id'];?>)">
                                                    <img class="border-0" width="10" src="<?php echo site_url();?>assets/front/images/ic_right.svg" alt="">
                                                </button>
                                                <button class="btn  btn-danger" onclick="bookingStatus('cancel',<?php echo $val['id'];?>)">
                                                    <img class="border-0" width="10" src="<?php echo site_url();?>assets/front/images/ic_close.svg" alt="">
                                                </button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php }else{ ?>
                <!-- if no booking available -->
                <div class="bottomSection my-3">
                    <div class="container mini-container">
                        <div class="row">
                            <div class="col-12">
                                <?php echo $this->lang->line('info_no_booking_text');?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php }?>
    </div>
    <div class="floatbtn">
        <a href="https://wa.me?text=<?php echo $share_link;?>" data-action="share/whatsapp/share"><img src="<?php echo site_url();?>assets/front/images/new/float_whatsapp.svg" alt=""><span><?php echo $this->lang->line('btn_share_text');?></span></a>
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

<script src="<?php echo site_url();?>assets/front/js/owl.carousel.min.js"></script>
<script type="text/javascript">
function bookingStatus(action,id) {
    $("#loader").show(); 
    $.ajax({
        url: "<?php echo site_url('update_booking_status');?>",
        type: 'POST',
        data: {action:action,id:id},
        dataType: 'json',
        success:function(resp){
            $("#loader").hide();  
            window.location.reload();
        },
        error:function(err){
            $("#loader").hide();
        }
    });
}  
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
$(document).ready(function (e) {
    $(".ytbx").hide();
    if(localStorage.getItem("openseatuser")){
        var openseatuser=localStorage.getItem("openseatuser");
        openseatuser=openseatuser.split("||");
        var usrtokn=openseatuser[0];
        $(".user_"+usrtokn).show();
    }
    $('.owl-carousel').owlCarousel({
        loop: true,
        items: 1,
        margin: 0,
        autoplay: false,
        smartSpeed: 500,
        nav: false,
        dots: false,
        navText: ['<span aria-label="Previous"><img class="d-ltr" src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt=""></span>', '<span aria-label="Next"><img src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt=""></span>'],
        lazyLoad: true,
    });
});


function prevArrow() {
    var x = document.getElementsByClassName("owl-prev")
    x[0].click();
}
function nextArrow() {
    var y = document.getElementsByClassName("owl-next")
    y[0].click();
}
function cancelBooking(id,token) {
    $("#loader").show(); 
    $.ajax({
        url: "<?php echo site_url('cancel_booking');?>",
        type: 'POST',
        data: {id:id,token:token},
        dataType: 'json',
        success:function(resp){
            $("#loader").hide();  
            window.location.reload();
        },
        error:function(err){
            $("#loader").hide();
        }
    });
}
</script>

