<?php

if (!isset($_SESSION['email'])) {
    header('location: Template/login.phtml');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: Template/login.phtml");
}

header('location: Template/index.phtml');