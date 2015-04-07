<div class="box-timer-bg">
  <div class="ib">
    <div class="title">
        <span style="font-size: <?php echo $title_font_size; ?>px"><?php echo $title ?></span>
    </div>
  </div>
  <div class="box-img-stop-date ib">
      <img src="<?php echo $image ?>" alt="<?php echo $title ?>">
      <div class="stop-date btn-style volume">до <?php echo $date_stop ?></div>
  </div>
  <div class="clock ib"></div>
</div>
<script type="text/javascript">
    var clock;
    var currentDate = ''+ <?php echo $start; ?> + '';
    var futureDate  = ''+ <?php echo $stop; ?> + '';
    var diff = futureDate - currentDate;

    clock = $('.clock').FlipClock(diff, {
        clockFace: 'DailyCounter',
        autoStart: false,
        language: 'russian'
    });

    clock.setCountdown(true);
    //clock.start();
</script>
