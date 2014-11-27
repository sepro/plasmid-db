<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		
		if (!isset($_SESSION['username']))
		{
			$_SESSION['warning'] = 'You are currently not logged in ! To use the platform log in or register.';
		}
		

	}


	public function about()
	{
		$data['controller'] = 'home';
		$data['title'] = 'Home';
		$this->load->view('info/view_about', $data);
	}
	
	public function acknowledgements()
	{
		$data['controller'] = 'home';
		$data['title'] = 'Home';
		$this->load->view('info/view_acknowledgements', $data);
	}
	
	public function contact()
	{
		$data['controller'] = 'home';
		$data['title'] = 'Home';
		$this->load->view('info/view_contact', $data);
	}
	
	public function faq()
	{
		$data['controller'] = 'home';
		$data['title'] = 'Home';
		$this->load->view('info/view_faq', $data);
	}
	
	public function legal()
	{
		$data['controller'] = 'home';
		$data['title'] = 'Home';
		$this->load->view('info/view_legal', $data);
	}
	
	public function publications()
	{
		$data['controller'] = 'home';
		$data['title'] = 'Home';
		$this->load->view('info/view_publications', $data);
	}
	
	public function start()
	{
		$data['controller'] = 'home';
		$data['title'] = 'Home';
		$this->load->view('info/view_quick_start', $data);
	}
	
	public function tutorial()
	{
		$data['controller'] = 'home';
		$data['title'] = 'Home';
		$this->load->view('info/view_tutorial', $data);
	}
}


?>