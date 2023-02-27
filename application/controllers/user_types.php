<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class User_Types extends CI_Controller {

        function __construct() 
        {
                parent::__construct();
                $this->load->model('mdl_user_type');
        }
        
	function index()
	{
                $data['access'] = json_decode(modules::run('settings/user_types/get_class_access'));
                $data['user_types'] = $this->mdl_user_type->get_user_types();
                $this->load->view('user_types/user_types',$data);                
	}
        
	function _form($user_type_id='')
	{
                $data['pages'] = $user_type_id=='' ? $this->mdl_user_type->get_pages() : $this->mdl_user_type->get_permissions($user_type_id);
                $data['landing_pages'] = $this->mdl_user_type->get_pages();
                $this->load->view('user_types/permissions',$data);  
	}
        
        function add()
        {
                if (!$this->mdl_user_type->validate_user_type()) {

                        $this->_form();
                
                } else {
                    
                        $this->mdl_user_type->add_user_type();
                        $this->session->set_flashdata('success','User Type successfully saved!');
                        redirect('settings/user_types','refresh');
                    
                }
        }
        
        function edit($user_type_id)
        {
                if (!$this->mdl_user_type->validate_user_type()) {
                    
                        $this->_form($user_type_id);    
                
                } else {
                    
                        $this->mdl_user_type->update_user_type($user_type_id);
                        $this->session->set_flashdata('success','User Type successfully saved!');
                        redirect('settings/user_types','refresh');
                    
                }
        }
        
        function get_class_access($class='',$action='')
        {
                $class = $class=='' ? $this->router->fetch_class() : $class;
                $access = $this->mdl_user_type->get_class_access($class,$action);
                echo json_encode($access);
        }
        
        function delete($user_type_id)
        {
                $users = $this->mdl_user_type->check_usertype_users($user_type_id);
                
                if(@$users){
                    
                        $this->session->set_flashdata('error','You cannot delete this user type.');
                        
                } else {
                    
                        $res = $this->mdl_user_type->delete_usertype_perma($user_type_id);
                        
                        if($res==1){
                            $this->session->set_flashdata('success','User Type successfully deleted!');
                        } else {
                            $this->session->set_flashdata('error','Deleting user type failed!');
                        }
                }
                redirect('settings/user_types','refresh');
        }

}

?>