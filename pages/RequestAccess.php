<?require_once('../src/admin.php');?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
<?php
if(Admin::Check_Logged_In()){
	Admin::Redirect("admin-home.php");
}

if(isset($_POST['submitted']))
{
	if(Admin::NewUserRequest()){
		Admin::Redirect("SuccessNewUserRequest.php");
	}
}
if(isset($_POST['back']))
{
	Admin::Redirect("../index.html");
}
?>

</head>
<body>
<div id="change">
	<h3>Register New User</h3>
		<form method="POST">
			<label>Desired User Name:</label><input type=text name='username'/>
			<br />
			<label>Real Name:</label><input type=text name='name' />
			<br />
			<label>Phone Number:</lable><input type=text name='phone'/>
			<br /> 
			<label>Email:</lable><input type=text name='email'/>
			<br />
			<p>Why should you be given an account?</p><textarea></textarea>
			<br />
			<input type=submit name='submitted' value="Send for Admin Review"/>
			<input type=submit name='back' value="Go Back" />
		</form>
</div>
</body>
</html>
