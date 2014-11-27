<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory_model extends CI_Model {
	
	public function get_inventory($location_id)
	{
		/*$q = $this
				->db->select('building, room, name, label, username')
				->order_by('building, room')
				->get('view_plasmids');*/
				
		$q = $this
				->db->select('name, label, comment, first_name, last_name')
				->from('plasmid_location')
				->join('plasmids', 'plasmid_location.plasmid_id = plasmids.plasmid_id', 'left')
				->join('locations', 'plasmid_location.location_id = locations.location_id', 'left')
				->join('users', 'plasmids.creator = users.user_id', 'left')
				->where('plasmid_location.location_id', $location_id)
				->order_by('building, room')->get();
				
				
		if ($q->num_rows > 0) {
			return $q;
		}

		return false;
	}
}
?>