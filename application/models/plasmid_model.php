<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plasmid_model extends CI_Model {
	
	public function list_plasmids()
	{
		$q = $this
				->db
				->select('*')
				->from('plasmids')
				->join('users', "plasmids.creator = users.user_id", 'left')
				->get();
		
		//echo $this->db->last_query();
		
		$plasmids = array();
		
		if ($q->num_rows > 0) {

			foreach($q->result() as $row) {
				array_push($plasmids, $row);
			}
			
			return $plasmids;
		}
		
		return false;
	}

	public function get_plasmids_from_location($location_id)
	{
		$q = $this
				->db
				->select('*')
				->from('plasmid_location')
				->join('plasmids', 'plasmid_location.plasmid_id = plasmids.plasmid_id', 'left')
				->join('users', "plasmids.creator = users.user_id", 'left')
				->where('location_id', $location_id)
				->get();
		
		if ($q->num_rows > 0) {
			$plasmids = array();
			foreach($q->result() as $row) {
				array_push($plasmids, $row);
			}
			return $plasmids;
		}
		
		return false;	
	}

	public function get_plasmids_creator($id)
	{
		$q = $this
				->db
				->where('creator', $id)
				->get('plasmids');
		
		$plasmids = array();
		
		if ($q->num_rows > 0) {

			foreach($q->result() as $row) {
				array_push($plasmids, $row);
			}
			
			return $plasmids;
		}
		
		return false;
	}
	
	public function get_plasmid($id)
	{
		$q = $this
				->db
				->where('plasmid_id', $id)
				->limit(1)
				->get('plasmids');
				
		if ($q->num_rows > 0) {
			return $q->row();
		}
		
		return false;
	}
	
	public function get_plasmid_id($name)
	{
		$q = $this
				->db
				->where('name', $name)
				->limit(1)
				->get('plasmids');
				
		if ($q->num_rows > 0) {
			return $q->row()->plasmid_id;
		}
		
		return false;
	}
	
	public function get_plasmids_backbone($backbone_id)
	{
		$q = $this
				->db
				->where('backbone', $backbone_id)
				->get('plasmids');
				
		if ($q->num_rows > 0) {
			return $q->result();
		}
		
		return false;
	}
	
	public function get_backbones()
	{
		$q = $this
				->db
				->where('is_backbone', 1)
				->get('plasmids');
				
		if ($q->num_rows > 0) {
			
			$output = array();
			foreach($q->result() as $row)
			{
				$output[$row->plasmid_id] = $row->name;
			}
			
			return $output;
		}
		
		return false;		
	}
	
	public function get_locations($id)
	{
		$q = $this
				->db
				->select('*')
				->from('plasmid_location')
				->join('locations', 'plasmid_location.location_id = locations.location_id', 'left')
				->where('plasmid_id', $id)
				->get();
				
		$locations = array();
		
		if ($q->num_rows > 0) {
			
			foreach($q->result() as $row) {
				array_push($locations, $row);
			}
			return $locations;
			
		}
		
		return false;	
	}

	public function plasmid_exists($name)
	{
		$q = $this
				->db
				->where('name', $name)
				->get('plasmids');
				
		return ($q->num_rows > 0);
	}

	public function search_plasmid($keyword)
	{
		$where = "`name` LIKE \"%$keyword%\" OR `description` LIKE \"%$keyword%\" OR `bacterial_resistance` LIKE \"%$keyword%\" OR `plant_resistance` LIKE \"%$keyword%\" OR `genbank` LIKE \"%$keyword%\"";
		
		
		$q = $this->db->where($where)->get('plasmids');
		
		if($q->num_rows > 0)
		{
			$plasmids = array();
			foreach($q->result() as $row)
			{
				array_push($plasmids, $row);
			}
			return $plasmids;
		}
		
		return false;
	}

	public function upload_vectormap($plasmid_id)
	{
			//check if directory is writeable
			if(!is_writable(realpath(APPPATH . '../img/vectormaps')))
			{
				$_SESSION['error'] = "Directory img/vectormaps not writeable, contact the webmaster to set this up.";
				return false;
			}
			//session should be started by controller
			ob_start();
		
		
		    $config =  array (
				'allowed_types' => 'gif|png|jpg|jpeg',
				'upload_path' => realpath(APPPATH . '../img/vectormaps'),
				'max_size' => 2000			
			);
		
			$this->load->library('upload', $config);
			
			if (! $this->upload->do_upload())
			{
				$_SESSION['error'] = $this->upload->display_errors();
				return false;
			} else {
				$img_data = $this->upload->data();

				$newname = $img_data['file_path'].$plasmid_id.$img_data['file_ext'];
				$thumbname = $img_data['file_path']. $plasmid_id . "_thumb" . $img_data['file_ext'];
				
				if (file_exists($img_data['file_path'].$plasmid_id. ".png")) {unlink($img_data['file_path'].$plasmid_id. ".png"); }
				if (file_exists($img_data['file_path'].$plasmid_id. "_thumb.png")) {unlink($img_data['file_path'].$plasmid_id. "_thumb.png"); }
				if (file_exists($img_data['file_path'].$plasmid_id. ".jpg")) {unlink($img_data['file_path'].$plasmid_id. ".jpg"); }
				if (file_exists($img_data['file_path'].$plasmid_id. "_thumb.jpg")) {unlink($img_data['file_path'].$plasmid_id. "_thumb.jpg"); }
				if (file_exists($img_data['file_path'].$plasmid_id. ".jpeg")) {unlink($img_data['file_path'].$plasmid_id. ".jpeg"); }
				if (file_exists($img_data['file_path'].$plasmid_id. "_thumb.jpeg")) {unlink($img_data['file_path'].$plasmid_id. "_thumb.jpeg"); }
				if (file_exists($img_data['file_path'].$plasmid_id. ".gif")) {unlink($img_data['file_path'].$plasmid_id. ".gif"); }
				if (file_exists($img_data['file_path'].$plasmid_id. "_thumb.gif")) {unlink($img_data['file_path'].$plasmid_id. "_thumb.gif"); }
				
				rename($img_data['full_path'], $newname);
				
				//file uploaded and renamed now create a thumbnail version
				
				$thumb_config = array(
					'source_image' => $newname,
					'new_image' => $thumbname,
					'maintain_ration' => true,
					'width' => 200,
					'height' => 200
				);
				
				$this->load->library('image_lib', $thumb_config);
				$this->image_lib->resize();
				
				$_SESSION['success'] = "Vectormap successfully added !";
				return true;
			}
	}
	
	public function upload_sequence()
	{
			if(!is_writable(realpath(APPPATH . '../tmp')))
			{
				$_SESSION['error'] = "Directory tmp not writeable, contact the webmaster to set this up.";
				return false;
			}
			//session should be started by controller
			ob_start();		
			
		    $config =  array (
				'allowed_types' => '*',
				'upload_path' => realpath(APPPATH . '../tmp'),
				'max_size' => 2000			
			);

		
			$this->load->library('upload', $config);
			
			if (! $this->upload->do_upload())
			{
				$_SESSION['error'] = $this->upload->display_errors();
				return false;
			} else {
				$sequence_data = $this->upload->data();
				
				//generate safe filename
				$filename = $sequence_data['file_path'].strval(sha1(strval(microtime(true))."_".$_SESSION['username'])).".txt";
				
				rename($sequence_data['full_path'], $filename);
				
				//parse gb file and add to database
				
				$content = file_get_contents($filename, FILE_USE_INCLUDE_PATH);
				$sequence = str_replace("\r", "", $content);						//PHP equivalent of dos2unix
				
				
				unlink($filename);	//remove file after parsing
				
				
				$_SESSION['success'] = "Sequence file successfully uploaded!";
				return $sequence;
			}			
			
	}
	
	public function upload_genbank()
	{
			$this->load->helper('genbank');
			
			if(!is_writable(realpath(APPPATH . '../tmp')))
			{
				$_SESSION['error'] = "Directory tmp not writeable, contact the webmaster to set this up.";
				return false;
			}
			
			//session should be started by controller
			ob_start();
		
		    $config =  array (
				'allowed_types' => '*',
				'upload_path' => realpath(APPPATH . '../tmp'),
				'max_size' => 2000			
			);
		
			$this->load->library('upload', $config);
			
			if (! $this->upload->do_upload())
			{
				$_SESSION['error'] = $this->upload->display_errors();
				return false;
			} else {
				$gb_data = $this->upload->data();
				
				//generate safe filename
				$filename = $gb_data['file_path'].strval(sha1(strval(microtime(true))."_".$_SESSION['username'])).".gb";
				
				rename($gb_data['full_path'], $filename);
				
				//parse gb file and add to database
				
				$content = file_get_contents($filename, FILE_USE_INCLUDE_PATH);
				$content = str_replace("\r", "", $content);						//PHP equivalent of dos2unix
				
				$plasmid = parse_genbank($content, $_SESSION['userid']);
				
				unlink($filename);	//remove file after parsing
				
				
				$_SESSION['success'] = "GenBank file successfully uploaded!";
				return $plasmid;
			}
	}

	public function upload_embl()
	{
			$this->load->helper('embl');
			
			if(!is_writable(realpath(APPPATH . '../tmp')))
			{
				$_SESSION['error'] = "Directory tmp not writeable, contact the webmaster to set this up.";
				return false;
			}
			
			//session should be started by controller
			ob_start();
		
		    $config =  array (
				'allowed_types' => '*',
				'upload_path' => realpath(APPPATH . '../tmp'),
				'max_size' => 2000			
			);
		
			$this->load->library('upload', $config);
			
			if (! $this->upload->do_upload())
			{
				$_SESSION['error'] = $this->upload->display_errors();
				return false;
			} else {
				$embl_data = $this->upload->data();
				
				//generate safe filename
				$filename = $embl_data['file_path'].strval(sha1(strval(microtime(true))."_".$_SESSION['username'])).".embl";
				
				rename($embl_data['full_path'], $filename);
				
				//parse gb file and add to database
				
				$content = file_get_contents($filename, FILE_USE_INCLUDE_PATH);
				$content = str_replace("\r", "", $content);						//PHP equivalent of dos2unix
				
				$plasmid = parse_embl($content, $_SESSION['userid']);
				
				unlink($filename);	//remove file after parsing
				
				
				$_SESSION['success'] = "EMBL file successfully uploaded!";
				return $plasmid;
			}
	}

	public function insert_plasmid($plasmid_data)
	{
		$this->db->insert('plasmids', $plasmid_data);
	}

	public function delete_plasmid($id)
	{
		$this->db->where('plasmid_id', $id)->delete('plasmids');
	}
	
	public function update_plasmid($id, $plasmid_data)
	{
		$this->db->where('plasmid_id', $id)->update('plasmids', $plasmid_data);
	}
	
	public function remove_sequence($plasmid_id)
	{
		$data = array("sequence" => "");
		
		$this->update_plasmid($plasmid_id, $data);
	}

	public function remove_vectormap($plasmid_id)
	{
		if(!is_writable(realpath(APPPATH . '../img/vectormaps/')))
		{
			$_SESSION['error'] = "Directory img/vectormaps/ not writeable, contact the webmaster to set this up.";
			return false;
		}
		
		$img_path = realpath(APPPATH . '../img/vectormaps/');
		$img_path = $img_path . "/" . $plasmid_id; 
		if (file_exists($img_path. ".png")) {unlink($img_path. ".png"); }
		if (file_exists($img_path. "_thumb.png")) {unlink($img_path. "_thumb.png"); }
		if (file_exists($img_path. ".jpg")) {unlink($img_path. ".jpg"); }
		if (file_exists($img_path. "_thumb.jpg")) {unlink($img_path. "_thumb.jpg"); }
		if (file_exists($img_path. ".jpeg")) {unlink($img_path. ".jpeg"); }
		if (file_exists($img_path. "_thumb.jpeg")) {unlink($img_path. "_thumb.jpeg"); }
		if (file_exists($img_path. ".gif")) {unlink($img_path. ".gif"); }
		if (file_exists($img_path. "_thumb.gif")) {unlink($img_path. "_thumb.gif"); }		
	}

	public function remove_embl($plasmid_id)
	{
		$data = array("embl" => "");
		
		$this->update_plasmid($plasmid_id, $data);
	}

	public function remove_genbank($plasmid_id)
	{
		$data = array("genbank" => "");
		
		$this->update_plasmid($plasmid_id, $data);
	}

	public function update_sequence($plasmid_id, $sequence)
	{
		$data = array("sequence" => $sequence);
		
		$this->update_plasmid($plasmid_id, $data);
	}
	
	public function update_embl($plasmid_id, $embl)
	{
		$data = array("embl" => $embl);
		
		$this->update_plasmid($plasmid_id, $data);
	}	
	
	public function update_genbank($plasmid_id, $genbank)
	{
		$data = array("genbank" => $genbank);
		
		$this->update_plasmid($plasmid_id, $data);
	}
	
	public function transfer_plasmids($original_user, $new_user)
	{
		$data = array("creator" => $new_user);
		
		$this->db->where('creator', $original_user)->update('plasmids', $data);	
	}
	
}

?>
