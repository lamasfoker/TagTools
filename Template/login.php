<!DOCTYPE html>
<html xmlns:https="http://www.w3.org/1999/xhtml">
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
    <link href="../vendor/view/css/materialize.css" type="text/css" rel="stylesheet">
    <link href="../vendor/view/css/style.css" type="text/css" rel="stylesheet">
    <!-- Custom CSS-->
    <link href="../View/css/custom.css" type="text/css" rel="stylesheet">
    <!-- Background CSS-->
    <link href="../View/css/background.css" type="text/css" rel="stylesheet">
    <!-- CSS style Horizontal Nav-->
    <link href="../vendor/view/css/style-horizontal.css" type="text/css" rel="stylesheet">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="../vendor/view/css/prism.css" type="text/css" rel="stylesheet">
    <link href="../vendor/view/css/perfect-scrollbar.css" type="text/css" rel="stylesheet">
    <!-- GOOGLE ICON -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- login google -->
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="1056844128019-1ut7v3eude57a6u2barhcu6iuhc5ra88.apps.googleusercontent.com">
</head>
<body>
<img src="../media/images/background.jpg" class="background"/>
<div id="main">
    <div class="container">
        <div id="login" class="section">
            <img src="../media/images/logoTitle.png" />
            <div class="g-signin2" data-onsuccess="onSignIn"></div>
            <div id="form-wrapper">
                <form action="../Service/user_registration.php" id="login-form" method="post">
                    <input type="hidden" name="name" value="" id="name">
                    <input type="hidden" name="email" value="" id="email">
                    <input type="hidden" name="imageUrl" value="" id="imageUrl">
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- jQuery Library -->
<script type="text/javascript" src="../vendor/view/js/jquery-3.3.1.js"></script>
<!--materialize js-->
<script type="text/javascript" src="../vendor/view/js/materialize.min.js"></script>
<!--prism
   <script type="text/javascript" src="js/prism.js"></script>-->
<!--scrollbar -->
<script type="text/javascript" src="../vendor/view/js/perfect-scrollbar.min.js"></script>
<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="../vendor/view/js/plugins.js"></script>
<!--css-transition.js - Page specific JS
   <script type="text/javascript" src="js/css-transition.js"></script>-->
<!-- login google -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script type="text/javascript" src="../View/js/google-login.js"></script>
</body>
</html>