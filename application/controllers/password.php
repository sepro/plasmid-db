<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Password extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		
		if (!isset($_SESSION['username']))
		{
			redirect('login');
		}
		
		if ($_SESSION['account'] == 'pending')
		{
			$_SESSION['warning'] = 'Your account is <strong>awaiting approval from an administrator</strong>, all features are disabled';
		}
	}


	public function index()
	{
		$this->change();
	}
	
	public function change()
	{
		$this->load->model('user_model');
		
		$user = $this->user_model->get_user($_SESSION['username']);

		$this->load->library('form_validation');
		

		$this->form_validation->set_rules('password', 'password', 'required|min_length[5]');
		$this->form_validation->set_rules('new', 'new password', 'required|min_length[5]');
		$this->form_validation->set_rules('confirm', 'confirm new password', 'required|min_length[5]');

		if ( $this->form_validation->run() !== false) 
		{
			//passed initial validation, do additional checks and add user to databas
			if(sha1($this->input->post('password')) !== $user->password)
			{
				$_SESSION['error'] = "Old password incorrect";

			} elseif ($this->input->post('new') !== $this->input->post('confirm')) {
				$_SESSION['error'] = "New password and confirmation don't match.";
			
			}else {
				$passdata = array (
					"password" => sha1($this->input->post('new')),
				);
				
				$this->user_model->update_user($user->username, $passdata);
				$_SESSION['success'] = "Password successfully updated.";
				redirect('home');
			}
			
		}
		
		if (validation_errors() !== "") {
			$_SESSION['error'] = validation_errors();
		}
		
		
		
		$data['controller'] = 'password';
		$data['title'] = 'password';
		$this->load->view('edit_password', $data);	
	}
}


?>