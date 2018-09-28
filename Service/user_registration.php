<?php

use \tagtools\Model\User;

require_once '../Model/User.php';

session_start();

if (isset($_POST['email']))
{
    $user = new User($_POST['email']);

    if (!$user->isPresentUserData())
    {
        $user->insertRow([$_POST['name']]);
    }

    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    header('Location: ../upload.php');
}
