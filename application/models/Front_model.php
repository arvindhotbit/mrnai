<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_model extends CI_Model {
     
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

	
    public function getbusiness_list(){
        $lat  = trim($this->input->get('lat')); 
        $long = trim($this->input->get('long')); 
        $page=trim($this->input->get('page'));
        $category_id=trim($this->input->get('category'));
        $keyword=trim($this->input->get('keyword'));
        if(!$page){
            $page=0;
        }
        if($page==1){
            $page=0;
        }
        $limit=20;
        $offset=$limit*$page;

        if(empty($lat)){
            $lat="22.739361";
        }
        if(empty($long)){
            $long="75.885017";
        }

        $where=" where b.is_deleted=0 and b.status='Active' and b.business_name!=''";
        if(!empty($category_id)){
            $where.=" and b.category_id=".$category_id;
        }
        if(!empty($keyword)){
            $where.=" and (";
            $where.=" b.business_name like '%".$this->db->escape_str($keyword)."%'";
            $where.=" or b.address like '%".$this->db->escape_str($keyword)."%'";
            $where.=" or b.phone_no like '%".$this->db->escape_str($keyword)."%'";
            $where.=" )";
        }
        $sql="SELECT
            b.fullname,b.business_name,b.is_live,b.slug,b.views,cat.name as category,b.address,b.logo, (
              6373 * acos (
              cos ( radians(`lat`) )
              * cos( radians( ".$lat." ) )
              * cos( radians( ".$long." ) - radians(`long`) )
              + sin ( radians(`lat`) )
              * sin( radians( ".$lat." ) )
            )
        ) AS distance
        FROM business b
        LEFT JOIN business_category cat on cat.id=b.category_id
        $where HAVING distance < 25
        ORDER BY distance 
        LIMIT $offset, $limit";
        //HAVING distance < 20
        $query=$this->db->query($sql);
        // echo $this->db->last_query();die;

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else return false;
    }

    public function getbusiness_detail($slug){

        $where=" where b.is_deleted=0 and b.status='Active'";
        if(!empty($slug)){
            $where.=" and b.slug='".$this->db->escape_str($slug)."'";
        }
        $sql="SELECT b.id,
            b.fullname,b.business_name,b.is_live,b.slug,b.views,cat.name as category,b.address,b.logo
              
        FROM business b
        LEFT JOIN business_category cat on cat.id=b.category_id
        $where
        
        LIMIT 1";
        $query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else return false;
    }

    public function getBusinessServices($id){
        $sql="select w.id window_id,w.window_name,group_concat(bs.service_name) as services";
        $sql.=" from business_window w";
        $sql.=" inner join business_services bs on bs.window_id=w.id";
        $sql.=" where w.is_deleted=0 and bs.is_deleted=0";
        $sql.=" and w.business_id=".$id;
        $sql.=" and bs.business_id=".$id;
        $sql.=" group by w.id";
        $sql.=" order by w.id";
        $query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else return false;
    }

    public function checkBusinessServices($id,$services){

        $this->db->select('bs.id');
        $this->db->from('business_window w');
        $this->db->join('business_services bs','bs.window_id=w.id');
        $this->db->where('w.is_deleted',0);
        $this->db->where('bs.is_deleted',0);
        $this->db->where('w.business_id',$id);
        $this->db->where('bs.business_id',$id);
        $this->db->where_in('bs.id',$services);

        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else return false;
    }

    public function user_booking_list($id){

        $this->db->select('bk.id,bk.seat_no,b.fullname,b.business_name,b.logo,b.slug,b.address,bc.name as category,bw.window_name');
        $this->db->from('booking bk');
        $this->db->join('business b','b.id=bk.business_id');
        $this->db->join('business_category bc','b.category_id=bc.id');
        $this->db->join('business_window bw','bw.id=bk.window_id');
        $this->db->where('bk.user_id',$id);
        $this->db->where_in('bk.status',array('Pending','Confirm','Hold','In-Progress'));
        $this->db->where('date(bk.created)',date('Y-m-d'));

        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else return false;
    }

    public function alotSeatNo($business_id,$window_id,$booking_id){
        $whrmax=array('business_id'=>$business_id,'window_id'=>$window_id,'date(created)'=>date('Y-m-d'));
        $maxcnt = $this->Common_model->getRecords('booking','count(id) as counts',$whrmax,'id DESC',true);
        $this->Common_model->addEditRecords('booking',array('seat_no'=>$maxcnt['counts']),array('id'=>$booking_id));
    }

    public function get_window_booking_list($id){

        $sub="(select group_concat(service_name) from business_services where find_in_set(id,bk.service_ids)) as services";
        $this->db->select('bk.id,bk.status,bk.seat_no,bk.serve_time,u.id as user_id,u.phone_no,u.fullname,u.profile_pic,u.device_token,'.$sub);
        $this->db->from('booking bk');
        $this->db->join('business_window bw','bw.id=bk.window_id');
        $this->db->join('users u','u.id=bk.user_id');
        $this->db->where('bk.window_id',$id);
        $this->db->where_in('bk.status',array('Pending','Confirm','Hold','In-Progress'));
        $this->db->where('date(bk.created)',date('Y-m-d'));
        $this->db->order_by('bk.seat_no','asc');
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else return false;
    }

    public function getServicesTime($ids){

        $this->db->select('sum(bs.service_time) as totaltime');
        $this->db->from('business_window w');
        $this->db->join('business_services bs','bs.window_id=w.id');
        $this->db->where_in('bs.id',$ids);

        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            $r=$query->row_array();
            return $r['totaltime'];
        } else return 0;
    }

    public function getTotalBooking($id,$type){

        $this->db->select('count(id) as total');
        $this->db->from('booking');
        $this->db->where('business_id',$id);
        // $this->db->where_in('status',array('Pending','Confirm','Hold','In-Progress'));
        if($type=='month'){
            $this->db->where('year(created)',date('Y'));
            $this->db->where('month(created)',date('m'));
            $this->db->where('status','Completed');
        }
        if($type=='total'){
            $this->db->where('status','Completed');
        }

        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            $r=$query->row_array();
            return $r['total'];
        } else return 0;
    }

    public function getBusinessQuestions($id){

        $this->db->select('sq.*,bsq.answer');
        $this->db->from('security_question sq');
        $this->db->join('business_security_question bsq','bsq.question_id=sq.id');
        $this->db->where_in('bsq.business_id',$id);

        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else return false;
    }
    
    /*================================ Generate Random String ============================*/
    public function generateRandomString($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}


