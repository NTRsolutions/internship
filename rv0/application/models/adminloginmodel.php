<?php
class adminLoginmodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Login admin user
	 * @param unknown_type $username
	 * @param unknown_type $password
	 * @return boolean
	 */
	function loginAdmin($username, $password)
	{
		$this->db->select("*");
		$this->db->from("admin_users");
		$this->db->where("admin_email", $username);
		$this->db->where("admin_pass", md5($password));
		$this->db->where("admin_status", "1");
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if ( $query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	/**
	 * 
	 * @return boolean
	 */
	function userslist()
	{
		$this->db->select("*");
		$this->db->from("admin_users");
		$this->db->where("admin_status", "1");
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function userslistcount()
	{
		$this->db->select("count(*) as countn");
		$this->db->from("admin_users");
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function examscount()
	{
		$this->db->select("count(*) as countn");
		$this->db->from("skills_exam");
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function categorycount()
	{
		$this->db->select("count(*) as countn");
		$this->db->from("skills_category");
		$query =$this->db->get();
		if($query->result())
		{
			return $query->result();
		}else{
		    return false;
		}
	}
	
	function questionscount()
	{
	$this->db->select("count(*) as countn");
	$this->db->from("skills_question");
	$query =$this->db->get();
	if($query->result())
	{
		return $query->result();
	}else{
		return false;
	}
	}
	
	function changepass($arr)
	{		
		$temp=$this->session->userdata('scms_admin_users');
		$admin_id = $temp->admin_id;
		$this->db->select("*");
		$this->db->from("sparity_admin_users");
		$this->db->where("admin_pass",$arr['oldpass']);
		
		$this->db->where("admin_id",$admin_id);
		$query = $this->db->get();
		if($query->num_rows() == 1){
			$dataFields = array('admin_pass'=>$arr['cpass']);
			$this->db->where("admin_id",$admin_id);
			$this->db->update("sparity_admin_users",$dataFields );
			return true;
		}else{
				
			return false;
		}
	}
	

	
	function saveupdateprofile1($arr)
	{
		$temp = $this->session->userdata('scms_admin_users');
		$admin_id=$temp->admin_id;
		$datafields=$arr;
		$this->db->where("admin_id", $admin_id);
		$this->db->update('admin_users',$datafields);
		$temp->admin_img = $arr['admin_img'];
		$temp1 = $this->session->set_userdata('scms_admin_users', $temp);
		$temp = $this->session->userdata('scms_admin_users');
		return true;		
	}
	
	
	function adminsetting($jdata)
	{
		$temp=$this->session->userdata('scms_admin_users');
		$admin_id=$temp->admin_id;
		$datafields=array('admin_settings'=>$jdata);
		$this->db->where("admin_id", $admin_id);
		$this->db->update('admin_users',$datafields);
		return true;
		
	}
	

}
