<?php 


session_start();

// initializing variables
$server = "localhost";
$user = "root";
$pass = "";
$database = "login_register_pure_coding";

$db = mysqli_connect($server, $user, $pass, $database);

//Register user
if(isset($_POST['submit'])){
  $first_name = $_POST['firstname'];
  $last_name = $_POST['lastname'];
  $country = $_POST['country'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];

    $sql = "INSERT INTO queries (first_name,last_name,country,email,subject)
        VALUES ('$first_name', '$last_name', '$country',' $email',' $subject')";
    $result = mysqli_query($conn, $sql);
  	$_SESSION['email'] = $email;
      echo "<p>Your Query has been submitted successfully!<br>Our team will contact you shortly.</p>";
		header("Location: http://localhost/Project/front-page-intovert-travels-blog.html ");
}
?>