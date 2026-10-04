<?php
session_start();
$itemid = $_GET['itemid'];


// Get Item_ID URL Parameter 

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
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* $itemid = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email']; */
    
    // Step 3: Update the record in the database
    
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
  
  

  // SQL query to insert data into users table
  $sql = "UPDATE items SET status_id=2 WHERE item_ID=".$itemid;


  if (mysqli_query($conn, $sql)) {
    //if(isset($_POST['confirm task'])) {
          // Invoke SMS web service to the new user's phone number
              $Assigned_Voluntteer= $_POST["volunteersddl"];
              $array = explode("#$",$Assigned_Voluntteer);
          // Define the SOAP endpoint and credentials
          $endpoint = "http://api.mtcsms.com/sendsms.asmx";
          $username = "EJood";
          $password = "your_sms_password";
          $fullname = $_SESSION['donor_name'];
                   
          // Define the SOAP message parameters
          $sender = "EJood";
          $mobile = $_SESSION['Donor_phone'];
          $msg = "مرحبا ".$fullname." ، تم إستلام تبرعك الكريم. نشكر لك مساهمتك في خدمة مجتمعك، وكن متأكدا بأننا سوف نقوم بتوزيعه بالطرق المثلى. مع الاحترم : فريق اي جود.";
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
          
          //Show Success Message
          echo '<script>alert("Donation collecting has been confirmed!\nA confirmation message well be sent to donor.");window.location.href = "/EJood/index.php";</script>';
    //}
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
   
$result = mysqli_query($conn, $sql); 
}



?>









<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Confirm</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/gallery/e-Jood.png" rel="icon">
  <link href="assets/img/gallery/e-Jood.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Bootslander - v4.10.0
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="index.php"><span>eJood</span></a></h1>
       <!-- Uncomment below if you prefer to use an image logo  -->
<!--         <a href="index.html"><img src="assets/img/gallery/e-Jood.png" alt="" class="img-fluid"></a> -->
      </div>

      <nav id="navbar" class="navbar">
      <ul>
          
          <li><a class="nav-link scrollto active" href="http://localhost/EJood/">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="itemsdashboard.php">Items</a></li>
          <li class="dropdown"><a href="#"><span>Organizations</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="Add_organization.php">Add Organizations</a></li>
              <li class="dropdown">
              <li><a href="display_All_Organizations.php">view organization</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Volunteers</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="Add_volunteer.php">Add Volunteers</a></li>
              <li class="dropdown">
              <li><a href="display_All_volunteers.php">view Volunteers</a></li>
            </ul>

          <li class="dropdown"><a href="#"><span>Donors</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="Add_donor.php">Add Donors</a></li>
              <li class="dropdown">
              <li><a href="display_all_donors.php">view Donors</a></li>
            </ul>
          </li>
          <?php
            if(isset($_SESSION['UserFullName']) && $_SESSION['UserFullName'] !== "") {
              // User is logged in, show the dropdown list
          ?>

          <li class="dropdown"><a href="#"><span><?php echo  $_SESSION['UserFullName'] ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="My_profile.php">My Profile</a></li>
              <li class="dropdown">
              <li><a href="Logout.php">Logout</a></li>
            </ul>
          </li>
            
          <?php
          } elseif(!isset($_SESSION['UserFullName'])){
          ?>
            <li><a class="nav-link scrollto" href="login.html">Login</a></li>
            <?php
          } else {
          }
          ?>

      </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">

            
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
      <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Donation Collecting Confirmation</h5>
            
                          <!-- Vertical Form -->
                          <form  method="POST">
                            <div class="row mb-3">

                        
                               <?php



                              // Close the database connection
                              mysqli_close($conn);

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


                                
                                $sql = "Select items.item_ID, items.item_name, items.time_date, items.volunteer_ID, login.adress, login.Fname as Donor_Fname, login.Lname as Donor_Lname, volunteer.Fname as Volunteer_Fname, volunteer.Lname as Volunteer_Lname, volunteer.phone as Volunteer_phone, login.phone as Donor_phone from items INNER JOIN login ON items.donors_ID = login.Uid INNER JOIN login volunteer ON items.volunteer_ID = volunteer.Uid WHERE items.item_ID=".$itemid;
                              

                                if (mysqli_query($conn, $sql)) {
                                  
                                } else {
                                  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                              

                              $result = mysqli_query($conn, $sql);



                                ?>
                             </div>
</div>
                            
                             <?php
                                while($row = mysqli_fetch_assoc($result)) {
                                 

                                  //save donor address and donor full name in variable to be sent in SMS
                                  $_SESSION['donor_name'] = $row['Donor_Fname'].' '. $row['Donor_Lname'];
                                  $_SESSION['Donor_phone'] = $row['Donor_phone'];

                              
                                
                                ?>
                              </div>
                           

                              <div class="row mb-3">
                              
                              <label for="Item_Name" class="col-sm-2 col-form-label">Donor Name</label>
                              <div class="col-sm-10">
                              <?php
                                echo $row['Donor_Fname'].' '.$row['Donor_Lname'];
                             
                              ?>
                              </div>
                                </div>
                              <div class="row mb-3">
                              
                              <label for="Item_Name" class="col-sm-2 col-form-label">Item No.</label>
                                
                              <div class="col-sm-10">
                              <?php
                                echo $row['item_ID'];
                             
                              ?>
                              </div>
                              </div>
                            <div class="row mb-3">
                              
                              <label for="Item_Name" class="col-sm-2 col-form-label">Item Name</label>
                              <div class="col-sm-10">
                              <?php
                                echo $row['item_name'];
                             
                              ?>
                              </div>
                            </div>
                            
                        
                            <div class="row mb-3">
                              
                              <label for="Status" class="col-sm-2 col-form-label">Date of Donation</label>
                              <div class="col-sm-3">
                              
                              <?php
                              
                              
                              echo $row['time_date'];
                              
                              ?>
                              </div>
                            </div>
                            <div class="row mb-3">
                              
                              <label for="Status" class="col-sm-2 col-form-label">Collecting By</label>
                              <div class="col-sm-3">
                              
                              <?php
                             
                             
                             echo $row['Volunteer_Fname'].' '.$row['Volunteer_Lname'];                             
                             
                                                           
                             ?>
                             </div>
                             </div>
                              <div class="row mb-3">
                                <label for="Status" class="col-sm-2 col-form-label">Volunteers Phone</label>
                                <div class="col-sm-3">
                                <?php
                              
                                    echo $row['Volunteer_phone'];
                                                              
                                }
                              ?>
                              </div>
                            </div>
                              
                            
                            </div>
                            <div class="text-center">
                              <br>
                              <br>
                              <button type="submit" name = 'confirm task' id = 'confirm task'class="btn btn-primary" value="Update">Confirm Collection</button>
                              <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                          </form>
            <!-- Vertical Form -->
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <h3>eJood</h3>
              <p class="pb-3"><em>eJood is a pioneering project to transfer food, clothing and other basic things of life to the less fortunate groups in society.for more information:
              </em></p>
              <p>
                <strong>Location:</strong> Ramallah, AL-Bireh<br>
                <strong>Phone:</strong> 0569040666<br>
                <strong>Email:</strong> basharshunnar8@gmail.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php#features">Features</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="Add_organization.php">Join us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="Add_volunteer.php">Become a Volunteer</a></li>
            </ul>
          </div>



          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>subscribe to our Newsletter for daily news.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>eJood</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/ -->
        Designed by <a href="http://localhost/EJood/">eJood_developers</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>



</body>

</html>