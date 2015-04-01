<?php if ($slider_config['status'] == 1) { ?>

<!--	<div id="coin-slider<?php echo $module; ?>">-->
<!--	  <?php foreach ($sliders as $slider) { ?>-->
<!--		  <?php if ($slider['link']) { ?>-->
<!--		  	<a href="<?php echo $slider['link']; ?>" <?php if ($slider_config['link_new_tab'] == 0) { ?> target="_blank" <?php } ?> >-->
<!--				<img src="<?php echo $slider['image']; ?>">-->
<!--				<span>-->
<!--					<span class="title"><?php echo $slider['title']; ?></span>-->
<!--					<span class="subtitle">-->
<!--						<?php echo $slider['subtitle']; ?>-->
<!--					</span>-->
<!--				</span>-->
<!--			</a>-->
<!--		  <?php } else { ?>-->
<!--		  	<img src="<?php echo $slider['image']; ?>">-->
<!--			<span>-->
<!--				<span class="title"><?php echo $slider['title']; ?></span>-->
<!--				<span class="subtitle">-->
<!--					<?php echo $slider['subtitle']; ?>-->
<!--				</span>-->
<!--			</span>-->
<!--		  <?php } ?>-->
<!--	  <?php } ?>-->
<!--	</div>-->

<div class="box-slider">
  <div class="slider">
    <?php foreach ($sliders as $slider) { ?>
      <div class="slide">
        <div class="site-content">
          <img src="<?php echo $slider['image']; ?>" alt="<?php echo $slider['title']; ?>">
        </div>
      </div>
    <?php } ?>
  </div>
  <div class="prev"></div>
  <div class="next"></div>
  <div class="pager"></div>
</div>

<?php } ?>


