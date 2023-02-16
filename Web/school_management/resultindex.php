<?php

    if(!isset($_SESSION)){
        session_start();    
    }

    error_reporting(E_ERROR | E_PARSE);
    include_once("connections/connection.php");
    $con = connection();
    $search = $_GET['searchindex'];
    $sql = "SELECT * FROM student_list where firstName LIKE '%$search%' || middleName like '%$search%' || lastName like '%$search%' ORDER BY userId ASC";
    $students = $con->query($sql) or die($connection->error);
    $row = $students->fetch_assoc();

    if ($row['userId'] == null) {
        $row['userId'] = " ";   
        $row['firstName'] = " ";  
        $row['middleName'] = " "; 
        $row['lastName'] = " ";
        $row['keyCard'] = " ";  
        $row['timeIn'] = " ";  
        $row['timeOut'] = " "; 
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

    if ($row['timeIn'] == null) {
        $row['timeIn'] = " ";  
    }

    if ($row['timeOut'] == null) {
        $row['timeOut'] = " ";  
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
        <link rel = "stylesheet" href = "css/style.css"> 
    </head>
    <body>
        <center>
            <h1>
                Student Management System
            </h1> 
            <br>
                <form action = "resultindex.php" method = "get">
                    <input type = "text" name = "searchindex" id = "searchindex">  
                    <button type = "submit">
                        Search
                    </button>
                </form>
            <br>
            <a href="index.php">
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
                            Time In
                        </th>
                        <th>
                            Time Out
                        </th>
                    </tr>
                <tbody>
                    <?php do{?>
                    <tr>
                        <td> 
                            <?php echo $row['userId'];?>
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
                            <?php echo $row['timeIn'];?>
                        </td>
                        <td> 
                            <?php echo $row['timeOut'];?>
                        </td>
                    </tr>
                    <?php }while($row = $students->fetch_assoc()); ?>
                </tbody>
                </table>
            </thead>
        </center>
    </body>
</html>