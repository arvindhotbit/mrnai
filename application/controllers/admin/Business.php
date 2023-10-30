<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Business extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->load->model(array('admin/Common_model','admin/Business_model'));
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
		
		$data['title']="Business List | ".SITE_TITLE;
		$data['page_title']="Business List";
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
			'title' => 'Business List',
			'link' => ""
		);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$like=array();
		
		$data['filter_name']='';
		if($this->input->get('name')){
			$data['filter_name']=$this->input->get('name');
		}
		$data['filter_business_name']='';
		if($this->input->get('business_name')){
			$data['filter_business_name']=$this->input->get('business_name');
		}
		$data['filter_phone_no']='';
		if($this->input->get('phone_no')){
			$data['filter_phone_no']=$this->input->get('phone_no');
		}
		$data['filter_status']='';
		if($this->input->get('status')){
			$data['filter_status']=$this->input->get('status');
		}
		
		$data['total_records']=$this->Business_model->get_list(0,0);
	 	$data['records_results']=$this->Business_model->get_list(ADMIN_LIMIT,$page);
		$data['undeletable_ids']=array(); 
    	check_permission('87','view','yes');
  		$data['view_action']='admin/business/detail';
  		// if(check_permission('87','add')){ $data['add_action']='admin/business/add';}
  		if(check_permission('87','edit')){ $data['edit_action']='admin/business/edit';}
  		if(check_permission('87','delete')){ $data['delete_action']='1';}
		$data['pagination']=$this->Common_model->paginate(site_url('admin/business/list'),$data['total_records']);
		
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/business/list');
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
