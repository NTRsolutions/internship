<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sms_model extends CI_Model
{

	function __constuct()
	{
		parent::__constuct();
	}

    public function insert($uname)
    { 

           
           $format=explode('.',$_FILES['file']['name']);
		           $count=0;
       
                   $fp = fopen($_FILES['file']['tmp_name'],'r') or die("can't open file");

                   while($csv_line = fgetcsv($fp))
                   {
                           $count++;
                           if($count == 1)
                           {
                                continue;
                           }

                           for($i = 0, $j = count($csv_line); $i < $j; $i++)
                           {
                                 $insert_csv = array();

                                 $insert_csv['name'] = $csv_line[0];
                                 $insert_csv['rollno'] = $csv_line[1];
                                 $insert_csv['class'] = $csv_line[2];
                                 $insert_csv['section'] = $csv_line[3];
                                 $insert_csv['fathername'] = $csv_line[4];
                                 $insert_csv['mothername'] = $csv_line[5];
                                 $insert_csv['fatherno'] = $csv_line[6];
                                 $insert_csv['motherno'] = $csv_line[7];

                                 if(!empty($insert_csv['name']))
                                 {
                                    
                                    $insert_csv['name'] = $csv_line[0];

                                 }
                                 else
                                 {
                                    
                                    $insert_csv['name']=0;
                                 }
                                 if(!empty($insert_csv['rollno']))
                                 {
                                    
                                    $insert_csv['rollno'] = $csv_line[1];

                                 }
                                 else
                                 {
                                    
                                    $insert_csv['rollno']=0;
                                 }


                                 if(!empty($insert_csv['class']))
                                 {
                                    
                                    $insert_csv['class'] = $csv_line[2];
                                 }
                                else
                                 {
                                    
                                    $insert_csv['class']=0;
                                 }

                                if(!empty($insert_csv['section']))
                                {
                                    
                                    $insert_csv['section'] = $csv_line[3];
                                }
                                else
                                {
                                   
                                    $insert_csv['section']=0;
                                }

                                if(!empty($insert_csv['fathername']))
                                {
                                    
                                    $insert_csv['fathername'] = $csv_line[4];
                                }
                                else
                                {
                                    
                                    $insert_csv['fathername']=0;
                                }
                                if(!empty($insert_csv['mothername']))
                                {
                                    
                                    $insert_csv['mothername'] = $csv_line[5];
                                }
                                else
                                {
                                    
                                    $insert_csv['mothername']=0;
                                }
                                if(!empty($insert_csv['fatherno']))
                                {
                                    
                                    $insert_csv['fatherno'] = $csv_line[6];
                                }
                                else
                                {
                                    
                                    $insert_csv['fatherno']=0;
                                }
                                if(!empty($insert_csv['motherno']))
                                {
                                    
                                    $insert_csv['motherno'] = $csv_line[7];
                                }
                                else
                                {
                                    
                                    $insert_csv['motherno']=0;
                                }

                            }
             
                            $data = array(
                            'csvname'=>$uname,
                            'name' => $insert_csv['name'] ,
                            'rollno' => $insert_csv['rollno'] ,
                            'class' => $insert_csv['class'],
                            'section' => $insert_csv['section'],
                            'fathername'=>$insert_csv['fathername'],
                            'mothername'=>$insert_csv['mothername'],
                            'fatherno'=>$insert_csv['fatherno'],
                            'motherno'=>$insert_csv['motherno'],
                            'tenent_id'=>TENENT_ID);

                            $data=$this->db->insert('whd_sms_mylist', $data);
                    }

                    fclose($fp) or die("can't close file");
                    
           
    }
    function getclasses()
    {
        $this->db->distinct();
        $this->db->select('class');
        $this->db->where('tenent_id',TENENT_ID);
        $d=$this->db->get('whd_sms_mylist');
        return $d->result();
    }
    function getsection($class)
    {
        
        $this->db->select('section');
        $this->db->select('class');
        $this->db->distinct('section','class');
        $this->db->where_in('class',$class);
        $this->db->where('tenent_id',TENENT_ID);
        $d=$this->db->get('whd_sms_mylist');

        return $d->result();
    }
    function getstudents($sections)
    {
        
        $this->db->distinct('section','class');
        $this->db->where_in('class',$class);
        $this->db->where('tenent_id',TENENT_ID);
        $d=$this->db->get('whd_sms_mylist');
        return $d->result();
    }

    public function display($name)
    {
          //echo $name;

          $this->db->where('csvname',$name);
           $this->db->where('tenent_id',TENENT_ID);
        $res=$this->db->get('whd_sms_mylist');
        return $res->result();

          
    }
    public function db_insert($data)
    {
        
        $this->db->insert('whd_approve_template',$data);

    }
    public function all()
    {

        $date=$this->input->post('date');
        $time=$this->input->post('time');
        $name=$this->input->post('name');
        $csv=$this->input->post('selectcsv');
        $content=$this->input->post('content');
         
        $this->db->select('class');
        $this->db->distinct();
        $this->db->where('tenent_id',TENENT_ID);
        $res=$this->db->get('whd_sms_mylist');
        $class=$res->result();
        //$count=count($res);

        foreach($class as $c)
        {
             
             $this->db->select('section');
             $this->db->where('class',$c->class);
             $this->db->where('tenent_id',TENENT_ID);
             $sec=$this->db->get('whd_sms_mylist');
             $section=$sec->result();
             //$count1=count($res);

             foreach($section as $s)
             {

                  $data=array('date'=>$date,
                    'time'=>$time,
                    'csv'=>$csv,
                    'name'=>$name,
                    'class'=>$c->class,
                    'section'=>$s->section,
                    'content'=>$content);

                    $this->db->insert('whd_approve_template',$data);

            }
        }


    }
}