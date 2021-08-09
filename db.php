<?php 


session_start();

// initializing variables
$username = "";
$email = "";
//$pass = "";
$errors = array();
//$database = "login_register_pure_coding";

$db = mysqli_connect('localhost', 'root', '', 'login_register_pure_coding');

//Register user
if(isset($_POST['submit'])){
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $cpassword = mysqli_real_escape_string($db, $_POST['cpassword']);

 // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if ($password != $cpassword) {
  array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM login WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $login = mysqli_fetch_assoc($result);
  
  if ($login) { // if user exists
    if ($login['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($login['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password);//encrypt the password before saving in the database

    $query = "INSERT INTO login (username, email, password) 
          VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: http://localhost/Project/front-page-intovert-travels-blog.html');
  }
}
 


/*    $sql = "INSERT INTO login (username,email,password)
        VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($db, $sql);
  	$_SESSION['email'] = $email;
      echo "<p>Your Query has been submitted successfully!<br>Our team will contact you shortly.</p>";
		header("Location: http://localhost/Project/front-page-intovert-travels-blog.html ");
}*/
?>