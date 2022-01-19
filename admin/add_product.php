<?php
require_once("login_check.php");
//require_once("S3.php");
require_once("creds.php");
require_once("name_generator.php");
if(isset($_POST["submit"])){
$product_name = $_POST["product_name"];
$category_id = $_POST["category_id"];
$product_photo = $_FILES["product_photo"]["name"];
$product_photo_tmp = $_FILES["product_photo"]["tmp_name"];
$folder = "image/".$product_photo;
$product_description = $_POST["product_description"];
	if(empty($product_name)){
		echo "product name is empty";
		die;
	}
	if(empty($category_id)){
		echo "product category id is empty";
		die;
	}
	if ($_FILES['product_photo']['size'] == 0){
		echo "product photo is empty";
		die;
	}
	if(empty($product_description)){
		echo "product description is empty";
		die;
	}

$allowed = array('gif', 'png', 'jpg', 'jpeg');
$ext = pathinfo($product_photo, PATHINFO_EXTENSION);
if (!in_array($ext, $allowed)) {
    echo 'error';
die;
}
$new_name = random_strings(15)."." . pathinfo($product_photo, PATHINFO_EXTENSION);
	$query = "INSERT INTO products (product_name,product_category_id,product_photo,product_description) VALUES ('$product_name','$category_id','$new_name','$product_description')";

	$result = mysqli_query($db_connect,$query);
	if($result){
echo "product is added";
}else{
		echo "error in adding product";
die;
	}

if (defined('AWS_S3_URL')) {
  require_once('S3.php');
$new_name = "image/".$new_name;
  S3::setAuth(AWS_S3_KEY, AWS_S3_SECRET);
//  S3::setRegion(AWS_S3_REGION);
  S3::setSignatureVersion('v4');
  S3::putObject(S3::inputFile($product_photo_tmp, false), AWS_S3_BUCKET, 'kansu/'.$new_name, S3::ACL_PUBLIC_READ);
  unlink($tmpfile);
	//if(move_uploaded_file($product_photo_tmp,$folder)){
		echo "Successfully uploaded photo and added product.";
	}
	else{
		echo "file upload error";
die;
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
      <div class="card blue-grey darken-1">
        <div class="card-action">
          <a href="dash.php">Go back</a>
          <a href="logout.php">Logout</a>
        </div>
        <div class="card-content white-text center">
          <span class="card-title">Add product</span>
<form method="POST" action="" enctype="multipart/form-data">
<input type="text" name="product_name" placeholder="Product Name" />
<input type="text" name="category_id" placeholder="Product Category Id" />
<input type="text" name="category_did" placeholder="Product Category Id" />
<input type="file" name="product_photo" accept="image/*" />
<br><br>
<textarea name="product_description" placeholder="Product Description"> </textarea>
<br><br>
<input type="submit" name="submit" value="Submit"/>
</form>
</div></div></div></div>
</body>
</html>
