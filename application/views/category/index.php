<div class="collection">
<?php
  foreach($categories as $category){
    if($category->is_sub_category == 0){
      echo'<a href="/categories/category/' . $category->id .'" class="collection-item">' . $category->category_name . '</a>';
    }
  }
?>
</div>
