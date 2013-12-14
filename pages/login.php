<?require_once('../src/admin.php');?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
<?php 

if(isset($_POST['submitted']))
{
	if(Admin::Login())
	{
		Admin::Redirect("admin-home.php");
	}
}
if(isset($_POST['forgotpassword']))
{
	Admin::Redirect("ForgotPassword.php");
}
?>

</head>
<body>
	<div id="change">
		<h3>Log In</h3>
		<form method="POST">
			<label>User Name:</label><input type=text name='username' /><br />
			<label>Password:</label><input type=password name='password' /><br />
			<input type=submit name="submitted" value='Log In' />
			<input type=submit name="forgotpassword" value='Forgot Password' />
		</form>
</div>

</body>
</html>
