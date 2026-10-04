
<?php


  include 'add_donor.php';
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
    $name = $_POST["donor_name"];
    $address = $_POST["address"];
    $connact_person = $_POST["connact_person"];
    $phone_num = $_POST["phone_num"];
    

    // SQL query to insert data into users table
    $sql = "INSERT INTO donors(donor_name, address, connact_person, phone_num) VALUES ('$name', '$address', '$connact_person', '$phone_num')";

    if (mysqli_query($conn, $sql)) {
      echo '<script>alert("The Donor has been added successfully!")</script>';  
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  //}

  // Close the database connection
  mysqli_close($conn);
?>



