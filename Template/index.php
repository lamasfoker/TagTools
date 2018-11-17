<?php
use tagtools\Controller\Index;

require_once '../Controller/Index.php';

session_start();

$controller = new Index($_SESSION['email']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="TagTools is a web application that manage image and tag, it's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="CloudFind, TagTools, XML">
    <title>TagTools | ClounFind plugin</title>
    <!-- Icon-->
    <link rel="icon" href="../media/icon/logo-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon-precomposed" href="../media/icon/logo-152x152.png">
    <!-- CORE CSS-->
    <link href="../vendor/View/css/materialize.css" type="text/css" rel="stylesheet">
    <link href="../vendor/View/css/style.css" type="text/css" rel="stylesheet">
    <!-- Custom CSS-->
    <link href="../View/css/custom.css" type="text/css" rel="stylesheet">
    <!-- CSS style Horizontal Nav-->
    <link href="../vendor/View/css/style-horizontal.css" type="text/css" rel="stylesheet">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="../vendor/View/css/prism.css" type="text/css" rel="stylesheet">
    <link href="../vendor/View/css/perfect-scrollbar.css" type="text/css" rel="stylesheet">
    <!-- GOOGLE ICON -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body id="layouts-horizontal">
<!-- Start Page Loading
   <div id="loader-wrapper">
     <div id="loader"></div>
     <div class="loader-section section-left"></div>
     <div class="loader-section section-right"></div>
   </div>-->
<!-- End Page Loading -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START HEADER -->
<header id="header" class="page-topbar">
    <div class="navbar-fixed">
        <nav class="navbar-color red light-green">
            <div class="nav-wrapper">
                <ul class="left">
                    <li>
                        <h1 class="logo-wrapper">
                            <a href="../index.php" class="brand-logo darken-1">
                                <img src="../media/icon/materialize-logo.png" alt="materialize logo">
                                <span class="logo-text hide-on-med-and-down">TagTools</span>
                            </a>
                        </h1>
                    </li>
                </ul>
                <div class="header-search-wrapper hide-on-med-and-down">
                    <i class="material-icons">search</i>
                    <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Search" id="search"/>
                </div>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a href="#" class="waves-effect waves-block waves-light settings-button">
                            <i class="material-icons">content_copy<small id="row-counter" class="notification-badge pink accent-2">0</small></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-block waves-light settings-button" data-activates="settings-dropdown">
                            <i class="material-icons">settings</i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-block waves-light profile-button" data-activates="profile-dropdown">
                            <i class="material-icons">account_circle</i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-block waves-light download-button" data-activates="download-dropdown">
                            <i class="material-icons">file_download</i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-block waves-light tag-button" id="change-table-btn">
                            <i class="material-icons">local_offer</i>
                        </a>
                    </li>
                </ul>
                <!-- settings-dropdown -->
                <ul id="settings-dropdown" class="dropdown-content">
                    <li>
                        <a href="/data/<?= $_SESSION['email']; ?>.csv" class="grey-text text-darken-1 modal-trigger" download="database.csv">
                            <i class="material-icons">cloud_download</i> Scarica il CSV</a>
                    </li>
                    <li>
                        <a href="#modal_newDB" class="grey-text text-darken-1 modal-trigger">
                            <i class="material-icons">cloud_upload</i> Crea nuovo Database</a>
                    </li>
                </ul>
                <!-- profile-dropdown -->
                <ul id="profile-dropdown" class="dropdown-content">
                    <li>
                        <a href="mailto:<?= $_SESSION['email']; ?>" class="grey-text text-darken-1">
                            <i class="material-icons"><img src="<?= $_SESSION['imageUrl']; ?>" class="circle" id="userImg"/></i>
                            <?= $_SESSION['name']; ?>
                        </a>
                    </li>
                    <li>
                        <a href="../upload.php?logout='1'" class="grey-text text-darken-1 modal-trigger">
                            <i class="material-icons">keyboard_tab</i> Logout</a>
                    </li>
                </ul>
                <!-- download-dropdown -->
                <ul id="download-dropdown" class="dropdown-content">
                    <li>
                        <a href="#" class="grey-text text-darken-1" id="file-download-btn">
                            <i class="material-icons">archive</i> Download Immagini</a>
                    </li>
                    <li>
                        <a href="#" class="grey-text text-darken-1" id="xml-download-btn">
                            <i class="material-icons">assignment_returned</i> Download XML</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- END HEADER -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START MAIN -->
<div id="main">
    <!-- Modal new database -->
    <div id="modal_newDB" class="modal">
        <div class="modal-content">
            <h4>Creare un nuovo Database?</h4>
            <p>Creare un nuovo database richiede l'eliminazione di quello corrente. Puoi fare il download del database dalle Impostazioni per evitare la perdita di dati</p>
        </div>
        <div class="modal-footer">
            <a href="../Service/delete_user_db.php" class="modal-close waves-effect waves-green btn-flat" id="new-database">Nuovo</a>
            <a class="modal-close waves-effect waves-green btn-flat">Annulla</a>
        </div>
    </div>
    <!-- FORM HIDDEN -->
    <div id="form-wrapper">
        <form action="../Service/xml_maker.php" id="xml-download-form" method="post">
            <input type="submit">
        </form>
        <form action="../Service/file_downloader.php" id="file-download-form" method="post">
            <input type="submit">
        </form>
    </div>
    <!-- START WRAPPER -->
    <div class="wrapper">
        <!-- //////////////////////////////////////////////////////////////////////////// -->
        <!-- START CONTENT -->
        <div class="row">
            <div class="col l3">
                <div class="card-panel">
                    <span id="item-selected">Immagini Selezionate</span>
                    <div class="divider"></div>
                    <table id="selected-table" class="highlight"></table>
                    <ul id="selected-file-pagination" class="pagination"></ul>
                </div>
            </div>
            <div class="col l9">
                <div class="card-panel" id="table-container">
                    <?php $controller->printTables(); ?>
                </div>
            </div>
        </div>
        <!-- END CONTENT -->
        <!-- //////////////////////////////////////////////////////////////////////////// -->
    </div>
    <!-- END WRAPPER -->
</div>
<!-- END MAIN -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START FOOTER -->
<footer class="page-footer light-green">
    <div class="footer-copyright">
        <div class="container">
               <span>Copyright ©
                   <?= date("Y"); ?> <a class="grey-text text-lighten-4" href="https://t.me/LamasFoker" target="_blank">LamaFoker</a> All rights reserved.</span>
            <span class="right hide-on-small-only"> Design and Developed by <a class="grey-text text-lighten-4" href="https://t.me/LamasFoker/">LamaFoker</a></span>
            <!-- TODO: change the name of the web app in the footer -->
        </div>
    </div>
</footer>
<!-- END FOOTER -->
<!-- Scripts -->
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
<!--custom-script.js - Add your own theme custom JS-->
<script type="text/javascript" src="../View/js/custom-script.js"></script>
<!-- search -->
<script type="text/javascript" src="../View/js/search.js"></script>
<!-- pagination -->
<script type="text/javascript" src="../View/js/pagination.js"></script>
</body>
</html>