<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
 
	function __construct() {
		parent::__construct();
		$this->load->model("message_model");
		$this->load->model("replymsg_model");
		$language = 'english';
		$this->lang->load('message', $language);
		isLoggedin();
	 
	}

	public function index() {
		
		if($this->session->userdata('success_msg'))
		{  //echo "asdsa"; exit;
			$this->data['success_msg'] = $this->session->userdata('success_msg'); 
			$this->session->set_userdata('success_msg','');
		}
		if($this->session->userdata('error_msg'))
		{
			$this->data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		} 
		
		$session = $this->session->userdata('logged_in');
		 
		$email = $session['user']['email'];
		$usertype = $session['user']['user_roles_id'];
		$userID = $session['user']['id'];
		$table = "users";

		$this->data['messages'] = $this->message_model->get_order_by_message(array('email' => $email,'receiverID' => $userID, 'to_status' => 0));
		 
		if (count($this->data['messages'])) {
			foreach ($this->data['messages'] as $key => $item) {
				$this->data['messages'][$key]->messageID=doEncrypt($item->messageID);
				 if($item->usertype=='admin'){
					$query =  $this->message_model->getadminUser($item->userID); 
				}else{
					$query =  $this->message_model->getUser($item->userID); 
				}//print_r($query);exit;
				//$query =  $this->message_model->getUser($item->userID);
				if ($query) {
					$this->data['messages'][$key] = (object) array_merge( (array)$item, array( 'sender' => $query->display_name));
				}
			}
		}
		  $this->data['activepage'] = 'message';//print_r($this->data);exit;
		$this->data['theme_body'] = $this->load->view('index', $this->data, true); 
		$this->load->view('theme/gj/inner_layout', $this->data);
		 
		 
	}

	public function fav_message() {
		$email = $this->session->userdata('email');
		$usertype = $this->session->userdata('usertype');
		$userID = $this->userID();
		$table = "";

		$this->data['messages'] = $this->message_model->get_order_by_message(array('email' => $email,'receiverID' => $userID, 'receiverType' => $usertype, 'to_status' => 0, 'fav_status' => 1));
		$this->data['messages_sent'] = $this->message_model->get_order_by_message(array('userID' => $userID, 'usertype' => $usertype, 'from_status' => 0, 'fav_status_sent' => 1));
		if (count($this->data['messages'])) {
			foreach ($this->data['messages'] as $key => $item) {
				if ($item->usertype=="Admin") {
					$table = "systemadmin";
				} elseif($item->usertype=="Accountant" || $item->usertype=="Librarian") {
					$table = "user";
				} else {
					$table = strtolower($item->usertype);
				}
				$query = $this->db->get_where($table, array($table.'ID' => $item->userID));
				if (count($query->row())) {
					$this->data['messages'][$key] = (object) array_merge( (array)$item, array( 'sender' => $query->row()->name));
				}
			}
		}
		if (count($this->data['messages_sent'])) {
			foreach ($this->data['messages_sent'] as $key => $item) {
				if ($item->receiverType=="Admin") {
					$table = "systemadmin";
				} elseif($item->receiverType=="Accountant" || $item->receiverType=="Librarian") {
					$table = "user";
				} else {
					$table = strtolower($item->receiverType);
				}
				$query = $this->db->get_where($table, array($table.'ID' => $item->receiverID));
				if (count($query->row())) {
					$this->data['messages_sent'][$key] = (object) array_merge( (array)$item, array( 'sender' => $query->row()->name));
				}

			}
		}
		$this->data["subview"] = "message/favorite";
		
		$this->data['activepage'] = 'message';
		$this->load->view('_layout_main', $this->data);
	}

	public function sent() {
		
		if($this->session->userdata('success_msg'))
		{  //echo "asdsa"; exit;
			$this->data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->set_userdata('success_msg','');
		}
		if($this->session->userdata('error_msg'))
		{
			$this->data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		} 
		
		$session = $this->session->userdata('logged_in');  
		$userID = $session['user']['id'];  
		$table = "";
		$this->data['messages'] = $this->message_model->get_order_by_message(array('userID' => $userID, 'from_status' => 0));
		if (count($this->data['messages'])) {
			foreach ($this->data['messages'] as $key => $item) {
				$this->data['messages'][$key]->messageID=doEncrypt($item->messageID);
				if($item->receiverType=='admin'){
					$query =  $this->message_model->getadminUser($item->receiverID); 
				}else{
					$query =  $this->message_model->getUser($item->receiverID); 
				}
				if ($query) {
					$this->data['messages'][$key] = (object) array_merge( (array)$item, array( 'sender' => $query->display_name));
				}

			}
		}
		$this->data['activepage'] = 'message';
		$this->data['theme_body'] = $this->load->view('sent', $this->data, true); 
		$this->load->view('theme/gj/inner_layout', $this->data);
		
		 
		 
	}

	public function trash() {
		
		if($this->session->userdata('success_msg'))
		{  //echo "asdsa"; exit;
			$this->data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->set_userdata('success_msg','');
		}
		if($this->session->userdata('error_msg'))
		{
			$this->data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		} 
		
		$session = $this->session->userdata('logged_in');  
		$userID = $session['user']['id']; 
		$email = $session['user']['email']; 
		$username = $session['user']['username']; 
		$this->data['messages'] = $this->message_model->get_trash_message($email,$userID);  
		 //print_r($this->data['messages']);exit;
		/* sender */
		if (count($this->data['messages'])) {
			foreach ($this->data['messages'] as $key => $item) {
				$this->data['messages'][$key]->messageID=doEncrypt($item->messageID);
				if($item->usertype == 'admin' && $item->receiverType == 'alumni'){
					 $query = $this->message_model->getadminUser($item->userID);
				 }else{
					 if($item->usertype == 'alumni' && $item->receiverType == 'alumni'){
						 $query = $this->message_model->getUser($item->userID);
					 }else if($item->usertype == 'alumni' && $item->receiverType == 'admin'){
						 $query = $this->message_model->getUser($item->userID); 
					 }else{
					$query = $this->message_model->getadminUser($item->receiverID); 
					}
				 } 
				if ($query) {
					$this->data['messages'][$key] = (object) array_merge( (array)$item, array( 'sender' => $query->display_name));
				}

			}
		}
		 $this->data['activepage'] = 'message';
		$this->data['theme_body'] = $this->load->view('trash', $this->data, true); 
		$this->load->view('theme/gj/inner_layout', $this->data);
	}

	public function fav_status() {
		$messageID = $this->input->post('id');
		$array = array();
		if((int)$messageID) {
			$this->data['message'] = $this->message_model->get_message($messageID);
			if ($this->data['message']->fav_status==0) {
				$array["fav_status"] = 1;
			} else {
				$array["fav_status"] = 0;
			}
			$this->message_model->update_message($array, $messageID);
			$string = base_url("message/index");
			echo $string;
		} else {
			redirect(base_url("message/index"));
		}

	}

	public function fav_status_sent() {
		$messageID = $this->input->post('id');
		$array = array();
		if((int)$messageID) {
			$this->data['message'] = $this->message_model->get_message($messageID);
			if ($this->data['message']->fav_status_sent==0) {
				$array["fav_status_sent"] = 1;
			} else {
				$array["fav_status_sent"] = 0;
			}
			$this->message_model->update_message($array, $messageID);
			$string = base_url("message/sent");
			echo $string;
		} else {
			redirect(base_url("message/sent"));
		}

	}

	protected function rules() {
		$rules = array(
				 array(
					'field' => 'to',
					'label' => $this->lang->line("name"),
					'rules' => 'trim|required|xss_clean|max_length[128]'
				),
				array(
					'field' => 'message',
					'label' => $this->lang->line("message"),
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'subject',
					'label' => $this->lang->line("subject"),
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'attachment',
					'label' => $this->lang->line("attachment"),
					'rules' => 'trim|xss_clean'
				)
			);
		return $rules;
	}
	public function discard() {
		    $this->data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','Message discarded');
			redirect('message/index','Location');
	}
	public function add($msgid=null) {
		
		
		if($msgid!=''){
			$sid=doDecrypt($msgid);
			$this->data['selectadminusers'] = $this->message_model->get_admin_select($sid);
		}
		$session = $this->session->userdata('logged_in'); 
	    $username = $session['user']['username'];  
		$userID = $session['user']['id']; 
		$year = date("Y");
		
		$email = $this->data['email']  = $session['user']['email'];
		$this->data['users'] = $this->message_model->get_recivers($userID);
		$this->data['adminusers'] = $this->message_model->get_admin_recivers();
		if($this->session->userdata('success_msg'))
		{  //echo "asdsa"; exit;
			$this->data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->set_userdata('success_msg','');
		}
		if($this->session->userdata('error_msg'))
		{
			$this->data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		} 
	 
		if($_POST) {
			//$rules = $this->rules();
			//$this->form_validation->set_rules($rules);
		//	if ($this->form_validation->run() == FALSE) {
		 if(0)
		 {
				$this->data['form_validation'] = validation_errors();
				$this->data["subview"] = "message/add";
				$this->load->view('_layout_main', $this->data);
			} else {
				/*if ($usertype=="Admin") {
					$table = "systemadmin";
					$tableID = "systemadminID";
				} elseif($usertype=="Accountant" || $usertype=="Librarian") {
					$table = "user";
					$tableID = "userID";
				} else {
					$table = strtolower($usertype);
					$tableID = $table."ID";
				}*/
				 
				  
			    $userdata = $this->message_model->getUser($userID); 
				$receverInfo = explode(',', $_POST['to']);
				 
				$array = array(
					"email" => $receverInfo[2],
					"receiverID" => $receverInfo[1], 
					"receiverType" => $receverInfo[0], 
					"subject" => $this->input->post("subject"),
					"message" => strip_tags($this->input->post("message")),
					"userID" => $userID, 
					"useremail" => $email,
					"usertype" => 'alumni',
					"year" => $year,
					"date" => date("Y-m-d"),
					"create_date" => date("Y-m-d H:i:s"),
					"read_status" => 0,
					"from_status" => 0,
					"to_status" => 0,
					"fav_status" => 0,
					'fav_status_sent' => 0,
					'reply_status' => 0
				);
				
				if($_FILES["attachment"]['name'] !="") {
					$file_name = $_FILES["attachment"]['name'];
					$file_name_rename = rand(1, 100000000000);
		            $explode = explode('.', $file_name);
		            if(count($explode) >= 2) {
		            	$new_file = $file_name_rename.'.'.$explode[1];
		            	if (preg_match('/\s/',$file_name)) {
							$file_name = str_replace(' ', '_', $file_name);
						} 
						$bpath = base_url()."uploads/attach/";
						$config['upload_path'] = "./uploads/attach";
						$config['allowed_types'] = "gif|jpg|png|pdf|docx|csv";
						$config['file_name'] = $new_file;
						$config['max_size'] = '1024';
						$config['max_width'] = '3000';
						$config['max_height'] = '3000';
						$array['attach'] = $file_name;
						$array['attach_file_name'] = $bpath.$new_file;
						$this->load->library('upload', $config);
						if(!$this->upload->do_upload("attachment")) {
							$this->data["attachment_error"] = $this->upload->display_errors();
							$this->data["subview"] = "message/add";
							$this->data['theme_body'] = $this->load->view('add', $this->data, true); 
							$this->load->view('theme/gj/inner_layout', $this->data);
							//$this->load->view('_layout_main', $this->data);
						} else {
							$data = array("upload_data" => $this->upload->data());
							$this->message_model->insert_message($array);
							$this->session->set_userdata('success_msg', $this->lang->line("menu_success")); 
							 
							redirect(base_url("message/index"));
						}
					} else {
						$this->session->set_userdata('error_msg', 'Invalid file'); 
						$this->data["attachment_error"] = "Invalid file";
						$this->data["subview"] = "message/add";
						$this->load->view('_layout_main', $this->data);
					}
				} else {
					 
					$this->message_model->insert_message($array);
					$this->session->set_userdata('success_msg', $this->lang->line("menu_success"));
					redirect(base_url("message/index"));
				}
			}
		} else {
			 
			 
			$this->data['activepage'] = 'message';
			$this->data['theme_body'] = $this->load->view('add', $this->data, true); 
		    $this->load->view('theme/gj/inner_layout', $this->data);
		}
	}
		public function sentview($msgid) {
		//echo $id = htmlentities(mysql_real_escape_string($this->uri->segment(3))); exit;
	 
		if($this->session->userdata('success_msg'))
		{  //echo "asdsa"; exit;
			$this->data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->set_userdata('success_msg','');
		}
		if($this->session->userdata('error_msg'))
		{
			$this->data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		} 
	 
		
	     $id = doDecrypt($msgid); 
	     
	     $session = $this->session->userdata('logged_in');  
		 $this->data['userID'] =  $session['user']['id'];
		 $this->data['sender'] = new stdClass();
		
		if((int)$id) {
			  
			$this->data['message'] = $this->message_model->get_message($id); 
			$this->data['reply_msg'] = $this->replymsg_model->get_order_by_reply_msg(array('messageID'=>$id));
			//print_r($this->data['reply_msg']);exit;
			if ($this->data['message']) {

				/*reciver info*/
				$table1 = "";
				//print_r($this->data['message'][0]);exit;
				 if($this->data['message'][0]->receiverType == 'admin'){
					 $query = $this->message_model->getadminUser($this->data['message'][0]->receiverID);
				 }else{
					$query = $this->message_model->getUser($this->data['message'][0]->receiverID); 
				 }
				$this->data['reciver'] = $query;
				 if($this->data['message'][0]->usertype=='admin' && $this->data['message'][0]->receiverType=='alumni'){
					if($query->profile_thumb_image==''){
						$this->data['reciver']->profile_thumb_image= ASSETS."assets/img/emp-none.png";
					}
				}else if($this->data['message'][0]->usertype=='alumni' && $this->data['message'][0]->receiverType=='admin'){
							if($query->profile_thumb_image==''){
								//$this->data['reciver']->profile_thumb_image= '';
							}
							if($query->profile_image==''){
								$this->data['reciver']->profile_image= ASSETS."assets/img/emp-none.png";
							}
				}else{
					if($query->profile_thumb_image==''){
								$this->data['reciver']->profile_thumb_image= ASSETS."assets/img/emp-none.png";
							}
				}
				//print_r($this->data['reciver']);exit;
				/*reciver info end*/
				/*sender info*/
			 
				 
				$query = $this->message_model->getUser($this->data['message'][0]->userID);
				if($query){
					$this->data['sender'] = $query;
					if($query->profile_thumb_image==''){
						$this->data['sender']->profile_thumb_image = ASSETS."assets/img/emp-none.png";
					}
				} else {
					$this->data['sender']->email = $this->data['message'][0]->useremail;
					$this->data['sender']->profile_thumb_image = "defualt.png";
				}
				//print_r($this->data);exit;
				/* Change read status*/
				$read_status = array();
				if($this->data['userID']==$this->data['message'][0]->receiverID && $usertype==$this->data['message'][0]->receiverType) {
					$read_status['read_status'] = 1;
				} else {
					$read_status['reply_status'] = 0;
				}
				$this->message_model->update_message($read_status, $id);
				/*sender info end*/
				 $this->data['activepage'] = 'message';
				$this->data['theme_body'] = $this->load->view('sentview', $this->data, true); 
		        $this->load->view('theme/gj/inner_layout', $this->data);
				 
			} else {
				$this->data['activepage'] = 'message';
				$this->data["subview"] = "error";
				$this->load->view('theme/gj/inner_layout', $this->data);
			}
		} else {
			$this->data['activepage'] = 'message';
			$this->data["subview"] = "error";
			$this->load->view('theme/gj/inner_layout', $this->data);
		}
	}
		
	public function inboxview($msgid) {
		//echo $id = htmlentities(mysql_real_escape_string($this->uri->segment(3))); exit;
	 
		if($this->session->userdata('success_msg'))
		{  //echo "asdsa"; exit;
			$this->data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->set_userdata('success_msg','');
		}
		if($this->session->userdata('error_msg'))
		{
			$this->data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		} 
	 
		
	     $id = doDecrypt($msgid); 
	     
	     $session = $this->session->userdata('logged_in'); 
		 $this->data['userID'] =  $session['user']['id'];
		 $this->data['sender'] = new stdClass();
		//$usertype = $this->session->userdata('usertype');
		if((int)$id) {
			  
			$this->data['message'] = $this->message_model->get_message($id); 
			$this->data['reply_msg'] = $this->replymsg_model->get_order_by_reply_msg(array('messageID'=>$id));
			if ($this->data['message']) {
//print_r($this->data['reply_msg']);exit;
				/*reciver info*/
				$table1 = "";
				 if($this->data['message'][0]->usertype=='admin' && $this->data['message'][0]->receiverType == 'alumni'){
					 $query = $this->message_model->getUser($this->data['message'][0]->receiverID);
				 }else{
					 if($this->data['message'][0]->usertype=='alumni' && $this->data['message'][0]->receiverType == 'alumni'){
						 $query = $this->message_model->getUser($this->data['message'][0]->receiverID);
					 }else{
					$query = $this->message_model->getadminUser($this->data['message'][0]->userID);
					}
				}
				 
				//$query = $this->message_model->getUser($this->data['message'][0]->receiverID); 
				$this->data['reciver'] = $query;
				if($this->data['message'][0]->usertype=='admin'){
					if($this->data['message'][0]->usertype=='admin' && $this->data['message'][0]->receiverType == 'alumni'){
						if($query->profile_thumb_image==''){
							$this->data['reciver']->profile_thumb_image= ASSETS."assets/img/emp-none.png";
						}
						
					}
					}else{
						if($query->profile_thumb_image==''){
							$this->data['reciver']->profile_thumb_image= ASSETS."assets/img/emp-none.png";
						}
					}
					//print_r($this->data['reciver']);exit;
				/*reciver info end*/
				/*sender info*/
			 
				 if($this->data['message'][0]->usertype=='admin' && $this->data['message'][0]->receiverType == 'alumni' ){
					 $query = $this->message_model->getadminUser($this->data['message'][0]->userID);
				 }else{
					$query = $this->message_model->getUser($this->data['message'][0]->userID);
				}//print_r($query);exit;
				//$query = $this->message_model->getUser($this->data['message'][0]->userID);
				$this->data['sender'] = $query;
				if($this->data['message'][0]->usertype=='admin' && $this->data['message'][0]->receiverType=='alumni'){
					if(isset($query->profile_thumb_image) && $query->profile_thumb_image==''){
						$this->data['sender']->profile_thumb_image= ASSETS."assets/img/emp-none.png";
					}
					if($query->profile_image==''){
								$this->data['sender']->profile_image= ASSETS."assets/img/emp-none.png";
							}
				}else if($this->data['message'][0]->usertype=='alumni' && $this->data['message'][0]->receiverType=='admin'){
							if($query->profile_thumb_image==''){
								$this->data['sender']->profile_thumb_image= ASSETS."assets/img/emp-none.png";
							}
				}else{
					if($query->profile_thumb_image==''){
								$this->data['sender']->profile_thumb_image= ASSETS."assets/img/emp-none.png";
							}
				}
			//print_r($this->data['sender']);exit;
				/* Change read status*/
				$read_status = array();
				//if($this->data['userID']==$this->data['message'][0]->receiverID && $usertype==$this->data['message'][0]->receiverType) {
				if($this->data['userID']==$this->data['message'][0]->receiverID ) {
					$read_status['read_status'] = 1;
				} else {
					$read_status['reply_status'] = 0;
				}
				$this->message_model->update_message($read_status, $id);
				/*sender info end*/
				 $this->data['activepage'] = 'message';
				$this->data['theme_body'] = $this->load->view('inboxview', $this->data, true); 
		        $this->load->view('theme/gj/inner_layout', $this->data);
				 
			} else {
				$this->data['activepage'] = 'message';
				$this->data["subview"] = "error";
				$this->load->view('theme/gj/inner_layout', $this->data);
			}
		} else {
			$this->data['activepage'] = 'message';
			$this->data["subview"] = "error";
			$this->load->view('theme/gj/inner_layout', $this->data);
		}
	}
		public function trashview($msgid) {
		//echo $id = htmlentities(mysql_real_escape_string($this->uri->segment(3))); exit;
	 $this->data['activepage'] = 'message';
		if($this->session->userdata('success_msg'))
		{  //echo "asdsa"; exit;
			$this->data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->set_userdata('success_msg','');
		}
		if($this->session->userdata('error_msg'))
		{
			$this->data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		} 
	 
		
	     //$id = htmlentities($msgid); 
	     $id = doDecrypt($msgid); 
	     
	     $session = $this->session->userdata('logged_in');  
		 $this->data['userID'] =  $session['user']['id'];
		 $this->data['sender'] = new stdClass();
		
		if((int)$id) {
			  
			$this->data['message'] = $this->message_model->get_message($id); 
			$this->data['reply_msg'] = $this->replymsg_model->get_order_by_reply_msg(array('messageID'=>$id));
			if ($this->data['message']) {

				/*reciver info*/
				$table1 = "";
				 
				 if($this->data['message'][0]->receiverType == 'admin'){
					 $query = $this->message_model->getadminUser($this->data['message'][0]->receiverID);
				 }else{
					$query = $this->message_model->getUser($this->data['message'][0]->receiverID); 
				 }
				//$query = $this->message_model->getUser($this->data['message'][0]->receiverID); 
				$this->data['reciver'] = $query;
			 if($this->data['message'][0]->usertype=='admin' && $this->data['message'][0]->receiverType=='alumni'){
					if($query->profile_thumb_image==''){
						$this->data['reciver']->profile_thumb_image= ASSETS."assets/img/emp-none.png";
					}
				}else if($this->data['message'][0]->usertype=='alumni' && $this->data['message'][0]->receiverType=='admin'){
							if($query->profile_thumb_image==''){
								//$this->data['reciver']->profile_thumb_image= '';
							}
							if($query->profile_image==''){
								$this->data['reciver']->profile_image= ASSETS."assets/img/emp-none.png";
							}
				}else{
					if($query->profile_thumb_image==''){
								$this->data['reciver']->profile_thumb_image= ASSETS."assets/img/emp-none.png";
							}
				}
				
				/*reciver info end*/
				/*sender info*/
			 
				 if($this->data['message'][0]->receiverType=='alumni' && $this->data['message'][0]->usertype=='admin'){
					 $query = $this->message_model->getadminUser($this->data['message'][0]->userID);
					 
				 }else{
					 if($this->data['message'][0]->receiverType=='alumni' && $this->data['message'][0]->usertype=='alumni'){
						$query = $this->message_model->getUser($this->data['message'][0]->userID);
					}else{
						$query = $this->message_model->getUser($this->data['message'][0]->userID);
					}
				}
				//$query = $this->message_model->getUser($this->data['message'][0]->userID);
				$this->data['sender'] = $query;
				if($this->data['message'][0]->usertype=='admin' && $this->data['message'][0]->receiverType=='alumni'){
					if(isset($query->profile_thumb_image) && $query->profile_thumb_image==''){
						$this->data['sender']->profile_thumb_image= ASSETS."assets/img/emp-none.png";
					}
					if($query->profile_image==''){
						$this->data['sender']->profile_image= ASSETS."assets/img/emp-none.png";
					}
				}else if($this->data['message'][0]->usertype=='alumni' && $this->data['message'][0]->receiverType=='admin'){
							if($query->profile_thumb_image==''){
								$this->data['sender']->profile_thumb_image= ASSETS."assets/img/emp-none.png";
							}
				}else{
					if($query->profile_thumb_image==''){
								$this->data['sender']->profile_thumb_image= ASSETS."assets/img/emp-none.png";
							}
				}
					//print_r($this->data['sender']);exit;
				/*if($query){
					$this->data['sender'] = $query;
				} else {
					$this->data['sender']->email = $this->data['message'][0]->useremail;
					$this->data['sender']->profile_thumb_image = "defualt.png";
				}*/
				
				/* Change read status*/
				$read_status = array();
				if($this->data['userID']==$this->data['message'][0]->receiverID && $usertype==$this->data['message'][0]->receiverType) {
					$read_status['read_status'] = 1;
				} else {
					$read_status['reply_status'] = 0;
				}
				$this->message_model->update_message($read_status, $id);
				/*sender info end*/
				 
				$this->data['theme_body'] = $this->load->view('trashview', $this->data, true); 
		        $this->load->view('theme/gj/inner_layout', $this->data);
				 
			} else {
				$this->data["subview"] = "error";
				$this->load->view('theme/gj/inner_layout', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('theme/gj/inner_layout', $this->data);
		}
	}

	public function delete_inbox() {
		$this->data['activepage'] = 'message';
		//mysql_real_escape_string
		$id = htmlentities($this->input->post('id'));
		if($id) {
			$array = array();
			$array = explode(',', $id);
			$update_array = array();
			foreach ($array as $value) {
				$update_array['to_status']  = 1;
				$val = doDecrypt($value);
				$this->message_model->update_message($update_array, $val);
			}
			$this->session->set_userdata('success_msg', 'Moved to trash!');	
			 
			echo base_url("message/index");
		} else {
			echo base_url("message/index");
		}
		exit; 
	}

	public function delete_sent() {
		//mysql_real_escape_string
		$id = htmlentities($this->input->post('id'));
		if($id) {
			$array = array();
			$array = explode(',', $id);
			$update_array = array();
			foreach ($array as $value) {
				$val=doDecrypt($value);
				$update_array['from_status']  = 1;
				$this->message_model->update_message($update_array, $val);
			}
			 
			$this->session->set_userdata('success_msg', 'moved to trash!');
			echo base_url("message/sent");
		} else {
			echo base_url("message/sent");
		}
		exit;
	}

	public function delete_trash() {
		$session = $this->session->userdata('logged_in');  
		$userID =  $session['user']['id']; 
	    //mysql_real_escape_string
		$id = htmlentities($this->input->post('id'));
		if($id) {
			$array = array();
			$array = explode(',', $id);
			$update_array = array();
			foreach ($array as $value) {
				if($value != '') {
					$val=doDecrypt($value);
					$this->data['message'] = $this->message_model->get_message($val);
					if($this->data['message'][0]->receiverID==$userID) {
						$update_array['to_status']  = 2;
					} else {
						$update_array['from_status']  = 2;
					}
					$this->message_model->update_message($update_array, $val);
				}
			}
			$this->session->set_userdata('success_msg', 'Message deleted!');
		 
			echo base_url("message/trash");
		} else {
			echo base_url("message/trash");
		}
		exit;
	}

	public function restore_message() {
		$session = $this->session->userdata('logged_in');  
		$userID =  $session['user']['id'];  
		//mysql_real_escape_string 
		$id = htmlentities($this->input->post('id'));
		
		if($id) {
			$array = array();
			$array = explode(',', $id);
			$update_array = array();
			foreach ($array as $value) {
				if($value != '') {
					$val=doDecrypt($value);
					$this->data['message'] = $this->message_model->get_message($val);
					if($this->data['message'][0]->receiverID==$userID) {
						$update_array['to_status']  = 0;
					} else {
						$update_array['from_status']  = 0;
					}
					$this->message_model->update_message($update_array, $val);
				}
			}
			$this->session->set_userdata('success_msg', 'Message restored!');
			 
			echo base_url("message/trash");
		} else {
			echo base_url("message/trash");
		}
		exit;
	}

	public function reply_msg() {
		
	     $session = $this->session->userdata('logged_in');  
		$userID =  $session['user']['id'];
		 
		if ($_POST) {
			$id = $this->input->post('id');
			$uid = doEncrypt($this->input->post('id'));
			$message = $this->input->post('message');
			$type = $this->input->post('type');
			$this->data['message'] = $this->message_model->get_message($this->input->post('id'));
			$array = array();
			$active = array();
			$array = array(
				"messageID" => $id,
				"reply_msg" => $message,
				"create_time" => date("Y-m-d H:i:s")
			);
			if ($this->data['message'][0]->receiverID == $userID ) {
				$array['status'] = 0;
				$active['reply_status'] = 1;
			} else {
				$array['status'] = 1;
				$active['read_status'] = 0;
			}
			$active['create_date'] = date("Y-m-d H:i:s");
			if($this->replymsg_model->insert_reply_msg($array) && $this->message_model->update_message($active, $id)) {
				// $this->message_model->update_message($active, $id);
				$this->session->set_userdata('success_msg', 'Message sent!');
				 
				echo base_url("message/".$type."/view/$uid");
			} else {
				echo base_url("message/".$type."/view/$uid");
				$this->session->set_userdata('error_msg','Reply not sent!');
				 
			}
			exit;
		}

	}

	public function userID() {

		$usertype = $this->session->userdata('usertype');
		$username = $this->session->userdata('username');
		if ($usertype=="Admin") {
			$table = "systemadmin";
			$tableID = "systemadminID";
		} elseif($usertype=="Accountant" || $usertype=="Librarian") {
			$table = "user";
			$tableID = "userID";
		} else {
			$table = strtolower($usertype);
			$tableID = $table."ID";
		}
		$query = $this->db->get_where($table, array('username' => $username));
		$userID = $query->row()->$tableID;
		return $userID;
	}

	public function unreadCounter()
	{
		$session = $this->session->userdata('logged_in'); 
		$id = $session['user']['id']; 
		$array = array();
		 
		$array['inbox'] = $this->message_model->counter(array("read_status" => 0, "to_status" => 0, "receiverID" => $id));
		$array['send'] = $this->message_model->counter(array("reply_status" => 1, "from_status" => 0, "userID" => $id)); 
		echo json_encode($array); exit;
	}

}//doDecrypt,doEncrypt
