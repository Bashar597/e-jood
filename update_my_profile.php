
<?php
session_start();
  include 'sighnup.html';
  // MySQL database credentials
  $servername = "localhost";
  $username = "root";
  $password = "your_db_password";
  $dbname = "ejood";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Check if the form was submitted
  //if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data

    $signup_firstname= $_POST["firstName"];
    $signup_lastname = $_POST["lastName"];
    $signup_phone = $_POST["phonenumber"];
    $signup_address = $_POST["Address"];
    $signup_email = $_POST["YourEmail"];
    $signup_username = $_POST["Username"];
    $signup_password = $_POST["Password"];
    $signup_Accounttype = $_POST["Accounttype"];




    // SQL query to insert data into users table
    $Uid= $_SESSION['user_id'];
    $sql = "UPDATE login SET Fname='$signup_firstname', Lname='$signup_lastname', Account_type='$signup_Accounttype', email='$signup_email', phone= '$signup_phone', adress='$signup_address', Username='$signup_username' , password='$signup_password' WHERE Uid='$Uid'";


    if (mysqli_query($conn, $sql)) {
      echo '<script>alert("Your profile has been updated successfully!"); window.location.href = "My_profile.php";</script>';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
  
    mysqli_close($conn);
?>
