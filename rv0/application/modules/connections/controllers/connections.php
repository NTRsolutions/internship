<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connections extends CI_Controller {


   
/**
 * 	 author: 
 *   created Date: 15 june 2013
 *   
 */
   public function __construct() 
   {
    parent::__construct();
        isEmailVerified();
		//$this->lang->load("adminsite",  language_load());
		$this->load->model('connections_model');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('digitalemail');
		$this->load->library('googlemaps');
		$this->load->library('pagination');
		
		//$this->load->library('gweather');

	}
	public function index()
	{  
	    $data = array();
		$data['activepage'] = 'connection';
		$this->load->library('encrypt');
		$connections = $this->connections_model->GetallConnectionscount();
		/*check user is loggedin*/
		$data['logged'] = false;
		$session = $this->session->userdata('logged_in');
	    if(isset($session['user']['id']))
	       $data['logged'] = true;
		
		
		//pagination settings
        $config['base_url'] = site_url('connections/index');
        //$config['total_rows'] = $this->db->count_all('tbl_books');
        $config['total_rows'] = $connections;
        $config['per_page'] = 21;
        $config["uri_segment"] = 3;
        $config['page_query_string'] = FALSE;
        $choice = $config["total_rows"]/$config["per_page"];
        //$config["num_links"] = floor($choice);
        $config["num_links"] = 4;

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
		 
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;  
        
		$result = $this->connections_model->GetallConnections($config["per_page"], $data['page'], $_POST);
		foreach($result as $key=>$val){ 
		
		  $result[$key]->id = doEncrypt($val->id);
		  if(isset($val->last_accessed_on) && $val->last_accessed_on !='0000-00-00 00:00:00'  ) { 	
		    $result[$key]->last_accessed_on=time_elapsed_string(strtotime($val->last_accessed_on));
	      }else
	         $result[$key]->last_accessed_on='';
	  }
		$data['pagination'] = $this->pagination->create_links();
		$data['connections']=$result;
		$data['totalcount']=$connections;
		//print_r($data);exit;
		 
		$data['theme_body'] = $this->load->view('connections_list', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function connectiondetails()
	{
		 isLoggedin();
		$data = array();
		$data['activepage'] = 'connection';
		$connection = $this->connections_model->Getconnectiondetails($this->uri->segment(3));
		$data['connection']=$connection[0];
		$data['theme_body'] = $this->load->view('connections_details', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function activity() {
		 
		$uid = $this->uri->segment(3);
		$data = array(); 
		$data['activepage'] = 'connection';
		if($uid=='')
		 redirect('/','Location');
		else
		 $uid = doDecrypt($uid);
		 
		 $data['coverpageUpdate'] = 0;
		 $session = $this->session->userdata('logged_in');
	     $session_uid = $session['user']['id'];
	     if($session_uid==$uid)
	     {
			  $data['coverpageUpdate'] = 1;
		 }
		 
		$viewConnection = $uid;
		$connection = $this->connections_model->Getconnectiondetails($viewConnection);
		$connection[0]->id= doEncrypt($connection[0]->id);
		$data['connection']=$connection[0];
		
		$pastdata = $this->connections_model->getActivities($viewConnection);
		$data['pastdata']=$pastdata; 
		 foreach($data['pastdata'] as $k=>$v)
		{
			  $pastdata[$k]->editable = 0;
			  if(isset($session['user']['id']) && $v->user_id==$session['user']['id'])
			  {
				   $pastdata[$k]->editable = 1;
			  }
			  $data['pastdata'][$k]->action_item_id = doEncrypt($v->action_item_id);
			  $data['pastdata'][$k]->id = doEncrypt($v->id); 
		}
		$data['userid'] =  doEncrypt($viewConnection); 
		$data['theme_body'] = $this->load->view('connections_active', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function profile()
	{
		 isLoggedin();
	    $uid = $this->uri->segment(3);
		$data = array();
		$data['activepage'] = 'connection'; 
		if($uid=='')
		 redirect('/','Location');
		else
		 $uid = doDecrypt($uid);
		 
		 /* who is updating cover page*/
		 $data['coverpageUpdate'] = 0;
		 $session = $this->session->userdata('logged_in');
	     $session_uid = $session['user']['id'];
	     if($session_uid==$uid)
	     {
			  $data['coverpageUpdate'] = 1;
		 }
		 
		$connection = $this->connections_model->Getconnectiondetails($uid);
		$connection[0]->id= doEncrypt($connection[0]->id);
		$data['connection']=$connection[0];
		//get user roles names
		$this->load->model('user/user_model');
		//$alumnirole = $this->user_model->getRoleID($session_uid);
		$alumnirole = $this->user_model->getRoleID($uid);
		foreach($alumnirole as $k=>$v){
			$urole[]=$v->role_id;
		}
		$r=implode(',',$urole);
		$role = $this->connections_model->GetconnectionRolenames($r);
		if(!$role){
			$role='';
		}
		//print_r($role);exit;
		$data['rolenames']=$role;
		$data['theme_body'] = $this->load->view('connections_profile', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function search()
	{
		
	    /* if($this->input->post('searchname')==''){
			redirect('/connections','location');	
	     }*/
		 
		 //print_r($_REQUEST['searchname']);exit;
		$data = array();
		$data['activepage'] = 'connection';
		$search = $this->connections_model->Getsearchcount($_REQUEST);
		$data['totalcount']=$search;
		//pagination settings
        $config['base_url'] = site_url('connections/search');
        //$config['total_rows'] = $this->db->count_all('tbl_books');
        $config['total_rows'] = $search;
        $config['per_page'] = "21";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        //$config["num_links"] = floor($choice);
        $config["num_links"] = 4;

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
		$config['suffix'] = '/?searchname='.$_REQUEST['searchname'];
        //$config['base_url'] = base_url().'questions/search/';
        $this->pagination->initialize($config);
		 
		 
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
       
	    $result = $this->connections_model->Getsearch($config["per_page"], $data['page'], $_REQUEST);
		foreach($result as $key=>$val){ 
		
		  $result[$key]->id = doEncrypt($val->id);
		   if(isset($val->last_accessed_on) && $val->last_accessed_on !='0000-00-00 00:00:00') { 	
		    $result[$key]->last_accessed_on=time_elapsed_string(strtotime($val->last_accessed_on));
	      }else{
	         $result[$key]->last_accessed_on='';
		  }
	   }
	    $data['pagination'] = $this->pagination->create_links();
		//print_r( $data['pagination']);exit;
		$data['connections']=$result;
		$data['logged'] = false;
		$session = $this->session->userdata('logged_in');
	    if(isset($session['user']['id']))
	       $data['logged'] = true;
		$data['searchname']=$this->input->post('searchname');
		$data['theme_body'] = $this->load->view('connections_list', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
		 
	}
	
   function filters()
   {
	    
		
	   $arr['filter']=$this->uri->segment(3);
	   $data = array();
	   $data['filter']=$this->uri->segment(3);
		$search = $this->connections_model->Getsearchcount($arr);
		$data['totalcount']=$search;
		//pagination settings
        $config['base_url'] = site_url('connections/filters/'.$arr['filter']);
        //$config['total_rows'] = $this->db->count_all('tbl_books');
        $config['total_rows'] = $search;
        $config['per_page'] = "21";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
        //$config["num_links"] = floor($choice);
        $config["num_links"] = 4;

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
		
          $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; 
       
		
		
		$result = $this->connections_model->Getsearch($config["per_page"], $data['page'], $arr);
		$data['pagination'] = $this->pagination->create_links(); 
		 foreach($result as $key=>$val){
			  $result[$key]->id = doEncrypt($val->id);
			 if(isset($val->last_accessed_on) && $val->last_accessed_on!='0000-00-00 00:00:00') { 	
			  $result[$key]->last_accessed_on=time_elapsed_string(strtotime($val->last_accessed_on));
			  }else
				 $result[$key]->last_accessed_on='';
	     }
		$data['connections']=$result;
		$session = $this->session->userdata('logged_in');
		$data['logged'] = false;	
		if($session['user']['id']){
		$data['logged'] = true;	
		} 
		
		$data['theme_body'] = $this->load->view('connections_list', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
   }
   
   public function getactivities(){
		$data = array();
		$pid = doDecrypt($this->input->post('post_id'));
		$uid = doDecrypt($this->input->post('uid'));
	    $data['pastdata'] = $this->connections_model->loadactivities($pid ,$uid);
	     
		 foreach($data['pastdata'] as $k=>$v)
		{
			  $pastdata[$k]->editable = 0;
			  if(isset($session['user']['id']) && $v->user_id==$session['user']['id'])
			  {
				   $pastdata[$k]->editable = 1;
			  }
			  $data['pastdata'][$k]->action_item_id = doEncrypt($v->action_item_id);
			  $data['pastdata'][$k]->id = doEncrypt($v->id); 
		}
	    if($data['pastdata'])
	    $theme_body = $this->load->view('home/activity_li_content', $data, true);
	   else
	    $theme_body = $data['pastdata'];
	  echo json_encode($theme_body);exit;
	  exit;
	  
  }
   public function ourfaculty(){
	  $data = array();
		$data['activepage'] = 'connection';
		$this->load->library('encrypt');
		$arr['status']=5;
		$connections = $this->connections_model->GetallOurfacultycount($arr);
		/*check user is loggedin*/
		$data['logged'] = false;
		$session = $this->session->userdata('logged_in');
	    if(isset($session['user']['id']))
	       $data['logged'] = true;
		
		
		//pagination settings
        $config['base_url'] = site_url('connections/ourfaculty');
        //$config['total_rows'] = $this->db->count_all('tbl_books');
        $config['total_rows'] = $connections;
        $config['per_page'] = 21;
        $config["uri_segment"] = 3;
        $config['page_query_string'] = FALSE;
        $choice = $config["total_rows"]/$config["per_page"];
        //$config["num_links"] = floor($choice);
        $config["num_links"] = 4;

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
		 
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;  
        
		$result = $this->connections_model->GetallOurfaculty($arr, $config["per_page"], $data['page'], $_POST);
		foreach($result as $key=>$val){ 
		
		  $result[$key]->id = doEncrypt($val->id);
		  if(isset($val->last_accessed_on) && $val->last_accessed_on !='0000-00-00 00:00:00'  ) { 	
		    $result[$key]->last_accessed_on=time_elapsed_string(strtotime($val->last_accessed_on));
	      }else
	         $result[$key]->last_accessed_on='';
	  }
		$data['pagination'] = $this->pagination->create_links();
		$data['connections']=$result;
		$data['totalcount']=$connections;
		$data['activity']='faculty';
		//print_r($data);exit;
		 
		$data['theme_body'] = $this->load->view('connections_list', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
  }
  public function distinguishedalumni(){
	  $data = array();
		$data['activepage'] = 'connection';
		$this->load->library('encrypt');
		$arr['status']=3;
		$connections = $this->connections_model->GetallOurfacultycount($arr);
		/*check user is loggedin*/
		$data['logged'] = false;
		$session = $this->session->userdata('logged_in');
	    if(isset($session['user']['id']))
	       $data['logged'] = true;
		
		
		//pagination settings
        $config['base_url'] = site_url('connections/index');
        //$config['total_rows'] = $this->db->count_all('tbl_books');
        $config['total_rows'] = $connections;
        $config['per_page'] = 21;
        $config["uri_segment"] = 3;
        $config['page_query_string'] = FALSE;
        $choice = $config["total_rows"]/$config["per_page"];
        //$config["num_links"] = floor($choice);
        $config["num_links"] = 4;

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
		 
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;  
        
		$result = $this->connections_model->GetallOurfaculty($arr, $config["per_page"], $data['page'], $_POST);
		foreach($result as $key=>$val){ 
		
		  $result[$key]->id = doEncrypt($val->id);
		  if(isset($val->last_accessed_on) && $val->last_accessed_on !='0000-00-00 00:00:00'  ) { 	
		    $result[$key]->last_accessed_on=time_elapsed_string(strtotime($val->last_accessed_on));
	      }else
	         $result[$key]->last_accessed_on='';
	  }
		$data['pagination'] = $this->pagination->create_links();
		$data['connections']=$result;
		$data['totalcount']=$connections;
		$data['activity']='faculty';
		//print_r($data);exit;
		 
		$data['theme_body'] = $this->load->view('connections_list', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
  }
  public function getPages(){
		$last = $this->uri->total_segments();
		$record_num = $this->uri->segment($last);
		$urlname = rawurldecode($record_num);
		$page=$this->connections_model->getPageinfo($urlname);
		$alumnis=$this->connections_model->getAlumniinfo($urlname);
		foreach($alumnis as $key=>$val){ 
		
		  $alumnis[$key]->id = doEncrypt($val->id);
		  if(isset($val->last_accessed_on) && $val->last_accessed_on !='0000-00-00 00:00:00'  ) { 	
		    $alumnis[$key]->last_accessed_on=time_elapsed_string(strtotime($val->last_accessed_on));
	      }else
	         $alumnis[$key]->last_accessed_on='';
	  }
		$data=array();
		$data['title']=$urlname;
		$data['pageinfo']=$page;
		$data['alumnisinfo']=$alumnis;
		$data['theme_body'] = $this->load->view('page_template', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
  }

}
