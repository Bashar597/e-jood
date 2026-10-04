
<?php

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

    $signup_firstname= $_POST["FirstName"];
    $signup_lastname = $_POST["lastName"];
    $signup_phone = $_POST["phonenumber"];
    $signup_address = $_POST["Address"];
    $signup_email = $_POST["YourEmail"];
    $signup_username = $_POST["Username"];
    $signup_password = $_POST["Password"];
    $signup_Accounttype = $_POST["Accounttype"];




    // SQL query to insert data into users table
    $sql = "INSERT INTO login (Fname,Lname,phone,adress,email,Username,password,Account_type) VALUES ('$signup_firstname', '$signup_lastname', '$signup_phone', '$signup_address', '$signup_email', '$signup_username', '$signup_password','$signup_Accounttype')";

    if(isset($_POST['submit'])) {

        $signup_firstname= $_POST["FirstName"];
        $signup_lastname = $_POST["lastName"];
        $signup_phone = $_POST["phonenumber"];
        $signup_address = $_POST["Address"];
        $signup_email = $_POST["YourEmail"];
        $signup_username = $_POST["Username"];
        $signup_password = $_POST["Password"];
        $signup_Accounttype = $_POST["Accounttype"];

        if(empty($signup_firstname) || empty($signup_lastname) || empty($signup_phone) || empty($signup_address) || empty($signup_email) || empty($signup_username) || empty($signup_password) || ($signup_Accounttype) == "choose Account type") {
            echo "<p style='color:red'>Please fill in all fields</p>";
        } elseif($password != $confirm_password) {
            echo "<p style='color:red'>Passwords do not match</p>";
            } else {
            // add code here to insert the data into the database
            echo "<p style='color:green'>Signup successful!</p>";
        }
    }


    if (mysqli_query($conn, $sql)) {

      // Invoke SMS web service to the new user's phone number

      // Define the SOAP endpoint and credentials
      $endpoint = "http://api.mtcsms.com/sendsms.asmx";
      $username = "EJood";
      $password = "your_sms_password";
      $fullname = $signup_firstname. " " . $signup_lastname;

      // Define the SOAP message parameters
      $sender = "EJood";
      $mobile = $signup_phone;
      $msg = "شكرا ".$fullname."لانضمامك الى بوابتنا الإلكترونية، حيث يمكنك المساهمة في خدمة مجتمعك.يمكنك الدخول الى البوابة الالكترونية من خلال العنوان التالي: https://ejood.net";
      $type = "0";
      $rule = "3";

      // Define the SOAP message XML
      $xml = '<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
        <soap12:Body>
          <SendMessage xmlns="http://tempuri.org/">
            <Username>' . $username . '</Username>
            <Password>' . $password . '</Password>
            <Sender>' . $sender . '</Sender>
            <Mobile>' . $mobile . '</Mobile>
            <Msg>' . $msg . '</Msg>
            <Type>' . $type . '</Type>
            <Rule>' . $rule . '</Rule>
          </SendMessage>
        </soap12:Body>
      </soap12:Envelope>';

      // Define the SOAP headers
      $headers = array(
          'Content-Type: application/soap+xml; charset=utf-8',
          'Content-Length: ' . strlen($xml),
      );

      // Send the SOAP request using cURL
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $endpoint);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      $response = curl_exec($ch);
      curl_close($ch);

      // Parse the SOAP response
      $xml_response = simplexml_load_string($response);
      $ns = $xml_response->getNamespaces(true);
      $status = $xml_response->children($ns['soap12'])->Body->children()->SendMessageResponse->SendMessageResult;

      // Print the status in browser console
      echo "<script>console.log('".$status."');</script>";
      

      //Show Success Message
        echo '<script>alert("You have sugned up successfully!\nClick OK to return to the Login page..."); window.location.href = "/EJood/login.html";</script>';  }
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }


  //}

  // Close the database connection
  mysqli_close($conn);
?>
