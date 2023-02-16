<?php
    if(!isset($_SESSION)){
        session_start();    
    } 


    include_once("connections/connection.php");
    $con = connection();

    $sql = "SELECT * FROM student_users";
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
                User List
            </h2> 
                <form action = "resultuserlist.php" method = "get">
                    <input type = "text" name = "searchuserlist" id = "searchuserlist">  
                    <button type = "submit">
                        Search
                    </button>
                </form>
            <br>
            <a href="add.php">
                Add
            </a>
            &nbsp;
            &nbsp;
            &nbsp;
            <a href="index.php">
                Record List
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
                                <a href="edit.php?ID=<?php echo $row['id'];?>">
                                    Edit
                                </a>
                            </td>
                            <td> 
                                <a href="delete.php?ID=<?php echo $row['id'];?>">
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