<?php
if(!$logincheck) {
	header("Location: /");
}
include ('style.php')
?>

<header class="w3-container w3-light-blue">
  <h1>Select Pin Code</h1>
</header>
</br>
<form  action="<?php echo URL; ?>/myaddresses/addAddress" method="POST">
<div class="row">
	<div class="input-field col s5">
		<select id="pincodes" name="pincode" required="true">
			<option value="" disabled selected>Choose your Pin Code</option>
			<?php
				foreach($pincodes as $pincode){
					echo '<option value="' . $pincode->id . '">' . $pincode->pins . '</option>';
				}
			?>
		</select>
		<label>Select Your Pin Code</label>
	</div>
			

</div>
</br>

<footer class="w3-container w3-light-blue">
<button class="btn  w3-light-blue right" type="submit" name="next">Next
    <i class="material-icons right">send</i>
  	</button>
</footer>
	
</form>