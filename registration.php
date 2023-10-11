<?php
session_start();
error_reporting(0);
include("dbconnection.php");
//Include required PHPMailer files
require 'include/PHPMailer.php';
require 'include/SMTP.php';
require 'include/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$mobile=$_POST['phone'];
	$gender=$_POST['gender'];
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "<script>alert('Invalid email format. Please enter a valid email address.');</script>";
      echo "<script>window.location.href='registration.php'</script>";
      exit; // Stop processing further if email is invalid
  }

  // Validate contact number format (11 digits)
  if (!preg_match("/^\d{11}$/", $mobile)) {
      echo "<script>alert('Invalid contact number format. Please enter an 11-digit number without spaces or dashes.');</script>";
      echo "<script>window.location.href='registration.php'</script>";
      exit; // Stop processing further if contact number is invalid
  }
	$query=mysqli_query($con,"select email from user where email='$email'");
	$num=mysqli_fetch_array($query);
	if($num>1)
	{
  echo "<script>alert('Email already register with us. Please try with diffrent email id.');</script>";
  echo "<script>window.location.href='registration.php'</script>";
	}
	else
	{
 // Use prepared statement to insert data
 $stmt = mysqli_prepare($con, "INSERT INTO user (name, email, password, mobile, gender) VALUES (?, ?, ?, ?, ?)");
 mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $password, $mobile, $gender);
 
 if (mysqli_stmt_execute($stmt)) {
     $lastInsertId = mysqli_insert_id($con);
     
     if ($lastInsertId) {
         $msg = "User registered successfully";

         // Create instance of PHPMailer
         $mail = new PHPMailer();

         // Set mailer to use smtp
         $mail->isSMTP();

         // Define SMTP host
         $mail->Host = "smtp.gmail.com";

         // Enable SMTP authentication
         $mail->SMTPAuth = true;

         // Set SMTP encryption type (tls)
         $mail->SMTPSecure = "tls";

         // Port to connect SMTP
         $mail->Port = 587;

         // Set Gmail username and password
         $mail->Username = "boitumelomojela33@gmail.com";
         $mail->Password = "rsrcsxvqmfvkanos";

         // Email subject
         $mail->Subject = "DITHOMA System";

         // Set sender email
         $mail->setFrom('boitumelomojela33@gmail.com');

         // Enable HTML
         $mail->isHTML(true);

         // Email body
         $mail->Body = "<h1>User registration</h1></br><p>Account created successfully</p><br>
         <p>username: </p><br><p>
         password:</p>";

         // Add recipient
         $mail->addAddress('atlegangpule5@gmail.com');

         // Finally send email
         if ($mail->send()) {
             // Closing SMTP connection
             $mail->smtpClose();
         } else {
             $error = "Error sending email: " . $mail->ErrorInfo;
         }
     } else {
         $error = "Something went wrong. Please try again.";
     }
     mysqli_stmt_close($stmt);

     echo "<script>alert('Your Account has been created successfully.');</script>";
     echo "<script>window.location.href='login.php'</script>";
 } else {
     $error = "Error inserting data into the database.";
 }
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>DITHOMA| Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
function checkpass()
{
if(document.signup.password.value!=document.signup.cpassword.value)
{
alert('New Password and Re-Password field does not match');
document.signup.cpassword.focus();
return false;
}
return true;
}   

</script>

</head>
<body class="error-body no-top">
<div class="container">
  <div class="login-container">  
        <div class="col-md-5">
          <h2 class="text-center text-white"><strong>Create An Account</strong></h2>
          <hr style="border-color:#ebe7e7">
              <p class="text-center"><a href="login.php">Login Here!</a> if you already have an account</p>

		  
        </div>
        <div class="col-md-5 "> <br>
          <form id="signup" name="signup" class="login-form" onsubmit="return checkpass();" method="post">
            <div class="form-group">
              <label for="name" class="control-label">Name</label>
              <input type="text" class="form-control rounded-0" id="name" name="name" required="required">
            </div>
            <div class="form-group">
              <label for="email" class="control-label">Email</label>
              <input type="text" class="form-control rounded-0" id="email" name="email" required="required">
            </div>
            <div class="form-group">
              <label for="password" class="control-label">Password</label>
              <input type="password" class="form-control rounded-0" id="password" name="password" required="required">
            </div>
            <div class="form-group">
              <label for="password" class="control-label">Confirm Password</label>
              <input type="password" class="form-control rounded-0" id="cpassword" name="cpassword" required="required">
            </div>
            <div class="form-group">
    <label for="phone" class="control-label">Contact Number</label>
    <div class="input-group">
        <select class="custom-select" id="countrySelector" name="countrySelector" style="width: 30%;">
            <option value="" disabled selected>Select Country</option>
            <option value="27">South Africa (+27)</option>
            <option value="1">United States (+1)</option>
            <option value="44">United Kingdom (+44)</option>
            <option value="33">France (+33)</option>
            <option value="49">Germany (+49)</option>
            <option value="81">Japan (+81)</option>
            <option value="86">China (+86)</option>
            <option value="91">India (+91)</option>
            <option value="61">Australia (+61)</option>
            <option value="55">Brazil (+55)</option>
            <option value="52">Mexico (+52)</option>
            <!-- Add more countries and country codes as needed -->
        </select>
        <input type="text" class="form-control rounded-0" id="phone" name="phone" required="required" style="width: 70%;">
    </div>
</div>

            
            <div class="form-group">
              <label for="gender" class="control-label">Gender</label>
              <select class="form-control" name="gender" id="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
            <div class="form-group text-center">
              <button class="btn btn-primary rounded-pill">Create Account</button>
            </div>
          </form>
        </div>
     
    
  </div>
</div>
<script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="assets/js/login.js" type="text/javascript"></script>
<script>
    document.getElementById("countrySelector").addEventListener("change", function() {
        var countryCode = this.value;
        var phoneField = document.getElementById("phone");
        // Check if the phone field already contains a country code, and remove it if present
        if (phoneField.value.startsWith("+")) {
            phoneField.value = "+" + countryCode + phoneField.value.substring(phoneField.value.indexOf(" "));
        } else {
            phoneField.value = "+" + countryCode;
        }
    });
</script>
</body>
</html>