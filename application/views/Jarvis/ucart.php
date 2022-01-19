
  <?php if(empty($added_products)){ ?>
    <blockquote>
      Your cart is empty. Please add some products to cart.

    </blockquote>  
      <?php } else { ?>

  <?php
    
    $len = count($added_products);
    //$child = $(this).parent().children(".qt");
    //echo ($child);
    $total = array();
   include ('cartstyle.php')
   ?>


<header id="site-header">
    <div class="container">
      <h1>Shopping cart <span></span><span class="last-span is-open"></span></h1>
    </div>
  </header>

  <div class="container">
    <section id="cart"> 
      


<?php 
$product_serial=0;
foreach($added_products as $added_product){ 
    $product_serial++;
        if($added_product->offer_price != 0) {
      $percent = ($added_product->price - $added_product->offer_price) /$added_product->price ;
      }
    ?>
 

    <article class="product">
        <header>
          <!--< class="remove">-->
          <img src="https://cdn.kansu.in/kansu/image/<?=$added_product->product_photo?>" alt="">          
        </header>

        <div class="content">
          <h1><?=$added_product->product_name?></h1>
           <?php if((int)$added_product->offer_price != 0){ $total[] = $added_product->offer_price; ?> 
       
       <i class="cart_price_text">&nbsp;M.P.R:
       <strike class="red-text" > <?=$added_product->price?>
     </strike> </i>

     
       <span class="green-text cart_price_text" >&nbsp;New Price:<?=$added_product->offer_price?> 
     </span>
     
       
     <?php $added_product->price = $added_product->offer_price?>
     <i class="cart_price_text">&nbsp;You Saved: <?=substr($percent,0,4)?>%
     <!--<span data-badge-caption class="new badge"> <?=substr($percent,0,4)?>% Off</span>-->
     </i>
     <?php } else { $total[] = $added_product->price; ?>          

     <i class="cart_price_text">&nbsp;M.P.R:
     <?=$added_product->price?> <?php } ?> </i> <br>
     </pre>
         
          <div style="top: 0" class="color red">
          <button data-target="modal<?=$added_product->id?>" class="modal-trigger red right"><i class="material-icons">clear</i></button>
          </div>
        </div>

         <footer class="content">
          <span class="qt-minus">-</span>
          <span class="qt">1</span>
          <span class="qt-plus">+</span>
          
          <h2 class="full-price"><?=$added_product->price?>&#x20B9</h2>
          
          <h2 class="price"><?=$added_product->price?>
          
          </h2>
       
      

    
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
        <button href="#!" onclick="removeFromCart(<?=$added_product->id?>)" class="waves-effect waves-light red right btn-flat">Remove</button>
      </form>
    </div>
  </div>

  </footer>
      </article> 
  <?php }?>

  </section>
  </div>
  <?php
  
  $delivery_charge = 0;
  $grand_total = 0;
  $great_grand_total = 0;
  $tax_on_product = 0;
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

  $tax_on_product =$tax_on_product + ($price*5)/100;
  $great_grand_total = $grand_total +$delivery_charge+$tax_on_product; 
 
  foreach($added_products as $added_product){
    if((int)$added_product->offer_price != 0)
    { $total[] = $added_product->offer_price;  }
     else { $total[] = $added_product->price;  } 
    }

   ?>



<footer id="site-footer">
    <div class="container clearfix">
      <div class="left">
        <h3 class="subtotal">Subtotal: <span><?=$grand_total?></span>&#x20B9</h3>
        <h3 class="tax">Taxes (5%): <span><?=$tax_on_product?></span>&#x20B9</h3>
        <h3 class="shipping">Shipping: <span><?=$delivery_charge?></span>&#x20B9</h3>      
        <h3 class="total">Total:<span><?=$great_grand_total?></span>&#x20B9</h3>
        <a href="/cart/checkout/cod" ><button>Checkout with COD</button>     
        </a>
      </div>
      
    </div>
  </footer>

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


      var check = false;

function changeVal(el) {
  var qt = parseFloat(el.parent().children(".qt").html());
  var price = parseFloat(el.parent().children(".price").html());
  var eq = Math.round(price * qt * 100) / 100;
  
  el.parent().children(".full-price").html( eq + "<i>&#x20B9</i>" );
  
  changeTotal();      
}

function changeTotal() {
  
  var price = 0;
  
  $(".full-price").each(function(index){
    price += parseFloat($(".full-price").eq(index).html());
  });
  
  price = Math.round(price * 100) / 100;
  var tax = Math.round(price * 0.05 * 100) / 100
  var shipping = parseFloat($(".shipping span").html());
  var fullPrice = Math.round((price + tax + shipping) *100) / 100;
  
  if(price == 0) {
    fullPrice = 0;
  }
  
  $(".subtotal span").html(price);
  $(".tax span").html(tax);
  $(".total span").html(fullPrice);
}

$(document).ready(function(){
  
  $(".remove").click(function(){
    var el = $(this);
    el.parent().parent().addClass("removed");
    window.setTimeout(
      function(){
        el.parent().parent().slideUp('fast', function() { 
          el.parent().parent().remove(); 
          if($(".product").length == 0) {
            if(check) {
              $("#cart").html("<h1>The shop does not function, yet!</h1><p>If you liked my shopping cart, please take a second and heart this Pen on <a href='https://codepen.io/ziga-miklic/pen/xhpob'>CodePen</a>. Thank you!</p>");
            } else {
              $("#cart").html("<h1>No products!</h1>");
            }
          }
          changeTotal(); 
        });
      }, 200);
  });

  $(".qt-plus").click(function(){
    
    $(this).parent().children(".qt").html(parseInt($(this).parent().children(".qt").html()) + 1);
    $(this).parent().children(".full-price").addClass("added");    
    var el = $(this);
    window.setTimeout(function(){el.parent().children(".full-price").removeClass("added"); changeVal(el);}, 150);
  });
  
  $(".qt-minus").click(function(){
    
    child = $(this).parent().children(".qt");
    
    if(parseInt(child.html()) > 1) {
      child.html(parseInt(child.html()) - 1);
    }
    
    $(this).parent().children(".full-price").addClass("minused");
    
    var el = $(this);
    window.setTimeout(function(){el.parent().children(".full-price").removeClass("minused"); changeVal(el);}, 150);
  });
  
  window.setTimeout(function(){$(".is-open").removeClass("is-open")}, 1200);
  
  $(".btn").click(function(){
    check = true;
    $(".remove").click();
  });
});

</script>
