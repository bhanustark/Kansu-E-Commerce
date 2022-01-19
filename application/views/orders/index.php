<?php

if(empty($orders)){
	?>
    <blockquote>
      You haven't ordered anything yet.
    </blockquote>

	<?php
}

 ?>
<ul class="collection">
	<?php foreach($orders as $order) { 
		$date = new DateTime($order->order_date);
	?>
	<li class="collection-item avatar">
		<i class="material-icons circle green">local_mall</i>
		<span class="title">Order at <strong><?=$date->format('H:i (l) F d, Y ')?></strong></span>
		<p>Total Price Charge = <?=$order->total_price?> Rs.<br>
			<?php if($order->ispaid == 0){ echo "Payment: Unpaid"; } else { echo "Payment: Paid"; } ?><br>
			<?php if($order->status == 0){ echo "Status: Processing"; } else { echo "Status: Delivered"; } ?><br>
			<a href="/orders/seeall/<?=$order->id?>" class="waves-effect waves-light btn-small right">See All Items</a><br><br>
		</p>
		<a href="#modal<?=$order->id?>" class="secondary-content modal-trigger"><i class="material-icons"  style="color:#e91e63;">cancel</i></a>
	</li>

      <!-- Modal Structure -->
  <div id="modal<?=$order->id?>" class="modal">
    <div class="modal-content">
      <h4>Are you sure?</h4>
      <p>Are you sure to cancel this order?</p>
    </div>
    <div class="modal-footer">
      <button href="#!" class="modal-close waves-effect waves-green btn-flat">No</button>
      <a href="/orders/cancel/<?=$order->id?>" class="modal-close waves-effect waves-red btn-flat">Yes!</a>
    </div>
  </div>

	<?php } ?>
</ul>