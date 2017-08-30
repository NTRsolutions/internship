<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {


   
/**
 * 	 author: 
 *   created Date: 15 june 2013
 *   
 */
   public function __construct() 
   {
    parent::__construct();
		//$this->lang->load("adminsite",  language_load());
		isEmailVerified(); 
		$this->load->model('news_model');
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
	    $newscount = $this->news_model->Getallnewscount();  
		
		
		//pagination settings
        $config['base_url'] = site_url('news/index');
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
		$data = array();
          $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
       
		
		//print_r($data);exit;
		$result = $this->news_model->GetallNews($config["per_page"], $data['page'], $_POST);
		foreach($result as $k=>$v)
		{
			 $result[$k]->news_id = doEncrypt($v->news_id);
			  
		} 
		 
		//$news = $this->news_model->GetallNews();
		$data['pagination'] = $this->pagination->create_links();
		$data['news']=$result;
		$data['newscount']=$newscount;
		$data['activepage'] = 'news'; 
		//print_r($data);exit;
		$data['theme_body'] = $this->load->view('news_list', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function newsdetails()
	{
		$data = array();
		$data['activepage'] = 'news'; 
		$news = $this->news_model->Getnewsdetails(doDecrypt($this->uri->segment(3)));
		$data['news']=$news[0];
		 
		$data['gallery_images']=json_decode($news[0]->news_images);
		$data['gallery_thumbs_images']=json_decode($news[0]->news_thumbs_images);
		$data['theme_body'] = $this->load->view('news_details', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function search()
	{ 
		if($this->input->post('searchname')==''){
			redirect('/news','location');
		}
		$data = array();
		$data['activepage'] = 'news'; 
		$newscount = $this->news_model->Getsearchcount($_POST);
		
		
		//pagination settings
        $config['base_url'] = site_url('news/search');
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
       
		
		
		$result = $this->news_model->Getsearchnews($config["per_page"], $data['page'], $_POST);
		foreach($result as $k=>$v)
		{
			 $result[$k]->news_id = doEncrypt($v->news_id);
			  
		} 
		//$news = $this->news_model->GetallNews();
		$data['pagination'] = $this->pagination->create_links();
		$data['news']=$result;
		$data['newscount']=$newscount;
		$data['searchname']=$this->input->post('searchname');
		//print_r($data);exit;
		$data['theme_body'] = $this->load->view('news_list', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	
   

}
