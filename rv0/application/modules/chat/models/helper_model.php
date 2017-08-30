<?php

class Helper_model extends CI_Model{

	
		
		public function get_all_helper($id)
		{
			$tenant = 'tenant_id IN ('.SESSION_TENENT_ID.')';
			$this->db->select("*");
			$this->db->from("users");
			$this->db->where('status',1);
			$this->db->where($tenant);
			//$this->db->where_in('1tenant_id',SESSION_TENENT_ID);
			$this->db->where('id !=',$id);		
			$query = $this->db->get();
		   if ( $query->result()) {
				return $query->result();
			} else {
				 
				return false;
			}
		}
		
		public function get_adminUsers_helper(){
			$tenant = 'tenant_id IN ('.SESSION_TENENT_ID.')';
			$this->db->select("*");
			$this->db->from("admin_users");
			//$this->db->where('status',1);
			$this->db->where($tenant);		
			$query = $this->db->get();
		   if ( $query->result()) {
				return $query->result();
			} else {
				 
				return false;
			}
		}
		
	
}
