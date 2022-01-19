<?php
require_once("login_check.php");

//$query = "SELECT orders.id, orders.user_id,orders.address_id, orders.total_price, orders.ispaid, orders.order_date, orders.status, users.id AS users_id, users.name, users.email, users.photo, addresses.id AS addresses_id, addresses.user_id AS addresses_user_id, addresses.billing_name, addresses.pincode_id, addresses.city_id, addresses.address, addresses.phone, addresses.alt_phone, pincodes.id AS pincodes_id, pincodes.pins, cities.city_id AS cities_id, cities.city_name, cities.distance FROM orders INNER JOIN users ON orders.user_id = users.id INNER JOIN addresses ON addresses_id = users.id = addresses.user_id INNER JOIN cities ON addresses.city_id = cities.id INNER JOIN pincodes ON addresses.pincode_id = pincodes.id";


$query = "SELECT orders.id, orders.user_id,orders.address_id, orders.total_price, orders.ispaid, orders.order_date, orders.status, users.id AS users_id, users.name, users.email, users.photo FROM orders INNER JOIN users ON orders.user_id = users.id";

?>

<html>
<head>
	<title>Orders</title>
  <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="/js/materialize.min.js"></script>
            
            
</head>
<body>
  <div class="row">
    <div class="col s12 m6 offset-m3">
      <div class="card blue-grey darken-1">
        <div class="card-action">
          <a href="dash.php">Go back</a>
          <a href="logout.php">Logout</a>
        </div>
        <div class="card-content white-text center">
          <span class="card-title">Orders</span>
</div></div>


<?php

$result = mysqli_query($db_connect, $query);

  while ($row = mysqli_fetch_row($result)) {
?>

    	  <ul class="collection">
		    <li class="collection-item avatar">
		      <img src="<?=$row[11]?>" alt="" class="circle">
		      <span class="title"><?=$row[11]?></span>
		      <p>First Line <br>
		         Second Line
		      </p>
		      <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
		    </li>
		  </ul>

<?php
    }
//}

?>







</div></div>
</body>
</html>