
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

  
    
    $Uid = $_SESSION['user_id'];
    

    $sql = "SELECT * FROM login WHERE Uid = '$Uid' ";
    $result = mysqli_query($conn, $sql);

   

    while($row = mysqli_fetch_assoc($result)) {
       
         
      
   
  //}




?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MY ACCOUNT</title>
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
                    <header>Welcome!!</header>
                    <span class="d-none d-lg-block"></span>
                </a>

              
               
              </div><!-- End Logo -->

              <div>

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">My Account</h5>
                    <p class="text-center small">Update your account</p>
                  </div>

                    <form class="row g-3 needs-validation" action="update_my_profile.php" method="POST">
                        <div class="col-12">
                        <label for="FirstName" class="form-label">First Name</label>
                        <p><?php 
                        
                        echo '<input type="text" name="firstName" class="form-control" id="firstName" required value="'.$row['Fname'].'">'
                        
                        
                        ?></p>
                        <div class="invalid-feedback">Please, enter your first name!</div>
                        </div>

                    
                        <div class="col-12">
                        <label for="lastName" class="form-label">last Name</label>
                        <?php 
                        
                        echo '<input type="text" name="lastName" class="form-control" id="lastName" required value="'.$row['Lname'].'">'
                        
                        
                        ?>
                        
                        <div class="invalid-feedback">Please, enter your last name!</div>
                        </div>
                        <div class="col-12">
                            <label for="Accounttype" class="form-label">Account Type</label>
                        <select id="Accounttype" name="Accounttype" class="form-select">
                            
                                <option value="personal"<?php if($row['Account_type'] == 'personal') echo ' selected'; ?>>personal</option>
                                <option value="organization"<?php if($row['Account_type'] == 'organization') echo ' selected'; ?>>organization</option>
                                <option value="employee"<?php if($row['Account_type'] == 'employee') echo ' selected'; ?>>employee</option>
                                <option value="volunteer"<?php if($row['Account_type'] == 'volunteer') echo ' selected'; ?>>volunteers</option>
                                <option value="goverment"<?php if($row['Account_type'] == 'goverment') echo ' selected'; ?>>goverment</option>
                                
                            
                        </select>
                        
                        </div>
                        <div class="col-12">
                            <label for="phonenumber" class="form-label">phone number</label>
                            <?php  echo '<input  type="text" name="phonenumber" class="form-control" id="phonenumber" required value="'.$row['phone'].'">' ?>
                            <div class="invalid-feedback">Please, enter your phone number!</div>
                        </div>

                            
                        
                        <div class="col-12">
                        <label for="Address" class="form-label"> Address </label>
                        <?php echo '<input  type="text" name="Address" class="form-control" id="Address" required value="'.$row['adress'].'">' ?>
                        <div class="invalid-feedback">1234 Main St</div>
                        </div>
                        <div class="col-12">
                    <label for="YourEmail" class="form-label">Your Email</label>
                    <?php echo '<input  type="email" name="YourEmail" class="form-control" id="YourEmail" value="'.$row['email'].'">' ?>                   
                    <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                        </div>
                        <div class="col-12">
                    <label for="Username" class="form-label">Username</label>
                    <div class="input-group has-validation">
                    <?php echo '<input  type="text" name="Username" class="form-control" id="Username" value="'.$row['Username'].'">' ?> 
                        <div class="invalid-feedback">Please choose a username.</div>
                    </div>
                        </div>
                        <div class="col-12">
                    <label for="Password" class="form-label">Password</label>
                    <?php echo '<input  type="password" name="Password" class="form-control" id="Password" value="'.$row['password'].'">' ?>
                    <div class="invalid-feedback">Please enter your password!</div>
                        </div>
                        
                        <div class="col-12">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                           <input type="password" name="confirm_password" class="form-control" id="confirm_password" required onchange="confirmPassword()"  style="display:inline; WIDTH:92%">
                           <img id="warnningpasswordimg" name="warnningpasswordimg" src="assets/img/passwordwarnning.png" alt="Password Confirmation Warnning" style="display:none" >        
                        </div>
                
                        <script>
                            function validatePassword(password) {
                            // Regular expressions to check for password complexity
                            var regexLowercase = /[a-z]/;
                            var regexUppercase = /[A-Z]/;
                            var regexNumber = /[0-9]/;
                            var regexSpecialChar = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

                            // Check password length
                            if (password.length < 8) {
                                return false;
                            }

                            // Check for lowercase letters
                            if (!regexLowercase.test(password)) {
                                return false;
                            }

                            // Check for uppercase letters
                            if (!regexUppercase.test(password)) {
                                return false;
                            }

                            // Check for numbers
                            if (!regexNumber.test(password)) {
                                return false;
                            }

                            // Check for special characters
                            if (!regexSpecialChar.test(password)) {
                                return false;
                            }

                            // If all checks pass, return true
                            return true;
                            }

                            function confirmPassword() {
                            var password = document.getElementById("Password").value;
                            var confirm_password = document.getElementById("confirm_password").value;
                            
                            if (password != confirm_password) {
                                document.getElementById("warnningpasswordimg").src="assets/img/passwordwarnning.png"
                                document.getElementById("warnningpasswordimg").title="Passwords do not match!"
                                document.getElementById("warnningpasswordimg").style="display:inline"
                                document.getElementById("submit_btn").disabled = true;
                            }
                            else{

                                if (validatePassword(password) == true){
                                document.getElementById("warnningpasswordimg").src="assets/img/ok.png"
                                document.getElementById("warnningpasswordimg").title="Password is acceptable!"
                                document.getElementById("warnningpasswordimg").style="display:inline"
                                document.getElementById("submit_btn").disabled = false;
                                }
                                else{
                                    document.getElementById("warnningpasswordimg").src="assets/img/passwordwarnning.png"
                                    document.getElementById("warnningpasswordimg").title="Your passwords is weak!\n Your password must be at least 8 characters long and include at least one lowercase letter, one uppercase letter, one number, and one special character (!@#$%^&*()_+-=[]{};:'\|,.<>/?).\n Please try again."
                                    document.getElementById("warnningpasswordimg").style="display:inline"
                                    document.getElementById("submit_btn").disabled = true;

                                }
                                

                                
                            }

                            }
                        </script>



                        <div class="col-12">
                            <button  class="btn btn-primary w-100" type="submit"  name = submit_btn id =submit_btn >  Update your account </button>
                        </div>
                            <div class="col-12">
                            </div>
                    </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
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


<?php

        }
?>
</body>

</html>


