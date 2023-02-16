<?php
    if (!isset($_SESSION)){
        session_start();  
    } 
    include_once("connections/connection.php");
    $con = connection();

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM rfid_accounts WHERE username = '$username' AND password = '$password'";
        $user = $con->query($sql) or die($con->error);
        $row = $user->fetch_assoc();
        $total = $user->num_rows;

        if ($total > 0) {
            $_SESSION['UserLogin'] = $row['username'];
            $_SESSION['Access'] = $row['access'];
            echo header("Location:index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Student Management System
        </title>
        <link rel = "stylesheet" href="css/login.css">  
    </head>
    <body>
        <center>
            <div class = "container-1">
                <div class = "flex-box-container-1">
                    <form action = "" method = "post">
                        <h1>
                            Login Form
                        </h1>  
                        <thead>
                            <table>
                                <tr>
                                    <th>
                                        Username: 
                                    </th>
                                    <th>
                                        <input type = "text" name = "username" id = "username">
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <br>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        Password: 
                                    </th>
                                    <th>
                                        <input type = "text" name = "password" id = "password">
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <br>
                                    </th>
                                </tr>
                            </table>
                        </thead>
                        <button type = "submit" name = "login">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </center>
    </body>
</html>