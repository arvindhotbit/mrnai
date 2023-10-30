<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->load->model(array('admin/Common_model','admin/Booking_model'));
		$this->load->helper('common_helper');
		$this->load->library('Ajax_pagination');
	}

	public function index()
	{
		$this->Common_model->check_login();
	}

	public function mlist()
	{
		$this->Common_model->check_login();
		
		$data['title']="Booking List | ".SITE_TITLE;
		$data['page_title']="Booking List";
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
			'title' => 'Booking List',
			'link' => ""
		);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$like=array();
		$data['filter_booking_no']='';
		if($this->input->get('booking_no')){
			$data['filter_booking_no']=$this->input->get('booking_no');
		}
		$data['filter_business']='';
		if($this->input->get('business')){
			$data['filter_business']=$this->input->get('business');
		}
		$data['filter_mobile_no']='';
		if($this->input->get('mobile_no')){
			$data['filter_mobile_no']=$this->input->get('mobile_no');
		}
		$data['filter_state']='';
		if($this->input->get('state')){
			$data['filter_state']=$this->input->get('state');
		}
		$data['filter_city']='';
		if($this->input->get('city')){
			$data['filter_city']=$this->input->get('city');
		}
		$data['filter_daterange']='';
		if($this->input->get('daterange')){
			$data['filter_daterange']=$this->input->get('daterange');
		}
		$data['filter_status']='';
		if($this->input->get('status')){
			$data['filter_status']=$this->input->get('status');
		}
		$data['filter_category']='';
		if($this->input->get('category')){
			$data['filter_category']=$this->input->get('category');
		}
		
		$data['total_records']=$this->Booking_model->get_list(0,0);
	 	$data['records_results']=$this->Booking_model->get_list(ADMIN_LIMIT,$page);
		$data['undeletable_ids']=array(); 
    	check_permission('83','view','yes');
    	$data['detail_action']='admin/booking/detail/';
  		// if(check_permission('83','add')){ $data['add_action']='admin/booking/add';}
  		// if(check_permission('83','edit')){ $data['edit_action']='admin/booking/edit';}
  		if(check_permission('83','delete')){ $data['delete_action']='1';}
		$data['pagination']=$this->Common_model->paginate(site_url('admin/booking/list'),$data['total_records']);
		
		$data['categories']=$this->Common_model->getRecords('business_category', 'id,name', array('is_deleted'=>0,'status'=>'Active'), 'name asc', false);
		// echo "<pre>";print_r($data['records_results']);die;
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/booking/list');
		$this->load->view('admin/include/footer');
	} 
	

}
