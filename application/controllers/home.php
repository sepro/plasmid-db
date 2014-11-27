<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$data['controller'] = 'home';
		$data['title'] = 'Home';
		$this->load->view('view_home', $data);
	}
}


?>