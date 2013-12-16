<?require_once('../src/admin.php');?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
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
