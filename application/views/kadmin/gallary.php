
<div class="container">

  <div class="row justify-content-md-center">
    <div class="col-md-auto">
  <div class="card text-center" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">wANT tO uPLOAD</h5>
      <p class="card-text">Upload here new photo.</p>
      <a href="/kadmin/upload" class="btn btn-primary">Upload</a>
    </div>
  </div>
    </div>
  </div>

  <div class="row">
    <?php 
    foreach ($results as $result) {
    foreach ($result['Contents'] as $object) { ?>
    
    <div class="col-sm">
      <div class="card" style="width: 18rem; margin: 1rem;">
        <img src="https://cdn.kansu.in/<?=$object['Key']?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?=substr($object['Key'], 12)?></h5>
        </div>
        <div class="card-body">
          <a href="#" class="card-link">See Usage</a>
          <a href="#" class="card-link">Delete</a>
        </div>
      </div>
    </div>

    <?php } } ?>

  </div>
</div>