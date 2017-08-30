<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * @author Azar
 * @Created Date: 25 May 2013
 * @Description: It is used to fetch the Admin users Data from the database
 * 
 */

class replymsg_model extends CI_Model {

	protected $_table_name = 'reply_msg';
	protected $_primary_key = 'replyID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "replyID asc";

	function __construct() {
		parent::__construct();
	}

	function get_reply_msg($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_reply_msg($array=NULL) {
		      
		$this->db->select("*");
		$this->db->from("whd_reply_msg");  
		$this->db->where($array);  
		 
		$query = $this->db->get();    
		if ( $query->result()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}


	function insert_reply_msg($array) {
		 
		$resp  = $this->db->insert('whd_reply_msg',$array); 
		return TRUE;
	}

	function update_reply_msg($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_reply_msg($id){
		parent::delete($id);
	}
    }
?>
