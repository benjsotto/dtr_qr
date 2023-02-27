<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Validate_Session
{
    public function __construct()
    {
        $this->load->library('authenticate');
    }

    public function __get($property)
    {
        if ( ! property_exists(get_instance(), $property))
        {
                show_error('property: <strong>' .$property . '</strong> not exist.');
        }
        return get_instance()->$property;
    }

    public function validate()
    {
        if ( ! $this->authenticate->isSessionExists())
        {
                //redirect in login
            //echo "Invalid Session";
            //exit;
            if($this->uri->segment(1)!='login'){
                redirect('login','refresh');
            }
        }else{
            /*$loginUserData = $this->authenticate->isSessionExists();
            echo $loginUserData;
            exit;
             * 
             */
        }
    }
}