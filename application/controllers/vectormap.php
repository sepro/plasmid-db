<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vectormap extends CI_Controller {
	
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
			redirect('home');
		}
	}	

	public function show($plasmid_id)
	{

		$this->load->model('vectormap_model');
		
		$vectormap = $this->vectormap_model->get_vectormap($plasmid_id);
		
		$this->output
    		->set_content_type($vectormap->image_type) // You could also use ".jpeg" which will have the full stop removed before looking in config/mimes.php
    		->set_output($vectormap->image_data);
	}
	
	public function show_thumb($plasmid_id)
	{

		$this->load->model('vectormap_model');
		
		$vectormap = $this->vectormap_model->get_vectormap($plasmid_id);
		
		$this->output
    		->set_content_type($vectormap->image_type) // You could also use ".jpeg" which will have the full stop removed before looking in config/mimes.php
    		->set_output($vectormap->thumb_data);
	}
	
}
?>