<?php

class User_model extends CI_Model{

	public $register_rules = array(
		    'firstname' => array (
					'field' => 'firstname',
					'label' => 'first name',
					'rules' => 'trim|required|xss_clean'
			),
			'lastname' => array (
					'field' => 'lastname',
					'label' => 'last name',
					'rules' => 'trim|required|xss_clean'
			),
			'email' => array (
					'field' => 'email',
					'label' => 'email',
					'rules' => 'trim|required|valid_email|callback_unique_email|xss_clean'
			),
			'username' => array (
					'field' => 'username',
					'label' => 'username',
					'rules' => 'trim|required|callback_unique_username|xss_clean'
			),
			'password' => array (
					'field' => 'password',
					'label' => 'password',
					'rules' => 'trim|required|matches[cpassword]|xss_clean'
			),
			'cpassword' => array (
					'field' => 'cpassword',
					'label' => 'confirm password',
					'rules' => 'trim|required|matches[password]|xss_clean'
			)
		);

		public $login_rules = array(
			'username' => array (
					'field' => 'username',
					'label' => 'username',
					'rules' => 'trim|required|xss_clean'
			),
			'password' => array (
					'field' => 'password',
					'label' => 'password',
					'rules' => 'trim|required|xss_clean'
			)
		);	

		public $profile_rules = array(
			'firstname' => array (
					'field' => 'firstname',
					'label' => 'firstname',
					'rules' => 'trim|required|xss_clean'
			),
			'lastname' => array (
					'field' => 'lastname',
					'label' => 'lastname',
					'rules' => 'trim|required|xss_clean'
			),
			'email' => array (
					'field' => 'email',
					'label' => 'email',
					'rules' => 'trim|required|valid_email|callback_email_check|xss_clean'
			)
		);	
		public $password_rules = array(
			'current_password' => array (
					'field' => 'current_password',
					'label' => 'current password',
					'rules' => 'trim|required|callback_password_check|xss_clean'
			),
			'new_password' => array (
					'field' => 'new_password',
					'label' => 'new password',
					'rules' => 'trim|required|xss_clean'
			),
			'confirm_newpassword' => array (
					'field' => 'confirm_newpassword',
					'label' => 'confirm password',
					'rules' => 'trim|required|matches[new_password]|xss_clean'
			)
		);	
		
		public function get_all($id)
		{
			$tenant = 'tenant_id IN ('.SESSION_TENENT_ID.')';
			$this->db->select("*");
			$this->db->from("users");
			$this->db->where('status',1);
			$this->db->where($tenant);
			//$this->db->where_in('1tenant_id',SESSION_TENENT_ID);
			$this->db->where('id !=',$id);		
			$query = $this->db->get();
		   if ( $query->result()) {
				return $query->result();
			} else {
				 
				return false;
			}
		}
		public function get_allusers($id)
		{
			//$sql='SELECT u.id,u.display_name,u.profile_image,u.passout_year, (select `time` FROM whd_messages WHERE (`from` = u.id OR `to` = u.id) and u.id != '.$id.' ORDER by id DESC limit 0, 1) as timew FROM whd_users as u WHERE u.tenant_id IN('.SESSION_TENENT_ID.') and u.status = 1 and u.id != '.$id.' order by timew DESC ';
			$sql='SELECT u.id,u.display_name,u.profile_image,u.passout_year, (select `time` FROM whd_messages WHERE (`from` = u.id OR `to` = u.id) and u.id != '.$id.' ORDER by id DESC limit 0, 1) as timew FROM whd_users as u WHERE u.tenant_id IN('.SESSION_TENENT_ID.') and u.status = 1 and u.id != '.$id.' order by u.passout_year DESC ';
			
			//echo $ids;exit;
			/*$sql = 'SELECT `whd_users`.*, `whd_messages`.message, `whd_messages`.time FROM (`whd_users`) 
			LEFT JOIN `whd_messages` ON `whd_messages`.`from` = `whd_users`.`id` 
			LEFT JOIN `whd_messages` as mess ON `mess`.`to` = `whd_users`.`id` 
			WHERE `whd_users`.`status` = 1 AND `whd_users`.`tenant_id` IN (5) AND `whd_users`.`id` != 1 
			GROUP BY `whd_users`.`id` 
			ORDER BY `whd_messages`.`id` asc ';
			$tenant = 'users.tenant_id IN ('.SESSION_TENENT_ID.')';
			$this->db->select("users.*,messages.message,messages.time");
			$this->db->from("users");
			$this->db->join('messages', 'messages.from = users.id','left');
			$this->db->join('messages as mess', 'mess.to = users.id','left');
			$this->db->where('users.status',1);
			$this->db->where($tenant);
			//$this->db->where_in('1tenant_id',SESSION_TENENT_ID);
			$this->db->where('users.id !=',$id);
			
			$this->db->group_by('messages.id');
			$this->db->order_by("messages.time", "desc");*/
				
			$query = $this->db->query($sql);
		   if ( $query->result()) {
				return $query->result();
			} else {
				 
				return false;
			}
		}
		public function get_allusers_search($id,$searchname)
		{
			  if($searchname!=""){

			 /*$sql='SELECT u.id,u.display_name,u.profile_image, (select `time` FROM whd_messages WHERE (`from` = u.id OR `to` = u.id) and u.id != '.$id.' ORDER by id DESC limit 0, 1) as timew FROM whd_users as u WHERE u.tenant_id IN('.SESSION_TENENT_ID.') and u.status = 1 and u.first_name LIKE "%'.$searchname.'%" or u.first_name LIKE "%'.$searchname.'%" or u.passout_year LIKE "%'.$searchname.'%" and u.id != '.$id.' order by timew DESC ';
			 $query = $this->db->query($sql);
			 if ( $query->result()) {*/                                                                                                                                                                                                                                              

			 $sql='SELECT u.id,u.display_name,u.profile_image,u.passout_year, (select `time` FROM whd_messages WHERE (`from` = u.id OR `to` = u.id) and u.id != '.$id.' ORDER by id DESC limit 0, 1) as timew FROM whd_users as u WHERE u.tenant_id IN('.SESSION_TENENT_ID.') and u.status = 1 and (u.first_name LIKE "%'.$searchname.'%"  OR u.display_name LIKE "%'.$searchname.'%" OR u.last_name LIKE "%'.$searchname.'%" OR u.passout_year LIKE "%'.$searchname.'%") and u.id != '.$id.' order by u.passout_year DESC ';
			 $query = $this->db->query($sql);
			 if ($query->result()) {                                                                                                                                                                                                                                              $like_str .= "industry LIKE '%".$v."%'";

				return $query->result();
			} else {
				 
				return 'error';
			}
		  }else{
			    
			  $sql='SELECT u.id,u.display_name,u.profile_image,u.passout_year, (select `time` FROM whd_messages WHERE (`from` = u.id OR `to` = u.id) and u.id != '.$id.' ORDER by id DESC limit 0, 1) as timew FROM whd_users as u WHERE u.tenant_id IN('.SESSION_TENENT_ID.') and u.status = 1 and u.id != '.$id.' order by u.passout_year DESC ';
		    $query1 = $this->db->query($sql);
			 if ( $query1->result()) {
				return $query1->result();
			} else {
				 
				return false;
			}
			  
		  }
		}
		 
		public function getAdminusers($id){
			$tenant = 'tenant_id IN ('.SESSION_TENENT_ID.')';
			$this->db->select("*");
			$this->db->from("admin_users");
			//$this->db->where('status',1);
			$this->db->where('id',$id);	
			$this->db->where($tenant);
			$query = $this->db->get();
		   if ( $query->result()) {
				return $query->result();
			} else {
				 
				return false;
			}
		}
		public function get($id)
		{
			$tenant = 'tenant_id IN ('.SESSION_TENENT_ID.')';
			$this->db->select("*");
			$this->db->from("users");
			//$this->db->where('status',1);
			$this->db->where('id',$id);	
			$this->db->where($tenant);
			$query = $this->db->get();
		   if ( $query->result()) {
				return $query->result();
			} else {
				 
				return false;
			}
		}
		public function get_adminUsers(){
			$tenant = 'tenant_id IN ('.SESSION_TENENT_ID.')';
			$this->db->select("*");
			$this->db->from("admin_users");
			//$this->db->where('status',1);
			$this->db->where($tenant);		
			$query = $this->db->get();
		   if ( $query->result()) {
				return $query->result();
			} else {
				 
				return false;
			}
		}
		
		public function unread_peruser($id, $from){
		$this->db->select("*");
		$this->db->from("messages");
		$this->db->where_in('is_read',array('','0'));	
        $this->db->where('`to`',$id);
        $this->db->where('`from`',$from);
        	
		$query = $this->db->get();
		//print_r($query);exit;
	   if ( $query->num_rows()) {
			return $query->num_rows();
		} else {
			 
			return false;
		}
		
		/*$count  =  $this->db->where('to', $id)
							->where('from', $from)
							->where('is_read', '0')
							->count_all_results('messages');
		return $count;*/
	}
}
