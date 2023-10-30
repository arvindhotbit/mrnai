<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">      
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
            <div class="col-lg-12">
                <form class="" id="" method="POST" enctype="multipart/form-data"  action="<?php echo current_url(); ?>" role="form" data-parsley-validate>
                    <div class="col-lg-6">
                        <h3><?php if(isset($page_title)) echo $page_title; ?></h3>
                        <div class="box box-primary">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="panel-body">
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
                                    <!-- ajax error msg -->
                                    <div id= 'notification_msg'> </div> 
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="name" >Role Name *</label>
                                            <input type="text" class="form-control"  maxlength="50"  name="role_name" id="rolename" value="<?php if(isset($admin_data['name'])) echo $admin_data['name']; ?>" placeholder="Role Name" data-parsley-pattern="^[a-z A-Z 0-9 ]+$" data-parsley-required data-parsley-required-message="Please enter Role Name." data-parsley-pattern-message="please enter vaild role name."  oninput="this.value = this.value.replace(/[^A-Za-z0-9-'()& ]/g,'');">
                                               <p class="error" id="email_error" style="display:none;">Role Name already used.</p>
                                            <?php echo form_error('name'); ?>
                                        </div> 
                                    </div>
                                    <?php $type = $this->session->userdata('user_type');
                                          $admin_id = $this->session->userdata('admin_id');
                                        if($type=='Super Admin'){
                                            $type='Admin';
                                        }
                                       $parent_id=$this->Common_model->getRecords('roles','parent_id',array('type'=>$type),'',true);
                                       echo '<input type="hidden" id="parent_id" value="'.$parent_id['parent_id'].'">';
                                       echo '<input type="hidden" id="admin_id" value="'.$admin_id.'">';
                                    ?>              

                                </div><!-- panel body-->
                            </div>
                        </div>
                    </div><!-- row-->
                </div><!-- col-6-->

                 <div class="col-md-6">
                    <h3>Permissions</h3>
                    <div class="box box-primary">
                        <div class="box-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Section</th>
                                        <?php /*<th><input class="align-right p_check" type="checkbox" name="view" value="1"> View</th>
                                        <th><input class="align-right p_check" type="checkbox" id="add" name="add" value="1"> Add </th>
                                        <th><input class="align-right p_check" type="checkbox" id="edit" name="edit" value="1"> Edit </th>
                                        <th><input class="align-right p_check" type="checkbox" id="delete" name="delete" value="1"> Delete </th><?php */?>  
                                        <th> View</th>
                                        <th> Add </th>
                                        <th>Edit </th>
                                        <th>Delete </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if(!empty($permission))
                                {   
                                                               
                                    $i = 0;
                                    foreach ($permission as $row) {

                                        $i++; 
                                        ?>
                                        <?php if(!empty($row['name']) && $row['name']!='Settings' && $row['name']!='Manage Roles' && $row['name']!='Manage Admin' && $row['name']!='Manage Domain') { ?>
                                        <tr id="tr_<?php echo $row['id']; ?>">

                                            <td><?php echo $i; ?></td> 
                                            <td class="align-right">
                                                <?php if($row['parent_id']>0){
                                                    echo "--";
                                                }?>
                                                <?php if(!empty($row['name'])) echo $row['name']; ?>
                                                
                                            </td>
                                            <input class="align-right" type="hidden" name="sections[]" value="<?php echo  $row['id']; ?>">
                                            <td>
                                                
                                                <input  class="align-right view viewcheck parentviewcheck viewchildrow_<?php echo $row['parent_id']; ?>" view-attr="<?php echo  $row['id']; ?>" type="checkbox" name="permission[<?php echo  $row['id']; ?>][view]" <?php if($row['parent_id']>0){ echo "disabled"; }?>>
                                                
                                            </td>
                                            <?php //if(!empty($row['name']) && $row['name']!='Dashboard') { ?>
                                                
                                                <td>
                                                    <input disabled class="align-right add viewcheck1_<?php echo $row['id']; ?> childrow_<?php echo $row['parent_id']; ?>" type="checkbox" name="permission[<?php echo  $row['id']; ?>][add]">
                                                    
                                                </td>
                                                <td>
                                                   
                                                    <input disabled class="align-right edit viewcheck1_<?php echo $row['id']; ?> childrow_<?php echo $row['parent_id']; ?>" type="checkbox" name="permission[<?php echo  $row['id']; ?>][edit]">
                                                    
                                                </td>
                                                <td>
                                                    <input disabled class="align-right delete viewcheck1_<?php echo $row['id']; ?> childrow_<?php echo $row['parent_id']; ?>" type="checkbox" name="permission[<?php echo  $row['id']; ?>][delete]">
                                                    
                                                </td>
                                            <?php //} ?>
                                           
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>    
                                <?php } else {
                                    echo "<tr><td colspan='7' align='center'> No Record Found</td></tr>";
                                } ?>
                                </tbody>
                            </table>
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <a href="admin/role_list" class="btn btn-default">Back</a>
                                    </div>
                                </div>
                            </div>    
                        </div><!-- panel body-->
                    </div><!-- panel body-->
                </div>
            </form>
        </div>
    </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
var error_msg ='';
var error_msg1 ='';
//check email 
$('#rolename').change(function(e) {
    var id = "A"; 
    var role_name = $("#rolename").val();
    var parent_id = $("#parent_id").val();
    var admin_id = $("#admin_id").val();
    

    if(id!='') {

        $.ajax({
            type:'POST',
            url: "<?php echo base_url(); ?>admin/ajax/check_role_name/",
            data: {id:id,role_name:role_name,parent_id:parent_id,admin_id:admin_id},
            
            success:function(data)
            {
                console.log(data);
                if(data==1) {
                    error_msg1 = "Role name already used." ;
                    $("#email_error").show();
                }else{
                    error_msg1 = "" ;
                    $("#email_error").hide();
                }
            }
        });
    }
});

$(document).ready(function(){
    $('.p_check').click(function(event) {
        var p_class = '.'+$(this).attr('name');
        if(this.checked) {
            // Iterate each checkbox
            $(p_class).each(function() {
                this.checked = true;
            });
        } else {
            $(p_class).each(function() {
                this.checked = false;
            });
        }
    });

});

$(document).ready(function(){
    $('.viewcheck').click(function(event) {

        var p_class = $(this).attr('view-attr');
       
        if(this.checked) {

            $('.viewcheck1_'+p_class).each(function() {
                this.disabled = false;
            });
        } else {
            // alert(p_class);
            $('.viewcheck1_'+p_class).each(function() {
                this.checked = false;
            });
            $('.viewcheck1_'+p_class).each(function() {
                this.disabled = true;
            });
        }
    });

    $('.parentviewcheck').click(function(event) {

        var p_class = $(this).attr('view-attr');
       
        if(this.checked) {

            $('.viewchildrow_'+p_class).each(function() {
                this.disabled = false;
            });

        } else {
            $('.viewchildrow_'+p_class).each(function() {
                this.checked = false;
            });
            $('.viewchildrow_'+p_class).each(function() {
                this.disabled = true;
            });

            $('.childrow_'+p_class).each(function() {
                this.checked = false;
            });
            $('.childrow_'+p_class).each(function() {
                this.disabled = true;
            });
        }
    });

});
    
$(document).ready(function(){
    $("form").submit(function(){
      
        if(error_msg !=''){
            return false;
        }
         if(error_msg1 !=''){
            return false;
        }
    });
});
</script>



















