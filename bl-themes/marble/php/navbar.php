<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>

<aside id="fh5co-aside" role="complementary" class="border js-fullheight">
	<h1 id="fh5co-logo"><a href="<?php echo Theme::siteUrl() ?>"><?php echo $site->title() ?></a></h1>
	<nav id="fh5co-main-menu" role="navigation">
		<ul>
		<?php
		foreach ($staticContent as $menu):
			if ($menu->slug() != "front"){
				if (!$menu->isChild()){
					
					echo "<li><a href=".$menu->permalink().">".$menu->title()."</a></li>";
				}
			}
		endforeach;
		?>
		</ul>
	</nav>

	<div class="fh5co-footer">
		<p><small><?php echo $site->footer(); ?> <span>Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a> </span> <span class="ml-5 text-warning">Powered by <a target="_blank" class="text-white" href="https://www.bludit.com">Bludit</a></span></p>
		<ul>
			<?php
			if(count(Theme::socialNetworks())>0):
				foreach (Theme::socialNetworks() as $key=>$label):
					echo '<li><a href="'.$site->{$key}().'"><i class="icon-'.strtolower($label).'"></i></a></li>';
				endforeach;
			endif;
			?>
		</ul>
	</div>

</aside>
