<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	public function verifty_user($user, $password)
	{
		$q = $this
				->db
				->where('username', $user)
				->where('password', sha1($password))
				->limit(1)
				->get('users');
				
		if ($q->num_rows > 0) {
			//print_r($q->row());
			return $q->row();
		}
		
		return false;
	}
	
}

?>