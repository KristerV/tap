<?php
   include("dbinfo.inc.php");
   $ques = $_GET['q'];
   $ans = $_GET['a'];
   $usr = $_GET['u'];

   mysql_connect($mysql,$username,$password);
   @mysql_select_db($database) or die( "Unable to select database"); 

   $query = "INSERT INTO Main VALUES ('$ques','$usr','$ans','')";
   if (mysql_query($query))
  {
  echo $percent;
  }
else
  {
  echo "Entry error: " . mysql_error();
  }
  
   $select_yes="SELECT * FROM $table WHERE question = '$ques' AND answer = 'y'";
   $select_all="SELECT * FROM $table WHERE question = '$ques'";
   $get_yes=mysql_query($select_yes);
   $get_all=mysql_query($select_all);
   $num_yes = mysql_num_rows($get_yes);
   $num_all = mysql_num_rows($get_all);
   $percent = round($num_yes/$num_all*100);
   
   if (round($get_yes/$get_all*100)<101)
  {
  echo "\r\nSelect successful" . "\r\n" . $percent . "\r\n$num_yes" . "\r\n$num_all";
  }
else
  {
  echo "\r\nSelect error: " . mysql_error() . $percent . "\r\n$num_yes" . "\r\n$num_all";
  }
   mysql_close();
   
   
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
   logme("logMain.txt", " FROM APP" . "\r\nuser:     " . $_GET['u'] . "\r\nquestion: " . $_GET['q'] . "\r\nanswer:   " . $_GET['a']);
   //logme("logMain.txt", " TO DATABASE\r\n" . $result . "\r\n");
   
   
   
   
   
   
   ?>