<?php
class Mdl_collections extends CI_Model {

	function __construct()
    {
          parent::__construct();
          $this->load->database();
    }
    function getproducts()
	{	
		$this->db->where('tenant_id',TENENT_ID);
		$data=$this->db->get("whd_products");
		return $data->result();
	}
	function addcollection($data)
	{
		$this->db->insert("whd_collections",$data);
	
	}
	function getcollections()
	{	
		
		$this->db->where('tenant_id',TENENT_ID);
		$this->db->distinct();
		$this->db->select('name');
		$this->db->select('description');
		$this->db->select('img');
		$data=$this->db->get("whd_collections");
		return $data->result();
	}
	function delete_record($name)
	{
		$this->db->where('name',$name);
		$this->db->where('tenant_id', TENENT_ID);
        $d=$this->db->get("whd_collections");
        $data=$d->result();
       // echo $data[0]->img;
       // echo FCPATH.'uploads/store/'.$data[0]->img.'<br>';
         if(file_exists(FCPATH.'uploads/collections/'.$data[0]->img))
         {
        		unlink(FCPATH.'uploads/collections/'.$data[0]->img);
         }
         

		$this->db->where('name', $name);
		$this->db->where('tenant_id', TENENT_ID);
		$this->db->delete('whd_collections');

	}
	function return_update_record($name)
	{
		$this->db->where('tenant_id', TENENT_ID);
		$this->db->where('name', $name);
		$data=$this->db->get('whd_collections');
		return $data->result();
	}
	function update($oldname,$pid,$data)
	{

		$this->db->where('tenant_id', TENENT_ID);
		$this->db->where('name',$oldname);
		$this->db->where('pid', $pid);
		$d=$this->db->get('whd_collections');
		$d->result();print_r($d->result());exit;
		if(!empty($d))
		{
			$this->db->where('tenant_id', TENENT_ID);
			$this->db->where('name',$oldname);
			$this->db->where('pid', $pid);
			$this->db->update('whd_collections',$data);

		}
		else
		{
			$this->db->insert("whd_collections",$data);
		}

	}
	function addsideview($data)
	{

		$this->db->set($data['column'], $data['img']);
		$this->db->where('tenant_id',TENENT_ID);
		$this->db->where('name', $data['name']);
		$this->db->update('whd_collections');
			

	}
	function getcollection_onkey($key)
	{
		if($key=="")
		{	
			$this->db->where('tenant_id',TENENT_ID);
		$this->db->distinct();
		$this->db->select('name');
		$this->db->select('description');
		$this->db->select('img');
		$data=$this->db->get("whd_collections");
			return $data->result();
		}
		else
		{
			
		
		$this->db->where('tenant_id',TENENT_ID);
		$this->db->where("name LIKE '%$key%'");
		$this->db->distinct();
		$this->db->select('name');
		$this->db->select('description');
		$this->db->select('img');
		$data=$this->db->get("whd_collections");
			return $data->result();
		}


	}
	function removeproducts($name)
	{
		$this->db->where('tenant_id',TENENT_ID);
		$this->db->where('name',$name);
		$this->db->delete('collections');

	}
	/*function addproduct($data)
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

	/*}
	
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


	}*/
	
}
?>
