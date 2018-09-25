<?php
session_start();

// initializing variables
$email = "";
$name = "";
// connect to the database
include 'config.php';
$db = getdb();

if (isset($_POST['email'])) {
    // receive all input values from the form
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    // first check the database to make sure
    // a user does not already exist with the same email
    $user_check_query = "SELECT * FROM User WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if (!$user) { // if user doesnt exists
      $query = "INSERT INTO User (email, name)
        VALUES('$email', '$name')";
      mysqli_query($db, $query);
    }

    // Finally, register user if there are no errors in the form
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    header('Location: Template/upload.phtml');
    die();
  
}
