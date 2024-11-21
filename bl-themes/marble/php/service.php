  <div class="fh5co-narrow-content">
    <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft"><?php echo $language->p('Our Services'); ?></h2>
     <div class="row">
    <?php if($service_child_page): ?>
      <?php foreach($staticContent as $static): ?>
        <?php if($static->isChild() && $static->parentKey('slug') == 'service'): ?>
      <div class="col-md-6">
        <div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
          <div class="fh5co-icon">
            <i class="<?php echo $static->custom('icon')?"icon-".$static->custom('icon'):"icon-office"; ?>"></i>
          </div>
          <div class="fh5co-text">
            <h3><a href="<?php echo $static->permalink() ?>"><?php echo $static->title() ?></a></h3>
            <p><?php echo $static->description()?limittext($static->description(),140):$language->p('Plase add a description'); ?></p>
          </div>
        </div>
      </div>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-md-6">
        <div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
          <div class="fh5co-icon"><i class="icon-paperplane"></i></div>
          <div class="fh5co-text">
            <h3><?php echo $language->p('Create a child page on the service page that introduces the service') ?></h3>
          </div>
        </div>
      </div>
    <?php endif; ?>
    </div>
  </div>
