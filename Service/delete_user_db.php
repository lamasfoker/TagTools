<?php

require_once '../Model/User.php';
require_once '../Model/File.php';
require_once '../Model/Tag.php';

use \tagtools\Model\User;
use \tagtools\Model\File;
use \tagtools\Model\Tag;

session_start();

$user = new User($_SESSION['email']);

if ($user->isPresentUserData())
{
    $file = new File($user->getEmail());
    $tag = new Tag($user->getEmail());

    $file->deleteUserData();
    $tag->deleteUserData();
}

header('Location: ../heupload.php');