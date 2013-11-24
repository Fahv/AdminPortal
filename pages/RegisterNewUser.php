<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
<?php
require_once('../src/admin.php');
if(!Admin::Check_Logged_In()){
	Admin::Redirect("login.php");
}
if(!Admin::GetAdminStatus()){
	Admin::Redirect("admin-home.php");
}

if(isset($_POST['submitted']))
{
	if(Admin::RegisterNewUser()){
		Admin::Redirect("SuccessRegister.php");
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
	<h3>Register New User</h3>
		<form method="POST">
			<label>User Name:</label><input type=text name='username'/>
			<br />
			<label>Name:</label><input type=text name='name' />
			<br />
			<lable>Phone Number:</lable><input type=text name='phone'/>
			<br /> 
			<lable>Email:</lable><input type=text name='email'/>
			<br />
			<lable>Admin?</lable><input type=checkbox name='admin'/>
			<lable>Active?</lable><input type=checkbox name='active' checked=yes/>
			<br />
			<input type=submit name='submitted' value="Register New User"/>
			<input type=submit name='back' value="Go Back" />
		</form>
</div>
</body>
</html>
