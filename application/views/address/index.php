<?php if(!$logincheck) {header("Location: /"); } 
include ('style.php')
?>
  
<div class="row center">
<header class="w3-container w3-blue">
      <h1>My Address</h1>
    </header>
    <div class="w3-container">
<div class="col s10 m8 offset-m2">
<?php 
if(empty($addresses)){
  header("Location: /myaddresses/selectpincode");
}
?>
</div>
</div>

<?php foreach($addresses as $address) { ?>


  <div class="row center">
    <div class="col s12 m6 offset-m3">
      <div class="card">
        <div class="card-content">
          <?php echo '<span class="card-title">Billing Address</span>
          <p style="text-align:left;"> Name: ' . $address->billing_name . '</p>
          <p style="text-align:left;"> Pin Code: ' . $address->pins . '</p>
          <p style="text-align:left;"> City: ' . $address->city_name . '</p>
          <p style="text-align:left;"> Address: ' . $address->address . '</p>
          <p style="text-align:left;"> Phone: ' . $address->phone . ', 
          ' . $address->alt_phone; ?>
        </div>
        <div class="card-action">
          <strong><a href="/myaddresses/selectpincode">Update your Address</a></strong>
        </div>
      </div>
    </div>
  </div>


<?php } ?>