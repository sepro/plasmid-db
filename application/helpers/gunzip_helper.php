<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function gunzip($file_name, $file_out) 
{
	// Raising this value may increase performance
	$buffer_size = 4096; // read 4kb at a time
	// Open our files (in binary mode)
	$file = gzopen($file_name, 'rb');
	$out_file = fopen($file_out, 'wb'); 
	// Keep repeating until the end of the input file
	while(!gzeof($file)) {
		// Read buffer-size bytes
		// Both fwrite and gzread and binary-safe
  		fwrite($out_file, gzread($file, $buffer_size));
	}  
	// Files are done, close files
	fclose($out_file);
	gzclose($file);
}
?>