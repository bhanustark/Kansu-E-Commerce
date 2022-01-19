<?php
if(!$logincheck) {
	header("Location: /");
}
include ('style.php');
?>


<header class="w3-container w3-light-blue">
  <h1>Update Address</h1>
</header>

</br>
<div class="row">
<form action="<?php echo URL; ?>/myaddresses/addAddress" method="POST" class="col s12">
<div class="row">
	<div class="input-field col s12">
		<select id="cities" name="city_id" class="validate" required>
			<option value="" disabled selected>Choose your City/Village</option>
			<?php
				foreach($cities as $city){
					echo '<option value="' . $city->id . '">' . $city->city_name . '</option>';
				}
			?>
		</select>
		<label>Select Your City/Village</label>
	</div>
	<div class="input-field col s12">
		<input id="icon_prefix" name="full_name" type="text" class="validate">
		<label for="icon_prefix">Full Name</label>
	</div>
		
    <div class="input-field col s12">
	<textarea id="textarea1"  name="full_address" class="materialize-textarea validate" required></textarea>
        <label for="textarea1">Full Address with Gali/Mohalla</label>     
    </div>
	
        <div class="input-field col s6">
          <input id="phone" type="tel" name="phone" class="validate" pattern="[6-9]{1}[0-9]{4}[0-9]{5}" required>
          <label for="phone">Your Mobile Number</label>
        </div>
		
        <div class="input-field col s6">
          <input id="alt_phone" type="tel" name="alt_phone" pattern="[6-9]{1}[0-9]{4}[0-9]{5}" class="validate">
          <label for="alt_phone">Alternate Mobile Number</label>
        </div>


	
</div>
<footer class="w3-container w3-light-blue">
<button class="btn w3-light-blue right" type="submit" name="add">Set
    <i class="material-icons right">send</i>
  	</button>
	  </footer>
</form>
</div>