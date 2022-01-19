<div class="container">

<?php foreach ($categories as $category) {

	?>

	<div class="card" style="margin-top: 10px;">
	  <div class="card-header">
	   Category id: <?=$category->id?>
	  </div>
	  <div class="card-body">
	    <h5 class="card-title"><?=$category->category_name?></h5>
	    <a href="/kadmin/edit_category/<?=$category->id?>" class="btn btn-primary">Edit Category</a>
	    <!-- <button data-toggle="modal" data-target="#productModal<?=$product->id?>" type="button" class="btn btn-danger">Delete?</button> -->
	  </div>
	</div>


<!-- Modal -->
<!-- <div class="modal fade" id="productModal<?=$product->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to Delete this product?
      </div>
      <div class="modal-footer">
        <a type="button" href="/kadmin/delete_product/<?=$product->id?>" class="btn btn-primary">I'm Sure.</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div> -->


<?php } ?>

</div>
<script type="text/javascript">
  $(".nav-item").removeClass("active");
  $("#productsMenuItem").addClass("active");
</script>

