<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author: srihari
 * @Created Date: may 28 2013
 * 
 */

class Admin extends CI_Controller {

	public function __construct() {
	    parent::__construct();
		$this->lang->load("adminsite", language_load());
	}
	
	public function index()
	{
		 $data = array();	
		 $this->session->unset_userdata('scms_admin_users');
		 $this->load->view('admin/login_layout.php', $data);
	}
	
	public function login()
	{  
		//$this->form_validation->set_rules('email', 'User Email', 'trim|required|valid_email');
		//$this->form_validation->set_rules('password', 'Password', 'required');
		
		//if($this->form_validation->run() == FALSE) {
			 
			//$this->form_validation->set_message('check_database', 'Invalid Username and Password');
		//}
		//else {
			$user = $this->input->post('email');
			$pass = $this->input->post('password');
			
			$this->load->model('adminloginmodel');
			$result = $this->adminloginmodel->loginAdmin($user, $pass);
			 
			 
		     
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
		//}
		exit;
	}

	public function dashboard()
	
	{  
		  if(!adminLoginCheck()){
		    redirect('admin','refresh');
		  }
		  
		$data=array();
		$this->load->model('adminloginmodel');
		//$data['countlist'] = $this->load->adminloginmodel->userslistcount();
		//$data['categorylist'] = $this->load->adminloginmodel->categorycount();
		//$data['questions'] = $this->load->adminloginmodel->questionscount();
		//$data['exams'] = $this->load->adminloginmodel->examscount();
		$data['body'] = $this->load->view('admin/dashboard',$data,true);
		$this->load->view('admin/layout',$data);
	}	
	
	public function edituserprofile_1()	
	{  
		  if(!adminLoginCheck()){
		    redirect('admin','refresh');
		  }
		  
		$data=array();
		//$this->load->model('adminloginmodel');
		$data['body'] = $this->load->view('admin/editprofile',$data,true);
		$this->load->view('admin/layout',$data);
	}
	
	public function changepassword1()	
	{  
		  if(!adminLoginCheck()){
		    redirect('admin','refresh');
		  }
		
		$data=array();
		$data['body'] = $this->load->view('admin/changepassword',$data,true);
		$this->load->view('admin/layout',$data);
	}
	
	public function upload1()
	{
		$name = '';
		$path = '';
		$name = $_FILES["images"]["name"];
		$path = "/var/www/cms/assets/images/photos/profileimages/";

		$sizekb = $_FILES["images"]["size"] / 1024 ;
		$sizemb = $sizekb / 1024;
		$name = time()."_".$name;
		//die($name."--".$path);		
		if(move_uploaded_file( $_FILES["images"]["tmp_name"], $path.$name))
        {
	        echo $name."|".number_format($sizemb, 2, '.', '');
	        exit;
        }
		
	}
	
	
	public function updateprofile1()
	{
		if(!adminLoginCheck()){
			redirect('admin/', 'refresh');
		}
		
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$arr=array();
			$arr['admin_displayname'] = $this->input->post('pUsername');
			$arr['admin_email']       = $this->input->post('pEmail');
			$arr['admin_status']      = $this->input->post('pStatus');
			$arr['admin_img']         = $this->input->post('pImg');
				 
			$this->load->model('adminloginmodel');
			
			$result = $this->adminloginmodel->saveupdateprofile1($arr);
			
			if($result){
  				$response = array();
				$response['status']=true;
				$response['success'] = "Successfully";
				echo json_encode($response);exit;
			}
			else{
  				$response = array();
				$response['status']=false;
				$response['error'] = "Fail";
				echo json_encode($response);exit;
			}			
		} 
		else
		{
 			$data=array();
			$data['body'] = $this->load->view('admin/addpage',$data,true);
			$this->load->view('admin/layout',$data);
		}
	}
			
	
	public function logout()
	{
		$session_id = $this->session->userdata('scms_admin_users');
		$this->session->unset_userdata('scms_admin_users');
		//$this->session->sess_destroy();
		redirect('admin/', 'refresh');
	}
	
	public function cpass()
	{
		if(!adminLoginCheck()){
			redirect('admin/', 'refresh');
		}
		//if($this->input->server('REQUEST_METHOD') == 'POST' && $this->changepassvalidation()){
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$arr=array();
			$arr['oldpass'] = md5($this->input->post('oPass'));
			$arr['newpass'] = md5($this->input->post('nPass'));
			$arr['cpass']   = md5($this->input->post('cPass'));
				 
			$this->load->model('adminloginmodel');
			
			$result = $this->adminloginmodel->changepass($arr);
			if($result){
				$response = array();
				$response['status']=true;
				$response['success'] = $this->lang->line("admin_site_cpass_success");
				echo json_encode($response);exit;
			}else{
				$response = array();
				$response['status']=false;
				$response['error'] = $this->lang->line("admin_site_cpass_failure");
				echo json_encode($response);exit;
			}
			
		} 
		else{
			$data=array();
			$data['body'] = $this->load->view('admin/changepassword',$data,true);
			$this->load->view('admin/layout',$data);
		}
	}
	
	
	public function settings()
	{
		  if(!adminLoginCheck()){
		    redirect('admin','refresh');
		  }
		 if($this->input->server('REQUEST_METHOD') == 'POST' && $this->settingsvalidation()){
		 	$arr=array();
		 	$arr['dateformate']=$this->input->post('dateformate');
		 	$arr['perpage']=$this->input->post('perpage');
		 	$jdata=json_encode($arr);
		 	$this->load->model('adminloginmodel');
		 	$result = $this->adminloginmodel->adminsetting($jdata);
		 	if($result){
		 		  $response=array();
		 		  $response['status']=true;
		 		  $response['success']=$this->lang->line('admin_site_set_success');
		 		  echo json_encode($response);exit;
		 		  
		 	}else{
		 		$response=array();
		 		$response['status']=false;
		 		$response['failure']=$this->lang->line('admin_site_set_failure');
		 		echo json_encode($response);exit;
		 		  }
		}else{
			$data = array();
			$data['body'] = $this->load->view('admin/settings_form', $data, true);
			$this->load->view('admin/layout',$data);
		}
	}
	public function profile()
	{
		
	}
	
	public function loginstatus()
	{
		
	}
	public function settingsvalidation()
	{
		$this->form_validation->set_rules('dateformate','Date Formate','required');
		$this->form_validation->set_rules('perpage', 'Perpage', 'required');
			
		if ($this->form_validation->run() == FALSE){
			return false;
		}else{
			return true;
		}
		
	}
	public function changepassvalidation()
	{
		$this->form_validation->set_rules('admin_pass','Old Password','required');
		$this->form_validation->set_rules('newpass', 'Password', 'required|matches[cpass]');
		$this->form_validation->set_rules('cpass', 'Password Confirmation', 'required');
		 
		if ($this->form_validation->run() == FALSE){
			return false;
		}else{
			return true;
		}
		 
	}
	
/**
 *  Language Switch Using Ajax
 *  
 */	
	function switchLanguage() {
		$lang = $this->input->get('lang');
		$language = ($lang != "") ? $lang : "english";
		$this->session->set_userdata('site_lang', $language);
	}
}
