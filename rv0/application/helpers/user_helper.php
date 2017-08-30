<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$d = '';
function isLoggedin()
{
	 
	$CI =& get_instance(); 
	$session = $CI->session->userdata('logged_in');
	 
	 if($session['user']['id']=='')
	   {
			$redirect_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		   redirect('/home?dest-url='.urlencode ($redirect_link),'Location');
	   }else
	   {
	        $tent='tenant_id IN ('.SESSION_TENENT_ID.')'; 
			$CI->db->select("id");
			$CI->db->from("users");
			$CI->db->where("id",$session['user']['id']);
			$CI->db->where($tent);
			//$CI->db->where("status",'1');
			$query = $CI->db->get();
		
			if($query->num_rows()>0)
			{
				 
			  if($session['user']['email_verified']==0 && $session['user']['email']!='')
				redirect('user/registeremail','Location');
				else
				return true; 
			}else
			{
				redirect('user/logout','Location');
			}
	   } 
}


function isEmailVerified()
{
	$CI =& get_instance(); 
	$session = $CI->session->userdata('logged_in');
	 if($session['user']['id']!='' & $session['user']['email_verified']==0 && $session['user']['email']!='')
	   {
		  redirect('user/registeremail','Location');
	   }else
	      return true; 
}
function isNotLoggedin()
{
	
	$CI =& get_instance(); 
	$session = $CI->session->userdata('logged_in');
	
	 if($session['user']['id']!='')
	   {
		   redirect('/','Location');
	   }else
	    return true; 
}
function getOrgData()
{       
	    $tent='id IN ('.SESSION_TENENT_ID.')'; 
 $CI =& get_instance();
	  	$CI->db->select("about_org,contact_address,facebook_id,twitter_id,google_id,linked_id,facebook_url");
		$CI->db->from("organizations");
		$CI->db->where($tent);
		//$CI->db->where("status",'1');
		$query = $CI->db->get();
		//print_r($query->result());exit;
		if($query->result()){
			return $query->result();
		}else{
			return false;
	    }
	
}
function getBranchesdata()
{
	    //echo SESSION_TENENT_ID;exit; 
		
	    $tent='id IN ('.SESSION_TENENT_ID.')'; 
        $CI =& get_instance();
	  	$CI->db->select("organizationName");
		$CI->db->from("organizations");
		$CI->db->where($tent);
		//$CI->db->where("status",'1');
		$query = $CI->db->get();
		//print_r($query->result());exit;
		if($query->result()){
			return $query->result();
		}else{
			return false;
	    }
	
}

function getRoles(){
	    //$org =getorgtype();
		//$roletype=$org[0]->organizationType;
		$tent='tenant_id IN ('.SESSION_TENENT_ID.')'; 
	    $CI =& get_instance();
	  	$CI->db->select("*");
		$CI->db->from("whd_user_roles");
		$CI->db->where('roleType','alumni');
		$CI->db->where($tent);
		$CI->db->where("status_id",'1');
		$query = $CI->db->get();
		//print_r($query->result());exit;
		if($query->result()){
			return $query->result();
		}else{
			return false;
	    }
	}
 
function getBranchdetails()
{
	    $CI =& get_instance();
	    //echo SESSION_TENENT_ID;exit; 
		 //$session = $CI->session->userdata('logged_in');
		$session = $CI->session->userdata('logged_in');
		//print_r($session);exit;
	    //$tent='id IN ('.SESSION_TENENT_ID.')'; 
        $CI->db->select("id,branch_name,passout_year,course,provider");
		$CI->db->from("users");
		$CI->db->where('id',$session['user']['id']);
		$query = $CI->db->get();
		//print_r($query->result());exit;
		if($query->result()){
			return $query->result();
		}else{
			return false;
	    }
	
}
function getCourses(){
	    
	    $tent='id IN ('.SESSION_TENENT_ID.')'; 
        $CI =& get_instance();
	  	$CI->db->select("id,course");
		$CI->db->from("organizations");
		$CI->db->where($tent);
		//$CI->db->where("status",'1');
		$query = $CI->db->get();
		//print_r($query->result());exit;
		if($query->result()){
			return $query->result();
		}else{
			return false;
	    }
}
function getorgtype(){
	    //$tent='id IN ('.SESSION_TENENT_ID.')'; 
        $CI =& get_instance();
	  	$CI->db->select("id,organizationType");
		$CI->db->from("organizations");
		$CI->db->where('id',TENENT_ID);
		//$CI->db->where("status",'1');
		$query = $CI->db->get();
		//print_r($query->result());exit;
		if($query->result()){
			return $query->result();
		}else{
			return false;
	    }
}



function initiateData()
{
		
        $CI =& get_instance();
        //$CI->load->helper('cookie'); 	
	  	$CI->db->select("*");
		$CI->db->from("organizations");
		$CI->db->where_in("tenantId",TENENT_ID);
	    $CI->db->where("status",'1');
		$query = $CI->db->get();
		// print_r($query->result());exit;
		if($query->result())
		{
		    $initdata = $query->result();
			 
			$facebook=json_decode($initdata[0]->facebookLogin);
			$twitter=json_decode($initdata[0]->twitterLogin);
			$linked=json_decode($initdata[0]->linkedinLogin);
			 
			$fbkey=$facebook->key;
			$fbsec=$facebook->secret;
			$twkey=$twitter->key;
			$twsec=$twitter->secret;
			$likey=$linked->key;
			$lisec=$linked->secret;
			
			define('COOKIE_URL', $initdata[0]->alumniDomain); 
			define('ORGANISAION_NAME', $initdata[0]->organizationName);
			define('LOGO', $initdata[0]->profile_image);
			define('HEADERLOGO', $initdata[0]->header_image);
			define('THEMECOLOUR', $initdata[0]->themeColor);
			/*Contact inforamation*/
			define('CONACT_EMAIL', $initdata[0]->contactEmail);
			/* Digital Api Key */
			define('DigitalApiKey',$initdata[0]->digitalApiKey);
			define('FROM_EMAIL',$initdata[0]->fromEmail);
			define('FROM_NAME',$initdata[0]->fromName);
			define('FacebookID',$fbkey);
			define('FacebookSeckey',$fbsec);
			define('twitterID',$twkey);
			define('twitterSeckey',$twsec);
			define('linkedID',$likey );
			define('linkedSeckey',$lisec);
			$tenants = array();
			
			$val = "SELECT wo.id,concat_ws(',',(select group_concat(woo.tenantId) from whd_organizations woo where woo.parentId = wau.tenant_id group BY woo.parentId) , wau.tenant_id) orgid from whd_admin_users as  wau 
									LEFT JOIN whd_organizations wo ON (wau.tenant_id=wo.tenantId) WHERE wau.tenant_id =".TENENT_ID;
			 
			$query = $CI->db->query($val);
			$tenants = $query->result();
			 
			 //$dj_genres = trim($tenants[0]->orgid, "'");
			 //$dj_genres_array = explode(",", $dj_genres);
			 
			//print_r($tenants);exit;
			 define('SESSION_TENENT_ID',$tenants[0]->orgid); 
			//echo SESSION_TENENT_ID;exit;
	// parent
			/*if(suborganisation)
			{ 
			
			$tenants[] = TENENT_ID;
			}else
			{
				while()
				{
					$tenants[] = TENENT_ID;
				}
			}*/
			// if he is main org so get the sun tenants and map to SESSION_TENENT_ID
			// define('SESSION_TENENT_ID',); 
			
			
		}else{
			echo "error in configuration"; exit;
		} 
}


function time_elapsed_string($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
} 
 
function Getposts(){
	$CI =& get_instance();
	$session = $CI->session->userdata('logged_in');
	
	$CI->load->model('posts/posts_model');
	$co = $CI->posts_model->Getposts($session['user']['id']);
	if($co=='' || $co==0){
		$co=0;
		return $co;
	}else{
		return $co;
	}
}
function Getpostsdatacontent($id){
	$CI =& get_instance();
	$CI->load->model('posts/posts_model');
	$co = $CI->posts_model->Getpostsalertdata($id);
	if($co=='' || $co==0){
		$co=0;
		return $co;
	}else{
		return $co;
	}
	
}

function siteactivity($content){
	 
	$CI =& get_instance(); 
	$CI->load->model('home/home_model');
	$CI->home_model->siteactivity($content); 
	return  true;
 
}

function logactivity($content){
	 
	$CI =& get_instance(); 
	$CI->load->model('home/home_model');
	$CI->home_model->logactivity($content); 
	return  true;
 
}

function getMessagenotification(){
	$CI =& get_instance();
	$session = $CI->session->userdata('logged_in');
	$id = $session['user']['id'];
	$CI->load->model('message/message_model');
	$inbox =$CI->message_model->counter(array("read_status" => 0, "to_status" => 0, "receiverID" => $id));
	$sent = $CI->message_model->counter(array("reply_status" => 1, "from_status" => 0, "userID" => $id)); 
	return  $inbox+$sent; 
 
}

function Getpostsdata(){
	$CI =& get_instance();
	$session = $CI->session->userdata('logged_in'); 
	$CI->load->model('posts/posts_model');
	$co = $CI->posts_model->Getpostsdata($session['user']['id']);
	foreach($co as $k=>$v)
		{
			  $co[$k]->action_item_id = doEncrypt($v->action_item_id);
			  $co[$k]->id = doEncrypt($v->id); 
		} 
	 
	return $co;
}
 
function doEncrypt($str)
    {
		$CI =& get_instance();
		$CI->load->library('encrypt');
        $data=$CI->encrypt->encode($str);
        return str_replace(array('+', '/', '='), array('-', '_', '~'), $data);
    }
function doDecrypt($str)
    {
		$CI =& get_instance();
		$CI->load->library('encrypt');
        $data=str_replace(array('-', '_', '~'), array('+', '/', '='), $str);
        return $CI->encrypt->decode($data);
    }
 
function totalchatcount(){
	  $CI =& get_instance(); 
	 $session=$CI->session->userdata('logged_in');
	 if(isset($session['user']['id']) && $session['user']['id'] !=''){ 
			$CI->load->model("chat/helper_model");
			$contacts = $CI->helper_model->get_all_helper($session['user']['id']);
			$unreadcount='';
			foreach ($contacts as $key=>$contact) {
				 $val="SELECT * from whd_messages where is_read IN('','0') AND `to`=".$session['user']['id']." AND `from`=".$contact->id;
				$query = $CI->db->query($val);
				//print_r($query);exit;
				if($query->num_rows()) {
					$unreadcount += $query->num_rows();
				} 
			
			}
			$admincontacts = $CI->helper_model->get_adminUsers_helper();
			foreach ($admincontacts as $key=>$admincontacts) {
				 $val="SELECT * from whd_messages where is_read IN('','0') AND `to`=".$session['user']['id']." AND `from`=".$admincontacts->id;
				$query = $CI->db->query($val);
				//print_r($query);exit;
				if($query->num_rows()) {
					$unreadcount += $query->num_rows();
				} 
			
			}
				
		}else{
			$unreadcount='';
		}
		//echo $unreadcount;exit;
		return $unreadcount;
		
	}
function facebookTags(){
	
	 $CI =& get_instance();
	  	$CI->db->select("facebookOgtags,organizationType,ogTitle");
		$CI->db->from("organizations");
		$CI->db->where_in("tenantId",TENENT_ID);
	    $CI->db->where("status",'1');
		$query = $CI->db->get();
		$tenants = $query->result();//print_r($_SERVER['REQUEST_URI']);exit;
		$pagetittle=explode("/",$_SERVER['REQUEST_URI']);
		if($_SERVER['REQUEST_SCHEME']=='http'){
			$url=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'];
			$pagetitle=$pagetittle[1];
		}else{
			$url=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$pagetitle=$pagetittle[3];
		}
		/*if($tenants[0]->organizationType=='school'){
			$img='https://rightlink.org/alumni/assets/img/FB-School-post.png';
		}else{
			$img='https://rightlink.org/alumni/assets/img/FB-College-post.png';
		}*/
		//print_r($_SERVER);exit;
		$CI->db->select("*");
		$CI->db->from("ogtags");
		$CI->db->where_in("tenant_id",TENENT_ID);
		$CI->db->where("urlType",$pagetitle);
	    $CI->db->where("og_status",'1');
	    $CI->db->order_by("UpdatedOn","desc");
		$ogquery = $CI->db->get();
		$iages=$ogquery->result();
		$img=$iages[0]->ogImage;
		$description=$iages[0]->ogDescription;
		$title=$iages[0]->ogTitle;
		if($iages[0]->url!=''){
			$url=$iages[0]->url;
		}
	 $facebook['pageUrl']=$url;
	 $facebook['description']=$description.'-'.ORGANISAION_NAME;
	 $facebook['homepageUrl']=base_url();
	 $facebook['siteTitle']=ORGANISAION_NAME;
	 $facebook['pageTitle']=$title.'-'.$pagetitle;
	 $facebook['imageUrl']=$img;
	 return $facebook;
 }
 function getMenuurls(){
	 $CI =& get_instance();
	 $CI->db->select("pageTitle,description,morePages");
	 $CI->db->from("pages");
	 $CI->db->where_in("tenantID",TENENT_ID);
	 $CI->db->where("page_status",'1');
	 $query = $CI->db->get();
	 $pages = $query->result();
	 foreach($pages as $k=>$v){
		 if($v->pageTitle=='more'){
			 $page['more'][$k]['name']=$v->morePages;
			 $page['more'][$k]['description']=$v->description;
		 }else{
			 if($v->pageTitle=='AboutUs'){
				 $page['name']=$v->pageTitle;
				$page['description']=$v->description;
			}else{
				$page['rolepages'][$k]['name']=$v->pageTitle;
				$page['rolepages'][$k]['description']=$v->description;
			}
		}
	 }
	 
	 //$page['count']=count($pages);
	 $page['pagelist']=$page;
	 //print_r($page);exit;
	 return $page;
	 
 }
 
 function alumniroleurls(){
	 $CI =& get_instance(); 
	 $CI->db->select("count(whd_user_role.RID) as count,whd_user_role.role_id,whd_user_roles.name");
	 $CI->db->from("whd_user_role");
	 $CI->db->join("whd_user_roles", "whd_user_role.role_id=whd_user_roles.id", 'INNER');
	 //$CI->db->join("whd_pages1", "whd_user_roles.name=whd_pages.pageTitle", 'INNER');
	 $CI->db->where("whd_user_roles.status_id",1);
	 $CI->db->where("whd_user_roles.roleType",'alumni');
	 $CI->db->where_in("whd_user_role.tenant_id",TENENT_ID);
	 $CI->db->group_by("whd_user_role.role_id"); 
	 $query = $CI->db->get();
	 $pages = $query->result();
	 if($pages){
		 //foreach($pages as $k=>$v){
		//	 $pages[$k]->encryptid=doEncrypt($v->role_id);
		// }
		// print_r($pages);exit;
		return $pages;
	}else{
		return false;
	}
	
 }
 
 function rolesList(){
	 $alumnirole=alumniroleurls();
	 $menulist=getMenuurls();
	 foreach($alumnirole as $k=>$v){
		
		 $val[$v->name]=$v;
	 }
	  foreach($menulist['rolepages'] as $x=>$y){
			$val1[$y['name']]=$y;
		 }
	 if(count($val1)==0){
			 $val1=array();
		 }
		 if(count($val)==0){
			 $val=array();
		 }
	 $c = array_merge_recursive($val, $val1);
	  return $c;
 }
