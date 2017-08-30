<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * @author Azar
 * @Created Date: 25 May 2013
 * @Description: It is used to fetch the Admin users Data from the database
 * 
 */

class news_model extends CI_Model {

        function __construct(){
            parent::__construct();
        }
/*
 * registration page
 * 
 */
 
   public function GetallNews($arr)
	{  
	    
		$this->db->select("*");
		$this->db->from("news");
		$this->db->order_by("news_id","DESC"); 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function Getnewsdetails($id) {
		$this->db->select("*");
		$this->db->from("news");
		$this->db->where("news_id",$id); 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function Gethomenews()
	{
		$this->db->select("*");
		$this->db->from("news");
		$this->db->order_by("news_id","DESC");
		$this->db->limit(3);
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
