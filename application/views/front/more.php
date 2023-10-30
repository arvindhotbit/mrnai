<body>
  <div class="wrapper">
    <div class="card card-bottom _setLocation h-100vh rounded-0" id="demo">
      <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
       <a href="<?php echo site_url();?>"><img src="<?php echo site_url();?>assets/front/images/ic_close_light.svg" alt=""></a>
        <h1 class="card-title mb-0"><?php echo $this->lang->line('lab_more_text');?></h1>
        <span></span> 
      </div>
      <div class="card-body">
        <ul class="m-0 p-0 list-unstyled protal">
          <li class="active">
            <a href="<?php echo site_url('login');?>" >
              <img class="me-2" src="<?php echo site_url();?>assets/front/images/business_a.svg" alt=""> <?php echo $this->lang->line('head_business_login_title');?>
            </a>
            <img src="<?php echo site_url();?>assets/front/images/new/location_arrow.svg" alt="">
          </li>
          <li>
            <a href="<?php echo site_url('my_booking');?>"><img class="me-2" src="<?php echo site_url();?>assets/front/images/business_a.svg" alt=""> <?php echo $this->lang->line('head_booking_no_title');?></a>
          </li>
          <!-- <li>
            <a href="#"><img class="me-2" src="<?php echo site_url();?>assets/front/images/business_a.svg" alt=""> Sound</a>
          </li> -->
          <li>
            <a href="<?php echo site_url('share_app');?>"><img class="me-2" src="<?php echo site_url();?>assets/front/images/business_a.svg" alt=""> <?php echo $this->lang->line('head_app_linked_title');?></a>
          </li>
          <li>
            <a href="<?php echo site_url('how_it_work');?>"><img class="me-2" src="<?php echo site_url();?>assets/front/images/business_a.svg" alt=""> <?php echo $this->lang->line('head_how_it_work_title');?></a>
          </li>

          <li>
            <a href="<?php echo site_url('privacy_policy');?>"><img class="me-2" src="<?php echo site_url();?>assets/front/images/business_a.svg" alt=""> <?php echo $this->lang->line('head_privacy_title');?></a>
          </li>
          <li>
            <a href="<?php echo site_url('about_us');?>"><img class="me-2" src="<?php echo site_url();?>assets/front/images/business_b.svg" alt=""> <?php echo $this->lang->line('head_about_us_title');?></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
