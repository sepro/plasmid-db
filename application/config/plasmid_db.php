<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
	Plasmid DB configuration
	
	$config['autologin'] 		Set to TRUE to log in a user automatically
	$config['autologinuser']	username of the user to login automatically

	$config['demonstration']	Should be used with an auto logged in guest account --> enableling this prevents the user to change his settings.

*/
                       
$config['autologin']        = FALSE;
$config['autologinuser']	= 'autouser';

$config['demonstration']	= FALSE;

$config['plasmids_per_page']= 10; 