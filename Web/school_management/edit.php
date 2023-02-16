<?php
    include_once("connections/connection.php");
    $con = connection();
    $id = $_GET['ID'];

    $sql = "SELECT * FROM student_users WHERE Id = '$id'";
    $students = $con->query($sql) or die ($con->error);
    $row = $students->fetch_assoc();

    if(isset($_POST['update'])){
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $sql = "UPDATE student_users set firstName = '$firstname', middleName = '$middlename', lastName = '$lastname' where id = '$id'";
        $con->query($sql) or die($con->error);
        echo header("location:userlist.php?ID=".$id);
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
                            Edit RFID User
                        </h1>  
                        <thead>
                            <table>
                                <tr>
                                    <th>
                                        First Name: 
                                    </th>
                                    <th>
                                        <input type = "text" name = "firstname" id = "firstname" value = <?php echo $row['firstName'];?>>
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
                                        <input type = "text" name = "middlename" id = "middlename" value = <?php echo $row['middleName'];?>>
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
                                        <input type = "text" name = "lastname" id = "lastname" value = <?php echo $row['lastName'];?>
                                    </th>
                                </tr>
                            </table>
                        </thead>
                        <br>
                        <br>
                        <button type = "update" name = "update" value = "update">
                            Update
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
</html>