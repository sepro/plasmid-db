<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plasmid extends CI_Controller {
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
		if (isset($_SESSION['last_plasmid_page']))
		{
			$page = $_SESSION['last_plasmid_page'];
			unset($_SESSION['last_plasmid_page']);
			redirect('plasmid/page/'.$page);
		} else {
			redirect('plasmid/page/');
		}
	}
	
	public function view($id)
	{
		$this->load->model('plasmid_model');
		$this->load->model('user_model');
		$this->load->model('location_model');
		$this->load->model('insert_model');
		$this->load->model('vectormap_model');
		
		$plasmid = $this->plasmid_model->get_plasmid($id);

		
		$data['plasmid'] = $plasmid;
		$data['locations'] = $this->plasmid_model->get_locations($id);
		$data['creator'] = $this->user_model->get_user_id($data['plasmid']->creator);
		$data['creator_location'] = $this->location_model->get_location($data['creator']->location);
		$data['inserts'] = $this->insert_model->get_inserts_for_plasmid($id);
		
		if((int)$plasmid->is_backbone == 0)
		{
			$backbone = $this->plasmid_model->get_plasmid($plasmid->backbone);
			$data['backbone_name'] = $backbone->name;			
		}


		$data['has_vectormap'] = $this->vectormap_model->vectormap_exists($id);
		$data['controller'] = 'plasmid';
		$data['title'] = "Plasmid -- " . $data['plasmid']->name;
		$this->load->view('view_plasmid', $data);
			
	}
	
	public function location($location_id)
	{
		$this->load->model('plasmid_model');
		
		$data['use_pagination'] = false;
		$data['plasmids'] = $this->plasmid_model->get_plasmids_from_location($location_id);
		$data['backbones'] = $this->plasmid_model->get_backbones();
		$data['controller'] = 'plasmid';
		$data['title'] = "Plasmids";
		
		$this->load->view('view_plasmids', $data);			
	}
	
	public function all()
	{
		$this->load->model('plasmid_model');
		
		$data['use_pagination'] = false;
		$data['plasmids'] = $this->plasmid_model->list_plasmids();
		$data['backbones'] = $this->plasmid_model->get_backbones();
		$data['controller'] = 'plasmid';
		$data['title'] = "Plasmids";
		$this->load->view('view_plasmids', $data);			
	}
	
	public function page($page = 0)
	{
		$this->load->model('plasmid_model');
		
		$items_per_page = $this->config->item('plasmids_per_page');
		
		$all_plasmids = $this->plasmid_model->list_plasmids();
		
		//in case the database is empty go to this which hides pagination and handles this
		if($all_plasmids == false)
		{
			redirect('plasmid/all');
		} else {
			$count = count($all_plasmids);
			$visable_plasmids = array_slice($all_plasmids, $page, $items_per_page);
			
			if ($page >= $count && $count > 0)
			{
				redirect('plasmid/page/');
			} else {
				$_SESSION['last_plasmid_page'] = $page;
				$this->load->library('pagination');

				$config['base_url'] = base_url() . 'plasmid/page/';
				$config['total_rows'] = $count;
				$config['per_page'] = $items_per_page;
				
				$config['full_tag_open'] = "<nav><ul class=\"pagination\">\n";
				$config['full_tag_close'] = "</ul></nav>\n";
				
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = "</li>\n";
				
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = "</a></li>\n";

				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = "</li>\n";
				
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = "</li>\n";
				
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = "</li>\n";
				
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = "</li>\n";
				
				$this->pagination->initialize($config);

				$data['use_pagination'] = true;
				$data['pagination_links'] =	$this->pagination->create_links();
				
				$data['plasmids'] = $visable_plasmids;
				$data['backbones'] = $this->plasmid_model->get_backbones();
				$data['controller'] = 'plasmid';
				$data['title'] = "Plasmids";
				$this->load->view('view_plasmids', $data);	
			}
		}
	}

	public function add()
	{
		if ($_SESSION['account'] == 'guest')
		{
			redirect('plasmid');
		}
		$this->load->model('plasmid_model');
		$this->load->model('option_model');
		$this->load->model('user_model');
				
		$this->load->library('form_validation');
		
		
		//all forms need to be validated some way or another otherwise the set_value doesn't work !!'
		$this->form_validation->set_rules('name', 'plasmid name', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('creator', 'creator', 'integer');
		$this->form_validation->set_rules('is_vector', 'is_vector', 'integer');
		$this->form_validation->set_rules('backbone', 'backbone', 'integer');
		$this->form_validation->set_rules('publication', 'publication', 'integer');
		$this->form_validation->set_rules('website', 'website', '');
		$this->form_validation->set_rules('v_type', 'vector type', '');
		$this->form_validation->set_rules('b_res', 'bacterial resistance', '');
		$this->form_validation->set_rules('p_res', 'plant resistance', '');
		
		if ( $this->form_validation->run() !== false) 
		{
			$name = $this->input->post('name');
			$creator = $this->input->post('creator');

			$is_backbone = $this->input->post('is_vector');
			$backbone = $this->input->post('backbone');
			
			//make sure $is_backone is 0 if not selected
			if ($is_backbone !== '1')
			{
				$is_backbone = '0';
			} else {
				//if the new vector is a backbone make sure 
				//the backbone field is set to none
				$backbone = '0';
			}

			$publication = $this->input->post('publication');
			$website = $this->input->post('website');
			
			$vector_type = $this->input->post('v_type');
			
			$bacterial_resistance = $this->input->post('b_res');
			$plant_resistance = $this->input->post('p_res');
						
			$description = $this->input->post('description');
			
			$record = array(
				'vector_type' => $vector_type,
				'name' => $name,
				'creator' => $creator,
				'is_backbone' => $is_backbone,
				'pubmed_id' => $publication,
				'website' => $website,
				'bacterial_resistance' => implode(";", $bacterial_resistance),
				'plant_resistance' => implode(";", $plant_resistance),
				'description' => $description,
				'backbone' => $backbone
			);
			
			//print_r($record);
			
			if ($this->plasmid_model->plasmid_exists($name))
			{
				//plasmid with this name already existist in the db
				//throw error
				add_error_alert("plasmid with name " . $name . " already exists!");
			} elseif ($is_backbone !== '1' && $backbone == '0') {
				add_error_alert("plasmid " . $name . " requires a backone different than None.");
			}else {
				$this->plasmid_model->insert_plasmid($record);
				
				add_success_alert("Plasmid $name successfully added to the database");
				add_info_alert("Add a location for plasmid $name");
				$plasmid_id = $this->plasmid_model->get_plasmid_id($name);
				redirect('plasmid_location/add/' . $plasmid_id);
			}

		}
		
		if (validation_errors() !== "") {
			add_error_alert(validation_errors());
		}
		
		$data['b_res'] = $this->option_model->get_options_hash('bacterial_resistance');
		$data['p_res'] = $this->option_model->get_options_hash('plant_resistance');
		$data['v_type'] = $this->option_model->get_options_hash('vector_type');
		$data['users'] = $this->user_model->get_users_by_id();
		$data['backbones'] = $this->plasmid_model->get_backbones();
					
		$data['controller'] = 'plasmid';
		$data['title'] = "Add plasmid";
		$this->load->view('add_plasmid', $data);				
	}
	
	public function upload_gb()
	{
		if ($_SESSION['account'] == 'guest')
		{
			redirect('plasmid');
		}
		
		$this->load->model('plasmid_model');
		
		if (!empty($_FILES['userfile']['name']))
		{
			$plasmid = $this->plasmid_model->upload_genbank();
			
			if ($plasmid !== FALSE)
			{
				if ($this->plasmid_model->plasmid_exists($plasmid["name"]))
				{
					$_SESSION['success'] = NULL;
					add_error_alert("Cannot add this genbank file, plamid with this name already exists in database");
					redirect('plasmid');	
				} else {
					
					if($plasmid["name"] !== "")
					{
						$this->plasmid_model->insert_plasmid($plasmid);
				
						add_success_alert("Plasmid $name successfully added to the database");
						add_warning_alert("Not all information could be derived from the GenBank file. <strong>Please complete where necessary !</strong>");
						$plasmid_id = $this->plasmid_model->get_plasmid_id($plasmid["name"]);
						redirect('plasmid/edit/' . $plasmid_id);						
					} else {
						$_SESSION['success'] = NULL;
						add_error_alert("No plasmid found in this file or wrong file format!");
						redirect('plasmid');
					}

				}
			} else {
				//an error occurred go back (the model set the error msg)
				add_error_alert("Failed to upload GenBank file!");
				redirect('plasmid');
			}
					
		}
		
		$data['controller'] = 'plasmid';
		$data['title'] = "Upload GenBank File";
		$this->load->view('upload_genbank', $data);
	}
	
	public function upload_embl()
	{
		if ($_SESSION['account'] == 'guest')
		{
			redirect('plasmid');
		}
		
		$this->load->model('plasmid_model');
		
		if (!empty($_FILES['userfile']['name']))
		{
			$plasmid = $this->plasmid_model->upload_embl();
			
			if ($plasmid !== FALSE)
			{
				if ($this->plasmid_model->plasmid_exists($plasmid["name"]))
				{
					$_SESSION['success'] = NULL;
					add_error_alert("Cannot add this EMBL file, plamid with this name already exists in database");
					redirect('plasmid');	
				} else {
					
					if($plasmid["name"] !== "")
					{
						$this->plasmid_model->insert_plasmid($plasmid);
				
						add_success_alert("Plasmid $name successfully added to the database");
						add_warning_alert("Not all information could be derived from the EMBL file. <strong>Please complete where necessary !</strong>");
						$plasmid_id = $this->plasmid_model->get_plasmid_id($plasmid["name"]);
						redirect('plasmid/edit/' . $plasmid_id);						
					} else {
						$_SESSION['success'] = NULL;
						add_error_alert("No plasmid found in this file or wrong file format!");
						redirect('plasmid');
					}

				}
			} else {
				//an error occurred go back (the model set the error msg)
				add_error_alert("Failed to upload EMBL file!");
				redirect('plasmid');
			}
					
		}
		
		$data['controller'] = 'plasmid';
		$data['title'] = "Upload EMBL File";
		$this->load->view('upload_embl', $data);
	}

	public function addvectormap($plasmid_id)
	{
		if ($_SESSION['account'] == 'guest')
		{
			redirect('plasmid');
		}
		
		$this->load->model('plasmid_model');
		$this->load->model('vectormap_model');
		
		$plasmid = $this->plasmid_model->get_plasmid($plasmid_id);
		
		if($_SESSION['account'] !== 'admin' && $_SESSION['userid'] !== $plasmid->creator)
		{
			add_error_alert("You do not have permission to add/change the vector map of " . $plasmid->name);
			redirect('plasmid/view/' . $plasmid_id);			
		}
		
		if (!empty($_FILES['userfile']['name']))
		{
			
			if ($this->vectormap_model->upload_vectormap($plasmid_id))
			{
				//upload successfull go to view
				redirect('plasmid/view/' . $plasmid_id);
			} else {
				//an error occurred go back (the model set the error msg)
				redirect('plasmid/addvectormap/' . $plasmid_id);
			}
					
		}

		
		$data['plasmid'] = $this->plasmid_model->get_plasmid($plasmid_id);
		$data['plasmid_id'] = $plasmid_id;
		$data['title'] = 'Add vectormap';
		$data['controller'] = 'plasmid';
		$this->load->view('add_vectormap',$data);
	}
	
	public function delete($id)
	{
		$this->load->model('plasmid_model');
		$this->load->model('plasmid_location_model');

		$plasmid = $this->plasmid_model->get_plasmid($id);
		
		if($_SESSION['account'] !== 'admin' && $_SESSION['userid'] !== $plasmid->creator)
		{
			add_error_alert("You do not have permission to remove " . $plasmid->name);
			redirect('plasmid');			
		}
		
		
		if($this->plasmid_location_model->get_plasmid_locations($id) !== false)
		{
			add_error_alert("Cannot remove " . $plasmid->name . ", plasmid still in collection! (please delete all locations first)");
			redirect('plasmid');			
		}
		
		
		if ((int)$plasmid->is_backbone == 1 && $this->plasmid_model->get_plasmids_backbone($plasmid->plasmid_id) !== false)
		{
			add_error_alert("Cannot remove " . $plasmid->name . ", plasmids based on this backbone exist.");
			redirect('plasmid');
		}
			
		$this->plasmid_model->delete_plasmid($id);
		
		add_success_alert("Plasmid " . $plasmid->name . " successfully removed from the database.");
		redirect('plasmid');	

	}
	
	public function edit($plasmid_id)
	{
		if ($_SESSION['account'] == 'guest')
		{
			redirect('plasmid');
		}
		
		$this->load->model('plasmid_model');
		$this->load->model('option_model');
		$this->load->model('user_model');
		
		$plasmid = $this->plasmid_model->get_plasmid($plasmid_id);
		
		if($_SESSION['account'] !== 'admin' && $_SESSION['userid'] !== $plasmid->creator)
		{
			add_error_alert('You do not have the permission to edit this plasmid');
			redirect('plasmid');
		}
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'plasmid name', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('creator', 'creator', 'integer');
		$this->form_validation->set_rules('is_vector', 'is_vector', 'integer');
		$this->form_validation->set_rules('backbone', 'backbone', 'integer');
		$this->form_validation->set_rules('publication', 'publication', 'integer');
		$this->form_validation->set_rules('website', 'website', '');
		$this->form_validation->set_rules('v_type', 'vector type', '');
		$this->form_validation->set_rules('b_res', 'bacterial resistance', '');
		$this->form_validation->set_rules('p_res', 'plant resistance', '');	
		
		if ( $this->form_validation->run() !== false) 
		{
			$name = $plasmid->name; //name cannot be changed (potential issue with backbones) !!
			//fields that cannot be changed using the edit
			$embl = $plasmid->embl;
			$genbank = $plasmid->genbank;
			$sequence = $plasmid->sequence;
			
			$creator = $this->input->post('creator');

			$is_backbone = $this->input->post('is_vector');
			$backbone = $this->input->post('backbone');
			
			//make sure $is_backone is 0 if not selected
			if ($is_backbone !== '1')
			{
				$is_backbone = '0';
			} else {
				//if the new vector is a backbone make sure 
				//the backbone field is set to none
				$backbone = '0';
			}

			$publication = $this->input->post('publication');
			$website = $this->input->post('website');
			
			$vector_type = $this->input->post('v_type');
			
			$bacterial_resistance = $this->input->post('b_res');
			$plant_resistance = $this->input->post('p_res');
						
			$description = $this->input->post('description');

			
			$record = array(
				'vector_type' => $vector_type,
				'name' => $name,
				'creator' => $creator,
				'is_backbone' => $is_backbone,
				'pubmed_id' => $publication,
				'website' => $website,
				'bacterial_resistance' => implode(";", $bacterial_resistance),
				'plant_resistance' => implode(";", $plant_resistance),
				'description' => $description,
				'sequence' => $sequence,
				'backbone' => $backbone,
				'genbank' => $genbank,
				'embl' => $embl
			);
			
			if ($is_backbone !== '1' && $backbone == '0') {
				//user is stupid, make sure a correct backbone is entered for plasmid that is not flagged a backbone
				add_error_alert("Plasmid " . $name . " requires a backone different than None.");
			} elseif($is_backbone !== '1' && $this->plasmid_model->get_plasmids_backbone($plasmid_id) !== false){
				//user is trying to change a backbone that is used by other plasmids to non-backbone
				add_error_alert("Plasmid " . $name . " is used as a backbone for other plasmids and cannot be changed to non-backbone.");				
			}else {
				$this->plasmid_model->update_plasmid($plasmid_id, $record);
				
				add_success_alert("Plasmid $name successfully updated");
				redirect('plasmid/view/' . $plasmid_id);
			}


		}

		if (validation_errors() !== "") {
			add_error_alert(validation_errors());
		}

	
		$data['b_res'] = $this->option_model->get_options_hash('bacterial_resistance');
		$data['p_res'] = $this->option_model->get_options_hash('plant_resistance');
		$data['v_type'] = $this->option_model->get_options_hash('vector_type');
		$data['users'] = $this->user_model->get_users_by_id();
		$backbones = $this->plasmid_model->get_backbones();
		
		//make sure it isn't possible to assing a backbone to itself
		if (isset($backbones[$plasmid_id])) {
			unset($backbones[$plasmid_id]);
		}
		
		$data['backbones'] = $backbones;
		
		$data['plasmid'] = $plasmid;
		
		$data['title'] = 'Edit plasmid';
		$data['controller'] = 'plasmid';
		$this->load->view('edit_plasmid',$data);
	}

	public function sequence($plasmid_id)
	{
		$this->load->model('plasmid_model');
		
		$plasmid = $this->plasmid_model->get_plasmid($plasmid_id);
		
		$data['filename'] = $plasmid->name . ".fasta";
		$data['name'] = $plasmid->name;
		$data['content'] = $plasmid->sequence;
		
		$this->load->view('file/text_file', $data);
	}
	
	public function genbank($plasmid_id)
	{
		$this->load->model('plasmid_model');
		
		$plasmid = $this->plasmid_model->get_plasmid($plasmid_id);
		
		$data['filename'] = "plasmid.gb";
		$data['content'] = $plasmid->genbank;
		$this->load->view('file/text_file', $data);
	}
	
	public function embl($plasmid_id)
	{
		$this->load->model('plasmid_model');
		
		$plasmid = $this->plasmid_model->get_plasmid($plasmid_id);
		
		$data['filename'] = "plasmid.embl";
		$data['content'] = $plasmid->embl;
		$this->load->view('file/text_file', $data);
	}

	public function remove_sequence($plasmid_id)
	{
		$this->load->model('plasmid_model');
		
		if($_SESSION['account'] !== 'admin' && $_SESSION['userid'] !== $plasmid->creator)
		{
			add_error_alert("You do not have permission to change this plasmid " . $plasmid->name);
			redirect('plasmid');			
		}
		
		$this->plasmid_model->remove_sequence($plasmid_id);
		
		redirect('plasmid/view/'.$plasmid_id);
	}

	public function remove_embl($plasmid_id)
	{
		$this->load->model('plasmid_model');
		
		if($_SESSION['account'] !== 'admin' && $_SESSION['userid'] !== $plasmid->creator)
		{
			add_error_alert("You do not have permission to change this plasmid " . $plasmid->name);
			redirect('plasmid');			
		}
		
		$this->plasmid_model->remove_embl($plasmid_id);
		
		redirect('plasmid/view/'.$plasmid_id);
	}
	
	public function remove_genbank($plasmid_id)
	{
		$this->load->model('plasmid_model');
		
		if($_SESSION['account'] !== 'admin' && $_SESSION['userid'] !== $plasmid->creator)
		{
			add_error_alert("You do not have permission to change this plasmid " . $plasmid->name);
			redirect('plasmid');			
		}
		
		$this->plasmid_model->remove_genbank($plasmid_id);
		
		redirect('plasmid/view/'.$plasmid_id);
	}

    public function remove_vectormap($plasmid_id)
    {
		$this->load->model('vectormap_model');
		
		if($_SESSION['account'] !== 'admin' && $_SESSION['userid'] !== $plasmid->creator)
		{
			add_error_alert("You do not have permission to change this plasmid " . $plasmid->name);
			redirect('plasmid');			
		}
		
		$this->vectormap_model->delete_vectormap($plasmid_id);
		
		redirect('plasmid/view/'.$plasmid_id);		
	}

	public function add_sequence($plasmid_id)
	{
		$this->load->model('plasmid_model');
		
		if($_SESSION['account'] !== 'admin' && $_SESSION['userid'] !== $plasmid->creator)
		{
			add_error_alert("You do not have permission to change this plasmid " . $plasmid->name);
			redirect('plasmid');			
		}
		
		if (!empty($_FILES['userfile']['name']))
		{
			$sequence = $this->plasmid_model->upload_sequence();
		
			$this->plasmid_model->update_sequence($plasmid_id, $sequence);
		
			redirect('plasmid/view/'.$plasmid_id);
		}
		
		$data['controller'] = 'plasmid';
		$data['title'] = "Add/Replace Sequence File";
		$data['plasmid'] = $this->plasmid_model->get_plasmid($plasmid_id);
		$this->load->view('add_sequence', $data);
	}

	public function add_embl($plasmid_id)
	{
		$this->load->model('plasmid_model');
		
		if($_SESSION['account'] !== 'admin' && $_SESSION['userid'] !== $plasmid->creator)
		{
			add_error_alert("You do not have permission to change this plasmid " . $plasmid->name);
			redirect('plasmid');			
		}
		
		if (!empty($_FILES['userfile']['name']))
		{
			$plasmid = $this->plasmid_model->upload_embl();
		
			$this->plasmid_model->update_embl($plasmid_id, $plasmid['embl']);
			$this->plasmid_model->update_sequence($plasmid_id, $plasmid['sequence']);
		
			redirect('plasmid/view/'.$plasmid_id);
		}
		
		$data['controller'] = 'plasmid';
		$data['title'] = "Add/Replace EMBL File";
		$data['plasmid'] = $this->plasmid_model->get_plasmid($plasmid_id);
		$this->load->view('add_embl', $data);
	}

	public function add_genbank($plasmid_id)
	{
		$this->load->model('plasmid_model');
		
		if($_SESSION['account'] !== 'admin' && $_SESSION['userid'] !== $plasmid->creator)
		{
			add_error_alert("You do not have permission to change this plasmid " . $plasmid->name);
			redirect('plasmid');			
		}
		
		if (!empty($_FILES['userfile']['name']))
		{
			$plasmid = $this->plasmid_model->upload_genbank();
		
			$this->plasmid_model->update_genbank($plasmid_id, $plasmid['genbank']);
			$this->plasmid_model->update_sequence($plasmid_id, $plasmid['sequence']);
		
			redirect('plasmid/view/'.$plasmid_id);
		}
		
		$data['controller'] = 'plasmid';
		$data['title'] = "Add/Replace Genbank File";
		$data['plasmid'] = $this->plasmid_model->get_plasmid($plasmid_id);
		$this->load->view('add_genbank', $data);
	}

}


?>