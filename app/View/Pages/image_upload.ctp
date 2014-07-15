<?php

	require 'includes/connect.php';


// define a constant for the maximum upload size
define ('MAX_FILE_SIZE', 1024 * 500);

if (array_key_exists('upload', $_POST)) {
	// define constant for upload folder
	define('UPLOAD_DIR', 'upload/');
	// replace any spaces in original filename with underscores
	$file = str_replace(' ', '_', $_FILES['image']['name']);
	// create an array of permitted MIME types
	$permitted = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/jpg', 'image/png');
  
// upload if file is OK
  if (in_array($_FILES['image']['type'], $permitted)
      && $_FILES['image']['size'] > 0 
      && $_FILES['image']['size'] <= MAX_FILE_SIZE) {
    switch($_FILES['image']['error']) {
      case 0:
        // check if a file of the same name has been uploaded
        if (!file_exists(UPLOAD_DIR . $file)) {
          // move the file to the upload folder and rename it
          $success =
move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_DIR .
$file);
        } else {
		  
          $uploadResult = 'A file of the same name already exists.';
        }
        if ($success) {
          $uploadResult = "$file uploaded successfully.";

		  mysql_query("UPDATE `$tbl_name` SET picture='$file' WHERE id='$id';") or die(mysql_error());

		  header("location:edit_user.php?id=$id");

		} else {
          $uploadResult = "Error uploading $file. A file of the same name already exists.";
        }
        break;
      case 3:
      case 6:
      case 7:
      case 8:
        $uploadResult = "Error uploading $file. Please try again.";
        break;
      case 4:
        $uploadResult = "You didn't select a file to be uploaded.";
    }
  } else {
		$uploadResult = "$file is either too big or not an image.";
	}
}


	mysql_close($con);

?>
		
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log in</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.0-rc.1/jquery.mobile-1.3.0-rc.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.0-rc.1/jquery.mobile-1.3.0-rc.1.min.js"></script>
</head>
<body>
<div style="width: 500px; margin: 200px auto;">
	
		<div data-role="header" data-theme="d">
			<h1>Upload Image</h1>
		</div>
		
		
	    <?php
			// if the form has been submitted, display result
			if (isset($uploadResult)) {
			  echo "<p><strong>$uploadResult</strong></p>";
			}
		?>
<form action="" method="post" enctype="multipart/form-data" data-ajax="false" name="uploadImage" id="uploadImage">
<p>
  <input type="hidden" name="MAX_FILE_SIZE" 
    value="512000" />
  <label for="image">Upload image:</label>
  <input type="file" name="image" id="image" />
</p>
<p>
  <input type="submit" name="upload" id="upload" 
value="Upload" />
</p>
</form>
<p style="margin-bottom: 20px;"><a href="admin.php"  data-role="button" data-mini="true" data-inline="true" data-icon="back" >Return to the admin tool</a></p>
		
		</div>

</body>
</html>
		
		
		
		
		
		
