<?php
  // Get information from register form on form submit
  $newuser = $_POST['newuser'];
  $newpassword = $_POST['newpassword'];
  $newemail = $_POST['newemail'];

  // Database info
  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'root';
  $DATABASE_PASS = '';
  $DATABASE_NAME = 'phplogin';

  // Create connection
  $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
  // Check connection
    
  if (mysqli_connect_errno()) {
      exit('Failed to connect to MySQL: ' . mysqli_connect_error());
  }
  // Hash the password
  $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

  // Insert information into database so user can login with new account information
  $stmt = $conn->prepare("INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $newuser, $hashed_password, $newemail);

  if ($stmt->execute() === TRUE) {
    echo "success";
  } else {
      echo "error". mysqli_stmt_error($stmt);
  }
  // Close connection
  $conn->close();
?>