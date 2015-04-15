<?php
function renderCategoriesTree($tree) {

  if (empty($tree['items'])) return;

  echo "<ul>";

  foreach ($tree['items'] as $item) {

    echo "<li>";
    echo "<a href='".$item['href']."' class='".$item['active']."'>".$item['name']."</a>";

    echo "<ul>";
    foreach ($item['items'] as $data) {
      echo "<li>";
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


<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
    <div class="box-category">
      <?php renderCategoriesTree($categories); ?>
    </div>
  </div>
</div>
