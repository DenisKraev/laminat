<?php if(count($actions) > 0 ) { ?>
<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">

	<?php foreach($actions as $action) { ?>
	 	<div class="actionsModule">
		  	<?php if ($action['thumb']) { ?><a href="<?php echo $action['href']; ?>"><img src="<?php echo $action['thumb']; ?>" title="<?php echo $action['caption']; ?>" alt="<?php echo $action['caption']; ?>" /></a><?php } ?>
		    <div class="actionsHeader"><a href="<?php echo $action['href']; ?>"><?php echo $action['caption']; ?></a></div>
		    <?php if ($action['date']) { ?><div class="actionsDate"><?php echo $action['date']; ?></div><?php } ?>
			<div class="actionsDescription"><?php echo $action['anonnce']; ?></div>
		</div>
	<?php } ?>
	<div class="actionsReadAll"><a href="<?php echo $continue; ?>"><span><?php echo $text_read_all; ?></span></a></div>


  </div>
</div>
<?php } ?>
