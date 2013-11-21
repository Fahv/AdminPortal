<html>
<head>
<?php require_once('../src/admin.php');

if(isset($_POST['submitted']))
{
	echo "Submitted";
	if(Admin::Login())
	{
		echo "Login successful";
		Admin::Redirect("admin-home.php");
		
		//$fgmembersite->RedirectToURL("login-home.php");
	}
}
?>

</head>
<body>
<form method="POST">
	<input type='hidden' name='submitted' id='submitted' value='1'/>
	<label>User Name:</label><input type=text name='username' /><br />
	<label>Password:</label><input type=password name='password' /><br />
<input type=submit value='Log In' />
</form>

</body>
</html>
