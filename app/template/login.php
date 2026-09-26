<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">

<head>
    <title>SBiZ Affiliate</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="HR - Mahira Global Nusantara" />
    <meta name="keywords" content="HR - Mahira Global Nusantara">
    <meta name="author" content="Srthemesvilla" /> 
    <link rel="icon" type="image/x-icon" href="<?php echo $config['app']['assets'] ?>/img/favicon.png">

    <!-- Icon fonts --> 
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/fontawesome.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/ionicons.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/linearicons.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/open-iconic.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/feather.css">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>css/bootstrap-material.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>css/shreerang-material.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>css/uikit.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>css/pages/authentication.css">    

    <!-- Libs -->
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>libs/perfect-scrollbar/perfect-scrollbar.css">


</head>

<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] Ebd -->

    <?php echo $templateContent ?>

    <!-- Core scripts -->
    <script src="<?php echo $config['app']['assets'] ?>js/pace.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>libs/popper/popper.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>js/bootstrap.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>js/sidenav.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>js/layout-helpers.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>js/material-ripple.js"></script>

    <!-- Demo -->
    <script src="<?php echo $config['app']['assets'] ?>js/demo.js"></script>


    <?php echo $embedCssJS ?>
</body>

</html>
