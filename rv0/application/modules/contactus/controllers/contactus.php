<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactus extends CI_Controller {


   
/**
 * 	 author: 
 *   created Date: 15 june 2013
 *   
 */
   public function __construct() 
   {
    parent::__construct();
		//$this->lang->load("adminsite",  language_load());
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('digitalemail');
		$this->load->library('googlemaps');
	}
	public function index()
	{  
		$data = array();
		$data['activepage'] = 'contact';
		$data['theme_body'] = $this->load->view('contactus', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function sendcontact()
	{
		$data = array();
		$data['email'] = CONACT_EMAIL;
		$data['first_name'] = ORGANISAION_NAME;
		$data['last_name']   = '';
		$data['subject']   = 'Requesting from Alumni';
		 
		$message = 'Email from : '.$this->input->post('email');
		$message .= '<br/> Name : '.$this->input->post('name');
		$message .= '<br/> Subject : '.$this->input->post('subject');
		$message .= '<br/> Message : '.$this->input->post('message');
		$data['message']= $message;
		 
		// digital api is working
				         $digitalData = isLive();
						 if(!$digitalData)
						  {
							  
							  $response['status'] = 'error';
			                  $response['message'] = 'Email services not working.Contact administrator.';
							 
						  }else
						  {
							  $digitalData = json_decode($digitalData);
							  if($digitalData->sendMail=='Live')
							  { 
								 if(creditsLeft('email'))
								 {
								   // sending email
							       sendMail($data);
							       $response['status'] = 'success';
								   $response['message'] = 'your message will be sent successfully...';
							     }
							      else
							      {
									   $this->session->set_userdata('error_msg','Credit amount expired.'); 
										redirect('register', 'location');
								  }
						      }
						  } 
		//$data['message']   = $this->input->post('message');
		//$message=$this->load->view('email/contact_mail_format',$data,true);
		
		 
		echo json_encode($response);exit;
	}
	
}
