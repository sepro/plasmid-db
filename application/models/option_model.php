<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Option_model extends CI_Model {
	
	public function get_options_hash($options)
	{
		$q = $this
				->db
				->where('option_name', $options)
				->order_by('possible_value', 'asc')
				->get('options');
				
		if ($q->num_rows > 0) {
			
			$output = array();
			
			foreach($q->result() as $row)
			{
				$output[$row->possible_value] = $row->possible_value;
			}
			
			return $output;
		}
		
		return false;
	}
	
}

?>