<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller {
	protected $smiley_url = 'assets/images/smileys';
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'user');
		$this->load->model('message_model', 'message');
		$this->load->model('lastmsg_model', 'last');
		$this->load->helper('smiley');
	}

	public function index()
	{
		$this->load->view('chat');
	}
	public function messages(){
		//get paginated messages 
		$per_page = 5;
		$session = $this->session->userdata('logged_in');
		$user 		= $session['user']['id'];
		$buddy 		= $this->input->post('user');
		$user_key 		= $this->input->post('user_key');
		$limit 		= isset($_POST['limit']) ? $this->input->post('limit') : $per_page ;
		$contacts = $this->user->get_all($session['user']['id']);
		$totalunreadcount='';
			foreach ($contacts as $key=>$contact) {
				
				$val = $this->user->unread_peruser($session['user']['id'],$contact->id);
				  //$val="SELECT * from messages where is_read='0' AND `to`=".$contact->id." AND `from`=".$session['user']['id'];
				//$query = $this->db->query($val);
				//print_r($val);exit;
				
				if($val) {
					$totalunreadcount += $val;
				} 
				
			}
		$admincontacts = $this->user->get_adminUsers();//print_r($admincontacts);exit;
		//$totalunreadcount='';
			foreach ($admincontacts as $key=>$admincontacts) {
				$adminval = $this->user->unread_peruser($session['user']['id'],$admincontacts->id);
				if($adminval) {
					$totalunreadcount += $adminval;
				} 
				
			}
			//echo $totalunreadcount;exit;
		//unread message count
		$unreadcount 	= $this->message->unread_per_user($user,$buddy);
		
		$messages 	= array_reverse($this->message->conversation($user, $buddy, $limit));
		
		$total 		= $this->message->thread_len($user, $buddy);
//print_r($messages);exit;
		$thread = array();
		foreach ($messages as $message) {
			if($message->sender_key=='admin' && $message->receiver_key=='alumni'){
				$owner = $this->user->getAdminusers($message->from);
				//print_r($owner);exit;
			}else{
				$owner = $this->user->get($message->from);
				
			}
			$chat = array(
					'msg' 		=> $message->id,
					'sender' 	=> $message->from, 
					'recipient' => $message->to,
					'avatar' 	=> $owner[0]->profile_image != '' ? $owner[0]->profile_image : base_url().'../assets/img/user-thumb.jpg',
					'body' 		=> parse_smileys($message->message, $this->smiley_url),
					'time' 		=> date("M j, Y, g:i a", strtotime($message->time)),
					'type'		=> $message->from == $user ? 'out' : 'in',
					'name'		=> $message->from == $user ? 'You' : ucwords($owner[0]->display_name)
					);
			array_push($thread, $chat);
		}
		if($user_key=='admin'){
			$chatbuddy = $this->user->getAdminusers($buddy);
		}else{
			$chatbuddy = $this->user->get($buddy);
		}
		$contact = array(
			'name'=>ucwords($chatbuddy[0]->display_name),
			'status'=>$chatbuddy[0]->status,
			'id'=>$chatbuddy[0]->id,
			'limit'=>$limit + $per_page,
			'more' => $total  <= $limit ? false : true, 
			'scroll'=> $limit > $per_page  ?  false : true,
			'remaining'=> $total - $limit
			);

 
		$response = array(
					'success' => true,
					'errors'  => '',
					'message' => '',
					'buddy'	  => $contact,
					'thread'  => $thread,
					'unreadcount'  => $unreadcount,
					'totalunreadcount'  => $totalunreadcount
					);//print_r(json_encode( $response ));exit;
		//add the header here
		header('Content-Type: application/json');
		echo json_encode($response);exit;
	}
	public function save_message(){
		$session = $this->session->userdata('logged_in');
		//$logged_user = $this->authentication->read('identifier');
		$logged_user = $session['user']['id'];
		$buddy 		= $this->input->post('user');
		$message 	= $this->input->post('message');
		$receiver_key 	= $this->input->post('user_key');
		$arr=array();
		if($message != '' && $buddy != '')
		{
			
			$arr['from']=$logged_user;
			$arr['to']=$buddy;
			$arr['message']=$message;
			$arr['receiver_key']=$receiver_key;
			$arr['sender_key']='alumni';
			$arr['time']=date('Y-m-d H:i:s');
			
			$msg_id = $this->message->messageInsert($arr);
			$msg = $this->message->getMeaage($msg_id);
			if($msg[0]->sender_key=='admin' && $msg[0]->receiver_key=='alumni'){
				$owner = $this->user->getAdminusers($msg[0]->to);
				//print_r($owner);exit;
			}else{
				$owner = $this->user->get($msg[0]->from);
				
			}
			//print_r($owner );exit;
			$chat = array(
				'msg' 		=> $msg[0]->id,
				'sender' 	=> $msg[0]->from, 
				'recipient' => $msg[0]->to,
				'avatar' 	=> $owner[0]->profile_image != '' ? $owner[0]->profile_image : base_url().'../assets/img/user-thumb.jpg',
				'body' 		=> parse_smileys($msg[0]->message, $this->smiley_url),
				'time' 		=> date("M j, Y, g:i a", strtotime($msg[0]->time)),
				'type'		=> $msg[0]->from == $logged_user ? 'out' : 'in',
				'name'		=> $msg[0]->from == $logged_user ? 'You' : ucwords($owner[0]->display_name)
				);

			$response = array(
				'success' => true,
				'message' => $chat 	  
				);
		}
		else{
			  $response = array(
				'success' => false,
				'message' => 'Empty fields exists'
				);
		}
		//add the header here
		header('Content-Type: application/json');
		echo json_encode( $response );exit;
	}

	public function updates(){
	    $new_exists = false;
		$session = $this->session->userdata('logged_in');
		//$logged_user = $this->authentication->read('identifier');
		$user_id = $session['user']['id'];
		$last_seen  = $this->last->get_by('user_id', $user_id);
		$last_seen  = empty($last_seen) ? 0 : $last_seen[0]->message_id;
		
		$exists = $this->message->latest_message($user_id, $last_seen);
		//echo $exists;exit;
		if($exists){
			$new_exists = true;
		}
		// THIS WHOLE SECTION NEED A GOOD OVERHAUL TO CHANGE THE FUNCTIONALITY
	    if ($new_exists) {
	        $new_messages = $this->message->unread($user_id);
			$thread = array();
			$senders = array();
			foreach ($new_messages as $message) {
				if(!isset($senders[$message->from])){
					$senders[$message->from]['count'] = 1; 
				}
				else{
					$senders[$message->from]['count'] += 1; 
				}
				$owner = $this->user->get($message->from);
				$chat = array(
					'msg' 		=> $message->id,
					'sender' 	=> $message->from, 
					'recipient' => $message->to,
					'avatar' 	=> $owner[0]->profile_image != '' ? $owner[0]->profile_image : base_url().'../assets/img/user-thumb.jpg',
					'body' 		=> parse_smileys($message->message, $this->smiley_url),
					'time' 		=> date("M j, Y, g:i a", strtotime($message->time)),
					'type'		=> $message->from == $user_id ? 'out' : 'in',
					'name'		=> $message->from == $user_id ? 'You' : ucwords($owner[0]->display_name)
					);
				array_push($thread, $chat);
			}

			$groups = array();
			foreach ($senders as $key=>$sender) {
				$sender = array('user'=> $key, 'count'=>$sender['count']);
				array_push($groups, $sender);
			}
			// END OF THE SECTION THAT NEEDS OVERHAUL DESIGN
			$this->last->update_lastSeen($user_id);

			$response = array(
				'success' => true,
				'messages' => $thread,
				'senders' =>$groups
			);

			//add the header here
			header('Content-Type: application/json');
			echo json_encode( $response );exit;
	    } 
	}
	public function mark_read(){
		$this->message->mark_read();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
