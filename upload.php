<?php

session_start();

use tagtools\Model\File;

require_once 'Model/File.php';

if (!isset($_SESSION['email']))
{
    header('location: login.php');
    return;
}

if (isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['email']);
    unset($_SESSION['name']);
    unset($_SESSION['imageUrl']);
    header("location: login.php");
    return;
}

if (isset($_SESSION['email']))
{
    $file = new File($_SESSION['email']);

    if ($file->isPresentUserData())
    {
        header("location: index.php");
        return;
    }
}

header('location: Template/upload.php');