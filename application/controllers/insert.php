<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert extends CI_Controller {

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
		//nothing to see here, redirect to plasmid overview
		redirect('plasmid');
	}
	
	public function view($insert_id)
	{
		$this->load->model('insert_model');
		$this->load->model('plasmid_model');
		
		$insert = $this->insert_model->get_insert($insert_id);
		
		$data['plasmid'] = $this->plasmid_model->get_plasmid($insert->plasmid_id);
		$data['insert'] = $insert;
		$data['controller'] = 'plasmid';
		$data['title'] = 'Insert';
		$this->load->view('view_insert', $data);
	}
	
	public function add($plasmid_id)
	{
		$this->load->model('insert_model');
				
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'plasmid name', 'required');
		$this->form_validation->set_rules('comment', 'comment', 'required');
		$this->form_validation->set_rules('sequence', 'sequence', '');
		
		if ( $this->form_validation->run() !== false) 
		{
			$name = $this->input->post('name');
			$comment = $this->input->post('comment');
			$sequence = $this->input->post('sequence');

			$record = array(
				'name' => $name,
				'comment' => $comment,
				'sequence' => $sequence,
				'plasmid_id' => $plasmid_id,

			);
			

			$this->insert_model->insert_insert($record);
			
			add_success_alert("Insert successfully added to the database");
			redirect('plasmid/view/' . $plasmid_id);

		}
		
		if (validation_errors() !== "") {
			add_error_alert(validation_errors());
		}
		
		$data['controller'] = 'plasmid';
		$data['title'] = 'Add insert';
		$data['plasmid_id'] = $plasmid_id;
		$this->load->view('add_insert', $data);
	}
	
	public function edit($insert_id)
	{
		$this->load->model('insert_model');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'plasmid name', 'required');
		$this->form_validation->set_rules('comment', 'comment', 'required');
		$this->form_validation->set_rules('sequence', 'sequence', '');
		
		$insert = $this->insert_model->get_insert($insert_id);	
		$data['insert'] = $insert;
		
		if ( $this->form_validation->run() !== false) 
		{
			$name = $this->input->post('name');
			$comment = $this->input->post('comment');
			$sequence = $this->input->post('sequence');

			$record = array(
				'name' => $name,
				'comment' => $comment,
				'sequence' => $sequence,
			);
			

			$this->insert_model->update_insert($insert_id, $record);
			
			add_success_alert("Insert successfully saved to the database");
			redirect('plasmid/view/' . $insert->plasmid_id);			
		}
		
		if (validation_errors() !== "") {
			add_error_alert(validation_errors());
		}	
		

		
		$data['controller'] = 'plasmid';
		$data['title'] = 'Edit insert';
		$data['insert_id'] = $insert_id;
		$this->load->view('edit_insert', $data);
	}
	
	public function delete($insert_id)
	{
		$this->load->model('insert_model');
		
		$this->insert_model->delete_insert($insert_id);
		add_success_alert("Insert successfully removed from the database");
		redirect('plasmid');
		
	}
	
}


?>