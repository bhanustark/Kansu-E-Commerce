<style>
.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  font-size: 15px;
  transition: background-color .3s;
}

.pagination a.active {
  background-color: #2196F3 !important;
  color: white;
}

.pagination a:hover:not(.active) {background-color: #2196F3 !important;}

.sidenav {
  width: 130px;
  position: fixed;
  z-index: 1;
  top: 20px;
  left: 10px;
  background: #eee;
  overflow-x: hidden;
  padding: 8px 0;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #2196F3;
  display: block;
}

.sidenav a:hover {
  color: #064579;
}

.main {
  margin-left: 140px; /* Same width as the sidebar + left position in px */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

#myInput {
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 94%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block
}

#myUL li a:hover:not(.header) {
  background-color: #eee;
}
  
body {
    font-family: Arial, Helvetica, sans-serif;
  }
  
  /* Float four columns side by side */
  .j_column {
    float: left;
    width: 25%;
    padding: 0 10px;
  }
  
  /* Remove extra left and right margins, due to padding */
  .j_row {margin: 0 -5px;}
  
  /* Clear floats after the columns */
  .j_row:after {
    content: "";
    display: table;
    clear: both;
  }
  
  /* Responsive columns */
 @media screen and (max-width: 600px) {
    .j_column {
      width: 100%;
      display: block;
      margin-bottom: 20px;
    }
  }
  
  /* Style the counter cards */
  .j_card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);
    padding: 16px;
    text-align: left;
    font-size:15px;
    background-color: #f1f1f1;
  }


  /*style for collapse button*/
  .collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 10%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}

@media screen and (max-width: 500px) {
  .j_column {
    float: left;
    width: 75%;
    padding: 0 10px;
  }
  .j_row {margin: 0 -5px;}
  }

   /* Responsive columns */
 @media screen and (max-width: 300px) and (max-width:400px) {
  .j_column {
    float: left;
    width: 75%;
    padding: 0 10px;
  }
  .j_row {margin: 0 -5px;}
  }

</style>
<script>
function procudtsearch() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}


</script>


<input type="text" id="myInput" onkeyup="procudtsearch()" placeholder="Search Products" title="Type in a name">

<ul id="myUL">
  <?php
  foreach($categories as $category){
  	echo' <li><a  href="/categories/category/' . $category->id .'" class="collection-item"><option>' . $category->category_name . '</option></a></li>';
  }
?>
</ul>
</br>

<?php
include ('style.php');
$nb_elem_per_page = 52;
$page = isset($_GET['page'])?intval($_GET['page']-1):0;
// $data = (array)$this->view['data']['produkte'];
$number_of_pages = intval(count($products)/$nb_elem_per_page)+1;
?>


<?php 
$product_counter = 0;
$product1;
$product2;
$product3;
$product4;





foreach(array_slice($products, $page*$nb_elem_per_page, $nb_elem_per_page) as $product){ 
  

    if($product == NULL)
{
    echo 'Product is not available';
} 
    $product_counter++;

       if(isset($product->price_id)) {
      if($product_counter == 1)
      {
          $product1 = $product;
      }
      else if($product_counter == 2)
      {
          $product2 = $product;
      }
      else if($product_counter == 3)
      {
          $product3 = $product;
      }
      else if($product_counter == 4)
      {
          $product4 = $product;
          $product_counter = 0;
      ?>

<div class="j_row">
       <div class="j_column">
       <div class="j_card">
       <?php echo '<img class="card-img-top" style="width:100%;" src="https://cdn.kansu.in/kansu/image/' . $product1->product_photo . '">'; ?>     
        <b><?=$product1->product_name?></b>
        </br>
             <span class="price" data-product-price="">
                  <?php if(isset($product1->price)){ 
              if($product1->offer_price != 0) {
              if($product1->offer_price > $product1->price)
                   {
                     $product1->offer_price = 0;
                   }
              $percent = ($product1->price - $product1->offer_price)/$product1->price ;
              }
              if($product1->offer_price == 0){ ?>
                  <span style="color:green;" class="fa fa-inr"> <?= $product1->price ?>
                  </span>
                  <?php } else { ?> 
                    <span style="color:red;"><strike class="fa fa-inr" > <?=$product1->price?>
                  </strike></span>
                  <span style="color:green;" class="fa fa-inr" > <?=$product1->offer_price?>
                  </span> 
                  <span style="background:green;color:#fff;">
                  
                  <?=substr($percent,0,4)?>% Off</span> 
                  
                   <?php } } ?>
                </span>
                <form id="prod">
                <input type="hidden" id="product_id" name="product_id" value="<?=$product1->id?>">
                <button data-position="left" data-tooltip="Add to Cart" onclick="addToCart(<?=$product1->id?>)">Add To Cart</button>
                              </form>
              
    </div>
      </div>

  <div class="j_column">
    <div class="j_card">
    <?php echo '<img class="card-img-top" style="width:100%;" src="https://cdn.kansu.in/kansu/image/' . $product2->product_photo . '">'; ?>          
      <b><?=$product2->product_name?></b>
      </br>
      <span class="price" data-product-price="">
                  <?php if(isset($product2->price)){ 
              if($product2->offer_price != 0) {
                if($product2->offer_price > $product2->price)
                {
                  $product2->offer_price = 0;
                }
           $percent = ($product2->price - $product2->offer_price)/$product2->price ;
              }
            if($product2->offer_price == 0){ ?>
                  <span style="color:green;" class="fa fa-inr" > <?= $product2->price ?>
                  </span>
                  <?php } else { ?> 
                    <span style="color:red;"><strike class="fa fa-inr"> <?=$product2->price?>
                  </strike></span>
                  <span style="color:green;" class="fa fa-inr" > <?=$product2->offer_price?>
                  </span> 
                  <span style="background:green;color:#fff;">
                  
                  <?=substr($percent,0,4)?>% Off</span> 
                   
                  
                  <?php } ?> <?php  } ?>
                </span>
                <form id="prod">
                <input type="hidden" id="product_id" name="product_id" value="<?=$product2->id?>">
                <button data-position="left" data-tooltip="Add to Cart" >Add To Cart</button>
                          </form>
      </div>
  </div>
  
  <div class="j_column">
    <div class="j_card">
    <?php echo '<img class="card-img-top" style="width:100%;" src="https://cdn.kansu.in/kansu/image/' . $product3->product_photo . '">'; ?>
      <b><?=$product3->product_name?></b>
      </br>
      <span class="price" data-product-price="">
                  <?php if(isset($product3->price)){ 

              if($product3->offer_price != 0) {
                if($product3->offer_price > $product3->price)
                {
                  $product3->offer_price = 0;
                }
                $percent = ($product3->price - $product3->offer_price)/$product3->price ;
              }
            ?>
                  <?php if($product3->offer_price == 0){ ?>
                  <span style="color:green;" class="fa fa-inr" > <?= $product3->price ?>
                  </span>
                  <?php } else { ?> 
                    <span style="color:red;" ><strike class="fa fa-inr"> <?=$product3->price?>
                  </strike></span> 
                  <span style="color:green;" class="fa fa-inr"> <?=$product3->offer_price?>
                  </span> 
                  <span style="background:green;color:#fff;">
                  
                  <?=substr($percent,0,4)?>% Off</span> 
                  
                  
                  <?php }  } ?>
                </span>
                <form id="prod">
                <input type="hidden" id="product_id" name="product_id" value="<?=$product3->id?>">
                <button data-position="left" data-tooltip="Add to Cart" onclick="addToCart(<?=$product3->id?>)">Add To Cart</button>
                             </form>
            </div>
  </div>
  
  <div class="j_column">
    <div class="j_card">
      <?php echo '<img class="card-img-top" style="width:100%;" src="https://cdn.kansu.in/kansu/image/' . $product4->product_photo . '">'; ?>
      <b><?=$product4->product_name?></b>
      </br>
      <span class="price" data-product-price="">
                  <?php if(isset($product4->price)){ 
              if($product4->offer_price != 0) {
                if($product4->offer_price > $product4->price)
                {
                  $product4->offer_price = 0;
                }
               $percent = ($product4->price - $product4->offer_price)/$product4->price ;
              }
                if($product4->offer_price == 0){ ?>
                  <span style="color:green;" class="fa fa-inr" > <?= $product4->price ?>
                  </span>
                  <?php } else { ?> 
                    <span style="color:red;"><strike class="fa fa-inr"> <?=$product4->price?>
                  </strike></span>  
                  <span style="color:green;" class="fa fa-inr"> <?=$product4->offer_price?>
                  </span> 
                  <span style="background:green;color:#fff;">
               
                  <?=substr($percent,0,4)?>% Off</span>
                 
                  
                  <?php }  } ?>
                </span>
                <form id="prod">
                <input type="hidden" id="product_id" name="product_id" value="<?=$product4->id?>">
                <button data-position="left" data-tooltip="Add to Cart" onclick="addToCart(<?=$product4->id?>)">Add To Cart</button>
                             </form>
    </div>
  </div>
</div>
</br>

  <?php } }
    else{
    if($product_counter == 1)
    {
        $product1 = $product;
    }
    else if($product_counter == 2)
    {
        $product2 = $product;
    }
    else if($product_counter == 3)
    {
        $product3 = $product;
    }
    else if($product_counter == 4)
    {
        $product4 = $product;
        $product_counter = 0;
?>
       <div class="j_row">
       <div class="j_column">
       <div class="j_card">
       <?php echo '<img class="card-img-top" style="width:100%;" src="https://cdn.kansu.in/kansu/image/' . $product1->product_photo . '">'; ?>     
        <b><?=$product1->product_name?></b>
    </div>
  </div>

  <div class="j_column">
    <div class="j_card">
    <?php echo '<img class="card-img-top" style="width:100%;" src="https://cdn.kansu.in/kansu/image/' . $product2->product_photo . '">'; ?>          
      <b><?=$product2->product_name?></b>
    </div>
  </div>
  
  <div class="j_column">
    <div class="j_card">
    <?php echo '<img class="card-img-top" style="width:100%;" src="https://cdn.kansu.in/kansu/image/' . $product3->product_photo . '">'; ?>
      <b><?=$product3->product_name?></b>
    </div>
  </div>
  
  <div class="j_column">
    <div class="j_card">
      <?php echo '<img class="card-img-top" style="width:100%;" src="https://cdn.kansu.in/kansu/image/' . $product4->product_photo . '">'; ?>
      <b><?=$product4->product_name?></b>
    </div>
  </div>
</div>
</br>

  <?php  }
   }
}
?>
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

  
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function subcatogory() {
  document.getElementById("subcat").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>


        <?php
if($number_of_pages > 1){
for($i=1;$i<=$number_of_pages;$i++){ ?>
    <li <?php if($page == $i-1)
    { ?> class="waves-effect active" <?php } 
    else { ?> class="waves-effect" <?php } ?> >
    <div  class="pagination">
    <a  href='?page=<?=$i?>'><?php echo $i; ?></a>
</div>
</li>
<?php } } ?>