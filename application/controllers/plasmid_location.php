<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plasmid_location extends CI_Controller {

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

	public function index()
	{
		//index not directly accessible
		redirect('home');
	}
	
	public function add($plasmid_id)
	{
		$this->load->model('option_model');
		$this->load->model('location_model');
		$this->load->model('plasmid_model');
		
		$plasmid = $this->plasmid_model->get_plasmid($plasmid_id);

		if($_SESSION['account'] !== 'admin' && $_SESSION['userid'] !== $plasmid->creator)
		{
			add_error_alert('Only admins and creators can add locations for a plasmid.');
			redirect('plasmid/view/' . $plasmid_id);
		}

		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('label', 'label', 'required');

		if ( $this->form_validation->run() !== false) 
		{
			$this->load->model('plasmid_location_model');
			
			$location = $this->input->post('location');
			$storage = $this->input->post('storage');
			$label = $this->input->post('label');
			$comment = $this->input->post('comment');
			
			$new_location = array(
				"location_id" => $location,
				"plasmid_id" => $plasmid_id,
				"storage_type" => $storage,
				"label" => $label,
				"comment" => $comment
			);
			
			$this->plasmid_location_model->insert_plasmid_location($new_location);
			
			add_success_alert("Location for " . $plasmid->name . " added.");
			
			redirect('plasmid/view/' . $plasmid_id);
			
		}
		
		if (validation_errors() !== "") {
			add_error_alert(validation_errors());
		}
		

		$data['locations'] = $this->location_model->get_locations();
		$data['storage_types'] = $this->option_model->get_options_hash('storage_type');
		$data['title'] = 'Add plasmid location';
		$data['plasmid_id'] = $plasmid_id;
		$data['plasmid_name'] = $plasmid->name;
		
		$data['controller'] = 'plasmid_location';
		$this->load->view('add_plasmid_location', $data);
	}
	
	
	public function delete($id,$plasmid_id)
	{
		$this->load->model('plasmid_location_model');
		$this->plasmid_location_model->delete_plasmid_location($id);
		add_success_alert("Successfully removed a location.");
		redirect('plasmid/view/' . $plasmid_id);
	}
	
	public function edit($id,$plasmid_id)
	{
		$this->load->model('option_model');
		$this->load->model('location_model');
		$this->load->model('plasmid_model');
		$this->load->model('plasmid_location_model');
		
		$plasmid = $this->plasmid_model->get_plasmid($plasmid_id);
		
		if($_SESSION['account'] !== 'admin' && $_SESSION['userid'] !== $plasmid->creator)
		{
			add_error_alert('You do not have the permission to edit this plasmid\'s location');
			redirect('plasmid/view/' . $plasmid_id);
		}
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('label', 'label', 'required');
		
		if ( $this->form_validation->run() !== false) 
		{	
			$location = $this->input->post('location');
			$storage = $this->input->post('storage');
			$label = $this->input->post('label');
			$comment = $this->input->post('comment');
			
			$updated_location = array(
				"location_id" => $location,
				"plasmid_id" => $plasmid_id,
				"storage_type" => $storage,
				"label" => $label,
				"comment" => $comment
			);
			
			$this->plasmid_location_model->update_plasmid_location($id, $updated_location);
			
			add_success_alert("Location for " . $plasmid->name . " successfully update.");
			
			redirect('plasmid/view/' . $plasmid_id);
			
		}
		
		if (validation_errors() !== "") {
			add_error_alert(validation_errors());
		}
		
		
		$data['id'] = $id;
		$data['plasmid_id'] = $plasmid_id;
		$data['plasmid_name'] = $plasmid->name;
		$data['locations'] = $this->location_model->get_locations();
		$data['storage_types'] = $this->option_model->get_options_hash('storage_type');
		$data['plasmid_location'] = $this->plasmid_location_model->get_plasmid_location($id);
		
		$data['title'] = 'Edit plasmid location';
		$data['controller'] = 'plasmid_location';
		
		$this->load->view('edit_plasmid_location', $data);
	}
	
}


?>