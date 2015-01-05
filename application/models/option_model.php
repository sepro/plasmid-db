<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Option_model extends CI_Model {
	
	public function get_options()
	{
		$q = $this->db->order_by('option_name', 'asc')->get('options');
		
		if ($q->num_rows > 0) {
			$options = array();
			
			foreach($q->result() as $row)
			{
				array_push($options, $row);
			}	
			
			return $options;
		}
		
		return false;
	}
	
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
	
	public function option_exists($option_name, $possible_value)
	{
		$q = $this->db->where(array('option_name' =>  $option_name, 'possible_value' => $possible_value))->get('options');
		
		if ($q->num_rows > 0)
		{
			return true;
		}
		
		return false;
	}
	
	public function add_option($option_name, $possible_value)
	{
		if (!$this->option_exists($option_name, $possible_value))
		{
			$this->db->insert('options', array('option_name' =>  $option_name, 'possible_value' => $possible_value));
		}
		
		return false;
	}
	
	public function delete_option($id)
	{
		$this->db->where('id', $id)->delete('options');
	}
}

?>