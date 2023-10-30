<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent:: __construct();
    }

    public function get_user_list($limit,$offset) {

        if($this->input->get('name')){
            $first_name=$this->input->get('name');
            $this->db->like("U.fullname", trim($first_name));
        }
        
        if($this->input->get('phone_no')){
            $contact_phone_no=$this->input->get('phone_no');
            $this->db->like("U.phone_no", trim($contact_phone_no));
        }
        
        if($this->input->get('status')){
            $admin_approval=$this->input->get('status');
            $this->db->where('U.status',$admin_approval);
        }
        // $sub.=",(select count(id) from orders where user_id=U.id and status='Pending'  and is_deleted=0) as pending_orders";
        $this->db->select('U.*',false);
        $this->db->from('users U');
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
    public function get_user_info($id) {
        $this->db->select('U.*');
        $this->db->from('users U');
        $this->db->where('U.id',$id);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else return false;
        
    }

}//model end

?>