<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "help_desk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "INSERT INTO `queue_list` (`User`, `EmployeeID`, `Problem`) VALUES ('$dbname', 2, 'I am dumb')";
mysqli_query($conn, $sql);
?>