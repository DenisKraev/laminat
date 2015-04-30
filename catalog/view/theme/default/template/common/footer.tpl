<div class="cf"></div>
<div id="push"></div>
</div>
<div id="footer">
    <div class="site-content">
        <div class="left">
            <div class="copy">&copy; Ламинат-бонус, <?php echo $copy; ?></div>
            <div class="footer-contacts">
                г. Киров, лица Некрасова дом № 77 (Производственная 28 б) <br>
                т.: 8(8332)-44-74-55, факс: 8(8332)-44-74-55 <br>
                E-mail: laminatmarket@mail.ru
            </div>
        </div>
        <div class="right">
          <div class="footer-menu">
              <ul>
                <?php foreach ($categories as $category) { ?>
                  <li><a href="<?php echo $category['href']; ?>" class="<?php echo $category['active'] ? 'active' : ''; ?>"><?php echo $category['name']; ?></a></li>
                <?php } ?>
                <?php foreach ($informations as $information) { ?>
                  <li><a href="<?php echo $information['href']; ?>" class="<?php echo $information['active'] ? 'active' : ''; ?>"><?php echo $information['title']; ?></a></li>
                <?php } ?>
              </ul>
          </div>
          <div class="pay">
              <p>Принимаем к оплате</p>
              <img src="/catalog/view/theme/default/image/app/pay-cards.png">
          </div>
            <div class="dev">
                <span>Сделано в</span>
                <img src="/catalog/view/theme/default/image/app/artnet-logo.png" alt="Разработка и дизайн сайтов Artnet Studio" title="Разработка и дизайн сайтов Artnet Studio">
                <a href="http://artnetdesign.ru/" target="_blank">Artnet Studio</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>