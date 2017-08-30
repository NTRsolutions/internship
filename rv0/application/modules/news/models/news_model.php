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
 
   public function GetallNews($limit, $start, $search=array())
	{  
	    $tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("news");
		$this->db->where($tent); 
		$this->db->where("news_status",1); 
		$this->db->order_by("news_id","DESC"); 
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function Getallnewscount()
	{  
	    $tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("news_id");
		$this->db->from("news");
		$this->db->where($tent); 
		$this->db->where("news_status",1); 
		$this->db->order_by("news_id","DESC"); 
		$query = $this->db->get();
		return $query->num_rows();
		 
	}
	public function Getnewsdetails($id) {
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("news");
		$this->db->where($tent); 
		$this->db->where("news_status",1); 
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
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("news_id,news_title,news_description,news_images,created_on");
		$this->db->from("news");
		$this->db->where($tent); 
		$this->db->where("news_status",1); 
		$this->db->order_by("news_id","DESC");
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result();
	}
	 
	
	
	 
	
	public function Getsearchcount($search) 
	{
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("news_id");
		$this->db->from("news");
		$this->db->where($tent); 
		$this->db->where("news_status",1);
		
		if(isset($search['searchname']) &&  $search['searchname'] !=''){
			 
			 $custom_where = "(news_title LIKE '%".$search['searchname']."%' OR news_description LIKE '%".$search['searchname']."%')"; 
			 $this->db->where($custom_where);
			$this->db->order_by("news_id","DESC");
		} else{
			if(!isset($search['filter']))
			$this->db->order_by("news_id","DESC");
		
	}
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function Getsearchnews($limit, $start, $search=array())
	{
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("news");
		$this->db->where($tent); 
		$this->db->where("news_status",1);
		
		if(isset($search['searchname']) &&  $search['searchname'] !=''){
			 
			 $custom_where = "(news_title LIKE '%".$search['searchname']."%' OR news_description LIKE '%".$search['searchname']."%')"; 
			 $this->db->where($custom_where);
			$this->db->order_by("news_id","DESC");
		} else{
			if(!isset($search['filter']))
			$this->db->order_by("news_id","DESC");
		
	}
		
		
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	
          
    }
?>
