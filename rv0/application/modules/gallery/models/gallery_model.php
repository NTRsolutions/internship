<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * @author Azar
 * @Created Date: 25 May 2013
 * @Description: It is used to fetch the Admin users Data from the database
 * 
 */

class gallery_model extends CI_Model {

        function __construct(){
            parent::__construct();
        }
/*
 * registration page
 * 
 */
 
   public function GetallGallery($limit, $start, $search=array())
	{  
	    $tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("gallery");
		$this->db->where($tent); 
		$this->db->where("gallery_status",1); 
		$this->db->order_by("ID","DESC"); 
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function Getallgallerycount()
	{  
	    $tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("ID");
		$this->db->from("gallery");
		$this->db->where($tent); 
		$this->db->where("gallery_status",1); 
		$this->db->order_by("ID","DESC"); 
		$query = $this->db->get();
		return $query->num_rows();
		 
	}
	public function Getnewsdetails($id) {
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("gallery");
		$this->db->where($tent); 
		$this->db->where("gallery_status",1); 
		$this->db->where("ID",$id); 
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function Getsearchcount($search) 
	{
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("ID");
		$this->db->from("gallery");
		$this->db->where($tent); 
		$this->db->where("gallery_status",1);
		
		if(isset($search['searchname']) &&  $search['searchname'] !=''){
			 
			 $custom_where = "(galleryTitle LIKE '%".$search['searchname']."%' OR galleryDescription LIKE '%".$search['searchname']."%')"; 
			 $this->db->where($custom_where);
			$this->db->order_by("ID","DESC");
		} else{
			if(!isset($search['filter']))
			$this->db->order_by("ID","DESC");
		
	}
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function Getsearchgallery($limit, $start, $search=array())
	{
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("gallery");
		$this->db->where($tent); 
		$this->db->where("gallery_status",1);
		
		if(isset($search['searchname']) &&  $search['searchname'] !=''){
			 
			 $custom_where = "(galleryTitle LIKE '%".$search['searchname']."%' OR galleryDescription LIKE '%".$search['searchname']."%')"; 
			 $this->db->where($custom_where);
			$this->db->order_by("ID","DESC");
		} else{
			if(!isset($search['filter']))
			$this->db->order_by("ID","DESC");
		
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
