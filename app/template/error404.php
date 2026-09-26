<html>
	<head>
		<title>Simple CMS</title>

	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	    <link rel="icon" type="image/x-icon" href="<?php echo $config['app']['path'] ?>admin/assets/img/favicon.ico">

	    <!-- Icon fonts -->
	    <link rel="stylesheet" href="<?php echo $config['app']['path'] ?>admin/assets/fonts/fontawesome.css">
	    <link rel="stylesheet" href="<?php echo $config['app']['path'] ?>admin/assets/fonts/ionicons.css">
	    <link rel="stylesheet" href="<?php echo $config['app']['path'] ?>admin/assets/fonts/linearicons.css">
	    <link rel="stylesheet" href="<?php echo $config['app']['path'] ?>admin/assets/fonts/open-iconic.css">
	    <link rel="stylesheet" href="<?php echo $config['app']['path'] ?>admin/assets/fonts/pe-icon-7-stroke.css">
	    <link rel="stylesheet" href="<?php echo $config['app']['path'] ?>admin/assets/fonts/feather.css">

	    <!-- Core stylesheets -->
	    <link rel="stylesheet" href="<?php echo $config['app']['path'] ?>admin/assets/css/bootstrap-material.css">
	    <link rel="stylesheet" href="<?php echo $config['app']['path'] ?>admin/assets/css/shreerang-material.css">
	    <link rel="stylesheet" href="<?php echo $config['app']['path'] ?>admin/assets/css/uikit.css">

	    <!-- Libs -->
	    <link rel="stylesheet" href="<?php echo $config['app']['path'] ?>admin/assets/libs/perfect-scrollbar/perfect-scrollbar.css">
	    <!-- Page -->
	    <link rel="stylesheet" href="<?php echo $config['app']['path'] ?>admin/assets/css/pages/authentication.css">
	<head>	
	<body>

	<!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] End -->

    <!-- [ Content ] Start -->
    <div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style="background-image: url('<?php echo $config['app']['path'] ?>admin/assets/img/bg/21.jpg');">
        <div class="ui-bg-overlay bg-dark opacity-25"></div>

        <div class="authentication-inner py-5">

            <div class="card">
                <div class="p-4 p-sm-5">
                    <!-- [ Logo ] Start -->
                    <div class="d-flex justify-content-center align-items-center pb-2 mb-4">
                        <div class="ui-w-60">
                            <div class="w-100 position-relative">
                                <img src="<?php echo $config['app']['path'] ?>admin/assets/img/logo-dark.png" alt="Brand Logo" class="img-fluid">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- [ Logo ] End -->
                    <h5 class="text-center text-muted font-weight-normal mb-4">Ups....</h5>

                        <div class="alert alert-dark-danger alert-dismissible fade show">
                            Sorry... modul not found!!
                        </div>
                    <!-- [ Form ] End -->
                </div>
            </div>

        </div>
    </div>
    <!-- / Content -->
  	<!-- Core scripts -->
    <script src="<?php echo $config['app']['path'] ?>assets/js/pace.js"></script>
    <script src="<?php echo $config['app']['path'] ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $config['app']['path'] ?>assets/libs/popper/popper.js"></script>
    <script src="<?php echo $config['app']['path'] ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo $config['app']['path'] ?>assets/js/sidenav.js"></script>

    <!-- Libs -->
    <script src="<?php echo $config['app']['path'] ?>assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <!-- Demo -->
    <script src="<?php echo $config['app']['path'] ?>/assets/js/demo.js"></script>
</html>