function change_status(field,id,table)
{

    if(id) {

        $("#status_"+id).html('Wait...');

        $.ajax({

            type:'POST',

            data:{ 

                id:id,

                table_name:table,

                field:field 

            },

            url: base_url+"admin/ajax/change_status/",

            success:function(data)

            {
                
                var response = JSON.parse(data);

                if(response.msg=="success") {

                     if(response.status == 'Inactive') {

                        $("#status_"+id).html(response.status);

                        $("#status_"+id).removeClass('bg-green');

                        $("#status_"+id).addClass('bg-red');

                    }

                    else {

                        $("#status_"+id).html(response.status);

                        $("#status_"+id).removeClass('bg-red');

                        $("#status_"+id).addClass('bg-green');

                        

                    }

                }
                else if(response.msg=="one_record")
                {
                    alert("Only one record is remaining.You cannot change status.");
                    $("#status_"+id).html('Active');
                }
                else {

                    alert("Some error occurred. Please try again !!");

                }

               

            }

        });

    }

}


function delete_record(id,table,field) {
    if(id && table && field) {
        var r = confirm('Are you sure you want to delete record ?');
        if (r == true) {
            $.ajax({
                type:'POST',
                url: "admin/Ajax/delete_records",
                data: {id:id,field:field,table:table},
                
                success:function(data)
                {
                    data = JSON.parse(data);
                    if(data.status==true) 
                    {
                        success_msg = data.msg ;
                        success = '<div class="alert alert-block alert-success fade in"><button data-dismiss="alert" class="close" type="button">×</button>'+success_msg+'</div>';
                        //$('#notification_msg').html(success).fadeIn(250).fadeOut(10000);
                        location.reload();
                    } else {
                        error_msg =  data.msg ;
                        error = '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close" type="button">×</button>'+error_msg+'</div>';
                        location.reload();
                        $('#notification_msg').html(error).fadeIn(250).fadeOut(10000);
                    }
                }       
            });
        } 
    }
}


//To update the help questions order

function update_order(id,table,type)

{

    if(id!='' && table!='') {

        $("#order_"+id).next().hide();

        $("#order_"+id).after("<img style='padding:4px;' src='assets/images/loading.gif'>");

        $('#notification_msg').html('');

        var order = $("#order_"+id).val();

       

        $.ajax({

            type:'POST',

            data:{ 

                id:id,

                order:order,

                table:table,

                type:type

            },

            url: base_url+"admin/ajax/update_order/",

            success:function(data)

            {   

                $("#order_"+id).next().remove();

                $("#order_"+id).next().show();

                var response = JSON.parse(data);

               

                if(response.status==true) {

                    $('#notification_msg').html('<div class="alert alert-success fade in"><button data-dismiss="alert" class="close" type="button">×</button><p>'+response.msg+'</p></div>');

                }

                else {

                    $('#notification_msg').html('<div class="alert alert-danger fade in"><button data-dismiss="alert" class="close" type="button">×</button><p>'+response.msg+'</p></div>');

                }

            }

        });

    }

}

function soft_delete_user_record(id,table,field) {
    if(id && table && field) {
        var r = confirm('Are you sure you want to delete record ?');
        if (r == true) {
            $.ajax({
                type:'POST',
                url: "admin/Ajax/soft_delete_user_record",
                data: {id:id,field:field,table:table},
                
                success:function(data)
                {
                    data = JSON.parse(data);
                    if(data.status==true) 
                    {
                        success_msg = data.msg ;
                        success = '<div class="alert alert-block alert-success fade in"><button data-dismiss="alert" class="close" type="button">×</button>'+success_msg+'</div>';
                        //$('#notification_msg').html(success).fadeIn(250).fadeOut(10000);
                        location.reload();
                    } else {
                        error_msg =  data.msg ;
                        error = '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close" type="button">×</button>'+error_msg+'</div>';
                        $('#notification_msg').html(error).fadeIn(250).fadeOut(10000);
                    }
                }       
            });
        } 
    }
} 

function sort_delete_record(id,table,field) {
    if(id && table && field) {
        var r = confirm('Are you sure you want to delete record ?');
        if (r == true) {
            $.ajax({
                type:'POST',
                url: "admin/Ajax/sort_delete_record",
                data: {id:id,field:field,table:table},
                
                success:function(data)
                {
                    data = JSON.parse(data);
                    if(data.status==true) 
                    {
                        success_msg = data.msg ;
                        success = '<div class="alert alert-block alert-success fade in"><button data-dismiss="alert" class="close" type="button">×</button>'+success_msg+'</div>';
                        //$('#notification_msg').html(success).fadeIn(250).fadeOut(10000);
                        location.reload();
                    } else {
                        error_msg =  data.msg ;
                        error = '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close" type="button">×</button>'+error_msg+'</div>';
                        $('#notification_msg').html(error).fadeIn(250).fadeOut(10000);
                    }
                }       
            });
        } 
    }
} 


