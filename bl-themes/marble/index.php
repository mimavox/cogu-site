<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="<?php echo Theme::lang() ?>"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="<?php echo Theme::lang() ?>"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="<?php echo Theme::lang() ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php echo Theme::lang() ?>"> <!--<![endif]-->
	<head>
	<?php include(THEME_DIR_PHP.'head.php'); ?>
	</head>
	<body>
		<div id="fh5co-page">
		<?php Theme::plugins('siteBodyBegin'); ?>

		<?php include(THEME_DIR_PHP.'navbar.php'); ?>

		<?php
		// strip tags to avoid breaking any html
		#  https://stackoverflow.com/questions/4258557/limit-text-length-in-php-and-provide-read-more-link
		function limitText($string,$size=140){
			$string = strip_tags($string,$size);
			if (mb_strlen($string) > $size) {
			// truncate string
			$stringCut = mb_substr($string, 0, $size);
			$endPoint = mb_strrpos($stringCut, ' ');
			//if the string doesn't contain any space then it will cut without word basis.
			$string = $endPoint ? mb_substr($stringCut, 0, $endPoint) : mb_substr($stringCut, 0);
			$string .= '...';
			}
			return $string;
		} ?>

		<?php
		// check service page and contact page
			$service_page = false;
			$service_child_page =false;
			$contact_page = false;
			foreach($staticContent as $static):
				if($static->slug() == "service"){ $service_page = true; };
				if($static->parentKey('slug') == 'service'){$service_child_page = true;};
				if($static->slug() == "contact"){ $contact_page = true; };
			endforeach;
			?>

		<div id="fh5co-main">
		<?php
		if ($WHERE_AM_I == 'home' || $WHERE_AM_I == 'blog'):
			include(THEME_DIR_PHP.'home.php');
		elseif ($page->template()):
			$file = THEME_DIR_PHP.$page->template().'.php';
			if (file_exists($file)) {include($file);} else {include(THEME_DIR_PHP.'page.php');}
		else:
			include(THEME_DIR_PHP.'page.php');
		endif;
		?>

		<?php if ($contact_page){ include(THEME_DIR_PHP.'contact.php'); };?>
		</div>
	</div>

	<!-- jQuery -->
	<?php echo Theme::js('js/jquery.min.js'); ?>
	<!-- jQuery Easing -->
	<?php echo Theme::js('js/jquery.easing.1.3.js'); ?>
	<!-- Bootstrap -->
	<?php echo Theme::js('js/bootstrap.min.js'); ?>
	<!-- Waypoints -->
	<?php echo Theme::js('js/jquery.waypoints.min.js'); ?>
	<!-- Flexslider -->
	<?php echo Theme::js('js/jquery.flexslider-min.js'); ?>

	<!-- MAIN JS -->
	<?php echo Theme::js('js/main.js'); ?>

	<?php Theme::plugins('siteBodyEnd'); ?>
	</body>
</html>

