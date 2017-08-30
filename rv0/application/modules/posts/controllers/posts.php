<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {


   
/**
 * 	 author: 
 *   created Date: 15 june 2013
 *   
 */
   public function __construct() 
   {
    parent::__construct();
		//$this->lang->load("adminsite",  language_load());
		$this->load->model('posts_model');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('digitalemail');
		$this->load->library('googlemaps');
		
		//$this->load->library('gweather');

	}
	public function index()
	{  
		$data = array();
		$news = $this->news_model->GetallNews();
		$data['news']=$news;
		$data['theme_body'] = $this->load->view('news_list', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function updatepoststatus()
	{
		$session = $this->session->userdata('logged_in');
		$data = array();
		$data['id']=$session['user']['id'];
		$data['notification_view_date']=date('Y-m-d H:i:s');
		$postdata = $this->posts_model->updatepoststatus($data);
		echo $postdata;exit;
	}
	public function deletepost()
	{
		isLoggedin(); 
		$session = $this->session->userdata('logged_in');
		$data = array(); 
		$postdata = $this->posts_model->deletepost(doDecrypt($this->input->post('post_id')),$session['user']['id']);
		
		echo $postdata; exit;
	}
	public function postdetailes()
	{
		$data = array();
		$data['user_id'] = '';
	 	$session = $this->session->userdata('logged_in');
		$postdata = $this->posts_model->postdetailes(doDecrypt($this->uri->segment(3))); 
		  
		$postdata[0]->editable = 0;
		 
		if(isset($session['user']['id']) && $postdata[0]->user_id==$session['user']['id'])
		{
		  $postdata[0]->editable = 1;
		}
		$postdata[0]->post_id = doEncrypt($postdata[0]->post_id); 
		$postdata[0]->user_id = doEncrypt($postdata[0]->user_id);
		$data['postdata']=$postdata[0]; 
		$data['postimages'] = json_decode($postdata[0]->post_images);
		$data['postthumbsimages'] = json_decode($postdata[0]->post_thumbs_images);
		// to display post box in home page - checking session
		if(isset($session['user']['id']) && $session['user']['id']!='')
		{
			$data['user_id'] = $session['user']['id'];
			// edit popup template 
			$data['editPopup'] = $this->load->view('posts/editpostPopup', $data, true);
	    } 
		 
		$data['theme_body'] = $this->load->view('post_detailes', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	
	
   

}
