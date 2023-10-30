<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	
        $this->load->model(array('admin/Common_model','admin/Booking_model'));
		$this->load->helper('Common_helper'); 
	}
	public function index()
	{
		$this->Common_model->check_login();
		$type = $this->session->userdata('user_type');
		if($type=='Super Admin'){
			$type='Admin';
		}
		$role_id = $this->session->userdata('role_id');
		$data['title']="Dashboard| ".SITE_TITLE;
		$data['page_title']="Dashboard";
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'icon'=>'<i class="fa fa-dashboard"></i>',
			'class'=>'',
			'title' => 'Home',
			'link' => '#'
		);
		$data['breadcrumbs'][] = array(
			'icon'=>'',
			'class'=>'active',
			'title' => 'Dashboard',
			'link' => site_url('admin/dashboard')
		);

        $data['total_users'] = $this->Common_model->getNumRecords('users','id',array('is_deleted'=>0)); 
        $data['today_users'] = $this->Common_model->getNumRecords('users','id',array('is_deleted'=>0,'date(created)'=>date('Y-m-d'))); 
        $data['total_month_users'] = $this->Common_model->getNumRecords('users','id',array('is_deleted'=>0,'month(created)'=>date('m'),'year(created)'=>date('Y')));

        $data['total_business'] = $this->Common_model->getNumRecords('business','id',array('is_deleted'=>0)); 
        $data['today_business'] = $this->Common_model->getNumRecords('business','id',array('is_deleted'=>0,'date(created)'=>date('Y-m-d'))); 
        $data['total_month_business'] = $this->Common_model->getNumRecords('business','id',array('is_deleted'=>0,'month(created)'=>date('m'),'year(created)'=>date('Y')));


        $data['total_booking'] = $this->Common_model->getNumRecords('booking','id',array('id !='=>0));
        $data['today_booking'] = $this->Common_model->getNumRecords('booking','id',array('date(created)'=>date('Y-m-d')));
        $data['total_month_booking'] = $this->Common_model->getNumRecords('booking','id',array('month(created)'=>date('m'),'year(created)'=>date('Y')));
        
        $data['complete_booking'] = $this->Common_model->getNumRecords('booking','id',array('status'=>'Completed'));
        $data['complete_month_booking'] = $this->Common_model->getNumRecords('booking','id',array('status'=>'Completed','month(created)'=>date('m'),'year(created)'=>date('Y')));

        $data['item_stats'] =array();
        
		$this->load->view('admin/include/header',$data);
	
		$this->load->view('admin/include/sidebar');
		if($this->session->userdata('user_type')!='Super Admin'){
            if($this->Common_model->getRecords('role_permissions','view',array('role_id'=>$role_id,'section_id'=>1,'view'=>1),'',true)){
				$this->load->view('admin/dashboard');
			}else{
				$this->load->view('admin/prohibit_dashboard');
			}
		}else{
			$this->load->view('admin/dashboard');
		}
		
		$this->load->view('admin/include/footer');

	}

	public function prohibit_dashboard(){
		$this->Common_model->check_login();
		$data['title']="Dashboard| ".SITE_TITLE;
		$data['page_title']="Dashboard";
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'icon'=>'<i class="fa fa-dashboard"></i>',
			'class'=>'',
			'title' => 'Home',
			'link' => '#'
		);
		$data['breadcrumbs'][] = array(
			'icon'=>'',
			'class'=>'active',
			'title' => 'Dashboard',
			'link' => site_url('admin/dashboard')
		);
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/prohibit_dashboard');
		$this->load->view('admin/include/footer');

	}

}

