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

	public function get_user_mail($email)
	{
		$q = $this
				->db
				->where('email', $email)
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
	
	public function create_reset_key($user)
	{
		$key = md5(rand()); //trick to generate a random key
		$timestamp = date('Y-m-d H:i:s');
		
		$data = array(
			'reset_key' => $key,
			'reset_date' => $timestamp
		);
		
		$this->db->where('username', $user)->update('users', $data);
		
		return $key;
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
		$this->load->model('user_model');
		$oldUser = $this->user_model->get_user($user);
		
		//if the account type changed send an email
		if (isset($userdata['account']) && $oldUser->account != $userdata['account'])
		{
			$this->load->model('notification_model');
			$this->notification_model->account_type_changed($oldUser->email);
		}
		
		$this->db->where('username', $user)->update('users', $userdata);
	}
	
	public function reset_password($user)
	{
		$password = substr(md5(rand()), 0, 8);
		
		$data = array (
			"password" => sha1($password)
		);
		
		$this->db->where('username', $user)->update('users', $data);
		
		return $password;
	}
}

?>