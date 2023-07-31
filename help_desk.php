<<<<<<< HEAD
=======

>>>>>>> 520c49c (Updates)
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "help_desk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully\n";


// Adds a row
<<<<<<< HEAD
// $sql = "INSERT INTO `queue_list` (`User`, `EmployeeID`, `Problem`) VALUES ('Person', 0, 'I am dumb')";
// mysqli_query($conn, $sql);

// Selescts all data in a table 
$sql = "SELECT * FROM `queue_list`
        WHERE User = 'Person'";
=======
// $sql = "INSERT INTO `queue_list` (`User`, `EmployeeID`, `Problem`) VALUES ('Lance', 2, 'I am dumb')";
// mysqli_query($conn, $sql);

// Selescts all data in a table 
$sql = "SELECT * FROM `queue_list`";
>>>>>>> 520c49c (Updates)


$result = ($conn->query($sql));
    //declare array to store the data of database
    $row = []; 
  
    if ($result->num_rows > 0) 
    {
        // fetch all data from db into array 
        $row = $result->fetch_all(MYSQLI_ASSOC);  
    }   
?>


<!DOCTYPE html>
<html>
<style>
    td,th {
<<<<<<< HEAD
        border: 1px solid black;
        padding: 10px;
        margin: 5px;
        text-align: center;
    }
</style>
  
<body>
    <h1 align = "center">Queue List</h1>
=======
        border: 2px solid black;
        padding: 50px;
        margin: 5px;
        text-align: center;
        font-size: 35px;
    }
    h1 {
        text-align: center;
        font-size: 50px;
    }
</style>
<body>
    <h1>Check-In List</h1>
>>>>>>> 520c49c (Updates)
    <table align = "center">
        <thead>
            <tr>
                <th>User</th>
                <th>EmployeeID</th>
                <th>Problem</th>
            </tr>
        </thead>
        <tbody>
            <?php
               if(!empty($row))
               foreach($row as $rows)
              { 
            ?>
            <tr>
<<<<<<< HEAD
  
=======
>>>>>>> 520c49c (Updates)
                <td><?php echo $rows['User']; ?></td>
                <td><?php echo $rows['EmployeeID']; ?></td>
                <td><?php echo $rows['Problem']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>


<?php   
    // Closes connection 
    mysqli_close($conn);
?>
