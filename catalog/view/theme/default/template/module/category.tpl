<?php
function renderCategoriesTree($tree) {

  if (empty($tree['items'])) return;

  echo "<ul>";

  foreach ($tree['items'] as $item) {

    echo "<li class='".$item['active']."'>";
    echo "<a href='".$item['href']."' class='".$item['active']."'>".$item['name']."</a>";

    echo "<ul>";
    foreach ($item['items'] as $data) {
      echo "<li class='".$data['active']."'>";
      echo "<a href='".$data['href']."' class='".$data['active']."'>". $data['name']."</a>";
      renderCategoriesTree($data);
      echo "</li>";
    }
    echo "</ul>";

    echo "</li>";
  }

  echo "</ul>";
}
?>


<div class="box-category-menu">
  <div class="title"><?php echo $heading_title; ?></div>
  <div class="category-menu">
    <?php renderCategoriesTree($categories); ?>
  </div>
</div>