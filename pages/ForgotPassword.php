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
	if(Admin::ForgotPassword()){
		Admin::Redirect("SuccessForgotPassword.php");
	}
}
if(isset($_POST['back']))
{
	Admin::Redirect("index.html");
}
?>

</head>
<body>
<div id="change">
	<h3>Forgot Password</h3>
		<form method="POST">
			<label>User Name:</label><input type=text name='username'/>
			<br />
			<label>Real Name:</label><input type=text name='name' />
			<br />
			<label>Email:</lable><input type=text name='email'/>
			<br />
			<input type=submit name='submitted' value="Request Password"/>
			<input type=submit name='back' value="Go Back" />
		</form>
</div>
</body>
</html>
