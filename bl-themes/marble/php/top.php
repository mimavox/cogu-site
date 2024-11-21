<aside id="fh5co-hero" class="js-fullheight">
	<div class="flexslider js-fullheight">
		<ul class="slides">
		<?php if($service_child_page): ?>
			<?php foreach($staticContent as $static): ?>
			<?php if($static->isChild() && $static->parentKey('slug') == 'service'): ?>
			<li style="background-image: url(<?php echo ($static->coverImage()?$static->coverImage():HTML_PATH_THEME_IMG.'noimg.png') ?>);">
				<div class="overlay"></div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center js-fullheight slider-text">
							<div class="slider-text-inner">
								<h1><?php echo $static->title(); ?></h1>
								<h2><?php echo $static->description()?$static->description():$language->p('Plase add a description'); ?></h2>
								<p><a class="btn btn-primary" href="<?php echo $static->permalink(); ?>"><?php echo $language->p('Learn More'); ?><i class="icon-arrow-right3"></i></a></p>
							</div>
						</div>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php endforeach; ?>
			<?php else: ?>
				<li style="background-image: url(<?php echo HTML_PATH_THEME_IMG.'noimg.png'; ?>);">
				<div class="overlay"></div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center js-fullheight slider-text">
							<div class="slider-text-inner">
								<h1><?php echo $language->p('Add a static page with slug name service and'); ?></h1>
								<h2><?php echo $language->p('create a child page introducing the service with cover image'); ?></h2>
							</div>
						</div>
					</div>
				</div>
			</li>
			<?php endif; ?>
		</ul>
	</div>
</aside>

<?php Theme::plugins('pageBegin'); ?>

<?php Theme::plugins('pageEnd'); ?>

<?php if($service_page){include(THEME_DIR_PHP.'service.php');};	?>
