<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		
		if (isset($_SESSION['username']))
		{
			//user is logged in, cannot request the username or a password reset
			redirect('home');
		}
	}
		
	public function index()
	{
		$data['controller'] = 'home';
		$data['title'] = 'Forgot username or password';
		$this->load->view('view_forgot', $data);
	}
	
	public function userpass()
	{
		$this->load->model('user_model');
		$this->load->model('notification_model');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'e-mail address', 'required|valid_email');
		
		if ( $this->form_validation->run() !== false) 
		{
					
			$action = $this->input->get_post("submit");
			$email = $this->input->post('email');
			$user = $this->user_model->get_user_mail($email);
			
			if($user == FALSE)
			{
				$_SESSION['error'] = "ERROR: No user found with this e-mail address: <strong>" . $email . "</strong> !";
				redirect('home');
			}
			
			if($action == 'username')
			{
				//code to recover username
				$this->notification_model->recover_username($user->name, $email);
				$_SESSION['success'] = "Username mailed to <strong>" . $email . "</strong> !";
			} elseif ($action == 'password') {
				//code to generate data to reset password
				
				$_SESSION['success'] = "Instructions to reset password mailed to <strong>" . $email . "</strong> !";
			} else {
				$_SESSION['error'] = "ERROR: unknown action: " . $action . " !";
			}
		}
		
		if (validation_errors() !== "") {
			$_SESSION['error'] = validation_errors();
		}
		
		redirect('home');
	}
}
