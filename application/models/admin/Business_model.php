<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Business_model extends CI_Model {

    public function __construct()
    {
        parent:: __construct();
    }

    public function get_list($limit,$offset) {

        if($this->input->get('name')){
            $first_name=$this->input->get('name');
            $this->db->like("U.fullname", trim($first_name));
        }
        if($this->input->get('business_name')){
            $first_name=$this->input->get('business_name');
            $this->db->like("U.business_name", trim($first_name));
        }
        
        if($this->input->get('phone_no')){
            $contact_phone_no=$this->input->get('phone_no');
            $this->db->like("U.phone_no", trim($contact_phone_no));
        }
        
        if($this->input->get('status')){
            $admin_approval=$this->input->get('status');
            $this->db->where('U.status',$admin_approval);
        }
        $sub=",(select count(id) from booking where business_id=U.id) as bookings";
        // $sub.=",(select name from country where id=U.country_id) as country";
        $sub.=",(select name from states where id=U.state_id) as state";
        $sub.=",(select name from cities where id=U.city_id) as city";

        $this->db->select('U.*,c.name as category'.$sub,false);
        $this->db->from('business U');
        $this->db->join('business_category c','c.id=U.category_id','left');
        $this->db->where('U.is_deleted',0);
        $this->db->order_by('U.id','desc');
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
    public function get_business_info($id) {
        $this->db->select('U.*');
        $this->db->from('business U');
        $this->db->where('U.id',$id);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else return false;
        
    }

}//model end

?>