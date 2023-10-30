<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
 

public function __construct()
{
	parent:: __construct();
	$this->load->database();
	$this->load->model(array('admin/Common_model','admin/User_model'));
	$this->load->helper('Common_helper');
}

	//upload_image
	public function image_upload() {
		$config['upload_path'] = 'resources/images/product/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->set_allowed_types('*');
		
		$pid=$this->input->post("pid");
		if (!$this->upload->do_upload('img_upload')) 
		{
			echo $this->upload->display_errors();		
		}
		else
		{
			$upload_data=$this->upload->data();
			$product_data=array('img_name' =>$upload_data['file_name'] 
			);
			$this->db->where('product_id',$pid);
			$this->db->update('products',$product_data);
			echo "<img src='".base_url('resources/images/product')."/".$upload_data['file_name']."'  width='200px' height='200px' classs='img-responsive'/>";
		}
	}/* Product Image Upload*/


	/* profile pic upload */
	public function profile_pic_upload() {
		$newFileName = $_FILES['image']['name'];
		$fileExt = pathinfo($newFileName, PATHINFO_EXTENSION);
		// $fileExt = array_pop(explode(".", $newFileName));
		$filename = uniqid(time()).".".$fileExt; 
		//set filename in config for upload

		$config['upload_path'] = 'resources/images/profile/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['file_name'] = $filename;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		// $this->upload->set_allowed_types('*');
		
		$aid=$this->input->post("aid");
		if (!$this->upload->do_upload('image')) 
		{
			echo $this->upload->display_errors();		
		}
		else
		{
			$upload_data=$this->upload->data();
			if($upload_data['file_type']!='image/svg+xml'){
				$config['image_library'] = 'gd2';
				$config['source_image'] = $upload_data['full_path'];
				$config['new_image'] = $filename;
				$config['quality'] = 100;
				$config['maintain_ratio'] = FALSE;
				$config['width']         = 150;
				$config['height']       = 150;

				$this->load->library('image_lib', $config);

				$this->image_lib->resize();
				$this->image_lib->clear();
				//unlink($upload_data['full_path']);
			}
			$this->db->select('profile_pic');
			$this->db->where('admin_id',$aid);
			$q=$this->db->get('admin');
			$r=$q->row();
			if(!empty($r->image)){
				unlink($r->image);
			}

			$update_data=array('profile_pic' =>'resources/images/profile/'.$upload_data['file_name']);
			$this->db->where('admin_id',$aid);
			$this->db->update('admin',$update_data);
			$admin_id = $this->session->userdata('admin_id');
			if($aid == $admin_id){
			$this->session->set_userdata($update_data);}
			$res = array('status'=>'1','msg' =>"Image updated successfully.");
			echo json_encode($res); exit;	
		}
	}/* Profile Pic Upload*/

	/* profile pic upload */
	public function profile_pic_user() {
		$newFileName = $_FILES['image']['name'];
		$fileExt = pathinfo($newFileName, PATHINFO_EXTENSION);
		// $fileExt = array_pop(explode(".", $newFileName));
		$filename = uniqid(time()).".".$fileExt;
		//set filename in config for upload

		$config['upload_path'] = 'resources/images/profile/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['file_name'] = $filename;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		// $this->upload->set_allowed_types('*');
		
		$aid=$this->input->post("aid");
		if (!$this->upload->do_upload('image')) 
		{
			echo $this->upload->display_errors();		
		}
		else
		{
			$upload_data=$this->upload->data();
			if($upload_data['file_type']!='image/svg+xml'){
				$config['image_library'] = 'gd2';
				$config['source_image'] = $upload_data['full_path'];
				$config['new_image'] = $filename;
				$config['quality'] = 100;
				$config['maintain_ratio'] = FALSE;
				$config['width']         = 150;
				$config['height']       = 150;

				$this->load->library('image_lib', $config);

				$this->image_lib->resize();
				$this->image_lib->clear();
				//unlink($upload_data['full_path']);
			}
			$this->db->select('profile_pic');
			$this->db->where('user_id',$aid);
			$q=$this->db->get('users');
			$r=$q->row();
			if(!empty($r->image)){
				unlink($r->image);
			}

			$update_data=array('profile_pic' =>'resources/images/profile/'.$upload_data['file_name']);
			$this->db->where('user_id',$aid);
			$this->db->update('users',$update_data);
			$this->session->set_userdata($update_data);
			echo "1";
		}
	}

    //check username already exists or not
    public function check_username()
    {
       	if($_POST['id'] && $_POST['username']) {
       		if($this->Common_model->getRecords('admin', 'admin_id', array('admin_id!='=>$_POST['id'],'username'=>$_POST['username'],'is_deleted'=>0), '', true)) {
       			echo 1;
       		} else {
       			echo 0;
       		}
       	} 
    }

    public function check_username_user()
    {
       	if($_POST['id'] && $_POST['username']) {
       		if($this->Common_model->getRecords('users', 'user_id', array('user_id!='=>$_POST['id'],'username'=>$_POST['username']), '', true)) {
       			echo 1;
       		} else {
       			echo 0;
       		}
       	} 
    }

    //check email already exists or not
    public function check_admin_email()
    {
       	if($_POST['id'] && $_POST['email']) {
       		if($this->Common_model->getRecords('admin', 'admin_id', array('admin_id!='=>$_POST['id'],'email'=>$_POST['email'],'is_deleted'=>0), '', true)) {
       			echo 1;
       		} else {
       			echo 0;
       		}
       	} 
    }
   	
   	public function check_role_name()
    {
       	if($_POST['id'] && $_POST['role_name'] && $_POST['admin_id']) {
       		if($this->Common_model->getRecords('roles', 'role_id', array('role_id!='=>$_POST['id'],'name'=>$_POST['role_name'],'parent_id'=>$_POST['parent_id'],'created_by'=>$_POST['admin_id']), '', true)) {
       			echo 1;
       		} else {
       			echo 0;
       		}
       	} 
    }

    
    public function check_title()
    {
       	if(isset($_POST['title']) && isset($_POST['table'])) {
       		if(isset($_POST['id'])) {
       			if($_POST['table']=="facility_types" || $_POST['table']=="request_types") {
       				$field = "id";
       			} else {
       				$field = $_POST['field'];
       			}
	       		if($this->Common_model->getRecords($_POST['table'], 'id', array("$field!=" =>$_POST['id'],'title'=>$_POST['title'],'is_deleted'=>0), '', true)) {
	       			echo 1;die;
	       		} else {
	       			echo 0;die;
	       		}
	       	} else {
	       		if($this->Common_model->getRecords($_POST['table'], 'id', array('title'=>$_POST['title'],'is_deleted'=>0), '', true)) {
	       			echo 1;die;
	       		} else {
	       			echo 0;die;
	       		}
	       	}
       	}
    }
   
   	public function check_unique()
    {
       	if(isset($_POST['matched_column']) && isset($_POST['table']) && isset($_POST['matched_value']) ) {
       		if((isset($_POST['id'])) && isset($_POST['matched_id'])) {
       			
       			$field = $_POST['matched_id'];
	       		if($this->Common_model->getRecords($_POST['table'], $_POST['matched_column'], array("$field!=" =>$_POST['id'],$_POST['matched_column']=>$_POST['matched_value'],'is_deleted'=>0), '', true)) {
	       			echo 1;die;
	       		} else {
	       			echo 0;die;
	       		}
	       	} else {
	       		if($this->Common_model->getRecords($_POST['table'], $_POST['matched_column'], array($_POST['matched_column']=>$_POST['matched_value'],'is_deleted'=>0), '', true)) {
	       			echo 1;die;
	       		} else {
	       			echo 0;die;
	       		}
	       	}
       	}
    }

    //check email already exists or not
    public function check_user_email()
    {   
    	if($_POST['id'] && $_POST['email']) {
            echo  user_email($_POST['id'],$_POST['email']);
       }	 
    }
    public function change_status(){
		if($this->input->post()) 
		{
			$field = $this->input->post('field'); 
			$id = $this->input->post('id'); 
			$table_name = $this->input->post('table_name');
			 $where = array($field=> $id);
			$date = date("Y-m-d H:i:s");
			// for alleast one ad check 
			$col='status';
			//$status = $this->Common_model->getFieldValue($table_name,$col,$where);
		
			if($status = $this->Common_model->getFieldValue($table_name,$col,$where)) {
				$new_status = "Active";
				if($status=="Active") {
					$new_status = "Inactive";
				}
			
				if($this->Common_model->addEditRecords($table_name,array($col=>$new_status,'modified'=>$date,'modified_by'=>$this->session->userdata('admin_id')),$where))
				{
					$data = array('msg'=>'success','status' =>$new_status);
				
				} else {
					$data = array('msg'=>'fail','admin_approve' =>$admin_approve);
				}
				echo json_encode($data);
			}
		}
	}

    public function change_status_post(){
		if($this->input->post()) 
		{
			$field = $this->input->post('field'); 
			$id = $this->input->post('id'); 
			$table_name = $this->input->post('table_name');
			$where = array($field=> $id);
			$date = date("Y-m-d H:i:s");
			if($status = $this->Common_model->getFieldValue($table_name,'status',$where)) {
				$new_status = "Active";
				if($status=="Active") {
					$new_status = "Deactive";
				} 

				if($this->Common_model->addEditRecords($table_name,array('status'=>$new_status,'modified'=>$date),$where))
				{
					$data = array('msg'=>'success','status' =>$new_status);
				
				} else {
					$data = array('msg'=>'fail','admin_approve' =>$admin_approve);
				}
				echo json_encode($data);
			}
		}
	}


	public function delete_record()
	{ 
		if($this->input->post()) 
		{
	        $field = $this->input->post('field'); 
		    $id = $this->input->post('id'); 
			$table = $this->input->post('table_name');
			$where = array($field=> $id);
		    $delete_gallery=$this->Common_model->deleteRecords($table, $where);

	    }
	}

	public function delete_records()
	{
		if($_POST) {
			$id=$this->input->post('id');
			$table=$this->input->post('table');
			$field=$this->input->post('field');
			$where=array($field=>$id);
				if($table=='banners') 
				{
					$count = $this->Common_model->getNumRecords($table,'banner_id',array('status'=>'Active'));
					if($count<=1)
					{
						$this->session->set_flashdata('error', 'Unable to Delete Last Record.');
						$data = array('msg'=>'Unable to Delete Last Record.','status'=>false);
						echo json_encode($data);  exit;
					}
					
				}

				$data=array();
				$record = $this->Common_model->getRecords($table, '*', array($field =>$id), '', true);
				if($this->Common_model->deleteRecords($table,$where))
				{	
				//To Remove Image from folder after deleting the respective record
					if(isset($record['image']) && !empty($record['image'])) {
						if(file_exists($record['image'])) {
							unlink($record['image']);
						}
				}
				//To Delete Comments associated with Blogs and Style Guide 
				
				$this->session->set_flashdata('success', 'Record Deleted Successfully.');
				$data = array('msg'=>'Record Deleted Successfully.','status'=>true);
		} 
		echo json_encode($data);  exit;
		} 

	}

    public function soft_delete_user_record()
	{
		if($_POST) {
			
			$id=$this->input->post('id');
			$table=$this->input->post('table');
			$field=$this->input->post('field');
			$where=array($field=>$id);

			$data=array();
			$record = $this->Common_model->getRecords($table, '*', array($field =>$id), '', true);

			/*if($table=='items'){
				$lastrec=$this->Common_model->getRecords('items', 'id', array('type_id'=>$record['type_id'],'is_deleted'=>0), 'id desc', true);
				if($lastrec['id']!=$record['id']){
					$data = array('msg'=>'Only last item can be delete for this type of item','status'=>false);
					echo json_encode($data);  exit;
				}
			}*/
			// echo '<pre>';print_r($record);exit;
			$update_data=array('is_deleted'=>1);
			$this->db->where($where,$field);
			
			if($this->db->update($table,$update_data)) {
				//To Remove Image from folder after deleting the respective record
				if(isset($record['image']) && !empty($record['image'])) {
					if(file_exists($record['image'])) {
						unlink($record['image']);
					}
				}
	
				$this->session->set_flashdata('success', 'Record Deleted Successfully.');
				$data = array('msg'=>'Record Deleted Successfully.','status'=>true);
			} 
			echo json_encode($data);  exit;
		} 
	} 
	
	public function sort_delete_record()
	{
		if($_POST) {
			
			$id=$this->input->post('id');
			$table=$this->input->post('table');
			$field=$this->input->post('field');
			$where=array($field=>$id);
			
			
			$update_data=array('is_deleted'=>1,'deleted_by'=>$this->session->userdata('admin_id'));
			$this->db->where($where,$field);
			
			if($this->db->update($table,$update_data)) {
				if($record = $this->Common_model->getRecords($table, 'sort_order,id', 
					array("$field >"  =>$id), '', false))
				{
					
					foreach($record as $list)
					{
						$update_data=array(
							'sort_order' => $list['sort_order']-1,
							'modified' => date("Y-m-d H:i:s"),
							'modified_by' => $this->session->userdata('admin_id')
							);
						$this->db->where($field,$list['id']);
						$this->db->update($table,$update_data);
					
					}
				}
				
				$this->session->set_flashdata('success', 'Record Deleted Successfully.');
				$data = array('msg'=>'Record Deleted Successfully.','status'=>true);
			} 
			echo json_encode($data);  exit;
		} 
	} 

	public function common_update_image() {
		$newFileName = $_FILES['image']['name'];
		$fileExt = pathinfo($newFileName, PATHINFO_EXTENSION);
		// $fileExt = array_pop(explode(".", $newFileName));
		$filename = uniqid(time()).".".$fileExt;
		//post data
		$record_id=$this->input->post("record_id");
		$table=$this->input->post("table");
		$where=$this->input->post("where");
		$select=$this->input->post("select");
		$upload_path=$this->input->post("upload_path");
		$height=$this->input->post("height");
		$width=$this->input->post("width");
		//die($record_id);
		//set filename in config for upload
		//$height=300;
		//$width=300;
		if($this->input->post("height")){
			$height=$this->input->post("height");
			//echo $height;exit;
		}
		if($this->input->post("width")){
			$width=$this->input->post("width");
		}
		// echo $width;
		//	echo $height;
		// echo "<pre>"; print_r($_POST); exit;
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = '*';
		// $config['file_name'] = 'orignal_'.$filename;
		$config['file_name'] = $filename;


		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		// $this->upload->set_allowed_types('*');
		
		
		if (!$this->upload->do_upload('image')) 
		{
			$msg = $this->upload->display_errors();	
			$res = array('status'=>'0','msg' =>$msg);
			echo json_encode($res); exit;	
		}
		else
		{
			$upload_data=$this->upload->data();
			if($upload_data['file_type']!='image/svg+xml'){
				$config['image_library'] = 'gd2';
				$config['source_image'] = $upload_data['full_path'];
				$config['new_image'] = $filename;
				$config['quality'] = 100;
				$config['maintain_ratio'] = true;
				$config['width']         = $width;
				$config['height']       = $height;
				// echo "<pre>"; print_r($config); exit;
				$this->load->library('image_lib',$config);
				// $this->upload->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				//unlink($upload_data['full_path']);
			}

			$this->db->select($select);
			$this->db->where($where,$record_id);
			$q=$this->db->get($table);
			$r=$q->row();
			if(!empty($r->$select)){
				if(file_exists($r->$select))
					unlink($r->$select);
			}

			$update_data=array($select =>$upload_path.$filename);
			$this->db->where($where,$record_id);
			$this->db->update($table,$update_data);
			//echo $this->db->last_query();exit;
			//$this->session->set_userdata($update_data);
			
			$res = array('status'=>'1','msg' =>"Image updated successfully.");
			echo json_encode($res); exit;	
		}
	}/* Profile Pic Upload*/

	public function get_cities()
    {
    	$cities = array();
       	if($_POST['id']) {
       		$cities = $this->Common_model->getRecords('cities', 'id,title', array('state_id'=>$_POST['id'],'is_deleted'=>0), 'title asc', false);
       	} 
       	//echo $sub_outlets;
        echo json_encode($cities);  exit;
    }

    public function get_states()
    {
    	$states = array();
       	
       	$states = $this->Common_model->getRecords('states', 'id,state_name', array('is_deleted'=>0), 'state_name asc', false);
       	 
       	//echo $sub_outlets;
        echo json_encode($states);  exit;
    }
}
?>