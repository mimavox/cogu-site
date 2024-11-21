<?php if (empty($content)): ?>
<div class="fh5co-narrow-content">
  <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Read Our Blog</h2>
  <div class="row row-bottom-padded-md">
    <div class="col-md-3 col-sm-6 col-padding animate-box" data-animate-effect="fadeInLeft">
      <div class="blog-entry">
        <a href="#" class="blog-img"><img src="<?php echo HTML_PATH_THEME_IMG.'noimg.png' ?>" class="img-responsive" alt=""></a>
        <div class="desc">
          <h3><?php echo $language->p('Not post found'); ?></h3>
        </div>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
<div class="fh5co-narrow-content">

  <?php foreach($staticContent as $static):
    
    if($static->slug() == "front"){$static_title = $static->title(); $static_content = $static->content(); $description_page = true; }
    endforeach;

    if($description_page == true){ ?>
        <div class="jumbotron">
          <h1><?php echo $static_title ?></h1>
          <div class="lead"><?php echo $static_content ?></div>
        </div>

    <?php } ?>

	<div class="row row-bottom-padded-md">
	<?php foreach($content as $page):?>
		<div class="col-md-3 col-sm-6 col-padding animate-box" data-animate-effect="fadeInLeft">
			<div class="blog-entry">
				<a href="<?php echo $page->permalink() ?>" class="blog-img"><img src="<?php echo $page->coverImage()?$page->coverImage():HTML_PATH_THEME_IMG.'noimg.png'; ?>" class="img-responsive" alt=""></a>
				<div class="desc">
					<h3><a href="<?php echo $page->permalink() ?>"><?php echo limitText($page->title(),32); ?></a></h3>
					<span><small>by <?php echo $page->user('nickname'); ?> </small> / <small> <?php echo $page->category(); ?> </small> / <small> <i class="icon-comment"></i> <?php echo $page->date(); ?></small></span>
					<p><?php echo limitText($page->contentBreak(),100); ?></p>
					<a href="<?php echo $page->permalink() ?>" class="lead"><?php $language->p('Read More') ?><i class="icon-arrow-right2"></i></a>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
  <!-- Pagination -->
  <?php if (Paginator::numberOfPages()>1): ?>
  <nav class="paginator">
    <ul class="pagination flex-wrap">

      <!-- Previous button -->
      <?php if (Paginator::showPrev()): ?>
      <li class="page-item mr-2">
        <a class="page-link" href="<?php echo Paginator::previousPageUrl() ?>" tabindex="-1">&#9668; <?php echo $L->get('Previous'); ?></a>
      </li>
      <?php endif; ?>

      <!-- Home button -->
      <li class="page-item <?php if (Paginator::currentPage()==1) echo 'disabled' ?>">
        <a class="page-link" href="<?php echo Theme::siteUrl() ?>">Home</a>
      </li>

      <!-- Next button -->
      <?php if (Paginator::showNext()): ?>
      <li class="page-item ml-2">
        <a class="page-link" href="<?php echo Paginator::nextPageUrl() ?>"><?php echo $L->get('Next'); ?> &#9658;</a>
      </li>
      <?php endif; ?>

    </ul>
  </nav>
  <?php endif ?>
</div>

<?php endif ?>
