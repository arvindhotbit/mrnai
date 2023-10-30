<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  	<h1> <?php echo $page_title;?> </h1>
  		<ol class="breadcrumb">
			<?php foreach ($breadcrumbs as  $breadcrumb) { ?>
				<li class="<?php echo $breadcrumb['class'];?>"> 
					<?php if(!empty($breadcrumb['link'])) { ?>
						<a href="<?php echo $breadcrumb['link'];?>"><?php echo $breadcrumb['icon'].$breadcrumb['title'];?></a>
					<?php } else {
						echo $breadcrumb['icon'].$breadcrumb['title'];
					} ?>
				</li>
			<?php }?>
  		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12 message_box">
				<?php if ($this->session->flashdata('error')) { ?>
					<div class="alert alert-block alert-danger fade in">
						<button data-dismiss="alert" class="close" type="button">×</button>
						<?php echo $this->session->flashdata('error') ?>
					</div>
				<?php } ?>
				<?php if ($this->session->flashdata('success')) { ?>
					<div class="alert alert-block alert-success fade in">
					<button data-dismiss="alert" class="close" type="button">×</button>
					<?php echo $this->session->flashdata('success') ?>
				</div>
				<?php } ?>
				<div class="box">
					<div class="box-header with-border">  
                  		<!--<h3 class="box-title">Filter Here</h3>-->  
                		<form method="get" action="<?php echo base_url().'admin/booking/list';?>"> 
						<div class="box-body row"> 
			              	<div class="form-group col-md-3">
                               <input class="column_filter form-control" id="booking_no" name='booking_no' type="text" placeholder="Booking No." value="<?php if(!empty($filter_booking_no))echo $filter_booking_no;?>">
                        	</div> 
                        	<div class="form-group col-md-3">
                               <input class="column_filter form-control" id="mobile_no" name='mobile_no' type="text" placeholder="Mobile No." value="<?php if(!empty($filter_mobile_no))echo $filter_mobile_no;?>">
                        	</div> 
                        	<div class="form-group col-md-3">
                               <input class="column_filter form-control" id="business" name='business' type="text" placeholder="Business" value="<?php if(!empty($filter_business))echo $filter_business;?>">
                        	</div> 
                        	<div class="form-group col-md-3">
				              	<select name="category" id="category" class="column_filter form-control">
				              		<option value="">Category</option>
				              		<?php foreach ($categories as $cat) { ?>
				              		<option value="<?php echo $cat['id'];?>" <?php if(!empty($filter_category)&& $filter_category==$cat['id']){ echo 'selected'; }?>><?php echo $cat['name'];?></option>
				              		<?php } ?>
				              	</select> 
	                        </div>
                        	<div class="form-group col-md-3">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="column_filter form-control pull-right daterange" id="daterange" name="daterange"  autocomplete="off"  Placeholder="Date Time" oninput="this.value = this.value.replace(/[^]/g, '').replace(/(\..*)\./g, '$1');" value="<?php if(!empty($filter_daterange)&& $filter_daterange){ echo $filter_daterange; }?>" >
                                </div>
                            </div>
			              	<div class="form-group col-md-3">
				              	<select name="status" id="status" class="column_filter form-control">
				              		<option value="">Status</option>
				              		<option value="Pending" <?php if(!empty($filter_status)&& $filter_status=='Pending'){ echo 'selected'; }?>>Pending</option>
				              		<option value="In-Progress" <?php if(!empty($filter_status)&& $filter_status=='In-Progress'){ echo 'selected'; }?>>In-Progress</option>
				              		<option value="Confirm" <?php if(!empty($filter_status)&& $filter_status=='Confirm'){ echo 'selected'; }?>>Confirm</option>
				              		<option value="Canceled" <?php if(!empty($filter_status)&& $filter_status=='Canceled'){ echo 'selected'; }?>>Canceled</option>
				              		<option value="Completed" <?php if(!empty($filter_status)&& $filter_status=='Completed'){ echo 'selected'; }?>>Completed</option>
				              	</select> 
	                        </div>
			             	<div class="form-group col-md-3">
			               		<input class="btn btn-primary" type="submit" value="Search">
			               		<a class="btn btn-default" href="<?php echo base_url().'admin/booking/list';?>">Reset</a>
			             	</div>
			             
			          	</div>
			          </form> 
		          		<?php if(isset($add_action) && !empty($add_action)){ ?>
	              			<a href="<?php echo $add_action;?>" title="" data-toggle="tooltip" data-original-title="Add" class="btn btn-default pull-right"><i class="fa fa-plus"></i></a>
	            		<?php } ?>  
	                		
                	</div> 

					<div class="box-body  table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th width="3%">#</th>
									<th width="8%">Booking No.</th>
									<th width="8%">Business</th>
									<th width="8%">Category</th>
									<th width="8%">User Name</th>
									<th width="8%">User No.</th>
									<th width="8%">Services</th>
									<th width="8%">Serve Time</th>
									<th width="8%">State</th>
									<th width="8%">City</th>
									<th width="8%">Status</th>
									<th width="8%">Date</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if(!empty($records_results))
								{	
									$i = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
									$table="booking";
									$field = "id";
									foreach ($records_results as $row) { $i++; 
										/*if(isset($row['status'])) {
	                                        if($row['status']=="Active") {
	                                            $status = "Active";
	                                            $class = "pointer badge bg-green";
	                                            $cls="badge bg-green";
	                                        } else {
	                                            $status = "Inactive";
	                                            $class = "pointer badge bg-red";
	                                            $cls="badge bg-red";
	                                        }
                                    	}*/
                                    	?>
										<tr id="tr_<?php echo $row[$field]; ?>">
										<!-- serve_time,seat_no,services -->
											<td><?php echo $i; ?></td>
											<td><?php if(!empty($row['booking_no'])) echo $row['booking_no'];?></td>
											<td><?php if(!empty($row['business_name'])) echo $row['business_name'];?></td>
											<td><?php if(!empty($row['category'])) echo ucwords($row['category']);?></td>
											<td><?php if(!empty($row['fullname'])) echo $row['fullname'];?></td>
											<td><?php if(!empty($row['phone_no'])) echo $row['phone_no'];?></td>
											<td><?php if(!empty($row['services'])) echo ucwords($row['services']);?></td>
											<td><?php if(!empty($row['serve_time'])) echo ucwords($row['serve_time']);?>min</td>
											<td><?php if(!empty($row['state'])) echo ucwords($row['state']);?></td>
											<td><?php if(!empty($row['city'])) echo ucwords($row['city']);?></td>
											<td><?php if(!empty($row['status'])) echo ucwords($row['status']);?></td>
											<td><?php if(!empty($row['created'])) echo date('d/M/Y h:i A',strtotime($row['created']));?></td>
											
										</tr>

									<?php }
								} else {
									echo "<tr><td colspan='12' align='center'> No Record Found</td></tr>";
								} ?>
							</tbody>
						</table>
						<tfoot>						
							<tr>
								<?php if(!empty($pagination)) { ?>
									<td >Total Records - <?php echo $total_records;?></td>
									<td colspan="7" align="center">
										<div><?php echo $pagination; ?></div>
									</td>
								<?php }else{ ?>	
									<td align="center">Total Records - <?php if($total_records >0){echo $total_records;} else{echo '0';}?></td>
									<td colspan="7" align="center"></td>
								<?php } ?>			
							</tr>
						</tfoot>	
					</div>			
				</div>			
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
	$(function () {
	    $('.daterange').daterangepicker({
	        format: 'MM-DD-YYYY '
	    });
    });
</script>