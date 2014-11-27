<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends CI_Controller {

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
			redirect('home');
		}
	}


	public function index()
	{
		$this->view();
	}
	
	public function pdf($location_id)
	{
		$this->load->helper(array('dompdf', 'file'));
		$this->load->helper('file');
			
		$html = $this->get_inventory($location_id);
	
		//create pdf
		$pdfdata = pdf_create($html, '', false);
		$filename = 'pdf/' . $_SESSION['username'] . "_inventory.pdf";
		
		write_file($filename, $pdfdata);
		redirect($filename);
	}
	
	public function view($location_id)
	{
		$html = $this->get_inventory($location_id);
		
		echo $html;
	}
	
	//one function to get data and generate html code
	//view and pdf will be based on exactly the same code
	private function get_inventory($location_id)
	{
		$this->load->model('inventory_model');
		$this->load->model('location_model');
		$this->load->library('table');
		
		$template = array('table_open' => '<table id="myTable">');
		
		$this->table->set_template($template);
		$this->table->set_heading(array('Plasmid' , 'Label', 'Comment', 'First name', 'Last name'));
		
		$inventory = $this->inventory_model->get_inventory($location_id);

		$data['building'] = "Not found";
		$data['room'] = "";
		
		$location = $this->location_model->get_location($location_id);
		if ($location !== FALSE)
		{
			$data['building'] = $location->building;
			$data['room'] = $location->room;
		}
		
		if ($inventory !== FALSE)
		{

			$data['inventory_table'] = $this->table->generate($inventory);	
		} else {
			$data['inventory_table'] = "<p>No samples at this location!</p>";
		}

		$data['title'] = 'Inventory';
		return $this->load->view('pdf/view_inventory', $data, TRUE);		
	}
	
	
}


?>