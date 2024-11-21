<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php echo Theme::metaTags('title'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php echo Theme::metaTags('description'); ?>
<meta name="author" content="<?php echo empty($content)?"":$page->user('nickname') ?>">
<meta name="generator" content="Bludit">

<!--
//////////////////////////////////////////////////////

FREE HTML5 TEMPLATE
DESIGNED & DEVELOPED by FreeHTML5.co

Website: 		http://freehtml5.co/
Email: 			info@freehtml5.co
Twitter: 		http://twitter.com/fh5co
Facebook: 		https://www.facebook.com/fh5co

//////////////////////////////////////////////////////
-->

<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<?php echo Theme::favicon('favicon.ico'); ?>

<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<!-- Animate.css -->
<?php echo Theme::css('css/animate.css'); ?>
<!-- Icomoon Icon Fonts-->
<?php echo Theme::css('css/icomoon.css'); ?>
<!-- Bootstrap  -->
<?php echo Theme::css('css/bootstrap.css'); ?>
<!-- Flexslider  -->
<?php echo Theme::css('css/flexslider.css'); ?>
<!-- Theme style  -->
<?php echo Theme::css('css/style.css'); ?>
<!-- Plus styling -->
<?php echo Theme::css('css/plus.css'); ?>
<!-- Modernizr JS -->
<?php echo Theme::js('js/modernizr-2.6.2.min.js'); ?>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<?php echo Theme::js('js/respond.min.js'); ?>
<![endif]-->

<?php Theme::plugins('siteHead'); ?>
