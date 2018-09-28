<?php

session_start();

if (isset($_SESSION['email']))
{
    header('location: upload.php');
    return;
}

header('location: Template/login.php');