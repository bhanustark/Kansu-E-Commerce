<div class="container">

  <div class="row">
    <?php foreach ($products as $product) { ?>
  <div class="col-sm-3" style="margin-top: 20px;">
    <div class="card">
      <div class="card-body">
        <img src="https://cdn.kansu.in/kansu/image/<?=$product->product_photo?>" class="card-img-top" alt="...">
        <h5 class="card-title"><?=$product->product_name?></h5>
        <p class="card-text"><?php echo nl2br($product->product_description); ?></p>
        <a href="/kadmin/orders" class="btn btn-primary">Go Back</a>
      </div>
    </div>
  </div>
    <?php } ?>
  </div>

</div>
<script type="text/javascript">
  $(".nav-item").removeClass("active");
  $("#ordersMenuItem").addClass("active");
</script>