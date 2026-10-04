
<?php

  include 'Add_organization.php';
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
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["organization_name"];
    $PHONE_NUMBER = $_POST["organization_phone"];
    $email = $_POST["Email"];
    $Region = $_POST["Address"];
    

    // SQL query to insert data into users table
    $sql = "INSERT INTO organizations(organization_name, organization_phone, Email, organization_region) VALUES ('$name', '$PHONE_NUMBER', '$email', '$Region')";

    if (mysqli_query($conn, $sql)) {
      echo "User added successfully!";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

  // Close the database connection
  mysqli_close($conn);
?>



