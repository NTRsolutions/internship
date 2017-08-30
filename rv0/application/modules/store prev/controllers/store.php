<?php
class Store extends MX_Controller {
	public function __construct()
        {
                parent::__construct();
                $this->load->model('Mdl_store');  
                $this->load->library("form_validation");
                $this->load->library('session');
                $this->load->helper('form','url');
                $this->load->helper('cookie');


                                  
        }
        function index()
        {
            $data=array();

           $layout_session = $this->session->userdata('logged_in');
            if(!empty(get_cookie('rightlink_cart')))
            {
                 
                $total_quantity=0;
               if($layout_session['user']['id']!='')
               {
                $session_id=get_cookie('rightlink_cart');
                $p=$this->Mdl_store->getcart($session_id,$layout_session['user']['id']);
                foreach ($p as $key => $value) 
                {
                    $total_quantity+=$value->quantity;
                }
                 $data['no_products']=$total_quantity;
               
                
               }
               else
               {
                    
                    $session_id=get_cookie('rightlink_cart');
                    $p=$this->Mdl_store->getcart($session_id,'');
                    foreach ($p as $key => $value) 
                    {
                        $total_quantity+=$value->quantity;
                    }
                    $data['no_products']=$total_quantity;   
                    
               }

               $data['product']=$this->Mdl_store->getproducts();
                
            }
            else
            {
                $session_id = $this->session->userdata('session_id');
                $cookie = array(
                  'name'   => 'rightlink_cart',
                  'value'  => $session_id,
                   'expire' => '86500',
                );
                $this->input->set_cookie($cookie);
               
               $total_quantity=0;
               if($layout_session['user']['id']!='')
               {
                $p=$this->Mdl_store->getcart('',$layout_session['user']['id']);
                foreach ($p as $key => $value) 
                {
                    $total_quantity+=$value->quantity;
                }
                 $data['no_products']=$total_quantity;
               
                
               }
                else
                {
                $data['product']=$this->Mdl_store->getproducts();
                $data['no_products']=0;
                }
            }
            
           
            $data['theme_body'] = $this->load->view('store_list',$data);
            $this->load->view('theme/gj/inner_layout', $data);
            
        }

        function store_product($pid)
        {

            $session_id = $this->session->userdata('session_id');
            $d['data']=$this->Mdl_store->return_product($pid);
            $d['product']=$this->Mdl_store->getcategory($d['data'][0]->p_category);
            $layout_session = $this->session->userdata('logged_in');
            if(!empty(get_cookie('rightlink_cart')))
            {
            $total_quantity=0;
               if($layout_session['user']['id']!='')
               {
                $session_id=get_cookie('rightlink_cart');
                $p=$this->Mdl_store->getcart($session_id,$layout_session['user']['id']);
                foreach ($p as $key => $value) 
                {
                    $total_quantity+=$value->quantity;
                }
                 $d['no_products']=$total_quantity;
               
                
               }
               else
               {
                    
                    $session_id=get_cookie('rightlink_cart');
                    $p=$this->Mdl_store->getcart($session_id,'');
                    foreach ($p as $key => $value) 
                    {
                        $total_quantity+=$value->quantity;
                    }
                    $d['no_products']=$total_quantity;   
                    
               }

               
                
            }
            else
            {
               
               $total_quantity=0;
               if($layout_session['user']['id']!='')
               {
                $p=$this->Mdl_store->getcart('',$layout_session['user']['id']);
                foreach ($p as $key => $value) 
                {
                    $total_quantity+=$value->quantity;
                }
                 $d['no_products']=$total_quantity;
               
                
               }
                else
                {
                
                $d['no_products']=0;
                }
            }

            
            
            $data['theme_body']=$this->load->view('store_product',$d);
            $this->load->view('theme/gj/inner_layout', $data);
        }
	
    public function add_to_cart() {
       
    	
        $layout_session = $this->session->userdata('logged_in');
        $session_id = $this->session->userdata('session_id');
       
        $flag=0;
        

        
        $product_id=$_POST['pid'];
        $quantity=$_POST['quantity'];
        
        if($layout_session['user']['id']!='')
        {
        		$session_id=get_cookie('rightlink_cart');
                $cart=array("session_id"=>$session_id ,"user_id"=>$layout_session['user']['id'],"pid"=>$product_id,"quantity"=>$quantity,"tenant_id"=>TENENT_ID);
               // print_r($cart);
                    $this->Mdl_store->insert_cartdetails($cart);
        }
        else
        {
        	if(!empty(get_cookie('rightlink_cart')))
        	{
        		
        		$session_id=get_cookie('rightlink_cart');
        		$cart=array("session_id"=>$session_id ,"user_id"=>'',"pid"=>$product_id,"quantity"=>$quantity,"tenant_id"=>TENENT_ID);
             
                    $this->Mdl_store->insert_cartdetails($cart);
        	}
        	else
        	{
        		
             $cart=array("session_id"=>$session_id ,"user_id"=>'',"pid"=>$product_id,"quantity"=>$quantity,"tenant_id"=>TENENT_ID);
             
                    $this->Mdl_store->insert_cartdetails($cart);
             }

        }
        
        $data= array();

                
        if(!empty(get_cookie('rightlink_cart')))
        {
        $layout_session = $this->session->userdata('logged_in');
         $total_quantity=0;
               if($layout_session['user']['id']!='')
               {
                    $session_id=get_cookie('rightlink_cart');
                    $p=$this->Mdl_store->getcart($session_id,$layout_session['user']['id']);
                    foreach ($p as $key => $value) 
                    {
                        $total_quantity+=$value->quantity;
                    }
                     $data['no_products']=$total_quantity;
                   
               }
               else
               {
                    
                    $session_id=get_cookie('rightlink_cart');
                    $p=$this->Mdl_store->getcart($session_id,'');
                    foreach ($p as $key => $value) 
                    {
                        $total_quantity+=$value->quantity;
                    }
                    $data['no_products']=$total_quantity; 

                    
               }

               
           }     
            else
            {
                
               $total_quantity=0;
               if($layout_session['user']['id']!='')
               {
                $p=$this->Mdl_store->getcart('',$layout_session['user']['id']);
                foreach ($p as $key => $value) 
                {
                    $total_quantity+=$value->quantity;
                }
                 $data['no_products']=$total_quantity;
               
               }
                else
                {
                
                $data['no_products']=0;
                }
            }

            echo $data['no_products'];

            exit;
       
        
    }
    function cart_details()
    {
        
        $f=0;
        $session_id = $this->session->userdata('session_id');
        $total_quantity=0;
        $layout_session = $this->session->userdata('logged_in');
        $data=array();
            if(!empty(get_cookie('rightlink_cart')))
            {
                if($layout_session['user']['id']!='')
                {
                    $session_id=get_cookie('rightlink_cart');
                    $p=$this->Mdl_store->getcart($session_id,$layout_session['user']['id']);
                    foreach ($p as $key => $value) {
                        $total_quantity+=$value->quantity;

                    }
                    $data['no_products']=$total_quantity;
                    if($total_quantity==0)
                    $f=1;
                   
                    else
                    {
                        $data['data']=$this->Mdl_store->getcart_products($p);
                        $data['quantity']=$p;
                        $data['theme_body']=$this->load->view('store_cartdetails',$data);
                        $this->load->view('theme/gj/inner_layout', $data);
                    }

               }
               else
               {
                    $session_id=get_cookie('rightlink_cart');
                    $p=$this->Mdl_store->getcart($session_id,'');
                    foreach ($p as $key => $value) {
                    $total_quantity+=$value->quantity;
                    }
                    $data['no_products']=$total_quantity;
                    if($total_quantity==0)
                    $f=1;
                    else
                    {
                        $data['data']=$this->Mdl_store->getcart_products($p);

                        $data['quantity']=$p;

                        $data['theme_body']=$this->load->view('store_cartdetails',$data);
                        $this->load->view('theme/gj/inner_layout', $data);
                    }
                    
               }

               
                
            }
            else
            {

               $data['data']=array();
            $data['no_products']=0; 
            $data['theme_body']=$this->load->view('store_emptycartdetails',$data);
            print_r($data);
             $this->load->view('theme/gj/inner_layout', $data);


            }
            if($f==1)
            {

               $data['data']=array();
            $data['no_products']=0; 
            $data['theme_body']=$this->load->view('store_emptycartdetails',$data);
            
             $this->load->view('theme/gj/inner_layout', $data);   
            }
             
            
    }
    function remove_from_cart($pid)
    {
      
        $session_id=get_cookie('rightlink_cart');
        $layout_session = $this->session->userdata('logged_in');
        if($layout_session['user']['id']!='')
        {
        
        $customimg=$this->Mdl_store->getcustom($session_id,$layout_session['user']['id'],$pid);

            if(file_exists(FCPATH.'uploads/store/customize/'.$customimg))
             {
                    unlink(FCPATH.'uploads/store/customize/'.$customimg);
             }
             $this->Mdl_store->remove_from_cart($layout_session['user']['id'],'',$pid);

        }
        else
        {
                
            $customimg=$this->Mdl_store->getcustom($session_id,'',$pid);
    
            if(file_exists(FCPATH.'uploads/store/customize/'.$customimg))
             {
                    unlink(FCPATH.'uploads/store/customize/'.$customimg);
             }
             $this->Mdl_store->remove_from_cart('',$session_id,$pid);
        }
        $this->cart_details();


        
    }
    function logoimage()
    {
       
    define('UPLOAD_DIR', './uploads/store/customize/');
    $img = $_POST['imgdb'];

    $pid=$_POST['pid'];
    $img = str_replace('data:image/png;base64,', '', $img);
    
    $img = str_replace(' ', '+', $img); 
    $data = base64_decode($img);
    $n=uniqid() . '.png';
    $file = UPLOAD_DIR . $n;
    $success = file_put_contents($file, $data);
    
    
    print $success ? $file : 'Unable to save the file.';
    

    $layout_session = $this->session->userdata('logged_in');
    $session_id = $this->session->userdata('session_id');
    if($layout_session['user']['id']!='')
        {
                $session_id=get_cookie('rightlink_cart');
                $cart=array("session_id"=>$session_id ,"user_id"=>$layout_session['user']['id'],"pid"=>$pid,"quantity"=>'',"tenant_id"=>TENENT_ID,"cartlogo"=>$n);
               // print_r($cart);
                    $this->Mdl_store->cartlogo($cart);
        }
        else
        {
            if(!empty(get_cookie('rightlink_cart')))
            {

                $session_id=get_cookie('rightlink_cart');
                $cart=array("session_id"=>$session_id ,"user_id"=>'',"pid"=>$pid,"quantity"=>'',"tenant_id"=>TENENT_ID,"cartlogo"=>$n);
               
                    $this->Mdl_store->cartlogo($cart);
            }
            else
            {
                
             $cart=array("session_id"=>$session_id ,"user_id"=>'',"pid"=>$pid,"quantity"=>'',"tenant_id"=>TENENT_ID,"cartlogo"=>$n);
             
                    $this->Mdl_store->cartlogo($cart);
             }

        }
    //$this->Mdl_store->cartlogo($file,$pid);
       
    }
    function pop_window($pid)
    {
        $d['data']=$this->Mdl_store->return_product($pid);
       
        $this->load->view('pop_window',$d);
    }
function standard_products()
{
    $d['collections']=$this->Mdl_store->getstandardproduct();
     $data['theme_body'] = $this->load->view("store_c_list",$d);
     $this->load->view('theme/gj/inner_layout', $data);
}

function store_custom()
 {
    $pid=$_POST['pid'];
   
    $f=0;
    
        $session_id = $this->session->userdata('session_id');
        $total_quantity=0;
        $layout_session = $this->session->userdata('logged_in');
        $data=array();
            if(!empty(get_cookie('rightlink_cart')))
            {
                if($layout_session['user']['id']!='')
                {
                    $session_id=get_cookie('rightlink_cart');
                    $p=$this->Mdl_store->getcustom($session_id,$layout_session['user']['id'],$pid);
                   

               }
               else
               {
                    
                    $session_id=get_cookie('rightlink_cart');
                    $p=$this->Mdl_store->getcustom($session_id,'',$pid);
                    echo $p;
                    exit;

                    
               }

               
            }


   // $this->load->view('store_product',$p);
    }
    function getcustom_img()
    {
        $pid=$_POST['pid'];
        $session_id = $this->session->userdata('session_id');
        $layout_session = $this->session->userdata('logged_in');
        $data=array();
            if(!empty(get_cookie('rightlink_cart')))
            {
                if($layout_session['user']['id']!='')
                {
                    $session_id=get_cookie('rightlink_cart');
                    $p=$this->Mdl_store->getcustom($session_id,$layout_session['user']['id'],$pid);
                    echo $p;
                    exit;
                    
               }
               else
               {

                    $session_id=get_cookie('rightlink_cart');
                    $p=$this->Mdl_store->getcustom($session_id,'',$pid);
                    echo $p;
                    exit;
                    
               }

               
                
            }
    

    }
     function stock()
    {
        
        $pid=$_POST['pid'];
        $quantity=$_POST['quantity'];
        $this->Mdl_store->stock_details($pid,$quantity);
    }
    function edit_quantity()
    {
        $pid=$_POST('pid');
        $c_value=$_POST('c_value');
        echo $c_value;
       $p=$this->Mdl_store->editcart($pid, $c_value);
    }


}



?>
