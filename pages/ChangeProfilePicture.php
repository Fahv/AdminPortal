<html>
<head>
<link rel="stylesheet" type="text/css" href="../style/style.css" />
<?php
require_once('../src/admin.php');
if(!Admin::Check_Logged_In()){
	Admin::Redirect("login.php");
}
if(isset($_POST['back']))
{
	Admin::Redirect("admin-home.php");
}
if(isset($_POST['submitted'])){
	
	error_reporting(E_ALL);

	// we first include the upload class, as we will need it here to deal with the uploaded file
	include('../src/class.upload.php');

	// retrieve eventual CLI parameters
	$cli = (isset($argc) && $argc > 1);
	if ($cli) {
		if (isset($argv[1])) $_GET['file'] = $argv[1];
		if (isset($argv[2])) $_GET['dir'] = $argv[2];
		if (isset($argv[3])) $_GET['pics'] = $argv[3];
	}

	// set variables
	$dir_dest = (isset($_GET['dir']) ? $_GET['dir'] : '../Profile Pictures');
	$dir_pics = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest);

	if (!$cli && !(isset($_SERVER['HTTP_X_FILE_NAME']) && isset($_SERVER['CONTENT_LENGTH']))) {


		// we create an instance of the class, giving as argument the PHP object
		// corresponding to the file field from the form
		// All the uploads are accessible from the PHP object $_FILES
		$handle = new Upload($_FILES['my_field']);

		// then we check if the file has been uploaded properly
		// in its *temporary* location in the server (often, it is /tmp)
		if ($handle->uploaded) {

			// yes, the file is on the server
			// now, we start the upload 'process'. That is, to copy the uploaded file
			// from its temporary location to the wanted location
			// It could be something like $handle->Process('/home/www/my_uploads/');
			$handle->file_overwrite = true;
			$handle->file_new_name_body = Admin::GetUser_ID();
			$handle->image_resize = true;
			$handle->image_convert = 'jpg';
			$handle->image_x = 227;
			$handle->image_y = 230;
			$handle->Process($dir_dest);

			// we check if everything went OK
			if ($handle->processed) {
				// everything was fine !
				/*echo '<p class="result">';
				echo '  <b>File uploaded with success</b><br />';
				echo '  File: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a>';
				echo '   (' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
				echo '</p>';*/
				echo "<script>alert('New Profile Picture Uploaded Fine');</script>";
			} else {
				// one error occured
				echo '<p class="result">';
				echo '  <b>File not uploaded to the wanted location</b><br />';
				echo '  Error: ' . $handle->error . '';
				echo '</p>';
			}

			// we delete the temporary files
			$handle-> Clean();

		} else {
			// if we're here, the upload file failed for some reasons
			// i.e. the server didn't receive the file
			echo '<p class="result">';
			echo '  <b>File not uploaded on the server</b><br />';
			echo '  Error: ' . $handle->error . '';
			echo '</p>';
		}
	}
}

$picture = Admin::GetProfilePicture();
?>
</head>
<body>
<div id="change">
	<h3>Current Profile Picture</h3>
	<?php echo "<img src='$picture' /><br />"; ?>
	<form name="form1" enctype="multipart/form-data" method="post"/>
		<p><input type="file" size="32" name="my_field" value="" /></p>
		<p class="button"><input type="hidden" name="action" value="simple" />
		<input type="submit" name="submitted" value="Upload" />
		<input type="submit" name="back" value="Go Back" />
		
		</p>
	</form>
</div>
</body>
</html>
