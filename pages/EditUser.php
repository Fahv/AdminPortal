<?require_once('../src/admin.php');?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
<?php
if(!Admin::Check_Logged_In()){
	Admin::Redirect("login.php");
}
if(!Admin::GetAdminStatus()){
	Admin::Redirect("admin-home.php");
}

if(isset($_POST['submitted']))
{
	if(Admin::UpdateUsers()){
		echo "<script>alert('Updated Users');</script>";
	}
}
if(isset($_POST['back']))
{
	Admin::Redirect("admin-home.php");
}
$UsersArray = Admin::GetUsers();
?>

</head>
<body>
	<div id="change">
		<h3>Modify Users</h3>
		<form method="POST">
			<table border=1 align=center>
				<tr>
					<td>Name</td>
					<td>Email</td>
					<td>Profile Image</td>
					<td>Active</td>
					<td>Admin</td>
				</tr>
				<?php
				$alert = "alert('test')";
				foreach($UsersArray as $User){
					$active = "";
					$admin = "";
					if($User['Active']){
						$active = "checked";
					}
					if($User['Admin']){
						$admin = "checked";
					}
				echo "<tr>
					<td>".$User['Name']."</td>
					<td>".$User['Email']."</td>
					<td><img src='".Admin::GetProfilePictureOfId($User['User_ID'])."' /></td>
					<td><input type=checkbox name='active".$User['User_ID']."' $active/></td>
					<td><input type=checkbox name='admin".$User['User_ID']."' $admin/><input type=hidden name='User_ID".$User['User_ID']."' value='".$User['User_ID']."' /></td>
				</tr>";
				}			
				?>
			</table>
			<input type=submit name='submitted' value="Update Users"/>
			<input type=submit name='back' value="Go Back" />
			</form>
	</div>
</body>
</html>
