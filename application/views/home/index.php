<?php

$nb_elem_per_page = 52;
$page = isset($_GET['page'])?intval($_GET['page']-1):0;
// $data = (array)$this->view['data']['produkte'];
$number_of_pages = intval(count($products)/$nb_elem_per_page)+1;
?>

<?php if (isset($text)) { ?>
  <div class="row">
    <form class="col s12" method="POST" action="/home/searchnow">
        <div class="input-field col s12 m6 offset-m3">
          <i class="material-icons prefix">search</i>
          <input id="search" type="search" name="text" class="validate" value="<?=$text?>">
          <label for="search">Search</label>
        </div>
    </form>
  </div>
<?php } ?>

<?php
        $homeurl = '/index.php';                               
        $homepage = "/";
        $currentpage = $_SERVER['REQUEST_URI'];
        include ('style.php')

if($currentpage == $homepage or $currentpage == '/index.php') {

  ?>

<div class="row">
  <div class="col s4">
    <div class="card cat-card">
      <div class="card-image content-card">
        <a href="/categories/category/15">
        <img src="/img/food.jpg">
        <span class="card-title home-cat-title">Foods</span>
        </a>
      </div>
    </div>
  </div>
    <div class="col s4">
      <div class="card cat-card">
        <div class="card-image content-card">
          <a href="/categories/category/18">
          <img src="/img/grocery.jpg">
          <span class="card-title home-cat-title">Grocery</span>
          </a>
        </div>
      </div>
    </div>
      <div class="col s4">
        <div class="card cat-card">
          <div class="card-image content-card">
            <a href="/categories/category/121">
            <img src="/img/medicine.jpg">
            <span class="card-title home-cat-title">Medicine</span>
            </a>
          </div>
        </div>
      </div>
</div>

<style>
.home-cat-title {
  font-weight: 900 !important;
  background-color: rgba(255,255,255,0.8);
  padding: 5% 10% 5% !important;
  font-size: 1rem !important;
  color: black !important;
}
.cat-card {
  -webkit-transform: skewY(-5deg);
-moz-transform: skewY(-5deg);
-ms-transform: skewY(-5deg);
-o-transform: skewY(-5deg);
transform: skewY(-5deg);
}
.content-card {
  -webkit-transform: skewY(5deg);
-moz-transform: skewY(5deg);
-ms-transform: skewY(5deg);
-o-transform: skewY(5deg);
transform: skewY(5deg);
}
</style>
<?php } ?>





    <div class="gallery row">

        <?php foreach(array_slice($products, $page*$nb_elem_per_page, $nb_elem_per_page) as $product){ ?>
          
            <?php if(isset($product->price_id)) { ?>

            <?php
              if((int)$product->offer_price != 0) {
              $percent = (((int)$product->price - (int)$product->offer_price)*100) /(int)$product->price ;
              }
            ?>

          <div class="col l3 m6 s6 gallery-item gallery-expand gallery-filter polygon">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <?php echo '<img class="loading" style="width:100px;background: transparent url(/img/loading.gif) center no-repeat;" src="https://cdn.kansu.in/kansu/image/' . $product->product_photo . '">'; ?>
              </a>
              <div class="gallery-header">
                <span><?=$product->product_name?></span>
                <div class="product-ratings-price">
                <span class="price" data-product-price="">
                  <?php if(isset($product->price)){ ?><?php if($product->offer_price == 0){ ?><span style="color:green;" class="fa fa-inr" >Rs. <?= $product->price ?></span><?php } else { ?> <span style="background:green;color:#fff;"><?=substr($percent,0,4)?>% Off</span> <span style="color:green;">Rs. <?=$product->offer_price?></span> <span style="color:red;"><strike>Rs. <?=$product->price?></strike></span> <?php } ?> <?php  } ?>
                </span>
        </div>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3><?=$product->product_name?></h3>
                  <span class="price"><?php if(isset($product->price)){ ?><?php if($product->offer_price == 0){ ?><span style="color:green;">Rs. <?= $product->price ?></span><?php } else { ?> <span style="background:green;color:#fff;"><?=substr($percent,0,4)?>% Off</span> <span style="color:green;">Rs. <?=$product->offer_price?></span> <span style="color:red;"><strike>Rs. <?=$product->price?></strike></span> <?php } ?> <?php  } ?></span>
                <p><?=nl2br($product->product_description)?></p>
                </div>

              </div>
              <div class="gallery-action">
             <form id="prod">
                <input type="hidden" id="product_id" name="product_id" value="<?=$product->id?>">
                <button class="btn-floating btn-large waves-effect waves-light blue" data-position="left" data-tooltip="Add to Cart" onclick="addToCart(<?=$product->id?>)"><i class="material-icons">add_shopping_cart</i></button>
              </form>
              </div>
            </div>
          </div>

      <?php } else { ?>
          <div class="col l3 m6 s6 gallery-item gallery-expand gallery-filter polygon">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <?php echo '<img class="loading" style="width:100px;background: transparent url(/img/loading.gif) center no-repeat;" src="https://cdn.kansu.in/kansu/image/' . $product->product_photo . '">'; ?>
              </a>
              <div class="gallery-header">
                <span><?=$product->product_name?></span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3><?=$product->product_name?></h3>
                  <span class="price"></span>
                <p><?=nl2br($product->product_description)?></p>
                </div>

<!--                 <div class="carousel-wrapper">
                  <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#two!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#three!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#four!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#five!"><img src="http://placehold.it/300x200"></a>
                  </div>
                </div> -->
              </div>
              <div class="gallery-action">
                <!-- <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a> -->
              </div>
            </div>
          </div>
        <?php } } ?>

        </div>

<ul class="pagination right" style="padding:10px;">
<?php
if($number_of_pages > 1){
for($i=1;$i<=$number_of_pages;$i++){ ?>
    <li <?php if($page == $i-1){ ?> class="waves-effect active" <?php } else { ?> class="waves-effect" <?php } ?> ><a href='?page=<?=$i?>'><?php echo $i; ?></a></li>
<?php } } ?>
</ul>

  <script>
  var prod_id;

    function addToCart(pro_id){
      this.prod_id = pro_id;
    }

      $(function () {

        $('form#prod').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: '/cart/add',
            data: { product_id: prod_id },
            success: function (result) {
              M.toast({html: result});
              var items = $("#added_item").text();
              $("#added_item").text(parseInt(items) + 1);
            }
          });

        });

      });
    </script>
