<?php
//Include Medoo and database.config
require_once 'medoo.min.php';
require_once 'database.config.php';

class Admin{

	// Variables
	private static $database;
	private static $salt;
	
	public static function Initialize_Class(){
		$database = DatabaseConfig::Initialize_DataBase();
		$salt = "1234567890";
	}
	
	public static function GetSelfScript()
    {
        return htmlentities($_SERVER['PHP_SELF']);
    } 
	
	public static function Login(){
		if(empty($_POST['username'])){
			echo "Enter username";
			return false;
		}
		if(empty($_POST['password'])){
			echo "Enter Password";
			return false;
		}
		$username = trim($_POST['username']);
        $password = Encrypt_Password(trim($_POST['password']));
        
         if(!isset($_SESSION)){ 
			 session_start(); 
		}
		if(!Check_Login_Creditials($username,$password)){
			echo "Username or Password is wrong";
			return false;
		}
		$_SESSION['User_Name'] = $username;

	}

	private static function Initialize_New_Database(){
		if($database->get("account","ID_User",["1=1"]) ==0)
		{
			echo "Account table not created";
			$database->query("CREATE TABLE `account` (
				ID_User int(11) NOT NULL AUTO_INCREMENT,
				`Name` varchar(512) NOT NULL,
				`Email` varchar(512) NOT NULL,
				`Phone_Number` varchar(512) NOT NULL,
				`User_Name` varchar(512) NOT NULL,
				`User_Password` varchar(512) NOT NULL,
				`Admin` tinyint(1) NOT NULL,
				`Active` tinyint(1) NOT NULL,
				`Bio` text NOT NULL,
				PRIMARY KEY (`ID_User`)
				) ENGINE=InnoDB"
				);
				
			$database->insert("account", [
				"Name" => "foo",
				"Email" => "foo@bar.com",
				"Phone_Number" => "555-5555",
				"User_Name" => "foo",
				"User_Password" => Encrypt_Password("Pass"),
				"Admin" => 1,
				"Active" => 1,
				"Bio" => "<h1>Sample Bio</h1>"
				]);
		} else {
			echo "Account table created";
		}
	}
	
	private static function Encrypt_Password($pass){
		$EncryptedPass = crypt($pass,$salt);
		
		return $EncryptedPass;
	}
	
	private static function Check_Login_Creditials($username,$password){
		if($database->has("account",["User_Password" => $password])){
			return true;
		}
		return false;
	}
	
}Admin::Initialize_Class();
?>
