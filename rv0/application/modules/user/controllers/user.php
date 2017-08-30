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
		//$this->load->helper('cookie'); 
		$this->load->library('parser');
		     
		 
		//$this->load->library('gweather');

	}
	public function index()
	{  
		  isLoggedin();
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
	
	public function notificationEmail(){
	   
  //$session = $this->session->userdata('logged_in');
	 $userdata = $this->user_model->getUserNotificationCount();
	   $maildata = array();
	   $data=array();
	  foreach($userdata as $k=>$v){
		    $notificationCount=Getpostsdatacontent($v->id); 
          	$maildata['email'] =$v->email;
			$maildata['subject'] = ORGANISAION_NAME;
			$maildata['message'] = "A lot has happened in your alumni family since you last logged in. Here are some notifications you've missed from your peers";
	  if($notificationCount >= $v->notificationCount){
		 $data['notificationCount']=$notificationCount+20;
		 $data['id']=$v->id;
		 sendMail($maildata);
	   $usernoticationCount = $this->user_model->UpdateUserNotificationCount($data); 
	   }
	 }		
	}
	public function profileUpdateNotification(){
		 
	    $usernoticationCount = $this->user_model->getUserUpdateProfile();
		  //print_r($usernoticationCount);exit;
		  $data=array();
		  $maildata = array();
		   $pTime=date('Y-m-d H:i:s');
		   foreach($usernoticationCount as $k=>$v){
			      
			     $edudetails=json_decode($v->education_details);
			  if($edudetails->school->school_passout_year=="" || $edudetails->undergraduation->undergraduation_passout_year=="" || $edudetails->postgraduation->postgraduation_name==""){
				  $maildata['email'] =$v->email;
			      $maildata['subject'] = ORGANISAION_NAME;
				  $data['link'] ='home/educationInformation/'.doEncrypt($v->id);
			      $maildata['message'] =  $this->load->view('user/profileupdateTempalte', $data, true);
				 $workingHours = (strtotime($pTime)-strtotime($v->registred_on)) / 3600;
			    if($workingHours>=24){
				 sendMail($maildata); 
				 $data['profileUpdate']=1;
		         $data['id']=$v->id;
				 $usernoticationCount = $this->user_model->userProfileUpdateNotification($data);
				 }
			   }  
			 }
		}
		
	public function birthadayMessage(){
	   $userdata = $this->user_model->getUserDateOfBirth();
	   $maildata = array();
	   $data=array();
	    foreach($userdata as $k=>$v){
			$dob=date("m/d/Y",$v->dob);
			$cdob=explode('/',$dob);
			  $month=$cdob[0];
			  $day=$cdob[1];
			  $cday=date('d');
			  $cmonth=date('m'); 
			  $data=array();
			  $data['first_name']=$v->first_name;
			  $data['last_name']=$v->last_name;
			  $data['username']=$v->username;
			  if($month==$cmonth && $day==$cday){
				  $maildata['email'] =$v->email;
			      $maildata['subject'] = ORGANISAION_NAME;
			      $maildata['message'] = $this->load->view('user/birthdayEmailTempalte', $data, true);
				  sendMail($maildata);  
			  }else{
				 echo "No Birthdays"; 
			  }
			 
		}
		
	}	
	
	public function invite()
	{
		  isLoggedin();
		$data = array();
		
	   if($this->session->userdata('useremail'))
		{ 
			$data['useremail'] = $this->session->userdata('useremail');
			$this->session->set_userdata('useremail','');
		}
		if($this->session->userdata('error_msg'))
		{ 
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		}
		
		
		 
		$data['theme_body'] = $this->load->view('invite', $data, true); 
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function addEmail()
	{
		   
		// isLoggedin();
		 if(!$this->input->post('email') or $this->input->get('email') ){
			 $this->session->set_userdata('success_msg','Your key is not valid pls try again');
			 redirect('user/registeremail','Location');
		 }
		    
		   
		 $user = array();
		 $session = $this->session->userdata('logged_in');
		 $user['email'] = strtolower($this->input->post('email')); 
		 $isExists = $this->user_model->isEmailExists($user,$session['user']['id']); 
		 if($isExists)
		 {
			    
			 
			   $this->session->set_userdata('useremail',$user['email']);
			   $this->session->set_userdata('error_msg','Email already exists with other account');
			   redirect('user/registeremail', 'location');
		 }else{
			 
			   $verifydata = array();
			   $p  = substr(sha1(mt_rand()),17,8);
		       $verifydata['email_code'] = md5($p); 
			   $verifydata['email'] = $user['email'];
			   $this->user_model->verifyEmailAfterLog($verifydata,$session['user']['id']);
			   
			   $session['user']['email'] = $user['email']; 
		       $this->session->set_userdata('logged_in',$session);
		   
			   $userdata = $this->user_model->user($session['user']['id']);
			   $this->session->set_userdata('success_msg','Verification link is sent .! Please activate your account'); 
			    //$this->emailVerifyCode();
			    
			   // send a verification code
			    $data=array();
				$data['firstname']=$userdata[0]->first_name;
				$data['lastname']=$userdata[0]->last_name;
				$data['email']=$userdata[0]->email;
				//$data['display_name']=$userdata[0]->display_name;
				$data['activation_link']=site_url('user/email_verify').'?email='.$user['email'].'&code='.$verifydata['email_code'];
				//$data['random_code']=$verifydata['email_code'];
			    $maildata = array();
			    $maildata['email'] = $user['email'];
		        $maildata['subject'] = 'Email verification code';
				$maildata['message']=$this->load->view('user/emailActivationTemplate',$data,true);
			   //$maildata['message'] = 'Verification code : '.$p;
		        $maildata['first_name'] = $userdata[0]->first_name;
		        $maildata['last_name'] = $userdata[0]->last_name;
			    // digital api is working
			     //$this->emailVerifyCode(); 
				 $digitalData = isLive();
				 if(!$digitalData)
				  {
					 $this->session->set_userdata('error_msg','Email services not working.Contact administrator.'); 
					 redirect('user/registeremail', 'location');
				  }else
				  {
					  $digitalData = json_decode($digitalData);
					  if($digitalData->sendMail=='Live')
					  { 
						 if(creditsLeft('email'))
						 {
						   // sending email
						     $this->session->set_userdata('success_msg','Verification code sent to mail.'); 
						     sendMail($maildata);
						     
						     $this->registeremail();
						 }
						  else
						  {
							   $this->session->set_userdata('error_msg','Credit amount expired.'); 
								 redirect('user/registeremail', 'location');
						  }
					  }
				  }
			   
		 }
	}
	 
	 
	public function emailVerifyCode()
	{
		// isLoggedin(); 
		$data = array();
		$session = $this->session->userdata('logged_in');
		$data['email'] = $this->input->post('email');
		if($this->session->userdata('error_msg'))
		{
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		}
		if($this->session->userdata('success_msg'))
		{
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->set_userdata('success_msg','');
		}
		if($this->session->userdata('useremail'))
		{
			$data['email'] = $this->session->userdata('useremail');
			$this->session->set_userdata('useremail','');
		}
		// if no email pushing email as per record
		 
		 
		$data['theme_body'] = $this->load->view('emailVerifyCode', $data, true);
		
		$this->load->view('theme/gj/email_layout', $data);
	}
	public function mobileVerifyCode($mobile)
	{
		  isLoggedin();
		$data = array();
		$session = $this->session->userdata('logged_in');
		$data['mobile'] = $this->input->post('mobile');
		if($this->session->userdata('error_msg'))
		{
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		}
		if($this->session->userdata('success_msg'))
		{
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->set_userdata('success_msg','');
		}
		if($this->session->userdata('mobile'))
		{
			$data['mobile'] = $this->session->userdata('mobile');
			$this->session->set_userdata('mobile','');
		}
		// if no email pushing email as per record
		 
		 
		$data['theme_body'] = $this->load->view('verifyMobile', $data, true);
		
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function doRegister()
	{  
	      //print_r($_POST);exit;
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
                 $user['last_updated_on'] = date('Y-m-d H:i:s');				 
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
				 //$user['passout_year'] = $this->input->post('yop'); 
				 $user['dob'] =  strtotime($this->input->post('birthdate')); 
				 $user['gender'] =  $this->input->post('gender'); 
                 //$user['role']=$this->input->post('signup_role');				 
				 //$user['branch_name'] = $this->input->post('branch_name');
				 $user['provider'] = 'rightlink';
				 $user['notificationCount'] =5;
				 $user['changepassword'] = 1;
				 
				 $userId = $this->user_model->createUserAccount($user);
				 //Insert the user roles
				 if($userId){
					 $role=array();
					 $role['tenant_id']=TENENT_ID;
					 $role['user_id']=$userId;
					 $role['role_id']=$this->input->post('signup_role');//print_r($role);
					 $userId1 = $this->user_model->createUserRole($role);//echo $userId1;exit;
				 }
				 //$accountTemplate=$this->user_model->getTemplatedata();
				 $sitelink=site_url('user/verify').'?email='.$user['email'].'&code='.$user['activation_code'];
				 $mdata = array(
									'lastname'=>$user['last_name'],
									'firstname'=>$user['first_name'],
									'organization'=>ORGANISAION_NAME,
									'email'=>$user['email'],
									'password'=>$this->input->post('pass'),
									'activation_link'=>$sitelink
									 
					);
				   // assigning email params
				   // echo $accountTemplate[0]->template_body;
				    $user['message']=$this->load->view('user/emailActivationTemplate',$mdata,true);
					//print_r($user['message']);exit;
				    /*if(is_array($accountTemplate)){
					 $user['message']=$this->parser->parse_string($accountTemplate[0]->template_body, $mdata, TRUE);	
					}else{
					 $user['message'] = $this->load->view('user/activationTempalte', $user, true); 	
					}*/
				  $user['subject'] = ORGANISAION_NAME.' - Profile Activation ';;
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
								 if(creditsLeft('email'))
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
	public function registeremail()
	{
		 
		$data = array();
		$session = $this->session->userdata('logged_in'); 
		$data['useremail'] = $session['user']['email']; 
		   
		if($this->session->userdata('useremail'))
		{ 
			$data['useremail'] = $this->session->userdata('useremail');
			$this->session->set_userdata('useremail','');
		}
		if($this->session->userdata('error_msg'))
		{ 
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->set_userdata('error_msg','');
		}
		$data['useremail'] = $data['useremail'];
		$data['theme_body'] = $this->load->view('force-email', $data, true); 
		$this->load->view('theme/gj/email_layout', $data);
	}
	public function login()
	{
		isNotLoggedin(); 
		$data = array();
		$data['theme_body'] = $this->load->view('login', $data, true);
		
		$this->load->view('theme/gj/index', $data);
	}
	public function doLogin()
	{
		 $resp = array();
		  $status = $this->user_model->isUserExists($_POST);
		  
		  
		  /* if(isset($_POST['remberme']) && $_POST['remberme']=='true'){
			    $cookie_name = $this->input->post(email);
				$cookie_value = $this->input->post(pass);
				$cookie = array(
					'name'   => 'rightlink_username',
					'value'  => $cookie_name,
					'expire' => '86500',
					'domain' => 'localhost',
					'path'   => '/',
					//'prefix' => 'rightlink_',
					'secure' => TRUE,
					);
					set_cookie($cookie);
					$cookie = array(
					'name'   => 'rightlink_password',
					'value'  => $cookie_value,
					'expire' => '86500',
					'domain' => 'localhost',
					'path'   => '/',
					//'prefix' => 'rightlink_',
					'secure' => TRUE,
					);
					set_cookie($cookie); 
		   }*/
		  if($status) 
		   { 
			    
			   
			    //$this->session->set_userdata('success_msg','Logged in ...');
			    $sess = array();
				 
			    $sess['user']['id'] = $status[0]->id;
			    $sess['user']['email'] = $status[0]->email;
				$sess['user']['tenant_id'] = $status[0]->tenant_id;
			    $sess['user']['email_verified'] = $status[0]->email_verified;
			    $sess['user']['firstName'] = $status[0]->first_name;
			    $sess['user']['lastName'] = $status[0]->last_name;
			    $sess['user']['user_roles_id'] = $status[0]->user_roles_id;
			    $sess['user']['display_name'] = $status[0]->display_name; 
			    $sess['user']['username'] = $status[0]->username; 
				$sess['user']['mobile'] = $status[0]->mobile; 
			    $sess['user']['provider'] = 'rightlink';
			    $sess['user']['profile_thumb_image'] = $status[0]->profile_thumb_image; 
			    
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
			    // user account activated even email not exixts.but loggedin with credentials which we sent to mobile, treated as mobile verified 
			   
			     // if user login with forgot password  without verify
			     if($status[0]->email!='' && $status[0]->email_verified==0 && $status[0]->activation_code=='')
					{
					  $arr['status'] = 1;
					  $arr['email_verified'] = 1;
					  $sess['user']['email_verified'] = 1;
					  
					 $activity['user_id'] =   $status[0]->id;
					 $activity['tenant_id'] = $status[0]->tenant_id; 
					 $activity['activity_content'] = $status[0]->first_name.' '.$status[0]->last_name.' joined in '.ORGANISAION_NAME;
					  
					 $activity['date_time'] = date('Y-m-d H:i:s'); 
					 $activity['action_item_id'] = $status[0]->id;
					 $activity['action_type'] = 'newjoin';
					 
					 siteactivity($activity);
					 }
					else if($status[0]->email=='')
					{
					  $arr['status'] = 1;
					  $arr['sms_verified'] = 1;
					} 
			    // set user session
			    $this->session->set_userdata('logged_in',$sess);
				$firstLogin=$this->user_model->getFirstLogin($status[0]->id);
				 
				if($firstLogin==1){
					 
				  $maildata = array();
			       $maildata['email'] =$status[0]->email;
			       $maildata['subject'] = ORGANISAION_NAME.' welcomes you';
				   $maildata['message'] = $this->load->view('user/welcomeTemplate',$data,true); 	
			       //$maildata['message'] = "Hello ".$status[0]->first_name."! 
//Great to have you on board,thank you for joining your alumni association to build a vibrant Network, this will help you enhance your connections.";
				   sendMail($maildata);
				   //default chat message
				   $session = $this->session->userdata('logged_in');
				   //print_r($session);exit;
						   $date = date('Y-m-d H:i:s');
						  $currentDate = strtotime($date);
						  $futureDate = $currentDate+(60*2);
						  $formatDate = date("Y-m-d H:i:s", $futureDate);
						  $adminuser = $this->user_model->getAdminUsers();
						  $chat=array();
						  $chat['from']=$adminuser[0]->id;
						  $chat['to']=$status[0]->id;
						  $chat['message']='Welcome back '.$session['user']['firstName'].' '.$session['user']['lastName'].'. How have you been?';
						  $chat['sender_key']='admin';
						  $chat['receiver_key']='alumni';
						  $chat['time']=$formatDate;
						  $chat['is_read']=0;
						  $savechat = $this->user_model->chatWelcomemeaage($chat);
				  }
			     //print_r($arr);exit;
			    $this->user_model->update_lastaccess($arr);
				
				$activity=array();
			    $activity['user_id'] = $sess['user']['id'];
			    $activity['tenant_id']=$status[0]->tenant_id ;
			    $activity['date_time'] = date('Y-m-d H:i:s'); 
			    $activity['action_type'] = 'login';
			    $activity['provider'] = 'rightlink'; 
			    //print_r($activity);exit;
			    logactivity($activity);
			    $resp['email_exist'] =false;
			    $resp['isLoggedin'] = true;
				 $gb=getBranchdetails();
				 $org =getorgtype();
				  if($org[0]->organizationType=="college"){ 
				 if( trim($gb[0]->branch_name)=="" || trim($gb[0]->passout_year)=="" || trim($gb[0]->course)=="" ){
				 $resp['showBranch'] = true;  	
		            } 
				 }
				  
				 if($org[0]->organizationType=="school"){ 
                  if(trim($gb[0]->branch_name)=="" || trim($gb[0]->passout_year)==""){
				 $resp['showBranch'] = true;  	
		          } 
				 }
			    
			    // checking email exists if no send to force entering email id
			    if($status[0]->email!=''){
			      $resp['email_exist'] = true;
				}
			    if($status[0]->mobile==''){
			      $resp['mobile_exist'] = true;
				}
                
				if($this->input->post('ajax'))
			    {
				 //print_r($resp);exit;
				  echo json_encode($resp); exit;
				}

					redirect('/', 'location');
				
			    
		   }else{
			   
		      // $this->session->set_userdata('error_msg','Invalid username or password...');
               $resp['isLoggedin'] = false;
		       if($this->input->post('ajax'))
			    {
					echo json_encode($resp); exit;
				}
		       redirect('user/index', 'location');
 
 
		   }
	 
	}
	public function homepage(){
		$tets=getorgtype();
		print_r($tets);exit;
	}
	public function insertbranchdetails(){
		//print_r($_POST);exit;
		$data=array();
		if($this->input->post('branch_name')!=''){
			$data['branch_name']=$this->input->post('branch_name');
			
			$branchid=$this->user_model->getBranchID($this->input->post('branch_name'));
			$data['tenant_id']=$branchid[0]->ID;
		}
		if($this->input->post('course')!='')
		$data['course']=$this->input->post('course');
		if($this->input->post('passout_year')!='')
		$data['passout_year']=$this->input->post('passout_year');
	    //if($this->input->post('signup_role')!=''){
			$session = $this->session->userdata('logged_in');
			$roles=getRoles();
			foreach($roles as $a=>$b){
				$r[]=$b->id;
			}
			if($this->input->post('signup_role')!=''){
				$role=array();
				$roleid=implode(",",$r);
				$role['user_id']=$session['user']['id'];
				$role['tenant_id']=$branchid[0]->ID;
				if($this->input->post('signup_role')!=''){
					$role['role_id']=$this->input->post('signup_role');
				}
				//print_r($role);exit;
				$updaterole=$this->user_model->updateUserRole($role,$roleid);
			}
			/*$user = $this->user_model->user($session['user']['id']);
			$roles=getRoles();//print_r($user);echo "-----";	print_r($roles);exit;	
			foreach($roles as $a=>$b){
				$r[]=$b->id;
			}
			$urole=explode(",",$user[0]->role);//print_r($urole);print_r($r);exit;
			foreach($urole as $k=>$v){
				if(in_array($v,$r)){
					  //$val1[]=$v;
				  }else{
					   $val1[]=$v;
				  }
			}
			if($val1[0]!=''){
				$p=implode(",",$val1).",";
			}else{
				$p='';
			}
			 //print_r($val1);exit;
			 $userrole=$p.$this->input->post('signup_role');
			 $data['role']=$userrole;*/
			
		//}
		//print_r($data);exit;
		//$data['role']=$this->input->post('signup_role');
		
		$userdata = $this->user_model->updatebranchdetails($data);
		if($userdata){
			redirect(base_url(), 'location');
		}
	}
	public function brachUpdate(){
		 isLoggedin();
		$data=array();
		$session = $this->session->userdata('logged_in');
		$userdata = $this->user_model->getBranchesuserdata();
		 //print_r($userdata);exit;
		$data['branchname']  =$userdata[0]->branch_name;
		$data['course']  =$userdata[0]->course; 	
		$data['passout_year']  =$userdata[0]->passout_year;
        //$data['user_role']  =$userdata[0]->role;
        
        $roles=getRoles();	
      //  echo $session['user']['id'];
        $userrole=$this->user_model->getRoleID($session['user']['id']);
       // print_r($userrole);exit;
			//print_r($roles);echo "-----";	print_r($userrole);exit;
			foreach($roles as $a=>$b){
				$r[]=$b->id;
			}
			foreach($userrole as $c=>$d){
				$urole[]=$d->role_id;
			}
        //$data['user_role']  =$urole;
			//$urole=explode(",",$urole);
			foreach($urole as $k=>$v){
				if(in_array($v,$r)){
					  $val1[]=$v;
				  }
			}
		$data['urole']=$urole;
		$data['role']=$val1;//print_r($data);exit;
		$data['theme_body'] = $this->load->view('branchupdate', $data, true); 
		$this->load->view('theme/gj/email_layout', $data);
		
	}
	public function resendCode()
	{
		  $resp = array();  
		  $session = $this->session->userdata('logged_in');
		  $userid = $session['user']['id'];
		  $userdata = $this->user_model->user($userid);
		  
		  $verifydata = array();  
		  $p  = substr(sha1(mt_rand()),17,8);
		  $verifydata['email_code'] = md5($p); 
		  $verifydata['email'] = $this->input->post('email');
		  // updatting verification code to user
		  $this->user_model->verifyEmailAfterLog($verifydata,$session['user']['id']);
		  
		   $session['user']['email'] = $this->input->post('email'); 
		   $this->session->set_userdata('logged_in',$session);
		    $data=array();
			
				$data['firstname']=$userdata[0]->first_name;
				$data['lastname']=$userdata[0]->last_name;
				$data['email']=$userdata[0]->email;
				$data['activation_link']=site_url('user/email_verify').'?email='.$user['email'].'&code='.$p;
				$data['random_code']=$verifydata['email_code'];
			$maildata = array();
			$maildata['email'] =$verifydata['email'];
			$maildata['subject'] = 'Email verification code';
			//$maildata['message'] = 'Verification code : '.$p;
			$maildata['message']=$this->load->view('user/emailActivationTemplate',$data,true); 
			$maildata['first_name'] = $userdata[0]->first_name;
			$maildata['last_name'] = $userdata[0]->last_name;
			    // digital api is working
			     //$this->emailVerifyCode(); 
				 $digitalData = isLive();
				 if(!$digitalData)
				  {
					  $resp['message'] = 'Email services not working.Contact administrator.';
					  $resp['status'] = 'error';
					  
				  }else
				  {
					  $digitalData = json_decode($digitalData);
					  if($digitalData->sendMail=='Live')
					  { 
						 if(creditsLeft('email'))
						 {
						   // sending email
						   $resp['message'] = 'Verification code sent to mail.';
					       $resp['status'] = 'success';
						     
						   sendMail($maildata);
						   //$this->emailVerifyCode();
						 }
						  else
						  {
							   $resp['message'] = 'Credit amount expired.';
					           $resp['status'] = 'error';
							    
						  }
					  }
				  }
				  $resp['message'] = 'Verification code sent to mail.';
				  $resp['status'] = 'success';
				  echo json_encode($resp);
				  exit;
	}
	public function resendMobileCode()
	{
		  $resp = array();  
		  $session = $this->session->userdata('logged_in');
		  $mobile = $this->input->post('mobile'); 
		  $userdata = $this->user_model->user($session['user']['id']); 
		  $verifydata = array();  
		  $p  = substr(sha1(mt_rand()),17,8);
		  $verifydata['sms_code'] = md5($p); 
		  //$verifydata['sms_verified'] = 0; 
		  
		 
		  // updatting verification code to user
		  $this->user_model->verifyEmailAfterLog($verifydata,$session['user']['id']);
		  
		    
		    $org = COOKIE_URL;
			$maildata = array();
			$maildata['number'] = trim($mobile); 
			$maildata['country'] = '91'; 
					 
			 
			$maildata['message'] = 'Dear '.$userdata[0]->display_name.', OTP to verify your mobile no. is '.$p.'. Regards, '.$org;  
			 
			    // digital api is working
			     //$this->emailVerifyCode(); 
				 $digitalData = isLive();
				 if(!$digitalData)
				  {
					  $resp['message'] = 'Email services not working.Contact administrator.';
					  $resp['status'] = 'error';
					  
				  }else
				  {
					  $digitalData = json_decode($digitalData);
					  if($digitalData->sendMail=='Live')
					  { 
						 if(creditsLeft('sms'))
						 {
						   // sending email
						   $resp['message'] = 'Verification code sent to Mobile.';
					       $resp['status'] = 'success';
						      
						   sendSMS($maildata);
						  // $this->emailVerifyCode();
						 }
						  else
						  {
							   $resp['message'] = 'Credit amount expired.';
					           $resp['status'] = 'error';
							    
						  }
					  }
				  }
				  $resp['message'] = 'Verification code sent to Mobile.';
				  $resp['status'] = 'success';
				  echo json_encode($resp);
				  exit;
	}
	
	public function email_verify()
	{
		 $email = $this->input->get('email');
		 $code = $this->input->get('code'); 
		 $session = $this->session->userdata('logged_in'); 
		
		 $status = $this->user_model->email_verify2($email,$code);
		 if($status)
		 {
			 $activity = array();
			 $activity['user_id'] =   $status[0]->id;
			 $activity['tenant_id'] = $status[0]->tenant_id; 
			 $activity['activity_content'] = $status[0]->first_name.' '.$status[0]->last_name.' joined in '.ORGANISAION_NAME;
			 
			 $activity['date_time'] = date('Y-m-d H:i:s'); 
			 $activity['action_item_id'] = $status[0]->id;
			 $activity['action_type'] = 'newjoin';
			 siteactivity($activity);
			 
			$activity=array();
			$activity['user_id'] = $status[0]->id;
			$activity['tenant_id']= $status[0]->tenant_id;
			$activity['date_time'] = date('Y-m-d H:i:s'); 
			$activity['action_type'] = 'Email verified';
			$activity['provider'] = 'rightlink'; 
			logactivity($activity);
			 
			 $session['user']['email_verified'] = 1;
			 $this->session->set_userdata('logged_in',$session); 
			 $gb=getBranchdetails();
		        if($gb[0]->branch_name=="" || $gb[0]->passout_year=="" || $gb[0]->course==""  ){
				  	 redirect(base_url('user/brachUpdate'), 'location'); 
		        }else{
				 	redirect(base_url(), 'location');
				}
			 
			 
			 
		 }else
		 {
			  $this->session->set_userdata('success_msg','');
			  $this->session->set_userdata('error_msg','We are afraid, the link has expired.Type your email id to receive an activation mail.');
			  //$session = $this->session->userdata('error_msg'); 
			  //print_r($session);exit;
			  $this->session->set_userdata('useremail',$email);
			  
			  redirect('user/registeremail', 'location');
			
		 }
	}
	public function mobile_verify()
	{
		 $mobile = $this->input->post('mobile');
		 $code = md5($this->input->post('code')); 
		 $session = $this->session->userdata('logged_in'); 
		// echo $session['user']['id'].'_'.$code; exit;
		 $status = $this->user_model->mobile_verify2($session['user']['id'],$code,$mobile);
		 if($status)
		 {
			  
			 
			$activity=array();
			$activity['user_id'] = $status[0]->id;
			$activity['tenant_id']= $status[0]->tenant_id;
			$activity['date_time'] = date('Y-m-d H:i:s'); 
			$activity['action_type'] = 'Mobile verified';
			 
			logactivity($activity); 
			$this->session->set_userdata('success_msg','Your mobile has been verifying.');
			redirect(base_url().'user/profile', 'location');
			 
		 }else
		 {
			  $this->session->set_userdata('error_msg','you have entered wrong verification code.');
			   $this->session->set_userdata('mobile',$mobile);
			  redirect('user/mobileVerifyCode', 'location');
			
		 }
	}
	
	public function verify()
	{
		
		$email = $this->input->get('email');
		$code = $this->input->get('code');
		 
		$status = $this->user_model->email_verify($email,$code);
		//print_r($status);exit;
		 
		if($status)
		{
			if($status=='active')
			{
				$this->session->set_userdata('success_msg','your account activated already.');
				
			}
			/*else if($status->redirect=='email_verified')
			{
				$this->session->set_userdata('success_msg','your Email verified.');
				$session = $this->session->userdata('logged_in');  
				//updating email id in session and redirect to application to browse
				$session['user']['email'] = $status->email;
				$this->session->set_userdata('logged_in',$session); 
				redirect('/', 'location');
				
			}*/
			else if($status=='inactive')
			{
				$this->session->set_userdata('error_msg','User acoount in inactive state. Please contact administrator.');
			}else if($status=='expired')
			{
				$this->session->set_userdata('error_msg','Verification expired.Please do forgot password to get new password.');
			}else
			{
			 	
		     $activity = array();
			 $activity['user_id'] =   $status->id;
			 $activity['tenant_id'] = $status->tenant_id; 
			 $activity['activity_content'] = $status->first_name.' '.$status->last_name.' joined in '.ORGANISAION_NAME;
			 
			 $activity['date_time'] = date('Y-m-d H:i:s'); 
			 $activity['action_item_id'] = $status->id;
			 $activity['action_type'] = 'newjoin';
			 siteactivity($activity);
					
			$activity=array();
			$activity['user_id'] = $status->id;
			$activity['tenant_id']= $status->tenant_id;
			$activity['date_time'] = date('Y-m-d H:i:s'); 
			$activity['action_type'] = 'account verified & Email verified';
			$activity['provider'] = 'rightlink'; 
			logactivity($activity);
			//updating email verified in session
			 $session = $this->session->userdata('logged_in');
			 $session['user']['email_verified'] = 1;
			 $this->session->set_userdata('logged_in',$session);
			
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
		
		
		if($result){
			$activity=array();
			$activity['user_id'] = $result->id;
			$activity['tenant_id']= $result->tenant_id;
			$activity['date_time'] = date('Y-m-d H:i:s'); 
			$activity['action_type'] = 'Forgotpassword - New password sent';
			$activity['provider'] = 'rightlink'; 
			logactivity($activity);
			 
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
								// if email exists sent mail to email or mobile
								 if(isset($result->email) && $result->email!='')
								 {
										 if(creditsLeft('email'))
										 {
 
										  $mialdata = array();
										  $mialdata['email'] = $this->input->post('email');
										  $mialdata['subject'] = 'New password from '.ORGANISAION_NAME;
										  
										  
										  $message = '<p>Dear '.$result->first_name.' '.$result->last_name.',</p>';
										  $message .= '<p>As per your Request we have sent you a temporary password, Use the password for login &amp; setup a new password.</p>';
										  $message .= '<p><strong>Temporary Login Password: :</strong> '.strip_tags($password).'</p>';
										  $message .= '<p>If you have any query please mail us at <a href="mailto:'.CONACT_EMAIL.'">'.CONACT_EMAIL.'</a></p>';
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
							     }else if(isset($result->mobile) && $result->mobile!='')
								      {
										 if(creditsLeft('sms'))
										 {
										  $org = COOKIE_URL; 
										  $mialdata = array();
										  $mialdata['country'] = '91';
										  $mialdata['number'] = trim($result->mobile);
										  $mialdata['message'] =   'Dear '.$result->username.', Your new password is '.$password.'. Kindly change your password after logging in. Regards, '.$org;
										 // $mialdata['message'] = 'Access details : username : '.$result->username;
										  //$mialdata['message'] .= 'New password from '.ORGANISAION_NAME.' : '.$password; 
										   // sending email
										   sendSMS($mialdata);
										  
										   $data['status'] = 'success';
										   $data['message'] = 'New Password has been sent to your registered Mobile.Please Login & Change Your Password';
										 }
										  else
										  {
										   $data['status'] = 'error';
										   $data['message'] = 'SMS service not working. Please contact adminstrator.';
										  }
							         }else
							         {
										   $data['status'] = 'error';
										   $data['message'] = 'Invalid data provided.';
									 }
						      }else{
								  $data['status'] = 'error';
								  $data['message'] = 'System is under maintanance, Please try after some time.';
							  }
						  }
						 // digital api is working - end 
			 
			
		}else{
			$data['status'] = 'error';
			$data['message'] = 'Email or Username not available';
			 
		}
		echo json_encode($data); exit;		 
		//print_r($result);exit;
	}
	
	
	public function changepassword(){
		 isLoggedin();
		 if(trim($session['user']['mobile'])==""){
		 isEmailVerified();
		 }
		 $session = $this->session->userdata('logged_in');
 
		 if($session['user']['provider']!='rightlink')
		 {
			  redirect('/', 'location');
		 }
		 //Update changepassword status
		 $changpass = array();
		 $changpass['changepassword'] = 1;
		 $changpassstatus = $this->user_model->Passwordstatus($session['user']['id'],$changpass);
		 
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
			isLoggedin();
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
		$activity['tenant_id']= $session['user']['tenant_id'];
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
     public function getCourseName(){
		  
		$gdata = $this->user_model->getCouseNames($this->input->post('orgname'));
		 
		 
			 if($gdata[0]->course==''){
				 $gdata[0]->course='null';
			  }
			  echo $gdata[0]->course;exit;
			 
			  
		 
	 }
	public function profileupdate(){
		 // print_r($_POST['prof']);
		 isLoggedin();
		
	     $session = $this->session->userdata('logged_in');
		 $userid = $session['user']['id'];
		 $user = $this->user_model->user($userid);
		 $userdata=json_decode($user[0]->education_details);
		 $data = array();
		 $arr=array();
		 $val=array();
		 $val['mobile_verify'] = false;
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
			 if($user[0]->mobile != $this->input->post('mobile'))
			 {
				  $data['sms_verified'] = 0;
				  if($this->input->post('mobile'))
				    $val['mobile_verify'] = true;
			 }
			 if(isset($_POST['passout_year'])){
				$data['passout_year'] = $this->input->post('passout_year');
			 }
			 //USER IMAGE UPLOAD
			// print_r($_FILES);exit; 
			 
		 } 
		 elseif($this->input->post('profiledata')=='school'){
			 $arr['school']['school_name'] = $this->input->post('school_name');
			 $arr['school']['school_passout_year'] = $this->input->post('school_passout_year');
			 $arr['school']['school_location'] = $this->input->post('school_location');
			 
			 $arr['undergraduation']['undergraduation_name'] = $this->input->post('undergraduation_name');
			 $arr['undergraduation']['undergraduation_passout_year'] = $this->input->post('undergraduation_passout_year');
			 $arr['undergraduation']['undergraduation_specification'] = $this->input->post('undergraduation_specification');
			 $arr['undergraduation']['undergraduation_location'] = $this->input->post('undergraduation_location');
			 
			 $arr['postgraduation']['postgraduation_name'] = $this->input->post('postgraduation_name');
			 $arr['postgraduation']['postgraduation_specification'] = $this->input->post('postgraduation_specification');
			 $arr['postgraduation']['postgraduation_passout_year'] = $this->input->post('postgraduation_passout_year');
			 $arr['postgraduation']['postgraduation_location'] = $this->input->post('postgraduation_location');
			 
			 $arr['phd']['phd_name'] = $this->input->post('phd_name');
			$arr['phd']['phd_specification'] = $this->input->post('phd_specification');
			$arr['phd']['phd_passout_year'] = $this->input->post('phd_passout_year');
			$arr['phd']['phd_location'] = $this->input->post('phd_location');
			$data['education_details']=json_encode($arr);
			$data['last_updated_on'] = date('Y-m-d H:i:s');
		 } 
		 elseif($this->input->post('profiledata')=='profession'){
			 $data['profession']=json_encode($this->input->post('prof'));
			  $data['last_updated_on'] = date('Y-m-d H:i:s');
			  $indus=array();
		    foreach($_POST['prof'] as $k=>$v){
			  $indus[]=$v['industry'];
		  } 
		    $industry=implode(",",$indus);
		  $data['industry']=$industry;
		 } 
		 elseif($this->input->post('profiledata')=='userinterest'){
			 $int=array();
			 $int['tenant_id']=$session['user']['tenant_id'];
			 $int['user_id']=$session['user']['id'];
			 $userroleinsert=$this->user_model->deleteUserInterest($session['user']['id']);//print_r($userroleinsert);exit;
			 foreach($this->input->post('user_interest') as $k=>$v){
				 $int['interestId']=$v;
				 $userroleinsert=$this->user_model->createUserInterest($int);
			 }
			//print_r($this->input->post('user_interest'));exit;
			 //$userinterest=implode(",",$this->input->post('user_interest'));
			//$data['alumni_interest']=$userinterest;
		 }
		 elseif($this->input->post('profiledata')=='userrole'){
			$roles=getRoles();
			$userrole=$this->user_model->getRoleID($userid);
			//print_r($roles);echo "-----";	print_r($userrole);exit;
			foreach($roles as $a=>$b){
				$r[]=$b->id;
			}
			foreach($userrole as $c=>$d){
				$urole[]=$d->role_id;
			}
			//echo "----";print_r($urole);exit;
			//$urole=explode(",",$user[0]->role);
			//print_r($ur);print_r($r);exit;
			
			foreach($urole as $k=>$v){
				if(in_array($v,$r)){
					  //$val1[]=$v;
					  //$rol1[]=$v;
					  $userroledelete=$this->user_model->getRoleDelete($userid,$v);
				  }else{
					   $val1[]=$v;
				  }
			}
			// print_r($rol1);echo "--";print_r($val1);exit;
			 if($val1[0]!=''){
				 $p=implode(",",$val1).",";
			 }else{
				 $p='';
			 }
			 if($this->input->post('signup_role')[0]!=''){
				foreach($this->input->post('signup_role') as $h=>$i){
					$alumniroles=array();
					$alumniroles['role_id']=$i;
					if($userrole[0]->tenant_id!=''){
						$alumniroles['tenant_id']=$userrole[0]->tenant_id;
					}else{
						$alumniroles['tenant_id']=$session['user']['tenant_id'];
					}
					$alumniroles['user_id']=$userid;
					//print_r($alumniroles);exit;
					$userroleinsert=$this->user_model->createUserRole($alumniroles);
				}
				
			}
			 $userrole=$p.$this->input->post('signup_role');
			 //$data['role']=$userrole;
		 }
		  
		 //$data['last_updated_on'] = date('Y-m-d H:i:s');
		 $status = $this->user_model->profileupdate($data);
		 
		 // log activity
		 
		$activity=array();
		$activity['user_id'] = $session['user']['id'];
		$activity['tenant_id']= $session['user']['tenant_id'];
		$activity['date_time'] = date('Y-m-d H:i:s'); 
		$activity['action_type'] = 'Profile updated';
		$activity['provider'] = 'rightlink'; 
		logactivity($activity);
		
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
		 if($this->input->post('profiledata')=='home'){
			 $this->session->set_userdata('success_msg','profile updated successfully...');
			 redirect('user/profile', 'location');
		 }else{
			echo json_encode($val);exit;
		 }
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
						
						$width = $this->getWidth(UPLOAD_ABS_PATH.'/'.$large_image_location);
						$height = $this->getHeight(UPLOAD_ABS_PATH.'/'.$large_image_location);
						//Scale the image if it is greater than the width set above
						if ($width > $max_width){
							$scale = $max_width/$width;
							 
							$uploaded = $this->resizeImage(UPLOAD_ABS_PATH.'/'.$large_image_location,$width,$height,$scale);
						}else{
							 
							$scale = 1;
							$uploaded = $this->resizeImage(UPLOAD_ABS_PATH.'/'.$large_image_location,$width,$height,$scale);
						}  
						//Delete the thumbnail file so the user can create a new one
						if (file_exists($thumb_image_location)) {
							unlink($thumb_image_location);
						}
					}  
					
					$current_large_image_width = $this->getWidth(UPLOAD_ABS_PATH.'/'.$large_image_location);
					$current_large_image_height = $this->getHeight(UPLOAD_ABS_PATH.'/'.$large_image_location);
					
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
				
				  //print_r($thumb_image_location);exit;
			 
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
			
			$cropped = $this->resizeThumbnailImage(UPLOAD_ABS_PATH.'/'.$thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
			$data = array();
			$session = $this->session->userdata('logged_in');
		    $userid = $session['user']['id']; 
		    $data['id'] = $userid;
		    $data['profile_image'] = $large_image_location;
			$data['profile_thumb_image'] = base_url().$thumb_image_location;
		    $status = $this->user_model->profileupdate($data);
		    
		    $sessionData = $this->session->userdata('logged_in');
		    // reset thumb image in session
		    $sessionData['user']['profile_thumb_image'] = $data['profile_thumb_image'];
		    $this->session->set_userdata('logged_in',$sessionData);
		   // echo $upload_path;exit;
			echo $thumb_image_location; exit;
	}
	/*
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
						
						$width = $this->getWidth(UPLOAD_ABS_PATH.'/'.$large_image_location);
						$height = $this->getHeight(UPLOAD_ABS_PATH.'/'.$large_image_location);
						//Scale the image if it is greater than the width set above
						if ($width > $max_width){
							$scale = $max_width/$width;
							 
							$uploaded = $this->resizeImage(UPLOAD_ABS_PATH.'/'.$large_image_location,$width,$height,$scale);
						}else{
							 
							$scale = 1;
							$uploaded = $this->resizeImage(UPLOAD_ABS_PATH.'/'.$large_image_location,$width,$height,$scale);
						}  
						//Delete the thumbnail file so the user can create a new one
						if (file_exists($thumb_image_location)) {
							unlink($thumb_image_location);
						}
					}  
					
					$session = $this->session->userdata('logged_in');
					$userid = $session['user']['id']; 
					$data['id'] = $userid;
					$data['profile_original_cover_image'] =  base_url().$large_image_location;
					$data['profile_cover_image'] =  base_url().$large_image_location;
					$status = $this->user_model->profileupdate($data);
					
					$current_large_image_width = $this->getWidth(UPLOAD_ABS_PATH.'/'.$large_image_location);
					$current_large_image_height = $this->getHeight(UPLOAD_ABS_PATH.'/'.$large_image_location);
					
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
			 
			$cropped = $this->resizeThumbnailImage(UPLOAD_ABS_PATH.'/'.$thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
			$data = array();
			$session = $this->session->userdata('logged_in');
		    $userid = $session['user']['id']; 
		    $data['id'] = $userid;
		    $data['profile_original_cover_image'] = $large_image_location;
			$data['profile_cover_image'] = $large_image_location;
		    $status = $this->user_model->profileupdate($data);
		
			echo $thumb_image_location; exit;
	}
	*/
	public function  getFacebookdetails(){
		 
		//print_r($_POST); exit;
		             $provider="Facebook";
		
						//$first_name = $_POST['get_param']['first_name'];echo $first_name;exit; 
				  //log_message('debug', 'controller.HAuth.login: user authenticated.');

					//$user_profile = $service->getUserProfile();
					          $arr=array();
				             // $edudetails =json_decode($user_profile->education);
							  // print_r($edudetails);exit;
							  //print_r($edudetails[0]->school->name);exit;
		
		       //log_message('info', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));
					 
                    if(!isset($_POST['get_param']['email']) || $_POST['get_param']['email']=='') 
                      {
						  
						   $this->session->set_userdata('error_msg', 'Email not providing from the '.$provider);
						   redirect('/register', 'register'); 
						   exit;
					  }
                     
					    
						  $first_name = $_POST['get_param']['first_name']; 
						  $last_name =  $_POST['get_param']['last_name']; 
						  $displayname = $_POST['get_param']['name']; 
                          $birth=explode('/',$_POST['get_param']['birthday']);						  
						  $dob = $birth[2].'/'.$birth[0].'/'.$birth[1];
						  $gender = $_POST['get_param']['gender'];
						  $email = $_POST['get_param']['email'];
						  if(!isset($_POST['get_param']['username']) || $_POST['get_param']['username']=='')
						  $username = strtolower($_POST['get_param']['first_name']).'.'.strtolower($_POST['get_param']['last_name']).'.'.$_POST['get_param']['id']; 
						  else
						  $username = $_POST['get_param']['username']; 
					       
						  $profile_image = $profile_thumb_image = "https://graph.facebook.com/" . $_POST['get_param']['id'] . "/picture?width=150&height=150";
                          $status = 1 ;
                          $email_verified = 1;
                          $provider = $provider;
					   
					     $activity =  array();
					    
					     
					     $user = array();  
					     $user['tenant_id'] = TENENT_ID;  
						 				  
						// $user['user_roles_id'] = 1;
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
						 //$user['status'] =  $status;
						 $user['email_verified'] = $email_verified;
						 $user['provider'] =  $provider;
						 $user['notificationCount'] =5;
						 $isExists = $this->user_model->isExists($user);
					     
					   if($isExists)
					   {
						  
						  $existuserData = $isExists[0];
						  
						  if($existuserData->status==4) 
						  {
							   redirect(base_url().'accountBlocked','Location');
						  }
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
						   $user['email_verified'] = 1;
						   $user['user_roles_id'] = 1;
							 $user['status'] =  $status;
						   //updating user
						     
		
						   //print_r($user);exit;
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
						   $user['registred_on'] = date('Y-m-d H:i:s');
						   
						  /* if(is_array($edudetails)){
							 if(isset($edudetails[0])){		
							 $arr['school']['school_name']=$edudetails[0]->school->name;
							 $arr['school']['school_passout_year']=$edudetails[0]->year->name;
							 }
							 if(isset($edudetails[1])){	
							 $arr['undergraduation']['undergraduation_name']=$edudetails[1]->school->name;
							 $arr['undergraduation']['undergraduation_passout_year']=$edudetails[1]->year->name;
							 }
							 if(isset($edudetails[2])){	
							 $arr['postgraduation']['postgraduation_name']=$edudetails[2]->school->name;
							
							 $arr['postgraduation']['postgraduation_passout_year']=$edudetails[2]->year->name;
							 }
							 if(isset($edudetails[3])){	
							 $arr['phd']['phd_name']=$edudetails[3]->school->name;
							 $arr['phd']['phd_passout_year']=$edudetails[3]->year->name;
							 }
							 }*/
							 $user['status'] = 1;
			                // $user['education_details']=json_encode($arr);
							 $user['last_updated_on']=date('Y-m-d H:i:s');
							 
						     $userId = $this->user_model->createUserAccount($user);
							 
						   
						   //new user adding to site tracking
						   
						   	  
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
						$sess['user']['email_verified'] = $user['email_verified'];
						$sess['user']['user_roles_id'] =  $user['user_roles_id'];
						$sess['user']['display_name'] =  $user['display_name']; 
						$sess['user']['provider'] = $provider; 
						$sess['user']['tenant_id'] = TENENT_ID;
						$sess['user']['username'] =  $user['username']; 
						$sess['user']['profile_thumb_image'] = $user['profile_thumb_image'];
						 
						$this->session->set_userdata('logged_in',$sess);
						$firstLogin=$this->user_model->getFirstLogin($userId);
						if($firstLogin==1){
						   $maildata = array();
						   $maildata['email'] =$email;
						   $maildata['subject'] = ORGANISAION_NAME.' welcome message';
						   
						  $maildata['message'] =$this->load->view('user/welcomeTemplate',$data,true);
                            //print_r($maildata['message']);exit;
						  sendMail($maildata);
						  //default chat message
						  //$this->load->model('user_model');
						  $session = $this->session->userdata('logged_in');
				  
						   $date = date('Y-m-d H:i:s');
						  $currentDate = strtotime($date);
						  $futureDate = $currentDate+(60*2);
						  $formatDate = date("Y-m-d H:i:s", $futureDate);
						  $adminuser = $this->user_model->getAdminUsers();
						  $chat=array();
						  $chat['from']=$adminuser[0]->id;
						  $chat['to']=$userId;
						  $chat['message']='Welcome back '.$session['user']['firstName'].' '.$session['user']['lastName'].'. How have you been?';
						  $chat['sender_key']='admin';
						  $chat['receiver_key']='alumni';
						  $chat['time']=$formatDate;
						  $chat['is_read']=0;
						 
						  $savechat = $this->user_model->chatWelcomemeaage($chat);
				        }
						//echo "kkkk123";exit;
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
						//echo "lll";exit;
						$activity=array();
						$activity['user_id'] = $sess['user']['id'];
						$activity['tenant_id']= TENENT_ID;
						$activity['date_time'] = date('Y-m-d H:i:s'); 
						$activity['action_type'] = 'login';
						$activity['provider'] = $provider; 
						logactivity($activity);
			            $this->session->set_userdata('closeReloadWindow','reload');
						//echo $this->session->userdata('closeReloadWindow');exit;
						// redirect pre - url
						
						$a['status']='success';
						  echo json_encode($a);exit;
						 
 }
	
	public function sociallogin($provider)
	{
		 
		 // pre-url redrect 
		$durl = '';
		if($this->input->get('dest-url')!='')
		  $durl  = $this->input->get('dest-url') ;
		 
 
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
					          $arr=array();
				              $edudetails =json_decode($user_profile->education);
							  // print_r($edudetails);exit;
							  //print_r($edudetails[0]->school->name);exit;
		
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
                          $email_verified = 1;
                          $provider = $provider;
					   
					     $activity =  array();
					    
					     
					     $user = array();  
					     $user['tenant_id'] = TENENT_ID;  
						 				  
						// $user['user_roles_id'] = 1;
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
						 //$user['status'] =  $status;
						 $user['email_verified'] = $email_verified;
						 $user['provider'] =  $provider;
						 $user['notificationCount'] =5;
						 $isExists = $this->user_model->isExists($user);
					     
					   if($isExists)
					   { 
						  
						  $existuserData = $isExists[0];
						  
						  if($existuserData->status==4) 
						  {
							   redirect(base_url().'accountBlocked','Location');
						  }
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
						   $user['email_verified'] = 1;
						   $user['user_roles_id'] = 1;
							 $user['status'] =  $status;
						   //updating user
						     
		
						   //print_r($user);exit;
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
						   $user['registred_on'] = date('Y-m-d H:i:s');
						   
						   if(is_array($edudetails)){
							 if(isset($edudetails[0])){		
							 $arr['school']['school_name']=$edudetails[0]->school->name;
							 $arr['school']['school_passout_year']=$edudetails[0]->year->name;
							 }
							 if(isset($edudetails[1])){	
							 $arr['undergraduation']['undergraduation_name']=$edudetails[1]->school->name;
							 $arr['undergraduation']['undergraduation_passout_year']=$edudetails[1]->year->name;
							 }
							 if(isset($edudetails[2])){	
							 $arr['postgraduation']['postgraduation_name']=$edudetails[2]->school->name;
							
							 $arr['postgraduation']['postgraduation_passout_year']=$edudetails[2]->year->name;
							 }
							 if(isset($edudetails[3])){	
							 $arr['phd']['phd_name']=$edudetails[3]->school->name;
							 $arr['phd']['phd_passout_year']=$edudetails[3]->year->name;
							 }
							 }
							 $user['status'] = 1;
			                 $user['education_details']=json_encode($arr);
							 $user['last_updated_on']=date('Y-m-d H:i:s');
							 
						     $userId = $this->user_model->createUserAccount($user);
							 
						   
						   //new user adding to site tracking
						   
						   	  
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
						$sess['user']['email_verified'] = $user['email_verified'];
						$sess['user']['user_roles_id'] =  $user['user_roles_id'];
						$sess['user']['display_name'] =  $user['display_name']; 
						$sess['user']['provider'] = $provider; 
						$sess['user']['tenant_id'] = TENENT_ID;
						$sess['user']['username'] =  $user['username']; 
						$sess['user']['profile_thumb_image'] = $user['profile_thumb_image'];
						 
						$this->session->set_userdata('logged_in',$sess);
						$firstLogin=$this->user_model->getFirstLogin($userId);
						if($firstLogin==1){
						   $maildata = array();
						   $maildata['email'] =$email;
						   $maildata['subject'] = ORGANISAION_NAME.' welcome message';
						   
						  $maildata['message'] =$this->load->view('user/welcomeTemplate',$data,true);
                            //print_r($maildata['message']);exit;
						  sendMail($maildata);
						  //default chat message
						  //$this->load->model('user_model');
						  $session = $this->session->userdata('logged_in');
				   
						   $date = date('Y-m-d H:i:s');
						  $currentDate = strtotime($date);
						  $futureDate = $currentDate+(60*2);
						  $formatDate = date("Y-m-d H:i:s", $futureDate);
						  $adminuser = $this->user_model->getAdminUsers();
						  $chat=array();
						  $chat['from']=$adminuser[0]->id;
						  $chat['to']=$userId;
						  $chat['message']='Welcome back '.$session['user']['firstName'].' '.$session['user']['lastName'].'. How have you been?';
						  $chat['sender_key']='admin';
						  $chat['receiver_key']='alumni';
						  $chat['time']=$formatDate;
						  $chat['is_read']=0;
						  //print_r($chat);exit;
						  $savechat = $this->user_model->chatWelcomemeaage($chat);
				        }
						 
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
			            $this->session->set_userdata('closeReloadWindow','reload');
						// redirect pre - url
						if( $durl!=''){ 
						   redirect($durl, 'location');
					     }else{
						    redirect('/', 'location'); 
						}
						 
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
				         $this->session->set_userdata('closeReloadWindow','close');
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
						$activity['tenant_id']=$session['user']['tenant_id'];
						$activity['date_time'] = date('Y-m-d H:i:s'); 
						$activity['action_type'] = 'logout';
						$activity['provider'] = $provider; 
						
						$this->session->unset_userdata('logged_in');
						$this->session->unset_userdata('message_status');
						
						/*if( $provider !='rightlink' and $provider!='Facebook'  ) 
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
						}*/
						logactivity($activity); 
		  }
       // log track
		//if($provider!='Facebook')
		//echo base_url();exit;
		redirect(base_url());
	    //else
		//return true; 
	}
	public function getBrancheuserdata(){
		 
	}
	public function profile()
	{
	    isLoggedin(); 
		
		$data=array();
		if($this->session->userdata('success_msg'))
			{ 
				$data['success_msg'] = $this->session->userdata('success_msg');
				$this->session->set_userdata('success_msg','');
			}
		
		$data['activepage'] = 'profile'; 
		$session = $this->session->userdata('logged_in');
		$userdata = $this->user_model->user($session['user']['id']);
		$arr = json_decode($userdata[0]->education_details);
		$data['profession'] = json_decode($userdata[0]->profession);
		$data['user']=$userdata[0];
		$userdata[0]->id= doEncrypt($userdata[0]->id);
		$data['school']=$arr->school;
		$data['undergraduation']=$arr->undergraduation;
		$data['postgraduation']=$arr->postgraduation;
		$data['phd']=$arr->phd;
		//$interest=explode(",",$userdata[0]->alumni_interest);
		$interest = $this->user_model->getInterest($session['user']['id']);
		foreach($interest as $k=>$v){
			$i[]=$v->interestId;
		}
		$data['userinterest']=$i;
		//$data['userinterest']=$interest;
		 if($data['user']->dob!='')
		{
			 $data['user']->dob = date('Y-m-d',$data['user']->dob);
		}
		//get alumni roles
		$role=$this->user_model->getRoleID($session['user']['id']);
		foreach($role as $k=>$v){
			$r[]=$v->role_id;
		}
		//print_r($r);exit;
		$data['role']=implode(',',$r);
		if($this->session->userdata('success_msg'))
		{  //echo "asdsa"; exit;
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->set_userdata('success_msg','');
		}
		//print_r($data);exit;
		 //get alumni  interest data
		 $query=$this->user_model->getAlumnidata();
		 $data['alumniinterest']=$query;//print_r($data);exit;
		$data['theme_body'] = $this->load->view('profile', $data, true);
		$this->load->view('theme/gj/inner_layout', $data);
	}
	function verifymobile()
	{
		    isLoggedin(); 
			$data = array();
			$session = $this->session->userdata('logged_in');
			$userdata = $this->user_model->user($session['user']['id']);
			$data['mobile'] = $userdata[0]->mobile; 
		
			 
			 
			   
			if($this->session->userdata('mobile'))
			{ 
				$data['mobile'] = $this->session->userdata('mobile');
				$this->session->set_userdata('mobile','');
			}
			if($this->session->userdata('error_msg'))
			{ 
				$data['error_msg'] = $this->session->userdata('error_msg');
				$this->session->set_userdata('error_msg','');
			}
			 		
		
			$data['theme_body'] = $this->load->view('verifyMobileForm', $data, true);
			$this->load->view('theme/gj/inner_layout', $data);
	}
	function sendMobileCode()
	{
		 
		if(!$this->input->post('mobile'))
		   redirect('user/verifymobile','Location');
		   
		 $user = array();
		 $session = $this->session->userdata('logged_in');
		 $user['mobile'] = strtolower($this->input->post('mobile')); 
		  
		    
			 
			   $verifydata = array();
			   $p  = substr(sha1(mt_rand()),17,8);
		       $verifydata['sms_code'] = md5($p); 
			  // $verifydata['mobile'] = $user['mobile'];
			   $this->user_model->verifyEmailAfterLog($verifydata,$session['user']['id']);  
			   $userdata = $this->user_model->user($session['user']['id']);
			   $this->session->set_userdata('success_msg','Verification code sent to Mobile.'); 
			     
			    
				 				   
			   // send a verification code
			    $org = COOKIE_URL;
			    $maildata = array();
			    $maildata['number'] = trim($user['mobile']); 
			    $maildata['country'] = '91';
									    
			    $maildata['message'] = 'Dear '.$userdata[0]->display_name.', OTP to verify your mobile no. is '.$p.'. Regards, '.$org;
		        //$maildata['message'] = 'Verification code from '.ORGANISAION_NAME.': '.$p;
		           
			    // digital api is working
			     //$this->emailVerifyCode(); 
				 $digitalData = isLive();
				 if(!$digitalData)
				  {
					 $this->session->set_userdata('error_msg','SMS services not working.Contact administrator.'); 
					 redirect('user/verifymobile', 'location');
				  }else
				  {
					  $digitalData = json_decode($digitalData);
					  if($digitalData->sendMail=='Live')
					  { 
						 if(creditsLeft('sms'))
						 {
						   // sending email
						     $this->session->set_userdata('success_msg','Verification code sent to Mobile.'); 
						     // sending email
						   $maildata['message'] =  str_replace("\\n", "\n",$maildata['message']);
							  sendSMS($maildata);
						     $this->mobileVerifyCode($user['mobile']);
						 }
						  else
						  {
							   $this->session->set_userdata('error_msg','Credit amount expired.'); 
								 redirect('user/verifymobile', 'location');
						  }
					  }
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
function removeCover()
{
	$session = $this->session->userdata('logged_in');
	$session_uid = $session['user']['id'];
	$data['id'] = $session_uid;
    $data['profile_cover_image'] = '';
    $data['coverpage_position'] = '';
	$status = $this->user_model->profileupdate($data);
	echo "";
	exit;
}
function coverpageUpdate()
{
	
	$session = $this->session->userdata('logged_in');
	$session_uid = $session['user']['id'];
	$path = getcwd().'/uploads/users/coverpages/';
	$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
	if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($session_uid))
	{
	$name = $_FILES['photoimg']['name'];
	$size = $_FILES['photoimg']['size'];


	if(strlen($name))
	{
	$ext = $this->getExtension($name);
	if(in_array($ext,$valid_formats))
	{
	if($size<(1024*1024))
	{
	$actual_image_name = time().$session_uid.".".$ext;
	$tmp = $_FILES['photoimg']['tmp_name'];
	$bgSave='<div id="uX'.$session_uid.'" class="bgSave wallbutton blackButton">Save Cover</div>';
	  
	if(move_uploaded_file($tmp, $path.$actual_image_name))
	{     
		$data['id'] = $session_uid;
		$data['profile_cover_image'] = $actual_image_name;
		$status = $this->user_model->profileupdate($data);
			
		if($data)
		echo $bgSave.'<img src="'.base_url().'uploads/users/coverpages/'.$actual_image_name.'"  id="timelineBGload" class="headerimage ui-corner-all" style="top:0px"/>';

	}				
	else
	{
	echo "Fail upload folder with read access.";
	}
	}
	else
	echo "Image file size max 1 MB";
	}
	else
	echo "Invalid file format.";
	}

	else
	echo "Please select image..!";

	exit;
	}
}
function updatecoverpagePosition()
{
	$session = $this->session->userdata('logged_in');
	$session_uid = $session['user']['id'];
	    if(isset($_POST['position']) && isset($session_uid))
		{ 
			$data['id'] = $session_uid;
			$data['coverpage_position'] = $_POST['position'];
			 
			$status = $this->user_model->profileupdate($data);
		}
		 
		echo $data['coverpage_position']; exit;
}
//Get File Extension 
function getExtension($str) 
{
         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 
 //get Image Search
 function getImageSearch(){
	$arr = array();
	$arr['search']=$this->input->post('search');
	if($this->input->post('img_id')!=''){
		$arr['ID']=doDecrypt($this->input->post('img_id'));
	}
	//print_r($arr);exit;
	 $searchdata = $this->user_model->getImageSearch($arr);//print_r($searchdata);exit;
	 foreach($searchdata as $k=>$v){
		 $searchdata[$k]->ID=doEncrypt($v->ID);
	 }
	  //print_r($searchdata);exit;
	 $data = array();
	 if($searchdata){
		 $data['status']='success';
		 $data['searchdata']=$searchdata;
	 }else{
		 $data['status']='error';
		 $data['message']='Name or Hall Ticket Number not available';
	 }
	 echo json_encode($data);exit;
 }
 function checkOrgactivity(){
	$d=strtotime('-45 days',strtotime(date('Y-m-d H:i:s')));
	$activitydate = date('Y-m-d H:i:s',$d);
	$val="SELECT wo.id,concat_ws(',',(select group_concat(woo.tenantId) from whd_organizations woo where woo.parentId = wau.tenant_id group BY woo.parentId) , wau.tenant_id) orgid from whd_admin_users as  wau 
									LEFT JOIN whd_organizations wo ON (wau.tenant_id=wo.tenantId) where parentId=0 group by wo.ID";
	$query = $this->db->query($val);
	$orglist = $query->result();
	$inactiveorglist=array();
	foreach($orglist as $key=>$val){
		 $sql='SELECT whd_admin_users.id,whd_admin_users.email,whd_admin_users.first_name,whd_admin_users.last_name,whd_campaign.id as camid, whd_campaign.tenant_id, 
			CASE
				WHEN  whd_campaign.orgReminderCampaign="0000-00-00 00:00:00" THEN whd_campaign.created_on
				ELSE whd_campaign.orgReminderCampaign 
				END  AS "created_on"
		
FROM whd_campaign
RIGHT JOIN whd_admin_users ON whd_campaign.tenant_id = whd_admin_users.tenant_id
WHERE whd_campaign.tenant_id IN('.$val->orgid.') 
ORDER BY whd_campaign.id DESC
LIMIT 0 , 1';
		$query = $this->db->query($sql);
		$activity=$query->result();
		if($query->num_rows()>=1){
			foreach($activity as $k=>$v){
				if(strtotime($v->created_on)<strtotime($activitydate)){
					$inactiveorglist[$v->tenant_id]=$v;
				}
				$user=array();
				$user['id'] = $v->camid;
				$user['orgReminderCampaign'] = date('Y-m-d H:i:s');
				$usernoticationCount = $this->user_model->updateCampaignactivity($user); 
			}
		}else{
			$user= 'SELECT id,email,first_name,last_name,tenant_id,orgReminderCampaign
			FROM whd_admin_users where tenant_id IN('.$val->orgid.')';
			$query = $this->db->query($user);
			$activity=$query->result();
			foreach($activity as $ke=>$va){
				if(strtotime($va->orgReminderCampaign)<strtotime($activitydate)){
					$inactiveorglist[$va->tenant_id]=$va;
				}
				$user=array();
				$user['id'] = $va->id;
				$user['orgReminderCampaign'] = date('Y-m-d H:i:s');
				$usernoticationCount = $this->user_model->updateadminCampaignactivity($user); 
			}
		}
		
	}
		$url = "https://www.digitalapi.com/api/v1/sendMail";  
		$subject='Hello Customer!'; 
		$message='Hello!<br/>We hope you are doing well. We measured spike in alumni activity in your portal when you run campaigns. We believe it is most effective way to keep 
		alumni active and to spread the word aggressively.<br/><br/>We Request you to let us know incase you need our help to plan running Interesting campaigns accordingly.';
		$fromEmail='arun@rightlink.org';
		$fromName='RightLink';
		foreach($inactiveorglist as $k=>$v){
			$parameterarray=array(
				'message'=> $message,
				'subject'=> $subject,
				'to_mail'=> 'praveen@northalley.com',
				'from_mail'=> $fromEmail,
				'reply_to'=> $fromEmail,
				'from_name'=> $fromName,
				'to_name'=> $v->first_name.' '.$v->last_name,
				'type'=>'transactional',
			); 
			//Json encode to prepare data string
				$jsonencoded_data=  json_encode($parameterarray);
				//API DATA ARRAY
				$data = array('apiKey'=>'E74A21C81C8A78F7B8EE3A1F2DADA','data'=>$jsonencoded_data); 
			$response=  CallAPI($url,$data);
			}
 }

}
