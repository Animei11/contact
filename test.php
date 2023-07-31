<<<<<<< HEAD
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "help_desk";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
?>


<!DOCTYPE html>
<html lang="en">
  <body>
    <?php 
        $lname = $_POST["lname"];
        $fname = $_POST["fname"];
        $comma = ", ";
        $comp_type = $_POST["comp_type"];
        $problem = $_POST["problem"];
        $user = $lname. $comma. $fname;
        printf("User: %s<br>", $user);
        printf("Computer Type: %s<br>", $comp_type);
        printf("Problem: %s<br>", $problem);
        
    ?>
</body>
</html>


<?php   
    $sql = "INSERT INTO `queue_list` (`User`, `EmployeeID`, `Problem`, `Computer`) VALUES ('$user', 2, '$problem', '$comp_type')";
    mysqli_query($conn, $sql);
    // Closes connection 
    mysqli_close($conn);
=======
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "help_desk";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
?>


<!DOCTYPE html>
<html lang="en">
  <body>
    <?php 
        $lname = $_POST["lname"];
        $fname = $_POST["fname"];
        $comma = ", ";
        $comp_type = $_POST["comp_type"];
        $problem = $_POST["problem"];
        $user = $lname. $comma. $fname;
        printf("User: %s<br>", $user);
        printf("Computer Type: %s<br>", $comp_type);
        printf("Problem: %s<br>", $problem);
        
    ?>
</body>
</html>


<?php   
    $sql = "INSERT INTO `queue_list` (`User`, `EmployeeID`, `Problem`, `Computer`) VALUES ('$user', 2, '$problem', '$comp_type')";
    mysqli_query($conn, $sql);
    // Closes connection 
    mysqli_close($conn);
>>>>>>> 520c49c (Updates)
?>