<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * @author Azar
 * @Created Date: 25 May 2013
 * @Description: It is used to fetch the Admin users Data from the database
 * 
 */

class connections_model extends CI_Model {

        function __construct(){
            parent::__construct();
        }
/*
 * registration page
 * 
 */
 
   public function GetallConnections($limit, $start, $search=array())
	{  
	    $status = array('0','1');
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("id,display_name,profile_thumb_image,passout_year,branch_name,course,last_accessed_on");
		$this->db->from("users");
		$this->db->where_in("status",$status);
		$this->db->where($tent);
		//$this->db->where("profile_thumb_image !=''"); 
	   $this->db->order_by("last_accessed_on","DESC");
		//$this->db->order_by("id","DESC"); 
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		if ($query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function GetallConnectionscount()
	{  
	    $status = array('0','1');
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("id");
		$this->db->from("users");
		$this->db->where_in("status",$status);
		$this->db->where($tent);
		//$this->db->where("profile_thumb_image !=''"); 
		 $this->db->order_by("last_accessed_on","DESC");
		 //$this->db->order_by("id","DESC"); 
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function Getconnectiondetails($id) {
		$status = array('0','1','3','5');
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where_in("status",$status);
		$this->db->where($tent); 
		$this->db->where("id",$id); 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function Gethomeconnections()
	{
		$status = array('0','1');
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("id,display_name,profile_thumb_image,profile_image");
		$this->db->from("users"); 
		$this->db->where_in('status', $status);
		$this->db->where($tent); 
		$this->db->where("profile_thumb_image !=''"); 
		$this->db->order_by("last_accessed_on","DESC");
		$this->db->limit(8);
		$query = $this->db->get();
		return $query->result();
	}
	public function GetUserCount()
	{
		 
		$status = array('0','1');
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("id");
		$this->db->from("users"); 
		$this->db->where($tent); 
		$this->db->where_in('status', $status);
		//$this->db->order_by("last_accessed_on","DESC");
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function homeUserCount()
	{
		 
		$status = array('0','1','3','5');
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("id");
		$this->db->from("users"); 
		$this->db->where($tent); 
		$this->db->where_in('status', $status);
		//$this->db->order_by("last_accessed_on","DESC");
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function Getsearchcount($search) 
	{
		$status = array('0','1');
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("id");
		$this->db->from("users");
		$this->db->where($tent); 
		 
		$this->db->where_in("status",$status);
		
		if(isset($search['searchname']) &&  $search['searchname'] !=''){
			
			$custom_where = "(passout_year LIKE '%".$search['searchname']."%'  OR first_name LIKE '%".$search['searchname']."%' OR last_name LIKE '%".$search['searchname']."%' OR display_name LIKE '%".$search['searchname']."%' OR username LIKE '%".$search['searchname']."%'OR branch_name LIKE '%".$search['searchname']."%'OR course LIKE '%".$search['searchname']."%')"; 
		    $this->db->where($custom_where);
			$this->db->order_by("id","DESC");
		} else{
			if(!isset($search['filter']))
			$this->db->order_by("id","DESC");
		}
		
		if(isset($search['filter']) &&  $search['filter'] !='' && $search['filter']=='alphabetical'){
			$this->db->order_by("display_name","ASC");
		}
		if(isset($search['filter']) &&  $search['filter'] !='' && $search['filter']=='active'){
			$this->db->order_by("registred_on","DESC");
		}
		
		$query = $this->db->get();
		if ( $query->num_rows()) {
			return $query->num_rows();
		} else {
			 
			return false;
		}
	}
	public function Getsearch($limit, $start, $search=array())
	{
			 			
		$status = array('0','1');
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("id,display_name,profile_thumb_image,passout_year,branch_name,course,last_accessed_on");
		$this->db->from("users");
		$this->db->where($tent);  
		$this->db->where_in("status",$status);
		
		if(isset($search['searchname']) &&  $search['searchname'] !=''){
			 
		    $custom_where = "(passout_year LIKE '%".$search['searchname']."%'  OR first_name LIKE '%".$search['searchname']."%' OR last_name LIKE '%".$search['searchname']."%' OR display_name LIKE '%".$search['searchname']."%' OR username LIKE '%".$search['searchname']."%' OR branch_name LIKE '%".$search['searchname']."%'OR course LIKE '%".$search['searchname']."%')"; 
		    $this->db->where($custom_where);
			$this->db->order_by("id","DESC");
		} else{
			if(!isset($search['filter']))
			$this->db->order_by("id","DESC");
		}
		if(isset($search['filter']) &&  $search['filter'] !='' && $search['filter']=='alphabetical'){
			$this->db->order_by("display_name","ASC");
		}
		if(isset($search['filter']) &&  $search['filter'] !='' && $search['filter']=='active'){
			$this->db->order_by("last_accessed_on","DESC");
		}
		
		$this->db->limit($limit, $start);
		$query = $this->db->get();
    	if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function getActivities($userid){
		
		$sql = "(SELECT site_activity.id,site_activity.action_type,site_activity.user_id,site_activity.action_item_id,site_activity.activity_title,site_activity.activity_content,site_activity.date_time,users.profile_thumb_image as profile_thumb_image,users.display_name FROM whd_site_activity as site_activity 
				LEFT JOIN whd_users as users ON users.id = site_activity.user_id 
				WHERE site_activity.tenant_id IN ('".SESSION_TENENT_ID."') AND site_activity.user_id= '".$userid."' AND site_activity.action_type = 'post'  AND site_activity.status='1' )

				UNION

				(SELECT site_activity.id,site_activity.action_type,site_activity.user_id,site_activity.action_item_id,site_activity.activity_title,site_activity.activity_content,site_activity.date_time,admin_users.profile_image as profile_thumb_image,admin_users.display_name  FROM whd_site_activity as site_activity 
				LEFT JOIN whd_admin_users as admin_users ON admin_users.id =  site_activity.user_id  
				WHERE site_activity.tenant_id IN ('".SESSION_TENENT_ID."') AND site_activity.user_id= '".$userid."' AND site_activity.action_type IN('news','event')  AND site_activity.status='1' ) order by id DESC LIMIT 5  ";
	 		 
		 $query =  $this->db->query($sql); 
		 
		 
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function loadactivities($id,$uid){
 
	 
		$sql = "(SELECT site_activity.id,site_activity.action_type,site_activity.user_id,site_activity.action_item_id,site_activity.activity_title,site_activity.activity_content,site_activity.date_time,users.profile_thumb_image as profile_thumb_image,users.display_name FROM whd_site_activity as site_activity 
				LEFT JOIN whd_users as users ON users.id = site_activity.user_id 
				WHERE site_activity.tenant_id IN ('".SESSION_TENENT_ID."') AND site_activity.user_id= '".$uid."' AND site_activity.action_type = 'post' AND  site_activity.id < ".$id." AND site_activity.status='1' )

				UNION

				(SELECT site_activity.id,site_activity.action_type,site_activity.user_id,site_activity.action_item_id,site_activity.activity_title,site_activity.activity_content,site_activity.date_time,admin_users.profile_image as profile_thumb_image,admin_users.display_name  FROM whd_site_activity as site_activity 
				LEFT JOIN whd_admin_users as admin_users ON admin_users.id =  site_activity.user_id  
				WHERE site_activity.tenant_id IN ('".SESSION_TENENT_ID."') AND site_activity.user_id= '".$uid."' AND site_activity.action_type IN('news','event') AND  site_activity.id < ".$id."  AND site_activity.status='1' ) order by id DESC LIMIT 5  ";
	 		 
		 $query =  $this->db->query($sql);
		 
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function GetallOurfaculty($arr, $limit, $start, $search=array())
	{  
	   // $status = array('0','1');
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("id,display_name,profile_thumb_image,passout_year,branch_name,course,last_accessed_on");
		$this->db->from("users");
		$this->db->where("status",$arr['status']);
		$this->db->where($tent);
		//$this->db->where("profile_thumb_image !=''"); 
	   $this->db->order_by("last_accessed_on","DESC");
		//$this->db->order_by("id","DESC"); 
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		if ($query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function GetallOurfacultycount($arr)
	{  
	   // $status = array('0','1');
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("id");
		$this->db->from("users");
		$this->db->where("status",$arr['status']);
		$this->db->where($tent);
		//$this->db->where("profile_thumb_image !=''"); 
		 $this->db->order_by("last_accessed_on","DESC");
		 //$this->db->order_by("id","DESC"); 
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function GetconnectionRolenames($val){
		if($val!=''){
			$tent='id IN ('.$val.')';
			$this->db->select("name");
			$this->db->from("user_roles");
			$this->db->where("status_id",1);
			$this->db->where($tent);
			
			$query = $this->db->get();
			if ($query->result()) {
				return $query->result();
			} else {
				 
				return false;
			}
		}else{
			return false;
		}
	}
	public function getPageinfo($val){
		$tent='tenantID IN ('.SESSION_TENENT_ID.')';
		$this->db->select("description");
		$this->db->from("pages");
		$this->db->where("pageTitle",$val);
		$this->db->where("page_status",1);
		$this->db->where($tent);
		//$this->db->where("profile_thumb_image !=''"); 
		 //$this->db->order_by("last_accessed_on","DESC");
		 //$this->db->order_by("id","DESC"); 
		$query = $this->db->get();
		return $query->result();
	}
	public function getAlumniinfo($val){
		$this->db->select("users.id,users.display_name,users.profile_thumb_image,users.passout_year,users.branch_name,users.course,users.last_accessed_on");
		$this->db->from("user_role");
		$this->db->join("user_roles", "user_roles.id = user_role.role_id", 'INNER');
		$this->db->join("users", "users.id = user_role.user_id", 'INNER');
		$this->db->where("user_roles.name",$val);
		$this->db->where("user_roles.status_id",1);
		$this->db->where_in("user_role.tenant_id",TENENT_ID);
		//$this->db->group_by("user_role.role_id"); 
		$query = $this->db->get();
		return $query->result();
	}
          
    }
?>
