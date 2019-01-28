<?php 
include_once 'dbconfig.php';
/**
 * 
 */
session_start();
class Users 
{
	public $con;
	
	function __construct()
	{
		$this->con= mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		if (mysqli_connect_errno()) {
			echo "Error: Cannot Connect To Database";
			exit;
		}
	}

	// INSERT AND VALIDATE REGISTRATION
	public function register_user($fullname,$username,$email,$password)
	{
		$password = md5($password);
		//check if username/email exist already in db
		$sql = "SELECT * FROM user_info WHERE username='$username' OR email='$email'";
		$check = $this->con->query($sql);
		$count_rows =$check->num_rows;

		if ($count_rows == 0) 
		{
			//insert to db if no result
			$sql1 = "INSERT INTO user_info SET fullname='$fullname', email='$email', username='$username', password='$password'";
			// echo $sql1;
			$result = mysqli_query($this->con,$sql1) or die(mysqli_connect_errno()."Error Data Cannot Insert To Table");
			return $result;
		}
		else { return false; }

	}
	public function login_user($useroremail,$pass){

		$pass = md5($pass);
		$sql = "SELECT id from user_info WHERE email='$useroremail' or username ='$useroremail' and password='$pass'";
		$result = mysqli_query($this->con,$sql);
		$user_data = mysqli_fetch_array($result);
		$countrow = $result->num_rows;

		if ($countrow == 1) {
			//this login var is for session
			$_SESSION['login'] = true;
			$_SESSION['id'] = $user_data['id'];
			return true;
		}
		else
		{
			return false;
		}
	}
	//LOGOUT DESTROY SESSION
	public function logout_user()
	{
		$_SESSION['login'] = FALSE;
		session_destroy();
	}
	//end logout session

	//Display user on live chat
	// public function display_users_chat()
	// {

	// 	// $sql = " SELECT * FROM user_info";

	// 	// $array = array();

	// 	// $query =mysqli_query($this->con,$sql);
	// 	// while ($row = mysqli_fetch_assoc($query)) {
	// 	// 	$array[] =$row;
	// 	// }
	// 	// // echo $sql;
	// 	// return $array;
	// 	echo "string";
	// }
	public function display_users()
	{

		$sql = " SELECT * FROM user_info";

		$array = array();

		$query =mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] =$row;
		}
		// echo $sql;
		return $array;
		// echo "string";
	}
	public function display_clicked_user($useridclick)
	{

		$sql = " SELECT * FROM user_info WHERE id ='".$useridclick."'";

		$array = array();

		$query =mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] =$row;
		}
		// echo $sql;
		return $array;
		// echo "string";
	}
	public function send_message($table,$myarray)
	{
		$sql ="";
		$sql .="INSERT INTO ".$table;
		$sql .=" (".implode(",",array_keys($myarray)).") VALUES ";
		$sql .="('".implode("','",array_values($myarray))."')";
		// print_r($fields);
		// echo $sql;
		// print_r($fields);
		
		$query =mysqli_query($this->con,$sql);
		if ($query) {
			return true;
		}
	}
	// SELECT * FROM live_chat LEFT JOIN user_info ON user_info.id = live_chat.sender_id WHERE live_chat.sender_id = '2' AND live_chat.receiver_id ='1' OR live_chat.sender_id ='1' AND live_chat.receiver_id ='2'
	public function display_convo($table,$table2,$senderid,$recieverid)
	{
		$sql= " SELECT * FROM ".$table." LEFT JOIN ".$table2." ON ".$table2.".id =".$table.".sender_id WHERE ".$table.".sender_id =".$senderid." AND ".$table.".receiver_id ='".$recieverid."' OR ".$table.".sender_id ='".$recieverid."' AND ".$table.".receiver_id ='".$senderid."'";

		// $sql= " SELECT * FROM ".$table.",".$table2.",".$table3." WHERE ".$table2.".id =".$table3.".id_user AND ".$table.".id_posts ='".$idofpost."' ORDER BY ".$table3.".date_comment ASC ";
		$array = array();
		$query = mysqli_query($this->con,$sql);
		// echo $sql;
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] = $row;
		}
		// echo $sql;
		return $array;

	}

	
}


?>