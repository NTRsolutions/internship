<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {


   
/**
 * 	 author: 
 *   created Date: 15 june 2013
 *   
 */
   public function __construct() 
   {
        parent::__construct();
		//$this->lang->load("adminsite",  language_load());
		$this->load->model('user_model');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('digitalemail');
		$this->load->library('googlemaps');
		 
		//$this->load->library('gweather');

	}
	public function index()
	{  
		 
		$data = array();
		$data['success_msg'] = '';
		$data['error_msg'] = '';
		if($this->session->userdata('success_msg'))
		{  //echo "asdsa"; exit;
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->set_userdata('success_msg','');
		}
		if($this->session->userdata('error_msg'))
		{
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		}
		
		//$data['theme_body'] = $this->load->view('register', $data, true);
		
		$this->load->view('theme/gj/index', $data);
	}
	public function doRegister()
	{
		 
		 
		 $user = array();
		 $usermeta =  array();
		 // user core data
		 $user['username'] = strtolower(trim($this->input->post('signup_username')));
		 $user['email'] = strtolower($this->input->post('email'));  
		 $user['password'] = md5($this->input->post('pass'));
		
		 
		 // checking email and user name exists
		  $isExists = $this->user_model->isExists($user);
		 // if($isExists)
		  if($isExists) 
		  {
			    $this->session->set_userdata('error_msg','Username or Email already exists');
			    $this->session->set_userdata('registerData',$_POST);
			    
		  }else{
				 $user['tenant_id'] = TENENT_ID; 
				 $user['activation_code'] = random_string('unique'); 
				 $user['registred_on'] = date('Y-m-d H:i:s');				  
				 $user['user_roles_id'] = 1; 
				 $user['first_name'] = strtolower(trim($this->input->post('firstName')));
				 $user['last_name'] = strtolower(trim($this->input->post('lastName')));
				 if($this->input->post('displayname'))
				 {
					 $displayname =  strtolower(trim($this->input->post('displayname')));
				 }else
				 {
					  $displayname = strtolower(trim($this->input->post('firstName'))).' '.strtolower(trim($this->input->post('lastName')));
				 }
				 $user['display_name'] = $displayname; 
				 $user['passout_year'] = $this->input->post('yop'); 
				 $user['dob'] =  strtotime($this->input->post('birthdate')); 
				 $user['gender'] =  $this->input->post('gender');  
				 $user['provider'] = 'rightlink';
				 $userId = $this->user_model->createUserAccount($user);
				 // assigning email params
				 $user['message'] = $this->load->view('user/activationTempalte', $user, true); 
				 $user['subject'] = 'User Registration';
				 if($userId)
				 {
				         // digital api is working
				         $digitalData = isLive();
						 if(!$digitalData)
						  {
							 $this->session->set_userdata('error_msg','Email services not working.Contact administrator.'); 
							 redirect('register', 'location');
						  }else
						  {
							  $digitalData = json_decode($digitalData);
							  if($digitalData->sendMail=='Live')
							  { 
								 if(creditsLeft())
								 {
								   // sending email
							       sendMail($user);
							     }
							      else
							      {
									   $this->session->set_userdata('error_msg','Credit amount expired.'); 
										redirect('register', 'location');
								  }
						      }
						  }
						 // digital api is working - end
				  
				   
				         $this->session->set_userdata('success_msg','You have successfully created your account! To begin using this site you will need to activate your account via the email we have just sent to your email address....');
				 }
				  else
				  $this->session->set_userdata('error_msg','Problem in registration...');
		  
		  } 
		  
		  redirect('register', 'location');
	}
	public function login()
	{
		 
		$data = array();
		$data['theme_body'] = $this->load->view('login', $data, true);
		
		$this->load->view('theme/gj/index', $data);
	}
	public function doLogin()
	{
		  
		  
		  $status = $this->user_model->isUserExists($_POST);
		    
		  if($status) 
		   {  
			   
			   
			   
			    //$this->session->set_userdata('success_msg','Logged in ...');
			    $sess = array();
			    $sess['user']['id'] = $status[0]->id;
			    $sess['user']['email'] = $status[0]->email;
			    $sess['user']['firstName'] = $status[0]->first_name;
			    $sess['user']['lastName'] = $status[0]->last_name;
			    $sess['user']['user_roles_id'] = $status[0]->user_roles_id;
			    $sess['user']['display_name'] = $status[0]->display_name; 
			    $sess['user']['username'] = $status[0]->username; 
			    $sess['user']['provider'] = 'rightlink';
			    $sess['user']['profile_thumb_image'] = $status[0]->profile_thumb_image; 
			    $this->session->set_userdata('logged_in',$sess);
			    $arr = array();
			    $arr['last_accessed_on'] = date('Y-m-d H:i:s');
			    $arr['id'] = $status[0]->id;
			   
			    $locationdata = $this->getip();
			    $arr['state'] = $locationdata['state'];
			    $arr['city'] = $locationdata['city'];
			    $arr['country_code'] = $locationdata['country_code'];
			    $arr['latitude'] = $locationdata['latitude'];
			    $arr['longitude'] = $locationdata['longitude'];
			    $arr['country'] = $locationdata['country_code'];
			    
			    $this->user_model->update_lastaccess($arr);
			    
			    $activity=array();
			    $activity['user_id'] = $sess['user']['id'];
			    $activity['tenant_id']= TENENT_ID;
			    $activity['date_time'] = date('Y-m-d H:i:s'); 
			    $activity['action_type'] = 'login';
			    $activity['provider'] = 'rightlink'; 
			    
			    logactivity($activity);
			    
			    if($this->input->post('ajax'))
			    {
					 echo "success"; exit;
				}
			    redirect('/', 'location');
			    
		   }else{
			   
		      // $this->session->set_userdata('error_msg','Invalid username or password...');
 
		       if($this->input->post('ajax'))
			    {
					 echo "error"; exit;
				}
		       redirect('user/index', 'location');
 
 
		   }
	 
	}
	public function verify()
	{
		$email = $this->input->get('email');
		$code = $this->input->get('code');
		 
		$status = $this->user_model->email_verify($email,$code);
		
		 
		if($status)
		{
			if($status=='active')
			{
				$this->session->set_userdata('error_msg','User already active state');
			}else if($status=='inactive')
			{
				$this->session->set_userdata('error_msg','User acoount in inactive state. Please contact administrator.');
			}else
			{
				
		     $activity = array();
			 $activity['user_id'] =   $status->id;
			 $activity['tenant_id'] = TENENT_ID; 
			 $activity['activity_content'] = $status->first_name.' '.$status->first_name.' joined in '.ORGANISAION_NAME;
			 $arr['post_status'] = 1;
			 $activity['date_time'] = date('Y-m-d H:i:s'); 
			 $activity['action_item_id'] = $status->id;
			 $activity['action_type'] = 'newjoin';
			 siteactivity($activity);
					
			$activity=array();
			$activity['user_id'] = $status;
			$activity['tenant_id']= TENENT_ID;
			$activity['date_time'] = date('Y-m-d H:i:s'); 
			$activity['action_type'] = 'email verified';
			$activity['provider'] = 'rightlink'; 
			logactivity($activity);
			
			$this->session->set_userdata('success_msg','you account has been verified successfully.Please Login into your accont.');
			}
			 
		}else{
			$this->session->set_userdata('error_msg','Email does not exists');
		   
		}
		$this->session->set_userdata('error_msg','User already active state');
		$this->session->set_userdata('openLogin','yes');
		redirect('/', 'location');
	}
	public function forgotpassword(){
		  
		$data = array();
		$data['theme_body'] = $this->load->view('forgot_password', $data, true);
		$this->load->view('user/index', $data);
	}
	public function savechangepassword(){
		 
		$arr = array();
		$session = array();
		$password = substr(sha1(mt_rand()),17,8);
		$arr['user_email']         = $this->input->post('email');
		$arr['user_password']      = md5($password);  
		$result = $this->user_model->savechangepassword($arr);
		$activity=array();
		$activity['user_id'] = $result->id;
		$activity['tenant_id']= TENENT_ID;
		$activity['date_time'] = date('Y-m-d H:i:s'); 
		$activity['action_type'] = 'Forgotpassword - New password sent';
		$activity['provider'] = 'rightlink'; 
		logactivity($activity);
		
		if($result){
			
			 
			 // digital api is working
				         $digitalData = isLive();
						 if(!$digitalData)
						  {
							 $this->session->set_userdata('error_msg','Email services not working.Contact administrator.'); 
							 redirect('register', 'location');
						  }else
						  {
							  $digitalData = json_decode($digitalData);
							  if($digitalData->sendMail=='Live')
							  { 
								  
								 if(creditsLeft())
								 {
									 
								  $mialdata = array();
								  $mialdata['email'] = $this->input->post('email');
								  $mialdata['subject'] = 'New password from Rightlink';
								  
								  
								  $message = '<p>Dear '.$result->first_name.' '.$result->last_name.',</p>';
								  $message .= '<p>As per your Request we have sent you a temporary password, Use the password for login &amp; setup a new password.</p>';
								  $message .= '<p><strong>Temporary Login Password: :</strong> '.strip_tags($password).'</p>';
								  $message .= '<p>If you have any query please mail us at <a href="mailto:info@rightlink.org">info@rightlink.org</a></p>';
								  $mialdata['message'] = $message;
								  $mialdata['first_name'] = $result->first_name;
								  $mialdata['last_name'] =  $result->last_name;
								  
								   // sending email
							       sendMail($mialdata);
							      
							       $data['status'] = 'success';
			                       $data['message'] = 'New Password has been sent to your registered email Please Login & Change Your Password';
							     }
							      else
							      {
								   $data['status'] = 'error';
			                       $data['message'] = 'Email service not working. Please contact adminstrator.';
								  }
						      }
						  }
						 // digital api is working - end
			 
			
			
			 
			
		}else{
			$data['status'] = 'error';
			$data['message'] = 'This email id not available';
			 
		}
		echo json_encode($data); exit;		 
		//print_r($result);exit;
	}
	
	
	public function changepassword(){
		 $session = $this->session->userdata('logged_in');
 
		 if($session['user']['provider']!='rightlink')
		 {
			  redirect('/', 'location');
		 }
		$data = array();
		$data['activepage'] = 'changepassword'; 
		$data['success_msg'] = '';
		$data['error_msg'] = '';
		if($this->session->userdata('success_msg'))
		{  //echo "asdsa"; exit;
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->set_userdata('success_msg','');
		}
		if($this->session->userdata('error_msg'))
		{
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		}
		$data['theme_body'] = $this->load->view('changepassword', $data, true); 
		$this->load->view('theme/gj/inner_layout', $data);
	}
	 	public function updatepassword(){
		$session = $this->session->userdata('logged_in');
		$data = array();
		$arr = array();
		//$session = array();
		 
		$arr['id'] = $session['user']['id'];
		$oldpass = md5($this->input->post('old_password'));
		$arr['password'] = md5($this->input->post('password'));
		 
		$result = $this->user_model->updatePassword($arr,$oldpass);
		
		$activity=array();
		$activity['user_id'] = $arr['id'];
		$activity['tenant_id']= TENENT_ID;
		$activity['date_time'] = date('Y-m-d H:i:s'); 
		$activity['action_type'] = 'change password - Password updated';
		$activity['provider'] = 'rightlink'; 
		logactivity($activity);
		
		
		if($result){
			 
			$this->session->set_userdata('success_msg', 'Password updated successfully');
			 
		}else{
			 
			$this->session->set_userdata('error_msg', 'Old password not matching...');
		}
		 redirect('user/changepassword', 'location');
	}
	public function home()
	{
		
		$data['success_msg'] = '';
		$data['error_msg'] = '';
		if($this->session->userdata('success_msg'))
		{  //echo "asdsa"; exit;
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->set_userdata('success_msg','');
		}
		if($this->session->userdata('error_msg'))
		{
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		}
		 
		 
		
		$data['theme_body'] = $this->load->view('home', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
		 
	}
	public function skipwizard()
	{
		$session = $this->session->userdata('logged_in');  
		 
		$status = $this->user_model->skipwizard($session['user']['id']);
		if($status) 
		{
			 $session['user']['wizard'] = 1;
			 
			 $this->session->set_userdata('logged_in',$session);
		}else{
		  echo "no updae"; exit;
		}
	 
		redirect('user/home', 'location');
	}
   public function getip(){

    $client  = @$_SERVER['HTTP_CLIENT_IP'];

    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];

    $remote  = @$_SERVER['REMOTE_ADDR'];

    $result  = array('country'=>'', 'city'=>'', 'state'=>'');

    if(filter_var($client, FILTER_VALIDATE_IP)){

        $ip = $client;

    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){

        $ip = $forward;

    }else{

        $ip = $remote;

    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
 
    if($ip_data && $ip_data->geoplugin_countryName != null){
        
         $result['country'] = $ip_data->geoplugin_countryName; 
         $result['latitude'] = $ip_data->geoplugin_latitude;
         $result['longitude'] = $ip_data->geoplugin_longitude; 
         $result['country_code'] = $ip_data->geoplugin_countryCode; 
         $result['state'] = $ip_data->geoplugin_region; 
         $result['city'] = $ip_data->geoplugin_city;
 
    }

    return $result;

}
	/*public function profile(){
		 
		$autoPpAddress = $this->getip();
	 
		$data = array(); 
		$data['success_msg'] = '';
		$data['error_msg'] = '';
		if($this->session->userdata('success_msg'))
		{  //echo "asdsa"; exit;
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->set_userdata('success_msg','');
		}
		if($this->session->userdata('error_msg'))
		{
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		}
		 
		$session = $this->session->userdata('logged_in');
		$data['currentCountry'] = '';
		$result = $this->user_model->user($session['user']['id']);
		 
		
		 
		$data['user'] = $result[0]; 
		$data['user']->dob = date('m/d/Y',strtotime($data['user']->dob));
	    $this->load->model('organisation/organisation_model');
	    $data['country_list'] = $this->organisation_model->countrylist();
		if($result[0]->homeTown==0)
		{
			foreach($data['country_list'] as $k=>$v)
			{
		     if(strtolower($v->country_name)==strtolower($autoPpAddress['country']))
		        $data['country_id']= $v->country_id;
	     	}
		    
		} 
		  
		$data['cities'] = $this->user_model->townlist();
		 
		$data['theme_body'] = $this->load->view('profile', $data, true);
		 
		$this->load->view('theme/gj/inner_layout', $data);
	}*/
	
	 public function imageadd(){
				$save=$this->input->post('saveForm');
				if($save){
				$config['upload_path'] = 'uploads/'; 
				$config['allowed_types'] = 'gif|jpg|jpeg|png'; 
				$config['max_size'] = '1000'; 
				$config['max_width'] = '1920'; 
				$config['max_height'] = '1280'; 

				$this->load->library('upload', $config); 
				if(!$this->upload->do_upload()) 
				$this->upload->display_errors(); 
				else { 
				$fInfo = $this->upload->data(); //uploading
				  $this->gallery_path = realpath(APPPATH . '../uploads');//fetching path

				$config1 = array(
					  'source_image' => $fInfo['full_path'], //get original image
					  'new_image' => $this->gallery_path.'/thumbs', //save as new image //need to create thumbs first
					  'maintain_ratio' => true,
					  'width' => 150,
					  'height' => 100
					   
					);
					$this->load->library('image_lib', $config1); //load library
					$this->image_lib->resize(); //generating thumb
				} 
			}

				$imagename=$fInfo['file_name'];// we will get image name here
}
	public function profileupdate(){
		 $session = $this->session->userdata('logged_in');
		 $userid = $session['user']['id'];
		 $user = $this->user_model->user($userid);
		 $userdata=json_decode($user[0]->education_details);
		 $data = array();
		 $arr=array();
		 $val=array();
		 $arr['school']['school_name']=$userdata->school->school_name;
		 $arr['school']['school_passout_year']=$userdata->school->school_passout_year;
		 $arr['school']['school_location']=$userdata->school->school_location;
		 $arr['undergraduation']['undergraduation_name']=$userdata->undergraduation->undergraduation_name;
		 $arr['undergraduation']['undergraduation_passout_year']=$userdata->undergraduation->undergraduation_passout_year;
		 $arr['undergraduation']['undergraduation_specification']=$userdata->undergraduation->undergraduation_specification;
		 $arr['undergraduation']['undergraduation_location']=$userdata->undergraduation->undergraduation_location;
		 $arr['postgraduation']['postgraduation_name']=$userdata->postgraduation->postgraduation_name;
		 $arr['postgraduation']['postgraduation_specification']=$userdata->postgraduation->postgraduation_specification;
		 $arr['postgraduation']['postgraduation_passout_year']=$userdata->postgraduation->postgraduation_passout_year;
		 $arr['postgraduation']['postgraduation_location']=$userdata->postgraduation->postgraduation_location;
		 $arr['phd']['phd_name']=$userdata->phd->phd_name;
		 $arr['phd']['phd_specification']=$userdata->phd->phd_specification;
		 $arr['phd']['phd_passout_year']=$userdata->phd->phd_passout_year;
		 $arr['phd']['phd_location']=$userdata->phd->phd_location;
		 
		 $data['id'] = $userid;
		 if($this->input->post('profiledata')=='home'){
			 $data['first_name'] = strtolower($this->input->post('first_name'));
			 $data['last_name'] = strtolower($this->input->post('last_name'));
			 $data['display_name'] = strtolower($this->input->post('display_name'));
			 $data['dob'] = strtotime($this->input->post('year').'-'.$this->input->post('dob_month').'-'.$this->input->post('day'));
			 $data['mobile'] = $this->input->post('mobile');
			 $data['passout_year'] = $this->input->post('passout_year');
			 //USER IMAGE UPLOAD
			// print_r($_FILES);exit; 
			 
		 } elseif($this->input->post('profiledata')=='school'){
			 $arr['school']['school_name'] = $this->input->post('school_name');
			 $arr['school']['school_passout_year'] = $this->input->post('school_passout_year');
			 $arr['school']['school_location'] = $this->input->post('school_location');
			 $data['education_details']=json_encode($arr);
		 } elseif($this->input->post('profiledata')=='undergraduation'){
		 	 $arr['undergraduation']['undergraduation_name'] = $this->input->post('undergraduation_name');
			 $arr['undergraduation']['undergraduation_passout_year'] = $this->input->post('undergraduation_passout_year');
			 $arr['undergraduation']['undergraduation_specification'] = $this->input->post('undergraduation_specification');
			 $arr['undergraduation']['undergraduation_location'] = $this->input->post('undergraduation_location');
			 $data['education_details']=json_encode($arr);
		} elseif($this->input->post('profiledata')=='postgraduation'){
			 $arr['postgraduation']['postgraduation_name'] = $this->input->post('postgraduation_name');
			 $arr['postgraduation']['postgraduation_specification'] = $this->input->post('postgraduation_specification');
			 $arr['postgraduation']['postgraduation_passout_year'] = $this->input->post('postgraduation_passout_year');
			 $arr['postgraduation']['postgraduation_location'] = $this->input->post('postgraduation_location');
			 $data['education_details']=json_encode($arr);
		} elseif($this->input->post('profiledata')=='phd'){
			 $arr['phd']['phd_name'] = $this->input->post('phd_name');
			$arr['phd']['phd_specification'] = $this->input->post('phd_specification');
			$arr['phd']['phd_passout_year'] = $this->input->post('phd_passout_year');
			$arr['phd']['phd_location'] = $this->input->post('phd_location');
			$data['education_details']=json_encode($arr);
		} elseif($this->input->post('profiledata')=='profession'){
			$data['profession']=$this->input->post('profession');
		}
		 $data['last_updated_on'] = date('Y-m-d H:i:s');
		 //print_r($data);exit;
		 $status = $this->user_model->profileupdate($data);
		
		$val['image']='';
		 if($this->input->post('profiledata')=='home'){
			 $session['user']['firstName'] = $this->input->post('first_name');
			 $session['user']['lastName'] = $this->input->post('last_name');
			 $session['user']['display_name'] = $this->input->post('display_name'); 
			 if(isset($data['profile_thumb_image']) && $data['profile_thumb_image']!=''){
				$session['user']['profile_thumb_image'] = $data['profile_thumb_image'];
				$val['image']=$data['profile_thumb_image'];
			 }
			 $val['displayname']=$this->input->post('display_name');
			 $this->session->set_userdata('logged_in',$session);
			 
		 }
		 
		 $val['status']='success';
		 $val['message']='profile updated successfully...';
		 echo json_encode($val);exit;
		 //$this->session->set_userdata('success_msg','profile updated successfully...');
		 //redirect('user/profile', 'location');
		// check uwer exist
		// $userexist = $this->user_model->emailExist($data);
		 //if($userexist)
		// {  
			// $this->session->set_userdata('error_msg','Email already exists');
			 
		// }else{
		
		/*if(isset($_FILES['image'])) {
			
		$final_width_of_image = 100;
		 
		$path_to_image_directory = 'assets/images/uploads/user/fullsized/';
		$path_to_thumbs_directory = 'assets/images/uploads/user/thumbs/';

		if(preg_match('/[.](jpg)|(gif)|(png)$/', $_FILES['image']['name'])) {
		 
		$filename = time().$_FILES['image']['name'];
		$data['userImage'] = $filename;
		$source = $_FILES['image']['tmp_name'];   
		$target = $path_to_image_directory . $filename;
		 
		move_uploaded_file($source, $target); 
		$this->createThumbnail($filename);     
		
		}
		}

		 
		 
			 $status = $this->user_model->profileupdate($data);
			/// if($status)
			  $this->session->set_userdata('success_msg','profile updated successfully...');
			  $session['user']['wizard'] = 1; 
			  $session['user']['firstName'] = $data['firstName'];
			  $session['user']['lastName'] = $data['lastName'];
			  $session['user']['currTown'] = $data['currTown'];
			  $this->session->set_userdata('logged_in', $session);
			  
			 // else
			 // $this->session->set_userdata('error_msg','Problem in registration...');
	      //}
	      redirect('user/profile', 'location');*/
	}
	function createThumbnail($filename) {
     
    $final_width_of_image = 80; 
    $final_height_of_image = 80;
	$path_to_image_directory = getcwd().'/uploads/users/';
	$path_to_thumbs_directory = getcwd().'/uploads/users/thumbs/';
     
    if(preg_match('/[.](jpg)$/', $filename)) {
         $im = imagecreatefromjpeg($path_to_image_directory . $filename);
    } else if (preg_match('/[.](gif)$/', $filename)) {
        $im = imagecreatefromgif($path_to_image_directory . $filename);
    } else if (preg_match('/[.](png)$/', $filename)) {
        $im = imagecreatefrompng($path_to_image_directory . $filename);
    }else if (preg_match('/[.](jpeg)$/', $filename)) {
        $im = imagecreatefrompng($path_to_image_directory . $filename);
    }
    
    $ox = imagesx($im);
    $oy = imagesy($im);
     
    $nx = $final_width_of_image;
    $ny = $final_height_of_image;
     
    $nm = imagecreatetruecolor($nx, $ny);
     
    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
     
    if(!file_exists($path_to_thumbs_directory)) {
		 
      if(!mkdir($path_to_thumbs_directory)) {
           die("There was a problem. Please try again!");
      } 
       }
 
    imagejpeg($nm, $path_to_thumbs_directory . $filename);
     
    return;
}
   
    public function updateProfileImage()
    { 
		        /*$sitedomain = COOKIE_URL.'/';
		        if(COOKIE_URL=='rightlink')
		        $sitedomain = '';*/
		        
				#########################################################################################################
				# CONSTANTS																								#
				# You can alter the options below																		#
				#########################################################################################################
				$random_key = strtotime(date('Y-m-d H:i:s')); //assign the timestamp to the session variable
				$upload_dir = "uploads/users"; 	 		// The directory for the images to be saved in
				$upload_path = $upload_dir."/";				// The path to where the image will be saved
				$large_image_prefix = "resize_"; 			// The prefix name to large image
				$thumb_image_prefix = "thumbnail_";			// The prefix name to the thumb image
				$large_image_name = $large_image_prefix.$random_key;     // New name of the large image (append the timestamp to the filename)
				$thumb_image_name = $thumb_image_prefix.$random_key;     // New name of the thumbnail image (append the timestamp to the filename)
				$max_file = "1"; 							// Maximum file size in MB
				$max_width = "500";							// Max width allowed for the large image
				$thumb_width = "160";						// Width of thumbnail image
				$thumb_height = "160";						// Height of thumbnail image
				// Only one of these image types should be allowed for upload
				$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
				$allowed_image_ext = array_unique($allowed_image_types); // do not change this
				$image_ext = "";	// initialise variable, do not change this.
				foreach ($allowed_image_ext as $mime_type => $ext) {
					$image_ext.= strtoupper($ext)." ";
				}
				//Image Locations
				$large_image_location = $upload_path.$large_image_name.$random_key;
				$thumb_image_location = $upload_path.$thumb_image_name.$random_key;
				//Create the upload directory with the right permissions if it doesn't exist
				if(!is_dir($upload_dir)){
					mkdir($upload_dir, 0777);
					chmod($upload_dir, 0777);
				}
		 
		
		
		 
				//Get the file information
				$userfile_name = $_FILES[0]['name'];
				$userfile_tmp = $_FILES[0]['tmp_name'];
				$userfile_size = $_FILES[0]['size'];
				$userfile_type = $_FILES[0]['type'];
				$filename = basename($_FILES[0]['name']);
				$file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
				 
				//Only process if the file is a JPG, PNG or GIF and below the allowed limit
				if((!empty($_FILES[0])) && ($_FILES[0]['error'] == 0)) {
					
					foreach ($allowed_image_types as $mime_type => $ext) {
						//loop through the specified image types and if they match the extension then break out
						//everything is ok so go and check file size
						if($file_ext==$ext && $userfile_type==$mime_type){
							$error = "";
							break;
						}else{
							$error = "Only <strong>".$image_ext."</strong> images accepted for upload<br />";
						}
					}
					//check if the file size is above the allowed limit
					if ($userfile_size > ($max_file*1048576)) {
						$error.= "Images must be under ".$max_file."MB in size";
					}
					
				}else{
					$error= "Select an image for upload";
				}
				
				//Everything is ok, so we can upload the image.
				if (strlen($error)==0){
					
					if (isset($_FILES[0]['name'])){
						//this file could now has an unknown file extension (we hope it's one of the ones set above!)
					  	$large_image_location = $large_image_location.".".$file_ext;
					  	$thumb_image_location = $thumb_image_location.".".$file_ext;  
						
						//put the file ext in the session so we know what file to look for once its uploaded
						$user_file_ext =".".$file_ext;
						
						move_uploaded_file($userfile_tmp, UPLOAD_ABS_PATH.'/'.$large_image_location);  
						chmod($large_image_location, 0777);
						
						$width = getWidth(UPLOAD_ABS_PATH.'/'.$large_image_location);
						$height = getHeight(UPLOAD_ABS_PATH.'/'.$large_image_location);
						//Scale the image if it is greater than the width set above
						if ($width > $max_width){
							$scale = $max_width/$width;
							 
							$uploaded = resizeImage(UPLOAD_ABS_PATH.'/'.$large_image_location,$width,$height,$scale);
						}else{
							 
							$scale = 1;
							$uploaded = resizeImage(UPLOAD_ABS_PATH.'/'.$large_image_location,$width,$height,$scale);
						}  
						//Delete the thumbnail file so the user can create a new one
						if (file_exists($thumb_image_location)) {
							unlink($thumb_image_location);
						}
					}  
					
					$current_large_image_width = getWidth(UPLOAD_ABS_PATH.'/'.$large_image_location);
					$current_large_image_height = getHeight(UPLOAD_ABS_PATH.'/'.$large_image_location);
					
					 $resp = array();
					 $resp['status'] = 'success';
					 $resp['message'] = '';
					 $resp['image_location'] = $large_image_location;
					 $resp['width'] =  $current_large_image_width;
					 $resp['height'] = $current_large_image_height;
					 $resp['random_key'] = $random_key;
					 echo json_encode($resp); exit;
					 
				 
				}else{
					 $resp = array();
					 $resp['status'] = 'error';
					 $resp['message'] = $error;
					 $resp['image_location'] = $large_image_location;
					 $resp['width'] =  $current_large_image_width;
					 $resp['height'] = $current_large_image_height;
					 $resp['random_key'] = $random_key;
					 echo json_encode($resp); exit;
				}
 

	}
	public function updateThumbImage()
	{
		
		 
		      /* $sitedomain = COOKIE_URL.'/';
		        if(COOKIE_URL=='rightlink')
		        $sitedomain = '';*/
		        
		        $random_key=  $_POST["random_key"];
			    $upload_dir = "uploads/users"; 	  	 		// The directory for the images to be saved in
				$upload_path = $upload_dir."/";				// The path to where the image will be saved
				$large_image_prefix = "resize_"; 			// The prefix name to large image
				$thumb_image_prefix = "thumbnail_";			// The prefix name to the thumb image
				$large_image_name = $large_image_prefix.$random_key;     // New name of the large image (append the timestamp to the filename)
				$thumb_image_name = $thumb_image_prefix.$random_key;     // New name of the thumbnail image (append the timestamp to the filename)
				$max_file = "1"; 							// Maximum file size in MB
				$max_width = "500";							// Max width allowed for the large image
				$thumb_width = "160";						// Width of thumbnail image
				$thumb_height = "160";						// Height of thumbnail image
				// Only one of these image types should be allowed for upload
				$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
				$allowed_image_ext = array_unique($allowed_image_types); // do not change this
				$image_ext = "";	// initialise variable, do not change this.
				foreach ($allowed_image_ext as $mime_type => $ext) {
					$image_ext.= strtoupper($ext)." ";
				}
				//Image Locations
				$large_image_location = $upload_path.$large_image_name.$random_key;
				$thumb_image_location = $upload_path.$thumb_image_name.$random_key;
				
				  
			 
				//Get the new coordinates to crop the image.
					$x1 = $_POST["x1"];
					$y1 = $_POST["y1"];
					$x2 = $_POST["x2"];
					$y2 = $_POST["y2"];
					$w = $_POST["w"];
					$h = $_POST["h"];
					$large_image_location=  $_POST["imageLocation"];
					
					$file_ext = strtolower(substr($large_image_location, strrpos($large_image_location, '.') + 1));
					 
					 
			        $thumb_image_location = $thumb_image_location.".".$file_ext;
			
			//Scale the image to the thumb_width set above
			$scale = $thumb_width/$w;
			 
			$cropped = resizeThumbnailImage(UPLOAD_ABS_PATH.'/'.$thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
			$data = array();
			$session = $this->session->userdata('logged_in');
		    $userid = $session['user']['id']; 
		    $data['id'] = $userid;
		    $data['profile_image'] = $large_image_location;
			$data['profile_thumb_image'] = base_url().$thumb_image_location;
		    $status = $this->user_model->profileupdate($data);
		
			echo $thumb_image_location; exit;
	}
	public function updateCoverProfileImage()
    { 
		 
		list($width, $height, $type, $attr) = getimagesize($_FILES[0]['tmp_name']);
		 
		
		if($width>700)
		{
		        $sitedomain = COOKIE_URL.'/';
		        if(COOKIE_URL=='rightlink')
		        $sitedomain = '';
		        
				#########################################################################################################
				# CONSTANTS																								#
				# You can alter the options below																		#
				#########################################################################################################
				$random_key = strtotime(date('Y-m-d H:i:s')); //assign the timestamp to the session variable
				$upload_dir = "uploads/users"; 	 		// The directory for the images to be saved in
				$upload_path = $upload_dir."/";				// The path to where the image will be saved
				$large_image_prefix = "cover_"; 			// The prefix name to large image
				$thumb_image_prefix = "thumbnail_";			// The prefix name to the thumb image
				$large_image_name = $large_image_prefix.$random_key;     // New name of the large image (append the timestamp to the filename)
				$thumb_image_name = $thumb_image_prefix.$random_key;     // New name of the thumbnail image (append the timestamp to the filename)
				$max_file = "3"; 							// Maximum file size in MB
				$max_width = "1290";							// Max width allowed for the large image
				$thumb_width = "160";						// Width of thumbnail image
				$thumb_height = "160";						// Height of thumbnail image
				// Only one of these image types should be allowed for upload
				$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
				$allowed_image_ext = array_unique($allowed_image_types); // do not change this
				$image_ext = "";	// initialise variable, do not change this.
				foreach ($allowed_image_ext as $mime_type => $ext) {
					$image_ext.= strtoupper($ext)." ";
				}
				//Image Locations
				$large_image_location = $upload_path.$large_image_name.$random_key;
				$thumb_image_location = $upload_path.$thumb_image_name.$random_key;
				//Create the upload directory with the right permissions if it doesn't exist
				if(!is_dir($upload_dir)){
					mkdir($upload_dir, 0777);
					chmod($upload_dir, 0777);
				}
		 
		
		
		 
				//Get the file information
				$userfile_name = $_FILES[0]['name'];
				$userfile_tmp = $_FILES[0]['tmp_name'];
				$userfile_size = $_FILES[0]['size'];
				$userfile_type = $_FILES[0]['type'];
				$filename = basename($_FILES[0]['name']);
				$file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
				 
				//Only process if the file is a JPG, PNG or GIF and below the allowed limit
				if((!empty($_FILES[0])) && ($_FILES[0]['error'] == 0)) {
					
					foreach ($allowed_image_types as $mime_type => $ext) {
						//loop through the specified image types and if they match the extension then break out
						//everything is ok so go and check file size
						if($file_ext==$ext && $userfile_type==$mime_type){
							$error = "";
							break;
						}else{
							$error = "Only <strong>".$image_ext."</strong> images accepted for upload<br />";
						}
					}
					//check if the file size is above the allowed limit
					if ($userfile_size > ($max_file*1048576)) {
						$error.= "Images must be under ".$max_file."MB in size";
					}
					
				}else{
					$error= "Select an image for upload";
				}
				
				//Everything is ok, so we can upload the image.
				if (strlen($error)==0){
					
					if (isset($_FILES[0]['name'])){
						//this file could now has an unknown file extension (we hope it's one of the ones set above!)
					  	$large_image_location = $large_image_location.".".$file_ext;
					  	$thumb_image_location = $thumb_image_location.".".$file_ext;  
						
						//put the file ext in the session so we know what file to look for once its uploaded
						$user_file_ext =".".$file_ext;
						
						move_uploaded_file($userfile_tmp, UPLOAD_ABS_PATH.'/'.$large_image_location);  
						chmod($large_image_location, 0777);
						
						$width = getWidth(UPLOAD_ABS_PATH.'/'.$large_image_location);
						$height = getHeight(UPLOAD_ABS_PATH.'/'.$large_image_location);
						//Scale the image if it is greater than the width set above
						if ($width > $max_width){
							$scale = $max_width/$width;
							 
							$uploaded = resizeImage(UPLOAD_ABS_PATH.'/'.$large_image_location,$width,$height,$scale);
						}else{
							 
							$scale = 1;
							$uploaded = resizeImage(UPLOAD_ABS_PATH.'/'.$large_image_location,$width,$height,$scale);
						}  
						//Delete the thumbnail file so the user can create a new one
						if (file_exists($thumb_image_location)) {
							unlink($thumb_image_location);
						}
					}  
					
					$current_large_image_width = getWidth(UPLOAD_ABS_PATH.'/'.$large_image_location);
					$current_large_image_height = getHeight(UPLOAD_ABS_PATH.'/'.$large_image_location);
					
					 $resp = array();
					 $resp['status'] = 'success';
					 $resp['message'] = '';
					 $resp['image_location'] = $large_image_location;
					 $resp['width'] =  $current_large_image_width;
					 $resp['height'] = $current_large_image_height;
					 $resp['random_key'] = $random_key;
					 echo json_encode($resp); exit;
					 
				 
				}else{
					 $resp = array();
					 $resp['status'] = 'error';
					 $resp['message'] = $error;
					 $resp['image_location'] = $large_image_location;
					 $resp['width'] =  $current_large_image_width;
					 $resp['height'] = $current_large_image_height;
					 $resp['random_key'] = $random_key;
					 echo json_encode($resp); exit;
				}
			}else
			{
				    $resp = array();
					 $resp['status'] = 'error';
					 $resp['message'] = 'Image width should be more then 800px';
					  
					 echo json_encode($resp); exit;
			}
 

	}
	public function updateCoverImage()
	{
		
		 
		       $sitedomain = COOKIE_URL.'/';
		        if(COOKIE_URL=='rightlink')
		        $sitedomain = '';
		        
		        $random_key=  $_POST["random_key"];
			    $upload_dir = "uploads/users"; 	  	 		// The directory for the images to be saved in
				$upload_path = $upload_dir."/";				// The path to where the image will be saved
				$large_image_prefix = "cover_"; 			// The prefix name to large image
				$thumb_image_prefix = "coverpage_";			// The prefix name to the thumb image
				$large_image_name = $large_image_prefix.$random_key;     // New name of the large image (append the timestamp to the filename)
				$thumb_image_name = $thumb_image_prefix.$random_key;     // New name of the thumbnail image (append the timestamp to the filename)
				$max_file = "3"; 							// Maximum file size in MB
				$max_width = "1290";							// Max width allowed for the large image
				
				$thumb_width = "1290";						// Width of thumbnail image
				$thumb_height = "335";						// Height of thumbnail image
				// Only one of these image types should be allowed for upload
				$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
				$allowed_image_ext = array_unique($allowed_image_types); // do not change this
				$image_ext = "";	// initialise variable, do not change this.
				foreach ($allowed_image_ext as $mime_type => $ext) {
					$image_ext.= strtoupper($ext)." ";
				}
				//Image Locations
				$large_image_location = $upload_path.$large_image_name.$random_key;
				$thumb_image_location = $upload_path.$thumb_image_name.$random_key;
				
				  
			 
				//Get the new coordinates to crop the image.
					$x1 = $_POST["x1"];
					$y1 = $_POST["y1"];
					$x2 = $_POST["x2"];
					$y2 = $_POST["y2"];
					$w = $_POST["w"];
					$h = $_POST["h"];
					$large_image_location=  $_POST["imageLocation"];
					
					$file_ext = strtolower(substr($large_image_location, strrpos($large_image_location, '.') + 1));
					 
					 
			        $thumb_image_location = $thumb_image_location.".".$file_ext;
			
			//Scale the image to the thumb_width set above
			$scale = $thumb_width/$w;
			 
			$cropped = resizeThumbnailImage(UPLOAD_ABS_PATH.'/'.$thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
			$data = array();
			$session = $this->session->userdata('logged_in');
		    $userid = $session['user']['id']; 
		    $data['id'] = $userid;
		    $data['profile_original_cover_image'] = $large_image_location;
			$data['profile_cover_image'] = base_url().$thumb_image_location;
		    $status = $this->user_model->profileupdate($data);
		
			echo $thumb_image_location; exit;
	}
	
	
	public function sociallogin($provider)
	{
		
		 
		log_message('debug', "controllers.HAuth.login($provider) called");
 
		try
		{
				
			log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib'); 
			
			$this->load->library('HybridAuthLib'); 
  
			if ($this->hybridauthlib->providerEnabled($provider))
			{ 
			
				
				//log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
				
				$service = $this->hybridauthlib->authenticate($provider);
 
		  
				if ($service->isUserConnected())
				{
					//log_message('debug', 'controller.HAuth.login: user authenticated.');

					$user_profile = $service->getUserProfile();
 	
					//log_message('info', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));
					 
                    if(!isset($user_profile->email) || $user_profile->email=='') 
                      {
						  
						   $this->session->set_userdata('error_msg', 'Email not providing from the '.$provider);
						   redirect('/register', 'register'); 
						   exit;
					  }
                     
					    
						  $first_name = $user_profile->firstName;
						  $last_name =  $user_profile->lastName;
						  $displayname =  $user_profile->displayName;
						  $dob = $user_profile->birthYear.'/'.$user_profile->birthMonth.'/'.$user_profile->birthDay;
						  $gender =  $user_profile->gender;
						  $email = $user_profile->email; 
						  if(!isset($user_profile->username) || $user_profile->username=='')
						  $username = strtolower($user_profile->firstName).'.'.strtolower($user_profile->lastName).'.'.$user_profile->identifier; 
						  else
						  $username = $user_profile->username; 
						  $profile_image = $profile_thumb_image = $user_profile->photoURL;
                          $status = 1 ;
                          $provider = $provider;
					   
					     $activity =  array();
					    
					     
					     $user = array();  
					     $user['tenant_id'] = TENENT_ID;  
						 $user['registred_on'] = date('Y-m-d H:i:s');				  
						 $user['user_roles_id'] = 1;
						 $user['email'] = $email;
						 $user['username'] = $username; 
						 $user['first_name'] = $first_name;
						 $user['last_name'] = $last_name;
						 if($displayname)
						 {
							 $displayname =   $displayname;
						 }else
						 {
							  $displayname =  $first_name.' '.$last_name;
						 }
						 $user['profile_image'] = $profile_image;
						 $user['profile_thumb_image'] = $profile_thumb_image;
						 $user['display_name'] = $displayname;  
						 $user['dob'] =  strtotime($dob); 
						 $user['gender'] =  $gender;  
						 $user['status'] =  $status;
						 $user['provider'] =  $provider;
						  
					     $isExists = $this->user_model->isExists($user);
					     
					   if($isExists)
					   {
						   
						  $existuserData = $isExists[0];
						  $userId = $user['id']= $existuserData->id;
						     if($existuserData->username!='')
						    $user['username'] = $existuserData->username;
						  if($existuserData->first_name!='')
						    $user['first_name'] = $existuserData->first_name;
						  if($existuserData->provider!='')
						    $user['provider'] = $existuserData->provider;
						  if($existuserData->last_name!='')
						    $user['last_name'] = $existuserData->last_name;
						  if($existuserData->display_name!='')
						    $user['display_name'] = $existuserData->display_name;
						   if($existuserData->dob!='')
						    $user['dob'] = $existuserData->dob;
						   if($existuserData->gender!='')
						    $user['gender'] = $existuserData->gender;
						  if($existuserData->profile_image!='')
						    $user['profile_image'] = $existuserData->profile_image;
						  if($existuserData->profile_thumb_image!='')
						    $user['profile_thumb_image'] = $existuserData->profile_thumb_image;
						    
						   $user['status'] = 1;
						   //updating user
						   $status = $this->user_model->profileupdate($user);
						   // updated the account
						   
						    //siteactivity
							  // adding to site track and user first time loggedin
							 if($existuserData->status==0)
							 {
								 $activity['user_id'] =   $userId;
								 $activity['tenant_id'] = TENENT_ID; 
								 $activity['activity_content'] = $existuserData->first_name.' '.$existuserData->last_name.' joined in '.ORGANISAION_NAME;
								 $arr['post_status'] = 1;
								 $activity['date_time'] = date('Y-m-d H:i:s'); 
								 $activity['action_item_id'] = $userId;
								 $activity['action_type'] = 'newjoin';
								 siteactivity($activity);
						    }
					   }else{
						   
						   // crate an account 
						    $userId = $this->user_model->createUserAccount($user); 
						   
						   //  new user adding to site tracking
						   
						   	  
							 //siteactivity
							  // adding to site track
							 $activity['user_id'] =   $userId;
							 $activity['tenant_id'] = TENENT_ID; 
							 $activity['activity_content'] = $first_name.' '.$last_name.' joined in '.ORGANISAION_NAME;
							 $arr['post_status'] = 1;
							 $activity['date_time']  = date('Y-m-d H:i:s'); 
							 $activity['action_item_id'] = $userId;
							 $activity['action_type'] = 'newjoin';
							 siteactivity($activity);
							   
						   
					   }
					   
					    //$this->session->set_userdata('success_msg','Logged in ...');
						$sess = array();
						$sess['user']['id'] =  $userId;
						$sess['user']['email'] = $email;
						$sess['user']['firstName'] =  $user['first_name'];
						$sess['user']['lastName'] =  $user['last_name'];
						$sess['user']['user_roles_id'] =  $user['user_roles_id'];
						$sess['user']['display_name'] =  $user['display_name']; 
						$sess['user']['provider'] = $provider; 
						$sess['user']['tenant_id'] = TENENT_ID;
						$sess['user']['username'] =  $user['username']; 
						$sess['user']['profile_thumb_image'] = $user['profile_thumb_image'];
						$this->session->set_userdata('logged_in',$sess);
						
						$arr = array();
						$arr['last_accessed_on'] = date('Y-m-d H:i:s');
						$arr['id'] =$userId;
						//get the ip data
						$locationdata = $this->getip();
						$arr['state'] = $locationdata['state'];
						$arr['city'] = $locationdata['city'];
						$arr['country_code'] = $locationdata['country_code'];
						$arr['country'] = $locationdata['country_code'];
						$arr['latitude'] = $locationdata['latitude'];
			            $arr['longitude'] = $locationdata['longitude'];
						$this->user_model->update_lastaccess($arr);
						
						$activity=array();
						$activity['user_id'] = $sess['user']['id'];
						$activity['tenant_id']= TENENT_ID;
						$activity['date_time'] = date('Y-m-d H:i:s'); 
						$activity['action_type'] = 'login';
						$activity['provider'] = $provider; 
						logactivity($activity);
			    
						redirect('/', 'location'); 
						 
				} 
				else // Cannot authenticate user
				{
					show_error('Cannot authenticate user');
				}
			}
			else // This service is not enabled.
			{
			 
				log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
				show_404($_SERVER['REQUEST_URI']);
			}
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
				case 0 : $error = 'Unspecified error.'; break;
				case 1 : $error = 'Hybriauth configuration error.'; break;
				case 2 : $error = 'Provider not properly configured.'; break;
				case 3 : $error = 'Unknown or disabled provider.'; break;
				case 4 : $error = 'Missing provider application credentials.'; break;
				case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				         //redirect();
				         if (isset($service))
				         {
				         	log_message('debug', 'controllers.HAuth.login: logging out from service.');
				         	$service->logout();
				         }
				         redirect(base_url());
				         show_error('User has cancelled the authentication or the provider refused the connection.');
				         break;
				case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				         break;
				case 7 : $error = 'User not connected to the provider.';
				         break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
	}
	public function endpoint()
	{

		log_message('debug', 'controllers.HAuth.endpoint called.');
		log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));

		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
			$_GET = $_REQUEST;
		}

		log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
		require_once APPPATH.'/third_party/hybridauth/index.php';

	}
	
	public function logout(){
		$session = $this->session->userdata('logged_in');
		$provider =  $session['user']['provider'];
		 if($session['user']['id']!='')
		   {
			   
		 
						$activity=array();
						$activity['user_id'] = $session['user']['id'];
						$activity['tenant_id']= TENENT_ID;
						$activity['date_time'] = date('Y-m-d H:i:s'); 
						$activity['action_type'] = 'logout';
						$activity['provider'] = $provider; 
						
						$this->session->unset_userdata('logged_in');
						$this->session->unset_userdata('message_status');
						
						if( $provider !='rightlink' ) 
						{
							$this->load->library('HybridAuthLib'); 
							
							//$data['providers'] = $this->hybridauthlib->getProviders(); 
					  
								if ($this->hybridauthlib->providerEnabled($provider))
								{   
									$activity['provider'] = $provider; 
									$service = $this->hybridauthlib->authenticate($provider);
								}
								
								if (isset($service))
								{
									$service->logout();
								}
						}
						logactivity($activity); 
		  }
       // log track
		
		redirect(base_url());
	}
	public function profile()
	{
		 
		isLoggedin(); 
		
		$data=array();
		$data['activepage'] = 'profile'; 
		$session = $this->session->userdata('logged_in');
		$userdata = $this->user_model->user($session['user']['id']);
		$arr = json_decode($userdata[0]->education_details);
		$data['user']=$userdata[0];
		$userdata[0]->id= doEncrypt($userdata[0]->id);
		$data['school']=$arr->school;
		$data['undergraduation']=$arr->undergraduation;
		$data['postgraduation']=$arr->postgraduation;
		$data['phd']=$arr->phd;
		if($data['user']->dob!='')
		{
			 $data['user']->dob = date('Y-m-d',$data['user']->dob);
		}
		
		$data['theme_body'] = $this->load->view('profile', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	
}
##########################################################################################################
# IMAGE FUNCTIONS																						 #
# You do not need to alter these functions																 #
##########################################################################################################
function resizeImage($image,$width,$height,$scale) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$image); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
    }
	
	chmod($image, 0777);
	return $image;
}
//You do not need to alter these functions
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$thumb_image_name); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$thumb_image_name,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$thumb_image_name);  
			break;
    }
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}
//You do not need to alter these functions
function getHeight($image) {
	$size = getimagesize($image);
	$height = $size[1];
	return $height;
}
//You do not need to alter these functions
function getWidth($image) {
	$size = getimagesize($image);
	$width = $size[0];
	return $width;
}
