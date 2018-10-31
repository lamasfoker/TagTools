<?php

use tagtools\Model\File;

require_once 'Model/File.php';

session_start();

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
    header("location: login.php");
    return;
}

if (isset($_SESSION['email']))
{
    $file = new File($_SESSION['email']);

    if (!$file->isPresentUserData())
    {
        header("location: upload.php");
        return;
    }
}

header('location: Template/index.php');