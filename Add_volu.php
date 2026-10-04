
<?php

  include 'Add_volunteer.html';
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
    $name = $_POST["Volunteer_name"];
    $phone_num = $_POST["Phone_number"];
    $Email = $_POST["Email"];
    $address = $_POST["address"];
    

    // SQL query to insert data into users table
    $sql = "INSERT INTO volunteers(volunteer_name, volunteer_region, Email, volunteer_phone) VALUES ('$name', '$address', '$Email', '$phone_num')";

    if (mysqli_query($conn, $sql)) {
      echo '<script>alert("The volunteer has been added successfully!")</script>';
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  //}

  // Close the database connection
  mysqli_close($conn);
?>



