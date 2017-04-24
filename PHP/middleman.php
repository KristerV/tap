<?php
// get database login details from file
   include("dbinfo.inc.php");
// get values from the http link
   $ques = $_GET['q'];
   $ans = $_GET['a'];
   $usr = $_GET['u'];

//connect to MySQL and select database
   mysql_connect($mysql,$username,$password);
   @mysql_select_db($database) or die( "Unable to select database"); 
   
//check if User has already submitted the question, if so DELETE
   $exists_query = "SELECT * FROM $table WHERE question = '$ques' AND userID ='$usr'";
   $exists_result = mysql_query($exists_query) or die(mysql_error());
   $delete_query = "DELETE FROM $table WHERE question = '$ques' AND userID ='$usr'";
   $delete_result = mysql_query($delete_query) or die(mysql_error());
   if (mysql_num_rows($exists_result)>0) {
   $delete_result;
   }

// insert new entry (if there already was one, it has been deleted by now)
   $date = date('Y-m-d');
   $query = "INSERT INTO Main VALUES ('$ques','$usr','$ans','$date')";
   mysql_query($query);
   
// find out how many percent of the answers are Yes, and return it to the App
   $select_yes="SELECT * FROM $table WHERE question = '$ques' AND answer = 'y'";
   $select_all="SELECT * FROM $table WHERE question = '$ques'";
   $get_yes=mysql_query($select_yes);
   $get_all=mysql_query($select_all);
   $num_yes = mysql_num_rows($get_yes);
   $num_all = mysql_num_rows($get_all);
   $percent = round($num_yes/$num_all*100);
   echo $percent;

// close MySQL connection
   mysql_close();
   
// log stuff into a file
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
   logme("logMain.txt", "user:" . $_GET['u'] . "_question:" . $_GET['q'] . "_answer:" . $_GET['a']);
   //logme("logMain.txt", " TO DATABASE\r\n" . $result . "\r\n");
   
   
   
   
   
   
   ?>