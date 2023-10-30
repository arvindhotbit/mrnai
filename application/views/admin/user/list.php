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
                		<form method="get" action="<?php echo base_url().'admin/user/list';?>"> 
						<div class="box-body row"> 
                        	<div class="form-group col-md-3">
                                <input class="column_filter form-control" id="name" name='name' type="text" placeholder="Name" value="<?php if(!empty($filter_name))echo $filter_name;?>">
			              	</div>
                        	<div class="form-group col-md-3">
                               <input class="column_filter form-control" id="phone_no" name='phone_no' type="text" placeholder="Phone Number" value="<?php if(!empty($filter_phone_no))echo $filter_phone_no;?>">
                        	</div> 
			              	<div class="form-group col-md-3">
				              	<select name="status" id="status" class="column_filter form-control">
				              		<option value="">Status</option>
				              		<option value="Active" <?php if(!empty($filter_status)&& $filter_status=='Active'){ echo 'selected'; }?>>Active</option>
				              		<option value="Inactive" <?php if(!empty($filter_status)&& $filter_status=='Inactive'){ echo 'selected'; }?>>Inactive</option>
				              	</select> 
	                        </div> 
							<div class="form-group col-md-3">
							<input class="btn btn-primary" type="submit" value="Search">
							<a class="btn btn-default" href="<?php echo base_url().'admin/user/list';?>">Reset</a>
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
									<th width="8%">Name</th>
									<th width="8%">Mobile Number</th>
									<th width="8%">Date</th>
									<th width="4%">Status</th>
                                	<th width="7%">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if(!empty($records_results))
								{	
									$i = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
									$table="users";
									$field = "id";
									foreach ($records_results as $row) { $i++; 
										if(isset($row['status'])) {
	                                        if($row['status']=="Active") {
	                                            $status = "Active";
	                                            $class = "pointer badge bg-green";
	                                            $cls="badge bg-green";
	                                        } else {
	                                            $status = "Inactive";
	                                            $class = "pointer badge bg-red";
	                                            $cls="badge bg-red";
	                                        }
                                    	}
                                    	?>
										<tr id="tr_<?php echo $row[$field]; ?>">
										
											<td><?php echo $i; ?></td>
											<td><?php if(!empty($row['fullname'])) echo $row['fullname'];?></td>
											<td><?php if(!empty($row['phone_no'])) echo $row['phone_no'];?></td>
											<td><?php if(!empty($row['created'])) echo date('d/M/Y h:i A',strtotime($row['created']));?></td>
											
											<?php if(isset($edit_action) && !empty($edit_action)){ ?>
												<td><p id="status_<?php echo $row[$field]; ?>" onclick="change_status('<?php echo $field; ?>','<?php echo $row[$field]; ?>','<?php echo $table; ?>')" class="<?php echo $class; ?>" title="" data-toggle="tooltip" data-original-title="Change Status"><?php echo $status; ?></p></td>
												<?php } else{ ?>
													<td>
                                            			<p id="status_<?php echo $row[$field]; ?>" class="<?php echo $cls; ?>" title="" ><?php echo $status; ?></p>
													</td>
											<?php }?>
											<td class="td-actions">
												
												<?php /*if(isset($edit_action) && !empty($edit_action)){ ?>
													
													<a id="" href="<?php echo $edit_action.'/'.$row[$field]; ?>" class="btn btn-xs btn-primary" title="" data-toggle="tooltip" data-original-title="Edit">
														<i class="fa fa-pencil"></i>
													</a>
												<?php }*/ ?>
												<?php if(isset($delete_action) && !empty($delete_action)) { ?>
													<?php if(!empty($row[$field])) {
														if (!in_array($row[$field], $undeletable_ids)) { ?>
															<button class="btn btn-xs bg-red delete" data-toggle="tooltip" data-original-title="Delete" onclick="return soft_delete_user_record(<?php if(!empty($row[$field])) echo $row[$field]; ?>,'<?php echo $table; ?>','<?php echo $field; ?>');"><i class="fa fa-trash-o"></i></button>
														<?php }
													} 
												} ?>
											</td>
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
$('#import_csv').click(function () {
    $('#pfile').click();
    $('#pfile').change(function () {
	    $("#errors_record_box").empty();

        var val = $(this).val();
        var file = val.substring(val.lastIndexOf('.') + 1).toLowerCase();

        if (file!='xls' && file!='xlsx') {
            alert('Only xls and xlsx format is allowed');
            location.reload();
            return false;
        } else {
            $('#loader').show();
            $('#psubmit').click();
            // submitDetailsForm('importFrm',"<?php echo site_url('admin/User/import_user');?>");
        }

    });
});	
</script>