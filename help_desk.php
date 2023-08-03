<!-- Service Desk Check-In Form-->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "help_desk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM `queue_list` ORDER BY `Time_submitted`";
$result = ($conn->query($sql));
$row = []; 

if ($result->num_rows > 0) {
    // fetch all data from db into array 
     $row = $result->fetch_all(MYSQLI_ASSOC);  
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Service Desk Waiting List</title>
    <style>
      .center {
        max-width: 500px;
        margin: auto;
        font-size: large;
      }
      td,th {
        border: 2px solid black;
        padding: 40px;
        margin: 5px;
        text-align: center;
        font-size: 25px;
      }
      h1 {
          text-align: center;
          font-size: 45px;
      }
    </style>
    <script>
      function again() {
        location.reload();
        document.write("Reloaded page...");
      }
    </script>
  </head>
  <!-- Displays waiting list -->
  <body action="http://localhost/contact/edit_user.php" class="center">
    <h1 align = "center">Service Desk Waiting List</h1>
    <table align = "center">
        <thead>
            <tr>
                <th>Number</th>
                <th>User</th>
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
                <td><?php echo $rows['Number']; ?></td>
                <td><?php echo $rows['User']; ?></td>
                <td><?php echo $rows['Problem']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- Deletes user when next button hit and sends email?-->
    <form method="post" >
      <?php
      // If Next button is clicked
        if(array_key_exists('next', $_POST)) {
          header("Refresh:0");
          echo "Reloaded page...";
          $sql = "SELECT `Email` FROM `queue_list` WHERE `Number` = 2";
          $result = ($conn->query($sql));
          $row = []; 

          if($result->num_rows > 0) {
            // Gets email from database 
            $row = $result->fetch_all(MYSQLI_ASSOC);  
          }  
          if(!empty($row))
            foreach($row as $rows) {
              $to_email = $rows['Email'];
            } 
          $subject = "Help Desk Check-In Status";
          $body = "Hello," ."\n" ."This email is to notify you that your computer is currently being looked at. We will notify you when the issue is resolved." 
                  ."\n\n" ."Thanks," ."\n" ."Help Desk";
          $headers = "From: HelpDesk";
          // Sends email
          if (mail($to_email, $subject, $body, $headers)) {
            echo "Email successfully sent to $to_email...";
          } else {
            echo "Email sending failed...";
          }
          // Deletes user from database 
          require __DIR__ . '/edit_user.php';
          edit_user("delete");
        }
      ?>
      <!-- Next button to delete user at the top of the list -->
      <input type="submit" name="next" class="button" value="Next">
    </form>
  </body>
</html>


<?php   
  // Closes connection 
  mysqli_close($conn);
?>
