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
          <h2>Террасные покрытия</h2>
          <p>Главной особенностью материала является технология производства. ДПК представляет собой смесь дерева и пластмассы, которая одновременно обладает качествами каждого из двух основных компонентов.</p>
          <a class="link-cat" href="#">Каталог</a><br>
          <a class="link-price" href="#">Узнать цены</a>
        </div>
      </div>
    <?php } ?>
  </div>
  <div class="prev"></div>
  <div class="next"></div>
  <div class="pager"></div>
</div>

<?php } ?>


