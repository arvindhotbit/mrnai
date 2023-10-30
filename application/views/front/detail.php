<link rel="stylesheet" href="<?php echo site_url('assets/front/css/owl.carousel.min.css');?>">
<body>
    <div class="wrapper">
    <div class="topSection themeClr">
        <div class="container mini-container">
            <div class="row ">
                <div class="col-12 g-0">
                    <div class="d-flex bg-default justify-content-between align-items-center py-2">
                        <div>
                        	<a class="cursor-pointer" href="<?php echo site_url();?>">
                        	<img src="<?php echo site_url();?>assets/front/images/ic_back_dark.svg" alt=""></a>
                        	<a href="#" class="shopImg">
                        	<img class="img-fluid" src="<?php echo $detail['logo'];?>" alt=""></a>
                        </div>
                        <div class="heading">
                            <h6><?php echo $detail['business_name'];?></h6>
                        </div>
                        <div class="onlineText"><span><?php echo ($detail['is_live']==1)?'Online':'Offline';?></span>
                        	<img src="<?php echo site_url();?>assets/front/images/ic_online.svg" alt="">
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
                                    <input type="hidden" name="windid" id="windid" value="<?php echo $ls['window_id'];?>">
                                </div>
                                <div>
                                	<a class="cursor-pointer" onclick="nextArrow()">
                                		<img src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt=""></a>
                                </div>
                            </div>
                            <?php if(!empty($ls['current'])){ ?>
                            <div class="bg_app_Block">
                                <div class="appContainer necon">
                                    <div>
                                        <span><?php echo $this->lang->line('lab_current_no_text');?></span>
                                        <h1><?php echo $ls['current']['seat_no'];?></h1>
                                    </div>
                                    <div>
                                        <span><?php echo $this->lang->line('lab_waiting_time_text');?></span>
                                        <!-- <h1 class="d-flex justify-content-between align-items-center">50 min <div> -->
                                        <h1 class="d-flex justify-content-between align-items-center"> 
                                            <span id="i<?php echo $ls['window_id'];?>-waiting-time">--</span>
                                            <div>
                                        	<a href="<?php echo current_url();?>" class="btn btn-outline-light btn-sm rounded-3 newBn">
                                        		<img src="<?php echo site_url();?>assets/front/images/ic_close.svg" /> 
                                        		<small><?php echo $this->lang->line('btn_refresh_text');?></small>  </a>
                                        	</div>
                                        </h1>
                                    </div>
                                    <div>
                                        <span><?php echo $this->lang->line('lab_serving_text');?></span>
                                        <h1><?php echo ucwords($ls['current']['services']);?></h1>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-between align-items-center">
                                        <a href="<?php echo site_url($detail['slug'].'/services/'.base64_encode($ls['window_id']));?>" class="btn btn-success w-100"><img src="<?php echo site_url();?>assets/front/images/ic_right.svg" alt=""> <?php echo $this->lang->line('btn_giveno_text');?></a>
                                        <a href="javascript:void(0);?>" onclick="cancelBooking(<?php echo $ls['current']['id'];?>,'<?php echo $ls['current']['device_token'];?>')" class="btn btn-danger w-100 user_<?php echo $ls['current']['device_token'];?>" style="display: none;">
                                            <img src="<?php echo site_url();?>assets/front/images/ic_close.svg" alt=""> <?php echo $this->lang->line('btn_cancel_text');?></a>
                                    </div>
                                </div>
                            </div>
                            <?php }else{ ?>
                                <!-- if no booking available -->
                                <div class="bg_app_Block">
                                    <div class="appContainer necon">
                                        <div>
                                            <span><?php echo $this->lang->line('lab_current_no_text');?></span>
                                            <h1>-</h1>
                                        </div>
                                        <div>
                                            <span><?php echo $this->lang->line('lab_waiting_time_text');?></span>
                                            <h1 class="d-flex justify-content-between align-items-center">-- <div>
                                                <a href="<?php echo current_url();?>" class="btn btn-outline-light btn-sm rounded-3 newBn">
                                                    <img src="<?php echo site_url();?>assets/front/images/ic_close.svg" /> 
                                                    <small><?php echo $this->lang->line('btn_refresh_text');?></small>  </a>
                                                </div>
                                            </h1>
                                        </div>
                                        <div>
                                            <span><?php echo $this->lang->line('lab_serving_text');?></span>
                                            <h1>--</h1>
                                        </div>
                                        <div class="d-flex gap-2 justify-content-between align-items-center">
                                            <a href="<?php echo site_url($detail['slug'].'/services/'.base64_encode($ls['window_id']));?>" class="btn btn-success w-100"><img src="<?php echo site_url();?>assets/front/images/ic_right.svg" alt=""> <?php echo $this->lang->line('btn_giveno_text');?></a>
                                        </div>
                                    </div>
                                </div>
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
                                <span class="ytbx user_<?php echo $val['device_token'];?>"><?php echo $this->lang->line('lab_your_no_text');?></span>
                                <div class="card-body p-2 searchList customerList">
                                    <div class="d-flex ">
                                        <div class="me-2">
                                            <?php if(empty($val['profile_pic'])){ ?>
                                                <img src="<?php echo site_url();?>assets/front/images/placeholder_image.jpeg" alt="" class="img-fluid shadow">
                                            <?php }else{ ?>
                                                <img src="<?php echo site_url($val['profile_pic']);?>" alt="" class="img-fluid shadow">
                                            <?php } ?>
                                            <input type="hidden" name="serve_time[]" class="serve_time" value="<?php echo $val['serve_time'];?>">
                                        </div>
                                        <div class="caption align-items-center flex-row">
                                            <div>
                                                <h4 class="mb-1"><?php echo ucfirst($val['fullname']);?></h4>
                                                <p class="mb-0"><span><?php echo ucwords($val['services']);?></span></p>
                                            </div>
                                            <div class="count">
                                                <p class="mb-0"><?php echo $val['seat_no'];?></p>
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

<script src="<?php echo site_url();?>assets/front/js/owl.carousel.min.js"></script>
<script>
$(document).ready(function (e) {
    $(".ytbx").hide();
    if(localStorage.getItem("openseatuser")){
        var openseatuser=localStorage.getItem("openseatuser");
        openseatuser=openseatuser.split("||");
        var usrtokn=openseatuser[0];
        $(".user_"+usrtokn).show();
        setTimeout(function(){
            waitingTime(usrtokn);
        },2000)
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
    waitingTime('');
}
function nextArrow() {
    var y = document.getElementsByClassName("owl-next")
    y[0].click();
    waitingTime('');
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

function waitingTime(token) {
    if(token==''){
        if(localStorage.getItem("openseatuser")){
            var openseatuser=localStorage.getItem("openseatuser");
            openseatuser=openseatuser.split("||");
            token=openseatuser[0];
        }
    }
    var slug="<?php echo $detail['slug'];?>";
    var id=$(".owl-item.active").find("#windid").val();
    $("#loader").show(); 
    $.ajax({
        url: "<?php echo site_url('get_waiting_time');?>",
        type: 'POST',
        data: {slug:slug,id:id,token:token},
        dataType: 'json',
        success:function(resp){
            // console.log(resp)
            $("#loader").hide();  
            if(resp.status==1){
                $(".owl-item.active").find("#i"+id+"-waiting-time").html(resp.time);
            }
        },
        error:function(err){
            $("#loader").hide();
        }
    });
}
</script>

