<!-- Service Desk Check-In Form-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Service Desk Check-In Form</title>
    <style>
      .center {
        max-width: 500px;
        margin: auto;
        font-size: large;
      }
      #problem {
        height: 100px;
        width: 500px;
      }
    </style>
  </head>
  <body action="http://localhost/contact/edit_user.php" class="center">
    <h1>Service Desk Check-In Form</h1>
    <!-- Goes to php file to save form to database -->
    <form method="post">
      <!-- Input for First Name -->
      <label for="fname">First name:</label><br>
      <input type="text" id="fname" name="fname" required><br><br>
      <!-- Input for Last Name -->
      <label for="lname">Last name:</label><br>
      <input type="text" id="lname" name="lname" required>
      <!-- Input for Computer Type -->
      <p>Computer Type:</p>
        <input type="radio" name="comp_type" value="Dell" required>
        <label for="Dell">Dell</label>
      <br>
        <input type="radio" name="comp_type" value="Mac" required>
        <label for="Mac">Mac</label><br><br>
      <!-- Input for Problem User is Having -->
      <label for="problem">Describe the issue with your computer:</label><br>
      <textarea type="text" id="problem" name="problem"></textarea>
      <br><br>
      <?php
        if(array_key_exists('submit', $_POST)) {
          require __DIR__ . '/edit_user.php';
          edit_user("add");
        }
      ?>
      <!-- Submit Form -->
      <input type="submit" name="submit" class="button" value="Submit">
    </form>
  </body>
</html>
