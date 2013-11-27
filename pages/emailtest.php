<?php

require_once('../src/admin.php');

if(Admin::SendTestEmail()){
	echo "Email success";
} else {
	echo "could not send email";
}

?>
