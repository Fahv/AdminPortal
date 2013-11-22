<html>
<head>
<?php
require_once('../src/admin.php');
if(!Admin::Check_Logged_In()){
	Admin::Redirect("login.php");
}

if(isset($_POST['submitted']))
{
	Admin::UpdateBio();
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
	<form method="POST">
		<input type='hidden' name='submitted' id='submitted' value='1'/>
	<textarea maxlength=512 rows="8" cols="30" name="bio"><?=Admin::GetBio();?></textarea>
	<input type=submit value="Update Bio"/>
</form>
</body>
</html>
