<?php

if(!isset($_SESSION)){
   session_start();    
}
   include_once("connections/connection.php");
   $con = connection();
   $card = $_GET['keyCard'];
   $sql = "SELECT count(*) FROM `student_users` WHERE `keyCard` = '$card'";
   $students = $con->query($sql) or die ($con->error);
   $row = $students->fetch_assoc();
   $answer = "";
   $answer = implode(", ", $row);

   if ($answer == "1") {
      echo "OK";
   }

   else if ($answer == "0") {
      echo "NO";
   }
?>