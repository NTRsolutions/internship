<?php
class Product extends MX_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("product_model");
        $this->load->helper(array('form', 'url'));
        
    }
  
   public function index()
    {
        $d['data']=$this->product_model->getproduct();
        $this->load->view("product_viewproduct",$d);
    }
    public function addproduct()
    {
        $d['data']=$this->product_model->category();   
        $this->load->view("product_addproduct",$d);

    }
    public function search()
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
         $d['category']=$this->product_model->category();  
         $this->load->view("product_editproduct",$d);

    }
    public function do_update($pid)
    {
        
                //$pid=$this->input->post('pid');
                $p_name=$this->input->post('p_name');
                $category=$this->input->post('Category');
                $discription=$this->input->post('discription');
                $o_price=$this->input->post('o_price');
                $r_price=$this->input->post('r_price');
                $s_price=$this->input->post('s_price');
               
        
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
                }
               
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
               
                $data=array('p_name' => $p_name,'discription'=> $discription,'p_category'=>$category,'o_price'=>$o_price,'r_price'=>$r_price,'s_price'=>$s_price);
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
                
    }

    public function do_upload()
        {
                //$pid=$this->input->post('pid');
                $p_name=$this->input->post('p_name');
                $discription=$this->input->post('discription');
                $category=$this->input->post('Category');
                $o_price=$this->input->post('o_price');
                $r_price=$this->input->post('r_price');
                $s_price=$this->input->post('s_price');
                $qty=$this->input->post('qty');
                
        
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
                                    
                 $data=array('p_name' => $p_name,'discription'=> $discription,'o_price'=>$o_price,'r_price'=>$r_price,'s_price'=>$s_price,'img'=>$img['main'],'rightview'=>$img['r_view'],'leftview'=>$img['l_view'],'topview'=>$img['t_view'],'bottomview'=>$img['b_view'],'p_category'=>$category,'tenant_id'=>TENENT_ID,'quantity'=>$qty);
                 $d["data"]=$data;
                 
                 $this->product_model->addproduct($data);
                 $this->load->view('product_uploadsuccess',$d);
                }
                       

                
        }
    


    

}
?>
