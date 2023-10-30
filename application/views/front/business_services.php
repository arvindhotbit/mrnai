<body>
    <div class="wrapper">
    	<div class="topSection themeClr">
    		<div class="container mini-container">
           		<div class="row ">
            		<div class="col-12 shadow">
                		<div class="d-flex bg-white  justify-content-between align-items-center py-2">
                    		<div class="w-25">
                    			<a class="cursor-pointer" href="<?php echo site_url('business_window');?>">
                    				<img src="<?php echo site_url();?>assets/front/images/ic_back_dark.svg" alt=""></a>
                            </div>
		                    <div class="heading w-50 text-center">
		                        <h6><?php echo $this->lang->line('lab_create_service_text');?></h6>
		                    </div>
                    		<div class="whatBtn w-25"> 
                    			<a href="#" class="btn btn-outline-success">
                    				<img src="<?php echo site_url();?>assets/front/images/new/header_whatsapp.svg" alt="">
                    				<small><?php echo $this->lang->line('lab_support_text');?></small> </a>
                    		</div>
                		</div>
            		</div>
           		</div>
        	</div>
    	</div>
    	<div class="bottomSection h-100vh mb-2">
        	<div class="container mini-container">
            	<div class="row mt-3">
                	<div class="col-12">
                     	<?php foreach ($list as $key => $value) { ?>
	                    <div class="d-flex align-items-center windowSep">
	                        <h4><?php echo ucfirst($value['window_name']);?> <?php echo $this->lang->line('lab_window_text');?></h4>
	                       <a href="<?php echo site_url('create_service?wid='.base64_encode($value['id']));?>">
	                        <img src="<?php echo site_url();?>assets/front/images/ser_add.svg" alt="">
	                       </a>
	                    </div>
	                    <?php if(!empty($value['services'])) { ?>
	                    <?php foreach ($value['services'] as $val) { ?>
	                    <div class="card mb-2 shadow r-10">
	                        <div class="card-body p-0 searchList servicelist">
	                            <div class="d-flex ">
	                                <div class="caption ">
	                                    <div class="d-flex p-2 border-bottom w-100 align-items-center justify-content-between">
	                                        <h4 class="mb-0"><?php echo ucfirst($val['service_name']);?></h4>
	                                      
	                                    </div>
	                                    <div class="d-flex p-1 px-2 w-100 align-items-center justify-content-between timingslots">
	                                        <div class="mb-0 d-flex flex-column"><span><?php echo $this->lang->line('lab_take_time_text');?></span>  <span><?php echo $val['service_time_str'];?></span> </div>
	                                        <div class="mb-0 d-flex flex-column"><span><?php echo $this->lang->line('lab_serve_text');?></span>  <span><?php echo $val['service_person'];?></span> </div>
	                                        <div class=""> 
	                                            <a href="<?php echo site_url('edit_service?id='.base64_encode($val['id']));?>" class="btn btn-outline-primary btn-sm editBtn"><?php echo $this->lang->line('btn_edit_text');?></a>
	                                         </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
                
	                	<?php } } }?>
                    </div>
                </div>
            </div>
    	</div>
  </div>
