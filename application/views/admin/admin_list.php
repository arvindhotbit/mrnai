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
			<div class="col-xs-12">
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
                  		<h3 class="box-title">Filter Here</h3> 
                		<form method="get" action="<?php echo base_url().'admin/subadmin/list';?>"  data-parsley-validate>
						<div class="box-body col-md-12">
		            	 	<div class="form-group col-md-3">
								<select class="column_filter form-control" name="role_name">
									<option value="" >Select Role</option>
									<?php if(!empty($role_list)){	
									foreach ($role_list as $list) {  ?>

									   <option <?php if(@$_GET['role_name']==$list['role_id']){ echo 'selected'; }?>  value="<?php echo $list['role_id'];?>" ><?php echo $list['name'];?></option>
									<?php }} ?> 
								 </select>
							</div>
			        
			              	<div class="form-group col-md-3">
			                 	<input class="column_filter form-control" oninput="this.value = this.value.replace(/[^A-Za-z0-9-'()& ]/g,'');"  data-parsley-pattern="^[a-z A-Z 0-9 ]+$" data-parsley-pattern-message="please enter vaild name." name="name" data-column="1" id="col1_filter" type="text" placeholder="Name" value="<?php echo $filter_name;?>">
			              	</div>
		              
			              	<div class="form-group col-md-3">
			                 	<input class="column_filter form-control" name="email" data-column="1" id="col1_filter" type="text" placeholder="Email" value="<?php echo $filter_email;?>">
			              	</div>  

		                    <div class="form-group col-md-3">
			                 	<input class="column_filter form-control" name="mobile" data-column="1" oninput="this.value = this.value.replace(/[^0-9-' ]/g,'');"  id="col1_filter" type="text" placeholder="Mobile" value="<?php echo $filter_mobile;?>">
			              	</div> 
			              	<div class="form-group col-md-3">
			               		<input class="btn btn-primary" type="submit" value="Filter">
			               		<a class="btn btn-default" href="<?php echo base_url().'admin/subadmin/list';?>">Reset</a>
			 
			              	</div>
			          	</div>

                  		<?php if(isset($add_action) && !empty($add_action)){ ?>
                  		<a href="<?php echo $add_action;?>" title="" data-toggle="tooltip" data-original-title="Add User" class="btn btn-default pull-right"><i class="fa fa-plus"></i></a>
                		<?php } ?>
                		
			          </form>
                	</div>
					<div class="box-body table-responsive">
						<table <?php  if(!empty($records_results))
								{	?>  <?php } ?> class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Profile Pic.</th> 
									<th>Full Name</th>
									<th>Role</th>
									<th>Email</th> 
									<th>Mobile</th> 
									<th>Status</th> 
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
	
								<?php 
								if(!empty($records_results))
								{	
									$i = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
									$table="admin";
									$field = "admin_id";
									foreach ($records_results as $row) { $i++; 
										if(isset($row['status'])) {
	                                        if($row['status']=="Active") {
	                                            $status = "Active";
	                                            $class = "pointer badge bg-green";
	                                        } else {
	                                            $status = "Inactive";
	                                            $class = "pointer badge bg-red";
	                                        }
                                    	}?>
										<tr id="tr_<?php echo $row[$field]; ?>">
											<td><?php echo $i; ?></td>
											<td class="user-block">
												<?php if(isset($row['profile_pic']) && !empty($row['profile_pic'])){ ?>
													<img src="<?php echo base_url().$row['profile_pic']; ?>" alt="user image" class="img-circle img-bordered-sm">
												<?php } else { ?>
													<img src="<?php echo base_url().'assets/images/placeholder_image.jpeg'; ?>" alt="user image" class="img-circle img-bordered-sm">
												<?php } ?>
											</td>
											
											<td><?php if(!empty($row['fullname'])) echo $row['fullname']; ?></td>
											<td><?php if(!empty($row['role_name'])) echo $row['role_name']; ?></td>
											<td><?php if(!empty($row['email'])) echo $row['email']; ?></td>
											<td><?php if(!empty($row['mobile'])) echo $row['mobile']; ?></td>
											<td>
												<?php if(isset($edit_action) && !empty($edit_action)){ ?> 
												
													<p id="status_<?php echo $row[$field]; ?>" onclick="change_status('<?php echo $field; ?>','<?php echo $row[$field]; ?>','<?php echo $table; ?>')" class="<?php echo $class; ?>" title="" data-toggle="tooltip" data-original-title="Change Status"><?php echo $status; ?></p>
												
												<?php } ?> 	
											</td>
											<td class="td-actions">
												<?php if(isset($edit_action) && !empty($edit_action)){ ?>
													<a id="edit_product" href="<?php echo $edit_action.'/'.$row[$field]; ?>" class="btn btn-xs btn-primary edit_product" title="" data-toggle="tooltip" data-original-title="Edit">
														<i class="fa fa-pencil"></i>
													</a>&nbsp;&nbsp;

												<?php } ?> 	
												<?php if(isset($delete_action) && !empty($delete_action)){ ?>
													<a  href="javascript:void(0)" class="btn btn-xs btn-danger"  
													onclick="soft_delete_user_record('<?php echo $row['admin_id'];?>','admin','admin_id')" data-toggle="tooltip" data-original-title="Delete">
														<i class="fa fa-trash-o"></i>
													</a>&nbsp;&nbsp;
												<?php } ?>	 
											</td>
										
										</tr> 

									<?php }
								} else {
									echo "<tr><td colspan='7' align='center'> No Record Found</td></tr>";
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

