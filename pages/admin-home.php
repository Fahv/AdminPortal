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

if(!$active){
	$string = 'Your account has been disabled by an admin \nYour profile will not show up on the main site,\nuntil an admin renables your account';
	//$patterns = array("/\\\\/", '/\n/', '/\r/', '/\t/', '/\v/', '/\f/');
	//$replacements = array('\\\\\\', '\n', '\r', '\t', '\v', '\f');
	//$string = preg_replace($patterns, $replacements, $string);
	echo '<script>alert("'.$string.'")</script>';
}

?>

</head>
<body>
	<div id='content'>
		<div id='sideBar'>
			<ul>
				<li><a href='ChangeBio.php'>Change Bio</a></li>
				<li><a href='ChangeProfilePicture.php'>Change Profile Picture</a></li>
				<li><a href='ChangeContactInformation.php'>Change Contact Information</a></li>
				<li><a href='Logout.php'>Log Out</a></li>
			</ul>
			<?php
			if($admin){
			echo "
			Admin only Functions
			<ul>
				<li><a href='RegisterNewUser.php'>Register New User</a></li>
				<li><a href='BlockUser.php'>Block A User</a></li>
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
				echo "You are an admin";
			}
			if(!$active){
				echo "$active";
			}
				
			?>
		</div>
	</div>
</body>
</html>
