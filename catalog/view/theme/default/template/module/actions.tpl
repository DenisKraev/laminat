<?php if(count($actions) > 0 ) { ?>
<div class="box-actions">
  <div class="site-content">

    <h3 class="title-style white"><a href="<?php echo $continue; ?>"><?php echo $heading_title; ?></a></h3>

    <div class="wrap-actions">
      <div class="actions-list" data-cycle-carousel-visible=<?php echo (count($actions) <= 2) ? count($actions): 2; ?>>

        <?php foreach($actions as $action) { ?>
          <div class="actions-item">
            <div class="cf">
              <?php if ($action['thumb']) { ?>
                <a class="box-img" href="<?php echo $action['href']; ?>">
                    <img src="<?php echo $action['thumb']; ?>" title="<?php echo $action['caption']; ?>" alt="<?php echo $action['caption']; ?>" />
                </a>
              <?php } ?>
              <div class="info">
                <div class="mark">Акция</div>
                <div class="title"><a href="<?php echo $action['href']; ?>"><?php echo $action['caption']; ?></a></div>
                <?php if ($action['date']) { ?>
                  <div class="date"><?php echo $action['date']; ?></div>
                <?php } ?>
                <div class="description"><?php echo $action['anonnce']; ?></div>
                <a class="more" href="<?php echo $action['href']; ?>">Подробнее</a>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>

      <div class="prev"></div>
      <div class="next"></div>
    </div>

  </div>
</div>
<?php } ?>
