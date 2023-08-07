<!-- Service Desk Check-In Form-->
<?php
header("Refresh:5");
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
        foreach($row as $rows) { 
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
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\SMTP;
      use PHPMailer\PHPMailer\Exception;
      // use PHPMailer\PHPMailer\Exception;
      require 'PHPMailer-master/src/PHPMailer.php';
      require 'PHPMailer-master/src/SMTP.php';
      require 'PHPMailer-master/src/Exception.php';
    // If Next button is clicked (Sends email, deletes user 1, moves the rest up teh list)
      if(array_key_exists('next', $_POST)) {
        // Refreshes page
        header("Refresh:0");


        // Email headings 
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'p01-wa-smtp-01.genesco.local';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = false;                                   //Enable SMTP authentication
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Port       = 25;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Help Desk Check-In Status';
        //Recipients
        $mail->setFrom('dwilmore@genesco.com', 'Help Desk');
        // Sets up email for person next in line 
        $sql = "SELECT `Email` FROM `queue_list` WHERE `Number` = 2";
        $result = ($conn->query($sql));
        $row = []; 
        if($result->num_rows > 0) {
          // Gets email address from database 
          $row = $result->fetch_all(MYSQLI_ASSOC);  
        }  
        if(!empty($row))
          foreach($row as $rows) {
            $mail->Body    = 'Hello,<br><br>This email is to notify you that your issue is currrently being looked at. We will email you when it is resolved.
            <br><br>Thanks,<br>Help Desk';
            $mail->addAddress($rows['Email']); 
            $mail->send();
            // $to_email = $rows['Email'];
            // Sends email
          } 

          
        // Sets up email for person to collect their laptop when finished 
        $sql = "SELECT `Email` FROM `queue_list` WHERE `Number` = 1";
        $result = ($conn->query($sql));
        $row = []; 
        if($result->num_rows > 0) {
          // Gets email address from database 
          $row = $result->fetch_all(MYSQLI_ASSOC);  
        }  
        if(!empty($row))
          foreach($row as $rows) {
            // Create a new PHPMailer instance
            $mail->clearAllRecipients( );
            $mail->Body    = 'Hello,<br><br>This email is to notify you that your issue has been resolved. Please collect your computer.
            <br><br>Thanks,<br>Help Desk';
            $mail->addAddress($rows['Email']); 
            $mail->send();
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
