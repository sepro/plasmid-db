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
				add_error_alert("ERROR: No user found with this e-mail address: <strong>" . $email . "</strong> !");
				redirect('home');
			}
			
			if($action == 'username')
			{
				//code to recover username
				$this->notification_model->recover_username($user->username, $email);
				add_success_alert("Username mailed to <strong>" . $email . "</strong> !");
			} elseif ($action == 'password') {
				//code to generate data to reset password
				$key = $this->user_model->create_reset_key($user->username);
				
				$url = base_url() . "forgot/password/" . $user->username . '/' . $key . '/'; 
				
				$this->notification_model->password_reset_requested($user->username, $url, $email);
				
				add_success_alert("Instructions to reset password mailed to <strong>" . $email . "</strong> !");
			} else {
				add_error_alert("ERROR: unknown action: " . $action . " !");
			}
		}
		
		if (validation_errors() !== "") {
			add_error_alert(validation_errors());
		}
		
		redirect('home');
	}
	
	public function password($username, $key)
	{
		$this->load->model('user_model');
		$this->load->model('notification_model');
		
		$user = $this->user_model->get_user($username);
		
		$reset_date = new DateTime($user->reset_date);
		$current_date = new DateTime("now");
		
		$time_difference=$current_date->diff($reset_date);
		
		if($time_difference->days < 2)
		{
			if($key == $user->reset_key)
			{
				//Valid key, reset password and send email with new password !
				
				$new_pass = $this->user_model->reset_password($username);
				
				$this->notification_model->password_reset($new_pass, $user->email);
				
				add_success_alert("Password successfully reset! The new password has been mailed to you.");
			}
		} else {
			add_error_alert("Unable to reset password, reset key expired. Request a new key <a href=\"" . base_url() . "forgot/\">here</a>");
		}
		
		redirect('home');			
	}
}
