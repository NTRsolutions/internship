<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends MX_Controller
{

	public function index()
	{
		$dir='uploads/sms/'.TENENT_ID.'/';
		if (!file_exists($dir))
		{
            mkdir($dir, 0777, true);
        }
		$data['filenames']=get_dir_file_info('uploads/sms/'.TENENT_ID.'/',TRUE);

		//print_r($data);exit;
		$this->load->view('sms_main',$data);
	}
	public function create_class()
	{	
	   	
		$name=$this->input->post('class');
		$dir='uploads/sms/'.TENENT_ID.'/'.$name.'/';

		if (!file_exists($dir))
		{
           mkdir($dir, 0777, true);
        }

		$data['filenames']=get_dir_file_info('uploads/sms/'.TENENT_ID.'/',TRUE);

		
		$this->load->view('sms_main',$data);
	}
	public function create_section($uploads,$sms,$tenent,$class)
	{	

		$name=$this->input->post('section');
		//echo $section;exit;
		$dir=$uploads.'/'.$sms.'/'.$tenent.'/'.$class.'/'.$name.'/';
		
		if (!file_exists($dir))
		{
           mkdir($dir, 0777, true);
        }
        

		$data['filenames']=get_dir_file_info($uploads.'/'.$sms.'/'.$tenent.'/'.$class,TRUE);
		
		$data['parent']=$class;
		$this->load->view('sms_sub',$data);
	}


	public function open($parent,$filename,$tenent,$class)
	{

		$data['filenames']=get_dir_file_info($parent.'/'.$filename.'/'.$tenent.'/'.$class,TRUE);

		$data['parent']=$class;
		//print_r($data);echo $class;exit;

		$this->load->view('sms_sub',$data);
	}
	public function open_section($parent,$filename,$tenent,$class,$section)
	{

		$data['filenames']=get_dir_file_info($parent.'/'.$filename.'/'.$tenent.'/'.$class.'/'.$section,TRUE);

		$data['path']=$parent.'/'.$filename.'/'.$tenent.'/'.$class.'/'.$section;
         $this->load->view('sms_csv',$data);
		
	}
	public function data()
 	{

 	   	    
 	    $path=$this->input->post('path');

        $config['upload_path'] = $path;
        $config['allowed_types']= '*';
                
        $this->load->library('upload', $config);

        if( $this->upload->do_upload('file'))
        {
                    
             $data = array('upload_data' => $this->upload->data());
             $uname=$data['upload_data']['file_name'];
             //echo $uname;exit;
             $this->load->model('sms_model');
             
 	   	     $this->sms_model->insert($uname);

 	   	     $data['filenames']=get_dir_file_info($path,TRUE);
 	   	     $data['path']=$path;
             $this->load->view('sms_csv',$data);
        }
        else
        {
        	if ( ! $this->upload->do_upload('file'))
                {
                        echo $this->upload->display_errors();exit;
                }
        }
 
    }
 	public function show($name)
 	{

 	   	   $this->load->model('sms_model');
 	   	               
 	   	   $data['user']=$this->sms_model->display($name);

 	   	   //print_r($data);exit;

 	   	   $this->load->view('sms_table',$data);
 	}
 	//
 	public function approve_template()
	{
		$this->load->view('sms_template');
	}
	public function selectclass()
	{
		
		 $val=$this->input->post('val');
		 	
		 $this->load->model('sms_model');
		 $classes=$this->sms_model->getclasses();
		
		 
		 
		 echo '<option value="" selected="selected">Select class</option>';
                 foreach($classes as $c){

               echo '<option value="'.$c->class.'">'.$c->class.'</option>';
              }
		
            
      exit;
    
	}
	public function section()
	{
		 $class=$this->input->post('class');
                 //echo  '<option value="">'.$class.'</option>';
                 // echo '<option value="class"selected="selected">Class</option>';
		 $this->load->model('drop_model');
		 $usr=$this->drop_model->section1($class);
		
		echo "<option>hi</option><option>hii</option><option>hiii</option><option>hiii</option>";
		
		  
		 
      
    
	}
	public function selectsection()
	{
		
		$class=$this->input->post('class');

		$this->load->model('sms_model');
		 $sections=$this->sms_model->getsection($class);
		
		//print_r($sections);exit;
		 
		//echo '<option value="" selected="selected">Select class</option>';
                 foreach($sections as $a =>$c){
                 	echo '<option value="'.$c->section.'">'.$c->class.' '.$c->section.'</option>';
              // echo '<option value="'.$c->section.'">'.$c->section.''.$c->class.'</option>';
                 	//echo $c->section.' '.$c->class.' ';
              }
		exit;
            
     
    
	}
	public function store()
    {
        $student=$this->input->post('selectcsv');

       if($student=='Select_Specfic_class')
       {
        $this->load->model('sms_model');
    	$date=$this->input->post('date');
    	$time=$this->input->post('time');
    	$name=$this->input->post('name');
    	$csv=$this->input->post('selectcsv');
    	$class=$this->input->post('cla');
    	$section=$this->input->post('section');
    	$content=$this->input->post('content');

        $count=count($section);

       	//echo $csv.' ';print_r($class);exit;
    	
    	 $data=array('date'=>$date,
    		        'time'=>$time,
                    'csv'=>$csv,
                    'name'=>$name,
                    'class'=>$class,
                    'section'=>$section,
                    'content'=>$content);

    	
		$this->sms_model->db_insert($data);

       
       $this->load->view('sms_template');
     }
     elseif($student=='AllStudents')
     {
             $this->load->model('sms_model');
             $this->sms_model->all();
             $this->load->view('sms_template');
            
     }

  }
	/*public function selectstudent()
	{
		
		$sections=$this->input->post('sections');
		$this->load->model('sms_model');
		 $students=$this->sms_model->getstudents($sections);
		
		//print_r($sections);
		 
		echo '<option value="" selected="selected">Select all</option>';
                 foreach($students as $a =>$c){
                 	echo '<option value="'.$c->student.'">'.$c->student.'</option>';
              // echo '<option value="'.$c->section.'">'.$c->section.''.$c->class.'</option>';
              }
		
            
      exit;
    
	}*/
}

?>