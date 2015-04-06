
  <?php echo $date_stop ?>
  <?php echo $title ?>
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
