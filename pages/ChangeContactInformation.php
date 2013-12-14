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
	if(Admin::UpdateContactInfo()){
		Admin::Redirect("SuccessContact.php");
	}
}
if(isset($_POST['back']))
{
	Admin::Redirect("admin-home.php");
}
$phone = Admin::GetPhoneNumber();
$email = Admin::GetEmail();
?>

</head>
<body>
<div id="change">
	<h3>Change Contact Information</h3>
		<form method="POST">
			<lable>Phone Number:</lable><input type=text name='phone' value=<?php echo $phone; ?> />
			<br /> 
			<lable>Email:</lable><input type=text name='email' value=<?php echo $email; ?> />
			<br />
			<input type=submit name='submitted' value="Update Contact Infomation"/>
			<input type=submit name='back' value="Go Back" />
		</form>
</div>
</body>
</html>
