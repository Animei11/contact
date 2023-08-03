<?php
// Function to add, delete, or update users
function edit_user($edit) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "help_desk";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    
    // Adds or deletes users
    if($edit == "add") {
        // Uploads data from html file and saves into database
        $lname = $_POST["lname"];
        $fname = $_POST["fname"];
        $comma = ", ";
        $comp_type = $_POST["comp_type"];
        $problem = $_POST["problem"];
        $user = $lname. $comma. $fname;
        $username = $_POST["username"];
        $email_extension = $_POST["email_extension"];
        $email = $username. $email_extension;
        $sql = "INSERT INTO `queue_list` (`Number`, `User`, `EmployeeID`, `Problem`, `Computer`, `Time_submitted`, `Email`) VALUES (0, '$user', 2, '$problem', '$comp_type', CURRENT_TIME, '$email');";
    }
    elseif($edit == "delete") {
        $sql = "DELETE FROM `queue_list` WHERE `Number` = 1";
    }
    mysqli_query($conn, $sql);
    // Updates what number each person is in the list 
    $sql = "SELECT * FROM `queue_list` ORDER BY `Time_submitted`";
    $result = ($conn->query($sql));
    $row = []; 
    $counter = 1;
    if ($result->num_rows > 0) {
        // fetch all data from db into array 
        $row = $result->fetch_all(MYSQLI_ASSOC);  
    } 
    if(!empty($row))
        foreach($row as $rows) {
            $user = $rows['User'];
            $sql = "UPDATE `queue_list` SET `Number` = $counter WHERE User = '$user'";
            mysqli_query($conn, $sql);
            $counter++;
        } 
    // Closes connection 
    mysqli_close($conn);
}
?>