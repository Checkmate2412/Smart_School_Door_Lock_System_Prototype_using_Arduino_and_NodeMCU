<?php

    if(!isset($_SESSION)){
        session_start();    
    }

    error_reporting(E_ERROR | E_PARSE);
    include_once("connections/connection.php");
    $con = connection();
    $search = $_GET['searchuserlist'];
    $sql = "SELECT * FROM student_users Where firstName LIKE '%$search%' || middleName like '%$search%' || lastName like '%$search%' ORDER BY id DESC";
    $students = $con->query($sql) or die($connection->error);
    $row = $students->fetch_assoc();

    if ($row['id'] == null) {
        $row['id'] = " ";   
        $row['firstName'] = " ";  
        $row['middleName'] = " "; 
        $row['lastName'] = " ";
        $row['keyCard'] = " ";  
        $enabler = "disabled";
    }

    if ($row['firstName'] == null) {
        $row['firstName'] = " ";  
    }

    if ($row['middleName'] == null) {
        $row['middleName'] = " "; 
    }
 
    if ($row['lastName'] == null) {
        $row['lastName'] = " ";
    }

    if ($row['keyCard'] == null) {
        $row['keyCard'] = " "; 
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>
            Student Management System
        </title>
        <style>
            .disabled{
                cursor: default;
                pointer-events: none;        
                text-decoration: none;
                color: grey;
            }
        </style>
        <link rel = "stylesheet" href = "css/style.css"> 
    </head>
    <body>
        <center>
            <h1>
                Student Management System
            </h1> 
            <br>
                <form action = "resultuserlist.php" method = "get">
                    <input type = "text" name = "searchuserlist" id = "searchuserlist">  
                    <button type = "submit">
                        Search
                    </button>
                </form>
            <br>
            <a href="userlist.php">
                Back to List
            </a>
            <br>
            <br>
            <br>
            <br>
            <br>
            <thead>
                <table>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            First Name
                        </th>
                        <th>
                            Middle Name
                        </th>
                        <th>
                            Last name
                        </th>
                        <th>
                            Key Card
                        </th>
                        <th>
                        </th>
                        <th>                  
                        </th>
                    </tr>
                <tbody>
                    <?php do{?>
                        <tr>
                            <td> 
                                <?php echo $row['id'];?>
                            </td>
                            <td> 
                                <?php echo $row['firstName'];?>
                            </td>
                            <td>
                                <?php echo $row['middleName'];?>
                            </td>
                            <td> 
                                <?php echo $row['lastName'];?>
                            </td>
                            <td> 
                                <?php echo $row['keyCard'];?>
                            </td>
                            <td> 
                                <a class="<?php echo $enabler;?>" href="edit.php?ID=<?php echo $row['id'];?>" >
                                    Edit
                                </a>
                            </td>
                            <td> 
                                <a class="<?php echo $enabler;?>" href="delete.php?ID=<?php echo $row['id'];?>" >
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php }while($row = $students->fetch_assoc()); ?>
                </tbody>
                </table>
            </thead>
        </center>
    </body>
</html>