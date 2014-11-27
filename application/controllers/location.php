<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location extends CI_Controller {

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

		$this->all();
	}
	
	public function view($location)
	{
		$this->load->model('location_model');
		$data['location'] = $this->user_model->get_user($user);
		$data['controller'] = 'location';
		if ($data['location'] !== false)
		{
			//user was found display detailed information
			$data['title'] = "Location -- " . $user;
			$this->load->view('view_location', $data);				
		} else {
			//user was not found throw error
			$data['title'] = "ERROR: location not found!";
			$data['error'] = "ERROR: location not found!";
			$this->load->view('view_error', $data);	
		}
		

	}
	
	public function all()
	{
		$this->load->model('location_model');
		$this->load->model('user_model');
		$this->load->model('plasmid_location_model');
		
		$data['users_per_location'] = $this->user_model->get_user_count_per_location();
		$data['plasmids_per_location'] = $this->plasmid_location_model->get_plasmid_count_per_location();
		$data['locations'] = $this->location_model->list_locations();
		$data['controller'] = 'location';
		$data['title'] = "Locations";
		$this->load->view('view_locations', $data);			
	}

	public function add()
	{
		if($_SESSION['account'] !== 'admin')
		{
			$_SESSION['error'] = "You do not have permission to add locations.";
			redirect('location');
		}
		
		$this->load->model('location_model');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('building', 'building', 'required');
		$this->form_validation->set_rules('room', 'room', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		
		if ( $this->form_validation->run() !== false) 
		{
				$building = $this->input->post('building');
				$room = $this->input->post('room');
				$address = $this->input->post('address');
				
				$record = array (
					'building' => $building,
					'room' => $room,
					'address' => $address
				);
				
				
				//TODO: make sure this is unique
				$this->location_model->insert_location($record);
				
				redirect('location');
		}	
		
		if (validation_errors() !== "") {
			$_SESSION['error'] = validation_errors();
		}
		
		$data['controller'] = 'location';
		$data['title'] = "Add location";
		$this->load->view('add_location', $data);	
	}
	
	public function delete($id)
	{
			$this->load->model('location_model');
			$this->load->model('user_model');
			$this->load->model('plasmid_location_model');
			
			$users = $this->user_model->get_users_at_location($id);
			$locations = $this->plasmid_location_model->get_plasmids_at_location($id);
			
			//check if there are users at this location
			if ($users == false && $locations == false)
			{
			//todo check if current user is admin
				if ($_SESSION['account'] == 'admin')
				{
					$this->location_model->delete_location($id);
					redirect('location');				
				} else {
					$_SESSION['error'] = "Error: you do not have the permission to delete this location.";
					redirect('location');
				}
			} else {
				//there are users or plasmids at this location it can't be deleted
					$_SESSION['error'] = "Error: users or samples are associated with this location, it can't be deleted";
					redirect('location');
			}

	}
	
	public function edit($location_id)
	{
		if($_SESSION['account'] !== 'admin')
		{
			$_SESSION['error'] = "You do not have permission to edit locations.";
			redirect('location');
		}

		$this->load->model('location_model');

		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('building', 'building', 'required');
		$this->form_validation->set_rules('room', 'room', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		
		if ( $this->form_validation->run() !== false) 
		{
				$building = $this->input->post('building');
				$room = $this->input->post('room');
				$address = $this->input->post('address');
				
				$record = array (
					'building' => $building,
					'room' => $room,
					'address' => $address
				);
				
				$this->location_model->update_location($location_id, $record);
				
				$_SESSION['success'] = "Successfully updated location.";
				redirect('location');
		}		
		
		if (validation_errors() !== "") {
			$_SESSION['error'] = validation_errors();
		}
		
		$location = $this->location_model->get_location($location_id);
		
		$data['title'] = "Edit location";
		$data['controller'] = 'location';
		$data['location_id'] = $location_id;
		
		$data['location'] = $location;
		
		$this->load->view('edit_location', $data);
		
	}

}

?>