<?php
    include_once("connections/connection.php");
    $con = connection();
    $id = $_GET['ID'];

    $sql = "SELECT * FROM student_users WHERE Id = '$id'";
    $students = $con->query($sql) or die ($con->error);
    $row = $students->fetch_assoc();
    $fullname = $row['firstName'] . " " . $row['middleName'] . " " . $row['lastName'];

    if(isset($_POST['yes'])) {
        $sql = "DELETE FROM student_users where id = '$id'";
        $con->query($sql) or die($connection->error);
        echo header("Location:userlist.php");
    }

    else if(isset($_POST['no'])) {
        echo header("Location:userlist.php");
    }
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
                        <thead>
                            <table>
                                <tr>
                                    <th>
                                        <h1>
                                            Delete <br> <?php echo $fullname;?>???
                                        </h1>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <br>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <button type = "yes" name = "yes">
                                            Yes
                                        </button>
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;
                                        <button type = "no" name = "no">
                                            No
                                        </button>
                                    </th>
                                </tr>
                            </table>
                        </thead>
                    </form>
                </div>
            </div>
        </center>
    </body>
</html>