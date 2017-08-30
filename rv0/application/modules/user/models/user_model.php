<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * @author Azar
 * @Created Date: 25 May 2013
 * @Description: It is used to fetch the Admin users Data from the database
 * 
 */

class user_model extends CI_Model {

        function __construct(){
            parent::__construct();
        }
/*
 * registration page
 * 
 */
 
   public function createUserAccount($arr)
	{  
	    $resp  = $this->db->insert('users',$arr);
		$userid = $this->db->insert_id(); 
		/*$userarr = array();
		$userarr['tenant_id'] = $userid;
		$this->db->where('id',$userid);
		$this->db->update("users",$userarr); */
		return $userid;
	}
	public function createUserRole($role){
		$resp  = $this->db->insert('user_role',$role);
		$roleid = $this->db->insert_id(); 
	}
	function getBranchesuserdata()
    {
	    //echo $session['user']['id'];exit; 
		
	    //$tent='id IN ('.SESSION_TENENT_ID.')'; 
         
		$session = $this->session->userdata('logged_in');
	  	$this->db->select("id,branch_name,course,passout_year,role");
		$this->db->from("users");
		//$CI->db->where($tent);
		$this->db->where('id',$session['user']['id']);
		//$CI->db->where("status",'1');
		$query = $this->db->get();
		//print_r($query->result());exit;
		if($query->result()){
			return $query->result();
		}else{
			return false;
	    }
	
}
	public function updatebranchdetails($arr){
		
	  $tent='tenant_id IN ('.SESSION_TENENT_ID.')';
	  $session = $this->session->userdata('logged_in');	
	  $this->db->where('id',$session['user']['id']);
	  $this->db->where($tent);
      $this->db->update("users",$arr);
	  return true;
		
		
	}
	
	public function getUserDateOfBirth(){
	    $this->db->select("id,dob,email,display_name,first_name,last_name,username");
		$this->db->from("users");
		//$this->db->where('dob!=','');
		//$CI->db->where("status",'1');
		$query = $this->db->get();
		//print_r($query->result());exit;
		if($query->result()){
			return $query->result();
		}else{
			return false;
	    }
		
	}
	public function getCouseNames($orgname){
		 
        
	  	$this->db->select("id,course");
		$this->db->from("organizations");
		$this->db->where('organizationName',$orgname);
		//$CI->db->where("status",'1');
		 $query = $this->db->get();
		//print_r($query->result());exit;
		if($query->result()){
			return $query->result();
		}else{
			return false;
	    }
		 
	}
	
	public function getUserNotificationCount($userid){
		 
		$this->db->select("id,notificationCount,email");
		$this->db->from("users");
        $this->db->where('status',1);		
		$query = $this->db->get();
	   if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
		 
	}
	public function UpdateUserNotificationCount($arr){
	  
      $this->db->where('id',$arr['id']);
      $this->db->update("users",$arr);
	  return true;
	}
	public function updateCampaignactivity($arr){
		$this->db->where('id',$arr['id']);
      $this->db->update("campaign",$arr);
	  return true;
	}
	public function getUserUpdateProfile(){
		 
		$this->db->select("id,registred_on,email,education_details");
		$this->db->from("users");
        $this->db->where('status',1);	
        $this->db->where('profileUpdate',0);		
		$query = $this->db->get();
	   if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
		 
	}
	public function userProfileUpdateNotification($arr){
		 $this->db->where('id',$arr['id']);
        $this->db->update("users",$arr);
	    return true;
	}
	
	public function getTemplatedata()
	{
		 
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("campaign_template"); 
		$this->db->where('type','account');
		$this->db->where($tent); 
		 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
		
	}
	
	 
	 
	public function isUserExists($user) {
		// echo SESSION_TENENT_ID;exit;
        $tenant_id= SESSION_TENENT_ID; 
        $this->db->select("*");
		$this->db->from("users"); 
		$custom_where = "(email='".$user['email']."' OR username='".$user['email']."') AND provider='rightlink'  AND password='".md5($user['pass'])."' AND  tenant_id IN(".$tenant_id.")"; 
	    $this->db->where($custom_where);  
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function isExists($user) {
		//$tenant_id= SESSION_TENENT_ID; 
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("users"); 
		$custom_where = "(email='".$user['email']."' OR username='".$user['username']."')"; 
		$this->db->where($custom_where); 
        $this->db->where($tent);		
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function isEmailExists($user,$id) {
		
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("users"); 
		$this->db->where('email',$user['email']);
		$this->db->where('id !=',$id);
		$this->db->where($tent); 
		 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function verifyEmailAfterLog($verifydata,$id)
	{
		              
					  $this->db->where('id',$id);
		              $this->db->update("users",$verifydata);
	}
	 public function email_verify2($email,$code) {
        $tent='tenant_id IN ('.SESSION_TENENT_ID.')';     
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("email",$email);  
		$this->db->where($tent); 
		$this->db->where("email_code",$code); 
		 
		
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{ 
			 $updatedata= array();
			 $updatedata['email_code'] = '';
			 $updatedata['email_verified'] = 1;
			 $updatedata['status'] = 1;
			 $this->db->where('email',$email);
			 $this->db->where($tent); 
		     $this->db->update("users",$updatedata ); 
		     return $query->result();
		} else {
			 
			return false;
		}
	}
	public function mobile_verify2($id,$code,$mobile) {
		
        $tent='tenant_id IN ('.SESSION_TENENT_ID.')';      
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("id",$id);  
		$this->db->where($tent); 
		$this->db->where("sms_code",$code); 
		 
		
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{ 
			 $updatedata= array();
			 $updatedata['mobile'] = $mobile;
			 $updatedata['sms_code'] = '';
			 $updatedata['sms_verified'] = 1;
			 $this->db->where('id',$id);
		     $this->db->update("users",$updatedata ); 
		     return $query->result();
		} else {
			 
			return false;
		}
	}
	public function email_verify($email,$code) {
        $tent='tenant_id IN ('.SESSION_TENENT_ID.')';      
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("email",$email);  
		$this->db->where($tent); 
		//$this->db->where("password",md5($user['pass']));
		
		$query = $this->db->get();
		if ($query->num_rows() > 0)
			 {
			 $userdata = $query->result(); 
			 if($userdata[0]->status=='1')
			 {
				   
					   
					 /* $arr = array();
					  if($userdata[0]->email_verified !=1) 
					  {
						  $arr['email_verified'] = '1';
						  $arr['activation_code']='';
						  $arr['last_updated_on'] = date('Y-m-d H:i:s');
						  $this->db->where('id',$userdata[0]->id);
						  $this->db->update("users",$arr );
						  
		              $userdata[0]->email = $email; 
		              $userdata[0]->redirect = 'email_verified';
		              return $userdata[0];
		              }else*/
		              return "active";
		              
				  
				  
				   
			 }else if($userdata[0]->status=='4')
			 {
				   return "suspend";
				   
			 }else if($userdata[0]->status=='0' && $userdata[0]->activation_code=='')
			 {
				   return "expired";
			 }else
			 {
				  
				   if($userdata[0]->status=='0' && $userdata[0]->activation_code==$code)
				  {
					   
					  $arr = array();
					  $arr['status'] = '1';
					  $arr['email_verified'] = '1';
					  $arr['activation_code']='';
					  $arr['last_updated_on'] = date('Y-m-d H:i:s');
					  $this->db->where('id',$userdata[0]->id);
		              $this->db->update("users",$arr );
		              return $userdata[0];
					  
				  }
				  
			 }
			 
			 
		} else {
			 
			return false;
		}
	}
	/*public function emailExist($user) {
               
		$this->db->select("id,firstName,lastName");
		$this->db->from("users");
		$this->db->where("email",$user['email']);
		 
		 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}*/
	public function user($id) {
               
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("id",$id); 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	
	 
	public function savechangepassword($arr){
		$tenant_id= SESSION_TENENT_ID; 
	    $this->db->select("*");
		$this->db->from("users");
		$custom_where = "(email='".$arr['user_email']."' OR username='".$arr['user_email']."') AND provider='rightlink' AND  status IN('0','1') AND tenant_id='".$tenant_id."'";  
		$this->db->where($custom_where);  
		$query = $this->db->get();
		 
		if ($query->num_rows() >= 1)
		{ 
			$userdata = $query->result();
			 
			$brr = array();
			$brr['password'] = $arr['user_password']; 
			$brr['activation_code'] = ''; 
			$this->db->where('id',$userdata[0]->id);
		    $this->db->update("users",$brr );
			return $userdata[0];
		}else
		return false;
		
		
	}
	public function updatePassword($arr,$old){
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
	    $this->db->select("*");
		$this->db->from("users");
		$this->db->where("password",$old);
		$this->db->where("provider","rightlink");
		$this->db->where($tent);
		$this->db->where("id",$arr['id']);
		$query = $this->db->get(); 
		 
		if ($query->num_rows() >= 1)
		{
			 
			$this->db->where('id',$arr['id']);
		    $this->db->update("users",$arr );
			return true;
		}else
		return false;
		
		
	}
	public function profileupdate($arr){
		 
		 
		 
		$this->db->where('id',$arr['id']);
		$this->db->update("users",$arr ); 
		return true;
	}
	
	public function update_lastaccess($arr)
	{
		$this->db->where('id',$arr['id']);
		$this->db->update("users",$arr ); 
		return true;
	}
	public function getFirstLogin($userId){
		//$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("id");
		$this->db->from("log_activity");
		$this->db->where("user_id",$userId);
		//$this->db->where($tent);
		$this->db->where("action_type","login");
		$query = $this->db->get();
		if ($query->result()) {
			return 0;
		} else {
			return 1;
		}
		
	}
	
	public function skipwizard($id)
	{
		 
		        $arr = array();
		        $arr['wizard'] = 1;
		 		$this->db->where('id',$id);
		        $status = $this->db->update("users",$arr );  
		        return $status;
		
	}
	
	 public function Getuserpasswordstatus($id) { 
		$this->db->select("changepassword");
		$this->db->from("users");
		$this->db->where("id",$id);
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function Passwordstatus($id,$changpass){
		$this->db->where('id',$id);
		$this->db->update("users",$changpass );
	}
	public function getImageSearch($arr){
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("alumni_images");
		$this->db->where("tenant_id",'237');
		//$this->db->where($tent);
		if(isset($arr['search']) &&  $arr['search'] !=''){
			
			$custom_where = "(Name LIKE '%".$arr['search']."%'  OR hallTicketNumber LIKE '%".$arr['search']."%')"; 
		    $this->db->where($custom_where);
			
		}
		if(isset($arr['ID']) &&  $arr['ID'] !=''){
			$this->db->where("ID <",$arr['ID']);
		}
		$this->db->order_by("ID","DESC");
		$this->db->LIMIT(10);
		$query = $this->db->get();
		if ( $query->num_rows()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function getAdminUsers(){
		$tenant = 'tenant_id IN ('.SESSION_TENENT_ID.')';
			$this->db->select("*");
			$this->db->from("admin_users");
			//$this->db->where('status',1);
			//$this->db->where('id',$id);	
			$this->db->where($tenant);
			$query = $this->db->get();
		   if ( $query->result()) {
				return $query->result();
			} else {
				 
				return false;
			}
	}
	public function chatWelcomemeaage($chat){
		$resp  = $this->db->insert('messages',$chat);
		$chatid = $this->db->insert_id(); 
		return $chatid;
	}
	public function checkOrgactivity($sql){
		
		$query = $this->db->get($sql);
		print_r($query->result());exit;
	}
	public function getAlumnidata(){
		$tenant = 'tenant_id IN ('.SESSION_TENENT_ID.')';
			$this->db->select("ID,interestName");
			$this->db->from("user_interest");
			$this->db->where('interest_status',1);
			//$this->db->where('id',$id);	
			$this->db->where($tenant);
			$query = $this->db->get();
		   if ( $query->result()) {
				return $query->result();
			} else {
				 
				return false;
			}
	}
	public function updateUserRole($role,$roleid){
		$tenant= 'role_id IN ('.$roleid.')';
		$this->db->select("RID");
		$this->db->from("user_role");
		$this->db->where('user_id',$role['user_id']);
		$this->db->where($tenant);
		$query = $this->db->get();
		//print_r($query->result());exit;
		if($query->result()){
			$this->db->where('user_id',$role['user_id']);
			$this->db->update("user_role",$role);
			return true;
		}else{
			$resp  = $this->db->insert('user_role',$role);
		}
		
	}
	public function getBranchID($bname){
		$this->db->select("ID");
		$this->db->from("organizations");
		//$CI->db->where($tent);
		$this->db->where('organizationName',$bname);
		//$CI->db->where("status",'1');
		$query = $this->db->get();
		//print_r($query->result());exit;
		if($query->result()){
			return $query->result();
		}else{
			return false;
	    }
	}
	public function getRoleID($id){
		$this->db->select("role_id,tenant_id");
			$this->db->from("user_role");
			//$this->db->where('status_id',1);
			$this->db->where('user_id',$id);	
			//$this->db->where($tenant);
			$query = $this->db->get();
		   if ( $query->result()) {
				return $query->result();
			} else {
				 
				return false;
			}
	}
	public function getRoleDelete($uid,$rid){
		$this->db->where('user_id', $uid);
		$this->db->where('role_id', $rid);
      $this->db->delete('user_role'); 
		
		return true;
	}
	public function deleteUserInterest($id){
		$this->db->select("tenant_id");
		$this->db->from("user_interest_assign");
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		if($query->result()) {
			$this->db->where('user_id', $id);
			$this->db->delete('user_interest_assign'); 
			return $query->result();
		}else{
			return true;
		}
		
	}
	public function createUserInterest($arr){
		$resp  = $this->db->insert('user_interest_assign',$arr);
		return true;
	}
	public function getInterest($id){
		$this->db->select("interestId");
		$this->db->from("user_interest_assign");
		$this->db->where('user_id',$id);	
		$query = $this->db->get();
		if($query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	 
    }
?>
