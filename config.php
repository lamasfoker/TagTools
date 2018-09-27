<?php
function getdb()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "tagtools";

    try {
        $con = mysqli_connect($servername, $username, $password, $db);
    }
    catch(exception $e)
    {
        //TODO: make a log
        echo "Connection failed: " . $e->getMessage();
    }
    return $con;
}