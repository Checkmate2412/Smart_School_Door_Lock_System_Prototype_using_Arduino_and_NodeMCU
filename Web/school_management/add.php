<?php
        include_once("connections/connection.php");
        $con = connection();

        if (isset($_POST['submit'])) {  
                $firstname = $_POST['firstname'];
                $middlename = $_POST['middlename'];
                $lastname = $_POST['lastname'];
                $keycard = $_POST['keycard'];
                $sql ="INSERT INTO `student_users` (`firstname`, `middlename`, `lastname`, `keycard`) 
                VALUES ('$firstname', '$middlename', '$lastname', '$keycard')";
                $con->query($sql) or die  ($con->error);
                echo header("location:userlist.php");
        }

        if(isset($_POST['back']))
            echo header("location:userlist.php");
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>
                Student Management System
        </title>
        <link rel = "stylesheet" href = "css/login.css">  
    </head>
    <body>
        <center>
            <div class="container-1">
                <div class="flex-box-container-1">
                    <form action = "" method = "post">
                        <h1>
                            Add RFID User
                        </h1>  
                        <thead>
                            <table>
                                <tr>
                                    <th>
                                        First Name: 
                                    </th>
                                    <th>
                                        <input type = "text" name = "firstname" id = "firstname">
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <br>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        Middle Name: 
                                    </th>
                                    <th>
                                        <input type = "text" name = "middlename" id = "middlename">
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <br>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        Last Name: 
                                    </th>
                                    <th>
                                        <input type = "text" name = "lastname" id = "lastname">
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <br>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                       Key Card: 
                                    </th>
                                    <th>
                                        <input type = "text" name = "keycard" id = "keycard">
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <br>
                                    </th>
                                </tr>
                            </table>
                        </thead>
                        <button type = "submit" name = "submit">
                            Add
                        </button>
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        <button type = "update" name = "back" value = "back">
                            Back
                        </button>
                    </form>
                </div>
            </div>
        </center>
    </body>
</html>