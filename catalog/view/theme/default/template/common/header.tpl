<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?></title>
<base href="<?php echo $base; ?>" />

<?php if ($description) { ?>
  <meta name="description" content="<?php echo $description; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
<?php } ?>

<?php if ($keywords) { ?>
  <meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>

<meta property="og:title" content="<?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $og_url; ?>" />

<?php if ($og_image) { ?>
  <meta property="og:image" content="<?php echo $og_image; ?>" />
<?php } else { ?>
  <meta property="og:image" content="<?php echo $logo; ?>" />
<?php } ?>
  <meta property="og:site_name" content="<?php echo $name; ?>" />
<?php if ($icon) { ?>
  <link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>

<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/normalize.css" />

<?php foreach ($links as $link) { ?>
  <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>

<!--<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/stylesheet.css" />-->

<?php foreach ($styles as $style) { ?>
  <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>

<!--<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/callbackphone/callbackphone.css" />-->
<!--<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/callbackphone/jquery-ui-timepicker-addon.css" />-->
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/tooltipster.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/jquery.fancybox.css" />

<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />

<!--<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen" />-->
<!--<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ocjoyajaxcheckout/font-awesome.min.css"/>-->
<!--<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ocjoyajaxcheckout/jquery.loadmask.css"/>-->



<script type="text/javascript" src="catalog/view/javascript/lib/jquery.placeholder.js"></script>
<script type="text/javascript" src="catalog/view/javascript/lib/jquery.tooltipster.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/lib/jquery.fancybox.pack.thumb.media.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>

<!--<script type="text/javascript" src="catalog/view/javascript/callbackphone/jquery-ui-timepicker-addon.js"></script>-->
<!--<script type="text/javascript" src="catalog/view/javascript/callbackphone/jquery-ui-timepicker-ru.js"></script>-->
<!--<script type="text/javascript" src="catalog/view/javascript/callbackphone/simplemodal.js"></script>-->
<!--<script type="text/javascript" src="catalog/view/javascript/callbackphone/mask.js"></script>-->

<script type="text/javascript" src="catalog/view/javascript/ocjoyajaxcheckout/ocjoyajaxcheckout.js"></script>
<!--<script type="text/javascript" src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js"></script>-->
<!--<script type="text/javascript" src="catalog/view/javascript/ocjoyajaxcheckout/inputmask.js"></script>-->
<!--<script type="text/javascript" src="catalog/view/javascript/ocjoyajaxcheckout/jquery.placeholder.js"></script>-->
<!--<script type="text/javascript" src="catalog/view/javascript/ocjoyajaxcheckout/jquery.loadmask.js"></script>-->

<?php foreach ($scripts as $script) { ?>
  <script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>

<script type="text/javascript" src="catalog/view/javascript/app.js"></script>

<?php if ($stores) { ?>
  <script type="text/javascript">
    <!--
    $(document).ready(function() {
      <?php foreach ($stores as $store) { ?>
      $('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
      <?php } ?>
    });
    //-->
  </script>
<?php } ?>

<?php echo $google_analytics; ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/application.css" />

</head>
<body>
<div id="notification"></div>
<div id="container">
<div id="header" class="site-content">

  <a href="<?php echo $home; ?>" class="logo">
      <img src="/catalog/view/theme/default/image/app/logo.png" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" />
      <span>Интернет-магазин напольных покрытий</span>
  </a>

  <div class="header-contacts">
    <div class="phone">8-922-925-5984</div>
    <div class="wrap-callback">
      <span>Заказать</span><a href="#callbackphone" class="link-style js-main-popup"><?php echo $this->config->get('callbackphone_link_title'); ?></a>
    </div>
  </div>

  <?php echo $cart; ?>

  <div id="search">
    <input class="form-search-style" type="text" name="search" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>" />
    <div class="button-search"></div>
  </div>

</div>

<div class="main-menu">
    <ul class="site-content">
      <?php foreach ($categories as $category) { ?>
        <li><a href="<?php echo $category['href']; ?>" class="<?php echo $category['active'] ? 'active' : ''; ?>"><?php echo $category['name']; ?></a></li>
      <?php } ?>
      <?php foreach ($informations as $information) { ?>
        <li><a href="<?php echo $information['href']; ?>" class="<?php echo $information['active'] ? 'active' : ''; ?>"><?php echo $information['title']; ?></a></li>
      <?php } ?>
    </ul>
</div>