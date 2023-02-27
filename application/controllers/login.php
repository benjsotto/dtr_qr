<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Login extends CI_Controller {
        
	function __construct()
	{
                parent::__construct();
                $this->load->model('mdl_session');
		$this->load->library('table');
		$this->load->helper(array('date', 'html'));
 	}
        
	function index()
        {
                if ($this->session->userdata('logged_in')== TRUE){
                    
                    if($this->session->userdata('user_type_id')==1){
                        redirect('employees','refresh');
                    } else {
                        redirect('attendance','refresh');
                    }
                    
                }
                
                $this->form_validation->set_rules('user_name', 'Username', 'required');
                $this->form_validation->set_rules('user_password', 'Password', 'required');

                if($this->form_validation->run() == FALSE) {
                    
                    $this->load->view('login');

                } else {

                    $validation = $this->mdl_session->login_validation();                   
                    
                    if(count($validation)>0){
                        foreach($validation as $row){
                            $user_type = $row->user_type;
                            $session_data = array (
                                    'userid' => $row->userid,
                                    'user_type_id' => $user_type,
                                    'username' => $row->user_name,
                                    'logged_in' => TRUE
                            );
                        }
                        
                        //session_start();
                        $this->session->set_userdata($session_data);
                        $this->mdl_session->save_login();

                        if($user_type==1){
                            redirect('employees','refresh');
                        } else {
                            redirect('attendance','refresh');
                        }

                    } else {
                        $userid = $this->mdl_session->userid_login_attempt();
                        if(@$userid) $this->mdl_session->save_login_attempt($userid);
                        
                        $this->session->set_flashdata('error','Incorrect username or password. Try Again.');                        
                        redirect('login', 'refresh');
                    }
                }
                        
                
                
	}
        
        function logout()
        {
                $this->mdl_session->save_logout();
                $this->session->sess_destroy();
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
                redirect('login', 'refresh');
        }
        
        
        function save_password()
        {
                $this->mdl_session->save_password($_POST['password']);

                $this->session->unset_userdata('password_expired');

                $this->session->set_userdata('password_expired', 0);
                        
                $this->session->set_flashdata('success','New Password successfully saved.');
                
        }
                
        
}
?>
