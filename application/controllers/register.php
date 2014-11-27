<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		
		if (isset($_SESSION['username']))
		{
			redirect('home');
		}
	}


	public function index()
	{
		$this->load->model('location_model');
		$this->load->model('user_model');
		
		$this->load->library('form_validation');
		
		$this->load->helper('email');
		
		$this->form_validation->set_rules('username', 'username', 'required|min_length[5]|is_unique[users.username]|alpha_numeric');
		$this->form_validation->set_rules('first_name', 'first name', 'required');
		$this->form_validation->set_rules('last_name', 'last name', 'required');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[5]');
		$this->form_validation->set_rules('confirm', 'confirm', 'required|min_length[5]');
		$this->form_validation->set_rules('email', 'e-mail address', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'phone number', 'required');
		$this->form_validation->set_rules('location', 'location', '');
		
		if ( $this->form_validation->run() !== false) 
		{
			//passed initial validation, do additional checks and add user to databas
			if($this->input->post('password') !== $this->input->post('confirm'))
			{
				$_SESSION['error'] = "Password doesn't match confirmation!";

			} else {
				$user = array (
					"username" => $this->input->post('username'),
					"first_name" => $this->input->post('first_name'),
					"last_name" => $this->input->post('last_name'),
					"password" => sha1($this->input->post('password')),
					"location" => $this->input->post('location'),
					"email" => $this->input->post('email'),
					"account" => 'pending',
					"phone" => $this->input->post('phone'),
				);
				
				$this->user_model->insert_user($user);
				send_email("proost@mpimp-golm.mpg.de", "New plasmid DB User!", "A new user registered, please check the webside to approve the account!");
				redirect('login');
			}
			
		}
		
		if (validation_errors() !== "") {
			$_SESSION['error'] = validation_errors();
		}				
		
		$data['locations'] = $this->location_model->get_locations();
		$data['controller'] = 'register';
		$data['title'] = 'Registration';
		$this->load->view('view_registration', $data);
	}
}


?>