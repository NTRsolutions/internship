<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {

/*
 * @author:Shafi
 * adding adduser,update,delete functions
 * 
 */
	public function __construct() 
    {
              
		parent::__construct();
		$this->lang->load("adminsite",  language_load());
		$this->lang->load("adminpages", language_load());
	}
	
	public function index()
	{
             
           
		$data = array();
		$this->load->model('admin_page_model');
		$data['list'] = $this->admin_page_model->pagelist('');
		$data['body'] = $this->load->view('admin_page_list', $data, true);
            
		if($this->input->post('ajaxcall') == 'true')
		{
			echo $data['body']; exit;
		}
		$this->load->view('admin/layout',$data);
	}
	
	/**
	 * 
	 * Page Management
	 * 
	 * */
	
	public function adduser1()
	{
	   if(!adminLoginCheck()){
		    redirect('admin','refresh');
		  }
		  
		$data=array();
		$data['body'] = $this->load->view('adduser',$data,true);
		$this->load->view('admin/layout',$data);
	}
	
	public function saveuser1()
	{
		if(!adminLoginCheck()){
			redirect('admin/', 'refresh');
		}
		
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$arr=array();
			$arr['admin_displayname'] = $this->input->post('uDisplayname');
			$arr['admin_email']       = $this->input->post('uEmail');
			$arr['admin_status']      = $this->input->post('uStatus');
			$arr['admin_role']        = $this->input->post('uRole');
				 
			$this->load->model('admin_user_model');
			
			$result = $this->admin_user_model->saveuserdata($arr);
			
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

	public function userslist1()
	{	

		 if(!adminLoginCheck()){
		    redirect('admin','refresh');
		  }
		  
        
        $this->load->model('admin_user_model'); 
        $data['list'] = $this->admin_user_model->userlist('');  
		$data['body'] = $this->load->view('userslist',$data,true);
		$this->load->view('admin/layout',$data);
	}
	
	public function edituserform1()
	{
		$user_id = $this->uri->segment(4);
		$this->load->model('admin_user_model');
		$data['udata'] = $this->admin_user_model->useredit($user_id);
		$data['body'] = $this->load->view('edituser',$data,true);
		$this->load->view('admin/layout',$data);
	}
	
    public function updateuser1()
	{
		if(!adminLoginCheck()){
			redirect('admin/', 'refresh');
		}
		
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$arr=array();
			$arr['admin_displayname'] = $this->input->post('uDisplayname');
			$arr['admin_email']       = $this->input->post('uEmail');
			$arr['admin_status']      = $this->input->post('uStatus');
			$arr['admin_role']        = $this->input->post('uRole');
			$arr['admin_id']        = $this->input->post('uId');
				 				 
			$this->load->model('admin_user_model');
			
			$result = $this->admin_user_model->userupdate($arr);
			
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
	
	public function deleteuserform1()
	{
		$this->load->model('admin_user_model');
		$user_id = $this->uri->segment(4);
		$result = $this->admin_user_model->deleteuser($user_id);

		$response=array();
		if($result){
			
			$response['status'] = true;
			$response['success'] = $this->lang->line('adminusers_success');			
			$this->session->set_userdata('pdelsuccess', $response['success']);	
			redirect('admin/users/userslist1');
			exit;
		}else{
			$response['status']=false;
			$response['error']=$this->lang->line('adminusers_error');
		}
		
		
	}
	
	
	/**
	 * 
	 * Page Management
	 * 
	 * */
  
  
  
  
  
  
  
  
  
	public function addusers()
	{
		 
		$this->getForm();
	}
	

        
        public function adminvalidateForm()
        {
        	 
           
           $this->form_validation->set_rules('page_title','Email','required');
           $this->form_validation->set_rules('page_alias','Password','required');
           $this->form_validation->set_rules('page_description','Display Name','required');
           
           if ($this->form_validation->run() == FALSE){
                 return false;
           }else{
                 return true;
            }
         
        } 

        public function insert()
        {
        	 
        	$arr = array();
        	$arr['page_title'] = $this->input->post('page_title');
        	$arr['page_alias'] = $this->input->post('page_alias');
        	$arr['page_description'] = $this->input->post('page_description');
        	$arr['page_meta_title'] = $this->input->post('page_meta_title');
        	$arr['page_meta_keywords'] = $this->input->post('page_meta_keywords');
        	$arr['page_meta_description'] = $this->input->post('page_meta_description'); 
        	$arr['page_status'] = $this->input->post('page_status');
        	$arr['created_date']=date('Y-m-d H:i:s');
        	$this->load->model('admin_page_model');
        	$result = $this->admin_page_model->pageinsert($arr);
        	if($result){
        		$response=array();
        		$response['status']=true;
        		$response['success']=$this->lang->line('admin_page_insertsuccessfully');
        		echo json_encode($response);exit;
        	}else{
        		$response=array();
        		$response['status']=false;
        		$response['error']=$this->lang->line('adminusers_tittlereadyexits');
        		echo json_encode($response);exit;
        	}
        	
        }
        public function update()
        {
        	$adminusers = array();
        	$arr = array();
        	$arr['page_id']=$this->input->post('page_id');
        	$arr['page_title'] = $this->input->post('page_title');
        	$arr['page_alias'] = $this->input->post('page_alias');
        	$arr['page_description'] = $this->input->post('page_description');
        	$arr['page_meta_title'] = $this->input->post('page_meta_title');
        	$arr['page_meta_keywords'] = $this->input->post('page_meta_keywords');
        	$arr['page_meta_description'] = $this->input->post('page_meta_description');
        	$arr['page_status'] = $this->input->post('page_status');
        	$arr['modified_date']=date('Y-m-d H:i:s');
        	$this->load->model('admin_page_model');
        	$result = $this->admin_page_model->pageupdate($arr);
        	if($result){	
        		$response=array();
        		$response['status']=true;
        		$response['success']=$this->lang->line('admin_page_updatesuccessfully');
        		echo json_encode($response);exit;
        	}else{
        		$response=array();
        		$response['status']=false;
        		$response['error']=$this->lang->line('adminusers_tittlereadyexits');
        		echo json_encode($response);exit;
        	}
        	
        }
 
}
