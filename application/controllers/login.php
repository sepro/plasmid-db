<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
	}

	public function index()
	{
		if (isset($_SESSION['username']))
		{
			//user is already logged in, redirect to home
			redirect('home');
		}
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'username', 'required|min_length[5]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[5]');
		
		if ( $this->form_validation->run() !== false) 
		{
			$this->load->model('login_model');
			$res = $this
					->login_model
					->verifty_user(
						$this->input->post('username'), 
						$this->input->post('password'));
			
			if ($res !== false)
			{
				$_SESSION['username'] = $this->input->post('username');
				$_SESSION['userid'] = $res->user_id;
				$_SESSION['first_name'] = $res->first_name;
				$_SESSION['last_name'] = $res->last_name;
				$_SESSION['account'] = $res->account;
				$_SESSION['loggedin'] = TRUE;
				
				redirect('home');
				
			} else {
				$_SESSION['error'] = "Couldn't log in " . $this->input->post('username') . " check credentials !";
			}
			
		} else {
			if (validation_errors() !== "")
			{
				$_SESSION['error'] = validation_errors();
			}			
		}
		
		$data['controller'] = 'login';
		$data['title'] = 'Login';
		$this->load->view('view_login', $data);
	}
	
	public function logout()
	{
		session_destroy();
		redirect('login');
	}
	
}


?>