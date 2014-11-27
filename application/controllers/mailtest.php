<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailtest extends CI_Controller {




	public function index()
	{
		$config = Array(
    		'protocol' => 'mail',
    		'smtp_host' => '',
    		'smtp_port' => 25,
    		'smtp_user' => '',
    		'smtp_pass' => '',
    		'mailtype'  => 'html', 
    		'charset'   => 'iso-8859-1'
		);

		$this->load->library('email', $config);
		
		$this->email->from('oldeeeminer@gmail.com');
		$this->email->to('sebastian.proost@gmail.com');
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