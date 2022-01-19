<?php
require_once("login_check.php");
?>
<html>
<head>
<!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
<div class="row">
<div class="col s12 m6 offset-m3">
      <div class="collection">
        <a href="add_product.php" class="collection-item">Add Product</a>
        <a href="add_price.php" class="collection-item">Add Price</a>
<a href="add_category.php" class="collection-item">Add Category</a>
        <a href="#!" class="collection-item">All products</a>
        <a href="logout.php" class="collection-item">Logout</a>
      </div>
</div>
</div>
</body>
</html>
