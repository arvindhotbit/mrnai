<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_model extends CI_Model {

    public function __construct()
    {
        parent:: __construct();
    }

    public function get_list($limit,$offset) {

        if($this->input->get('booking_no')){
            $first_name=$this->input->get('booking_no');
            $this->db->like("r.booking_no", trim($first_name));
        }
        if($this->input->get('category')){
            $category=$this->input->get('category');
            $this->db->where("b.category_id", trim($category));
        }
        if($this->input->get('mobile_no')){
            $mobile_no=$this->input->get('mobile_no');
            $this->db->like("u.phone_no", trim($mobile_no));
        }
        if($this->input->get('business')){
            $business=$this->input->get('business');
            $this->db->like("b.business_name", trim($business));
        }
        if($this->input->get('daterange')){
            $service_date=$this->input->get('daterange');
            $dates=explode(' - ',$service_date);
            $start_date=$dates[0];
            $array_date1 = explode("-", $dates[0]);  
            $fdate = $array_date1[1] . "-" . $array_date1[0] . "-" . $array_date1[2];
            $end_datee=$dates[1];
            $array_date2 = explode("-", $dates[1]);
            $edate = $array_date2[1] . "-" . $array_date2[0] . "-" . $array_date2[2];

            $this->db->where('date(r.created) >=', date('Y-m-d',strtotime($fdate)));
            $this->db->where('date(r.created) <=', date('Y-m-d',strtotime($edate)));
        }
        if($this->input->get('status')){
            $status=$this->input->get('status');
            $this->db->where('r.status',$status);
        }
        $sub=",b.business_name,bc.name as category,u.fullname,u.phone_no";
        $sub.=",(select name from states where id=b.state_id) as state";
        $sub.=",(select name from cities where id=b.city_id) as city";
        $sub.=",(select group_concat(service_name) from business_services where FIND_IN_SET(id,r.service_ids)) as services";
        $this->db->select('r.*'.$sub,false);
        $this->db->from('booking r');
        $this->db->join('business b','b.id=r.business_id');
        $this->db->join('business_category bc','bc.id=b.category_id');
        $this->db->join('users u','u.id=r.user_id');
        $this->db->order_by('r.id','desc');
        $this->db->limit($limit, $offset);
        $query=$this->db->get();

        if($limit==0 && $offset==0){ 
            return $query->num_rows();
        } else {
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else return false;
        }
    }

}//model end

?>