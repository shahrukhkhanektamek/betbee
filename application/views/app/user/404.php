<!DOCTYPE html>
<html lang="en">
<head>
	
	<title><?=website_name ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="theme-color" content="#009688">
	<meta name="format-detection" content="telephone=no">

	<!-- Favicons Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url() ?>assets/images/favicon.png">
    
	<!-- Globle Stylesheets -->
    
	<!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?=base_url() ?>assets/css/style.css">
    
    <!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@100;200;300;400;500;600;700;800;900;1000&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet">

</head>   
<body>
<div class="page-wrapper">
    
	<!-- Preloader -->
	<div id="preloader">
		<div class="loader">
			<div class="load-circle"><div></div><div></div></div>
		</div>
	</div>
    <!-- Preloader end-->
	
	<!-- Header -->
		<header class="header shadow header-fixed border-0">
			<div class="container">
				<div class="header-content">
					<div class="left-content">
						<a href="javascript:void(0);" class="back-btn">
							<i class="icon feather icon-chevron-left"></i>
						</a>
						<h6 class="title">Not Found</h6>
					</div>
					<div class="mid-content">
					</div>
					<div class="right-content">
					</div>
				</div>
			</div>
		</header>
	<!-- Header -->
	
	<!-- Page Content Start -->
	<div class="page-content space-top">
		<div class="container">
			<div class="error-page">
				<div class="icon-bx">
					<img src="<?=base_url() ?>assets/images/error2.svg" alt="">
				</div>
				<div class="clearfix">
					<h2 class="title text-primary">Sorry</h2>
					<p>Requested content not found.</p>
				</div>
			</div>
			<div class="error-img">
				<img src="<?=base_url() ?>assets/images/error.png" alt="">
			</div>
		</div>
	</div>
	<!-- Page Content End -->
</div>  
<!--**********************************
    Scripts
***********************************-->
<script src="<?=base_url() ?>assets/js/jquery.js"></script>
<script src="<?=base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url() ?>assets/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->
<script src="<?=base_url() ?>assets/js/dz.carousel.js"></script><!-- Swiper -->
<script src="<?=base_url() ?>assets/js/settings.js"></script>
<script src="<?=base_url() ?>assets/js/custom.js"></script>
</body>

</html>