<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
	<?php
require_once('../src/admin.php');

if(!Admin::Check_Logged_In()){
	Admin::Redirect("login.php");
}

$picture = Admin::GetProfilePicture();
$bio = Admin::GetBio();
$phone = Admin::GetPhoneNumber();
$email = Admin::GetEmail();
$admin = Admin::GetAdminStatus();
$active = Admin::GetActiveStatus();

?>

</head>
<body>
	<div id='content'>
		<div id='sideBar'>
			<ul>
				<li><a href='registerNewUser.php'>Change Bio</a></li>
				<li><a href='registerNewUser.php'>Change Profile Picture</a></li>
				<li><a href='registerNewUser.php'>Change Contact Information</a></li>
				<li><a href='logout.php'>Log Out</a></li>
			</ul>
			<?php
			if($admin){
			echo "
			Admin only Functions
			<ul>
				<li><a href='registerNewUser.php'>Register New User</a></li>
				<li><a href='registerNewUser.php'>Block A User</a></li>
			</ul>";}
			?>
		</div>
		<div id='preview'>
			<?php
			echo "<img src='$picture' /><br />";
			echo "$bio <br />";
			echo "Phone Number: $phone <br />";
			echo "Email: $email <br />";
			if($admin){
				echo "You are an admin ";
			}
			?>
		</div>
	</div>
</body>
</html>
