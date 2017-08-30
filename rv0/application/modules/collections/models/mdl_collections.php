<?php
class Mdl_collections extends CI_Model {

	function __construct()
    {
          parent::__construct();
          $this->load->database();
    }
    function getproducts($key)
	{	
			$this->db->where('tenant_id',TENENT_ID);
			//$this->db->where("p_name LIKE '%$key%'");
			$data=$this->db->get("whd_products");
			return $data->result();
		
	}
	function addcollection($data)
	{
		$this->db->insert("whd_collections",$data);
	
	}
	function getcollections($start,$limit)
	{	
		
		$this->db->where('tenant_id',TENENT_ID);
		$this->db->distinct();
		$this->db->select('name');
		$this->db->select('description');
		$this->db->select('img');
		$this->db->select('price');
		$data=$this->db->get("whd_collections",$start,$limit);
		return $data->result();
	}
	function dist()
	{	
		
		$this->db->where('tenant_id',TENENT_ID);
		$this->db->distinct();
		$this->db->select('name');
		$this->db->select('description');
		$this->db->select('img');
		$this->db->select('price');
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
	function order_price($start,$limit)
	{
		    $this->db->where('tenant_id',TENENT_ID);
		    $this->db->order_by("price", "asc");
		    $this->db->distinct();
		    $this->db->select('name');
		    $this->db->select('description');
		    $this->db->select('img');
		    $this->db->select('price');
		    $data=$this->db->get("whd_collections",$start,$limit);
			return $data->result();
        /*$this->db->order_by("price", "asc");
        $query = $this->db->get('whd_collections',$start,$limit);
        return $query->result();*/
	}
	function order_alphabetic($start,$limit)
	{
		    $this->db->where('tenant_id',TENENT_ID);
		    $this->db->order_by("name", "asc");
		    $this->db->distinct();
		    $this->db->select('name');
		    $this->db->select('description');
		    $this->db->select('img');
		    $this->db->select('price');
		    $data=$this->db->get("whd_collections",$start,$limit);
			return $data->result();

		/*$this->db->select("*");
        $this->db->order_by("name", "asc");
        $query = $this->db->get('whd_collections',$start,$limit);
        return $query->result();*/
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
		$this->db->where('name',$data['name']);
		$this->db->where('pid','');
		$d=$this->db->get('whd_collections');
		$d=$d->result();

		//echo $d[0]->pid;print_r($d);echo count($d);exit;*/
		if($data['pid']=='')
		{
			$this->db->where('tenant_id', TENENT_ID);
			$this->db->where('name',$oldname);
			//$this->db->where('pid', $pid);
			$this->db->update('whd_collections',$data);

		}
		else
		{
			$data['img']=$d[0]->img;
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
	function getcollection_onkey($key,$start,$limit)
	{
		if($key=="")
		{	
			$this->db->where('tenant_id',TENENT_ID);
		    $this->db->distinct();
		    $this->db->select('name');
		    $this->db->select('description');
		    $this->db->select('img');
		    $this->db->select('price');
		    $data=$this->db->get("whd_collections",$start,$limit);
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
		$this->db->select('price');
		$data=$this->db->get("whd_collections",$start,$limit);
			return $data->result();
		}


	}
	function onkey($key)
	{
		if($key=="")
		{	
			$this->db->where('tenant_id', TENENT_ID);
			$this->db->distinct();
		    $this->db->select('name');
		    $this->db->select('description');
		    $this->db->select('img');
		    $this->db->select('price');
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
		    $this->db->select('price');
		    $data=$this->db->get("whd_collections");
			return $data->result();
		}


	}
	function removeproducts($oldname)
	{
		$this->db->where('tenant_id',TENENT_ID);
		$this->db->where('name',$oldname);
		$this->db->where('pid !=','');
		$this->db->delete('collections');

	}
}
?>
