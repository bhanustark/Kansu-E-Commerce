<?php
require_once("login_check.php");
if(isset($_POST['submit'])){
echo "form is submitted";
$category_name = $_POST["category_name"];
$is_sub_category = $_POST["is_sub_category"];
$parent_category_id = $_POST["parent_category_id"];
if(empty($category_name)){
echo "Please enter the category name";
die;
}
if($is_sub_category == "Yes"){
$is_sub_category = 1;
}
else
{
$is_sub_category = 0;
}
if(!empty($parent_category_id)){
$query = "INSERT INTO categories (category_name,is_sub_category,parent_category_id) VALUES ('$category_name','$is_sub_category','$parent_category_id')";
}
else {
$query = "INSERT INTO categories (category_name,is_sub_category,parent_category_id) VALUES ('$category_name','$is_sub_category',NULL)";
}
$result = mysqli_query($db_connect,$query);
if($result){
echo "added category successfully";
die;
}
else{
echo "category not added";
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
<span class="card-title">Add a Category</span>
<form method="POST" action="" >
<input type="text" name="category_name" placeholder="Category Name" />
<label>Is it a sub-category?</label>
<div class="switch">
    <label>
      No
      <input type="checkbox" name="is_sub_category" value="Yes">
      <span class="lever"></span>
      Yes
    </label>
</div>
<input type="number" name="parent_category_id" placeholder="Parent Category ID" />
<input type="submit" name="submit" value="submit" />
</form>
</div></div></div></div>
</body>
</html>
