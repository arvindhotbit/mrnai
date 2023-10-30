<?php 

class Common_model extends CI_Model 
{
	function __construct() {
     	parent::__construct();
    }
	
	public function check_login() {
		if($this->session->userdata('admin_id')) {

		$admin_id = $this->session->userdata('admin_id');

		if($user_data = $this->Common_model->getRecords('admin','role_id,admin_id,user_type,parent_id,status,is_deleted',array('admin_id'=>$admin_id,'is_deleted' => 0,'status' => 'Active'),'',true)){
        	if($user_data['user_type'] =='SuperAdmin'){
		        return true;
           	}else{

			}
	    }else{

			$this->session->sess_destroy();
			redirect(base_url()."admin/login");
		}
	}else{
		redirect('admin/login');
	   }
  	}
  	public function check_business_login() 
    {
      	if($this->session->userdata('business_id')) {
        	$business_id=$this->session->userdata('business_id');
        	$user_type=$this->session->userdata('user_type');
        	if($user_type!='business'){
        		$this->session->sess_destroy();
        		return false;
        	}
        	$user = $this->Common_model->getRecords('business','id,fullname,business_name',array('id'=>$business_id,'is_deleted'=>0,'status'=>'Active'),'',true);
        	if(empty($user)){
        		$this->session->sess_destroy();
          		return false;
        	}else{
          		return $user;
        	}
      	} else {
      		// $this->session->sess_destroy();
        	return false;
      	}
    }
  	public function check_user_login() 
    {
      	if($this->session->userdata('user_id')) {
        	$userid=$this->session->userdata('user_id');
        	$userid=base64_decode($userid);
        	$user = $this->Common_model->getRecords('users','id',array('id'=>$userid,'is_deleted'=>0,'status'=>'Active'),'',true);
        	if(empty($user)){
          		return false;
        	}else{
          		return $user;
        	}
      	} else {
        	return false;
      	}
    }

	public function role_check($user_id) {
		$role=$this->session->userdata('role_id');
		if($role==4) {
			if($this->Common_model->getRecords('users','user_id',array('user_id'=>$user_id,'checker_id'=>$this->session->userdata('admin_id')),'',true)) {
				return true;
			}else {
				return false;
				//redirect('pages/page_not_found');
			}
		}
	}

	public function front_paginate($url,$total_row,$yes='') {
		$this->load->library('pagination');
		$config = array();
		$config["base_url"] = $url;
		$config["total_rows"] = $total_row;
		// $config["per_page"] = 2;
		$config["per_page"] = FRONT_LIMIT;
		// $config['use_page_numbers'] = TRUE;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		if($yes=='') {
			$config["uri_segment"] = 4;	
		}elseif ($yes=='seg5') {
			$config["uri_segment"] = 5;
		}elseif ($yes=='seg2') {
			$config["uri_segment"] = 2;
		}else{
			$config["uri_segment"] = 3;
		}
		
		$config['enable_query_strings']=TRUE;
		$config['reuse_query_string'] = TRUE;
 		$config['num_links'] = 2;
		//$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='active'><a href='javascript:void(0)'>";
		$config['cur_tag_close'] = "</a></li>";
		$config['next_tag_open'] = "<li class='next'>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li class='prev'>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	public function paginate($url,$total_row,$yes='') {
		$this->load->library('pagination');
		$config = array();
		$config["base_url"] = $url;
		$config["total_rows"] = $total_row;
		// $config["per_page"] = 2;
		$config["per_page"] = ADMIN_LIMIT;
		// $config['use_page_numbers'] = TRUE;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		if($yes=='') {
			$config["uri_segment"] = 4;	
		}elseif ($yes=='seg5') {
			$config["uri_segment"] = 5;
		}elseif ($yes=='seg2') {
			$config["uri_segment"] = 2;
		}else{
			$config["uri_segment"] = 3;
		}
		
		$config['enable_query_strings']=TRUE;
		$config['reuse_query_string'] = TRUE;
 		$config['num_links'] = 2;
		//$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='active'><a href='javascript:void(0)'>";
		$config['cur_tag_close'] = "</a></li>";
		$config['next_tag_open'] = "<li class='next'>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li class='prev'>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
	
	public function frontPaginate($url,$total_row,$segment) {
		$this->load->library('pagination');
		$config = array();
		$config["base_url"] = $url;
		$config["total_rows"] = $total_row;
		$config["per_page"] = FRONT_LIMIT;
		// $config['use_page_numbers'] = TRUE;
		// $choice = $config["total_rows"] / $config["per_page"];
		// $config["num_links"] = round($choice);
		$config["uri_segment"] = $segment;	
		
		$config['enable_query_strings']=TRUE;
		$config['reuse_query_string'] = TRUE;
		$config['num_links'] = 3;
		//$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<div class="pagination pager pull-left" style="display:block !important">';
		$config['full_tag_close'] = '</div>';
		$config['num_tag_open'] = "<div class='pageNumbers'>";
		$config['num_tag_close'] = '</div>';
		$config['cur_tag_open'] = "<div class='pageNumbers'><a href='javascript:void(0);' class='active'>";
		$config['cur_tag_close'] = "</a></div>";
		$config['prev_tag_open'] = "<div class='previousPage'>";
		$config['prev_link'] = "‹";
		$config['prev_tag_close'] = "</div>";
		$config['next_tag_open'] = "<div class='nextPage'>";
		$config['next_link'] = "›";
		$config['next_tag_close'] = "</div>";
		$config['first_tag_open'] = "<div class='firstPage'>";
		$config['first_link'] = "«";
		$config['first_tag_close'] = "</div>";
		$config['last_tag_open'] = "<div class='lastPage'>";
		$config['last_link'] = "»";
		$config['last_tag_close'] = "</div>";

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	public function getDropdownList($table,$col1,$col2,$title="",$where="",$group="") {

		$this->db->select($col1);
		$this->db->select($col2);
		if($where != "") {	
			$this->db->where($where);
		}
		if($group != "") {
		 $this->db->group_by($group); 
		}
		$this->db->order_by($col2,'asc');
		$query= $this->db->get($table);
		$query_result = $query->result_array();
		$return = array();
	    if( is_array( $query_result ) && count( $query_result ) > 0 ) {
	    	if($title !=""){
	    		$return[''] = 'Select '.ucfirst($title);
	    	}else{
	        	$return[''] = 'Select '.ucfirst($col1);
	        }
	        foreach($query_result as $row) {
	            $return[$row[$col1]] = $row[$col2];
	        }
	    }
	    return $return;
	}
	
	public function getRecords($table, $fields="", $condition="", $orderby="", $single_row=false,$groupby="",$offset=-1,$limit=10) {

		
		if($fields != "") {
			$this->db->select($fields);
		}

		if($groupby != "") {
			$this->db->group_by($groupby); 
		}
		 
		if($orderby != "") {
			$this->db->order_by($orderby); 
		}

		if($offset>-1) {
			$this->db->limit($limit,$offset);
		}
		
		if($condition != "") {
			$rs = $this->db->get_where($table,$condition);
		} else {
			$rs = $this->db->get($table);
		}
		//echo $this->db->last_query(); exit;
		
		if($single_row) {  
			return $rs->row_array();
		}
		return $rs->result_array();
	}

	public function group_By_Records($table_name='' , $field_name = '', $id='' ,$is_deleted='') {
        $this->db->select("$field_name,count(*) as total");
        if($is_deleted)
        {
        	$this->db->where('is_deleted',0);
        }
        $this->db->group_by($field_name);
        if($id)
        	$this->db->having($field_name,$id);
        $query = $this->db->get($table_name);
        return $query->result_array();
    }

    public function is_deleteable_comma_seperated($table_name='' , $field_name = '', $id=''){
        $this->db->select('id');
        $this->db->where("FIND_IN_SET('$id', $table_name.$field_name) !=", 0);
        $query = $this->db->get($table_name);
        return $query->result_array();
    }
	// this function returns table data.
	public function getFieldValue($table, $fields="", $condition="") {
		if($fields != "") {
			$this->db->select($fields);
		}

		if($condition != "") {
			$rs = $this->db->get_where($table,$condition);
		} else {
			$rs = $this->db->get_where($table);
		}
		$result = $rs->row_array();
		return $result[$fields];
	}

	public function addEditRecords($table_name, $data_array, $where='') {
		if($table_name && is_array($data_array)) {
			$columns = $this->getTableFields($table_name);
			foreach($columns as $coloumn_data)
				$column_name[]=$coloumn_data['Field'];
					  
			foreach($data_array as $key=>$val) {
				if(in_array(trim($key),$column_name)) {
					$data[$key] = $val;
				}
			 }

			if($where == "") {	
				$query = $this->db->insert_string($table_name, $data);
				$this->db->query($query);
				return  $this->db->insert_id();
			} else {
				$query = $this->db->update_string($table_name, $data, $where);
				$this->db->query($query);
				return  $this->db->affected_rows();
			}
		}			
	}

	function getNumRecords($table, $fields="", $condition="") {
		if($fields != "") {
			$this->db->select($fields);
		}
		if($condition != "") {
			$rs = $this->db->get_where($table,$condition);
		} else {
			$rs = $this->db->get($table);
		}		
		return $rs->num_rows();
	}
	
	// function for deleting records by condition.
	function deleteRecords($table, $where) { 
		$this->db->delete($table, $where);
		return $this->db->affected_rows();
	}

	// this function is used to get all the fields of a table.
	function getTableFields($table_name) {
		$query = "SHOW COLUMNS FROM $table_name";
		$rs = $this->db->query($query);
		return $rs->result_array();
	}

	// This function is used to set up mail configuration..
	function setMailConfig() {
		$this->load->library('email');
		$config['smtp_host'] = SMTP_HOST;
		$config['smtp_user'] = SMTP_USER;
		$config['smtp_pass'] = SMTP_PASS;
		$config['smtp_port'] = SMTP_PORT;
		// $config['smtp_crypto'] = 'ssl';
		$config['validate'] = 'TRUE';
		$config['protocol'] = PROTOCOL;
		$config['mailpath'] = MAILPATH;
		$config['mailtype'] = MAILTYPE;
		$config['charset'] = CHARSET;
		$config['wordwrap'] = WORD_WRAP;
		$config['smtp_timeout'] = 300;
		$config['newline'] = "\r\n";
		$this->email->set_crlf( "\r\n" );

		$this->email->initialize($config);
	}

	function sendEmail($to_email,$subject,$body,$from_email) {
		$from_email=FROM_EMAIL;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
	 	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 	$this->setMailConfig();
	 	$this->email->set_newline("\r\n");
		$this->email->from($from_email); 
		$this->email->to($to_email);
		$this->email->subject($subject); 
		$this->email->message($body); 
		$this->email->send();
		// echo $this->email->print_debugger();
		// die;
		return true;
	}

	function sendEmail_old($to_email,$subject,$body,$from_email) {
		$bcc_emails="ankitkumavat@ymail.com";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: ".$from_email. "\r\n";
		$headers .= "BCC: ". $bcc_emails . "\r\n";
		@mail($to_email,$subject,$body,$headers,'-f noreply@wadhwaneylawhouse.com');
		return true;
	}
	function defaultEmailSend($to_email,$subject,$body,$from_email) {
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: ".$from_email. "\r\n";
		$headers .= "BCC: ". $bcc_emails . "\r\n";
		@mail($to_email,$subject,$body,$headers,'-f notifications-caselaw@lbhsoftech.com');
		return true;
	}

	public function remember_me() {
        $result = $this->common_model->getRecords('admin','*',array('admin_id ' => $_COOKIE['remember_me']),'',true);
        $this->session->set_userdata('admin_auth',$result);
    }

    public function groupByRecords($table_name='' , $field_name = '', $id='') {
        $this->db->select("$field_name,count(*) as total");
        $this->db->group_by($field_name);
		if($id)
			$this->db->having($field_name,$id);        
        $query = $this->db->get($table_name);
        return $query->result_array();
    }

    public function groupBytotal($table_name='' , $name = '', $field_name = '', $id='') {
        $this->db->select("count($name) as total");
        $this->db->where('is_deleted','0');
        $this->db->where($field_name,$id);
        $query = $this->db->get($table_name);
        return $query->row_array();
    }

    public function itemGroupByRecords($table_name='' , $field_name = '', $where='') {
        $this->db->select("$field_name,count(*) as total");
        $this->db->group_by($field_name);
        $this->db->order_by('total desc');
        $this->db->order_by($field_name,'asc');
		if($where){
			$this->db->where($where);        
		}
        $query = $this->db->get($table_name);
        return $query->result_array();
    }

    public function getRecordsimg($table, $fields="", $condition="", $orderby="", $single_row=false,$limit=-1) {
		if($fields != "") {
			$this->db->select($fields);
		}
		 
		if($orderby != "") {
			$this->db->order_by($orderby); 
		}

		if($limit>-1) {
			$this->db->limit(5,$limit);
		}
		
		if($condition != "") {
			$rs = $this->db->get_where($table,$condition);
		} else {
			$rs = $this->db->get($table);
		}
		//echo $this->db->last_query(); exit;
		
		if($single_row) {
			return $rs->row_array();
		}
		return $rs->result_array();
	}

    public function getPermissionsadd() {

		$type = $this->session->userdata('user_type');
		if($type=='Super Admin'){
			$type='Admin';
		}

		$menuarray=array();
		$sections = $this->Common_model->getRecords('sections','*',array('type'=>$type,'status'=>'Active','parent_id'=>'0'),'sort_order asc',false); 
		foreach ($sections as $key => $value) {
			array_push($menuarray,$value);
			$subsections = $this->Common_model->getRecords('sections','*',array('type'=>$type,'status'=>'Active','parent_id'=>$value['id']),'sort_order asc',false); 
			if(!empty($subsections)){
				foreach ($subsections as $value1) {
					array_push($menuarray,$value1);
				}
			}

		}
		return $menuarray;
		
    }

	public function getrolePermissions($role_id) {

		$type = $this->session->userdata('user_type');
		if($type=='Super Admin'){
			$type='Admin';
		}

		$menuarray=array();

		$this->db->select('i.*,s.id as section_id,s.name,s.parent_id');
		$this->db->from('sections s');
		$this->db->join('role_permissions i','s.id = i.section_id and i.role_id='.$role_id,'left');       
		// $this->db->where('i.role_id',$role_id);
		$this->db->where('s.type',$type);
		$this->db->where('s.parent_id',0);
		$this->db->where('s.status','Active');
		$this->db->order_by('s.sort_order');
		$query = $this->db->get();
		$sections= $query->result_array();

		foreach ($sections as $key => $value) {
			array_push($menuarray,$value);

			$this->db->select('i.*,s.id as section_id,s.name,s.parent_id');
			$this->db->from('sections s');
			$this->db->join('role_permissions i','s.id = i.section_id and i.role_id='.$role_id,'left'); 
			$this->db->where('s.type',$type);
			$this->db->where('s.parent_id',$value['section_id']);
			$this->db->order_by('s.sort_order');
			$query = $this->db->get();
			$subsections= $query->result_array();

			if(!empty($subsections)){
				foreach ($subsections as $value1) {
					array_push($menuarray,$value1);
				}
			}
		}

		return $menuarray;

    }

	public function get_admin_list($offset=0) 
	{
		$admin_id=$this->session->userdata('admin_id');
		$where="admin.parent_id='".$admin_id."' AND admin.is_deleted=0";

		if($this->input->get('name')) {
			$name=$this->input->get('name');
			$where.=" and admin.fullname LIKE '%".$this->db->escape_like_str(trim($name))."%' ";
		} 
		if($this->input->get('role_name')) {
			$role_name=$this->input->get('role_name');
			$where.=" and admin.role_id =".$role_name;
		} 
		if($this->input->get('username')) {
			$username=$this->input->get('username');
			$where.=" and admin.username LIKE '%".$this->db->escape_like_str(trim($username))."%' ";
		}
		if($this->input->get('email')){
			$email=$this->input->get('email');
			$where.=" and admin.email LIKE '%".$this->db->escape_like_str(trim($email))."%' ";
		}
		if($this->input->get('mobile')){
			$mobile=$this->input->get('mobile');
			$where.=" and admin.mobile LIKE '%".$this->db->escape_like_str(trim($mobile))."%' ";
		}
		if($this->input->get('role')){
			$role=$this->input->get('role');
			$where.=" and admin.role_id = '".$role."' ";
		} 
		$where.=" and roles.hide = 0 ";
		$limit=ADMIN_LIMIT;
	 	$sql="SELECT admin.*,roles.name as role_name 
		FROM  admin inner join roles on roles.role_id = admin.role_id WHERE $where ORDER BY admin_id DESC
		limit $offset,$limit";
		$query=$this->db->query($sql);

		if ($query->num_rows() > 0) {
            return $query->result_array();
        } else return false;
	}	

	public function get_admin_total() 
	{
		$admin_id=$this->session->userdata('admin_id');
		$where="admin.parent_id='".$admin_id."' AND admin.is_deleted=0";

		if($this->input->get('name')) {
			$name=$this->input->get('name');
			$where.=" and admin.fullname LIKE '%".$this->db->escape_like_str(trim($name))."%' ";
		} 
		if($this->input->get('role_name')){
			$role_name=$this->input->get('role_name');
			$where.=" and admin.role_id =".$role_name;
		} 
		if($this->input->get('username')){
			$username=$this->input->get('username');
			$where.=" and admin.username LIKE '%".$this->db->escape_like_str(trim($username))."%' ";
		}
		if($this->input->get('email')){
			$email=$this->input->get('email');
			$where.=" and admin.email = '".$this->db->escape_like_str(trim($email))."' ";
		}
		if($this->input->get('mobile')){
			$mobile=$this->input->get('mobile');
			$where.=" and admin.mobile = '".$this->db->escape_like_str(trim($mobile))."' ";
		}
		if($this->input->get('role')){
			$role=$this->input->get('role');
			$where.=" and admin.role_id = '".$role."' ";
		}

		$limit=ADMIN_LIMIT;
		$sql="SELECT admin.*,roles.name as role_name FROM admin inner join roles on roles.role_id = admin.role_id	
		WHERE $where
		";
		$query=$this->db->query($sql);
		
		if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else return false;
	}	

 	public function get_role_list($offset=0) {
 		$type = $this->session->userdata('user_type');
 		$admin_id=$this->session->userdata('admin_id');
        if($type=='Super Admin'){
            $type='Admin';
        }

		$where="type ='".$type."' and hide=0";

		if($type!='Admin'){
        	
        	$where.=" and created_by ='".getParentAdminId($admin_id)."'";
        }

		if($this->input->get('name')){
			$name=$this->input->get('name');
			$where.=" and roles.name LIKE '%".$this->db->escape_like_str(trim($name))."%' ";
		} 
		 
		$limit=ADMIN_LIMIT;
	 	$sql="SELECT *
		FROM  roles 
		WHERE $where
		ORDER BY parent_id ASC
		limit $offset,$limit";
		$query=$this->db->query($sql);
		
		if ($query->num_rows() > 0) {
            return $query->result_array();
        } else return false;
	}	

	public function get_role_total() {
		$type = $this->session->userdata('user_type');
		$admin_id=$this->session->userdata('admin_id');
        if($type=='Super Admin'){
            $type='Admin';
        }
		$where="type ='".$type."'  and hide=0";

        if($type!='Admin'){
        	
        	$where.=" and created_by ='".getParentAdminId($admin_id)."'";
        }

		if($this->input->get('name')) {
			$name=$this->input->get('name');
			$where.=" and roles.name LIKE '%".$this->db->escape_like_str(trim($name))."%' ";
		} 
		 
		$limit=ADMIN_LIMIT;
		$sql="SELECT *
		FROM  roles
		WHERE $where
		";
		$query=$this->db->query($sql);
		
		if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else return false;
	}	 

	public function common_info($primary_table,$join_table,$clause,$where="",$single_row=false, $orderby="") {
        $this->db->select(''.$primary_table.'.*');
        $this->db->from($primary_table);
        if($where != "") {
	        $this->db->where($where);
        }
        if($orderby != "") {
			$this->db->order_by($orderby); 
		}
        $this->db->join($join_table,$clause, 'left');
        $query= $this->db->get();
        if($single_row) {  
            return $query->row_array();
        }
        return $query->result_array();
    }

    public function check_user_exist($user_id) {
        $this->db->select('user_id');
        $this->db->from('users');
        $this->db->where('user_id',$user_id,false);
        $query= $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else return false;
    }


    //ccevenue settings
    public function encrypt($plainText, $key){
        $key = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        $encryptedText = bin2hex($openMode);
        return $encryptedText;
   }

    /**
     * Function to decrypt
     * @param $encryptedText string
     * @param $key
     * @return string
     */
    public function decrypt($encryptedText, $key){
        $key = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = $this->hextobin($encryptedText);
        $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        return $decryptedText;
    }

	
	//*********** Padding Function *********************

	public function pkcs5_pad ($plainText, $blockSize)
	{
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}

	//********** Hexadecimal to Binary function for php 4.0 version ********

	public function hextobin($hexString) 
	{ 
		$length = strlen($hexString); 
		$binString="";   
		$count=0; 
		while($count<$length) 
		{       
			$subString =substr($hexString,$count,2);           
			$packedString = pack("H*",$subString); 
			if ($count==0)
			{
				$binString=$packedString;
			} 
			else 
			{
				$binString.=$packedString;
			} 

			$count+=2; 
		} 
		return $binString; 
	}

}

	