<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends CI_Model {
	
	public function list_locations()
	{
		$q = $this
				->db
				->get('locations');
				
		if ($q->num_rows > 0) {
			$locations = array();
			
			foreach($q->result() as $row)
			{
				array_push($locations, $row);
			}
			
			//print_r($users);
			return $locations;
		}

		return false;
	}

	public function get_locations()
	{
		$q = $this
				->db
				->get('locations');
				
		if ($q->num_rows > 0) {
			$output = array();
			
			foreach ($q->result() as $row)
			{
				$output[$row->location_id] = $row->building . " " . $row->room;
			}
			
			return $output;
		}

		return false;
	}

	public function get_location($id)
	{
		$q = $this
				->db
				->where('location_id', $id)
				->limit(1)
				->get('locations');
				
		if ($q->num_rows > 0) {

			return $q->row();
		}

		return false;
	}
	
	public function count_locations()
	{
		$q = $this
				->db
				->select('COUNT(*) AS location_count')
				->from('locations')
				->get();
				
		if($q->num_rows > 0)
		{
			$row =  $q->row();
			return $row->user_count;
		}
		
		return false;
	}
	
	public function delete_location($id)
	{
		$this->db->where('location_id', $id)->delete('locations');
	}
	
	public function insert_location($data)
	{
		$this->db->insert('locations', $data);
	}
	
	public function update_location($id, $data)
	{
		$this->db->where('location_id', $id)->update('locations', $data);
	}
	
}

?>