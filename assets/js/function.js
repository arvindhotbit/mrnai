$(function(){
    var path=window.location.href;
    path=path.replace(/\/$/,"");
    path=decodeURIComponent(path);
    //console.log(path.split("/")[5]);
    $('.sidebar-menu a').each(function(){
        var href=$(this).attr('href');
        if(path.substring(0,href.length)==href){
            $(this).parent('li').addClass('active');
        }
        //console.log(href.split("/")[5]);
        if(path.split("/")[4]==href.split("/")[4]){
        	$(this).parent('li').addClass('active');
        	$(this).parent('li').parent('ul').parent('li').addClass('active');
        }
    });
});

//side menu activation
var pid="";

$(document).ready(function() {
  //Profile pic upload
$(".upload_profile_pic").click(function(event) {

	$('#status_image').html('');

   	var file = document.getElementById("image").files[0];
   	$("#error").html('');
    $('#success').html('');
	if(file)

	{  

		var file_type = file.type.toLowerCase(file.type);

		if(file_type=="image/jpeg" || file_type=="image/png" || file_type=="image/jpg")

		{

			// $(".btn-file span.fileupload-new").hide();

		 //    $(".btn-file .fileupload-exists").show();

			aid =$("#admin_id").val();

			var formdata= new FormData();

			formdata.append('aid',aid);

			formdata.append('image',file);

			var ajax = new XMLHttpRequest();

			ajax.upload.addEventListener("progress", img_progressHandler, false);

			ajax.addEventListener("load", img_completeHandler, false);

			ajax.addEventListener("error", img_errorHandler, false);

			ajax.addEventListener("abort", img_abortHandler, false);

			ajax.open("POST", site_url+'admin/Ajax/profile_pic_upload');

			ajax.send(formdata);



			ajax.onreadystatechange = function() {

		        if (this.readyState == 4 && this.status == 200) {

		        	var new_src=  $(".fileupload-preview img").attr('src');	

		        	$(".fileupload-new img").attr('src',new_src);	

		        	$(".fileupload").removeClass('fileupload-exists').addClass('fileupload-new');

		       }

		    };

		}

		else

		{

		 	var error_msg = 'Please select JPEG/JPG/PNG image only.';
            $("#error").html(error_msg);
            return false;
		  // alert("Please Select JPG/PNG Only");

		}/* File Type Matched*/

		 

	}/* If file selected */       

	else

	{

		 $("#error").html("Please select image.");
        	return false;

	}

});	


$(".common_update_image").click(function(event) {
    var file = document.getElementById("image").files[0];
    $("#error").html('');
    $('#success').html('');
    //alert(file);
    if(file) {   
      
        var file_type = file.type.toLowerCase(file.type);
        //alert(file.type);
        if(file_type=="image/jpeg" || file_type=="image/png" || file_type=="image/jpg")
        {
            var record_id =$("#record_id").val();
            var upload_path =$("#upload_path").val();
            var where =$("#where").val();
            var table =$("#table").val();
            var select =$("#select").val();
            
            if($("#width").val()=="" || $("#width").val()==undefined) {
               var width=150; 

            } else {
                var width =$("#width").val();
            }
            if($("#height").val()=="" || $("#width").val()==undefined) {
               var height=150; 
            } else {
                var height =$("#height").val();
            }
           // alert(width);alert(height);
            var formdata= new FormData();
            formdata.append('record_id',record_id);
            formdata.append('upload_path',upload_path);
            formdata.append('table',table);
            formdata.append('where',where);
            formdata.append('select',select);
            formdata.append('image',file);
            formdata.append('height',height);
            formdata.append('width',width);
            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", img_progressHandler, false);
            ajax.addEventListener("load", img_completeHandler, false);
            ajax.addEventListener("error", img_errorHandler, false);
            ajax.addEventListener("abort", img_abortHandler, false);
            ajax.open("POST", 'admin/Ajax/common_update_image');
            ajax.send(formdata);
        } else {
            var error_msg = 'Please select JPEG/JPG/PNG image only.';
            $("#error").html(error_msg);
            return false;
        }/* File Type Matched*/
    }/* If file selected */       
    else {
        $("#error").html("Please select valid image.");
        return false;
    }
});

$(".document_update_image").click(function(event) {
    var file = document.getElementById("image").files[0];
    $("#error").html('');
    $('#success').html('');
    //alert(file);
    if(file) {   
      
        var file_type = file.type.toLowerCase(file.type);
        //alert(file.type);
        if(file_type=="image/pdf" || file_type=="image/PDF" )
        {
            var record_id =$("#record_id").val();
            var upload_path =$("#upload_path").val();
            var where =$("#where").val();
            var table =$("#table").val();
            var select =$("#select").val();
            
            if($("#width").val()=="" || $("#width").val()==undefined) {
               var width=150; 

            } else {
                var width =$("#width").val();
            }
            if($("#height").val()=="" || $("#width").val()==undefined) {
               var height=150; 
            } else {
                var height =$("#height").val();
            }
           // alert(width);alert(height);
            var formdata= new FormData();
            formdata.append('record_id',record_id);
            formdata.append('upload_path',upload_path);
            formdata.append('table',table);
            formdata.append('where',where);
            formdata.append('select',select);
            formdata.append('image',file);
            formdata.append('height',height);
            formdata.append('width',width);
            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", img_progressHandler, false);
            ajax.addEventListener("load", img_completeHandler, false);
            ajax.addEventListener("error", img_errorHandler, false);
            ajax.addEventListener("abort", img_abortHandler, false);
            ajax.open("POST", 'admin/Ajax/common_update_image');
            ajax.send(formdata);
        } else {
            var error_msg = 'Please select pdf only.';
            $("#error").html(error_msg);
            return false;
        }/* File Type Matched*/
    }/* If file selected */       
    else {
        $("#error").html("Please select valid image.");
        return false;
    }
});

	//Profile pic upload

$(".upload_profile_user").click(function(event) {



	$('#status_image').html('');

   	var file = document.getElementById("image").files[0];
   	$("#error").html('');
    $('#success').html('');
	if(file)

	{  
		var file_type = file.type.toLowerCase(file.type);

		if(file_type=="image/jpeg" || file_type=="image/png" || file_type=="image/jpg")

		{

			// $(".btn-file span.fileupload-new").hide();

		 //    $(".btn-file .fileupload-exists").show();

			aid =$("#user_id").val();

			var formdata= new FormData();

			formdata.append('aid',aid);

			formdata.append('image',file);

			var ajax = new XMLHttpRequest();

			ajax.upload.addEventListener("progress", img_progressHandler, false);

			ajax.addEventListener("load", img_completeHandler, false);

			ajax.addEventListener("error", img_errorHandler, false);

			ajax.addEventListener("abort", img_abortHandler, false);

			ajax.open("POST", site_url+'admin/Ajax/profile_pic_user');

			ajax.send(formdata);



			ajax.onreadystatechange = function() {

		        if (this.readyState == 4 && this.status == 200) {

		        	var new_src=  $(".fileupload-preview img").attr('src');	

		        	$(".fileupload-new img").attr('src',new_src);	

		        	// $(".fileupload").removeClass('fileupload-exists').addClass('fileupload-new');

		       }

		    };

		}

		else

		{

		 	var error_msg = 'Please select JPEG/JPG/PNG image only.';
            $("#error").html(error_msg);
            return false;

		  // alert("Please Select JPG/PNG Only");

		}/* File Type Matched*/

		 

	}/* If file selected */       

	else

	{

		  $("#error").html("Please select image.");
        	return false;

	}

});	

	//Profile pic upload

$(".upload_profile_user2").click(function(event) {



	$('#status_image').html('');

   	var file = document.getElementById("image").files[0];
   	$("#error").html('');
    $('#success').html('');
	if(file)

	{  
		var file_type = file.type.toLowerCase(file.type);

		if(file_type=="image/jpeg" || file_type=="image/png" || file_type=="image/jpg")

		{

			// $(".btn-file span.fileupload-new").hide();

		 //    $(".btn-file .fileupload-exists").show();

			aid =$("#user_id").val();

			var formdata= new FormData();

			formdata.append('aid',aid);

			formdata.append('image',file);

			var ajax = new XMLHttpRequest();

			ajax.upload.addEventListener("progress", img_progressHandler, false);

			ajax.addEventListener("load", img_completeHandler, false);

			ajax.addEventListener("error", img_errorHandler, false);

			ajax.addEventListener("abort", img_abortHandler, false);

			ajax.open("POST", site_url+'admin/Ajax/profile_pic_user');

			ajax.send(formdata);



			ajax.onreadystatechange = function() {

		        if (this.readyState == 4 && this.status == 200) {

		        	var new_src=  $(".fileupload-preview img").attr('src');	

		        	$(".user_ss img").attr('src',new_src);	

		        	$(".fileupload").removeClass('fileupload-exists').addClass('fileupload-new');

		       }

		    };

		}

		else

		{

		 	var error_msg = 'Please select JPEG/JPG/PNG image only.';
            $("#error").html(error_msg);
            return false;

		  // alert("Please Select JPG/PNG Only");

		}/* File Type Matched*/

		 

	}/* If file selected */       

	else

	{

		  $("#error").html("Please select image.");
        	return false;

	}

});	


function productimg_progressHandler(event){
    var percent = (event.loaded / event.total) * 100;
    var id = "progressBar_image_"+product_image_id;
    document.getElementById(id).style.width = Math.round(percent)+"%";
}
function productimg_completeHandler(event){
    var id = "progressBar_image_"+product_image_id;
    document.getElementById(id).style.width = "0%";
    var response = JSON.parse(event.target.responseText);
    if(response.status=="1") {
        $("#success").html(response.msg);
    } else {
        $("#error").html(response.msg);
    }
}



	//upload  testimonial




});/*document */





function img_progressHandler(event){

  	var percent = (event.loaded / event.total) * 100;

  	document.getElementById("progressBar_image").style.width = Math.round(percent)+"%";

}

function img_completeHandler(event){

  	document.getElementById("progressBar_image").style.width = "0%";

  	(event.target.responseText=="1")

	$("#image_container").html(event.target.responseText);
	 var response = JSON.parse(event.target.responseText);
    if(response.status=="1") {
        $("#success").html(response.msg);
    } else {
        $("#error").html(response.msg);
    }

}



function detail_img_progressHandler(event){

  	var percent = (event.loaded / event.total) * 100;

  	document.getElementById("detail_progress_bar").style.width = Math.round(percent)+"%";

}

function detail_img_completeHandler(event){

  	document.getElementById("detail_progress_bar").style.width = "0%";

  	(event.target.responseText=="1")

	$("#image_container").html(event.target.responseText);

}



function fabric_img_progressHandler(event){

  	var percent = (event.loaded / event.total) * 100;

  	document.getElementById("fabric_progress_bar").style.width = Math.round(percent)+"%";

}

function fabric_img_completeHandler(event){

  	document.getElementById("fabric_progress_bar").style.width = "0%";

  	(event.target.responseText=="1")

	$("#image_container").html(event.target.responseText);

}



function img_errorHandler(event){

  bootbox.alert("Upload Failed");

}

function img_abortHandler(event){

  bootbox.alert("Upload Aborted");

}

