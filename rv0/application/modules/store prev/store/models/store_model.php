<?php
class Store_model extends CI_Model {

	function __construct()
        {
             parent::__construct();
             $this->load->database();
        }
        function getproducts()
        {
        	
        	$data=$this->db->get('whd_products');
        	$dataa=$data->result();
        	return $dataa;
        	

        }
        function getcategory($ctg)
        {

            $this->db->where('p_category',$ctg);
            $data=$this->db->get('whd_products');
            $dataa=$data->result();
            return $dataa;
        }
        function return_product($pid)
        {
            $this->db->where('pid', $pid);
            $data=$this->db->get('whd_products');
            return $data->result();
        }
        function insert_cartdetails($data)
        {
           
            $this->db->where('session_id',$data['session_id']);
            $this->db->where('user_id',$data['user_id']);
            $this->db->where('pid',$data['pid']);
            $p=$this->db->get('whd_cart');
            $p=$p->result();
           
            

            if(count($p)!=0)
            {
               
                $q=$data['quantity']+$p[0]->quantity;
                $this->db->set('quantity', $q);
                $this->db->where('session_id',$data['session_id']);
                $this->db->where('user_id',$data['user_id']);
                $this->db->where('pid',$data['pid']);
                $this->db->update('whd_cart');

                
            }
            else
            {

                $this->db->insert('whd_cart',$data);
            }
        }
        function getcart_products($cart_products)
        {
            $pids=array();
            /*foreach ($cart_products as $key => $value) {
                $pids[]=$value['pid'];
            }*/
            foreach ($cart_products as $key => $value) {
                $pids[]=$value->pid;
            }
           $this->db->where_in('pid',$pids);
            $data = $this->db->get('whd_products');
            return $data->result();

        }
        
        
    function remove_from_cart($user_id,$session_id,$pid)
    {
        if($user_id!='')
        {
            $this->db->where('user_id', $user_id);
           $this->db->where('pid', $pid);
           $this->db->delete('whd_cart');
        }
        else
        {
           $this->db->where('session_id', $session_id);
           $this->db->where('pid', $pid);
           $this->db->delete('whd_cart');
        }
    }
    function getcart($session_id,$user_id)
    {
        
        if($user_id!='')
        {

            $this->db->select('pid');
            $this->db->select('quantity');
            $this->db->where('user_id',$user_id);
            $data=$this->db->get('whd_cart');
            
            return $data->result();
        }
        else
        {   

            $this->db->where('session_id',$session_id);
            $data=$this->db->get('whd_cart');
            return $data->result();
        }
          
    }
    function getstandardproduct()
    {
        $this->db->where('p_category','Standard_Products');
        $data=$this->db->get('whd_products');
        $data=$data->result();
        return $data[0]->pid;
    }
  function cartlogo($data)
    {
          $this->db->where('session_id',$data['session_id']);
            $this->db->where('user_id',$data['user_id']);
            $this->db->where('pid',$data['pid']);
            $p=$this->db->get('whd_cart');
            $p=$p->result();
           
            

            if(count($p)!=0)
            {
               
                
                $this->db->set('cartlogo', $data['cartlogo']);
                $this->db->where('session_id',$data['session_id']);
                $this->db->where('user_id',$data['user_id']);
                $this->db->where('pid',$data['pid']);
                $this->db->update('whd_cart');
                
                
            }
            else
            {
                
                $this->db->insert('whd_cart',$data);
            }
     }

     function getcustom($session_id,$user_id,$pid)
    {
        

        if($user_id!='')
        {
            $this->db->select('cartlogo', $data);
            $this->db->where('user_id',$user_id);
            $this->db->where('pid',$pid);
            $customimg=$this->db->get('whd_cart');
            $this->db->where('pid',$pid);
            $data=$this->db->get('whd_products');
            $data=$data->result();
            $data[0]->img=$customimg;
            return $data;
        }
        else
        {   
            $this->db->select('cartlogo', $data);
            $this->db->where('session_id',$session_id);
            $this->db->where('pid',$pid);
            $customimg=$this->db->get('whd_cart');
            $customimg=$customimg->result();

            //$this->db->where('pid',$pid);
            //$data=$this->db->get('whd_products');
            //$data=$data->result();
            return $customimg[0]->cartlogo;
            
        }
          
    }

}
?>
