<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailtest extends CI_Controller {




	public function index()
	{

		
		$config = array (
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'oldeeeminer@gmail.com',
			'smtp_pass' => 'primecoinminer'
		);

		$this->load->library('email', $config);
		
		$this->email->from('oldeeeminer@gmail.com');
		$this->email->to('proost@mpimp-golm.mpg.de');
		$this->email->subject('Email Test');
		$this->email->message('Quick test to see if this works with the current setup');
		
		if ($this->email->send())
		{
			echo('Email sent!');
		} else {
			 show_error($this->email->print_debugger());
		}
		
	}
}


?>