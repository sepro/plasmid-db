<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plasmid_location_model extends CI_Model {

	public function get_plasmid_location($id)
	{
		$q = $this->db->where('id',$id)->limit(1)->get('plasmid_location');
		
		if ($q->num_rows() > 0)
		{
			return $q->row();
		}
		
		return false;
	}
	
	public function get_plasmid_locations($plasmid_id)
	{
		$q = $this->db->where('plasmid_id',$plasmid_id)->get('plasmid_location');
		
		if ($q->num_rows() > 0)
		{
			return $q->result();
		}
		
		return false;
	}

	public function get_plasmids_at_location($location_id)
	{
		$q = $this->db->where('location_id',$location_id)->get('plasmid_location');
		
		if ($q->num_rows() > 0)
		{
			return $q->result();
		}
		
		return false;
	}

	public function get_plasmid_count_per_location()
	{
		$q = $this->db->select('location_id')->select('count(*) as count')->group_by('location_id')->get('plasmid_location');
		
		if ($q->num_rows() > 0)
		{
			$plasmids_per_location = array();
			
			foreach($q->result() as $row)
			{
				$plasmids_per_location[$row->location_id] = $row->count;
			}
			
			return $plasmids_per_location;
		}		
		
		return false;
	}

	public function insert_plasmid_location($plasmid_location_data)
	{
		$this->db->insert('plasmid_location', $plasmid_location_data);
	}

	public function delete_plasmid_location($id)
	{
		$this->db->where('id', $id)->delete('plasmid_location');
	}

	public function update_plasmid_location($id, $data)
	{
		$this->db->where('id', $id)->update('plasmid_location', $data);
	}
	
	public function transfer_plasmids_location($original_location, $new_location)
	{
		$data = array("location_id" => $new_location);
		
		$this->db->where('location_id', $original_location)->update('plasmid_location', $data);	
	}
}

?>