<div class="container">

<?php foreach ($orders as $order) { 

	$date=date_create($order->orders_order_date);

	?>

	<div class="card" style="margin-top: 10px;">
	  <div class="card-header">
	    <?php echo date_format($date,"h:i A, D d (F Y)"); ?>
	  </div>
	  <div class="card-body">
	    <h5 class="card-title"><?=$order->orders_total_price;?> Rupees <?php

	    if ($order->orders_ispaid == 0) {
	    	echo "Not Paid";
	    }
	    else
	    {
	    	echo "Paid";
	    }

	    ?></h5>
	    <p class="card-text">
	    	Name: <strong><?=$order->billing_name?></strong> <br />
	    	Address: <strong><?=$order->addresses_address?></strong> <br />
	    	City: <strong><?=$order->cities_city_name?></strong> <br />
	    	Distance: <strong><?=$order->cities_distance?> KM</strong> <br />
	    	Mobile: <strong><?=$order->addresses_phone?>, <?=$order->addresses_alt_phone?></strong>

	    </p>
	    <a href="/kadmin/order/<?=$order->orders_id?>" class="btn btn-primary">Ordered Products</a>
	    <button data-toggle="modal" data-target="#orderModal<?=$order->orders_id?>" type="button" class="btn btn-danger">Delivered?</button>
	  </div>
	</div>


<!-- Modal -->
<div class="modal fade" id="orderModal<?=$order->orders_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure, Order is Completed?
      </div>
      <div class="modal-footer">
        <a type="button" href="/kadmin/completed/<?=$order->orders_id?>" class="btn btn-primary">I'm Sure.</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>


<?php } ?>

</div>
<script type="text/javascript">
  $(".nav-item").removeClass("active");
  $("#ordersMenuItem").addClass("active");
</script>