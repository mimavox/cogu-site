<div class="fh5co-narrow-content">
	<div class="row row-bottom-padded-md">
	<?php if($page->coverImage()): ?>
		<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
			<img class="img-responsive" src="<?php echo $page->coverImage(); ?>" alt="">
		</div>
	<?php endif; ?>
		<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
		<?php Theme::plugins('pageBegin'); ?>
			<h1 class="fh5co-heading"><?php echo $page->title(); ?></h1>
			<?php echo $page->content(); ?>
		<?php Theme::plugins('pageEnd'); ?>
		</div>
	</div>
</div>

<?php if ($service_page){ include(THEME_DIR_PHP.'service.php'); }; ?>
