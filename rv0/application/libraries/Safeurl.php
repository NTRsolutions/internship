<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Safeurl {  
    
     protected $_ci; // Protected Ci instance for later use
     public function __construct() {
        $this->_ci =& get_instance();
        $this->_ci->load->library('encrypt');
    }
    
    public function doEncrypt1($str)
    {
        $data=$this->_ci->encrypt->encode($str);
        return str_replace(array('+', '/', '='), array('-', '_', '~'), $data);
    }
    public function doDecrypt1($str)
    {
        $data=str_replace(array('-', '_', '~'), array('+', '/', '='), $str);
        return $this->_ci->encrypt->decode($data);
    }
}

