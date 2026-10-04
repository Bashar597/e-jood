
<?php
  session_start();
  //include 'login.html';
  // MySQL database credentials
  $servername = "localhost";
  $username = "root";
  $password = "your_db_password";
  $dbname = "ejood";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}
  else{
    $signup_username = $_POST["Username"];
    $signup_password = $_POST["Password"];

    $sql = "SELECT * FROM login WHERE Username = '$signup_username' AND password = '$signup_password' ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      // Retrieve user information from database
      
      
      while($row = mysqli_fetch_assoc($result)) {
      $_SESSION['user_id'] = $row['Uid'];
      $_SESSION['username'] = $row['Username'];
      $_SESSION['UserFullName'] = $row['Fname']." ".$row['Lname'];
      $_SESSION['phone'] = $row['phone'];
      $_SESSION['loggedin'] = true;
      
      }
      //echo "<script>alert('".$_SESSION['username']."'); window.location.href = '/EJood';</script>";
      header('Location: index.php');
      exit;
      
    }    
      
      else{
        echo '<script>alert("Invalid Username or Password!\nPlease try again."); window.location.href = "/EJood/login.html";</script>';
    }  





    }

  // Close the database connection
  mysqli_close($conn);
          


?>


