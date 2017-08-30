<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * @author Azar
 * @Created Date: 25 May 2013
 * @Description: It is used to fetch the Admin users Data from the database
 * 
 */

class admin_user_model extends CI_Model {

        function __construct(){
            parent::__construct();
        }
/*
 * 
 * User managment
 */
 
 	function saveuserdata($arr)
	{
		$this->db->select("*");
		$this->db->from("sparity_admin_users");
		$this->db->where("admin_email",$arr['admin_email']);
		$query = $this->db->get();
		
		if($query->num_rows() == 0){
		$data = $arr;
		$this->db->insert('sparity_admin_users', $data); 
		return true;
		}
		else
		{
			return false;
		}
	}
	
	
	public function userlist() {
		$this->db->select("*");
		$this->db->from("sparity_admin_users");
		$query = $this->db->get();		
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function useredit($user_id)
	{		
		$this->db->select("*");
		$this->db->from("sparity_admin_users");
		$this->db->where('admin_id',$user_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return false;
			
		}
	}
	
	
	public function userupdate($arr)
	{
		 
		$this->db->select("*");
		$this->db->from("sparity_admin_users");
		$this->db->where("admin_email ='".$arr['admin_email']."'");
		$this->db->where("admin_id != ".$arr['admin_id']);
		$query = $this->db->get();
		if ($query->num_rows() >= 1)
		{
			return false;
		} else
		{
		$this->db->where('admin_id',$arr['admin_id']);
		$this->db->update("sparity_admin_users",$arr );
		return true;
		}
	}
	
	public function deleteuser($id) {
		 
		$this->db->where("admin_id",$id);
		$this->db->delete("sparity_admin_users");
		return true;
	}


/*
 * 
 * User managment
 */
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

	

	
   public function editform($id)
        {
        	$this->db->select("*");
        	$this->db->from("admin_users");
        	$this->db->where('admin_id',$id);
        	$query = $this->db->get();
        	if ( $query->result()) {
        		return $query->result();
        	} else {
        		return false;
        	}
        	
        }
 
/**
 * 
 * 
 */
    }
?>
