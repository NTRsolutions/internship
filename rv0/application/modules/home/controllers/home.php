<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {


   
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
		$this->load->model('home_model');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->library('safeurl');   
	}
	public function index()
	{ 
		//print_r($this->session->userdata('closeReloadWindow'));
		$data = array();
		$data['activepage'] = 'home';
		$data['success_msg'] = '';
		$data['error_msg'] = '';
		$data['openLogin'] = '';
		$data['user_id'] = '';
		$data['editPopup'] = '';
		$data['closeReloadWindow'] = '';
		$data['dest_url'] = '';
		$data['no_products']='';
			if(!empty($this->session->userdata('cart_products')))
            {
                 
                $cart_products=$this->session->userdata('cart_products');
                $data['product']=$this->home_model->getproducts();
                $total_quantity=0;
                foreach ($cart_products as $key => $value) {
                        $total_quantity+=$value['quantity'];
                        # code...
                    }    
            
                $data['no_products']=$total_quantity;
               // print_r($data);
                //$this->load->view('store_list',$data);
            }
            else
            {
                 $cart_products=array();
           		 $this->session->set_userdata('cart_products', $cart_products);
                    //echo 'hello';
                $data['product']=$this->home_model->getproducts();
                $data['no_products']=0;
               // print_r($data);
                //$this->load->view('store_list',$data);

            }







		if($this->input->get('dest-url')!='') 
		{
			$data['dest_url'] = $this->input->get('dest-url');
			$data['openLogin'] = 'yes';
		}
		if($this->session->userdata('closeReloadWindow'))
		{  //echo "asdsa"; exit;
			$data['closeReloadWindow'] = $this->session->userdata('closeReloadWindow');
			$this->session->set_userdata('closeReloadWindow','');
		}
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
		if($this->session->userdata('openLogin'))
		{
			$data['openLogin'] = $this->session->userdata('openLogin');
			$this->session->set_userdata('openLogin','');
		} 
		$session = $this->session->userdata('logged_in');
        //print_r($session);exit;
		
        //Check change password status
       /* if(isset($session['user']['id']) && $session['user']['id']!=''){
			$this->load->model('user/user_model');
			$passwordstatus = $this->user_model->Getuserpasswordstatus($session['user']['id']);
			if($passwordstatus[0]->changepassword==0){
				redirect('/user/changepassword', 'location');
			}
		}*/
        
		$this->load->model('news/news_model');
		$news = $this->news_model->Gethomenews();
		foreach($news as $k=>$v)
		{
			 $news[$k]->news_id = doEncrypt($v->news_id);
			 $news[$k]->created_on = date('d, M Y',strtotime($v->created_on));
			  
			  
		} 
		 
		$this->load->model('events/events_model');
		$events = $this->events_model->Gethomeevents();
		 
		foreach($events as $k=>$v)
		{
			 $events[$k]->event_id = doEncrypt($v->event_id);
			 $events[$k]->created_on = date('d, M Y',strtotime($v->created_on));
			  
			  
		} 
		//print_r($events);exit;
		$this->load->model('connections/connections_model');
		$connections = $this->connections_model->Gethomeconnections(); 
		$data['userCount'] = $this->connections_model->homeUserCount(); 
		$pastdata = array();
		$pastdata = $this->home_model->Gethomeposts();
		$data['bannerImages'] = $this->home_model->getBannerImages();
		 
		foreach($pastdata as $k=>$v)
		{     
			   $pastdata[$k]->editable = 0;
			  if(isset($session['user']['id']) && $v->user_id==$session['user']['id'])
			  {
				   $pastdata[$k]->editable = 1;
			  }
			  $pastdata[$k]->activity_content =  strip_tags($pastdata[$k]->activity_content);
			  $pastdata[$k]->action_item_id = doEncrypt($v->action_item_id);
			  $pastdata[$k]->id = doEncrypt($v->id);
			  
              			  
			 
		} 
	        //print_r($pastdata);exit;
		// to display post box in home page - checking session
		if(isset($session['user']['id']) && $session['user']['id']!='')
		{
			$data['user_id'] = $session['user']['id'];
			// edit popup template 
			$data['editPopup'] = $this->load->view('posts/editpostPopup', $data, true);
	    }
	    //display the admin users start
	    $this->load->model("message/message_model");
	    $adminusers = $this->message_model->get_admin_recivers();
	    foreach($adminusers as $k=>$v){
			$adminusers[$k]->id=doEncrypt($v->id); 
		}
		//chat counts
		if(isset($session['user']['id']) && $session['user']['id'] !=''){
			$this->load->model("chat/user_model");
			$contacts = $this->home_model->get_allc($session['user']['id']);
			$unreadcount='';
			foreach ($contacts as $key=>$contact) {
				//get unread messages from this user
				$this->load->model("chat/message_model");
				$unread = $this->home_model->unread_per_user($session['user']['id'], $contact->id);
				$contacts[$key]->unread =  $unread > 0 ? $unread : null ; 
				$unreadcount += $unread;
			}
		}else{
			$unreadcount='';
		}
	    //display the admin users end
	    $data['unreadcount']=$unreadcount;
	    $data['adminusers']=$adminusers;
		$data['news']=$news;
		$data['events']=$events;
		$data['pastdata']=$pastdata;
		$data['users']=$connections; 
	// print_r($data);exit;
		//echo $_COOKIE["rightlinkusername"];exit;
		//$name =get_cookie('rightlinkusername');print_r($name);exit
		$data['theme_body'] = $this->load->view('main', $data, true);
		  
		$this->load->view('theme/gj/inner_layout', $data);
		
		 
		
		 
	}
	public function getActivityContent(){
		
		//print_r($_POST);exit;
		$tablename="";
		 if($_POST['type']=='post'){
			$tablename='posts';
			$id='post_id';
			$con_des='post_description';
		 }
		if($_POST['type']=='news'){
			$tablename='news';
			$id='id';
			$con_des='news_description';
		 }
		 if($_POST['type']=='events'){
			$tablename='events';
			$id='id';
			$con_des='event_description';
		 } 
		 if($_POST['type']=='campaign'){
			$tablename='campaign';
			$id='id';
			$con_des='body';
		 }
		 
		  $data=array();
		 $data[]= $this->home_model->getActivityContent($this->input->post('actvityId'),$tablename,$id,$con_des);
		 json_decode($data[0]);exit;
		 // print_r($data[0]);exit;
		
		
	}
	public function getpost(){
		/*$data = array();
		$data['user_id']='';
		$session = $this->session->userdata('logged_in');
	    $data['pastdata'] = $this->home_model->Getactivities(doDecrypt($this->input->post('post_id')));
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
		// to display post box in home page - checking session
		if(isset($session['user']['id']) && $session['user']['id']!='')
		{
			$data['user_id'] = $session['user']['id'];
			 
	    } 
	  if($data['pastdata'])
	    $theme_body = $this->load->view('activity_li_content', $data, true);
	   else
	    $theme_body = $data['pastdata'];
	  echo json_encode($theme_body);exit;
	  exit;*/
	  $data = array();
	    $data['pastdata'] = $this->home_model->Getactivities(doDecrypt($this->input->post('post_id')));
	  foreach($data['pastdata'] as $k=>$v)
		{
			  $data['pastdata'][$k]->editable = 0;
			  if(isset($session['user']['id']) && $v->user_id==$session['user']['id'])
			  {
				   $data['pastdata'][$k]->editable = 1;
			  }
			  $data['pastdata'][$k]->activity_content =  strip_tags($v->activity_content);
			  $data['pastdata'][$k]->action_item_id = doEncrypt($v->action_item_id);
			  $data['pastdata'][$k]->id = doEncrypt($v->id);
               			  
			  
		}
	  if($data['pastdata'])
	    $theme_body = $this->load->view('activity_li_content', $data, true);
	   else
	    $theme_body = $data['pastdata'];
	  echo json_encode($theme_body);exit;
	  exit;
	  
  }
  /*comments module */
  public function getCommentdata(){
	   isLoggedin();
	  //$data=array();
	  //print_r($_POST);exit;
	  
	  $postid=doDecrypt($_POST['postId']);
	  $commentsdata = $this->home_model->getCommentdata($postid,$_POST['post_type']); 
	  //print_r($commentsdata);exit;
	 $cdata = array(); 
	  foreach($commentsdata as $k=>$v)
	  {
		//print_r($v); exit;
$cdata[$k]['id'] = $v->id;
 
$cdata[$k]['parent'] = $v->parent;
$cdata[$k]['fullname'] = $v->fullname;
$cdata[$k]['profile_picture_url'] = $v->profile_picture_url;
$cdata[$k]['created'] = time_elapsed_string(strtotime($v->created));
$cdata[$k]['modified'] = time_elapsed_string(strtotime($v->modified));		
$cdata[$k]['content'] = $v->content;
$cdata[$k]['created_by_admin'] = true;
$session = $this->session->userdata('logged_in');
	if($session['user']['id']==$v->userid){ 
     $cdata[$k]['created_by_current_user'] =true;
    }
$cdata[$k]['upvote_count'] = 0;	
$cdata[$k]['user_has_upvoted'] =true;	 
$cdata[$k]['post_id'] ='70'; 
$cdata[$k]['comment_id'] =$v->id;
	  }
  
	  $comdata=json_encode($cdata);
	  echo $comdata;exit;
	  
  }
  public function deleteCommentdata(){
	   isLoggedin();
	   $commentId = $this->home_model->deleteCommentdata($_POST['comment_id']);
	   if($commentId ){
		 echo json_encode($commentId);
		 exit;  
	   }
  }
  public function insertCommentdata(){
	  isLoggedin();
	  $data=array();
	  $session = $this->session->userdata('logged_in');
	  $data['entry_id']=doDecrypt($_POST['item_id']);
	  $data['entity_type']=$_POST['item_type'];
	  if($_POST['parent']!=""){
	  $data['parent_id']=$_POST['parent'];
	  }
	  $data['comment_created']=date("Y-m-d H:i:s");
	  $data['comment_modified']=date("Y-m-d H:i:s");
	  $data['userId']=$session['user']['id'];
	  $data['comment_body']=$_POST['content'];
      $data['userType']="user";
	  $data['tenant_id']=$session['user']['tenant_id'];
	  $commentId = $this->home_model->insertCommentdata($data);
	  $_POST['comment_id'] =  $commentId;
	  $_POST['fullname'] =  $session['user']['display_name'];
	  $_POST['created'] = time_elapsed_string(strtotime($_POST['created']));
	   $_POST['modified'] =time_elapsed_string(strtotime($_POST['modified']));
	  if($commentId){
		 echo json_encode($_POST);
		 exit;
	  }
	   
  }
  public function updateCommentdata(){
		isLoggedin(); 
		$session = $this->session->userdata('logged_in');
		$data['comment_id']=$_POST['comment_id'];
		$data['comment_body']=$_POST['content'];
		$data['comment_modified']=date("Y-m-d H:i:s");
		$commentId = $this->home_model->updateCommentdata($data);
	 // $_POST['comment_id'] =  $data['comment_id'];
	  //$_POST['fullname'] =  $session['user']['display_name'];
	  //$_POST['profile_picture_url'] =$session['user']['profile_thumb_image'];
	  if($commentId){
		  $_POST['modified'] =  time_elapsed_string(strtotime(date("Y-m-d H:i:s")));
		  echo json_encode($_POST);
             exit;
	  }
	}
  /* end comments module */	
  
  public function getpostdata(){
		$data = array();
		$this->load->model('posts/posts_model');
		$postdata = $this->posts_model->postdetailes(doDecrypt($this->input->post('post_id')));
		 
	    $pdata = array();
	    $pdata['id'] = $this->input->post('post_id');
	    $pdata['post_description'] = $postdata[0]->post_description;
	    $images = json_decode($postdata[0]->post_thumbs_images);
	   
	    $jsondata = array();
			 
					foreach($images as $k => $v)
					{
						$jsondata[$k]['name'] = $v;
						$jsondata[$k]['size'] = '123';
						$jsondata[$k]['type'] = 'image/jpg';
						$jsondata[$k]['file'] = $v;
					}
		   
	     $pdata['post_images'] = $jsondata;
	  echo json_encode($pdata);exit;
	  exit;
	  
  }
  public function getLocations()
  {
	  
	   $icons = array("blue", "red", "green");
       $rendKey = array_rand($icons);
        
	   $userdata = $this->home_model->getLocations();
	   $mapdata = array();
	   foreach($userdata as $k=>$v){
		   
		 $mapdata[$k][] = $v->latitude;
		 $mapdata[$k][] = $v->longitude;
		 $mapdata[$k][] = ASSETS.'assets/images/marker_'.$icons[$rendKey].'.png';
		 $mapdata[$k][] = $v->alumni_count.' alumni from '.$v->city;
		 $mapdata[$k][] =  $v->alumni_count.' alumni from '.$v->city;
		 $mapdata[$k][] = false;
		 $mapdata[$k][] = 1; 
	   }
	   echo json_encode($mapdata);
	   exit;
  }
  public function getnotificationpost(){
		$data = array();
		$session = $this->session->userdata('logged_in');
		$this->load->model('posts/posts_model');
	    $data['pastdata'] = $this->posts_model->Getnotification(doDecrypt($this->input->post('post_id')),$session['user']['id']);
	    foreach($data['pastdata'] as $k=>$v)
		{
			  $data['pastdata'][$k]->action_item_id = doEncrypt($v->action_item_id);
			  $data['pastdata'][$k]->id = doEncrypt($v->id); 
		} 
	    if($data['pastdata'])
	    $theme_body = $this->load->view('notification_li_content', $data, true);
	   else
	    $theme_body = $data['pastdata'];
	  echo json_encode($theme_body);exit;
	  exit;
	  
  }
	public function register()
	{
		
		isNotLoggedin();
		
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
		if($this->session->userdata('registerData'))
		{  //echo "asdsa"; exit;
			$data['user'] = $this->session->userdata('registerData');
			$this->session->set_userdata('registerData','');
		}
		$data['theme_body'] = $this->load->view('register', $data, true); 
		$this->load->view('theme/gj/inner_layout', $data);
		  
	}
	public function getip(){

    $client  = @$_SERVER['HTTP_CLIENT_IP'];

    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];

    $remote  = @$_SERVER['REMOTE_ADDR'];

    $result  = array('country'=>'', 'city'=>'');

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

        $result['city'] = $ip_data->geoplugin_city;

    }

    return $result;

  } 
  public function savepost()
  {
	  
	  isLoggedin();
	  if(isset($_FILES['files']['name'][0]) && $_FILES['files']['name'][0]!=''){
		  $uploads_dir = UPLOAD_ABS_PATH.'/uploads/posts';
		  $postimag = json_encode($_FILES['files']['name']);
		  $imagespaths=array();
		  $imagesthumbspaths=array();
		  $exluded_files = array();
		  
		  if($this->input->post('jfiler-items-exclude-files-0'))
		   $exluded_files = json_decode($this->input->post('jfiler-items-exclude-files-0'));
		 
		  foreach($_FILES['files']['name'] as $key=>$val){
			  // checkng removed files
			  if(in_array($_FILES["files"]["name"][$key],$exluded_files))
			   continue;
			  
			  $tmp_name = $_FILES["files"]["tmp_name"][$key];
			  $name = time().'_'.$_FILES["files"]["name"][$key];
			  //echo 'hai'. $tmp_name;
			  move_uploaded_file($tmp_name, $uploads_dir.'/'.$name);
			//  $this->createThumbnail($name); 
			  $imagespaths[]= base_url().'uploads/posts/'.$name;
			  $imagesthumbspaths[]= base_url().'uploads/posts/'.$name;
		  }
		  $postimages = json_encode($imagespaths);
		  $postthumbsimages = json_encode($imagesthumbspaths);
	  }else{
		  $postimag = '';
	  }
	  
	 $session = $this->session->userdata('logged_in');
	 $arr = array();
	 $activity =  array();
	 $activity['activity_content'] = $arr['post_description'] = strip_tags($this->input->post('post_description'));
	 $activity['user_id'] =  $arr['user_id']  = $session['user']['id'];
	 $activity['tenant_id'] = $arr['tenant_id']	=$session['user']['tenant_id'];
	 $arr['post_images'] =$postimages;
	 $arr['post_thumbs_images'] =$postthumbsimages;
	 $arr['post_status'] = 1;
	 $arr['post_type'] = "post";
	 
	 $activity['date_time'] = $arr['post_date'] = date('Y-m-d H:i:s');
     $postdata = $this->home_model->savepost($arr);
	 $activity['action_item_id'] = $postdata['id'];
	  
	 //siteactivity
	 
	 
	 if($postdata){
		 // adding to site track
		 $activity['action_type'] = 'post';
		 $activity['activity_content'] = $activity['activity_content'];
		 siteactivity($activity);
		 $postdata['data'][0]->post_id = doEncrypt($postdata['data'][0]->post_id);
		 $postdata['data'][0]->post_depcrypt =doDecrypt($postdata['data'][0]->post_id);
		 $postdata['data'][0]->id = doEncrypt($postdata['data'][0]->id);
		 echo json_encode($postdata['data'][0]);exit;
	 }else{
		 echo "aaaa";exit;
	 }
  }
  public function editpost()
  {
	  //edit_post_id
	  //edit_post_desc
	  isLoggedin();
	     $exluded_files = array();
		  
	    if($this->input->post('jfiler-items-exclude-updatefiles-0'))
	      $exluded_files = json_decode($this->input->post('jfiler-items-exclude-updatefiles-0'));
		   
		   
	  if(isset($_FILES['updatefiles']['name'][0]) && $_FILES['updatefiles']['name'][0]!=''){
		  $uploads_dir = UPLOAD_ABS_PATH.'/uploads/posts';
		  $postimag = json_encode($_FILES['updatefiles']['name']);
		  $imagespaths=array();
		  $imagesthumbspaths=array();
		  foreach($_FILES['updatefiles']['name'] as $key=>$val){
			  
			   // checkng removed files
			  if(in_array($_FILES["updatefiles"]["name"][$key],$exluded_files))
			   continue;
			   
			   
			  $tmp_name = $_FILES["updatefiles"]["tmp_name"][$key];
			  $name = time().'_'.$_FILES["updatefiles"]["name"][$key];
			  //echo 'hai'. $tmp_name;
			  move_uploaded_file($tmp_name, $uploads_dir.'/'.$name);
			 // $this->createThumbnail($name); 
			  $imagespaths[]= base_url().'uploads/posts/'.$name;
			  $imagesthumbspaths[]= base_url().'uploads/posts/'.$name;
		  }
		  $postimages = $imagespaths;
		  $postthumbsimages = $imagesthumbspaths;
	  }else{
		  $postimag = '';
	  }
	  
	 $session = $this->session->userdata('logged_in');
	 $arr = array();
	 $activity =  array();
	 $activity['activity_content'] = $arr['post_description'] = strip_tags($this->input->post('edit_post_desc'));
	 $activity['activity_content'] = substr(strip_tags($activity['activity_content']),0,200); 
	 $arr['post_images'] =$postimages;
	 $arr['post_thumbs_images'] =$postthumbsimages; 
	 $arr['edit_post_id'] = doDecrypt($this->input->post('edit_post_id')); 
	 //$activity['date_time'] = $arr['post_date'] = date('Y-m-d H:i:s'); 
	 $postdata = $this->home_model->updatepost($arr,$activity,$exluded_files,$session['user']['id']);
	 $arr['post_images'] =json_decode($postdata['post_images']);
	 $arr['post_thumbs_images'] =json_decode($postdata['post_images']);
	 //$activity['action_item_id'] = $postdata['id'];
	  
	 //siteactivity
	 
	 
	 if($postdata){
		 // adding to site track
		 $arr['edit_post_id'] = $this->input->post('edit_post_id');
		 
		 echo json_encode($arr);exit;
	 }else{
		 echo "false";exit;
	 }
  }
  public function activity()
  {
	   
	   	$data = array();
	   	$data['user_id'] = '';
	   	$session = $this->session->userdata('logged_in');
	   	$data['activepage'] = 'activity'; 
		$pastdata = $this->home_model->Gethomepostsactivity();
		$data['pastdata']=$pastdata;
		foreach($pastdata as $k=>$v)
		{
			  $pastdata[$k]->editable = 0;
			  if(isset($session['user']['id']) && $v->user_id==$session['user']['id'])
			  {
				   $pastdata[$k]->editable = 1;
			  }
			  $pastdata[$k]->activity_content =  strip_tags($v->activity_content);
			  $pastdata[$k]->action_item_id = doEncrypt($v->action_item_id);
			  $pastdata[$k]->id = doEncrypt($v->id); 
		} 
		// to display post box in home page - checking session
		if(isset($session['user']['id']) && $session['user']['id']!='')
		{
			$data['user_id'] = $session['user']['id'];
			// edit popup template 
			$data['editPopup'] = $this->load->view('posts/editpostPopup', $data, true);
	    } 
		$data['theme_body'] = $this->load->view('activity', $data, true); 
		$this->load->view('theme/gj/inner_layout', $data);
  }
  function createThumbnail($filename) {
     
    $final_width_of_image = 123; 
    $final_height_of_image = 123;
	$path_to_image_directory = getcwd().'/uploads/posts/';
	$path_to_thumbs_directory = getcwd().'/uploads/posts/thumbs/';
     
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

	public function educationInformation($msgid){
		$url=explode('/',$this->uri->uri_string());
		//echo $url[2];exit;
		$url=str_replace('%7E','~',$msgid);
		//echo $msgid;exit;
		//echo doDecrypt('tuVoEebl7V3p9Fnwi4-lF8E4kdLEcOe8dsqDaYdGiN1TiTf20JhWPK9lJn31mak2p5KHwgdft2vq4dYDUIAlBg~~');exit; 
		$data=array();
		$id=doDecrypt($url);
		$this->load->model('user/user_model');
		$userdata = $this->user_model->user($id);
		$arr = json_decode($userdata[0]->education_details);
		$data['school']=$arr->school;
		$data['undergraduation']=$arr->undergraduation;
		$data['postgraduation']=$arr->postgraduation;
		$data['phd']=$arr->phd;
		//$data['education_details'] = json_decode($userdata[0]->education_details);
		$data['profession'] = json_decode($userdata[0]->profession);
		$data['uid']=$id;
		//$interest=explode(",",$userdata[0]->alumni_interest);
		$interest = $this->user_model->getInterest($id);
		foreach($interest as $k=>$v){
			$i[]=$v->interestId;
		}
		$data['userinterest']=$i;
		//get alumni  interest data
		 $query=$this->user_model->getAlumnidata();
		 $data['alumniinterest']=$query;
        $data['theme_body'] = $this->load->view('education_information', $data, true);
		  
		$this->load->view('theme/gj/educational_layout', $data);
		//$this->load->view('education_information', $data);
	}
	
	public function saveedu(){
		//print_r($_POST);exit;
		$data=array();
		$arr=array();
		if(is_array($this->input->post('prof'))){
			foreach($this->input->post('prof') as $k=>$v){
				if($v->industry='other'){
					$industry=$v->other_industry;
				}else{
					$industry=$v->industry;
				}
				$arr['industry']=implode(",",$industry);
			}
		}
		$this->load->model('user/user_model');
		$arr['id']=$this->input->post('uid');
		$arr['profession']=json_encode($this->input->post('prof'));
		//$commentId = $this->home_model->updateprofession($arr);
		$arr2=array();
		//$arr1=array();
		//$this->load->model('user/user_model');
		//$arr['id']=$this->input->post('uid');
		$arr2['school']['school_name'] = $this->input->post('school_name');
		$arr2['school']['school_passout_year'] = $this->input->post('school_passout_year');
		$arr2['school']['school_location'] = $this->input->post('school_location');
			 
		$arr2['undergraduation']['undergraduation_name'] = $this->input->post('undergraduation_name');
		$arr2['undergraduation']['undergraduation_passout_year'] = $this->input->post('undergraduation_passout_year');
		$arr2['undergraduation']['undergraduation_specification'] = $this->input->post('undergraduation_specification');
		$arr2['undergraduation']['undergraduation_location'] = $this->input->post('undergraduation_location');
			 
		$arr2['postgraduation']['postgraduation_name'] = $this->input->post('postgraduation_name');
		$arr2['postgraduation']['postgraduation_specification'] = $this->input->post('postgraduation_specification');
		$arr2['postgraduation']['postgraduation_passout_year'] = $this->input->post('postgraduation_passout_year');
		$arr2['postgraduation']['postgraduation_location'] = $this->input->post('postgraduation_location');
			 
		$arr2['phd']['phd_name'] = $this->input->post('phd_name');
		$arr2['phd']['phd_specification'] = $this->input->post('phd_specification');
		$arr2['phd']['phd_passout_year'] = $this->input->post('phd_passout_year');
		$arr2['phd']['phd_location'] = $this->input->post('phd_location');
		$arr['education_details']=json_encode($arr2);
		$arr['last_updated_on']=date("Y-m-d H:i:s");
		//update user interest start
		$int=array();
		$userroleinsert=$this->user_model->deleteUserInterest($arr['id']);
		if($userroleinsert[0]->tenant_id ==''){
			$gettenant=$this->home_model->getUsertenant($arr['id']);
			$int['tenant_id']=$gettenant[0]->tenant_id;
		}else{
			$int['tenant_id']=$userroleinsert[0]->tenant_id;
		}
		//print_r($gettenant);exit;
		
		$int['user_id']=$arr['id'];
		foreach($this->input->post('user_interest') as $k=>$v){
			$int['interestId']=$v;
			$userroleinsert=$this->user_model->createUserInterest($int);
		}
		//update user interest end
		//$userinterest=implode(",",$this->input->post('user_interest'));
		//$arr['alumni_interest']=$userinterest;
		$commentId = $this->home_model->updateprofession($arr);
		$this->session->set_userdata('success_msg','Your Education and profession details updated successfully.');
		header('Location:' .base_url());
		//redirect(base_url());
		//$this->index();
		//$data['theme_body'] = $this->load->view('education_information_success', $data, true);
		  
		//$this->load->view('theme/gj/educational_layout', $data);
		
	}
	public function profileupdate(){
		//print_r($_POST);exit;
		$data=array();
		$arr2=array();
		$arr1=array();
		//$this->load->model('user/user_model');
		$arr1['id']=$this->input->post('uid');
		$arr2['school']['school_name'] = $this->input->post('school_name');
		$arr2['school']['school_passout_year'] = $this->input->post('school_passout_year');
		$arr2['school']['school_location'] = $this->input->post('school_location');
			 
		$arr2['undergraduation']['undergraduation_name'] = $this->input->post('undergraduation_name');
		$arr2['undergraduation']['undergraduation_passout_year'] = $this->input->post('undergraduation_passout_year');
		$arr2['undergraduation']['undergraduation_specification'] = $this->input->post('undergraduation_specification');
		$arr2['undergraduation']['undergraduation_location'] = $this->input->post('undergraduation_location');
			 
		$arr2['postgraduation']['postgraduation_name'] = $this->input->post('postgraduation_name');
		$arr2['postgraduation']['postgraduation_specification'] = $this->input->post('postgraduation_specification');
		$arr2['postgraduation']['postgraduation_passout_year'] = $this->input->post('postgraduation_passout_year');
		$arr2['postgraduation']['postgraduation_location'] = $this->input->post('postgraduation_location');
			 
		$arr2['phd']['phd_name'] = $this->input->post('phd_name');
		$arr2['phd']['phd_specification'] = $this->input->post('phd_specification');
		$arr2['phd']['phd_passout_year'] = $this->input->post('phd_passout_year');
		$arr2['phd']['phd_location'] = $this->input->post('phd_location');
		$arr1['education_details']=json_encode($arr2);
		$commentId = $this->home_model->updateprofession($arr1);
		$this->session->set_userdata('success_msg','Your education details updated successfully.');
		redirect(base_url(),'location');
	}
	public function setunsubscribe($msgid){
		//echo $msgid;exit;
		//echo doDecrypt('6xnYBteOoJrqCj87wCNBrYChZ9-yX_EinbIUMwa1Fo5BQdJqjlM1NvNwVLXS9PVrTZFhhEmxH9q7T-_aKwMBGA~~');exit; 
		$data=array();
		$id=doDecrypt($msgid);
		
		$data['uid']=$id;
		
        $data['theme_body'] = $this->load->view('unsubscribe', $data, true);
		  
		$this->load->view('theme/gj/educational_layout', $data);
		//$this->load->view('education_information', $data);
	}
	public function updateunsubscribe(){
		$arr=array();
		$arr['id']=$this->post->input('id');
		$arr['unSubscribe']=1;
		$commentId = $this->home_model->updateprofession($arr);
		$data['success']='success';
		echo json_decode($data);exit;
	}
	//get pages content
	public function getmorepages(){
		$last = $this->uri->total_segments();
		$record_num = $this->uri->segment($last);
		$urlname = rawurldecode($record_num);
		$pagecontent = $this->home_model->getmorePageinfo($urlname);
		$data=array();
		if($pagecontent){
			$data['description']=$pagecontent[0]->description;
		}else{
			$data['description']='testing';
		}
		$data['title'] =$urlname;
		$data['theme_body'] = $this->load->view('page_template', $data, true);
		  
		$this->load->view('theme/gj/inner_layout', $data);
	}
	public function About_Us(){
		$val='AboutUs';
		$pagecontent = $this->home_model->getPageinfo($val);
		$data=array();
		if($pagecontent){
			$data['description']=$pagecontent[0]->description;
		}else{
			$data['description']='testing';
		}
		$data['title'] =$pagecontent[0]->pageTitle;
		$data['theme_body'] = $this->load->view('page_template', $data, true);
		  
		$this->load->view('theme/gj/inner_layout', $data);
	}
}
