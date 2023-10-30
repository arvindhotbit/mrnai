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
                		<form method="get" action="<?php echo base_url().'admin/role_list';?>"> 
						<div class="box-body col-md-12"> 
			              <div class="form-group col-md-3">
			                 <input class="column_filter form-control" oninput="this.value = this.value.replace(/[^A-Za-z0-9-'()& ]/g,'');" name="name" data-column="1" id="col1_filter" type="text" placeholder="Name" value="<?php echo $filter_name;?>">
			              </div>
			                
			              <div class="form-group col-md-3">
			               	<input class="btn btn-primary" type="submit" value="Filter">
			               	<a class="btn btn-default" href="<?php echo base_url().'admin/role_list';?>">Reset</a>
			 
			              </div> 
			          	</div>
			          </form> 
		          		<?php if(isset($add_action) && !empty($add_action)){ ?>
                  			<a href="<?php echo $add_action;?>" title="" data-toggle="tooltip" data-original-title="Add Role" class="btn btn-default pull-right"><i class="fa fa-plus"></i></a>
                		<?php } ?>  	
                	</div> 

					<div class="box-body table-responsive">

						<table <?php  if(!empty($records_results))
								{	?>  <?php } ?> class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th> 
									<th>Role Name</th> 
									<!-- <th>Parent Role Name</th>  -->
									<th>Status</th> 
									<th>Actions</th>
									
								</tr>
							</thead>
							<tbody>
	

								<?php 
								if(!empty($records_results))
								{	
									$i = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
									$table="roles";
									$field = "role_id";

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
											<td><?php if(!empty($row['name'])) echo $row['name']; ?></td>
											<td>
												<p id="status_<?php echo $row[$field]; ?>" onclick="change_status('<?php echo $field; ?>','<?php echo $row[$field]; ?>','<?php echo $table; ?>')" class="<?php echo $class; ?>" title="" data-toggle="tooltip" data-original-title="Change Status"><?php echo $status; ?></p>
											</td>
												
											<td class="td-actions">
											<?php if(isset($edit_action) && !empty($edit_action)){ ?>
											
												<a id="edit_product" href="<?php echo $edit_action.'/'.$row[$field]; ?>" class="btn btn-xs btn-primary edit_product" title="" data-toggle="tooltip" data-original-title="Edit">
													<i class="fa fa-pencil"></i>
												</a>&nbsp;&nbsp;

											<?php } ?> 	
											<?php if(!empty($undeletable_ids) && !empty($row[$field])) {
												if (!in_array($row[$field], $undeletable_ids)) { ?>
													<?php if(isset($delete_action) && !empty($delete_action)){ ?>
													<a  href="javascript:void(0)" class="btn btn-xs btn-danger"  
													onclick="delete_report_page_list('role_id','<?php echo $row['role_id'];?>','roles')" data-toggle="tooltip" data-original-title="Delete">
														<i class="fa fa-trash-o"></i>
													</a>&nbsp;&nbsp;
											<?php } } } ?>	 
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
										<td align="center">Total Records - <?php echo $total_records;?></td>
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

<script>
function delete_report_page_list(field,id,table)
{ 
    if(id) {
         var a = confirm("Are you sure to delete this record?");
		if(a) {
	         $.ajax({
            type:'POST',
            data:{ 
                id:id,
                table_name:table,
                field:field 
            },
            url: base_url+"admin/ajax/delete_record/",
            success:function(data)
            {
             location.reload(); 
            }
        });
		}else{
		  return false;
		}

       
    }
}
</script>