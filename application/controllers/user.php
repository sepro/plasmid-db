<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
	
	public function view($user)
	{
		$this->load->model('user_model');
		$this->load->model('location_model');
		$this->load->model('plasmid_model');
		
		$userData = $this->user_model->get_user($user);

		if ($userData !== false)
		{
			//user was found display detailed information
			$data['user'] = $userData;
			$data['location']= $this->location_model->get_location($userData->location);
			$data['plasmids'] = $this->plasmid_model->get_plasmids_creator($userData->user_id);
			$data['backbones'] = $this->plasmid_model->get_backbones();
			
			$data['title'] = "User -- " . $user;
			$data['controller'] = 'user';
			$this->load->view('view_user', $data);				
		} else {
			//user was not found throw error
			add_error_alert("ERROR: user " . $user . " not found!");
			redirect('user');
		}
	}
	
	public function location($location_id)
	{
		$this->load->model('user_model');
		
		$data['users'] = $this->user_model->get_users_per_location($location_id);
		
		$data['title'] = "Users";
		$data['controller'] = 'user';
		$this->load->view('view_users', $data);			
	}
	
	public function all()
	{
		$this->load->model('user_model');
		
		$data['users'] = $this->user_model->list_users();
		
		$data['title'] = "Users";
		$data['controller'] = 'user';
		$this->load->view('view_users', $data);			
	}

	
	public function delete($user)
	{
			$this->load->model('user_model');
			$this->load->model('plasmid_model');
			if ($_SESSION['account'] == 'admin')
			{
				//check if current user is admin
				$userData = $this->user_model->get_user($user);
				$plasmids = $this->plasmid_model->get_plasmids_creator($userData->user_id);
				if ($userData->account !== 'admin' && $plasmids == false)
				{
					$this->user_model->delete_user($user);	
					redirect('user');
				} else {
					if ($userData->account == 'admin')
					{
						add_error_alert("Admin accounts cannot be deleted from the website.");
						redirect('user');						
					}
					if ($plasmids !== false)
					{
						add_error_alert("This user still is the creator of samples, first assign a new creator for these samples before deleting.");
						redirect('user');						
					}
				
				}
				
			} else {
					add_error_alert("You do not have the permission to delete this user.");
					redirect('user');
			}			

	}
	
	
	public function edit($username)
	{
		if($_SESSION['account'] !== 'admin' && $_SESSION['username'] !== $username)
		{
			add_error_alert('You do not have the permission to change this user\'s details.');
			redirect('user');
		}
		
		if($this->config->item('demonstration'))
		{
			add_error_alert('Demo mode active you cannot change your credentials');
			redirect('user');
		}
		
		$this->load->model('user_model');
		$this->load->model('location_model');
		
		$user = $this->user_model->get_user($username);
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('first_name', 'first name', 'required');
		$this->form_validation->set_rules('last_name', 'last name', 'required');
		//$this->form_validation->set_rules('email', 'e-mail address', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'phone number', 'required');
		$this->form_validation->set_rules('location', 'location', '');
		$this->form_validation->set_rules('account', 'account', '');
		
		
		if ( $this->form_validation->run() !== false) 
		{

			$user = array (
				"first_name" => $this->input->post('first_name'),
				"last_name" => $this->input->post('last_name'),
				"location" => $this->input->post('location'),
				//"email" => $this->input->post('email'),
				"account" => $this->input->post('account'),
				"phone" => $this->input->post('phone'),
			);
				
			$this->user_model->update_user($username, $user);
			add_success_alert('User ' . $username . ' has been successfully updated.');
			redirect('user/view/' . $username);
		}
		
		if (validation_errors() !== "") {
			add_error_alert(validation_errors());
		}		
		
		$data['user'] = $user;
		$data['locations'] = $this->location_model->get_locations();
		$data['title'] = "Edit user";
		$data['controller'] = 'user';
		
		$this->load->view('edit_user', $data);
	}

}

?>
