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
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/application.css" />

<?php foreach ($styles as $style) { ?>
  <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>

<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/lib/jquery.placeholder.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<script type="text/javascript" src="catalog/view/javascript/app.js"></script>

<?php foreach ($scripts as $script) { ?>
  <script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>

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

</head>
<body>
<div id="container">
<div id="header" class="site-content">

  <a href="<?php echo $home; ?>" class="logo"><img src="/catalog/view/theme/default/image/app/logo.png" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a>

  <div class="header-contacts"></div>

  <?php echo $cart; ?>

  <div id="search">
    <div class="button-search"></div>
    <input type="text" name="search" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>" />
  </div>

</div>

<?php //if ($categories) { ?>
<!--  <div id="menu">-->
<!--    <ul>-->
<!--      --><?php //foreach ($categories as $category) { ?>
<!--      <li>--><?php //if ($category['active']) { ?>
<!--        <a href="--><?php //echo $category['href']; ?><!--" class="active">--><?php //echo $category['name']; ?><!--</a>-->
<!--        --><?php //} else { ?>
<!--        <a href="--><?php //echo $category['href']; ?><!--">--><?php //echo $category['name']; ?><!--</a>-->
<!--        --><?php //} ?>
<!---->
<!--        --><?php //if ($category['children']) { ?>
<!--        <div>-->
<!--          --><?php //for ($i = 0; $i < count($category['children']);) { ?>
<!--          <ul>-->
<!--            --><?php //$j = $i + ceil(count($category['children']) / $category['column']); ?>
<!--            --><?php //for (; $i < $j; $i++) { ?>
<!--            --><?php //if (isset($category['children'][$i])) { ?>
<!--            <li><a href="--><?php //echo $category['children'][$i]['href']; ?><!--">--><?php //echo $category['children'][$i]['name']; ?><!--</a></li>-->
<!--            --><?php //} ?>
<!--            --><?php //} ?>
<!--          </ul>-->
<!--          --><?php //} ?>
<!--        </div>-->
<!--        --><?php //} ?>
<!--      </li>-->
<!--      --><?php //} ?>
<!--    </ul>-->
<!--  </div>-->
<?php //} ?>

<div id="notification"></div>