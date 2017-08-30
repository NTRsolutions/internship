<?php
class Mdl_store extends CI_Model {

	function __construct()
        {
             parent::__construct();
             $this->load->database();
        }
        function getproducts()
        {
        	$this->db->where('tenant_id',TENENT_ID);
            $this->db->where('quantity >',0);
        	$data=$this->db->get('whd_products');
        	$dataa=$data->result();
        	return $dataa;
        	

        }
        function getcategory($ctg)
        {

            $this->db->where('p_category',$ctg);
            $this->db->where('tenant_id',TENENT_ID);
            $data=$this->db->get('whd_products');
            $dataa=$data->result();
            return $dataa;
        }
        function return_product($pid)
        {
            $this->db->where('pid', $pid);
            $this->db->where('tenant_id',TENENT_ID);
            $data=$this->db->get('whd_products');
            return $data->result();
        }
        function insert_cartdetails($data)
        {
          
            $this->db->where('session_id',$data['session_id']);
            $this->db->where('user_id',$data['user_id']);
            $this->db->where('pid',$data['pid']);
            $this->db->where('tenant_id',TENENT_ID);
            $p=$this->db->get('whd_cart');
            $p=$p->result();
           lo;
            

            if(count($p)!=0)
            {
               
                $q=$data['quantity']+$p[0]->quantity;
                $this->db->set('quantity', $q);
                $this->db->where('session_id',$data['session_id']);
                $this->db->where('user_id',$data['user_id']);
                $this->db->where('pid',$data['pid']);
                $this->db->where('tenant_id',TENENT_ID);
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
                if($value->quantity!='')
                $pids[]=$value->pid;
            }
            $this->db->where('tenant_id',TENENT_ID);
           $this->db->where_in('pid',$pids);
            $data = $this->db->get('whd_products');
            return $data->result();

        }
        

        
        
    function remove_from_cart($user_id,$session_id,$pid)
    {
        if($user_id!='')
        {
           $this->db->where('tenant_id',TENENT_ID);
           $this->db->where('user_id', $user_id);
           $this->db->where('pid', $pid);
           $d=$this->db->get('whd_cart');
           $d=$d->result();
           $this->db->where('tenant_id',TENENT_ID);
           $this->db->where('pid', $pid);
           $p=$this->db->get('whd_products');
           $p=$p->result();
           $q=$p[0]->quantity+$d[0]->quantity;
           $this->db->set('quantity',$q);
            $this->db->where('tenant_id',TENENT_ID);
            $this->db->where('pid',$pid);
            $this->db->update('whd_products');

           $this->db->where('user_id', $user_id);
           $this->db->where('pid', $pid);
           $this->db->where('tenant_id',TENENT_ID);
           $this->db->delete('whd_cart');

        }
        else
        {
           $this->db->where('tenant_id',TENENT_ID);
           $this->db->where('session_id', $session_id);
           $this->db->where('pid', $pid);
           $d=$this->db->get('whd_cart');
           $d=$d->result();
           $this->db->where('tenant_id',TENENT_ID);
           $this->db->where('pid', $pid);
           $p=$this->db->get('whd_products');
           $p=$p->result();
           $q=$p[0]->quantity+$d[0]->quantity;
           $this->db->set('quantity',$q);
            $this->db->where('tenant_id',TENENT_ID);
            $this->db->where('pid',$pid);
            $this->db->update('whd_products');
           $this->db->where('session_id', $session_id);
           $this->db->where('pid', $pid);
           $this->db->where('tenant_id',TENENT_ID);
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
            $this->db->where('tenant_id',TENENT_ID);
            $data=$this->db->get('whd_cart');
            
            return $data->result();
        }
        else
        {   

            $this->db->where('session_id',$session_id);
            $this->db->where('tenant_id',TENENT_ID);
            $data=$this->db->get('whd_cart');
            return $data->result();
        }
          
    }
    function getstandardproducts()
    {
        $this->db->where('tenant_id',TENENT_ID);
        $this->db->distinct();
        $this->db->select('name');
        $this->db->select('description');
        $this->db->select('img');
        $this->db->select('price');
        $this->db->select('offerprice');
        $data=$this->db->get('whd_collections');
        $data=$data->result();
        return $data;
    }
    function cartlogo($data)
    {
          $this->db->where('session_id',$data['session_id']);
          $this->db->where('tenant_id',TENENT_ID);
            $this->db->where('user_id',$data['user_id']);
            $this->db->where('pid',$data['pid']);
            $p=$this->db->get('whd_cart');
            $p=$p->result();
           
            

            if(count($p)!=0)
            {
               
                
                $this->db->set('cartlogo', $data['cartlogo']);
                $this->db->where('session_id',$data['session_id']);
                $this->db->where('tenant_id',TENENT_ID);
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
            $this->db->where('tenant_id',TENENT_ID);
            $customimg=$this->db->get('whd_cart');
            /*$this->db->where('pid',$pid);
            $data=$this->db->get('whd_products');
            $data=$data->result();
            $data[0]->img=$customimg;
            return $data;*/
            $customimg=$customimg->result();
            return $customimg[0]->cartlogo;
        }
        else
        {   

            $this->db->select('cartlogo', $data);
            $this->db->where('session_id',$session_id);
            $this->db->where('tenant_id',TENENT_ID);
            $this->db->where('pid',$pid);
            $customimg=$this->db->get('whd_cart');
            $customimg=$customimg->result();

            //$this->db->where('pid',$pid);
            //$data=$this->db->get('whd_products');
            //$data=$data->result();
            return $customimg[0]->cartlogo;
            
        }
          
    }
    function stock_details($pid,$quantity)
    {

        $this->db->where('tenant_id',TENENT_ID);
        $this->db->where('pid',$pid);
        $d=$this->db->get('whd_products');
        $d=$d->result();
        $d[0]->quantity-=$quantity;
        if($d[0]->quantity<10)
        {
            $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'ganesh.kanthiwar@gmail.com',
            'smtp_pass' => 'gani.123',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            $this->email->from('ganesh.kanthiwar@gmail.com', 'Ganesh');
            $this->email->to('dearsikandarkhan@gmail.com');

            $this->email->subject('Stock Notification');
            $this->email->message('Product Name : '.$d[0]->p_name.'\n'.' quantity '.$d[0]->quantity);

            // $this->email->send();
            //$this->email->print_debugger(array('headers'));
        }
        $this->db->set('quantity',$d[0]->quantity);
        $this->db->where('tenant_id',TENENT_ID);
        $this->db->where('pid',$pid);
        $this->db->update('whd_products');
        echo $d[0]->quantity;exit;

    }
    function getcollection($name)
    {
         $this->db->where('tenant_id',TENENT_ID);
         $this->db->where('name',$name);
        
        $this->db->select('name');
        $this->db->select('description');
        $this->db->select('img');
        $this->db->select('pid');
        $this->db->select('quantity');
        $this->db->select('price');
        $this->db->select('offerprice');
        $data=$this->db->get('whd_collections');
        $data=$data->result();
        return $data;
    }
    function get_c_products($p)
    {
         $this->db->where('tenant_id',TENENT_ID);
         $this->db->where_in('pid',$p);
         $data=$this->db->get('whd_products');
         $data=$data->result();
        return $data;

    }
    function update_cart($pid,$q)
    {
        $this->db->where('tenant_id',TENENT_ID);
        $this->db->where('pid',$pid);
        $data=$this->db->get('whd_products');
        $data=$data->result();
        $this->db->where('tenant_id',TENENT_ID);
        $this->db->where('pid',$pid);
        $cart_p=$this->db->get('whd_cart');
        $cart_prod_q=$cart_p->result();
        $old_q=$cart_prod_q[0]->quantity;
        if($data[0]->quantity+$old_q>$q)
        {
            $this->db->set('quantity',$q);
            $this->db->where('tenant_id',TENENT_ID);
            $this->db->where('pid',$pid);
            $this->db->update('whd_cart');
            $this->db->set('quantity',$data[0]->quantity+$old_q-$q);
            $this->db->where('tenant_id',TENENT_ID);
            $this->db->where('pid',$pid);
            $this->db->update('whd_products');

        }
        else
        {
            echo "out of stock";
        }
    }


}
?>
