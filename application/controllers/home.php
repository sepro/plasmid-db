<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();

		if ($this->config->item('autologin'))
		{
			$this->load->model('user_model');
			
			$user = $this->user_model->get_user($this->config->item('autologinuser'));
			
			if(!($user == FALSE))
			{
				$_SESSION['username'] = $user->username;
				$_SESSION['userid'] = $user->user_id;
				$_SESSION['first_name'] = $user->first_name;
				$_SESSION['last_name'] = $user->last_name;
				$_SESSION['account'] = $user->account;
				$_SESSION['loggedin'] = TRUE;
				
				$_SESSION['success'] = 'Automatically logged in as : ' . $user->username;
			
			} else {
				$_SESSION['error'] = 'Could not login user ' . $this->config->item('autologinuser') . ' automatically, user not found!';
			}
			
			
		}

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
		$data['controller'] = 'home';
		$data['title'] = 'Home';
		$this->load->view('view_home', $data);
	}
}


?>