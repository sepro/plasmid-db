<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model {
	
	public function new_user($user)
	{
			$this->config->load('email');
			$this->load->library('email');
			
			if ($this->config->item('send_notifications'))
			{
				$this->email->from($this->config->item('notification_from'));
				$this->email->to($this->config->item('notification_to'));
				$this->email->subject('[PlasmidDB]New User Registered:' . $user);
				$this->email->message('A new user registered, the account is pending your approval.\n\nPlease log into the website and set the new user\'s permissions.');
				
				$this->email->send();
			}
	}
	
	public function registration_success($email)
	{
			$this->config->load('email');
			$this->load->library('email');
			if ($this->config->item('send_notifications'))
			{			
				$this->email->from($this->config->item('notification_from'));
				$this->email->to($email);
				$this->email->subject('[PlasmidDB]Registration Successful!');
				$this->email->message('You successfully registered for a PlasmidDB account. Before you can use your account an administrator will need to approve your account. You will be notified as soon as this is completed.');
				
				$this->email->send();
			}
	}
	
	public function account_type_changed($email)
	{
			$this->config->load('email');
			$this->load->library('email');
			if ($this->config->item('send_notifications'))
			{			
				$this->email->from($this->config->item('notification_from'));
				$this->email->to($email);
				$this->email->subject('[PlasmidDB]Account Type Changed');
				$this->email->message('An administrator changed your account type. If you were awaiting approval the account should now be active!');
				
				$this->email->send();
			}
	}
}
