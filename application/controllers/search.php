<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

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
			add_warning_alert('Your account is <strong>awaiting approval from an administrator</strong>, all features are disabled');
			redirect('home');
		}
	}


	public function index()
	{
		$this->load->model('plasmid_model');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('srch-term', 'search term', 'required');
		
		$data['term'] = 'please enter a keyword to search with.';
		$data['plasmids'] = false;
		
		
		if ( $this->form_validation->run() !== false) 
		{
			$term = $this->input->post('srch-term');
			$data['term'] = $term;
			$data['plasmids'] = $this->plasmid_model->search_plasmid($term);
		}
		
		if (validation_errors() !== "") {
			add_error_alert(validation_errors());
		}
		
		$data['backbones'] = $this->plasmid_model->get_backbones();
		
		$data['controller'] = 'search';
		$data['title'] = 'Search';
		
		$this->load->view('view_search_results', $data);
	}
}


?>