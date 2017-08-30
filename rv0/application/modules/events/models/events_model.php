<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * @author Azar
 * @Created Date: 25 May 2013
 * @Description: It is used to fetch the Admin users Data from the database
 * 
 */

class events_model extends CI_Model {

        function __construct(){
            parent::__construct();
        }
/*
 * registration page
 * 
 */
 
   public function Getevens()
	{  
	    $tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("events");
		$this->db->where($tent);
		$this->db->where("event_status",1);
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
		$this->db->select("event_id");
		$this->db->from("events");
		$this->db->where($tent); 
		$this->db->where("event_status",1);
		
		if(isset($search['searchname']) &&  $search['searchname'] !=''){
			 
			 $custom_where = "(event_title LIKE '%".$search['searchname']."%' OR event_description LIKE '%".$search['searchname']."%')"; 
			 $this->db->where($custom_where);
			$this->db->order_by("event_id","DESC");
		} else{
			if(!isset($search['filter']))
			$this->db->order_by("event_id","DESC");
		
	}
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function Getsearchnews($limit, $start, $search=array())
	{
		//print_r($_POST);exit;
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("events");
		$this->db->where($tent); 
		$this->db->where("event_status",1);
		
		if(isset($search['searchname']) &&  $search['searchname'] !=''){
			 
			 $custom_where = "(event_title LIKE '%".$search['searchname']."%' OR event_description LIKE '%".$search['searchname']."%')"; 
			 $this->db->where($custom_where);
			$this->db->order_by("event_id","DESC");
		} else{
			if(!isset($search['filter']))
			$this->db->order_by("event_id","DESC");
		
	}
		
		
		$this->db->limit($limit, $start);
		$query = $this->db->get();
	 
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function Getalleventcount()
	{  
	    $tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("event_id");
		$this->db->from("events");
		$this->db->where($tent); 
		$this->db->where("event_status",1); 
		$this->db->order_by("event_id","DESC"); 
		$query = $this->db->get();
		return $query->num_rows();
		 
	}
	public function GetallEvents($limit, $start, $search=array())
	{  
	    $tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("events");
		$this->db->where($tent); 
		$this->db->where("event_status",1); 
		$this->db->order_by("event_id","DESC"); 
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	public function Gethomeevents()
	{
		 
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("events");
		$this->db->where($tent); 
		$this->db->where("event_status",1); 
		$this->db->order_by("event_id","DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function Geteventsdetails($id) {
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')';
		$this->db->select("*");
		$this->db->from("events");
		$this->db->where("event_id",$id); 
		$this->db->where($tent);
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	 
	 
	 
	
          
    }
?>
