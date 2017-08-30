<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$d = '';

function getmenu($k)
{
	     $CI =& get_instance();
  		 $CI->load->model('menus/admin_menu_model');
         $menud = $CI->admin_menu_model->getMenuInfo($k);  
		 return $menud;
} 
  
function menu($arr, $parent ,$menu_id  ) {
GLOBAL $d;			
		 
			 foreach ($arr as $row) { 
				$open = 0;
				$f = getmenu($row['id']);
				 
				if ($parent == $row['parent_id']) {
					 $d .= ($open?'':'<li id="list_'.$row['id'].'"><div><span class="disclose"><span></span></span> <span class="menu_name_span">'.$f[0]->menu_item_name.'</span> <a  href="javascript:void(0)" class="edit_menu_item" alt="http://localhost/cms/admin/menus/editmi/'.$row['id'].'"  ><i class="icon-pencil"></i></a><a id="'.$row['id'].'" alt="'.$menu_id.'" class="confirmbutton" href="javascript:void(0)" style="float:right;"  ><i class="icon-trash"></i></a></div>')."<ol>";
					
					menu($arr, $row['id'] , $row['id'] );  
					 $d.=  "</ol>";
					$open++;
					 
				} 
			}
			/*foreach ($arr as $row) {
				 $open = 0;
				$f = getmenu($row['id']);
				if ($parent == $row['parent_id']) {
					
					$ul = '<ul id="medialist" class=""  >';
                    $ul.='<li class="image" style="padding:3px;list-style:none">';								 
                    $ul.=' <a   href="http://localhost/cms/admin/menus/editmi/'.$row['id'].'"  ><i class="icon-pencil"></i></a> ';                          	 
                    $ul.='</li></ul>';
					$data.= ($open?'':'<li id="list_'.$row['id'].'"><div><span class="disclose"><span></span></span> <span class="menu_name_span">'.$f[0]->menu_item_name.'</span> <a  href="javascript:void(0)" class="edit_menu_item" alt="http://localhost/cms/admin/menus/editmi/'.$row['id'].'"  ><i class="icon-pencil"></i></a><a id="'.$row['id'].'" alt="'.$menu_id.'" class="confirmbutton" href="javascript:void(0)" style="float:right;"  ><i class="icon-trash"></i></a></div>')."<ol>";
					menu($arr, $row['id'],$menu_id);
					$data.=  "</ol>";
					$open++;
				} 
			}*/
			 
			 return $d;
}

 




function leftMenu()
{	 
	echo'<div class="accordion" id="accordion2">
			<div class="accordion-group">
				<div class="accordion-heading">
				<a class="accordion-toggle" href="'.base_url('admin/adminusers').'">
				 <i class="icon-chevron-right"></i>Admin User List</a>
			    </div>
			</div>
			<div class="accordion-group">
				<div class="accordion-heading">
				<a class="accordion-toggle" href="'.base_url('admin/adds').'">
				 <i class="icon-chevron-right"></i>Advertisement</a>
			    </div>
			</div>
				<div class="accordion-group">
				<div class="accordion-heading">
				<a class="accordion-toggle" href="'.base_url('admin/course').'">
				 <i class="icon-chevron-right"></i>Course</a>
			    </div>
			</div>
			<div class="accordion-group">
				<div class="accordion-heading">
				<a class="accordion-toggle" href="'.base_url('admin/pages').'">
				  <i class="icon-chevron-right"></i>Pages  
				 </a>
			    </div>
			</div>
			<div class="accordion-group">
				<div class="accordion-heading">
				<a class="accordion-toggle" href="'.base_url('admin/contactus').'">
			    <i class="icon-chevron-right"></i>Contact List 
				</a>
			    </div>
			</div>
	 
			<div class="accordion-group">
				<div class="accordion-heading">
				<a class="accordion-toggle" href="'.base_url('admin/banners').'">
				 <i class="icon-chevron-right"></i>Banners
				</a>
			    </div>
			</div>
			<div class="accordion-group">
				<div class="accordion-heading">
				<a class="accordion-toggle" href="'.base_url('admin/exams').'">
				 <i class="icon-chevron-right"></i>Exams
				</a>
			    </div>
			</div>
		 	<div class="accordion-group">
				<div class="accordion-heading">
				<a class="accordion-toggle" href="'.base_url('admin/questions').'">
				 <i class="icon-chevron-right"></i>Questions
				</a>
			    </div>
			</div>
		</div>';	
}




 

function menuactive()
{
	$arr=array();
	$CI =& get_instance();
	$arr['c']=$CI->router->fetch_class();
	$arr['m']=$CI->router->fetch_method();
	return $arr;
	
}
function frontendLoginCheck()
{
$CI =& get_instance();
$CI->load->library('session');
$temp = $CI->session->userdata('session_user');
if(isset($temp->customer_id) && trim($temp->customer_id) != '')
		return true; 
}



function adminLoginCheck()
{
	$CI =& get_instance();
	$CI->load->library('session');
	$temp = $CI->session->userdata('scms_admin_users');
	if(isset($temp->admin_id) && trim($temp->admin_id) != '')
		return true;
	    return false;
}

function language_load()
{
	return "english";
	$ci =& get_instance();
	$ci->load->helper('language');
	
	$site_lang = $ci->session->userdata('site_lang');
	if ($site_lang) {
		$ci->lang->load('message',$ci->session->userdata('site_lang'));
	} else {
		$ci->lang->load('message','english');
	}
}

function getBreadcrumbs($arr)
{
	$str = '';
	foreach($arr as $k=>$v)
	{
		if($v == '')
			$str .= '<li> '.$k.'</li>';
		else
			$str .= '<li><a href="'.$v.'"> '.$k.' <span class="divider">/</span> </a></li>';
	}
	return $str;
}
function getbannerimages()
{  
   $CI =& get_instance();
  		 $CI->load->model('banners/banner_model');
          $result1 = $CI->banner_model->bannerlist();
		     return $result1;
}

function getcategoryimages()
{  
   $CI =& get_instance();
  		 $CI->load->model('welcome/loginmodel');
          $result1 = $CI->loginmodel->categoryimg();
		     return $result1;
}
function getcourses()
{
	$CI =& get_instance();
	$CI->load->model('course/admin_subcoursecategory_model');
	$co = $CI->admin_subcoursecategory_model->subcoursecategies();
	return $co;
	 
}
 
function socialicons()
{
	 
echo 	'<div class="addthis_toolbox addthis_default_style ">
	<a class="addthis_button_preferred_1"></a>
	<a class="addthis_button_preferred_2"></a>
	<a class="addthis_button_preferred_3"></a>
	<a class="addthis_button_preferred_4"></a>
	<a class="addthis_button_compact"></a>
	<a class="addthis_counter addthis_bubble_style"></a>
	</div>
	
	<script type="text/javascript">var addthis_config = {
		"data_track_addressbar":true};</script>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-512f3b8f50d95ea5"></script>';
		 
}
function emailSend($to, $subject, $message , $from='')
{
	$CI =& get_instance();
	$CI->load->library('email');
	$config = array (
			'mailtype' => 'html',
			'charset'  => 'utf-8',
			'priority' => '1'
	);
	$CI->email->initialize($config);
	$CI->email->from('info@skill.com');
	$CI->email->reply_to('info@skill.com');
	$CI->email->to($to);
	 
	$CI->email->subject($subject);
	$CI->email->message($message);
	$CI->email->send();
	 
 
}

function getpage($alias)
{
	$CI =& get_instance();
	$CI->load->model('pages/page_model');
	$page_data = $CI->page_model->getpagecontent($alias);
	 return $page_data;
	
}
function getadv($img)
{
	$CI =& get_instance();
	$CI->load->model('adds/adds_model');
	$result1 = $CI->adds_model->addsimage($img);
	return $result1;
	 
	 
}
