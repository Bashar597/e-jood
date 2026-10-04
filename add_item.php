
<?php

session_start();
//if ($_SESSION['loggedin'] != true){

  
  if (!isset($_SESSION['UserFullName'])) {
 
  header('Location: login.html');
  exit;
}
  
  // MySQL database credentials
  $servername = "localhost";
  $username = "root";
  $password = "your_db_password";
  $dbname = "ejood";

  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // get the values submitted from the form
  $donor_id = $_SESSION['user_id'];
  $item_name = $_POST['item_name'];
  $quantity = $_POST['Quantity'];
  $comments = $_POST['comments'];
  $phone = $_SESSION['phone'];
  // prepare the SQL statement with placeholders for the values
  $sql = "INSERT INTO items (donors_ID, item_name, quantity,comments, status_id ) VALUES ('$donor_id', '$item_name', '$quantity', '$comments',0)";


  if (mysqli_query($conn, $sql)) {
   
    // Define the SOAP endpoint and credentials
$endpoint = "http://api.mtcsms.com/sendsms.asmx";
$username = "EJood";
$password = "your_sms_password";
$fullname = $_SESSION['UserFullName'];
// Define the SOAP message parameters
$sender = "EJood";
$mobile = $_SESSION['phone'];
$msg = "مرحبا ".$fullname."  شكرا لتبرعك الكريم. سوف نقوم بالمباشرة بمتابعة تبرعك والتواصل معك لاستلامه في اسرع وقت ممكن. بوابة اي جود";
//$msg = "مرحبا ".$array[2]." نرجو منك القيام باستلام التبرعات المقدمة على العنوان التالي و توصيلها الى مركزنا الرئيسي. شاكرين لك جهودك في مساعدة مجتمعك. ";
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
//Show success Msg
echo '<script>alert("Thank you for your donation! \n We will keep you posted once we process your request. \n Press OK to proceed."); window.location.href = "/EJood/index.php";</script>';
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }



  // Close the database connection
  mysqli_close($conn);
}
?>

<!DOCTYPE html>

<html lang="en">


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Donate Items</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/gallery/e-Jood.png" rel="icon">
  <link href="assets/img/gallery/e-Jood.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div >
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                    <header><h3>Welcome!!</h3></header>
                    <span class="d-none d-lg-block"></span>
                </a>
               
              </div><!-- End Logo -->

              <div>

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Donate Items</h5>
                    <p class="text-center small">fill in the requierments</p>
                  </div>

                    <form class="row g-3 needs-validation"  method="POST">
                        <div class="col-12">
                            <label for="Full_name" class="form-label" id="name" name="name">Your Name</label>
                            <div  class="form-control"> 
                            <?php echo  $_SESSION['UserFullName'] ?>
                            </div><br>
                            <label for="Items" class="form-label">Type of Items</label>
                            <select id="item_name" name="item_name" class="form-select">
                    
                              <option selected="" value="water Bottle">water Bottle</elsoption>
                              <option value="clothes">clothes</option>
                              <option value="Food">Food</option>
                              <option value="others">others</option>                                                                                                  
                            </select>
                            <br>
                        </div>



                       

                        
                            <div class="col-13">
                            <label for="lastName" class="form-label">Quantity of Item</label>
                            <input type="number" name="Quantity" class="form-control" id="Quantity" required>
                            <div class="invalid-feedback">Please, enter the quantity of te Item!</div>
                            </div>
    
                            <div class="col-12">
                        <label for="Username" class="form-label">Any comments that you would like to add?</label>
                        <div class="input-group has-validation">
                            <textarea  rows="5" cols="50" type="text" name="comments" class="form-control" id="comments" ></textarea>
                            <div class="invalid-feedback">Please choose a username.</div>
                        
                        </div>
                        
                        <div class="col-44">
                          <br>
                            <button id="submit_btn" class="btn btn-primary w-100" type="submit" >  Donate </button>
                    </div>


               


                            
                            
                           