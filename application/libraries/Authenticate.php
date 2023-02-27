<?php

class Authenticate{

    var $CI;
    public function __construct()
    {
            $this->CI =& get_instance(); 
    }

    public function isSessionExists(){

        if($this->CI->session->userdata('logged_in')== TRUE){
            return TRUE;//$this->CI->session->userdata('key');
        }else{
            return false;
        }
    }
}