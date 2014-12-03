<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        
        // load email model and libraryused by all functions
        $this->config->load('email');
		$this->load->library('email');
    }
	
	public function new_user($user)
	{
			if ($this->config->item('send_notifications'))
			{
				$this->email->from($this->config->item('notification_from'));
				$this->email->to($this->config->item('notification_to'));
				$this->email->subject('Plasmid DB: New User (' . $user . ') registered.');
				$this->email->message('A new user (' . $user . ') registered, the account is pending your approval. Please log into the website and set the new user\'s permissions.');
				
				$this->email->send();
			}
	}
	
	public function registration_success($email)
	{
			if ($this->config->item('send_notifications'))
			{			
				$this->email->from($this->config->item('notification_from'));
				$this->email->to($email);
				$this->email->subject('Plasmid DB: Registration Successful!');
				$this->email->message('You successfully registered for a PlasmidDB account. Before you can use your account an administrator will need to approve your account. You will be notified as soon as this is completed.');
				
				$this->email->send();
			}
	}
	
	public function account_type_changed($email)
	{
			if ($this->config->item('send_notifications'))
			{			
				$this->email->from($this->config->item('notification_from'));
				$this->email->to($email);
				$this->email->subject('Plasmid DB: Account Type Changed');
				$this->email->message('An administrator changed your account type. If you were awaiting approval the account should now be active!');
				
				$this->email->send();
			}
	}
	
	public function password_reset_requested($user, $url, $email)
	{
			$this->email->from($this->config->item('notification_from'));
			$this->email->to($email);
			$this->email->subject('Plasmid DB: Reset Password');
			$this->email->message('A new password was requested for your account (' . $user . '). Please got to ' . $url . ' to confirm the reset and a new password will be mailed to you. (This link will be valid for 48 hours)');	
			
			$this->email->send();				
	}

	public function password_reset($password, $email)
	{
			$this->email->from($this->config->item('notification_from'));
			$this->email->to($email);
			$this->email->subject('Plasmid DB: New Password');
			$this->email->message('Your Plasmid DB password has been reset. Your new password is ' . $password);	
			
			$this->email->send();				
	}
	
	public function recover_username($user, $email)
	{
			$this->email->from($this->config->item('notification_from'));
			$this->email->to($email);
			$this->email->subject('Plasmid DB: Your username');
			$this->email->message('Your Plasmid DB username is : ' . $user);	
			
			$this->email->send();					
	}
}
