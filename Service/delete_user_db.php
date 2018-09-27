<?php

use \tagtools\Model\User;

session_start();

$user = new User($_SESSION['email']);

if ($user->isPresent())
{
    $user->deleteDB();
}

header('Location: upload.php');