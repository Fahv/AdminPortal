<?require_once('../src/admin.php');?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
<?php
if(!Admin::Check_Logged_In()){
	Admin::Redirect("login.php");
}
if(isset($_POST['submitted']))
{
	if(Admin::ChangePassword()){
		Admin::Redirect("SuccessPassword.php");
		//var_dump(Admin::GetError());
		//exit;
	}
}
if(isset($_POST['back']))
{
	Admin::Redirect("admin-home.php");
}
?>

</head>
<body>
<div id="change">
	<h3>Change Password</h3>
		<form method="POST">
			<label>Old Password</label><input type=password name='oldPass'/>
			<br />
			<label>New Password:</label><input type=password name='newPass1' />
			<br />
			<lable>New Password Again:</lable><input type=password name='newPass2'/>
			<br /> 
			<input type=submit name='submitted' value="Change Password"/>
			<input type=submit name='back' value="Go Back" />
		</form>
</div>
</body>
</html>
