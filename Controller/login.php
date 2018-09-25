<?php
include('../server.php');

if (isset($_SESSION['email'])) {
    header('location: ../Template/upload.phtml');
}