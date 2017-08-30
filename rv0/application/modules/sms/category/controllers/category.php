<?php
class Category extends MX_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("category_model");
        $this->load->helper(array('form', 'url'));
        
    }
  
    function index()
    {

            $data['data']=$this->category_model->category_details(); 
            $this->load->view('category_viewprouct',$data);
    }

    public function category_search()
    {

         $search=  $this->input->post('search');
        
          $d['data'] = $this->category_model->getproducts_onkey($search);
          $this->load->view("category_search",$d);

    }
    public function category_delete($c_id)
    {

         $this->category_model->delete_record($c_id);
         $d['data']=$this->category_model->category_details();
        $this->load->view("category_viewprouct",$d);

    }
    public function category_edit($c_id)
    {

         $data['products']=$this->category_model->products_details(); 
         $data['data']=$this->category_model->return_update_record($c_id);
         
         $this->load->view("category_editproduct",$data);

    }
  
        function product_category()
        {
            $data['products']=$this->category_model->products_details(); 
            $this->load->view('create_category',$data);
        }
        function pcategory_insert()
        {
           

            $c_name=$this->input->post('c_name');
            $discription=$this->input->post('discription');
            $addpro=$this->input->post('product');
           // $paren_type=$this->input->post('type');
            $config['upload_path']          = './uploads/store/category/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
                $f=0;
                $img='';
                $data=array();
                if (  $this->upload->do_upload('img'))
                {
                    
                        
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $image=$this->upload->data('file_name'); 
                        $img=$image['file_name'];
                        $f=1;                         

                }
                if($f==1)
                {
                    $data=array('c_name' => $c_name,'c_description'=> $discription,'c_img'=>$img,'tenant_id'=>TENENT_ID,'addproduct'=>'');
                    $this->category_model->category_add($data);

                    foreach ($addpro as $key => $value) {
                    
                $data=array('c_name' => $c_name,'c_description'=> $discription,'c_img'=>$img,'tenant_id'=>TENENT_ID,'addproduct'=>$value);
                 $this->category_model->category_add($data);
                    $data['data']=$data;
                   
                 }
                  $this->load->view('category_uploadsuccess',$data);
                }
                else
                {
                        $error=array("error"=>"You did not select a file to upload.");

                        $this->load->view('category_uploadunsuccess', $error);
                }

        }
        function view_category()
        {

            $data['data']=$this->category_model->category_details(); 
            $this->load->view('category_viewprouct',$data);
            

        }
        function category_update($c_id)
        {

            $c_name=$this->input->post('c_name');
            $discription=$this->input->post('discription');
            $addpro=$this->input->post('product');
            $config['upload_path']          = './uploads/store/category/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
                $f=0;
                $img='';
                $data=array();
                if (  $this->upload->do_upload('img'))
                {
                    
                        
                        $imgdetails = array('upload_data' => $this->upload->data());
                        $image=$this->upload->data('file_name'); 
                        $img=$image['file_name'];
                        $data=array("pic"=>"c_img","img"=>$img,"c_id"=>$c_id);
                        $this->category_model->addsideview($data);                      

                }
                 $this->category_model->removeproducts($c_id);
                 $data=array('c_name' => $c_name,'c_description'=> $discription,'tenant_id'=>TENENT_ID,'addproduct'=>'');
                 $this->category_model->update($c_id,$data);
                 foreach ($addpro as $key => $value) {
                    
                    
                $data=array('c_name' => $c_name,'c_description'=> $discription,'tenant_id'=>TENENT_ID,'addproduct'=>$value);

                   $this->category_model->update($c_id,$data);

                    $data['data']=$data;
                }
                    $this->load->view('category_uploadsuccess',$data);
                
        } 

}
?>
