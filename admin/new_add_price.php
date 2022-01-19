<?php

require_once("login_check.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST["submit"])){
  $product_id = $_POST["product_id"];
  $price = $_POST["price"];
  $discount_in_rupees = $_POST["discount_in_rupees"];
  $discount_in_percent = $_POST["discount_in_percent"];
  $offer_price = $_POST["offer_price"];
  $delivery_charge = $_POST["delivery_charge"];

  $last_id = 0;

  if(empty($product_id)){
    die("Product id is empty");
  }
  if(empty($price)){
    die("Price is empty");
  }
  if(empty($discount_in_rupees)){
    $discount_in_rupees = NULL;
  }
  if(empty($discount_in_percent)){
    $discount_in_percent = NULL;
  }
  if(empty($offer_price)){
    $offer_price = NULL;
  }
  if(empty($delivery_charge)){
    $delivery_charge = NULL;
  }
  if(!isset($_POST["chk_cities"])){
    die("please select atleast one city");
  }

  $checkbox1 = $_POST['chk_cities'];

  $query = "INSERT INTO prices (product_id,price,discount_in_rupees,discount_in_percent,offer_price,delivery_charge) VALUES ('$product_id','$price','$discount_in_rupees','$discount_in_percent','$offer_price','$delivery_charge')";
  $result = mysqli_query($db_connect,$query);
  if($result){
    echo "only price is added not city yet";
    $query = "SELECT * FROM prices ORDER BY ID DESC LIMIT 1";
    $result = mysqli_query($db_connect,$query);
      while ($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
          $last_id = $row['id'];
      }

    for($i=0;$i<sizeof($checkbox1);$i++){
      $query = "INSERT INTO city_price_relationships (city_id,price_id) VALUES ('".$checkbox1[$i]."','$last_id')";
      $result = mysqli_query($db_connect,$query);
    }
    if($result){
      echo "price with cities added successfully";
    }
    else {
      echo "cities are not added";
    }

  }
  else {
    echo "failed to add the price";
  }
}
?>
<html>
<head>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            
</head>
<body>

 <div class="row">
    <div class="col s12 m6 offset-m3">
      <div class="card">
        <div class="card-action">
          <a href="dash.php">Go back</a>
          <a href="logout.php">Logout</a>
        </div>
        <div class="card-content center">
          <span class="card-title">Add price to Product</span>
          <form method="POST" action="">
            <input type="number" name="product_id" placeholder="Product id" >

            <p>
              <label>
                <input type="checkbox" id="one" onclick="funOne()" value="1"/>
                <span>821101</span>
              </label>
            </p>
            <p>
              <label>
                <input type="checkbox" id="two" onclick="funTwo()" value="2"/>
                <span>821102</span>
              </label>
            </p>
            <p>
              <label>
                <input type="checkbox" id="three" onclick="funThree()" value="14"/>
                <span>821109</span>
              </label>
            </p>

            <div id="cityone" style="display:none;">
              <?php
                $query = "SELECT * FROM cities WHERE pincode_id='1'";
                $result = mysqli_query($db_connect,$query);
                if($result->num_rows > 0){
                  while($row = $result->fetch_assoc()) {
                    echo '<div style="margin-right:50px;display:inline;float:left;"><label><input type="checkbox" name="chk_cities[]" id="'. $row["city_name"].' checkbox-one" value="'.$row["id"].'" /><span>'. $row["city_name"] .' ('. $row["distance"] .' KM away)'.'</span></label></div>';
                  }
                }
               ?>
            </div>
            <div id="citytwo" style="display:none;">
              <?php 
                $query = "SELECT * FROM cities WHERE pincode_id='2'";
                $result = mysqli_query($db_connect,$query);
                if($result->num_rows > 0){
                  while($row = $result->fetch_assoc()){
                    echo '<div style="margin-right:50px;display:inline;float:left;"><label><input type="checkbox" name="chk_cities[]" id="'. $row["city_name"].' checkbox-two" value="'.$row["id"].'" /><span>'. $row["city_name"] .' ('. $row["distance"] . ' KM away)' .'</span></label></div>';
                  }
                }
              ?>
            </div>
            <div id="citythree" style="display:none;">
              <?php 
                $query = "SELECT * FROM cities WHERE pincode_id='14'";
                $result = mysqli_query($db_connect,$query);
                if($result->num_rows > 0){
                  while($row = $result->fetch_assoc()){
                    echo '<div style="margin-right:50px;display:inline;float:left;"><label><input type="checkbox" name="chk_cities[]" id="'. $row["city_name"].' checkbox-three" value="'.$row["id"].'" /><span>'. $row["city_name"] .' ('. $row["distance"] .' KM away)'.'</span></label></div>';
                  }
                }
              ?>
            </div>

            <input type="number" name="price" placeholder="Price" >
            <input type="number" name="discount_in_rupees" placeholder="Discount in Rupees" >
            <input type="number" name="discount_in_percent" placeholder="Discount in Percent" >
            <input type="number" name="offer_price" placeholder="Offer Price" >
            <input type="number" name="delivery_charge" placeholder="Delivery Charge" >
            <input type="submit" name="submit" value="Submit">
           </form>
         </div>
       </div>
     </div>
   </div>

   <script>
    function funOne(){
      var one = document.getElementById("one");
      var cityone = document.getElementById("cityone");
      if(one.checked == true){
        cityone.style.display = "block";
      }
      else {
        cityone.style.display = "none";
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var checkbox of checkboxes) {
          checkbox.checked = false;
        }
      }
    }

    function funTwo(){
      var two = document.getElementById("two");
      var citytwo = document.getElementById("citytwo");
      if(two.checked == true){
        citytwo.style.display ="block";
      }
      else {
        citytwo.style.display ="none";
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var checkbox of checkboxes) {
          checkbox.checked = false;
        }
      }
    }

      function funThree(){
        var three = document.getElementById("three");
        var citythree = document.getElementById("citythree");
        if(three.checked == true){
          citythree.style.display = "block";
        }
        else {
          citythree.style.display = "none";
          var checkboxes = document.querySelectorAll('input[type="checkbox"]');
          for (var checkbox of checkboxes) {
            checkbox.checked = false;
          }
        }
      }
   </script>
</body>
</html>
