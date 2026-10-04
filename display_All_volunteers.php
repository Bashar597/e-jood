
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

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }


  // SQL query to insert data into users table
  $sql = "Select * from volunteers";


  if (mysqli_query($conn, $sql)) {
    
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
//}

$result = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> Items Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/gallery/favicon.png" rel="icon">
  <link href="assets/img/gallery/favicon.png" rel="apple-touch-icon">
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
        <h1><a href="index.php"><span><img src="assets/img/gallery/e-Jood.png" alt="logo" width="100" height="100"></span></a></h1> 
        <!-- Uncomment below if you prefer to use an image logo -->
       
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
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
       
          
          </li>
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

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2> All volunteers</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li> All volunteers</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
      <div class="container">
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">All Volunteers </h5>

              <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns"><div class="dataTable-top"><div class="dataTable-dropdown"><div class="dataTable-container">
                <table class="table table-bordered datatable dataTable-table">
              <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">address</th>
                    <th scope="col">mail</th>
                    <th scope="col">phone number</th>
                  </tr>
                </thead>
                         
            
    

                <?php
               echo "<tbody>";
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr><th scope='row'><a href='#'>#".$row['volunteer_ID']."</a></th><td>".$row['volunteer_name']."</td><td><a href='#' class='text-primary'>".$row['volunteer_region']."</a></td><td>".$row['Email']."</td><td>".$row['volunteer_phone']."</td></tr>";
               
			}
            echo "</tbody>";

            // Close the database connection
            mysqli_close($conn);
			?>
               
              </table></div><div class="dataTable-bottom"><div class="dataTable-info"></div><nav class="dataTable-pagination"><ul class="dataTable-pagination-list"></ul></nav></div></div>

            </div>

          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

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

<script>
  setInterval(function() {
    location.reload();
  }, 15000); // refresh every 15 seconds
</script>
