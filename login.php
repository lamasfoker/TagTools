<?php

if (isset($_SESSION['email'])) {
    header('location: Template/upload.phtml');
}

header('location: Template/login.phtml');