<?php
class Collections extends MX_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("mdl_collections");
        $this->load->helper(array('form', 'url'));
        
    }
  
   public function index()
    {
        $data['data']=$this->mdl_collections->getcollections();
        $this->load->view("collections_view",$data);
    }
    public function addcollection()
    {
         $d['data']=$this->mdl_collections->getproducts();
        $this->load->view("collections_add",$d);

    }
    /*public function getproducts()
    {

        $key=$_POST['search'];

        $d['data']=$this->mdl_collections->getproducts($key);
        $this->load->view('collections_productsearch',$d);
    }*/
    public function get()
    {
        $p=$_POST('products');
        $this->mdl_collections->getproducts_onid($p);


    }
    public function do_upload()
        {
                //$pid=$this->input->post('pid');
                $c_name=$this->input->post('name');
                $description=$this->input->post('discription');
                $quantity=$this->input->post('quantity');
                $p=$this->input->post('product');
                /*foreach ($p as $key => $value) {  If products not added to collectioons then it will give error
                    $i++;
                }
                if($i==0)
                {

                                $e['msg']="Your not choosen products";
                                $e['url']="addcollection";
                                $this->load->view('collections_uploadunsuccess',$e);


                        
                }*/
                $img='';
                //img upload start
                $config['upload_path']          = './uploads/collections/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                //$config['max_size']             = 100;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;

                $this->load->library('upload', $config);


                if (  $this->upload->do_upload('img'))
                {
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $image=$this->upload->data('file_name'); 
                        $img=$image['file_name'];
                        $data=array('name'=>$c_name,'description'=>$description,'pid'=>'','img'=>$img,'tenant_id'=>TENENT_ID,'quantity'=>$quantity);
                         $this->mdl_collections->addcollection($data);
                        foreach ($p as $key => $value) {
                         $data=array('name'=>$c_name,'description'=>$description,'pid'=>$value,'img'=>$img,'tenant_id'=>TENENT_ID,'quantity'=>$quantity);
                         $this->mdl_collections->addcollection($data);
                      
                                                   } 
                        
                        $d['data']=$data;                            
                         
                         $this->load->view('collections_uploadsuccess',$d);
                }
                else
                {
                    
                    $this->load->view('collections_uploadunsuccess');
                }        
        }
        public function delete($name)
        {
         $this->mdl_collections->delete_record($name);
         $d['data']=$this->mdl_collections->getcollections();
        $this->load->view("collections_view",$d);

        }
        public function edit($name)
        {
         $d['data']=$this->mdl_collections->return_update_record($name);
         $d['products']=$this->mdl_collections->getproducts();
         $this->load->view("collections_edit",$d);

        }
        public function do_update($oldname)
        {
                //$pid=$this->input->post('pid');
                $name=$this->input->post('name');
                $description=$this->input->post('description');
                $quantity=$this->input->post('quantity');
                $p=$this->input->post('product');
                $i=0;
                /*foreach ($p as $key => $value) {
                    $i++;
                }
                if($i==0)
                {

                                $e['msg']="Your not choosen products";
                                $e['url']="edit/".$oldname;
                                $this->load->view('collections_uploadunsuccess',$e);


                        
                }
                */
                 $img='';
                
                //img upload start
                $config['upload_path']          = './uploads/collections/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';


                $this->load->library('upload', $config);
                $d=array();
                $this->mdl_collections->removeproducts($oldname);
                $data=array('name'=>$name,'description'=>$description,'pid'=>'','tenant_id'=>TENENT_ID,'quantity'=>$quantity);
                $this->mdl_collections->update($oldname,$value,$data);
                         $d['data']=$data;
                foreach ($p as $key => $value) {
                   
                         $data=array('name'=>$name,'description'=>$description,'pid'=>$value,'tenant_id'=>TENENT_ID,'quantity'=>$quantity);
                         $d['data']=$data;
                         $this->mdl_collections->update($oldname,$value,$data);
                }
                
                if (  $this->upload->do_upload('img'))
                {
                    
                        
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $image=$this->upload->data('file_name');
                        $img=$image['file_name'];
                        $d['data']['img']=$img;
                        $data=array("column"=>"img","img"=>$img,"name"=>$name); 
                         $this->mdl_collections->addsideview($data);       
                }
                $this->load->view('collections_uploadsuccess',$d);
                
    }
    public function search()
    {

         $search=  $this->input->post('search');
        
          $d['data'] = $this->mdl_collections->getcollection_onkey($search);
          
          $this->load->view("collections_search",$d);

    }
    /*public function search()
    {

         $search=  $this->input->post('search');
        
          $d['data'] = $this->product_model->getproducts_onkey($search);
          
          $this->load->view("product_searchproduct",$d);

    }
    public function delete($pid)
    {
         $this->product_model->delete_record($pid);
         $d['data']=$this->product_model->getproduct();
        $this->load->view("product_viewproduct",$d);

    }
    public function edit($pid)
    {
         $d['data']=$this->product_model->return_update_record($pid);
         $this->load->view("product_editproduct",$d);

    }
    public function do_update($pid)
    {
        
                //$pid=$this->input->post('pid');
                $p_name=$this->input->post('p_name');
                $status=$this->input->post('status');
                $category=$this->input->post('Category');
                $discription=$this->input->post('discription');
                $o_price=$this->input->post('o_price');
                $r_price=$this->input->post('r_price');
                $s_price=$this->input->post('s_price');
                $c_price=$this->input->post('c_price');
                $srp=$this->input->post('srp');
        
                $img=array();
                $img['main']='';
                $img['r_view']='';
                $img['l_view']='';
                $img['t_view']='';
                $img['b_view']='';





                //img upload start
                $config['upload_path']          = './uploads/store';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                //$config['max_size']             = 100;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;

                $this->load->library('upload', $config);
                $d=array();
//&& $this->upload->do_upload('rightview') && $this->upload->do_upload('leftview') && $this->upload->do_upload('topview') && $this->upload->do_upload('bottomview')

                if (  $this->upload->do_upload('img'))
                {
                    
                        
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $image=$this->upload->data('file_name');

                         $img['img']=$image['file_name'];
                        
                     $f=1;

                }
                
                if (  $this->upload->do_upload('rightview'))
                {
                        
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $rightview=$this->upload->data('file_name');

                         $img['rightview']=$rightview['file_name'];
                       /* $data=array("view"=>"rightview","img"=>$rightview,"pid"=>$pid);
                        
                        $this->load->model('Product_model');
                        $this->product_model->addsideview($data);*/
                /*}
               
                if (  $this->upload->do_upload('leftview'))
                {
                    
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $leftview=$this->upload->data('file_name');

                         $img['leftview']=$leftview['file_name'];
                        
                }
               
                if (  $this->upload->do_upload('topview'))
                {
                    
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $topview=$this->upload->data('file_name');

                         $img['topview']==$topview['file_name'];
                        
                }
                
                if (  $this->upload->do_upload('bottomview'))
                {
                    
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $bottomview=$this->upload->data('file_name');

                        $img['bottomview']=$bottomview['file_name'];

                }
               
                $data=array('p_name' => $p_name,'status' => $status,'discription'=> $discription,'o_price'=>$o_price,'r_price'=>$r_price,'s_price'=>$s_price,'c_price'=>$c_price,'srp'=>$srp);
                 $d["data"]=$data;
                 $this->load->model('Product_model');
                 $this->product_model->update($pid,$data);
                  foreach ($img as $key => $value) {
                    if($value!='')
                    {
                        $data=array("view"=>$key,"img"=>$value,"pid"=>$pid);
                        //print_r($data);exit;
                        $this->load->model('Product_model');
                        $this->product_model->addsideview($data);
                    }
                }
                
                 $this->load->view('product_uploadsuccess',$d);
                /*if($f==0)
                {
                        
                        
                       // $error = array('error' => $this->upload->display_errors());
                        $error=array("error"=>"You did not select a file to upload.");

                        $this->load->view('product_uploadunsuccess', $error);
                }
                else
                    $this->load->view('product_uploadsuccess',$d);*/

                //img upload end
                
                
                //img upload end
                
   /* }

    public function do_upload()
        {
                //$pid=$this->input->post('pid');
                $p_name=$this->input->post('p_name');
                $status=$this->input->post('status');
                $discription=$this->input->post('discription');
                $category=$this->input->post('Category');
                $o_price=$this->input->post('o_price');
                $r_price=$this->input->post('r_price');
                $s_price=$this->input->post('s_price');
                $c_price=$this->input->post('c_price');
                $qty=$this->input->post('qty');
                $srp=$this->input->post('srp');
        
                $img=array();
                $img['main']='';
                $img['r_view']='';
                $img['l_view']='';
                $img['t_view']='';
                $img['b_view']='';

                $f=0;
                //img upload start
                $config['upload_path']          = './uploads/store';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                //$config['max_size']             = 100;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;

                $this->load->library('upload', $config);


                if (  $this->upload->do_upload('img'))
                {
                    
                        
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $image=$this->upload->data('file_name'); 
                        $img['main']=$image['file_name'];
                        $f=1;                         

                }
                
                if (  $this->upload->do_upload('rightview'))
                {
                        
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $rightview=$this->upload->data('file_name');

                         $img['r_view']=$rightview['file_name'];
                       // $data=array("view"=>"rightview","img"=>$rightview);

                }
               
                if (  $this->upload->do_upload('leftview'))
                {
                    
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $leftview=$this->upload->data('file_name');

                         $img['l_view']=$leftview['file_name'];
    
                        //$this->load->model('Product_model');
                        //$this->product_model->addsideview($data);
                }
               
                if (  $this->upload->do_upload('topview'))
                {
                    
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $topview=$this->upload->data('file_name');

                         $img['t_view']=$topview['file_name'];
                       
                       
                }
                
                if (  $this->upload->do_upload('bottomview'))
                {
                    
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $bottomview=$this->upload->data('file_name');

                        $img['b_view']=$bottomview['file_name'];

                }
                if($f==0)
               {
                        
                        //echo "hi";exit;
                        //$error = array('error' => $this->upload->display_errors());
                        $error=array("error"=>"You did not select a file to upload.");

                        $this->load->view('product_uploadunsuccess', $error);
                }
                else
                {
                                    
                 $data=array('p_name' => $p_name,'status' => $status,'discription'=> $discription,'o_price'=>$o_price,'r_price'=>$r_price,'s_price'=>$s_price,'c_price'=>$c_price,'srp'=>$srp,'img'=>$img['main'],'rightview'=>$img['r_view'],'leftview'=>$img['l_view'],'topview'=>$img['t_view'],'bottomview'=>$img['b_view'],'p_category'=>$category,'tenant_id'=>TENENT_ID,'quantity'=>$qty);
                 $d["data"]=$data;
                 
                 $this->product_model->addproduct($data);
                 $this->load->view('product_uploadsuccess',$d);
                }
                       

                
        }
    
        */

    

}
?>
