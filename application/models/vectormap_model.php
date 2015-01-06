<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vectormap_model extends CI_Model {

	public function get_vectormap($plasmid_id)
	{
		$q = $this
				->db
				->where('plasmid_id', $plasmid_id)
				->limit(1)
				->get('vectormaps');
		
		if ($q->num_rows > 0) {
			return $q->row();
		}
		
		return false;
	}
	
	public function vectormap_exists($plasmid_id)
	{
		$q = $this
				->db
				->select('plasmid_id')
				->where('plasmid_id', $plasmid_id)
				->limit(1)
				->get('vectormaps');
		
		if ($q->num_rows > 0) {
			return true;
		}
		
		return false;
	}

	public function upload_vectormap($plasmid_id)
	{
			//check if directory is writeable
			if(!is_writable(realpath(APPPATH . '../tmp')))
			{
				$_SESSION['error'] = "Directory tmp not writeable, contact the webmaster to set this up.";
				return false;
			}
			
			//session should be started by controller
			ob_start();
		
		
		    $config =  array (
				'allowed_types' => 'gif|png|jpg|jpeg',
				'upload_path' => realpath(APPPATH . '../tmp'),
				'max_size' => 2000			
			);
		
			$this->load->library('upload', $config);
			
			if (! $this->upload->do_upload())
			{
				$_SESSION['error'] = $this->upload->display_errors();
				return false;
			} else {
				$img_data = $this->upload->data();

				$img_file_type = $img_data['file_type'];
				$img_type = $img_data['image_type'];
				$img_width = $img_data['image_width'];
				$img_height = $img_data['image_height'];
				
				$newname = $img_data['file_path'].$plasmid_id.$img_data['file_ext'];
				$thumbname = $img_data['file_path']. $plasmid_id . "_thumb" . $img_data['file_ext'];
				
				if (file_exists($newname)) {unlink($newname); }
				if (file_exists($thumbname)) {unlink($thumbname); }
				
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
				
				//Add data to database
				
				$img_blob = file_get_contents($newname, FILE_USE_INCLUDE_PATH);
				$thumb_blob = file_get_contents($thumbname, FILE_USE_INCLUDE_PATH);
				
				//remove temp files
				unlink($newname);
				unlink($thumbname);
				
				$vectormap_data =  array (
						"plasmid_id" => $plasmid_id,
						"width" => $img_width,
						"height" => $img_height,
						"image_type" => $img_type,
						"file_type" => $img_file_type,
						"image_data" => $img_blob,
						"thumb_width" => 200,
						"thumb_height" => 200,
						"thumb_data" => $thumb_blob
				);
				
				//remove previous copies of the vectormap
				$this->db->where('plasmid_id', $plasmid_id)->delete('vectormaps');
				
				$this->db->insert('vectormaps', $vectormap_data);
				
				$_SESSION['success'] = "Vectormap successfully added !";
				return true;
			}
	}

	public function delete_vectormap($plasmid_id)
	{
		$this->db->where('plasmid_id', $plasmid_id)->delete('vectormaps');
	}

}
?>