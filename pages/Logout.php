<html>
<head>
<?php
require_once('../src/admin.php');
if(isset($_SESSION)){ 
	$_SESSION = array();
	session_destroy();
	}
Admin::Redirect("login.php");
?>
</head>
</html>
