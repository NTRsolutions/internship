<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * @author Azar
 * @Created Date: 25 May 2013
 * @Description: It is used to fetch the Admin users Data from the database
 * 
 */

class home_model extends CI_Model {

        function __construct(){
            parent::__construct();
        }
/*
 * registration page
 * 
 */
 
 public function getproducts()
        {
        	
        	$data=$this->db->get('whd_products');
        	$dataa=$data->result();
        	return $dataa;
        	

        }
public function homeNews($cid=0,$sid=0,$did=0,$tid=0,$catid=0,$from=0,$to=10) {
		
		$town = array();
		if($tid==0)
		{
			$this->db->select("town_id");
			$this->db->from("town"); 
			$this->db->where('town_country_id',$cid);
			$this->db->where('town_state_id',$sid);
			$this->db->where('town_city_id',$did);
			$this->db->where('town_id',$tid);
			$query = $this->db->get();
			$tdata = $query->result();
			if($tdata)
			{
				 foreach($tdata as $k=>$v)
				 {
					  $town[] =$v->town_id; 
				 }
			}
	    }else
	    {
			$town[] = $tid;
		}
		
		
	 
		
		$this->db->select("posts.*,bussiness_type_title");
		$this->db->from("posts"); 
		$this->db->join("bussiness_type","bussiness_type.id=posts.category_type","LEFT"); 
		if(count($town)>0)
		$this->db->where_in("post_city",$town);
		$this->db->where("post_type","news");
		if($catid!=0)
		$this->db->where("category_type",$catid);
		
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
 public function home_advertisements($cid=0,$sid=0,$did=0,$tid=0,$org_id,$from=0,$to=10) {
		
		$town = array();
		if($tid==0)
		{
			$this->db->select("town_id");
			$this->db->from("town"); 
			$this->db->where('town_country_id',$cid);
			$this->db->where('town_state_id',$sid);
			$this->db->where('town_city_id',$did);
			$this->db->where('town_id',$tid);
			$query_t = $this->db->get();
			$tdata = $query_t->result();
			if($tdata)
			{
				 foreach($tdata as $k=>$v)
				 {
					  $town[] =$v->town_id; 
				 }
			}
	    }else
	    {
			$town[] = $tid;
		}
		
		
	 
		
		$this->db->select("posts.*,bussiness_type_title");
		$this->db->from("posts"); 
		$this->db->join("bussiness_type","bussiness_type.id=posts.category_type","LEFT"); 
		if(count($town)>0)
		$this->db->where_in("post_city",$town);
		$this->db->where("post_type","addsd");
		
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
  /*comments module */	
  public function getCommentdata($postid,$postType){
	 $sql="SELECT comment.comment_id as id,comment.parent_id as parent,comment.userId as userid,comment.comment_body as content,comment.comment_created as created,comment.comment_modified as modified,
             CASE
				   WHEN  comment.userType='user' THEN users.profile_thumb_image
					ELSE admin_users.profile_image 
				   END  AS 'profile_picture_url',
			CASE
				   WHEN  comment.userType='user' THEN users.display_name
					ELSE admin_users.display_name 
				   END  AS 'fullname'
           FROM whd_comment as comment
		   LEFT JOIN whd_users as users ON users.id=comment.userId
		   LEFT JOIN whd_admin_users as admin_users ON admin_users.id=comment.userId
		   WHERE comment.entry_id='".$postid."' AND comment.entity_type='".$postType."' AND comment.tenant_id IN ('".SESSION_TENENT_ID."')"; 
		   $query =  $this->db->query($sql); 
		 if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	 
	 /* $this->db->select("comment.comment_id as id,comment.parent_id as parent,comment.userId as userid,comment.comment_body as content,comment.comment_created as created,comment.comment_modified as modified,users.display_name as fullname,users.profile_thumb_image as profile_picture_url");
		$this->db->from("comment");
		$this->db->join("users","users.id=comment.userId");
		$this->db->where("comment.entry_id",$postid);
		$this->db->where("comment.entity_type",$postType);
		$this->db->where("comment.tenant_id",TENENT_ID);
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		} */
  }
  public function deleteCommentdata($id){
	   $this->db->where('comment_id',$id);
       $this->db->delete('comment'); 
       return true;	  
	 }
	 public function insertCommentdata($arr){
		 
       $this->db->insert('comment', $arr);
		$insert_id = $this->db->insert_id();
		return $insert_id; 
	}
	public function updateCommentdata($arr){
		$this->db->where('comment_id',$arr['comment_id']); 
		$this->db->update('comment', $arr);
		return true;
	}
   /*comments module */		 
   public function lnews() {
		$this->db->select("posts.*,bussiness_type_title");
		$this->db->from("posts");
		 
		$this->db->where("post_type","news");
		$this->db->join("bussiness_type","bussiness_type.id=posts.category_type");
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}  
	
	 public function getLocations() {
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("count(id) as alumni_count,users.city,users.latitude,users.longitude");
		$this->db->from("users"); 
		$this->db->where($tent); 
		$this->db->where("status","1"); 
		$this->db->where('latitude is NOT NULL', NULL, FALSE);
		$this->db->group_by('users.latitude');
		$this->db->group_by('users.longitude');
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}  
	public function getBannerImages(){
	    $tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("banner_title,banner_description,banner_images");
		$this->db->from("banner"); 
		$this->db->where($tent); 
		$this->db->where("banner_status","1"); 
		$this->db->order_by("banner_id", "desc");
		$this->db->order_by("banner_id", "desc");
		 $this->db->limit(10,0);
	    $query = $this->db->get();
	    if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
		
	}
	
	 public function news_categories() {
		$this->db->select("bussiness_type_title,id");
		$this->db->from("bussiness_type"); 
		$this->db->where("type","news"); 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	} 
	
	
	public function organisationList($userId) {
		$this->db->select("*");
		$this->db->from("organisation");
		 
		$query = $this->db->get();		
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	/**** Post Save*******/
	public function savepost($arr)
	{    
		$this->db->insert('posts', $arr);
		$insert_id = $this->db->insert_id();
		//echo $insert_id;exit;
		$this->db->select('p.post_id,p.post_description,users.profile_thumb_image,users.display_name,users.id');
		$this->db->from('posts as p');  
		$this->db->join("users","users.id=p.user_id");
		$this->db->where('p.post_id',$insert_id); 
		$query = $this->db->get();
		if ( $query->result()) {
			 $resp = array();
			 $resp['id'] = $insert_id;
			 $resp['data'] = $query->result();
			 
			 $resp['data'][0]->post_description = $resp['data'][0]->post_description;
			return $resp;
		} else {
			return false;
		}
	}
	/**** Post Save*******/
	public function updatepost($arr,$activity,$exluded_files,$user_id)
	{
		 
		$id = $arr['edit_post_id'];
		unset($arr['edit_post_id']);
		$this->db->select('post_id,post_description,post_images,post_thumbs_images');
		$this->db->from('posts as p'); 
		$this->db->where('p.post_id',$id); 
		$this->db->where('p.user_id',$user_id);
		$this->db->where('p.post_status',1);
		$query = $this->db->get();
		if ( $query->result()) { 
			$exdata = $query->result();
			$post_images = $endata = array();
			if($exdata[0]->post_images!=NULL && $exdata[0]->post_images!='')
			 $endata = json_decode($exdata[0]->post_images);
			foreach($endata as $k=>$v)
			{
				// removing existing images
				if(!in_array($v,$exluded_files))
				 $post_images[] = $v; 
			}
			 
			 
			$post_thumbs_images =  $endata_thumb = array();
		    if($exdata[0]->post_thumbs_images!=NULL && $exdata[0]->post_thumbs_images!='')
			 $endata_thumb = json_decode($exdata[0]->post_thumbs_images);
			foreach($endata_thumb as $k=>$v)
			{
				if(!in_array($v,$exluded_files))
				 $post_thumbs_images[] = $v; 
			}
			 
			if(is_array($arr['post_images']) && count($arr['post_images'])>0)
			{
				 
				$arr['post_images'] = json_encode(array_merge($post_images,$arr['post_images']));
				$arr['post_thumbs_images'] = json_encode(array_merge($post_thumbs_images,$arr['post_thumbs_images']));
		    }else
		    {
				$arr['post_images'] = json_encode($post_images);
				$arr['post_thumbs_images'] = json_encode($post_thumbs_images);
			}
			 
			 
			$this->db->where('post_id',$id); 
			$this->db->where('user_id',$user_id); 
			$this->db->update('posts', $arr);
			 
			$this->db->where('action_item_id',$id);
			$this->db->where('user_id',$user_id); 
		    $this->db->update('site_activity', $activity); 
			$arr['post_description'] =  substr($arr['post_description'],0,500).'...';
			return $arr;
		}else
		{
		  return false; 
	    }
		 
	}
	public function Gethomeposts(){
		
		/*$sql = "(SELECT site_activity.*,users.profile_thumb_image as profile_thumb_image,users.display_name FROM whd_site_activity as site_activity 
				LEFT JOIN whd_users as users ON users.id = site_activity.user_id 
				WHERE site_activity.tenant_id = '".TENENT_ID."' AND site_activity.action_type = 'post'  AND site_activity.status='1' )

				UNION

				(SELECT site_activity.*,admin_users.profile_image as profile_thumb_image,admin_users.display_name  FROM whd_site_activity as site_activity 
				LEFT JOIN whd_admin_users as admin_users ON admin_users.id =  site_activity.user_id  
				WHERE site_activity.tenant_id = '".TENENT_ID."' AND site_activity.action_type IN('news','event')  AND site_activity.status='1' ) order by id DESC LIMIT 10  ";*/
				
				 $sql = "SELECT site_activity.id,site_activity.action_type,site_activity.user_id,site_activity.action_item_id,site_activity.activity_title,site_activity.activity_content,site_activity.date_time,
		             CASE
						 WHEN  site_activity.action_type='post' || site_activity.action_type='newjoin' THEN users.profile_thumb_image
						   ELSE admin_image.profile_image 
						 END  AS 'profile_image',
					 CASE
						  WHEN  site_activity.action_type='post' || site_activity.action_type='newjoin' THEN users.display_name 
						   ELSE admin_users.nickname  
						  END  AS 'display_name'
		        FROM whd_site_activity as site_activity 
				LEFT JOIN whd_users as users ON users.id = site_activity.user_id 
				LEFT JOIN whd_organizations as admin_users ON admin_users.ID =  site_activity.tenant_id
                LEFT JOIN whd_admin_users as admin_image ON admin_image.id =  site_activity.user_id				
				WHERE site_activity.tenant_id IN (".SESSION_TENENT_ID.") AND site_activity.status='1' AND site_activity.status='1'   order by id DESC LIMIT 5";
	 		 
		 
		 //echo $sql;exit;
		 $query =  $this->db->query($sql); 
		 
		
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function Gethomepostsactivity(){
		
		/*$sql = "(SELECT site_activity.*,users.profile_thumb_image as profile_thumb_image,users.display_name FROM whd_site_activity as site_activity 
				LEFT JOIN whd_users as users ON users.id = site_activity.user_id 
				WHERE site_activity.tenant_id = '".TENENT_ID."' AND site_activity.action_type = 'post'  AND site_activity.status='1' )

				UNION

				(SELECT site_activity.*,admin_users.profile_image as profile_thumb_image,admin_users.display_name  FROM whd_site_activity as site_activity 
				LEFT JOIN whd_admin_users as admin_users ON admin_users.id =  site_activity.user_id  
				WHERE site_activity.tenant_id = '".TENENT_ID."' AND site_activity.action_type IN('news','event')  AND site_activity.status='1' ) order by id DESC LIMIT 10  ";*/
				
				 $sql = "SELECT site_activity.id,site_activity.action_type,site_activity.user_id,site_activity.action_item_id,site_activity.activity_title,site_activity.activity_content,site_activity.date_time,
		             CASE
						 WHEN  site_activity.action_type='post' || site_activity.action_type='newjoin' THEN users.profile_thumb_image
						   ELSE admin_image.profile_image 
						 END  AS 'profile_image',
					 CASE
						  WHEN  site_activity.action_type='post' || site_activity.action_type='newjoin' THEN users.display_name 
						   ELSE admin_users.nickname  
						  END  AS 'display_name'
		        FROM whd_site_activity as site_activity 
				LEFT JOIN whd_users as users ON users.id = site_activity.user_id 
				LEFT JOIN whd_organizations as admin_users ON admin_users.ID =  site_activity.tenant_id
                LEFT JOIN whd_admin_users as admin_image ON admin_image.id =  site_activity.user_id				
				WHERE site_activity.tenant_id IN (".SESSION_TENENT_ID.") AND site_activity.status='1' AND site_activity.status='1'   order by id DESC LIMIT 10";
	 		 
		 
		 //echo $sql;exit;
		 $query =  $this->db->query($sql); 
		 
		
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function Getactivities($id){
 
	 
		/*$sql = "(SELECT site_activity.*,users.profile_thumb_image as profile_thumb_image,users.display_name FROM whd_site_activity as site_activity 
				LEFT JOIN whd_users as users ON users.id = site_activity.user_id 
				WHERE site_activity.tenant_id = '".TENENT_ID."' AND site_activity.action_type = 'post' AND  site_activity.id < ".$id."  AND site_activity.status='1' )

				UNION

				(SELECT site_activity.*,admin_users.profile_image as profile_thumb_image,admin_users.display_name  FROM whd_site_activity as site_activity 
				LEFT JOIN whd_admin_users as admin_users ON admin_users.id =  site_activity.user_id  
				WHERE site_activity.tenant_id = '".TENENT_ID."' AND site_activity.action_type IN('news','event') AND  site_activity.id < ".$id."  AND site_activity.status='1' ) order by id DESC LIMIT 5  ";*/
	      $sql = "SELECT   site_activity.id,site_activity.action_type,site_activity.user_id,site_activity.action_item_id,site_activity.activity_title,site_activity.activity_content,site_activity.date_time,
		             CASE
						 WHEN  site_activity.action_type='post' || site_activity.action_type='newjoin' THEN users.profile_thumb_image
						  ELSE admin_users.profile_image 
						 END  AS 'profile_image',
					 CASE
						  WHEN  site_activity.action_type='post' || site_activity.action_type='newjoin' THEN users.display_name 
						   ELSE admin_users.nickname  
						  END  AS 'display_name'
		        FROM whd_site_activity as site_activity 
				LEFT JOIN whd_users as users ON users.id = site_activity.user_id 
				LEFT JOIN whd_organizations as admin_users ON admin_users.ID =  site_activity.user_id 
				WHERE site_activity.tenant_id IN (".SESSION_TENENT_ID.") AND  site_activity.id < ".$id." AND site_activity.status='1'  order by id DESC LIMIT 10";
	 		 
		 $query =  $this->db->query($sql);
		 
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
	}
	function getActivityContent($itemId,$table,$idname,$des_field){
		 
		$this->db->select($idname.",".$des_field);
		$this->db->from("whd_".$table); 
		$this->db->where($idname,$itemId); 
		$query = $this->db->get();
		 
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
		
	}
	
	
	public function siteactivity($array)
	{
	 
	    $array['status'] = 1;
		$this->db->insert('site_activity', $array);
		$insert_id = $this->db->insert_id();
	}
	public function logactivity($array)
	{
		$array['status'] = 1;
		$this->db->insert('log_activity', $array);
		$insert_id = $this->db->insert_id();
	}
	public function updateprofession($arr){
		$this->db->where('id',$arr['id']); 
		$this->db->update('users', $arr);
		return true;
	}
	public function unread_per_user($id, $from){
		$this->db->select("*");
		$this->db->from("messages");
		$this->db->where('is_read','0');	
        $this->db->where('`to`',$id);
        $this->db->where('`from`',$from);
        	
		$query = $this->db->get();
		//print_r($query);exit;
	   if ( $query->num_rows()) {
			return $query->num_rows();
		} else {
			 
			return false;
		}
		
		/*$count  =  $this->db->where('to', $id)
							->where('from', $from)
							->where('is_read', '0')
							->count_all_results('messages');
		return $count;*/
	}
	public function getPageinfo($val){
		$tent='tenantID IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("pages");
		$this->db->where('pageTitle',$val);	
        $this->db->where('page_status',1);
        $this->db->where($tent);
        $query = $this->db->get();
        if ($query->num_rows()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function getmorePageinfo($val){
		$tent='tenantID IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("pages");
		$this->db->where('morePages',$val);	
        $this->db->where('page_status',1);
        $this->db->where($tent);
        $query = $this->db->get();
        if ($query->num_rows()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function getUsertenant($arr){
		$this->db->select("tenant_id");
		$this->db->from("users");
		$this->db->where('id',$arr); 
		$query = $this->db->get();
        if ($query->num_rows()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function get_allc($id)
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
          
    }
?>
