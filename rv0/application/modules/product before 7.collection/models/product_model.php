<?php
class Product_model extends CI_Model {

	function __construct()
        {
             parent::__construct();
             $this->load->database();
        }

	function addproduct($data)
	{

		$this->db->insert("whd_products",$data);
		
		
	}
	function addsideview($data)
	{

		$this->db->set($data['view'], $data['img']);
		$this->db->where('tenant_id',TENENT_ID);
		$this->db->where('pid', $data['pid']);
		$this->db->update('whd_products');
			/*$this->db->set($data['view'], $data['img']);
			$this->db->where('pid', $data['pid']);
			$this->db->where('tenant_id',TENENT_ID);
			$this->db->update('whd_products');*/
		//$this->db->insert("whd_products");

	}
	function getproduct()
	{	
		$this->db->where('tenant_id',TENENT_ID);
		$data=$this->db->get("whd_products");
		return $data->result();



	}
	function getproducts_onkey($key)
	{
		if($key=="")
		{	
			$this->db->where('tenant_id', TENENT_ID);
			$data=$this->db->get("whd_products");
			return $data->result();
		}
		else
		{
			$data=$this->db->select('*')->from('whd_products')->where("p_name LIKE '%$key%'")->where('tenant_id', TENENT_ID)->get();
			
			return $data->result();
		}


	}
	function delete_record($pid)
	{
		$this->db->where('pid',$pid);
		$this->db->where('tenant_id', TENENT_ID);
        $d=$this->db->get("whd_products");
        $data=$d->result();
       // echo $data[0]->img;
       // echo FCPATH.'uploads/store/'.$data[0]->img.'<br>';
         if(file_exists(FCPATH.'uploads/store/'.$data[0]->img))
         {
        		unlink(FCPATH.'uploads/store/'.$data[0]->img);
         }
         if(file_exists(FCPATH.'uploads/store/'.$data[0]->rightview))
         {
        		unlink(FCPATH.'uploads/store/'.$data[0]->rightview);
         }
         if(file_exists(FCPATH.'uploads/store/'.$data[0]->leftview))
         {
        		unlink(FCPATH.'uploads/store/'.$data[0]->leftview);
         }
         if(file_exists(FCPATH.'uploads/store/'.$data[0]->topview))
         {
        		unlink(FCPATH.'uploads/store/'.$data[0]->topview);
         }
         if(file_exists(FCPATH.'uploads/store/'.$data[0]->bottomview))
         {
        		unlink(FCPATH.'uploads/store/'.$data[0]->bottomview);
         }

		$this->db->where('pid', $pid);
		$this->db->where('tenant_id', TENENT_ID);
		$this->db->delete('whd_products');

	}
	function return_update_record($pid)
	{
		$this->db->where('tenant_id', TENENT_ID);
		$this->db->where('pid', $pid);
		$data=$this->db->get('whd_products');
		return $data->result();
	}
	function update($pid,$data)
	{

		$this->db->where('tenant_id', TENENT_ID);
		$this->db->where('pid', $pid);
		$this->db->update('whd_products',$data);


	}
	
}
?>
