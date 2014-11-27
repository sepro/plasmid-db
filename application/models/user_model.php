<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	
	public function list_users()
	{
		$q = $this
				->db
				->get('users');
				
		if ($q->num_rows > 0) {
			$users = array();
			
			foreach($q->result() as $row)
			{
				array_push($users, $row);
			}
			
			//print_r($users);
			return $users;
		}

		return false;
	}

	public function get_users_per_location($location_id)
	{
		$q = $this
				->db
				->where('location', $location_id)
				->get('users');
				
		if ($q->num_rows > 0) {
			$users = array();
			
			foreach($q->result() as $row)
			{
				array_push($users, $row);
			}
			
			return $users;
		}

		return false;
	}

	public function get_users_by_id()
	{
		$q = $this
				->db
				->get('users');
				
		if ($q->num_rows > 0) {
			$output = array();
			
			foreach($q->result() as $row)
			{
				$output[$row->user_id] = $row->first_name . " " . $row->last_name;
			}
			
			return $output;
			
		}

		return false;
	}


	public function get_user($user)
	{
		$q = $this
				->db
				->where('username', $user)
				->limit(1)
				->get('users');
				
		if ($q->num_rows > 0) {

			return $q->row();
		}

		return false;
	}

	public function get_user_id($id)
	{
		$q = $this
				->db
				->where('user_id', $id)
				->limit(1)
				->get('users');
				
		if ($q->num_rows > 0) {

			return $q->row();
		}

		return false;
	}

	public function get_users_at_location($id)
	{
		$q = $this
				->db
				->where('location', $id)
				->get('users');
				
		if ($q->num_rows > 0) {

			$users = array();
			
			foreach ($q->result() as $row)
			{
				array_push($users, $row);
			}
			
			return $users;
		}

		return false;
	}
	
	public function get_user_count_per_location()
	{
		$q = $this->db->select('location')->select('count(*) as count')->group_by('location')->get('users');
		
		if($q->num_rows > 0)
		{
			$users_per_location = array();
			
			foreach ($q->result() as $row)
			{
				$users_per_location[$row->location] = $row->count;
			}
			
			return $users_per_location;
			
		}
		return false;
	}
	
	public function count_users()
	{
		$q = $this
				->db
				->select('COUNT(*) AS user_count')
				->from('users')
				->get();
				
		if($q->num_rows > 0)
		{
			$row =  $q->row();
			return $row->user_count;
		}
		
		return false;
	}
	
	public function delete_user($user)
	{
		$this->db->where('username', $user)->delete('users');
	}
	
	public function insert_user($user)
	{
		$this->db->insert('users', $user);
	}
	
	public function update_user($user, $userdata)
	{
		$this->db->where('username', $user)->update('users', $userdata);
	}
	
}

?>