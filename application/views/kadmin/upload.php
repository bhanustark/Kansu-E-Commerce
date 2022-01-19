<?php
function random_strings($length_of_string) 
{ 
  
    // String of all alphanumeric character 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
  
    // Shufle the $str_result and returns substring 
    // of specified length 
    return substr(str_shuffle($str_result),  
                       0, $length_of_string); 
} 


	if(isset($_FILES['image'])){
		$file_name = $_FILES['image']['name'];   
		$temp_file_location = $_FILES['image']['tmp_name'];

		$new_name = "kansu/image/" . random_strings(15)."." . pathinfo($file_name, PATHINFO_EXTENSION);

		$result = $s3->putObject([
			'Bucket' => AWS_S3_BUCKET,
			'Key'    => $new_name,
			'SourceFile' => $temp_file_location,
        	'ACL'    => 'public-read'	
		]);

		echo $new_name;
	}
?>

<div class="container" style="margin: 1rem;">
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
<form action="/kadmin/upload" enctype="multipart/form-data" method="POST">
  <div class="form-group">
    <label for="exampleFormControlFile1">Upload Photo</label>
    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
  </div>
    <input type="submit" class="btn btn-primary mb-2" />
</form>
</div></div>
</div>