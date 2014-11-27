<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function parse_genbank($content, $userid)
{
					$name = "";
				$sequence = "";
				$url = "";
				$description = "";
				
				$lines = explode("\n", $content);
				
				$prev_key = NULL;
				
				$data = array();
				
				//FIRST CAPTURE FILE IN DATA STRUCTURE
				foreach($lines as $line)
				{
					$key = trim(substr($line, 0, 12));
					$val = trim(substr($line, 12));
					if (strlen($line) > 0 && $line[0] == " ")
					{
						$key = $prev_key;
						$line = ltrim($line);
					}
					else
					{
						$prev_key = $key;
						$data[$key] = array();
						$line = ltrim($val);
					}
					
					if($line != "")
					{
						array_push($data[$key], $line);
					}
					
				}
				
				foreach($data as $feature => $f_data)
				{
					//LOCUS, contains name 
					if ($feature == "LOCUS")
					{
						$parts = explode(" ", $data[$feature][0]);
						$name = $parts[0];
					}
					
					//ORIGIN, contains sequence
					if ($feature == "ORIGIN")
					{
						foreach ($data[$feature] as $ori_seq)
						{
							$parts = explode(" ", $ori_seq);
							$s_parts = array_shift($parts);
							$s = implode($parts);
							$sequence = $sequence . $s;
						}
					}
					
					//COMMENT, can contain URL
					if ($feature == "COMMENT")
					{
						foreach ($data[$feature] as $comment_line)
						{
								if(filter_var($comment_line, FILTER_VALIDATE_URL))
								{
									$url = $comment_line;
								}
						}
					}

					//FEATURES, extract names and add to description
					if ($feature == "FEATURES")
					{
						$feature_list = array();
						foreach ($data[$feature] as $feature_line)
						{
								if(strpos($feature_line, "/label=") !== FALSE )
								{
									$feature_new = str_replace("/label=", "", $feature_line);
									$feature_new = trim($feature_new, "\"");
									array_push($feature_list, $feature_new);
								}
						}
						
						if (count($feature_list) > 0)
						{
							$description = "Plasmid contains: " . implode(", ", $feature_list);
						}
					}
					
				}
				
				$plasmid = array(
					'name' => $name,
					'creator' => $userid,
					'is_backbone' => 1,
					'backbone' => "None",
					'vector_type' => "Unknown",
					'website' => $url,
					'description' => $description,
					'sequence' => strtoupper($sequence),
					'bacterial_resistance' => "None",
					'plant_resistance' => "None",
					'genbank' => $content
				);
				
				return $plasmid;
}

?>