<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert_model extends CI_Model {
	
	public function get_inserts_for_plasmid($plasmid_id)
	{
		$q = $this
				->db
				->where('plasmid_id',$plasmid_id)
				->get('inserts');
				
		if ($q->num_rows > 0) {

			return $q->result();
		}

		return false;
	}

	public function get_insert($insert_id)
	{
		$q =  $this->db->where('id', $insert_id)->limit(1)->get('inserts');
		if ($q->num_rows > 0) {

			return $q->row();
		}

		return false;
	}
	
	public function insert_insert($insert_data)
	{
		$this->db->insert('inserts', $insert_data);
	}
	
	public function delete_insert($insert_id)
	{
		$this->db->where('id', $insert_id)->delete('inserts');
	}
	
	public function update_insert($id, $insert_data)
	{
		$this->db->where('id', $id)->update('inserts', $insert_data);
	}
	
}
?>