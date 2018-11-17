<?php

use \tagtools\Model\User;

require_once '../Model/User.php';

session_start();

if (isset($_POST['email']))
{
    $user = new User($_POST['email']);

    if (!$user->isPresentUserData())
    {
        $user->insertRow([$_POST['name'], $_POST['imageUrl']]);
    }

    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['imageUrl'] = $_POST['imageUrl'];
    header('Location: ../upload.php');
}
