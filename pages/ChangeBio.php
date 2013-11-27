<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
<?php
require_once('../src/admin.php');
if(!Admin::Check_Logged_In()){
	Admin::Redirect("login.php");
}

if(isset($_POST['submitted']))
{
	if(Admin::UpdateBio()){
		Admin::Redirect("SuccessBio.php");
	}
}
if(isset($_POST['back']))
{
	Admin::Redirect("admin-home.php");
}

$bio = Admin::GetBio();
?>
<script type='text/javascript' src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({
			selector:'textarea',
			plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste "
    ],
			toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | link image | formatselect fontselect fontsizeselect ",
			//toolbar1: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"

			menubar: false,
			toolbar_items_size: 'small',
			 });
</script>
</head>
<body>
	<div id="change">
		<h3>Change Bio</h3>
		<form method="POST">
			<textarea name="bio"><?=Admin::GetBio();?></textarea>
			<input type=submit name='submitted' value="Update Bio"/>
			<input type=submit name='back' value="Go Back" />
		</form>
	</div>
</body>
</html>
