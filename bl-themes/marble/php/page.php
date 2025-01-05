<div class="fh5co-narrow-content">
    <div class="row row-bottom-padded-md">
        
        <div class="jumbotron container">

            <?php if($page->coverImage()): ?>
                <div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
                    <img class="img-responsive" src="<?php echo $page->coverImage(); ?>" alt="">
                </div>
            <?php endif; ?>
                <div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
                    <?php Theme::plugins('pageBegin'); ?>
                    <h1 class="fh5co-heading"><?php echo $page->title(); ?></h1>
                    <?php echo $page->content(); ?>
                </div>
            
        </div>
    </div>
        <?php if($url->slug() == "research"): 

            $categoryKey = 'research';
            $category = getCategory($categoryKey);
            if ($category): ?>
                <div class="row row-bottom-padded-md">
                <?php foreach ($category->pages() as $pageKey):
                    $page = new Page($pageKey); ?>

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
            <?php endif; 
        
        elseif($url->slug() == "about"):

            $categoryKey = 'people';
            $category = getCategory($categoryKey);
            if ($category): ?>
                <div class="row row-bottom-padded-md">
                <?php foreach ($category->pages() as $pageKey):
                    $page = new Page($pageKey); ?>

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
            <?php endif;

        endif; ?>

        <?php Theme::plugins('pageEnd'); ?>

</div>
<?php if ($service_page){ include(THEME_DIR_PHP.'service.php'); }; ?>