<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Users extends CI_Controller {

        function __construct() 
        {
                parent::__construct();
                $this->load->model('mdl_user');
                
                if($this->session->userdata('user_type_id')!=1){
                    $this->session->set_flashdata('error','You don\'t have access to Employees module.');
                    redirect('attendance','refresh');
                }
        }
        
	function index()
	{
                $data['access'] = '';//json_decode(modules::run('settings/user_types/get_class_access'));
                $this->load->view('users/users',$data);                
	}
        
        function load_users_table()
        {
                $search = trim($_POST['search']);
                $page2 = $_POST['page'];
                $limit = $_POST['limit'];
                $order_by = $_POST['order_by'];
                $sort_by = $_POST['sort_by'];
                        
		$page=1;
		if($page2!='') $page=$page2;
		$num_list=$limit;
                
		$condition="";
		if($search!=''){
			$condition="and (username like '%".($search)."%' or user_idno like '%".($search)."%' or user_type_name like '%".($search)."%' 
                                or emp_fname like '%".($search)."%' or emp_lname like '%".($search)."%' or emp_mname like '%".($search)."%' or emp_fullname like '%".mysql_real_escape_string($search)."%')";
		} else {
                }

		$event_count = $this->mdl_user->count_users($condition);
		$event_list = $this->mdl_user->get_users($condition,$page,$num_list,$order_by,$sort_by);
		
                $max_page = ($num_list!='all') ? ceil($event_count/$num_list) : 0;
		$page = ($page>$max_page) ? 1 : $page;
                
                $data['records']=$event_list;
                $data['details']= array(
                    'aa'=>($num_list*$page)-$num_list,
                    'page'=>$page,
                    'num_list'=>$num_list,
                    'event_count'=>$event_count,
                    'max_page'=>$max_page,
                    'num'=>0
                );
                
                $this->load->view('users/users_table',$data);
        }
        
	function _form($userid='',$pass_error='')
	{
                $data['user_types'] = $this->mdl_user->get_user_types();

                $data['pass_error'] = $pass_error;

                if($userid!=''){
                    $data['details'] = $this->mdl_user->get_users_details($userid);
                }
                $this->load->view('users/users_form',$data);  
	}
        
        function add()
        {
                if (!$this->mdl_user->validate_user_account()) {
                    
                        $this->_form();
                
                } else if (!$this->mdl_user->valid_password()) {
                    
                        $error = 'Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.';
                        $this->_form('',$error);
                
                } else {
                    
                        $res = $this->mdl_user->save_user_account();
                        if($res){
                            $this->session->set_flashdata('success','User account successfully saved!');
                        } else {
                            $this->session->set_flashdata('error','Error! Something went wrong while saving user account');
                        }
                        redirect('users','refresh');
                    
                }
        }
        
        function edit($userid)
        {
                if (!$this->mdl_user->validate_user_account($userid)) {
                    
                        $this->_form($userid);
                
                } else if (!$this->mdl_user->valid_password() && $this->input->post('password')) {
                    
                        $error = 'Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.';
                        $this->_form('',$error);
                
                } else {
                    
                        $res = $this->mdl_user->save_user_account($userid);
                        if($res){
                            $this->session->set_flashdata('success','User account successfully updated!');
                        } else {
                            $this->session->set_flashdata('error','Error! Something went wrong while updating user account');
                        }
                        redirect('users','refresh');
                    
                }
        }
        
        
        
        function generate_password()
        {
                $pwd = $this->mdl_user->randomPassword(10);
                echo $pwd;
	}
        
        
        
        function delete($userid)
        {
                if($userid!=$this->session->userdata('userid')){
                    $status = $this->mdl_user->delete_user_account($userid);
                    if($status==1){
                        $this->session->set_flashdata('success','User account successfully deleted!');
                    } else {
                        $this->session->set_flashdata('error','Deleting user account failed!');
                    }
                } else {
                    $this->session->set_flashdata('error','Error! You cannot delete your own account.');
                }
                redirect('users','refresh');
        }
        

}

?>