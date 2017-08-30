<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * @author Azar
 * @Created Date: 25 May 2013
 * @Description: It is used to fetch the Admin users Data from the database
 * 
 */

class posts_model extends CI_Model {

        function __construct(){
            parent::__construct();
        }
/*
 * registration page
 * 
 */
 
   public function Getposts($id)
	{  
	    $tent='tenant_id IN ('.SESSION_TENENT_ID.')';
	    $this->db->select("users.notification_view_date,registred_on");
		$this->db->from("users");
		$this->db->where('id',$id );
		$query = $this->db->get(); 
		$date = $query->result();
		if($date){ 
		$this->db->select("id");
		$this->db->from("site_activity");
		$this->db->where('user_id !=',$id );
		$this->db->where($tent); 
		$this->db->where('date_time >',$date[0]->notification_view_date);
		$this->db->where('date_time >',$date[0]->registred_on);
		$this->db->where('status',1); 
		$query1 = $this->db->get();
	 
		if ( $query1->result()) {
			return $query1->num_rows();
			
		} else {
			 
			return false;
		}
		} else{
			return false;
		}
	}
	public function Getpostsalertdata($id)
	{  
	    $this->db->select("users.notification_view_date,registred_on");
		$this->db->from("users");
		$this->db->where('id',$id );
		$query = $this->db->get(); 
		$date = $query->result();
		if($date){ 
		$this->db->select("id");
		$this->db->from("site_activity");
		$this->db->where('user_id !=',$id );
		$this->db->where('date_time >',$date[0]->notification_view_date);
		$this->db->where('date_time >',$date[0]->registred_on);
		$this->db->where('status',1); 
		$query1 = $this->db->get();
		
		if ( $query1->result()) {
			return $query1->num_rows();
			
		} else {
			 
			return false;
		}
		} else{
			return false;
		}
	}
 public function Getpostsdata($id)
	{  
	    
	     $sql = $sql = " SELECT   site_activity.*,
		             CASE
						 WHEN   site_activity.action_type='post' || site_activity.action_type='newjoin'  THEN users.profile_thumb_image
						  ELSE admin_image.profile_image 
						 END  AS 'profile_image',
                                                 
					 CASE
						  WHEN  site_activity.action_type='post' || site_activity.action_type='newjoin'  THEN users.display_name 
						   ELSE admin_users.nickname  
						  END  AS 'display_name'
				FROM whd_site_activity as site_activity 
				LEFT JOIN whd_users as users ON users.id = site_activity.user_id 
				LEFT JOIN whd_organizations as admin_users ON admin_users.ID =  site_activity.tenant_id 
LEFT JOIN whd_admin_users as admin_image ON admin_image.id =  site_activity.user_id
				WHERE site_activity.tenant_id IN (".SESSION_TENENT_ID.")  AND site_activity.status='1' AND site_activity.user_id !='".$id."'  order by id DESC LIMIT 10
 ";
 
				/*UNION

				(SELECT site_activity.*,admin_users.profile_image as profile_thumb_image,admin_users.display_name  FROM whd_site_activity as site_activity 
				LEFT JOIN whd_admin_users as admin_users ON admin_users.id =  site_activity.user_id  
				WHERE site_activity.tenant_id = '".TENENT_ID."' AND site_activity.action_type IN('news','event') AND site_activity.user_id !='".$id."') order by id DESC LIMIT 5  ";*/
	 		 
		 $query =  $this->db->query($sql); 
		 // print_r($query->result());exit;
		 
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
		
		 
	}
 public function Getnotification($activity_id,$id)
	{  
	     
		    $sql = "SELECT   site_activity.*,
		             CASE
						 WHEN  site_activity.action_type='post' || site_activity.action_type='newjoin'  THEN users.profile_thumb_image
						  ELSE admin_users.profile_image 
						 END  AS 'profile_image',
					 CASE
						  WHEN  site_activity.action_type='post' || site_activity.action_type='newjoin'  THEN users.display_name 
						   ELSE admin_users.nickname  
						  END  AS 'display_name'
		        FROM whd_site_activity as site_activity 
				LEFT JOIN whd_users as users ON users.id = site_activity.user_id 
				LEFT JOIN whd_organizations as admin_users ON admin_users.ID =  site_activity.tenant_id 
				WHERE site_activity.tenant_id IN (".SESSION_TENENT_ID.")  AND site_activity.status='1' AND site_activity.user_id !='".$id."' AND  site_activity.id < ".$activity_id." order by id DESC LIMIT 5";
	 		  
		 $query =  $this->db->query($sql); 
		 
		 
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
		
		 
	}
	public function updatepoststatus($data) {
		
		$this->db->where('id',$data['id']);
		$this->db->update("users",$data);
		return true;
		
	}
	public function postdetailes($post_id)
	{
		$this->db->select("*,users.id as user_id");
		$this->db->from("posts");
		$this->db->join("users","users.id=posts.user_id");
		$this->db->where('posts.post_id',$post_id );
		$this->db->where('posts.post_status',1);
		$query = $this->db->get();
		return $query->result();
	}
	 
	
	public function isExists($user) {
               
		$this->db->select("ID");
		$this->db->from("users");  
		$this->db->where('email',$user['email']);  
		$this->db->or_where('username',$user['username']);  
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	 
	public function email_verify($email,$code) {
              
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("email",$email);  
		//$this->db->where("password",md5($user['pass']));
		
		$query = $this->db->get();
		if ($query->num_rows() > 0)
			 {
			 $userdata = $query->result();
			    
			 if($userdata[0]->status=='1')
			 {
				  return "active";
			 }else if($userdata[0]->status=='-1')
			 {
				   return "inactive";
			 }else
			 {
				  
				   if($userdata[0]->status=='0' && $userdata[0]->activation_code==$code)
				  {
					   
					  $arr = array();
					  $arr['status'] = '1';
					  $arr['activation_code']='';
					  $arr['last_updated_on'] = date('Y-m-d H:i:s');
					  $this->db->where('id',$userdata[0]->id);
		              $this->db->update("users",$arr );
		              return 'verified';
				  }
				  
			 }
			 
			 
		} else {
			 
			return false;
		}
	}
	public function emailExist($user) {
               
		$this->db->select("id,firstName,lastName");
		$this->db->from("users");
		$this->db->where("email",$user['email']);
		 
		 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function user($id) {
        $tent='tenant_id IN ('.SESSION_TENENT_ID.')';       
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where($tent); 
		$this->db->where("id",$id); 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	
	public function friends($userid)
	{
		    $this->db->select("*");
			$this->db->from("buddies"); 
			$custom_where = "(initiator_user_id='".$buddy."' OR buddy_user_id='".$buddy."') AND  is_confirmed=1"; 
			$this->db->where($custom_where); 
			 
		    $query = $this->db->get();
		    return $query->result();
	}
	public function savechangepassword($arr,$old){
		
	    $this->db->select("*");
		$this->db->from("users");
		$this->db->where("password ='".$old."'");
		$this->db->where("id = ".$arr['id']);
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
	
	public function skipwizard($id)
	{
		 
		        $arr = array();
		        $arr['wizard'] = 1;
		 		$this->db->where('id',$id);
		        $status = $this->db->update("users",$arr );  
		        return $status;
		
	}
	public function deletepost($post_id,$user_id) {
		
		$this->db->select('post_id');
		$this->db->from('posts as p');  
		$this->db->where('post_id',$post_id);
	    $this->db->where('user_id',$user_id);
		$query = $this->db->get();
		if ( $query->num_rows()>0) { 
			 
			 
            $arr = array();
            $arr['post_status'] = 0; 
	        $this->db->where('post_id',$post_id);
	        $this->db->where('user_id',$user_id);
		    $status = $this->db->update("posts",$arr );
		    
		    
		    $arr = array();
            $arr['status'] = 0;
		    $this->db->where('action_item_id',$post_id);
	        $this->db->where('user_id',$user_id);
		    $this->db->update("site_activity",$arr ); 
		     return true; 
		     
		 }
		 return false;
		    
	}
	 public function townlist() {
		$this->db->select("*");
		$this->db->from("town");
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function IsFav($uid,$tid) {
		$this->db->select("*");
		$this->db->from("favorites");
		$this->db->where("fav_org_id",$tid);
		$this->db->where("user_id",$uid);
		 
		 
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return true;
		} else {
			return false;
		}
	}
	public function userHomeTown($cityid) {
		$this->db->select("*");
		$this->db->from("town");
		$this->db->join("country","country.country_id=town.town_country_id","LEFT");
		$this->db->join("state","state.state_id=town.town_state_id","LEFT");
		 
		$this->db->where('town_id',$cityid);
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function organisationList($userId,$city_id) {
		$this->db->select("*");
		$this->db->from("organisation");
		$this->db->where("userId",$userId);
		$this->db->where("town_id",$city_id);
		$query = $this->db->get();		
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function timeline($city_id) {
		$res = array();
		
		$this->db->select("*");
		$this->db->from("posts"); 
		$this->db->where("post_city",$city_id);
		$this->db->where("post_type",'adds');
		$this->db->order_by("id","DESC");
		$this->db->LIMIT(3);
		$query = $this->db->get();		
		if ( $query->result()) {
			$res['adds'] = $query->result();
			 
		}  
		$this->db->select("*");
		$this->db->from("posts");
		$custom_where = "(post_city = '".$city_id."' AND post_type='news')"; 
		 
		 
		$this->db->order_by("id","DESC");
		$this->db->LIMIT(3);
		$query = $this->db->get();		
		if ( $query->result()) {
			$res['news'] = $query->result();
			 
		}  
		return $res;
	}
	public function bussinesstypelist() {
		$this->db->select("*");
		$this->db->from("bussiness_type");
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	
          
    }
?>
