<body>
    <div class="wrapper">
    	<div class="topSection themeClr">
        	<div class="container mini-container">
            	<div class="row ">
                	<div class="col-12 g-0 shadow">
                    	<div class="d-flex bg-white bg-default justify-content-between align-items-center py-2">
                        	<div><a class="cursor-pointer" href="<?php echo $back_link;?>">
                        		<img src="<?php echo site_url();?>assets/front/images/ic_back_dark.svg" alt=""></a>
                        	</div>
                        	<div class="heading">
                            	<h6><?php echo $this->lang->line('head_my_booking_no_title');?></h6>
                        	</div>
                        	<div><a href="#" class="invisible"><img src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt=""></a></div>
                    	</div>
                	</div>
            	</div>
        	</div>
   	 	</div>
    	<div class="bottomSection h-100vh my-3">
        	<div class="container mini-container">
            	<div class="row">
                	<div class="col-12" id="bookinglist">
                    	
                    </div>
                </div>
            </div>
    	</div>
    </div>

<script type="text/javascript">
if(localStorage.getItem("openseatuser")){
	var openseatuser=localStorage.getItem("openseatuser");
	openseatuser=openseatuser.split("||");
	getBooking(openseatuser[0],openseatuser[2]);
}
function getBooking(token,mobileno) {

	$.ajax({
		url: "<?php echo site_url('my_booking');?>/"+token,
		type: 'GET',
		data: {},
		dataType: 'json',
		success:function(resp){
			if(resp.status==1){
				
				for (var i = 0; i < resp.list.length; i++) {
					let rec=resp.list[i];
					
					var html=`<div class="card mb-2 r-10">
                        	<div class="card-body p-2 searchList">
                            	<div class="d-flex ">
                                    <a href="${rec.link}">
                                    	<div class="me-2 position-relative">
                                        	<img src="${rec.logo}" alt=""  class="img-fluid">
    	                                    <span class="count1">${rec.seat_no}</span>
    	                                    <span class="online1"></span>
                                    	</div>
                                    </a>
	                                <div class="caption">
	                                    <h4 class="mb-0">${rec.business_name}</h4>
	                                    <p class="mb-0"><span>${rec.window_name} Window</span><span class="text-dark">${rec.category}</span> </p>
	                                    <p class="mb-0">${rec.address}</p>
	                                </div>
	                            </div>
	                        </div>
	                    </div>`;
	                $("#bookinglist").append(html);

				}
			}else{
				$("#bookinglist").append(`<?php echo $this->lang->line('info_no_booking_text');?>`);
			}
		}
	});
}
</script>