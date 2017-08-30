<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * @author Azar
 * @Created Date: 25 May 2013
 * @Description: It is used to fetch the Admin users Data from the database
 * 
 */

class message_model extends CI_Model {


	 

	function __construct() {
		parent::__construct();
	}

	function get_message($id) {
		$tenant_id= SESSION_TENENT_ID;       
		$this->db->select("*");
		$this->db->from("whd_message");  
		$this->db->where("messageID",$id);  
		$this->db->where_in("tenant_id",$tenant_id);
		$query = $this->db->get();    
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
		 
	}

	function get_recivers($notuser) {
		$tenant_id= SESSION_TENENT_ID;       
		$this->db->select("*");
		$this->db->from("whd_users");  
		$this->db->where("status","1"); 
		$this->db->where("id !=",$notuser); 
		$this->db->where_in("tenant_id",$tenant_id);   
		 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
		
		 
		 
	}
	function get_admin_recivers() {
		$tenant_id= SESSION_TENENT_ID;       
		$this->db->select("*");
		$this->db->from("whd_admin_users");  
		$this->db->where("status","1"); 
		//$this->db->where("id !=",$notuser); 
		$this->db->where_in("tenant_id",$tenant_id);   
		 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
		
		 
		 
	}
	function get_admin_select($id) {
		$tenant_id= SESSION_TENENT_ID;       
		$this->db->select("*");
		$this->db->from("whd_admin_users");  
		$this->db->where("status","1"); 
		$this->db->where("id",$id); 
		$this->db->where_in("tenant_id",$tenant_id);   
		 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
		
		 
		 
	}

	function get_order_by_message($array=NULL) {
		 
		
		$tenant_id= SESSION_TENENT_ID;       
		$this->db->select("*");
		$this->db->from("whd_message");  
		$this->db->where($array); 
		$this->db->where_in('tenant_id',$tenant_id);   
		$this->db->order_by('messageID','DESC');   
		 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
		
		return $query;
	}
	function get_trash_message($email, $userID) {
		$tenant_id= SESSION_TENENT_ID;       
		$where = "((email = '$email' AND to_status = 1) OR (userID = $userID AND from_status = 1)) AND tenant_id IN(".$tenant_id.")";
		$this->db->where($where);
		//$this->db->where('tenant_id',$tenant_id); 
		$this->db->order_by('messageID','DESC');
		$query = $this->db->get('message');
		return $query->result();
	}


	function insert_message($array) {
		 
		$array['tenant_id'] = TENENT_ID;
		$resp  = $this->db->insert('message',$array); 
		return TRUE;
	}

	function update_message($data, $id = NULL) { 
		$this->db->where('messageID',$id);
		$this->db->update("message",$data);  
		return $id;
	}

	public function delete_message($id){
		parent::delete($id);
	}

	public function counter($array=NULL)
	{
		$tenant_id= SESSION_TENENT_ID;       
		$this->db->select("*");
		$this->db->from("message");  
		$this->db->where($array); 
		$this->db->where_in('tenant_id',$tenant_id);  
		$query = $this->db->get(); 
		return count($query->result()); 
	}
	public function getUser($uname)
	{
		$tenant_id= SESSION_TENENT_ID;       
		$this->db->select("profile_thumb_image,id,first_name,last_name,display_name,email");
		$this->db->from("users");  
		$this->db->where('id',$uname); 
		$this->db->where_in('tenant_id',$tenant_id);  
		$query = $this->db->get(); 
		$userdata =   $query->result();
		return  $userdata[0]; 
	}
	
	public function getadminUser($uname)
	{
		$tenant_id= SESSION_TENENT_ID;     
		$this->db->select("admin_users.*");
		$this->db->from("admin_users");  
		//$this->db->join('organizations', 'organizations.ID = admin_users.tenant_id', 'left');
		$this->db->where('admin_users.id',$uname); 
		$this->db->where_in('admin_users.tenant_id',$tenant_id);  
		$query = $this->db->get(); 
		$userdata =   $query->result();
		return  $userdata[0]; 
	}
	
          
    }
?>
