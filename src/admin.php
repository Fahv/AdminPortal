<?php
//Include Medoo and database.config
require_once 'medoo.php';
require_once 'database.config.php';

class Admin{

	// Variables
	private static $database;
	private static $salt;
	private static $NameOfSite;
	
	public static function Initialize_Class(){
		self::$database = DatabaseConfig::Initialize_DataBase();
		self::$salt = "1234567890";
		self::Initialize_New_Database();
		self::$NameOfSite = "Admin Portal";
	}
	
	public static function GetSelfScript()
    {
        return htmlentities($_SERVER['PHP_SELF']);
    } 
	
	public static function Login(){
		echo "Start Login";
		if(empty($_POST['username'])){
			echo "Enter username";
			return false;
		}
		if(empty($_POST['password'])){
			echo "Enter Password";
			return false;
		}
	
		$username = trim($_POST['username']);
        $password = Admin::Encrypt_Password(trim($_POST['password']));
        if(!isset($_SESSION)){ 
			 session_start(); 
		}
		if(!Admin::Check_Login_Creditials($username,$password)){
			echo "Username or Password is wrong";
			return false;
		}
		$_SESSION['User_Name'] = $username;
		$_SESSION['User_ID'] = self::Get_ID_From_UserName($username);
		return true;
	}

	public static function Count_Entrities(){
		return self::$database->count("account",["User_ID"=>1]);
	}
	
	public static function Check_Logged_In(){
		if(!isset($_SESSION)){ session_start(); }
		//echo $_SESSION['User_ID'];
		if(isset($_SESSION['User_ID'])){
			return true;
		}
		return false;
	}
	
	public static function Redirect($url){
		header("Location: $url");
		exit;
	}
	
	public static function GetProfilePicture(){
		return "../Profile Pictures/".$_SESSION['User_ID'].".png";
	}

	public static function GetBio(){
		$tmp = self::$database->get("account","Bio",["User_ID" => $_SESSION['User_ID']]);
		return $tmp;
	}
	public static function GetPhoneNumber(){
		return self::$database->get("account","Phone_Number",["User_ID" => $_SESSION['User_ID']]);
	}
	public static function GetEmail(){
		return self::$database->get("account","Email",["User_ID" => $_SESSION['User_ID']]);
	}
	public static function GetAdminStatus(){
		return self::$database->get("account","Admin",["User_ID" => $_SESSION['User_ID']]);
	}
	public static function GetActiveStatus(){
		return self::$database->get("account","Active",["User_ID" => $_SESSION['User_ID']]);
	}
	public static function UpdateBio(){
		if(empty($_POST['bio'])){
			echo "Bio not submitted";
			return false;
		}
		$bio = trim($_POST['bio']);
		self::$database->update("account",["Bio" =>$bio],["User_ID" => $_SESSION['User_ID']]);
		return true;
	}
	public static function UpdateContactInfo(){
		$phone = trim($_POST['phone']);
		$email = trim($_POST['email']);
		self::$database->update("account",["Phone_Number" =>$phone,"Email" => $email],["User_ID" => $_SESSION['User_ID']]);
		return true;
	}
	
	public static function RegisterNewUser(){
		if(empty($_POST['username'])){
			echo "Username not submitted";
			return false;
		}
		if(empty($_POST['name'])){
			echo "Name not submitted";
			return false;
		}
		$username = trim($_POST['username']);
		$name = trim($_POST['name']);
		$email = trim($_POST['email']);
		$phone = trim($_POST['phone']);
		$admin = $_POST['admin'];
		$active = $_POST['active'];
		$password = substr(base64_encode($email),0,8);
		self::$database->insert("account",[
				"Name" => $name,
				"Email" => $email,
				"Phone_Number" => $phone,
				"User_Name" => $username,
				"User_Password" => self::Encrypt_Password($password),
				"Admin" => $admin,
				"Active" => $active,
				"Bio" => "<h1>Sample Bio, please change</h1>"
				]);
		//self::Send_User_Email($email,"New User created on the $NameOfSite",$message);
		return true;
	}

	private static function Initialize_New_Database(){
		if(self::$database->get("account","User_ID",["1=1"]) ==0)
		{
			self::$database->query("CREATE TABLE `account` (
				User_ID int(11) NOT NULL AUTO_INCREMENT,
				`Name` varchar(512) NOT NULL,
				`Email` varchar(512) NOT NULL,
				`Phone_Number` varchar(512) NOT NULL,
				`User_Name` varchar(512) NOT NULL UNIQUE,
				`User_Password` varchar(512) NOT NULL,
				`Admin` tinyint(1) NOT NULL,
				`Active` tinyint(1) NOT NULL,
				`Bio` text NOT NULL,
				PRIMARY KEY (`User_ID`)
				) ENGINE=InnoDB"
				);
			
			self::$database->insert("account", [
				"Name" => "foo",
				"Email" => "foo@bar.com",
				"Phone_Number" => "555-5555",
				"User_Name" => "foo",
				"User_Password" => self::Encrypt_Password("Bar"),
				"Admin" => 1,
				"Active" => 0,
				"Bio" => "<h1>Sample Bio</h1>"
				]);
			if(self::$database->get("account","User_ID",["1=1"]) ==1)
			{
				echo "Account table created succesfully";
			} else {
				echo "Error while creating account table";
				var_dump(self::$database->error());
			}
		} else {
			//echo "Account table already created";
		}
	}
	
	private static function Encrypt_Password($pass){
		$EncryptedPass = crypt($pass,self::$salt);
		
		return $EncryptedPass;
	}
	
	private static function Check_Login_Creditials($username,$password){
		//var_dump(self::$database->error());
		
		$there = self::$database->has("account",["AND"=> ["User_Password" => $password ,"User_Name" =>$username]]);
		
		if($there){
			return true;
		}
		return false;
	}
	private static function Get_ID_From_UserName($username){
		$tmp = self::$database->get("account",["User_ID"],["User_Name" =>$username]);
		return $tmp["User_ID"];
	}
	
	private static function Send_User_Email($to,$subject,$message){
		$headers = "From: webmaster@example.com\r\nReply-To: webmaster@example.com";
		
		$mail_sent = mail( $to, $subject, $message, $headers );
		return $mail_sent ? TRUE : FALSE;
	}
	
}Admin::Initialize_Class();
?>
