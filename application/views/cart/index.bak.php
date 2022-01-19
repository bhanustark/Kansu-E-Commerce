

  <ul class="collection">
  <?php if(empty($added_products)){ ?>
    <blockquote>
      Your cart is empty. Please add some products to cart.
    </blockquote>  
  <?php } else { ?>

  <?php
  
    $total = array();

   ?>

  <?php foreach($added_products as $added_product){ ?>

    <?php
      if((int)$added_product->offer_price != 0) {
      $percent = (((int)$added_product->price - (int)$added_product->offer_price)*100) /(int)$added_product->price ;
      }
    ?>

    <li class="collection-item avatar">
      <img src="https://asecured.s3.us-east-1.amazonaws.com/kansu/image/<?=$added_product->product_photo?>" alt="" class="circle">
      <form id="remove">
      	<input type="hidden" id="cart_id" name="cart_id" value="<?=$added_product->id?>">
      	<button href="#!" onclick="removeFromCart(<?=$added_product->id?>)" class="btn-floating waves-effect waves-light red right"><i class="material-icons">clear</i></button>
      </form>
      <span class="title"><strong><?=$added_product->product_name?></strong></span>
      <p><?php if((int)$added_product->offer_price != 0){ $total[] = $added_product->offer_price; ?> <span style="font-size:125%;" class="green-text">Rs. <?=$added_product->offer_price?> </span><strike>Rs. <?=$added_product->price?></strike> <span data-badge-caption class="new badge left"> <?=$percent?>% Off</span> <?php } else { $total[] = $added_product->price; ?> Rs. <?=$added_product->price?> <?php } ?>  <br>
         <?php echo substr($added_product->product_description,0,100); echo "...";?>
      </p>
    </li>

  <?php }
  
  $delivery_charge = 0;
  $grand_total = 0;
  $great_grand_total = 0;

foreach($total as $price){
  (int)$grand_total = (int)$grand_total + (int)$price;
}

if((int)$address->distance == 1 || (int)$address->distance == 2 ){
  $delivery_charge = 10;
    if((int)$grand_total >= 300){
    $delivery_charge = 0;
  }
} else if((int)$address->distance == 3 || (int)$address->distance == 4 ){
  $delivery_charge = 20;
  if((int)$grand_total >= 500){
    $delivery_charge = 0;
  }
} else if((int)$address->distance > 4){
  $delivery_charge = (int)$address->distance * 10;
}


  $great_grand_total = (int)$grand_total + (int)$delivery_charge; 
  
   ?>

    <li class="collection-item right">      <span class="title">Total = <?=$grand_total?> Rupees</span>
      <p>
         +<?=$delivery_charge?> Rupees (Delivery Charge)
      </p>
      <div class="collection">
        <a href="#!" class="secondary-content collection-item active">Grand Total = <?=$great_grand_total?> Rupees</a>
      </div>
    </li>

  </ul>

  <div class="right">

    <a href="/cart/checkout/cod" class="btn waves-effect waves-light right">Checkout with COD
      <i class="material-icons right">send</i>
    </a>

  </div>
    <blockquote>
      Purchase of more than 500 Rupees for free delivery.
    </blockquote>
    <?php } ?>

<script>

  var cart_id;

    function removeFromCart(cart_id){
      this.cart_id = cart_id;
    }

      $(function () {

        $('form#remove').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: '/cart/remove',
            data: { cart_id: cart_id },
            success: function (result) {
              M.toast({html: result});
              var items = $("#added_item").text();
              $("#added_item").text(parseInt(items) - 1);
              location.reload(true);
            }
          });

        });

      });

</script>