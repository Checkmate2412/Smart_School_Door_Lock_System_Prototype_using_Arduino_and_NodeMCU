<?php

if(!isset($_SESSION)){
   session_start();    
}
   include_once("connections/connection.php");
   $con = connection();
   $card = $_GET['keyCard'];

   $sql = "SELECT * FROM student_users where keyCard = '$card'";
   $students = $con->query($sql) or die($con->error);
   $row = $students->fetch_assoc();
   
   $firstname = $row['firstName'];
   $middlename = $row['middleName'];
   $lastname = $row['lastName'];
   $keycard = $row['keyCard'];

   $sql1 = "SELECT count(*) FROM `student_list` WHERE `timeOut` = '' AND `keyCard` = '$card'";
   $students1 = $con->query($sql1) or die ($con->error);
   $row1 = $students1->fetch_assoc();
   $answer = "";
   $answer = implode(", ", $row1);
   $time = date("g:i:s a, M-d-Y");

   if ($answer == 1) {   
      $sql2 = "SELECT * FROM `student_list` WHERE `timeOut` IS NULL OR `timeOut` = '' 
      AND keyCard = '$card';";
      $con->query($sql2) or die  ($con->error);
      $students2 = $con->query($sql2) or die($con->error);
      $row2 = $students2->fetch_assoc();

      $id = $row2['userId'];

      $sql3 = "UPDATE student_list set `firstName` = '$firstname', `middleName` = '$middlename', `lastName` = '$lastname',
      `timeOut` = '$time' where userId = '$id'";
      $con->query($sql3) or die($con->error);
   }

   else if ($answer == 0) {
      $sql4 ="INSERT INTO `student_list` (`firstname`, `middlename`, `lastname`, `keycard`, `timeIn`) 
      VALUES ('$firstname', '$middlename', '$lastname', '$keycard', '$time')";
      $con->query($sql4) or die  ($con->error);
   }
?>