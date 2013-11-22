<html>
<head>
<link rel="stylesheet" type="text/css" href="../style/style.css" />
<?php
require_once('../src/admin.php');
if(!Admin::Check_Logged_In()){
	Admin::Redirect("login.php");
}
if(isset($_POST['submitted'])){
	if(isset($_FILES['imgfile'])){
		$filename =  $_FILES['imgfile']["name"];
		list($width, $height, $type, $attr) = getimagesize($_FILES['imgfile']["tmp_name"]);
		if (((($_FILES["imgfile"]["type"] == "image/png") ||(($_FILES["imgfile"]["type"] == "image/jpg")))&& ($_FILES["imgfile"]["size"] < 200000)))
		{
			if(file_exists($_FILES["imgfile"]["name"]))
			{
				echo "File name exists.";
			}
			else
			{
				if(move_uploaded_file($_FILES["imgfile"]["tmp_name"],"img/profile/$filename") == TRUE){
					echo "Upload Successful . <a href='img/profile/".$fgmembersite->UserId().".png'>Click here</a> to view the uploaded image";
				} else{
					echo "Upload Unsuccessful.";
				}
			}
		}
		else{	//Image File Type
			echo "invalid file.";
		}		
	} else{	//File Name not Given
		echo "No file name given";
	}
}

$picture = Admin::GetProfilePicture();
?>
</head>
<body>
<div id="content">
	<h3>Current Profile Picture</h3>
	<?php echo "<img src='$picture' /><br />"; ?>
	<form name="form1" enctype="multipart/form-data" method="post" action="upload.php" />
		<p><input type="file" size="32" name="my_field" value="" /></p>
		<p class="button"><input type="hidden" name="action" value="simple" />
		<input type="submit" name="Submit" value="upload" /></p>
	</form>
</div>
</body>
</html>
