<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
	    parent::__construct();
		$this->lang->load("adminsite", language_load());
	}
	
	public function index()
	{
		 
		 $data = array();	
		  echo "asdsa"; exit;
		 //$this->session->unset_userdata('scms_admin_users');
		 $this->load->view('captial/index.php', $data);
		 
	}
	
	public function login()
	{ //print_r($_POST);exit;
		$this->form_validation->set_rules('email', 'User Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() == FALSE) {
			$this->form_validation->set_message('check_database', 'Invalid Username and Password');
		}
		else {
			$user = $this->input->post('email');
			$pass = $this->input->post('password');
			
			$this->load->model('loginmodel');
			$result = $this->loginmodel->userlogin($user, $pass);
			 
			 
		     
			if (!$result) {
				$response = array();
				$response['status']=false;
				$response['error'] = $this->lang->line("admin_login_error");
				echo json_encode($response);
			} else { 
				$this->session->set_userdata('scms_admin_users', $result[0]);	 
				$response = array();
				$response['status']=true;
				$response['success'] = $this->lang->line("admin_redirecting");
				echo json_encode($response);
			}
		}
		exit;
	}

	 

	public function logout()
	{
		$session_id = $this->session->userdata('scms_admin_users');
		$this->session->unset_userdata('scms_admin_users');
		$this->session->sess_destroy();
		redirect('captial/', 'refresh');
	}

 
}
