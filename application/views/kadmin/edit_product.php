<div class="container">
	<br><br />

<?php foreach ($products as $product) { ?>
<form action="" method="POST">
	<input type="hidden" name="id" value="<?=$product->id?>">
	<div class="mb-3">
	  <label for="exampleFormControlInput1" class="form-label">Product Name</label>
	  <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="<?=$product->product_name?>" placeholder="Full name of the product">
	</div>

	<div class="mb-3">
	  <label for="exampleFormControlInput1" class="form-label">Photo</label>
	  <input type="text" name="photo" class="form-control" id="exampleFormControlInput1" value="<?=$product->product_photo?>" placeholder="Full name of the product">
	  <a target="_blank" href="https://cdn.kansu.in/kansu/image/<?=$product->product_photo?>">View Photo</a>
	</div>

	<div class="form-group cat">
	    <label for="exampleFormControlSelect1">Primary Category</label>
	    <select class="form-control" id="exampleFormControlSelect1" name="category">
	    <?php
			foreach($categories as $category) {
				?>
			<option value="<?=$category->id?>"><?=$category->category_name?></option>
			<?php
			}
		?>
	    </select>
	</div>

	<div class="mb-3">
	  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
	  <textarea id="editor" class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?php echo nl2br($product->product_description); ?></textarea>
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php } ?>
</div>

<div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Updated!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Prodcut Updated Successfully.</p>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($result)) { if ($result) { ?>
	<script type="text/javascript">
		$('#myModal').modal('show')
	</script>
<?php }} ?>

<script src="https://cdn.tiny.cloud/1/dnjs6lleer8n2iskotetfs1h4pw6empuj8cbkpy9y3e0vscs/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: 'textarea#editor',
    menubar: false
  });
</script>
<script type="text/javascript">
  $(".nav-item").removeClass("active");
  $("#productsMenuItem").addClass("active");
</script>