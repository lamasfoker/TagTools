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
    <link rel="icon" href="../media/icon/logo-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon-precomposed" href="../media/icon/logo-152x152.png">
    <!-- CORE CSS-->
    <link href="../vendor/View/css/materialize.css" type="text/css" rel="stylesheet">
    <link href="../vendor/View/css/style.css" type="text/css" rel="stylesheet">
    <!-- Custom CSS-->
    <link href="../View/css/custom.css" type="text/css" rel="stylesheet">
    <!-- Background CSS-->
    <link href="../View/css/background.css" type="text/css" rel="stylesheet">
    <!-- CSS style Horizontal Nav-->
    <link href="../vendor/View/css/style-horizontal.css" type="text/css" rel="stylesheet">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="../vendor/View/css/prism.css" type="text/css" rel="stylesheet">
    <link href="../vendor/View/css/perfect-scrollbar.css" type="text/css" rel="stylesheet">
    <!-- GOOGLE ICON -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<img src="../media/images/background.jpg" class="background"/>
<div id="main" >
    <div class="container">
        <div id="upload" class="section">
            <img src="../media/images/logoTitle.png" />
            <div id="form-wrapper card-panel">
                <form action="../Service/import_csv.php" enctype='multipart/form-data' method="post">
                    <input id="real-file-btn" type='file' name='userFile' class="hide">
                    <a id="file-btn" class="waves-effect waves-light btn">Scegli un file</a><br><br>
                    <button id="submit" type='submit' name='upload_btn' class="waves-effect waves-light btn disabled">Upload</button><br><br>
                    <a href="../upload.php?logout='1'" class="waves-effect waves-light btn">Logout</a>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ================================================
   Scripts
   ================================================ -->
<!-- jQuery Library -->
<script type="text/javascript" src="../vendor/View/js/jquery-3.3.1.js"></script>
<!--materialize js-->
<script type="text/javascript" src="../vendor/View/js/materialize.min.js"></script>
<!--prism
   <script type="text/javascript" src="js/prism.js"></script>-->
<!--scrollbar -->
<script type="text/javascript" src="../vendor/View/js/perfect-scrollbar.min.js"></script>
<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="../vendor/View/js/plugins.js"></script>
<!--css-transition.js - Page specific JS
   <script type="text/javascript" src="js/css-transition.js"></script>-->
<!-- Upload Button -->
<script type="text/javascript" src="../View/js/upload.js"></script>
</body>
</html>