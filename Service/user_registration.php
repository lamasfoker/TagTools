<?php

use \tagtools\Model\User;

session_start();

if (isset($_POST['email']))
{

    $user = new User($_POST['email']);

    if (!$user->isPresent())
    {
        $user->setName($_POST['name']);
        $user->save();
        $_SESSION['name'] = $user->getName();
        $_SESSION['email'] = $user->getEmail();
    }

    header('Location: Template/upload.phtml');
}
