<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		
		if (!isset($_SESSION['username']))
		{
			redirect('login');
		}
		
		//Only permit people with an admin account to view this page
		if ($_SESSION['account'] != 'admin')
		{
			$_SESSION['warning'] = 'Only administrators can access this page!';
			redirect('home');
		}	
	}
	
	function index()
	{
		$this->load->model('option_model');
		$this->load->model('user_model');
		$this->load->model('location_model');
		
		$data['options'] = $this->option_model->get_options();
		$data['users'] = $this->user_model->get_users_by_id();
		$data['locations'] = $this->location_model->get_locations();
		
		$data['title'] =  'Admin panel';
		$data['controller'] = 'admin';

		$this->load->view('view_admin_panel', $data);

	}
	
	function delete_option($id)
	{
		$this->load->model('option_model');
		
		$this->option_model->delete_option($id);
		
		$_SESSION['success'] = "Successfully removed option!";
		redirect('admin');
	}
	
	function add_option()
	{
		$this->load->model('option_model');
		
		$this->load->library('form_validation');
		
		//all forms need to be validated some way or another otherwise the set_value doesn't work !!'
		$this->form_validation->set_rules('option_name', 'option name', 'required');
		$this->form_validation->set_rules('option_value', 'option value', 'required');
		
		if ( $this->form_validation->run() !== false) 
		{
			$option_name = $this->input->post('option_name');
			$option_value = $this->input->post('option_value');
			
			if (!$this->option_model->add_option($option_name, $option_value))
			{
				$_SESSION['success'] = "Successfully added option!";
			} else {
				$_SESSION['error'] = "Cannot add this option! Reason: Option exists already.";
			}
		}
		
		if (validation_errors() !== "") {
			$_SESSION['error'] = validation_errors();
		}
		
		redirect('admin');
	}
	
	function transfer_plasmids()
	{
		$this->load->model('plasmid_model');
		$this->load->model('user_model');
		
		$this->load->library('form_validation');
		
		//all forms need to be validated some way or another otherwise the set_value doesn't work !!'
		$this->form_validation->set_rules('original_user', 'original user', 'required');
		$this->form_validation->set_rules('new_user', 'new user', 'required');	
		
		if ( $this->form_validation->run() !== false) 
		{
			$users = $this->user_model->get_users_by_id();
			
			$original_user = $this->input->post('original_user');
			$new_user = $this->input->post('new_user');
			
			$this->plasmid_model->transfer_plasmids($original_user, $new_user);
			$_SESSION['success'] = "Transfered plasmids from " . $users[$original_user] . " to " . $users[$new_user] . ".";
		}
		
		if (validation_errors() !== "") {
			$_SESSION['error'] = validation_errors();
		}
		
		redirect('admin');
	}
	
	function transfer_plasmids_location()
	{
		$this->load->model('plasmid_location_model');
		$this->load->model('location_model');
		
		$this->load->library('form_validation');
		
		//all forms need to be validated some way or another otherwise the set_value doesn't work !!'
		$this->form_validation->set_rules('original_location', 'original location', 'required');
		$this->form_validation->set_rules('new_location', 'new location', 'required');	
		
		if ( $this->form_validation->run() !== false) 
		{
			$locations = $this->location_model->get_locations();
			
			$original_location = $this->input->post('original_location');
			$new_location = $this->input->post('new_location');
			
			$this->plasmid_location_model->transfer_plasmids_location($original_location, $new_location);
			$_SESSION['success'] = "Transfered plasmids from " . $locations[$original_location] . " to " . $locations[$new_location] . ".";
		}
		
		if (validation_errors() !== "") {
			$_SESSION['error'] = validation_errors();
		}
		
		redirect('admin');
	}
	
	function export_database()
	{
		// Load the DB utility class and helpers
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');


		
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup();

		
		force_download('backup.sql.gz', $backup); 
	}
}
	

?>