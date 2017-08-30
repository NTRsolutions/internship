<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {


   
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
		$this->load->model('events_model');
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
		$data['activepage'] = 'event'; 
		$events = $this->events_model->Getevens();
		$arr=array();
		foreach($events as $k=>$v){
			$arr[$k]['title']=$v->event_title;
			$arr[$k]['start']=$v->event_startdate;
			$arr[$k]['end']=$v->event_enddate;
			$arr[$k]['url']= base_url().'events/eventsdetails/'.doEncrypt($v->event_id);
		}
		$data['events']=json_encode($arr);
		$data['theme_body'] = $this->load->view('events_list', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function search()
	{ 
		if($this->input->post('searchname')==''){
			redirect('/events/gridView','location');
		}
		$data = array();
		$data['activepage'] = 'event'; 
		$newscount = $this->events_model->Getsearchcount($_POST);
		
		
		//pagination settings
        $config['base_url'] = site_url('groups/search');
        //$config['total_rows'] = $this->db->count_all('tbl_books');
        $config['total_rows'] = $newscount;
        $config['per_page'] = "20";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>';
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
       
		
		
		$result = $this->events_model->Getsearchnews($config["per_page"], $data['page'], $_POST);
		foreach($result as $k=>$v)
		{
			 $result[$k]->event_id = doEncrypt($v->event_id);
			  
		} 
		//$news = $this->news_model->GetallNews();
		$data['pagination'] = $this->pagination->create_links();
		$data['events']=$result;
		$data['eventscount']=$newscount;
		$data['searchname']=$this->input->post('searchname');
		//print_r($data);exit;
		$data['theme_body'] = $this->load->view('events_grid_list', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function gridView(){
		 
		$data = array();
	    $eventscount = $this->events_model->Getalleventcount(); 
	    $data['activepage'] = 'event';
	    //pagination settings
        $config['base_url'] = site_url('events/gridView');
        //$config['total_rows'] = $this->db->count_all('tbl_books');

        $config['total_rows'] = $eventscount;
        $config['per_page'] = "20";

        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);
         
        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        
		$data = array();
          $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
       
		
		//print_r($data);exit;
		$result = $this->events_model->GetallEvents($config["per_page"], $data['page'], $_POST);
		foreach($result as $k=>$v)
		{
			 $result[$k]->event_id = doEncrypt($v->event_id);
			  
		} 
		
		 
		 
		//$news = $this->news_model->GetallNews();
		$data['pagination'] = $this->pagination->create_links();
		$data['events']=$result;
		$data['eventscount']=$eventscount;
		$data['activepage'] = 'event'; 
		//print_r($data);exit;
		$data['theme_body'] = $this->load->view('events_grid_list', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function eventsdetails()
	{
		$data = array();
		$data['activepage'] = 'event';
		$events = $this->events_model->Geteventsdetails(doDecrypt($this->uri->segment(3)));
		$data['events']=$events[0];
		$data['currentdate']=date('Y-m-d H:i:s');//print_r($data);exit;
		$data['theme_body'] = $this->load->view('events_details', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	
	
   

}
