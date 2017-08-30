<?php
class Category_model extends CI_Model {

	function __construct()
        {
             parent::__construct();
             $this->load->database();
        }

	function addsideview($data)
	{
		

		$this->db->set($data['pic'], $data['img']);
		$this->db->where('tenant_id',TENENT_ID);
		$this->db->where('c_id', $data['c_id']);
		$this->db->update('whd_category');
			/*$this->db->set($data['view'], $data['img']);
			$this->db->where('pid', $data['pid']);
			$this->db->where('tenant_id',TENENT_ID);
			$this->db->update('whd_products');*/
		//$this->db->insert("whd_products");

	}
	
	function getproducts_onkey($key)
	{
	
		if($key=="")
		{	
			$this->db->where('tenant_id', TENENT_ID);
			$this->db->distinct();
			$this->db->select('c_name');
			$this->db->select('c_description');
			$this->db->select('c_img');
			$data=$this->db->get("whd_category");
			return $data->result();
		}
		else
		{
			$this->db->where('tenant_id',TENENT_ID);
			$this->db->where("c_name LIKE '%$key%'");
			$this->db->distinct();
			$this->db->select('c_name');
			$this->db->select('c_description');
			$this->db->select('c_img');
			$data=$this->db->get("whd_category");
			return $data->result();
		}


	}
	function delete_record($c_id)
	{
		$this->db->where('c_name',$c_id);
		$this->db->where('tenant_id', TENENT_ID);
        $d=$this->db->get("whd_category");
        $data=$d->result();
       // echo $data[0]->img;
       // echo FCPATH.'uploads/store/'.$data[0]->img.'<br>';
         if(file_exists(FCPATH.'uploads/store/category/'.$data[0]->c_img))
         {
        		unlink(FCPATH.'uploads/store/category/'.$data[0]->c_img);
         }

		$this->db->where('c_name', $c_id);
		$this->db->where('tenant_id', TENENT_ID);
		$this->db->delete('whd_category');

	}
	function return_update_record($c_id)
	{

		$this->db->where('tenant_id', TENENT_ID);
		$this->db->where('c_name', $c_id);
		$data=$this->db->get('whd_category');
		return $data->result();

	}
	function update($c_id,$data)
	{
		
		$this->db->where('tenant_id', TENENT_ID);
		$this->db->where('c_name', $c_id);
		$this->db->where('addproduct','');
		$d=$this->db->get('whd_category');
		$d=$d->result();
       if($data['addproduct']=='')
		{
			$this->db->where('tenant_id', TENENT_ID);
			$this->db->where('c_name',$c_id);
			//$this->db->where('pid', $pid);
			$this->db->update('whd_category',$data);

		}
		else
		{
			
			$data['c_img']=$d[0]->c_img;
			$this->db->insert("whd_category",$data);
		}


	}
	function category_add($data)
	{

		$this->db->insert("whd_category",$data);
	}
	function category_details()
	{

		$this->db->where('tenant_id',TENENT_ID);
		$this->db->distinct();
		$this->db->select('c_name');
		$this->db->select('c_description');
		$this->db->select('c_img');
		$data=$this->db->get("whd_category");
		return $data->result();
	}
	function products_details()
	{
			
		$data=$this->db->get('whd_products');
		return $data->result();
	}
	function removeproducts($c_id)
	{
		
		$this->db->where('tenant_id',TENENT_ID);
		$this->db->where('c_name',$c_id);
		$this->db->where('addproduct !=','');
		$this->db->delete('whd_category');

	}
	
}
?>
