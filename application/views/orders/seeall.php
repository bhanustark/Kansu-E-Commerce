

  <ul class="collection">
  <?php
  
    $total = array();

   ?>

  <?php foreach($all as $one){ ?>
    <li class="collection-item avatar">
      <img src="https://cdn.kansu.in/kansu/image/<?=$one->product_photo?>" alt="" class="circle">
       <span class="title"><strong><?=$one->product_name?></strong></span>
      <p><?php echo substr($one->product_description,0,100); echo "...";?>
      </p>
    </li>

    <?php } ?>

  </ul>

  <?php
  
   ?>
