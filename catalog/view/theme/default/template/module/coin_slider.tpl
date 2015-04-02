<?php if ($slider_config['status'] == 1) { ?>

<div class="box-slider">
  <div class="slider">
    <?php foreach ($sliders as $slider) { ?>
      <div class="slide" style="background-color: #<?php echo $slider['slide_background_color']; ?>">
        <div class="slider-content site-content" style="background: url(<?php echo $slider['image']; ?>) 50% 50% no-repeat">
          <?php if($slider['link'] != '') { ?>
            <a class="btn-style volume more" href="<?php echo $slider['link']; ?>">Подробнее</a>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>
  <div class="prev"></div>
  <div class="next"></div>
  <div class="wrap-pager">
    <div class="pager"></div>
  </div>
</div>

<?php } ?>


