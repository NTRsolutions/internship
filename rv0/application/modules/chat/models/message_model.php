<?php

class Message_model extends CI_Model{

	public $message_rules = array(
		    'message' => array (
					'field' => 'message',
					'label' => 'message',
					'rules' => 'trim|required|xss_clean'
			)
		);
		public function getusers($id){
			$this->db->select("*");
		$this->db->from("users");
		$this->db->where('id !=',$id);
        $this->db->where('status',1);
        $this->db->where('tenant_id',TENENT_ID);		
		$query = $this->db->get();
			return $query->result();
		}
	public function conversation($user, $chatbuddy, $limit = 5){
        $this->db->where('from', $user);
        $this->db->where('to', $chatbuddy);
        $this->db->or_where('from', $chatbuddy);
        $this->db->where('to', $user);
        $this->db->order_by('id', 'desc');
        $messages = $this->db->get('messages', $limit);

        $a = $this->db->where('to', $user)->where('from',$chatbuddy)->update('messages', array('is_read'=>'1'));
       
        return $messages->result();
	}
	public function thread_len($user, $chatbuddy){
        $this->db->where('from', $user);
        $this->db->where('to', $chatbuddy);
        $this->db->or_where('from', $chatbuddy);
        $this->db->where('to', $user);
        $this->db->order_by('id', 'desc');
        $messages = $this->db->count_all_results('messages');
        return $messages;
	}

	public function latest_message($user, $last_seen){
		$message  =  $this->db->where('`to`', $user)
							  ->where('id  >= ', $last_seen)
							  ->order_by('time', 'desc')
							  ->get('messages');
//print_r($message);exit;
		if($message->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	public function new_messages($user, $last_seen){
		$messages  =  $this->db->where('to', $user)
							  ->where('id  > ', $last_seen)
							  ->order_by('time', 'asc')
							  ->get('messages');

		return $messages->result();
	}

	public function unread($user){
		$messages  =  $this->db->where('`to`', $user)
							  ->where_in('is_read', array('','0'))
							  ->order_by('time', 'asc')
							  ->get('messages');

		return $messages->result();
	}
	public function mark_read(){
		$id = $this->input->post('id');
		$this->db->where('id', $id)->update('messages', array('is_read'=>'1'));
	}

	public function unread_per_user($id, $from){
		$this->db->select("*");
		$this->db->from("messages");
		$this->db->where_in('is_read',array('','0'));		
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
	public function messageInsert($arr){
		$resp  = $this->db->insert('messages',$arr);
		$userid = $this->db->insert_id(); 
		return $userid;
		
	}
	public function getMeaage($mid){
		$this->db->select("*");
		$this->db->from("messages");
        $this->db->where('id',$mid);
        $query = $this->db->get();
		//print_r($query );exit;
	   if ( $query->num_rows()) {
			return $query->result();
		} else {
			 
			return false;
		}
	}
	
}
