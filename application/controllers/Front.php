<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Front extends CI_Controller
{
    function __construct() 
    {
        parent::__construct();
        // phpinfo();die;
        $this->load->model(array('admin/Common_model','Front_model'));
        $this->load->helper('common_helper'); 
        // $this->load->helper('string');
        // $this->load->library(array('encrypt','PHPExcel'));
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }

    public function getState() 
    {
        $country_id=$this->input->post('country_id');
        if(empty($country_id)){
           display_output('0',$this->lang->line('err_country_select'));  
        }
        $list=$this->Common_model->getRecords('states', 'id,name', array('is_deleted'=>0,'country_id'=>$country_id), 'name asc', false);
        if($list){
            display_output('1','States',array('list'=>$list));
        }else{
            display_output('0',$this->lang->line('err_no_data'));  
        }
    }
    public function getCity() 
    {
        $state_id=$this->input->post('state_id');
        if(empty($state_id)){
           display_output('0',$this->lang->line('err_state_select'));
        }
        $list=$this->Common_model->getRecords('cities', 'id,name', array('is_deleted'=>0,'state_id'=>$state_id), 'name asc', false);
        if($list){
            display_output('1','City',array('list'=>$list));
        }else{
            display_output('0',$this->lang->line('err_no_data'));  
        }
    }
    public function how_it_work(){
        $data['title']=$this->lang->line('lab_howit_work_title');
        $siteLang = $this->session->userdata('site_lang'); 
        $sel_lang = ($siteLang != "") ? $siteLang : "hindi";
        $this->load->view('front/header',$data);
        $this->load->view('front/how_it_work_'.$sel_lang);
        $this->load->view('front/footer');
    }
    public function privacy_policy(){
        $data['title']=$this->lang->line('lab_privacy_security_title');
        $siteLang = $this->session->userdata('site_lang'); 
        $sel_lang = ($siteLang != "") ? $siteLang : "hindi";
        $this->load->view('front/header',$data);
        $this->load->view('front/privacy_policy_'.$sel_lang);
        $this->load->view('front/footer');
    }
    public function about_us(){
        $data['title']=$this->lang->line('lab_about_title');
        $siteLang = $this->session->userdata('site_lang'); 
        $sel_lang = ($siteLang != "") ? $siteLang : "hindi";
        $this->load->view('front/header',$data);
        $this->load->view('front/about_us_'.$sel_lang);
        $this->load->view('front/footer');
    }
    public function share_app(){
        $data['title']=$this->lang->line('lab_shareapp_title');
        $siteLang = $this->session->userdata('site_lang'); 
        $sel_lang = ($siteLang != "") ? $siteLang : "hindi";
        $this->load->view('front/header',$data);
        $this->load->view('front/share_app_'.$sel_lang);
        $this->load->view('front/footer');
    }

    public function index(){
        $data['title']="title";
        $data['is_business']="no";
        $data['is_login']="no";
        $check=$this->Common_model->check_business_login();
        if($check){
            $data['is_business']="yes";
            $data['is_login']="yes";
        }
        $data['categories']=$this->Common_model->getRecords('business_category', 'id,name', array('is_deleted'=>0,'status'=>'Active'), 'name asc', false);
        $this->load->view('front/header',$data);
        $this->load->view('front/index');
        $this->load->view('front/footer');
    }
    public function more(){
        $data['title']="title";
        $data['is_business']="no";
        $data['is_login']="no";
        $check=$this->Common_model->check_business_login();
        if($check){
            $data['is_business']="yes";
            $data['is_login']="yes";
        }
        $this->load->view('front/header',$data);
        $this->load->view('front/more');
        $this->load->view('front/footer');
    }
    public function signup(){
        $data['title']="title";
        $check=$this->Common_model->check_business_login();
        if($check){
            $business_id=$this->session->userdata('business_id');
            if(!$this->Common_model->getRecords('business_security_question', 'id', array('business_id'=>$business_id), 'id asc', false)){
                redirect(site_url('security_question'));
            }
            if(empty($check['business_name'])){
                redirect(site_url('edit_profile'));
            }
        }
        $this->load->view('front/header',$data);
        $this->load->view('front/signup');
        $this->load->view('front/footer');
    }
    public function login(){
        $data['title']="title";
        $check=$this->Common_model->check_business_login();
        if($check){
            if(empty($check['business_name'])){
                redirect(site_url('edit_profile'));
            }
        }
        $this->load->view('front/header',$data);
        $this->load->view('front/login');
        $this->load->view('front/footer');
    }
    public function security_question(){
        $data['title']="title";

        $check=$this->Common_model->check_business_login();
        if($check){
            $business_id=$this->session->userdata('business_id');
            if($this->Common_model->getRecords('business_security_question', 'id', array('business_id'=>$business_id), 'id asc', false)){
                redirect(site_url());
            }
        }

        $data['security_question']=$this->Common_model->getRecords('security_question', 'id,question', array('is_deleted'=>0,'status'=>'Active'), 'question asc', false);
        $this->load->view('front/header',$data);
        $this->load->view('front/security_question');
        $this->load->view('front/footer');
    }
    public function forgot_pass_step1(){
        $data['title']="title";
        $check=$this->Common_model->check_business_login();
        if($check){
            redirect(site_url());
        }
        $this->load->view('front/header',$data);
        $this->load->view('front/forgot_pass_step1');
        $this->load->view('front/footer');
    }
    public function forgot_pass_step2(){
        $data['title']="title";
        $phone_no=$this->session->userdata('business_no');
        if(!$phone_no){
            redirect(site_url('forgot_password'));
        }
        $where['phone_no'] = $phone_no;
        $where['is_deleted'] = '0';
        if($user_data = $this->Common_model->getRecords('business','id,status,business_name',$where,'id DESC',true)) {
        }else{
            redirect(site_url('forgot_password'));
        }
        $data['security_question']=$this->Front_model->getBusinessQuestions($user_data['id']);

        $this->load->view('front/header',$data);
        $this->load->view('front/forgot_pass_step2');
        $this->load->view('front/footer');
    }
    public function forgot_pass_step3(){
        $data['title']="title";
        $phone_no=$this->session->userdata('business_no');
        $answer_verified=$this->session->userdata('answer_verified');
        if(!$phone_no){
            redirect(site_url('forgot_password'));
        }
        if(!$answer_verified){
            redirect(site_url('forgot_password'));
        }
        $where['phone_no'] = $phone_no;
        $where['is_deleted'] = '0';
        if($user_data = $this->Common_model->getRecords('business','id,status,business_name',$where,'id DESC',true)) {
        }else{
            redirect(site_url('forgot_password'));
        }

        $this->load->view('front/header',$data);
        $this->load->view('front/forgot_pass_step3');
        $this->load->view('front/footer');
    }
    public function edit_profile(){
        $data['title']="title";
        $check=$this->Common_model->check_business_login();
        if($check){
            $business_id=$this->session->userdata('business_id');
            if(!$this->Common_model->getRecords('business_security_question', 'id', array('business_id'=>$business_id), 'id asc', false)){
                redirect(site_url('security_question'));
            }
        }else{
            redirect(site_url('login'));
        }
        $business_id=$this->session->userdata('business_id');
        $where['id']=$business_id;
        $sel="fullname,phone_no,business_name,country_id,state_id,city_id,category_id,lat,long,address,logo,is_live,slug";
        if($detail = $this->Common_model->getRecords('business',$sel,$where,'id DESC',true)) {
          
            if(!empty($detail['logo'])){
                $detail['logo']=site_url($detail['logo']);
            }
            // $detail['country']=$this->Common_model->getFieldValue('country','name',array('id'=>$detail['country_id']));
            // $detail['state']=$this->Common_model->getFieldValue('states','name',array('id'=>$detail['state_id']));
            // $detail['city']=$this->Common_model->getFieldValue('cities','name',array('id'=>$detail['city_id']));

            $detail['has_services']="yes";
            if(!$this->Common_model->getRecords('business_services','id',array('business_id'=>$business_id,'is_deleted'=>0),'id DESC',true)) {
                $detail['has_services']="no";
            }
        }
        $data['detail']=$detail;
        $data['country']=$this->Common_model->getRecords('country', 'id,name', array('is_deleted'=>0), 'name asc', false);
        $data['states']=$this->Common_model->getRecords('states', 'id,name', array('is_deleted'=>0,'country_id'=>$detail['country_id']), 'name asc', false);
        $data['cities']=$this->Common_model->getRecords('cities', 'id,name', array('is_deleted'=>0,'state_id'=>$detail['state_id']), 'name asc', false);

        $data['categories']=$this->Common_model->getRecords('business_category', 'id,name', array('is_deleted'=>0,'status'=>'Active'), 'name asc', false);
        $this->load->view('front/header',$data);
        $this->load->view('front/edit_profile');
        $this->load->view('front/footer');
    }
    public function create_service(){
        $data['title']="title";
        $check=$this->Common_model->check_business_login();
        if($check){
            $business_id=$this->session->userdata('business_id');
            if(!$this->Common_model->getRecords('business_security_question', 'id', array('business_id'=>$business_id), 'id asc', false)){
                redirect(site_url('security_question'));
            }
        }else{
            redirect(site_url('login'));
        }
        $business_id=$this->session->userdata('business_id');
        
        $data['business_window']=$this->Common_model->getRecords('business_window', 'id,window_name', array('is_deleted'=>0,'business_id'=>$business_id), 'id asc', false);
        $data['selected']='';
        if(isset($_GET['wid'])){
            $data['selected']=base64_decode($_GET['wid']);
        }
        $this->load->view('front/header',$data);
        $this->load->view('front/create_service');
        $this->load->view('front/footer');
    }

    public function edit_service(){
        $data['title']="title";
        $check=$this->Common_model->check_business_login();
        if($check){
            $business_id=$this->session->userdata('business_id');
        }else{
            redirect(site_url('login'));
        }
        if(isset($_GET['id'])){
            $service_id=base64_decode($_GET['id']);
        }else{
            redirect(site_url('business_services'));
        }
        $business_id=$this->session->userdata('business_id');
        $where['id']   = $service_id;
        $where['business_id']   = $business_id;
        $where['is_deleted']= '0';
        $data['detail'] = $this->Common_model->getRecords('business_services','*',$where,'id asc',true);
        if(!$data['detail']){
            redirect(site_url('business_services'));
        }
        $data['business_window']=$this->Common_model->getRecords('business_window', 'id,window_name', array('is_deleted'=>0,'business_id'=>$business_id), 'id asc', false);

        $this->load->view('front/header',$data);
        $this->load->view('front/edit_service');
        $this->load->view('front/footer');
    }

    public function business_services(){
        $data['title']="title";
        $check=$this->Common_model->check_business_login();
        if($check){
            $business_id=$this->session->userdata('business_id');
            if(!$this->Common_model->getRecords('business_security_question', 'id', array('business_id'=>$business_id), 'id asc', false)){
                redirect(site_url('security_question'));
            }
        }else{
            redirect(site_url('login'));
        }
        $business_id=$this->session->userdata('business_id');
        $where['business_id']   = $business_id;
        $where['is_deleted']= '0';
        $list = $this->Common_model->getRecords('business_services','*',$where,'id asc',false);
        if(!$list){
            redirect(site_url('create_service'));
        }

        $business_window=$this->Common_model->getRecords('business_window', 'id,window_name', array('is_deleted'=>0,'business_id'=>$business_id), 'id asc', false);

        foreach ($business_window as $key => $value) {
            $where=array('is_deleted'=>0,'business_id'=>$business_id,'window_id'=>$value['id']);
            $business_window[$key]['services']=$this->Common_model->getRecords('business_services','*',$where,'id asc',false);
        }

        $data['list']=$business_window;
        $this->load->view('front/header',$data);
        $this->load->view('front/business_services');
        $this->load->view('front/footer');
    }
    public function business_window(){
        $data['title']="title";
        $check=$this->Common_model->check_business_login();
        if($check){
            $business_id=$this->session->userdata('business_id');
            if(!$this->Common_model->getRecords('business_security_question', 'id', array('business_id'=>$business_id), 'id asc', false)){
                redirect(site_url('security_question'));
            }
        }else{
            redirect(site_url('login'));
        }
        $business_id=$this->session->userdata('business_id');
        if(empty($check['business_name'])){
            redirect(site_url('edit_profile'));
        }
        $where['business_id']   = $business_id;
        $where['is_deleted']= '0';
        $list = $this->Common_model->getRecords('business_services','*',$where,'id asc',true);
        if(!$list){
            redirect(site_url('create_service'));
        }

        $data['business_name']=$check['business_name'];
        $bdetail = $this->Common_model->getRecords('business','is_live,phone_no,slug',array('id'=>$business_id),'id asc',true);

        $data['share_link']=site_url('detail/'.$bdetail['slug']);
        $data['phone_no']=$bdetail['phone_no'];
        $is_live = $bdetail['is_live'];
        $data['business_live']="yes";
        if($is_live==0){
            $data['business_live']="no";
        }
        
        $data['month_booking'] = $this->Front_model->getTotalBooking($business_id,'month');
        $data['total_booking'] = $this->Front_model->getTotalBooking($business_id,'total');
        $data['windows'] = $this->Front_model->getBusinessServices($business_id);

        $windows=array();
        if(!empty($data['windows'])){
            for ($i=0; $i < count($data['windows']); $i++) { 
                $obj=array('window_id'=>$data['windows'][$i]['window_id'],
                    'window_name'=>$data['windows'][$i]['window_name'],
                    'services'=>$data['windows'][$i]['services']);

                $obj['bookings']=$this->Front_model->get_window_booking_list($obj['window_id']);

                $obj['current']=array();
                if(!empty($obj['bookings'])){
                    $current = array_filter($obj['bookings'], function ($var) {
                        return ($var['status'] == 'In-Progress');
                    });
                    if(!empty($current)){
                        foreach ($current as $j => $vll) {
                            if(isset($current[$j])){
                                $obj['current']=$current[$j];
                                break;
                            }
                        }
                    }
                }
                array_push($windows, $obj);
            }
        }
        // echo "<pre>";print_r($windows);die;
        $data['windows']=$windows;

        $this->load->view('front/header',$data);
        $this->load->view('front/business_window');
        $this->load->view('front/footer');
    }
    public function business_printqr(){
        $data['title']="title";
        $check=$this->Common_model->check_business_login();
        if($check){
            $business_id=$this->session->userdata('business_id');
            if(!$this->Common_model->getRecords('business_security_question', 'id', array('business_id'=>$business_id), 'id asc', false)){
                redirect(site_url('security_question'));
            }
        }else{
            redirect(site_url('login'));
        }
        $business_id=$this->session->userdata('business_id');
        if(empty($check['business_name'])){
            redirect(site_url('edit_profile'));
        }
        $where['business_id']   = $business_id;
        $where['is_deleted']= '0';
        $list = $this->Common_model->getRecords('business_services','*',$where,'id asc',true);
        if(!$list){
            redirect(site_url('create_service'));
        }

        $data['business_name']=$check['business_name'];
        $bdetail = $this->Common_model->getRecords('business','is_live,phone_no,slug',array('id'=>$business_id),'id asc',true);

        $data['share_link']=site_url('detail/'.$bdetail['slug']);
        $data['phone_no']=$bdetail['phone_no'];
        $is_live = $bdetail['is_live'];
        $data['business_live']="yes";
        if($is_live==0){
            $data['business_live']="no";
        }
        
        $data['month_booking'] = $this->Front_model->getTotalBooking($business_id,'month');
        $data['total_booking'] = $this->Front_model->getTotalBooking($business_id,'total');
        
        $qrimage=$bdetail['slug'].'.png';
        if(!file_exists(QR_PATH.$qrimage)){
            $qrimage=generateQrCode($data['share_link'],$qrimage);
            $data['qr_image']=site_url($qrimage);
        }else{
            $data['qr_image']=site_url(QR_PATH.$qrimage);
        }
        
        $this->load->view('front/header',$data);
        $this->load->view('front/qrcode');
        $this->load->view('front/footer');
    }
    public function business_detail() 
    {
        $slug           = $this->uri->segment(2);
        
        $detail = $this->Front_model->getbusiness_detail($slug);
        if($detail){
            $detail['business_name']=ucfirst($detail['business_name']);
            $detail['fullname']=ucfirst($detail['fullname']);
            $detail['link']=site_url('detail/'.$detail['slug']);
            $data['share_link']=site_url('detail/'.$detail['slug']);
            $detail['logo']=site_url($detail['logo']);

            $data['page_title']=$detail['business_name'];
            $data['page_description']=$detail['category'].', '.$detail['address'];
            $data['page_url']=$data['share_link'];
            $data['share_img']=$detail['logo'];

            $data['detail']=$detail;
            $data['windows'] = $this->Front_model->getBusinessServices($detail['id']);

            $windows=array();
            if(!empty($data['windows'])){
                for ($i=0; $i < count($data['windows']); $i++) { 
                    $obj=array('window_id'=>$data['windows'][$i]['window_id'],
                        'window_name'=>$data['windows'][$i]['window_name'],
                        'services'=>$data['windows'][$i]['services']);

                    $obj['bookings']=$this->Front_model->get_window_booking_list($obj['window_id']);

                    $obj['current']=array();
                    if(!empty($obj['bookings'])){
                        $current = array_filter($obj['bookings'], function ($var) {
                            return ($var['status'] == 'In-Progress');
                        });
                        if(!empty($current)){
                            foreach ($current as $j => $vll) {
                                if(isset($current[$j])){
                                    $obj['current']=$current[$j];
                                    break;
                                }
                            }
                        }
                    }
                    array_push($windows, $obj);
                }
            }
            // echo "<pre>";print_r($windows);die;
            $data['windows']=$windows;

            $this->load->view('front/header',$data);
            $this->load->view('front/detail');
            $this->load->view('front/footer');
        }else{
            redirect(site_url());
        }
    }

    public function get_waiting_time() 
    {
        $slug          = $this->input->post('slug');
        $wid           = $this->input->post('id');
        $token         = $this->input->post('token');
        
        $detail = $this->Front_model->getbusiness_detail($slug);
        if($detail){
            $data['detail']=$detail;
            $windows=array();
            $obj['bookings']=$this->Front_model->get_window_booking_list($wid);

            $obj['current']=array();
            $waittime=0;
            $arr=array();
            if(!empty($obj['bookings'])){
                foreach ($obj['bookings'] as $key => $value) {
                    if($value['status']== 'In-Progress' && $value['device_token']==$token){
                        $waittime=0;
                        break;
                    }else if($value['device_token']==$token){
                        array_push($arr, array(
                            "act"=>'if',
                            "token"=>$token,
                            "device_token"=>$value['device_token'],
                            "serve_time"=>$value['serve_time'],
                        ));
                    }else{
                        if($value['status']!='Canceled'){
                            $waittime=$waittime+$value['serve_time'];
                            array_push($arr, array(
                                "act"=>'else',
                                "token"=>$token,
                                "device_token"=>$value['device_token'],
                                "serve_time"=>$value['serve_time'],
                            ));
                        }
                    }
                }
            }
            // echo "<pre>";print_r($arr);die;
            if($waittime>0){
                $waittime=$waittime.' min';
            }else{
                $waittime='--';
            }
            display_output('1','success.',array('time'=>$waittime));

        }else{
           display_output('0','success.',array('time'=>'--'));
        }
    }
    public function services(){
        $data['title']="title";
        $data['is_female']='no';
        $window_id=$this->uri->segment(3);
        
        $where['id']   =base64_decode($window_id);
        $where['is_deleted']= '0';
        $window = $this->Common_model->getRecords('business_window','*',$where,'id asc',true);
        if(!$window){
            redirect(site_url());
        }
        $data['detail']= $this->Common_model->getRecords('business','*',array('id'=>$window['business_id']),'id asc',true);

        $data['window']=$window;
        $whr=array('is_deleted'=>0,'window_id'=>$window['id']);
        if(isset($_GET['female'])){
            $data['is_female']='yes';
            $whr=array('is_deleted'=>0,'window_id'=>$window['id'],'gender'=>'female');
        }
        $data['services']=$this->Common_model->getRecords('business_services', '*', $whr, 'id asc', false);
        
        $data['current_link']=site_url($data['detail']['slug'].'/services/'.$window_id);
        $data['back_link']=site_url('detail/'.$data['detail']['slug']);
        $this->load->view('front/header',$data);
        $this->load->view('front/services');
        $this->load->view('front/footer');
    }

    public function my_booking(){
        $data['title']="title";
        $data['back_link']=site_url();
        $this->load->view('front/header',$data);
        $this->load->view('front/my_booking');
        $this->load->view('front/footer');
    }
    //////////////////////

    public function business_signup() 
    {
        if($this->input->post()){
            $phone_no      =  clear_input($this->input->post('mobile_no'));
            $password    =  clear_input($this->input->post('password'));

            if(empty($phone_no)) {
                display_output('0',$this->lang->line('err_mobile_no'));  
            }
             if(!is_numeric($phone_no)){
                display_output('0',$this->lang->line('err_valid_mobile_no'));
            }
            if(strlen($phone_no)!=10){
                display_output('0',$this->lang->line('err_valid_mobile_no'));
            }
            if(empty($password)) {
                display_output('0',$this->lang->line('err_passcode'));
            }
            if(strlen($password)<6 || strlen($password)>12){
                display_output('0',$this->lang->line('err_valid_passcode'));
            }
           
            $where['phone_no'] = $phone_no;
            $where['is_deleted'] = '0';
            if(!$user_data = $this->Common_model->getRecords('business','id',$where,'id DESC',true)) {
                $login_token=md5(time().mt_rand(100,10000));
                $formData = array(
                    'phone_no' => $phone_no,
                    'password' => md5($password),
                    'login_token' => $login_token,
                    'created' => date("Y-m-d H:i:s")); 

                if($business_id=$this->Common_model->addEditRecords('business',$formData)){ 

                    $formData = array('business_id' => $business_id,
                    'window_name' => "Guest"); 
                    $this->Common_model->addEditRecords('business_window',$formData);

                    $login=array(   
                        'business_id'=>$business_id,
                        'login_token'=>$login_token
                        );
                    $login_session=array(   
                        'business_id'=>$business_id,
                        'user_type'=> "business",
                        );
                    $this->session->set_userdata($login_session);

                    $response = array('returnurl'=>site_url('security_question'));
                    $msg = $this->lang->line('info_welcome_to_opneline_text');
                
                    display_output('1',$msg,$response);
                }else{
                    display_output('0',$this->lang->line('err_something_wrong'));
                }
            }else{
                display_output('0',$this->lang->line('err_mobile_already_exist'));
            }
        }//end post method
    }

    public function submit_question() 
    {
        $check=$this->Common_model->check_business_login();
        if(!$check){
            display_output('4',$this->lang->line('err_session_expire'));
        }
        $business_id=$this->session->userdata('business_id');
        if($this->input->post()){
            $qustion_id     =  $_POST['qustion_id'];
            $qustion_ans    =  $_POST['qustion_ans'];
       
            if(empty($qustion_ans)) {
                display_output('0',$this->lang->line('err_enter_answers'));
            }
            $cnt=0;
            foreach ($qustion_id as $key => $value) {
                if(!empty($qustion_ans[$key])){
                    $cnt++;
                }
            }
            if($cnt<3){
                display_output('0',$this->lang->line('err_enter_3answer'));
            }
            foreach ($qustion_id as $key => $value) {
                $formData = array(
                'business_id' =>$business_id,
                'question_id' =>$value,
                'answer' =>$qustion_ans[$key],
                'created' => date("Y-m-d H:i:s")); 
                $this->Common_model->addEditRecords('business_security_question',$formData);
            }
            $response = array('returnurl'=>site_url('edit_profile'));
            $msg=$this->lang->line('info_submitted_successfully');
            display_output('1',$msg,$response);
        }//end post
    }

    public function business_login() 
    {
        if($this->input->post()){
            $phone_no    =  clear_input($this->input->post('mobile_no'));
            $password    =  clear_input($this->input->post('password'));

            if(empty($phone_no)) {
                display_output('0',$this->lang->line('err_mobile_no'));
            }
            if(empty($password)) {
                display_output('0',$this->lang->line('err_passcode'));
            }
            if(strlen($password)<6 || strlen($password)>12){
                display_output('0',$this->lang->line('err_valid_passcode'));
            }
            if(!is_numeric($phone_no)){
                display_output('0',$this->lang->line('err_valid_mobile_no'));
            }
            if(strlen($phone_no)!=10){
                display_output('0',$this->lang->line('err_valid_mobile_no'));
            }
            $where['phone_no'] = $phone_no;
            $where['is_deleted'] = '0';
            if($user_data = $this->Common_model->getRecords('business','id,status,business_name,password',$where,'id DESC',true)) {

                if($user_data['status']!='Active'){
                    display_output('0',$this->lang->line('info_account_deactivated'));
                }
                if(md5($password)!=$user_data['password']){
                    display_output('0',$this->lang->line('err_wrong_password'));
                }
                
                $business_id=$user_data['id'];
                $login_token=md5(time().mt_rand(100,10000));
                $login=array(   
                    'business_id'=>$business_id,
                    'login_token'=>$login_token
                    );
                $login_session=array(   
                    'business_id'=>$business_id,
                    'user_type'=> "business",
                    );
                $this->session->set_userdata($login_session);

                $response = array('returnurl'=>site_url('security_question'),'details'=>$login);
                $msg =$this->lang->line('info_welcome_to_opneline_text');

                if(!$this->Common_model->getRecords('business_security_question','id',array('business_id'=>$user_data['id']),'id DESC',true)){
                    display_output('2',$this->lang->line('info_submit_quest_first'),$response);
                }
                
                if(empty($user_data['business_name'])){
                    $returnurl=site_url('edit_profile');
                }else if(!$this->Common_model->getRecords('business_services','id',array('business_id'=>$business_id,'is_deleted'=>0),'id DESC',true)) {
                    $returnurl=site_url('create_service');
                }else{
                    $returnurl=site_url('business_window');
                }

                $response = array('returnurl'=>$returnurl,'details'=>$login);
                display_output('1',$msg,$response);
            }else{
                display_output('0',$this->lang->line('info_mobile_not_register'));
            }
        }//end post
    }
    //below 3 functions for for forgot password
    public function check_business_number() 
    {
        if($this->input->post()){
            $phone_no    =  clear_input($this->input->post('mobile_no'));
            if(empty($phone_no)) {
                display_output('0',$this->lang->line('err_mobile_no'));
            }
            if(!is_numeric($phone_no)){
                display_output('0',$this->lang->line('err_valid_mobile_no'));
            }
            if(strlen($phone_no)!=10){
                display_output('0',$this->lang->line('err_valid_mobile_no'));
            }
            $where['phone_no'] = $phone_no;
            $where['is_deleted'] = '0';
            if($user_data = $this->Common_model->getRecords('business','id,status,business_name,password',$where,'id DESC',true)) {

                if($user_data['status']!='Active'){
                    display_output('0',$this->lang->line('info_account_deactivated'));
                }
                $log_session=array(   
                    'business_no'=>$phone_no,
                );
                $this->session->set_userdata($log_session);

                if(!$this->Common_model->getRecords('business_security_question','id',array('business_id'=>$user_data['id']),'id DESC',true)){
                    display_output('2',$this->lang->line('info_contact_admin_password'));
                }

                $response = array('returnurl'=>site_url('forgot_password/question'));
                display_output('1','',$response);
            }else{
                display_output('0',$this->lang->line('info_mobile_not_register'));
            }
        }//end post
    }
    public function forgot_secury_verify() 
    {
        $phone_no=$this->session->userdata('business_no');
        if(!$phone_no){
            display_output('2',$this->lang->line('err_try_again'));
        }
        $where['phone_no'] = $phone_no;
        $where['is_deleted'] = '0';
        if($user_data = $this->Common_model->getRecords('business','id,status,business_name',$where,'id DESC',true)) {
        }else{
            display_output('2',$this->lang->line('err_try_again'));
        }
        $business_id=$user_data['id'];

        if($this->input->post()){
            $qustion_id     =  $_POST['qustion_id'];
            $qustion_ans    =  $_POST['qustion_ans'];
       
            if(empty($qustion_ans)) {
                display_output('0',$this->lang->line('err_enter_answers'));
            }
            $cnt=0;
            foreach ($qustion_id as $key => $value) {
                if(!empty($qustion_ans[$key])){
                    $cnt++;
                }
            }
            if($cnt==0){
                display_output('0',$this->lang->line('err_enter_answers'));
            }
            $rightans=0;
            foreach ($qustion_id as $key => $value) {
                $answer=$this->Common_model->getFieldValue('business_security_question','answer',array('business_id'=>$business_id,'question_id'=>$value));
                if(!empty($answer)){
                    if($answer==$qustion_ans[$key]){
                        $rightans++;
                    }
                }
            }
            if($rightans==0){
                display_output('0',$this->lang->line('err_no_answers_match'));
            }
            $log_session=array(   
                'business_no'=>$phone_no,
                'answer_verified'=>'yes',
            );
            $this->session->set_userdata($log_session);
            $response = array('returnurl'=>site_url('forgot_password/reset_pass'));
            display_output('1',$this->lang->line('info_verified_successfully'),$response);
        }//end post
    }
    public function reset_password() 
    {
        $phone_no=$this->session->userdata('business_no');
        if(!$phone_no){
            $response = array('returnurl'=>site_url('forgot_password/reset_pass'));
            display_output('2',$this->lang->line('err_try_again'),$response);
        }
        $where['phone_no'] = $phone_no;
        $where['is_deleted'] = '0';
        if($user_data = $this->Common_model->getRecords('business','id,status,business_name',$where,'id DESC',true)) {
        }else{
            $response = array('returnurl'=>site_url('forgot_password/reset_pass'));
            display_output('2',$this->lang->line('err_try_again'));
        }
        $business_id=$user_data['id'];

        if($this->input->post()){
            $password    =  clear_input($this->input->post('password'));

            if(empty($password)) {
                display_output('0',$this->lang->line('err_passcode'));
            }
            if(strlen($password)<6 || strlen($password)>12){
                display_output('0',$this->lang->line('err_valid_passcode'));
            }
           
            $formData = array(
                'password' => md5($password),
                'modified' => date("Y-m-d H:i:s")); 

            if($result=$this->Common_model->addEditRecords('business',$formData,array('id'=>$business_id))){ 
                    
                $response = array('returnurl'=>site_url('login'));
                $msg = $this->lang->line('info_welcome_to_opneline_text');
                $this->session->sess_destroy();
                display_output('1',$msg,$response);
            }else{
                display_output('0',$this->lang->line('err_something_wrong'));
            }
        }//end post method
    }
    //end forgot password functions

    public function business_logout() 
    {
        $business_id=$this->session->userdata('business_id');
        if($business_id){
            $update = array(
                'is_live'=>'0',
                'login_token'=>''
            );
            $this->Common_model->addEditRecords('business',$update,array('id' => $business_id));
        }
        $this->session->sess_destroy();
        redirect(site_url());
    }

    public function get_categories_1() 
    {
        $list=$this->Common_model->getRecords('business_category', 'id,name', array('is_deleted'=>0,'status'=>'Active'), 'name asc', false);
        if($list){
            display_output('1','Categories',array('list'=>$list));
        }else{
            display_output('0',$this->lang->line('err_no_data'));  
        }
    }
    
    public function update_business_profile() 
    {
        $check=$this->Common_model->check_business_login();
        if(!$check){
            display_output('4',$this->lang->line('err_session_expire'));
        }
        $business_id=$this->session->userdata('business_id');
        $fullname          = clear_input($this->input->post('fullname')); 
        $phone_no          = clear_input($this->input->post('phone_no')); 
        $business_name     = clear_input($this->input->post('business_name')); 
        $category_id       = clear_input($this->input->post('category_id')); 
        $state_id          = clear_input($this->input->post('state_id')); 
        $country_id        = clear_input($this->input->post('country_id')); 
        $city_id           = clear_input($this->input->post('city_id')); 
        $address           = clear_input($this->input->post('address')); 
        $lat               = clear_input($this->input->post('lat_val')); 
        $long              = clear_input($this->input->post('long_val')); 
        // $country_id=101;
        if(empty($fullname)) {
            display_output('0',$this->lang->line('input_business_ownname_req'));  
        }
        if(empty($business_name)) {
            display_output('0',$this->lang->line('input_business_name_req'));  
        }
        if(empty($category_id)) {
            display_output('0',$this->lang->line('err_business_type_select'));  
        }
        if(empty($city_id)) {
            display_output('0',$this->lang->line('err_city_select'));  
        }
        if(empty($state_id)) {
            display_output('0',$this->lang->line('err_state_select'));  
        }
        if(empty($phone_no)) {
            display_output('0',$this->lang->line('err_mobile_no'));  
        }
        if(!is_numeric($phone_no)){
            display_output('0',$this->lang->line('err_valid_mobile_no'));  
        }
        if(strlen($phone_no)!=10){
            display_output('0',$this->lang->line('err_valid_mobile_no'));  
        }
        if(empty($long)){
            // $long='';
            // display_output('0','Longitude is missing.');
        }
        if(empty($lat)){
            // $lat='';
            // display_output('0','Latitude is missing.');
        }
        
        $where['id'] = $business_id;
        $where['is_deleted'] = '0';
        $user_data = $this->Common_model->getRecords('business','id,logo,slug',$where,'id DESC',true);
        if(!$user_data){
            display_output('4',$this->lang->line('info_dont_permission'));
        }

        if($this->Common_model->getRecords('business', 'phone_no', array('id !='=>$business_id,'phone_no'=>$phone_no,'is_deleted'=>0), '', true)) {
            display_output('0',$this->lang->line('err_mobile_already_exist'));
        }
        
        if(!$this->Common_model->getFieldValue('business_category','name',array('id'=>$category_id))){
            display_output('0',$this->lang->line('err_wrong_category'));      
        }
        $filepath="";
        $filerror="";
        if(isset($_FILES['logo']) && !empty($_FILES['logo']['name'])){
            if($_FILES['logo']['error']==0) {
                $image_path = IMAGE_PATH;
                // $allowed_types = 'jpg|JPG|jpeg|JPEG|png|PNG|svg';
                $allowed_types = '*';
                $file='logo';
                $height = 150;
                $width = 150;
                $responce = commonImageUpload($image_path,$allowed_types,$file,$width,$height);
                if($responce['status']==0){
                    $upload_error = $responce['msg'];   
                    $filerror="1";
                } else {
                    $filepath=$responce['image_path'];
                }
            }
        }
        if($filerror!=''){
            display_output('0',strip_tags($upload_error));
        }
        $set = array(
            'fullname'=>$fullname,
            'business_name'=> $business_name,
            'category_id'=> $category_id,
            'phone_no'=> $phone_no,
            'address'=> $address,
            'lat'=> $lat,
            'long'=> $long,
            'country_id'=> $country_id,
            'state_id'=> $state_id,
            'city_id'=> $city_id,
            'modified'=> date("Y-m-d H:i:s"),
        );
        if(!empty($filepath)){
            $set['logo']=$filepath;
        }
        if(empty($user_data['slug'])){
            $set['slug']=create_slug($business_name).mt_rand(1000,10000);
        }
        if($this->Common_model->addEditRecords('business',$set,$where))
        {
            if(!empty($filepath) && !empty($user_data['logo'])){
                @unlink($user_data['logo']);
            }
            $res=array('returnurl'=>site_url('edit_profile'));
            if(!$this->Common_model->getRecords('business_services','id',array('business_id'=>$business_id,'is_deleted'=>0),'id DESC',true)) {
                $res=array('returnurl'=>site_url('create_service'));
            }
            display_output('1',$this->lang->line('info_profile_uodated_successfully'),$res);
        }else{
            display_output('0',$this->lang->line('err_something_wrong')); 
        }
    }
    //
    //palasiya   22.724356,75.883896
    //navlakha  22.702470,75.875690
    //lig  22.739361,75.885017

    public function make_business_live() 
    {
        $check=$this->Common_model->check_business_login();
        if(!$check){
            display_output('4',$this->lang->line('err_session_expire'));
        }
        $business_id=$this->session->userdata('business_id');
        $is_live = $this->Common_model->getFieldValue('business', 'is_live', array('id'=>$business_id));
        $newstatus=0;
        if($is_live==0){
            $newstatus=1;
        }
       
        $where = array('id'=>$business_id);
        $update_data = array(
            'is_live' => $newstatus,
            'modified'=>date("Y-m-d H:i:s")
            );

        if(!$this->Common_model->addEditRecords('business', $update_data, $where)) {
            display_output('0',$this->lang->line('err_something_wrong')); 
        } else {
            display_output('1',$this->lang->line('info_updated_successfully'));
        }
    }

    public function add_service() 
    {
        $check=$this->Common_model->check_business_login();
        if(!$check){
            display_output('4',$this->lang->line('err_session_expire'));
        }
        $business_id=$this->session->userdata('business_id');

        $service_name       = clear_input($this->input->post('service_name')); 
        $service_person     = clear_input($this->input->post('service_person')); 
        $service_time       = clear_input($this->input->post('service_time')); 
        $gender             = clear_input($this->input->post('gender')); 
        $window_id          = clear_input($this->input->post('window_id')); 
        $window_type        = clear_input($this->input->post('window_type')); 
        $window_name        = clear_input($this->input->post('window_name')); 
        if(empty($service_name)) {
            display_output('0',$this->lang->line('err_service_name_text'));
        }
        if(empty($service_person)) {
            display_output('0',$this->lang->line('err_service_person_text'));
        }
        if(empty($service_time)) {
            display_output('0',$this->lang->line('err_service_time_text'));
        }
        if(empty($gender)) {
            display_output('0',$this->lang->line('err_gender'));
        }

        if($window_type=='same') {
            if(empty($window_id)){
                display_output('0',$this->lang->line('err_window_select_text'));
            }
        }
        if($window_type=='new') {
            if(empty($window_name)){
                display_output('0',$this->lang->line('err_window_name_text'));
            }
            if($this->Common_model->getRecords('business_window', 'id', array('business_id'=>$business_id,'window_name'=>$window_name,'is_deleted'=>0), '', true)) {
                display_output('0',$this->lang->line('err_window_already_exist'));
            }
            $add = array(
            'business_id'=>$business_id,
            'window_name'=>$window_name);
            $window_id=$this->Common_model->addEditRecords('business_window',$add);
        }
        if($window_type=='same') {
            if($this->Common_model->getRecords('business_services', 'id', array('window_id'=>$window_id,'business_id'=>$business_id,'service_name'=>$service_name,'is_deleted'=>0), '', true)) {
                display_output('0',$this->lang->line('err_service_already_exist'));
            }
        }
        
        $add = array(
            'business_id'=>$business_id,
            'window_id'=>$window_id,
            'service_name'=>$service_name,
            'service_person'=>$service_person,
            'service_time'=>$service_time,
            'service_time_str'=>$service_time.' min',
            'gender'=>$gender,
        );
        if(!$this->Common_model->addEditRecords('business_services',$add)) {
            display_output('0',$this->lang->line('err_something_wrong'));
        }
        $res=array('returnurl'=>site_url('business_services'));
        display_output('1',$this->lang->line('info_service_added_successfully'),$res);
    }

    public function get_service_list_1() 
    {
        $check=$this->Common_model->check_business_login();
        if(!$check){
            display_output('4',$this->lang->line('err_session_expire'));
        }
        $business_id=$this->session->userdata('business_id');

        $where['business_id']   = $business_id;
        $where['is_deleted']= '0';
        $list = $this->Common_model->getRecords('business_services','*',$where,'id asc',false);
        if($list){
            foreach ($list as $key => $value) {
                $list[$key]['window']=$this->Common_model->getFieldValue('business_window','window_name',array('id'=>$value['window_id']));
            }
            display_output('1','Service List',array('list'=>$list));
        }else{
            display_output('0',$this->lang->line('err_no_data'));  
        }
    }

    public function update_service() 
    {
        $check=$this->Common_model->check_business_login();
        if(!$check){
            display_output('4',$this->lang->line('err_session_expire'));
        }
        $business_id=$this->session->userdata('business_id');

        $service_id         = clear_input($this->input->post('service_id')); 
        $service_name       = clear_input($this->input->post('service_name')); 
        $service_person     = clear_input($this->input->post('service_person')); 
        $service_time       = clear_input($this->input->post('service_time')); 
        $gender             = clear_input($this->input->post('gender')); 
        $window_id          = clear_input($this->input->post('window_id')); 
        $window_type        = clear_input($this->input->post('window_type')); 
        $window_name        = clear_input($this->input->post('window_name')); 
        if(empty($service_id)) {
            display_output('0','Service id missing.');
        }
        if(empty($service_name)) {
            display_output('0',$this->lang->line('err_service_name_text'));
        }
        if(empty($service_person)) {
            display_output('0',$this->lang->line('err_service_person_text'));
        }
        if(empty($service_time)) {
            display_output('0',$this->lang->line('err_service_time_text'));
        }
        if(empty($gender)) {
            display_output('0',$this->lang->line('err_gender'));
        }
        if(!$this->Common_model->getRecords('business_services','id',array('id'=>$service_id,'business_id'=>$business_id),'id DESC',true)){
            display_output('0',$this->lang->line('info_dont_permission'));
        }
        if($window_type=='same') {
            if(empty($window_id)){
                display_output('0',$this->lang->line('err_window_select_text'));
            }
        }
        if($window_type=='new') {
            if(empty($window_name)){
                display_output('0',$this->lang->line('err_window_name_text'));
            }
            if($this->Common_model->getRecords('business_window', 'id', array('business_id'=>$business_id,'window_name'=>$window_name,'is_deleted'=>0), '', true)) {
                display_output('0',$this->lang->line('err_window_already_exist'));
            }
            $add = array(
            'business_id'=>$business_id,
            'window_name'=>$window_name);
            $window_id=$this->Common_model->addEditRecords('business_window',$add);
        }
        if($window_type=='same') {
            if($this->Common_model->getRecords('business_services', 'id', array('id !='=>$service_id,'window_id'=>$window_id,'business_id'=>$business_id,'service_name'=>$service_name,'is_deleted'=>0), '', true)) {
                display_output('0',$this->lang->line('err_service_already_exist'));
            }
        }
        
        $add = array(
            'window_id'=>$window_id,
            'service_name'=>ucfirst($service_name),
            'service_person'=>$service_person,
            'service_time'=>$service_time,
            'service_time_str'=>$service_time.' min',
            'gender'=>$gender,
        );
        
        $this->Common_model->addEditRecords('business_services',$add,array('id'=>$service_id));
        $res=array('returnurl'=>site_url('business_services'));
        display_output('1',$this->lang->line('info_service_udpated_successfully'),$res);
    }

    public function delete_service() 
    {
        $check=$this->Common_model->check_business_login();
        if(!$check){
            display_output('4',$this->lang->line('err_session_expire'));
        }
        $business_id=$this->session->userdata('business_id');
        $service_id     = clear_input($this->input->post('service_id')); 
        if(empty($service_id)) {
            display_output('0','Service id missing.');
        }
       
        if(!$this->Common_model->getRecords('business_services','id',array('id'=>$service_id,'business_id'=>$business_id),'id DESC',true)){
            display_output('0',$this->lang->line('info_dont_permission'));
        }
        $set = array(
            'is_deleted'=>1,
        );
        $this->Common_model->addEditRecords('business_services',$set,array('id'=>$service_id,'business_id'=>$business_id));
        $res=array('returnurl'=>site_url('business_services'));
        display_output('1',$this->lang->line('info_service_deleted_successfully'),$res);
    }

    public function get_window_list_1() 
    {
        $check=$this->Common_model->check_business_login();
        if(!$check){
            display_output('4',$this->lang->line('err_session_expire'));
        }
        $business_id=$this->session->userdata('business_id');
        $where['business_id']   = $business_id;
        $where['is_deleted']= '0';
        $list = $this->Common_model->getRecords('business_window','*',$where,'id asc',false);
        if($list){
            foreach ($list as $key => $value) {
                $services = $this->Common_model->getRecords('business_window','*',array('window_id'=>$value['id'],'is_deleted'=>0),'id asc',false);
                if(!empty($services)){
                    $list[$key]['services']=$services;
                }else{
                    $list[$key]['services']=array();
                }
            }
            display_output('1','Window List',array('list'=>$list));
        }else{
            display_output('0',$this->lang->line('err_no_data'));  
        }
    }

    public function update_booking_status() 
    {
        $check=$this->Common_model->check_business_login();
        if(!$check){
            display_output('4',$this->lang->line('err_session_expire'));
        }
        $business_id=$this->session->userdata('business_id');
        $id          = clear_input($this->input->post('id')); 
        $action      = clear_input($this->input->post('action')); 
        if(empty($id)) {
            display_output('0',$this->lang->line('err_invalid_request'));  
        }
        if(empty($action)) {
            display_output('0',$this->lang->line('err_invalid_request'));  
        }

        $where['id'] = $id;
        $where['business_id'] =$business_id;
        $status='Pending';
        if($action=='confirm'){
            $status='Confirm';
        }else if($action=='hold'){
            $status='Hold';
        }else if($action=='cancel'){
            $status='Canceled';
        }else if($action=='complete'){
            $status='Completed';
        }
        $set = array(
            'status'=>$status,
            'updated_by'=>"business",
            'updated_id'=>$business_id,
            'modified'=>date("Y-m-d H:i:s"),
        );
        $this->Common_model->addEditRecords('booking',$set,$where);

        $booking = $this->Common_model->getRecords('booking','business_id,status,window_id',$where,'id DESC',true);
        $business_id=$booking['business_id'];
        $currstatus=$booking['status'];
        $window_id=$booking['window_id'];

        $checkrecord = $this->Common_model->getRecords('booking','id',array('status'=>'In-Progress','window_id'=>$window_id,'business_id'=>$business_id,'date(created)'=>date('Y-m-d')),'id DESC',true);
        if(!$checkrecord){
            $getconfirm = $this->Common_model->getRecords('booking','id',array('status'=>'Confirm','window_id'=>$window_id,'business_id'=>$business_id,'date(created)'=>date('Y-m-d')),'seat_no ASC',true);
            if($getconfirm){
                $set = array(
                    'status'=>'In-Progress',
                    'updated_by'=>"business",
                    'updated_id'=>$business_id,
                    'modified'=>date("Y-m-d H:i:s"),
                );
                $this->Common_model->addEditRecords('booking',$set,array('id'=>$getconfirm['id']));
            }
        }

        display_output('1',$this->lang->line('info_status_updated'));
    }
   
    ///end business module

    public function search_business() 
    {
        $lat           = clear_input($this->input->get('lat')); 
        $long          = clear_input($this->input->get('long')); 
        $category      = clear_input($this->input->get('category')); 
        $keyword       = clear_input($this->input->get('keyword')); 
        
        $list = $this->Front_model->getbusiness_list();
        if($list){
            foreach ($list as $key => $value) {
                $list[$key]['business_name']=ucfirst($value['business_name']);
                $list[$key]['fullname']=ucfirst($value['fullname']);
                $list[$key]['link']=site_url('detail/'.$value['slug']);
                $list[$key]['logo']=site_url($value['logo']);
                $list[$key]['distance']=round($value['distance'],2).' km';
            }
            display_output('1','List',array('list'=>$list));
        }else{
            display_output('0',$this->lang->line('err_no_data'));  
        }
    }
   
    public function user_book_table() 
    {
        $business_id        = clear_input($this->input->post('business_id')); 
        $window_id          = clear_input($this->input->post('window_id')); 
        $username           = clear_input($this->input->post('username')); 
        $mobile_no          = clear_input($this->input->post('mobile_no')); 
        $device_token       = clear_input($this->input->post('device_token')); 
        $services           = $_POST['services']; 
        if(empty($services)) {
            display_output('0',$this->lang->line('err_service_select_text'));
        }
        if(empty($window_id)) {
            display_output('0',$this->lang->line('err_window_select_text'));
        }
        if(empty($username)) {
            display_output('0',$this->lang->line('err_name_text'));
        }
        if(!empty($mobile_no)) {
            if(!is_numeric($mobile_no)){
                display_output('0',$this->lang->line('err_valid_mobile_no'));
            }
            if(strlen($mobile_no)!=10){
                display_output('0',$this->lang->line('err_valid_mobile_no'));
            }
        }
        
        $where['id'] = $business_id;
        $where['status'] = 'Active';
        $where['is_deleted'] = '0';
        $bdata = $this->Common_model->getRecords('business','id,is_live,slug',$where,'id DESC',true);
        if(!$bdata){
            display_output('0',$this->lang->line('info_page_refresh_alert'));
        }
        if($bdata['is_live']==0){
            display_output('0',$this->lang->line('info_booking_close_msg'));
        }

        $serviceids=explode(',', $services);
        if(!$this->Front_model->checkBusinessServices($business_id,$serviceids)){
            display_output('0',$this->lang->line('info_page_refresh_alert'));
        }
        $serve_time=$this->Front_model->getServicesTime($serviceids);

        $filepath="";
        $filerror="";
        if(isset($_FILES['profile_pic']) && !empty($_FILES['profile_pic']['name'])){
            if($_FILES['profile_pic']['error']==0) {
                $image_path = USER_IMAGE_PATH;
                $allowed_types = '*';
                $file='profile_pic';
                $height = 150;
                $width = 150;
                $responce = commonImageUpload($image_path,$allowed_types,$file,$width,$height);
                if($responce['status']==0){
                    $upload_error = $responce['msg'];   
                    $filerror="1";
                } else {
                    $filepath=$responce['image_path'];
                }
            }
        }
        if($filerror!=''){
            display_output('0',strip_tags($upload_error));
        }
        if(empty($device_token)){
            $device_token=md5(time().mt_rand(10,100));
        }
        $set = array(
            'device_token'=>$device_token,
            'fullname'=>$username,
            'device_id'=> "",
            'device_type'=>"",
            'phone_no'=> $mobile_no
        );
        if(!empty($filepath)){
            $set['profile_pic']=$filepath;
        }
        $storefile=$filepath;

        $uwhere="";
        $user_id="";
        $udata="";
        if(!empty($mobile_no)){
            $udata = $this->Common_model->getRecords('users','id,is_deleted,status,profile_pic,device_token',array('phone_no'=>$mobile_no),'id DESC',true);
            if(!$udata){
                $udata = $this->Common_model->getRecords('users','id,is_deleted,status,profile_pic',array('device_token'=>$device_token),'id DESC',true);
            }else{
                if(!empty($udata['device_token'])){
                    $device_token=$udata['device_token'];
                }
            }
        }else{
            $udata = $this->Common_model->getRecords('users','id,is_deleted,status,profile_pic',array('device_token'=>$device_token),'id DESC',true);
        }
        if($udata){
            $user_id=$udata['id'];
            if($udata['is_deleted']==1){
                if(!empty($filepath)){
                    @unlink($filepath);
                }
                display_output('0',$this->lang->line('info_alert_user_account_deactive'));
            }
            if($udata['status']!='Active'){
                if(!empty($filepath)){
                    @unlink($filepath);
                }
                display_output('0',$this->lang->line('info_alert_user_account_deactive'));
            }
            if(empty($filepath)){
                $storefile=$udata['profile_pic'];
            }
            $uwhere=array('id'=>$udata['id']);
        }
        
        if(empty($uwhere)){
            $set['created']= date("Y-m-d H:i:s");
        }else{
            $set['modified']= date("Y-m-d H:i:s");
        }
        if($uid=$this->Common_model->addEditRecords('users',$set,$uwhere)){

            if(empty($user_id)){
                $user_id=$uid;
            }
            $book = array(
                'user_id'=>$user_id,
                'business_id'=>$business_id,
                'window_id'=>$window_id,
                'service_ids'=> $services,
                'serve_time'=>$serve_time,
                'status'=> 'Pending',
                'created'=> date("Y-m-d H:i:s"),
            );
            $bid=$this->Common_model->addEditRecords('booking',$book);

            $booking_no=str_pad($bid,6,0,STR_PAD_LEFT);
            $this->Common_model->addEditRecords('booking',array('booking_no'=>$booking_no),array('id'=>$bid));

            $this->Front_model->alotSeatNo($business_id,$window_id,$bid);
            if(!empty($storefile)){
                $storefile=site_url($storefile);
            }
            $userdata=$device_token.'||'.$set['fullname'].'||'.$set['phone_no'].'||'.$storefile;
            $res=array('userdata'=>$userdata,'returnurl'=>site_url('detail/'.$bdata['slug']));
           
            display_output('1',$this->lang->line('info_booking_successfull'),$res);
        }else{
            display_output('0',$this->lang->line('err_something_wrong')); 
        }
    }
    public function cancel_booking() 
    {
        $id          = clear_input($this->input->post('id')); 
        $device_token       = clear_input($this->input->post('token')); 
        if(empty($id)) {
            display_output('0',$this->lang->line('err_window_select_text')); 
        }
        if(empty($device_token)) {
            display_output('0',$this->lang->line('err_something_wrong')); 
        }

        $user = $this->Common_model->getRecords('users','id',array('device_token'=>$device_token),'id DESC',true);
        if(!$user){
            display_output('0',$this->lang->line('err_something_wrong')); 
        }
        $user_id=$user['id'];
        $where['id'] = $id;
        $where['user_id'] =$user_id;

        $booking = $this->Common_model->getRecords('booking','business_id,status,window_id',$where,'id DESC',true);
        $business_id=$booking['business_id'];
        $currstatus=$booking['status'];
        $window_id=$booking['window_id'];
        
        $set = array(
            'status'=>"Canceled",
            'updated_by'=>"user",
            'updated_id'=>$user_id,
            'modified'=>date("Y-m-d H:i:s"),
        );
        $this->Common_model->addEditRecords('booking',$set,$where);

        if($currstatus=='In-Progress'){
            $getconfirm = $this->Common_model->getRecords('booking','id',array('status'=>'Confirm','window_id'=>$window_id,'business_id'=>$business_id,'date(created)'=>date('Y-m-d')),'seat_no ASC',true);
            if($getconfirm){
                $set = array(
                    'status'=>'In-Progress',
                    'updated_by'=>"business",
                    'updated_id'=>$business_id,
                    'modified'=>date("Y-m-d H:i:s"),
                );
                $this->Common_model->addEditRecords('booking',$set,array('id'=>$getconfirm['id']));
            }
        }
        display_output('1',$this->lang->line('info_booking_cancel_successfull'));
    }
    public function my_booking_data() 
    {
        $device_token           = $this->uri->segment(2); 
        $udata = $this->Common_model->getRecords('users','id,is_deleted,status,profile_pic',array('device_token'=>$device_token),'id DESC',true);
        if(!$udata){
            display_output('0',$this->lang->line('err_something_wrong')); 
        }

        $list = $this->Front_model->user_booking_list($udata['id']);
        if($list){
            foreach ($list as $key => $value) {
                $list[$key]['business_name']=ucfirst($value['business_name']);
                $list[$key]['fullname']=ucfirst($value['fullname']);
                $list[$key]['link']=site_url('detail/'.$value['slug']);
                $list[$key]['logo']=site_url($value['logo']);
            }
            display_output('1','List',array('list'=>$list));
        }else{
            display_output('0',$this->lang->line('err_no_data'));  
        }
    }

    public function contact_us() 
    {
        $user_id            = clear_input($this->input->post('user_id')); 
        $role_id            = clear_input($this->input->post('role_id')); 
        $subject            = clear_input($this->input->post('subject')); 
        $message            = clear_input($this->input->post('message')); 
        $contact_no         = clear_input($this->input->post('contact_no')); 

        if(empty($user_id)) {
            display_output('0','Please enter user id.');
        }  
        if(empty($role_id)){
            display_output('0','Please enter role id.');
        }
        if(empty($subject)){
            display_output('0','Please enter subject.');
        }
        if(empty($message)){
            display_output('0','Please enter message.');
        }
        if(empty($contact_no)){
            display_output('0','Please enter contact no.');
        } 
        
        $this->Front_model->check_user_status();
        
        $emaildetail=getNameEmailAddress($user_id);
        $from_name = $emaildetail['fullname']; 
        $from_email = $emaildetail['email']; 
        $user_type = $emaildetail['user_type']; 

        $todetail=getSuperAdminDetail();
        $to_name = $todetail['fullname']; 
        $to_email = $todetail['email']; 

        $subject = WEBSITE_NAME . ' - ' . $subject;

        $data['message'] = $message; 
        $data['fromname'] = $from_name; 
        $data['toname'] = $to_name;

        $senttype="";

        $body = $this->load->view('template/contact_us_template', $data,TRUE);
        $user_id=getParentAdminId($user_id);
        $insert_data = array(
            'message'   => $message,
            'subject'   => $this->input->post('subject'),
            'contact_no'=> $this->input->post('contact_no'),
            'name'      => $from_name,
            'email'     => $from_email,
            'type'      => $senttype,
            'from_id'   => $user_id,
            'to_id'     => $todetail['admin_id'],
            'parent_id' => 0,
            'status'    => 'Pending',
            'created'   => date("Y-m-d H:i:s")
        );
        //Send mail 
        if($this->Common_model->sendEmail($to_email,$subject,$body,$from_email)) {

            $contact_id=$this->Common_model->addEditRecords('contact', $insert_data);
            $ticket_id=str_pad($contact_id,6,0,STR_PAD_LEFT);
            $this->Common_model->addEditRecords('contact', array('ticket_id'=>$ticket_id), array('contact_id'=>$contact_id));

            display_output('1','Message Sent Successfully.');
        } else {
            display_output('0','Message not sent. Please try again !!');
        }
            
    }


} //End controlller class




    
