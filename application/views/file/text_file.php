<?php //Generate text file on the fly

   header("Content-type: text/plain");
   header("Content-Disposition: attachment; filename=$filename");
   echo ">" . $name . "\n";
   echo $content;
?>