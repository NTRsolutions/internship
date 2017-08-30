<?php defined('BASEPATH') OR exit('No direct script access allowed');

function encrypt()
{
    require_once('encryption/Crypt/RSA.php');
   
}
/**
 * Returns an encrypted & utf8-encoded
 */
function encryptE($pure_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
    return base64_encode($encrypted_string);
}

/**
 * Returns decrypted original string
 */
function decryptD($encrypted_string, $encryption_key) {
   $encrypted_string= base64_decode($encrypted_string);
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;
}


/**
 * Get the Organization Name
 */
function GetOrganization() {
	$CI =& get_instance();
        $CI->load->helper('url');
        $CI->load->library('session');
        $sesdata=$CI->session->userdata();
		
	/*$CI->load->model('dashboard/mdl_db');
		
	$result = $CI->mdl_db->GetOrganization();*/
	$query = getalltenantid($sesdata['id']);
	$tenantids = $query->result();
	if($query->num_rows()<=1){
	//if(isset($tenantids[0]->orgid)){
		$t= explode(",",$tenantids[0]->orgid);
		$CI->load->database(); 
		$CI->db->select("ID,organizationName,parentId");
		$CI->db->from("whd_organizations");
		$CI->db->where_in("ID",$t);
		$CI->db->where("status",1);
		$CI->db->order_by("ID ASC");
		$query = $CI->db->get();	
		 
		
		//print_r($query->num_rows());exit;
		if($query->num_rows() > 0):
			foreach($query->result() as $trow):
				$organizationlist[$trow->ID]['id']=$trow->ID;
				$organizationlist[$trow->ID]['orgname']=$trow->organizationName;
				$organizationlist[$trow->ID]['parent']=$trow->parentId;
			endforeach;
		endif;
		$a=array();
		
		$val=$sesdata['UDATA'][0]->ID;
		
		foreach ($organizationlist as $i => $t) {
			$cond='';
			if($t['id']==$val){
				$cond='selected="selected"';
			}
			$dash = ($t['parent'] == 0) ? '' : '- ';
			$a[$i]='<option '.$cond.' value='.$t['id'].'>'.$dash.$t['orgname'].'</option>';
			
		}
		return $a;
	}else{
		
	
	$CI->load->database(); 
	foreach($tenantids as $k=>$v){
		$t= explode(",",$v->orgid);
		$CI->db->select("ID,organizationName,parentId");
		$CI->db->from("whd_organizations");
		$CI->db->where_in("ID",$t);
		$CI->db->where("status",1);
		$CI->db->order_by("ID ASC");
		$query = $CI->db->get();	
		 
		
		//print_r($query);exit;
		if($query->num_rows() > 0):
			foreach($query->result() as $trow):
				$organizationlist[$trow->ID]['id']=$trow->ID;
				$organizationlist[$trow->ID]['orgname']=$trow->organizationName;
				$organizationlist[$trow->ID]['parent']=$trow->parentId;
			endforeach;
		endif;
		$a=array();
		
		$val=$sesdata['UDATA'][0]->ID;
		$a[0]='<option '.$cond.' value="1">RightLink</option>';
		foreach ($organizationlist as $i => $t) {
			$cond='';
			if($t['id']==$val){
				$cond='selected="selected"';
			}
			$dash = ($t['parent'] == 0) ? '' : '- ';
			$a[$i]='<option '.$cond.' value='.$t['id'].'>'.$dash.$t['orgname'].'</option>';
			
		}
	}
	return $a;
	//return $query->result();
	}
}

function getBranches(){
	
	
	$CI =& get_instance();
    $CI->load->helper('url');
    $CI->load->library('session');
    $sesdata=$CI->session->userdata();
    $CI->load->database(); 
    /*$t= explode(",",$sesdata['UDATA'][0]->tenant_id);
    
    $CI->db->select("whd_organizations.ID,whd_organizations.organizationName");
	$CI->db->from("whd_organizations");
	$CI->db->where_in("ID",$t);
	$CI->db->where("status",1);
	$CI->db->order_by("ID ASC");
	$query = $CI->db->get();*/
	$id=$sesdata['id'];
	getalltenantid($id);
	return $query->result();	
	 
}
function getalltenantid($id){
	$CI =& get_instance();
    $CI->load->helper('url');
    //$CI->load->library('session');
    $CI->load->database(); 
    if($id==1){
		$val="SELECT wo.id,concat_ws(',',(select group_concat(woo.tenantId) from whd_organizations woo where woo.parentId = wau.tenant_id group BY woo.parentId) , wau.tenant_id) orgid from whd_admin_users as  wau 
									LEFT JOIN whd_organizations wo ON (wau.tenant_id=wo.tenantId) where parentId=0 group by wo.ID";
	}else{
		$val = "SELECT wo.id,concat_ws(',',(select group_concat(woo.tenantId) from whd_organizations woo where woo.parentId = wau.tenant_id group BY woo.parentId) , wau.tenant_id) orgid from whd_admin_users as  wau 
									LEFT JOIN whd_organizations wo ON (wau.tenant_id=wo.tenantId) WHERE wau.id = ".$id;
	}
	$query = $CI->db->query($val);
	return $query;
}
function setTenantid($id){
	$CI =& get_instance();
    $CI->load->helper('url');
    $CI->load->library('session');
    $sesdata=$CI->session->userdata();
    $sesdata['UDATA'][0]->tenant_id=$id;
    $CI->session->set_userdata($sesdata);
}
/** 
 * Sending Email/sms curl code
 * */
function ExecApi($params,$apiUrl)
{
	$CI =& get_instance();
        $CI->load->helper('url');
        $CI->load->library('session');
	$sesdata=$CI->session->userdata();
 //print_r($sesdata);exit;
	$data = array();
	$data['apiKey'] = $sesdata['UDATA'][0]->digitalApiKey;
	if($apiUrl!=LIVEURL)
	$data['data'] = json_encode($params);
	$URL = $apiUrl;
	//print_r($data);exit;
    $cs = curl_init(); // curl session
    curl_setopt($cs, CURLOPT_URL, $URL);
    curl_setopt($cs, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($cs, CURLOPT_FAILONERROR, true);
    curl_setopt($cs, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cs, CURLOPT_POST, 1);
    curl_setopt($cs, CURLOPT_POSTFIELDS, $data);
    curl_setopt($cs, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($cs, CURLOPT_TIMEOUT, 30);
    curl_setopt($cs, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($cs, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($cs, CURLOPT_USERAGENT, 'TCPDF');
    $ret = curl_exec($cs);
    curl_close($cs);
    return $ret;

}


/**
 * Get the Organization Name
 */
function GetApiUsagecount() {
	$URL = GETUSAGE;
	$params = array();
	$status = ExecApi($params,$URL);
	$livestatus = json_decode($status);
	print_r($livestatus);exit;
}

/**
 * Get the GetApiUsagestatus
 */
function GetApiUsagestatus() {
	$URL = CREDITSTATUS;
	$params = array();
	$status = ExecApi($params,$URL);
	$livestatus = json_decode($status);
	$status=array();
	if(isset($livestatus->credits->service_credits->sendMail->credits)){
		$status['emailcount']=$livestatus->credits->service_credits->sendMail->credits;
	}else{
		$status['emailcount']='Api not avalable';
	}
	if(isset($livestatus->credits->service_credits->sendMessage->credits)){
		$status['smscount']=$livestatus->credits->service_credits->sendMessage->credits;
	}else{
		$status['smscount']='Api not avalable';
	}
	return $status;
}
/**
 * Site activity  
 */

 
function getUserRoles($m,$p){
	 
	$CI =& get_instance(); 
	$uid=$CI->session->userdata();
	$roleid = $uid['UDATA'][0]->user_roles_id;
	$tids = explode(",",$uid['UDATA'][0]->tenant_id);
	$CI->db->select("permissions");
	$CI->db->from("whd_admin_user_roles");
	$CI->db->where("id",$roleid); 
	$CI->db->where("status_id",1); 
	$query = $CI->db->get();
		if ( $query->result()) {
			$data= $query->result();
		} 
	$re = array();
	$role = json_decode($data[0]->permissions);
	//Organization removed the create permissions
	if(count($tids)!=1){
		foreach($role as $k=>$v){
			$re[$k]['c'] = 0;
			$re[$k]['r'] = $v->r;
			$re[$k]['u'] = $v->u;
			$re[$k]['d'] = $v->d;
		}
	}else{
		foreach($role as $k=>$v){
			$re[$k]['c'] = $v->c;
			$re[$k]['r'] = $v->r;
			$re[$k]['u'] = $v->u;
			$re[$k]['d'] = $v->d;
		}
	}
	if($re[$m][$p]){
			return true;
		}else{
			return false;
		}
} 
/**
 * get user roles end  
 */
 
