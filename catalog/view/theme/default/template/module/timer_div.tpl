
<?php echo $date_stop ?>
<span style="font-size: <?php echo $title_font_size; ?>px"><?php echo $title ?></span>
<?php echo $image ?>
<div class="clock"></div>

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
