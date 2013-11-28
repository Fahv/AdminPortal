<html>
<head>
	<link rel="stylesheet" type="text/css" href="/AdminPortal/style/style.css" />
	<?php require_once('src/admin.php');
		$UsersArray = Admin::Get_Active_User_Info();
		$UserToDisplay;
		$ID;
		if(isset($_GET['ID'])){
			$ID = $_GET['ID'];
		} else {
			$ID = 1;
		} 
		foreach($UsersArray as $User){
			if($User['User_ID'] == $ID){
				$UserToDisplay = $User;
			}
		}
		$name = $UserToDisplay['Name'];
		$picture = Admin::GetProfilePictureOfId($UserToDisplay['User_ID']);
		$bio = $UserToDisplay['Bio'];
		$phone = $UserToDisplay['Phone_Number'];
		$email = $UserToDisplay['Email'];
	?>

</head>
<body>
	<div id="content">
		<div id="sidebar">
				<ul>
				<?php
				foreach($UsersArray as $User){
					echo "<li>";
					echo "<a href='ExamplePage.php?ID=".$User['User_ID']."'>";
					echo "<img src='".Admin::GetProfilePictureOfId($User['User_ID'])."' /></a>";
					echo"</li>";
				}
				
				?>
				</ul>
		</div>
		<div id="preview">
		<?php
			echo "<img src='$picture' /><br />";
			echo "$bio <br />";
			echo "Phone Number: $phone <br />";
			echo "Email: $email <br />";			
		?>
		</div>
	</div>
</body>
</html>
