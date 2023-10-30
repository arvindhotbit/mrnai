<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->load->model(array('admin/Common_model','admin/User_model'));
		$this->load->helper('common_helper');
		$this->load->library('Ajax_pagination');
		$this->load->library('PHPExcel');

		ini_set('max_execution_time', 0);
		ini_set('max_input_time', 0);
		ini_set("memory_limit","20000M");
	}

	public function index()
	{
		$this->Common_model->check_login();
	}

	public function user_list()
	{
		$this->Common_model->check_login();
		
		$data['title']="User List | ".SITE_TITLE;
		$data['page_title']="User List";
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'icon'=>'<i class="fa fa-dashboard"></i>',
			'class'=>'',
			'title' => 'Dashboard',
			'link' => site_url('admin/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'icon'=>'',
			'class'=>'active',
			'title' => 'User List',
			'link' => ""
		);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$like=array();
		
		$data['filter_name']='';
		if($this->input->get('name')){
			$data['filter_name']=$this->input->get('name');
		}
		$data['filter_phone_no']='';
		if($this->input->get('phone_no')){
			$data['filter_phone_no']=$this->input->get('phone_no');
		}
		$data['filter_status']='';
		if($this->input->get('status')){
			$data['filter_status']=$this->input->get('status');
		}
		
		$data['total_records']=$this->User_model->get_user_list(0,0);
	 	$data['records_results']=$this->User_model->get_user_list(ADMIN_LIMIT,$page);
		$data['undeletable_ids']=array(); 
    	check_permission('13','view','yes');
  		// if(check_permission('13','add')){ $data['add_action']='admin/user/add';}
  		if(check_permission('13','edit')){ $data['edit_action']='admin/user/edit';}
  		if(check_permission('13','delete')){ $data['delete_action']='1';}
		$data['pagination']=$this->Common_model->paginate(site_url('admin/user/list'),$data['total_records']);
		
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/user/list');
		$this->load->view('admin/include/footer');
	} 

	public function edit_user($id) 
	{
		$this->Common_model->check_login();
		check_permission('13','edit','yes');
		if(!$id) {
			
			redirect('pages/page_not_found');
		}
		$data['title']="Edit User | ".SITE_TITLE;
		$data['page_title']="Edit User";
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'icon'=>'<i class="fa fa-dashboard"></i>',
			'class'=>'',
			'title' => 'Dashboard',
			'link' => site_url('admin/dashboard')
		);
		$data['breadcrumbs'][] = array(
			'icon'=>'',
			'class'=>'',
			'title' => 'User List',
			'link' => site_url('admin/user/list')
		);
		$data['breadcrumbs'][] = array(
			'icon'=>'',
			'class'=>'active',
			'title' => 'Edit User',
			'link' => ""
		);	
		if(!$data['users'] = $this->Common_model->getRecords('users','*',array('id'=>$id),'',true))
		{
			redirect('pages/page_not_found');
		}
		if($this->input->post()) {
			
			$this->form_validation->set_rules('email', 'email', 'trim|required',array('required'=>'Please enter %s'));
			
			$this->form_validation->set_error_delimiters('<p class="inputerror">', '</p>');

			if($this->form_validation->run()==TRUE) 
			{	
	       		if($this->Common_model->getRecords('users', 'email', array('id!='=>$id,'email'=>$this->input->post('email'),'is_deleted'=>0), '', true)) {
	       			echo json_encode(array('status'=>0,'message'=>'<div class="alert alert-danger">Email already exist.</div>')); 
            		exit; 
	       		}
            	$user_data = array(
					'fullname'=>$this->input->post('fullname'),
					'email'=>$this->input->post('email'),
					'phone_no'=>$this->input->post('phone_no'),
					'address'=>$this->input->post('address'),
					'modified'=> date("Y-m-d H:i:s"),
					'modified_by'=> $this->session->userdata('admin_id')
				); 
				if($user_id=$this->Common_model->addEditRecords('users',$user_data,array('id'=>$id))) {
					
					echo json_encode(array('status'=>1,'message'=>'<div class="alert alert-success">User Updated Successfully.</div>')); 
					exit;
                }
			}else{
				echo json_encode(array('status'=>0,'message'=>'<div class="alert alert-danger">Please enter all required values.</div>')); 
            	exit; 
			}
		}
		$data['form_action']=site_url('admin/user/edit/'.$id);
		$data['back_action']=site_url('admin/user/list');

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/user/edit');
		$this->load->view('admin/include/footer');
	}
	public function add_user() 
	{
		$this->Common_model->check_login();
		check_permission('13','add','yes');
		$data['title']="Add User | ".SITE_TITLE;
		$data['page_title']="Add User";
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'icon'=>'<i class="fa fa-dashboard"></i>',
			'class'=>'',
			'title' => 'Dashboard',
			'link' => site_url('admin/dashboard')
		);
		$data['breadcrumbs'][] = array(
			'icon'=>'',
			'class'=>'',
			'title' => 'User List',
			'link' => site_url('admin/user/list')
		);
		$data['breadcrumbs'][] = array(
			'icon'=>'',
			'class'=>'active',
			'title' => 'Add User',
			'link' => ""
		);	
		if($this->input->post()) {
			$this->form_validation->set_rules('email', 'email', 'trim|required',array('required'=>'Please enter %s'));
			$this->form_validation->set_error_delimiters('<p class="inputerror">', '</p>');

			if($this->form_validation->run()==TRUE) 
			{
        		if($this->Common_model->getRecords('users', 'email', array('email'=>$this->input->post('email'),'is_deleted'=>0), '', true)) {
	       			echo json_encode(array('status'=>0,'message'=>'<div class="alert alert-danger">Email already exist.</div>')); 
            		exit; 
	       		}
	       		$user_status = "Active"; 
            	$user_data = array(
					'fullname'=>$this->input->post('fullname'),
					'email'=>$this->input->post('email'),
					'phone_no'=>$this->input->post('phone_no'),
					'address'=>$this->input->post('address'),
					'created'=> date("Y-m-d H:i:s"),
					'created_by'=> $this->session->userdata('admin_id')
				); 

				if($user_id=$this->Common_model->addEditRecords('users',$user_data)) {

					echo json_encode(array('status'=>1,'message'=>'<div class="alert alert-success">User Added Successfully.</div>','user_id'=>$user_id)); 
					exit;
				}
			}else{
				echo json_encode(array('status'=>0,'message'=>'<div class="alert alert-error">Please enter all required values.</div>')); 
				exit;
			}
		}

		$data['form_action']=site_url('admin/user/add');
		$data['back_action']=site_url('admin/user/list');
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/user/add');
		$this->load->view('admin/include/footer');
	}

	function rolekey_exists($key,$field) {
		$param=explode('-', $field);
		$table=$param[0];
		$col_name=$param[1];
		$type=$param[2];
		if($type=='add')
		{
       		if($this->Common_model->getRecords($table, $col_name, array($col_name=>$key,'is_deleted'=>0), '', true)) {
       			 $this->form_validation->set_message(__FUNCTION__, 'This %s is already exist.');
       			return false;
       		}
       		else
       		{

       			return true;
       		}

		}
		else
		{
			$id_col=$param[3];
			$id_col_val=$param[4];
			if($this->Common_model->getRecords($table, $col_name, array("$id_col!=" =>$id_col_val,$col_name=>$key,'is_deleted'=>0), '', true)) {
				$this->form_validation->set_message(__FUNCTION__, 'This %s is already exist.');
				return false;
			}
			else
       		{
       			return true;
       		}

		}
		
	}
}
