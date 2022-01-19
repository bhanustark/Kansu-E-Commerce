<ul class="collection">
  <?php if(empty($added_products)){ ?>
    <blockquote>
      Your cart is empty. Please add some products to cart.
    </blockquote>  
  <?php } else { ?>

  <?php
  
    $total = array();
    include ('style.php')
   ?>
<style>

.plus-minus-input {
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
}

.plus-minus-input .input-group-field {
  text-align: center;
  margin-left: 0.5rem;
  margin-right: 0.5rem;
  padding: 1rem;
}

.plus-minus-input .input-group-field::-webkit-inner-spin-button,
.plus-minus-input .input-group-field ::-webkit-outer-spin-button {
  -webkit-appearance: none;
          appearance: none;
}

.plus-minus-input .input-group-button .circle {
  border-radius: 50%;
  padding: 0.25em 0.8em;
}

</style>
<header class="w3-container w3-light-blue">
  <h4><b>Your Orders</b></h4>
</header> 
<?php 
$product_serial=0;
foreach($added_products as $added_product){ 
  $product_serial++;
  
      if($added_product->offer_price != 0) {
      $percent = ($added_product->price - $added_product->offer_price) /$added_product->price ;
      }
    ?>
 
    <li class="collection-item avatar">
      <img src="https://cdn.kansu.in/kansu/image/<?=$added_product->product_photo?>" alt="" class="circle">
      	<button data-target="modal<?=$added_product->id?>" class="modal-trigger btn-floating waves-effect waves-light red right"><i class="material-icons">clear</i></button>
      <span class="title"><strong><?=$added_product->product_name?></strong></span>
      <p><?php if((int)$added_product->offer_price != 0){ $total[] = $added_product->offer_price; ?> 
       
        <p class="cart_price_text">M.P.R:
        <strike class="red-text fa fa-inr fa-xs" > <?=$added_product->price?>
      </strike> </p>

      <p class="cart_price_text">New Price:
        <span class="green-text fa fa-inr fa-xs" > <?=$added_product->offer_price?> 
        </p>
      </span>
      
      <p class="cart_price_text">You Saved: <?=substr($percent,0,4)?>%
      <!--<span data-badge-caption class="new badge"> <?=substr($percent,0,4)?>% Off</span>-->
      </p>
      <?php } else { $total[] = $added_product->price; ?>
        <i class="cart_price_text">M.P.R:
      <i class="fa fa-inr fa-xs"> </i>  <?=$added_product->price?> <?php } ?> </i> <br>
      </p>
    </li>

      <!-- Modal Structure -->
  <div id="modal<?=$added_product->id?>" class="modal">
    <div class="modal-content">
      <h4>Are you sure?</h4>
      <p>Are you sure to remove this product from Cart?</p>
    </div>
    <div class="modal-footer">
      <button href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</button>
      <form id="remove">
        <input type="hidden" id="cart_id" name="cart_id" value="<?=$added_product->id?>">
        <button href="#!" onclick="removeFromCart(<?=$added_product->id?>)" class="btn waves-effect waves-light red right">Remove</button>
      </form>
    </div>
  </div>

  <!-- Change the `data-field` of buttons and `name` of input field's for multiple plus minus buttons-->
  <div class="input-group plus-minus-input">
  <input  type="number" name="quantity" value="0">
    <button type="button" data-quantity="minus" data-field="quantity" class="fa fa-minus" aria-hidden="true">
    </button>
    <button type="button" data-quantity="plus" data-field="quantity"  class="fa fa-plus" aria-hidden="true">
    </button>
</div>



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
  <?php if((int)$address->distance <= 2) {?>
    <blockquote>
      Purchase more than 300 Rupees for free delivery.
    </blockquote>
  <?php } else if((int)$address->distance <= 4) { ?>
    <blockquote>
      Purchase more than 500 Rupees for free delivery.
    </blockquote>
    <?php } } ?>

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


      jQuery(document).ready(function(){
    // This button will increment the value
    $('[data-quantity="plus"]').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $('[data-quantity="minus"]').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
});



</script>
