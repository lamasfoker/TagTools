<?php
session_start();
include 'config.php';

if (!isset($_SESSION['email'])) {
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    unset($_SESSION['name']);
    header("location: login.php");
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT COUNT(*) AS total FROM File WHERE email='$email'";
    $db = getdb();
    $result = mysqli_query($db, $query);
    $count = mysqli_fetch_assoc($result);
    if ($count['total']>0) {
        header("location: index.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="description" content="TagTools is a web application that manage image and tag, it's modern, responsive and based on Material Design by Google. ">
        <meta name="keywords" content="CloudFind, TagTools, XML">
        <title>TagTools | Sowftware that implement ClounFind</title>
        <!-- Icon-->
        <link rel="icon" href="icon/logo-32x32.png" sizes="32x32">
        <link rel="apple-touch-icon-precomposed" href="icon/logo-152x152.png">
        <!-- CORE CSS-->
        <link href="css/materialize.css" type="text/css" rel="stylesheet">
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <!-- Custom CSS-->
        <link href="css/custom.css" type="text/css" rel="stylesheet">
        <!-- CSS style Horizontal Nav-->
        <link href="css/style-horizontal.css" type="text/css" rel="stylesheet">
        <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
        <link href="css/prism.css" type="text/css" rel="stylesheet">
        <link href="css/perfect-scrollbar.css" type="text/css" rel="stylesheet">
        <!-- GOOGLE ICON -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="card-panel col l3 push-l4">
                        <h3>TagTools</h3>
                        <div id="upload" class="section">
                            <form action='functions.php' method='POST' enctype='multipart/form-data'>
                                <!-- notification message -->
                                <?php if (isset($_SESSION['success'])) : ?>
                                    <div class="error success" >
                                        <p>
                                            <?php
                                            echo $_SESSION['success'];
                                            unset($_SESSION['success']);
                                            ?>
                                        </p>
                                    </div>
                                <?php endif ?>
                                <!-- logged in user information -->
                                <?php  if (isset($_SESSION['email'])) : ?>
                                    <p>Benvenuto <strong><?= $_SESSION['name']; ?></strong></p>
                                <?php endif ?>
                                <input type='file' name='userFile'><br><br>
                                <button type='submit' name='upload_btn' class="waves-effect waves-light btn">Upload</button>
                            </form>
                            <a href="upload.php?logout='1'">LOGOUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ================================================
        Scripts
        ================================================ -->
        <!-- jQuery Library -->
        <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
        <!--materialize js-->
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!--prism
        <script type="text/javascript" src="js/prism.js"></script>-->
        <!--scrollbar -->
        <script type="text/javascript" src="js/perfect-scrollbar.min.js"></script>
        <!--plugins.js - Some Specific JS codes for Plugin Settings-->
        <script type="text/javascript" src="js/plugins.js"></script>
        <!--css-transition.js - Page specific JS
        <script type="text/javascript" src="js/css-transition.js"></script>-->
    </body>
</html>
