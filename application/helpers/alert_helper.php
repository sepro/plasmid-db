<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function add_alert($type, $text)
{
	if (isset($_SESSION[$type]))
	{
		$_SESSION[$type] = $_SESSION[$type] . "<br />" . $text;
	} else {
		$_SESSION[$type] = $text;
	}
}

function add_error_alert($text)
{
	add_alert('error', $text);
}

function add_success_alert($text)
{
	add_alert('success', $text);
}

function add_info_alert($text)
{
	add_alert('info', $text);
}

function add_warning_alert($text)
{
	add_alert('warning', $text);
}

?>