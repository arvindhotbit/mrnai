<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('is_used')){
    function is_used($table,$is_used,$id){
        //get main CodeIgniter object
        $ci =& get_instance();
        $res =array();
        $res = $ci->Common_model->getRecords($table,$id,array($id=>$is_used),'',true);
        return $res[$id];
    }
}


if (!function_exists('passwordValidate')){
    function passwordValidate($password){
        if(preg_match("/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[-_!@#$]).{8,30}$/", $password)) {
            return true;
        } else {
           return false; 
        }
    }
}

if (!function_exists('getAdminEmail')){
    function getAdminEmail(){
        //get main CodeIgniter object
        $ci =& get_instance();
        $res =array();
        $res = $ci->Common_model->getRecords('admin','email',array('admin_id' => 1),'',true);
        return $res['email'];
    }
}

if (!function_exists('getParentAdminId')){
    function getParentAdminId($id){
        //get main CodeIgniter object
        $ci =& get_instance();
        $res =array();
        $res = $ci->Common_model->getRecords('admin','admin_id,parent_id',array('admin_id'=>$id),'',true);
        if($res['parent_id']>0){
            return $res['parent_id'];
        }
        return $id;
    }
}

if (!function_exists('getAdminIdfromTable')){
    function getAdminIdfromTable($table,$id){
        //get main CodeIgniter object
        $ci =& get_instance();
        $res =array();
        $res = $ci->Common_model->getRecords($table,'admin_id',array('id'=>$id),'',true);
        
        return $res['admin_id'];
    }
}

if (!function_exists('getSuperAdminDetail')){
    function getSuperAdminDetail(){
        //get main CodeIgniter object
        $ci =& get_instance();
        $res =array();
        $res = $ci->Common_model->getRecords('admin','email,admin_id,fullname',array('user_type'=>'Super Admin'),'',true);
        return $res;
    }
}
if (!function_exists('getActualId')){
    function getActualId($table){
        //get main CodeIgniter object
        $ci =& get_instance();
        $res =array();
        $loggedin_user_id=$ci->session->userdata('admin_id');
        
        $res = $ci->Common_model->getRecords('admin','admin_id,parent_id',array('admin_id'=>$loggedin_user_id),'',true);
        if($res['parent_id']>0){
            $admin_id=$res['parent_id'];
        }else{
            $admin_id=$loggedin_user_id;
        }
        $details = $ci->Common_model->getRecords($table,'id',array('admin_id'=>$admin_id),'',true);
        return  $details['id'];
        
    }
}
if (!function_exists('getActualParentId')){
    function getActualParentId($table){
        //get main CodeIgniter object
        $ci =& get_instance();
        $res =array();
        $loggedin_user_id=$ci->session->userdata('admin_id');
        
        $res = $ci->Common_model->getRecords('admin','admin_id,parent_id',array('admin_id'=>$loggedin_user_id),'',true);
        if($res['parent_id']>0){
            $admin_id=$res['parent_id'];
        }else{
            $admin_id=$loggedin_user_id;
        }
        
        return  $admin_id;
        
    }
}


if (!function_exists('commonImageUpload')){
    function commonImageUpload($upload_path,$allowed_types,$file,$width,$height) 
    {
        $ci =& get_instance();
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = $allowed_types;
        $config['encrypt_name'] = TRUE;
        $ci->load->library('upload', $config);
        $ci->upload->initialize($config);
        
        if (!$ci->upload->do_upload($file)) {
            return array('status'=>0,'msg'=>$ci->upload->display_errors("<p class='inputerror'>","</p>"));        
        } else {
            $upload_data=$ci->upload->data();
           
            $img=$upload_data['file_name'];
            if($upload_data['file_type']!='image/svg+xml'){
                $img = uniqid(time()).$upload_data['file_ext'];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $upload_data['full_path'];
                $config['new_image'] = $upload_path.$img;
                $config['quality'] = 100;
                $config['maintain_ratio'] = FALSE;
                // $config['width']         = $width;
                // $config['height']       = $height;

                $ci->load->library('image_lib', $config);

                $ci->image_lib->resize();
                $ci->image_lib->clear();
                unlink($upload_data['full_path']);
            }
            return array('status'=>1,'image_path'=>$upload_path.$img);
        }
    }
}
function resizeImage($upload_path,$file,$width,$height) {

    $img='thumb_'.basename($file);
    $info = getimagesize($file);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($file);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($file);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($file);

    imagejpeg($image, $upload_path.$img, 75);
    @unlink($file);
    return array('status'=>1,'image_path'=>$upload_path.$img);
}
if (!function_exists('resizeImage1')){
    function resizeImage1($upload_path,$file,$width,$height) 
    {
        $ci =& get_instance();
        $img='thumb_'.basename($file);
        $config=array();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $file;
        $config['new_image'] = $upload_path.$img;
        $config['quality'] = 80;
        // $config['maintain_ratio'] = FALSE;
        // $config['width']         = $width;
        // $config['height']       = $height;

        $ci->image_lib->initialize($config);

        $ci->image_lib->resize();
        $ci->image_lib->clear();
        unlink($file);
        return array('status'=>1,'image_path'=>$upload_path.$img);
    }
}
if (!function_exists('resizewithsize')){
    function resizewithsize($upload_path,$file,$width,$height) 
    {
        $ci =& get_instance();
        $img='thumb_'.basename($file);
        $config=array();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $file;
        $config['new_image'] = $upload_path.$img;
        $config['quality'] = 60;
        $config['maintain_ratio'] = FALSE;
        $config['width']         = $width;
        $config['height']       = $height;

        $ci->image_lib->initialize($config);

        $ci->image_lib->resize();
        $ci->image_lib->clear();
        @unlink($file);
        return $upload_path.$img;
    }
}
if (!function_exists('commonDocumentUpload')){
    function commonDocumentUpload($upload_path,$allowed_types,$file,$width,$height) 
    {
        $ci =& get_instance();
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = $allowed_types;
        $new_name = uniqid(time()).$_FILES["image"]['name'];
        $config['file_name'] = $new_name;
        $ci->load->library('upload', $config);
        $ci->upload->initialize($config);
        
        if (!$ci->upload->do_upload($file)) {
            return array('status'=>0,'msg'=>$ci->upload->display_errors("<p class='inputerror'>","</p>"));        
        } else {
            $upload_data=$ci->upload->data();
            $img=$upload_data['file_name'];
            // if($upload_data['file_type']!='application/pdf'){
            if($upload_data['file_ext']!='.pdf' && $upload_data['file_ext']!='.docx' && $upload_data['file_ext']!='.doc'){
                $img = uniqid(time()).$upload_data['file_ext'];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $upload_data['full_path'];
                $config['new_image'] = $upload_path.$img;
                $config['quality'] = 100;
                $config['maintain_ratio'] = FALSE;
                $config['width']         = $width;
                $config['height']       = $height;

                $ci->load->library('image_lib', $config);

                $ci->image_lib->resize();
                $ci->image_lib->clear();
                unlink($upload_data['full_path']);
            }
            return array('status'=>1,'image_path'=>$upload_path.$img);
        }
    }
}
if (!function_exists('multiImageUpload')){
    function multiImageUpload($upload_path,$allowed_types,$file,$width,$height,$filename) 
    {
        $ci =& get_instance();
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = $allowed_types;
        $config['encrypt_name'] = TRUE;
        // $new_name = uniqid(time()).$filename;
        // $config['file_name'] = $new_name;
        $ci->load->library('upload', $config); 
        $ci->upload->initialize($config);
        $ci->load->library('image_lib');
        
        if (!$ci->upload->do_upload($file)) {
            //echo $ci->upload->display_errors(); exit;
            return array('status'=>0,'msg'=>$ci->upload->display_errors("<p class='inputerror'>","</p>"));        
        } else {
            $upload_data=$ci->upload->data();
            $img =$upload_data['file_name'];
            /*if($upload_data['file_ext']!='.pdf' && $upload_data['file_ext']!='.docx' && $upload_data['file_ext']!='.doc'){
                $img = $filename;
                //$img = uniqid(time()).$upload_data['file_ext'];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $upload_data['full_path'];
                $config['new_image'] = $upload_path.$img;
                $config['quality'] = 100;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = $width;
                $config['height']       = $height;

                $ci->image_lib->initialize($config);
                $ci->image_lib->resize();
                $ci->image_lib->clear();
                unlink($upload_data['full_path']);
            }*/
            return array('status'=>1,'image_path'=>$upload_path.$img);
        }
    }
}




if (!function_exists('getUserInfo')){
    function getUserInfo($id,$table,$match_col,$find_col){
        //get main CodeIgniter object
        $ci =& get_instance();
        $res=array();
        if($res = $ci->Common_model->getRecords($table, $find_col, array($match_col=>$id), '', true)) {
           return $res[$find_col];
        } else {
            return 0;
        }
    }
}

if (!function_exists('BannerUpload')){

    function BannerUpload($upload_path,$allowed_types,$file) {
        $ci =& get_instance();
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = $allowed_types;
        $ci->load->library('upload', $config);
        $ci->upload->initialize($config);
        
        if (!$ci->upload->do_upload($file)) {
            return array('status'=>0,'msg'=>$ci->upload->display_errors("<p class='inputerror'>","</p>"));        
        } else {
            $upload_data=$ci->upload->data();
            $img=$upload_data['file_name'];
            $img = uniqid(time()).$upload_data['file_ext'];
            rename($upload_data['full_path'], $upload_path.$img);
            return array('status'=>1,'image_path'=>$upload_path.$img);
        }
    }


}

if (!function_exists('user_username')){
    function user_username($id,$username){
        //get main CodeIgniter object
        $ci =& get_instance();
        if($ci->Common_model->getRecords('users', 'user_id', array('user_id!='=>$id,'username'=>$username), '', true)) {
            return 1;
        } else {
            return 0;
        }
    }
}



if (!function_exists('getCommaName')){
    function getCommaName($table_name,$ids,$get_column_name,$compare_column_name){
        //get main CodeIgniter object
        $ci =& get_instance();
    
        $record_array = array();
         $ids = explode(',', $ids);
         foreach ($ids as $key => $id) {
            $record =  $ci->Common_model->getRecords($table_name,"$get_column_name",array($compare_column_name=>$id,'is_deleted'=>0),'',true);
            if(!empty($record))
            { 
                $record_array[$key] = ucfirst($record[$get_column_name]);
            }
         }
         // echo "<pre>";print_r($record_array);die;
         if(!empty($record_array))
         {
            return implode(',',$record_array);      
         }else
         {
            return $record_array;
         } 
    }
}

if (!function_exists('check_permission')){
    function check_permission($section_id,$action,$redirect=''){
       
        $ci =& get_instance(); 
        $user_id = $ci->session->userdata('admin_id');
    

        if($admin_role_id = $ci->Common_model->getRecords('admin', 'role_id,user_type', array('admin_id='=>$user_id), '', true)) {
            if($a=$ci->Common_model->getRecords('role_permissions', '*', array('role_id='=>$admin_role_id['role_id'],'section_id'=>$section_id,$action=>'1'), '', true)) { 
           
                return true;
            }else{
              
                if($admin_role_id['user_type']!='Super Admin')
                {
                    if(!empty($redirect))
                    { 
                        redirect(base_url().'admin/not_authorized');
                    }else{
                        return false;
                    }   
                }else{
                    return true;
                }
            }  
        }  
    }
}

function getroles($parent_id = 0, $prefix='',$count=0,$select='',$full='')
{ 
    $ci =& get_instance();
    if($parent_id!=0){
        $prefix++;  
    }
    $type = $ci->session->userdata('user_type');
    if($type=='Super Admin'){
        $type='Admin';
    }

    $roles = $ci->Common_model->getRecords('roles','*',array('parent_id'=>$parent_id,'hide'=>'0','type'=>$type,'status'=>'Active'),'parent_id ASC',false);
    $role = '';
    $testing = 0;
    $countt= count($roles);
    if(count($roles) > 0) {
        foreach ($roles as $row) {
                  
            if($select==$row['role_id'])
            {
                $selected= 'selected';
            }else{
                $selected= '';
            }
            if($prefix < 2 || $full!=''){
                $role .= "<option ".$selected." value=".$row['role_id'].">  ";
                for($i=1;$i <=$prefix ;$i++){
                    $role .= " - ";
                    $count++;
                }
                $role .= ucfirst($row['name']);
                $role .= getroles($row['role_id'],$prefix,$count,$select,$full);
                $role .= "</option>";
            
            }
        }
    }
    return $role;
} 

if (!function_exists('filterData')){
 function filterData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
}

if (!function_exists('get_sub_role_id')){  
    function get_sub_role_id($parent_id = 0,$prefix=0)
    {
        $ci =& get_instance();
        $test='';
        if($parent_id!=0){
            $prefix++;  
        }
        $categories = $ci->Common_model->getRecords('roles','*',array('parent_id'=>$parent_id,'status'=>'Active','hide'=>'0'),'parent_id ASC',false); 
        if(count($categories) > 0) {
            foreach ($categories as $row) {
                $test .=','.$row['role_id'];    
                $test .=   get_sub_role_id($row['role_id'],$prefix); 
            }
        } 
        return $test;
    }
}


if (!function_exists('get_sidemenu')){
    function get_sidemenu()
    {
        $ci =& get_instance(); 
        $type = $ci->session->userdata('user_type');
        
        // $type='Admin';
        $menuarray=array();
        if($type=='Super Admin'){

            if($type=='Super Admin'){
                $type='Admin';
            }

            $sections = $ci->Common_model->getRecords('sections','*',array('type'=>$type,'status'=>'Active','flag'=>0),'',false); 
            if(count($sections) > 0) {
                $parentarr = array_filter($sections, function ($var) {
                    return ($var['parent_id'] == '0');
                });
                $keys = array_column($parentarr, 'sort_order');
                array_multisort($keys, SORT_ASC, $parentarr);

                foreach ($parentarr as $key => $value) 
                {
                    array_push($menuarray,$value);
                    $submenu = array_filter($sections, function ($var) use ($value) {
                        return ($var['parent_id'] == $value['id']);
                    });
                    $subkeys = array_column($submenu, 'sort_order');

                    array_multisort($subkeys, SORT_ASC, $submenu);
                    $menuarray[$key]['children']=$submenu;
                }
                
            } 
        }else{
            $check_section_id=1;

            $role_id = $ci->session->userdata('role_id');
            if(!$ci->Common_model->getRecords('role_permissions','view',array('role_id'=>$role_id,'section_id'=>$check_section_id,'view'=>1),'',true)){
                $sections1[]=array('id' => 253,
                            'role_id' =>  $role_id,
                            'section_id' => 1,
                            'add' => 1,
                            'edit' => 1,
                            'delete' => 1,
                            'view' => 1,
                            'created' => date('Y-m-d H:i:s'),
                            'modified' => date('Y-m-d H:i:s'),
                            'name' => 'Dashboard',
                            'parent_id' => 0,
                            'icon' => 'fa fa-dashboard',
                            'link' => 'admin/dashboard');
            }
            $ci->db->select('i.*,s.id as section_id,s.name,s.parent_id,s.icon,s.link');
            $ci->db->from('sections s');
            $ci->db->join('role_permissions i','s.id = i.section_id','left');       
            $ci->db->where('i.role_id',$role_id);
            $ci->db->where('i.view',1);
            $ci->db->where('s.type',$type);
            $ci->db->where('s.parent_id',0);
            $ci->db->where('s.status','Active');
            $ci->db->order_by('s.sort_order');
            $query = $ci->db->get();

            $sections= $query->result_array();
            if(isset($sections1) && !empty($sections1)){
              $sections=array_merge($sections1,$sections);  
            }
          
            foreach ($sections as $key => $value) {
                //array_push($menuarray,$value);
                $ci->db->select('i.*,s.id as section_id,s.name,s.parent_id,s.icon,s.link');
                $ci->db->from('sections s');
                $ci->db->join('role_permissions i','s.id = i.section_id','left'); 
                $ci->db->where('i.role_id',$role_id);
                $ci->db->where('i.view',1);
                $ci->db->where('s.type',$type);
                $ci->db->where('s.status','Active');
                $ci->db->where('s.parent_id',$value['section_id']);
                $ci->db->order_by('s.sort_order');
                $query = $ci->db->get();
                $subsections= $query->result_array();

                 if($value['link']=='javascript:void(0);'){
                    if(!empty($subsections)){
                        // array_push($menuarray,$value);
                        // $menuarray[$key]['children']=$subsections;
                        $value['children']=$subsections;
                        $menuarray[]=$value;
                    }
                }else{
                    array_push($menuarray,$value);
                }
            }
        }
       // echo "<pre>";
         //print_r($menuarray);
        //die;
        return $menuarray;
    }
}

if (!function_exists('configAjaxPagination')){
    function configAjaxPagination($total_records,$b_url,$selector,$per_page,$function) {
        $config['target']      = $selector;
        $config['base_url']    = $b_url;
        $config['total_rows']  = $total_records;
        $config['per_page']    = $per_page;
        $config['function']    = $function;
        $config["uri_segment"] = 4;
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = "<li class='active'><a href='javascript:void(0);'>";
        $config['cur_tag_close'] = '</a></li>';
        return $config;
        //$this->ajax_pagination->initialize($config);
    }
}

if (!function_exists('getSetting')){
    function getSetting($table,$field) {
        $ci =& get_instance();
        $getInfo = array();
        $getInfo = $ci->Common_model->getRecords($table,$field,'','',true);
        return $getInfo[$field];
    }
}
if (!function_exists('generateQrCode')){
    function generateQrCode($qr_code,$qr_image_name) {
        $ci =& get_instance();
        $ci->load->library('ciqrcode');
        // $qr_image_name=strtotime(date("Y-m-d H:i:s")).rand().'.png';
        $qr_image_path=QR_PATH.$qr_image_name;

        // $qr_array = array(
        //     "qr_code" => $qr_code
        // );

        // $qr_string = json_encode($qr_array);
        // $params['data'] = $qr_string;
        $params['data'] = $qr_code;
        $params['level'] = 'H';
        $params['size'] = 8;
        $params['savename'] = $qr_image_path;
        $qrcode_image = '';
        if($ci->ciqrcode->generate($params)) {
            
        }
        return $qr_image_path;
    }
}
// Function to create slug
if (!function_exists('create_slug_with_id')) {
    function create_slug_with_id($str,$id) {
        $str = trim($str);
        $encode_key = "57";
        $id = base64_encode($encode_key."_".$id);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
        $clean = $clean."-".$id;
        return $clean;
    }
}

// Function to create slug
if (!function_exists('create_slug')){
    function create_slug($str) {
        $str = trim($str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
        return $clean;
    }
}



function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ' : '';
}

if (!function_exists('getCitiesList')){
    function getCitiesList($state_id){
        //get main CodeIgniter object
        $ci =& get_instance();
        $res =array();
        if($state_id) {
           $res = $ci->Common_model->getRecords('cities','id,title',array('state_id'=>$state_id),'',false);
        }
        return $res;
    }
}
if (!function_exists('convertFromHoursToMinutes')){
    function convertFromHoursToMinutes($string)
    {
        //echo $string;
        // Separate hours from minutes
        $split = explode(':', $string);
      // print_r($split);
        // Transform hours into minutes
        $hoursToMinutes = $split[0] * 60;

        $total = $hoursToMinutes + (int)$split[1];

        return $total;
    }
}
if (!function_exists('DayCount')){
    function DayCount($day, $start, $end)
    {        
        //get the day of the week for start and end dates (0-6)
        $w = array(date('w', $start), date('w', $end));

        //get partial week day count
        if ($w[0] < $w[1])
        {            
            $partialWeekCount = ($day >= $w[0] && $day <= $w[1]);
        }else if ($w[0] == $w[1])
        {
            $partialWeekCount = $w[0] == $day;
        }else
        {
            $partialWeekCount = ($day >= $w[0] || $day <= $w[1]);
        }

        //first count the number of complete weeks, then add 1 if $day falls in a partial week.
        return floor( ( $end-$start )/60/60/24/7) + $partialWeekCount;
    }
}
if (!function_exists('hoursRange')){
    function hoursRange( $lower = 0, $upper = 86400, $step = 3600, $format = '' ) {
        $times = array();

        if ( empty( $format ) ) {
            $format = 'H:i';
        }

        foreach ( range( $lower, $upper, $step ) as $increment ) {
            $increment = gmdate( 'H:i', $increment );

            list( $hour, $minutes ) = explode( ':', $increment );

            $date = new DateTime( $hour . ':' . $minutes );

            $times[(string) $increment] = $date->format( $format );
        }

        return $times;
    }
}

function get_time_diffrence($date1,$date2,$type)
{
    $diff = abs(strtotime($date2) - strtotime($date1)); 

    $years   = floor($diff / (365*60*60*24)); 
    $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
    $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 

    $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

    $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 
    switch ($type) {
        case 'years':
            return $years;
            break;
        case 'months':
            return $months;
            break;
        case 'days':
            return $days;
            break;
        case 'hours':
            return $hours;
            break;
        case 'minuts':
            return $minuts;
            break;
        case 'seconds':
            return $seconds;
            break;
    }
}

function get_number_to_albhabet($number)
{
    $alpha='';
    foreach(explode('-', $number) as $num){
        $list=array('A' => 0,'B' => 1,'C' => 2,'D' => 3,'E' => 4,'F' => 5,'G' => 6,'H' => 7,'I' => 8,'J' => 9);
        
        $arr_num=str_split ($num);
        foreach($arr_num as $data)
        {
            $alpha.=array_search($data,$list);
        }
        $alpha.="-";
    }
    return rtrim($alpha,'-');
}

function get_albhabet_to_number($modal){
    $numb='';
    foreach(explode('-', $modal) as $str){
        $list=array(0 =>'A',1 => 'B',2 => 'C',3 => 'D',4 => 'E',5 => 'F',6 => 'G',7 => 'H',8 => 'I',9 => 'J');
        
        $arr_num=str_split ($str);
        foreach($arr_num as $data)
        {
            $numb.=array_search($data,$list);
        }
        $numb.="-";
    }
    return rtrim($numb,'-');

}

function get_albhabet_to_number_mask($modal){
    $numb='';
    foreach(explode('-', $modal) as $str){
        $list=array(0 =>'A',1 => 'B',2 => 'C',3 => 'D',4 => 'E',5 => 'F',6 => 'G',7 => 'H',8 => 'I',9 => 'J');
        
        $arr_num=str_split ($str);
        foreach($arr_num as $data)
        {
            $numb.=array_search($data,$list);
        }
        $numb.="-";
    }
    $numb=rtrim($numb,'-');
    return '***-**-'.substr($numb, -4);

}
//to get distance using latlong
function calculate_distance($lat1, $lon1, $lat2, $lon2, $unit='M') {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  $result=0;
  if ($unit == "K") {
      $result= ($miles * 1.609344);
  } else if ($unit == "N") {
      $result= ($miles * 0.8684);
  } else {
      $result= $miles;
  }
  return round($result,2);
}

function isDate($string) {
    $today=date('Y-m-d' ,strtotime("+ 1 day"));
    $check_date=date('Y-m-d',strtotime(str_replace('/','-', $string)));
    $matches = array();
    $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/';
   // $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/';
    if (!preg_match($pattern, $string, $matches)) return false;
    if (!checkdate($matches[2], $matches[1], $matches[3])) return false;
    if(strtotime($today) >= strtotime($check_date))return false;
    return true;
}
function display_output($status,$msg,$data=array()){

    $response =  array('status'=>$status,'msg'=>$msg);
    if(!empty($data)){
       $response= array_merge($response,$data);
    }
    echo json_encode($response); 
    exit;
}
function clear_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    //$data = htmlspecialchars($data);
    return $data;
}