<?php
session_start();
// connect to the database
include 'config.php';
$db = getdb();

$email = $_SESSION['email'];

$sqlFile = "DELETE FROM File WHERE email='$email'";
$sqlTag = "DELETE FROM Tag WHERE email='$email'";

mysqli_query($db, $sqlFile);
mysqli_query($db, $sqlTag);

header('Location: upload.php');