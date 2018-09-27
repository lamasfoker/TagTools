<?php

session_start();

use tagtools\Model\File;

if (!isset($_SESSION['email'])) {
    header('location: Template/login.phtml');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    unset($_SESSION['name']);
    header("location: Template/login.phtml");
}

if (isset($_SESSION['email'])) {
    $file = new File($_SESSION['email']);

    if ($file->isPresentUserData())
    {
        header("location: Template/index.phtml");
    }
}

header('location: Template/upload.phtml');