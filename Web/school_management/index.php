<?php
    if(!isset($_SESSION)){
        session_start();    
    } 


    include_once("connections/connection.php");
    $con = connection();

    $sql = "SELECT * FROM student_list";
    $students = $con->query($sql) or die ($con->error);
    $row = $students->fetch_assoc();
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
            <h2>
                Record List
            </h2> 
            <form action = "resultindex.php" method = "get">
                <input type = "text" name = "searchindex" id = "searchindex">  
                <button type = "submit">
                    Search
                </button>
            </form>
        <br>
        <a href="userlist.php">
            User List
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