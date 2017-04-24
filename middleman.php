<?php
   function logme($filename, $msg)
   {
   // open file
   $fd = fopen($filename, "a");
   // append date/time to message
   $str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg;
   // write string
   fwrite($fd, $str . "\r\n");
   // close file
   fclose($fd);
   }
   logme("L", "w")
   ?>