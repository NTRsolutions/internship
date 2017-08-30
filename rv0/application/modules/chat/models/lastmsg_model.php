<?php

class Lastmsg_model extends CI_Model{

	public $_table = 'last_seen';

	public $belongs_to = array( 'user' => array('model'=>'user_model'));

	public function update_lastSeen($user=0)
	{
		$last_msg = $this->db->where('`to`', $user)->order_by('time', 'desc')->get('messages')->row();
		$msg = !empty($last_msg) ? $last_msg->id : 0;

		$record = $this->get_by('user_id', $user);
		$details = array('user_id' => $user,'message_id' => $msg);
		if(empty($record))
		{
			$this->insert($details);
		}else{
			$this->update($record[0]->id, $details);
		}
	}
	public function get_by($name,$id){
		$this->db->select("*");
		$this->db->from("last_seen");
		$this->db->where('user_id ',$id);		
		$query = $this->db->get();
		if ( $query->result()) {
			return $query->result();
		} else {
			return false;
		}
		
	}
	public function insert($details){
		$resp  = $this->db->insert('last_seen',$details);
		$userid = $this->db->insert_id(); 
		return $userid;
	}
	public function update($id,$details){
		$this->db->where('id',$id);
      $this->db->update("last_seen",$details);
	  return true;
	}
}
