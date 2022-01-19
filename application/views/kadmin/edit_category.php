<div class="container">
	<br><br />

<?php foreach ($scategories as $scategory) { ?>
<form action="" method="POST">
	<input type="hidden" name="id" value="<?=$scategory->id?>">
	<div class="mb-3">
	  <label for="exampleFormControlInput1" class="form-label">Category Name</label>
	  <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="<?=$scategory->category_name?>" placeholder="Category Name">
	</div>

	<div class="mb-3">
	  <label for="exampleFormControlInput1" class="form-label">Photo</label>
	  <input type="text" name="photo" class="form-control" id="exampleFormControlInput1" value="<?=$scategory->category_image?>" placeholder="Photo of Category">
	  <a target="_blank" href="https://cdn.kansu.in/kansu/image/<?=$scategory->category_image?>">View Photo</a>
	</div>

	<div class="form-group cat">
	    <label for="exampleFormControlSelect1">Parent Category</label>
	    <select class="form-control" id="exampleFormControlSelect1" name="category">
				<option value="null">No</option>
	    <?php
			foreach($cats as $cat) {
				?>
			<option value="<?=$cat->id?>"><?=$cat->category_name?></option>
			<?php
			}
		?>
	    </select>
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
        <p>Category Updated Successfully.</p>
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

<script type="text/javascript">
  $(".nav-item").removeClass("active");
  $("#productsMenuItem").addClass("active");
</script>

